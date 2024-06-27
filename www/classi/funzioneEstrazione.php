<?php

function estraiManutenzione()
{
   
        $my_conn = new PDO('sqlite:manutentori.db');
        $query = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $estrazioni) {
            echo "<tr id='storiciLista'>
                    <td id='stile'>{$estrazioni['Sigla']}</td>
                    <td id='stile'>{$estrazioni['Nome']}</td>
                    <td id='stile'>{$estrazioni['Cat']}</td>
                    <td id='stile'>{$estrazioni['Reparto']}</td>
                    <td id='stile'>{$estrazioni['Manutenzione']}</td>
                    <td id='stile'>{$estrazioni['UltimaMan']}</td>
                    <td id='stile'>{$estrazioni['ProxMan']}</td>
                    <td id='stile' style='display:none;'>{$estrazioni['identificativo']}</td>";
            $identificativoEstratto = $estrazioni['identificativo'];
    
            $queryDue = $my_conn->prepare("SELECT * FROM 'storici' WHERE manutenzione='{$identificativoEstratto}'");
    
            $queryDue->execute();
    
            $risultato = $queryDue->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($risultato as $estrazioneDue) {
    
                echo "
                        <td id='storici' style='display:none'>{$estrazioneDue['id']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['data']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['esito']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['note']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['manutenzione']}</td>
                        
                        ";
            }
    
            echo "</tr>";
        }
       
    
   
}



function estraiManutenzioneScadute()
{
  
        $my_conn = new PDO('sqlite:manutentori.db');
        $query = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE InScadenza=1");
        $query->execute();
        
        foreach ($query as $estrazioni) {
            echo "<tr id='storiciLista'>
                    <td id='stile'>{$estrazioni['Sigla']}</td>
                    <td id='stile'>{$estrazioni['Nome']}</td>
                    <td id='stile'>{$estrazioni['Cat']}</td>
                    <td id='stile'>{$estrazioni['Reparto']}</td>
                    <td id='stile'>{$estrazioni['Manutenzione']}</td>
                    <td id='stile'>{$estrazioni['UltimaMan']}</td>
                    <td id='stile'>{$estrazioni['ProxMan']}</td>
                    <td id='stile' style='display:none;'>{$estrazioni['identificativo']}</td>";
            $identificativoEstratto = $estrazioni['identificativo'];
    
            $queryDue = $my_conn->prepare("SELECT * FROM 'storici' WHERE manutenzione='{$identificativoEstratto}'");
    
            $queryDue->execute();
    
            $risultato = $queryDue->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($risultato as $estrazioneDue) {
    
                echo "
                        <td id='storici' style='display:none'>{$estrazioneDue['id']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['data']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['esito']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['note']}</td>
                        <td id='storici' style='display:none'>{$estrazioneDue['manutenzione']}</td>
                        
                        ";
            }
    
            echo "</tr>";
        }
    
    
   
}



function estraiIdentificativo()
{
    $my_conn = new PDO('sqlite:manutentori.db');
    $query = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $maxValue = 0;
    foreach ($results as $estrazioni) {
        if ($estrazioni['identificativo'] > $maxValue) {
            $maxValue = $estrazioni['identificativo'];
        }


    }
    return $maxValue;
}


function is_data_formato_valido($data) {
    // Espressione regolare per il formato dd/mm/YYYY
    $regex = '/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(19[0-9][0-9]|20[0-2][0-4])$/';
    // Controlla se la data corrisponde al formato regex
    return preg_match($regex, $data);
  }


function estraiScadenzaManutenzioniCheckbox()
{
    $my_conn = new PDO('sqlite:manutentori.db');
    $query = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $estrazioni) {
        if ($estrazioni["InScadenza"] == 1) {
            $presenza = "ok";
            return $presenza;
        } else {
        }
    }
    $presenza = "NonOK";
    return $presenza;
}






//per la checkbox
/*function estraiScadenzaNonScadenzaPrecedente()
{
    $my_conn = new PDO('sqlite:manutentori.db');
    $query = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $estrazioni) {
        if ($estrazioni["InScadenza"] == 1) {
            $my_conn = new PDO('sqlite:manutentori.db');
            $query = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=0 WHERE InScadenza=1");
            $query->execute();

        }
    }
}







//per la tabella

function estraiScadenzaNonScadenza()
{
    $my_conn = new PDO('sqlite:manutentori.db');
    $query = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $estrazioni) {
        if ($estrazioni["InScadenza"] == 1) {
            $my_conn = new PDO('sqlite:manutentori.db');
            $query = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=0 WHERE InScadenza=1");
            $query->execute();
        } else {//Capiamo dove si trova rispettivamente la data
            $stringDate = $estrazioni['ProxMan'];
            $format = "d/m/Y";


            $pastDate = DateTime::createFromFormat($format, $stringDate);


            $today = new DateTime('now');


            if ($pastDate->format('Y') < $today->format('Y')) {
                //nel passato
                $my_conn = new PDO('sqlite:manutentori.db');
                $query = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=1 WHERE id='{$estrazioni['id']}'");
                $query->execute();

                echo "<tr>
                <td id='stile'>{$estrazioni['Sigla']}</td>
                <td id='stile'>{$estrazioni['Nome']}</td>
                <td id='stile'>{$estrazioni['Cat']}</td>
                <td id='stile'>{$estrazioni['Reparto']}</td>
                <td id='stile'>{$estrazioni['Manutenzione']}</td>
                <td id='stile'>{$estrazioni['UltimaMan']}</td>
                <td id='stile'>{$estrazioni['ProxMan']}</td>
                <td id='stile' style='display:none;'>{$estrazioni['identificativo']}</td>
                </tr>
            ";


            } elseif ($pastDate->format('Y') > $today->format('Y')) {
                //futuro
            } else {
                if ($pastDate->format('md') < $today->format('md')) {
                    //passato
                    $my_conn = new PDO('sqlite:manutentori.db');
                    $query = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=1 WHERE id='{$estrazioni['id']}'");
                    $query->execute();
                    echo "
                    <tr>
                <td id='stile'>{$estrazioni['Sigla']}</td>
                <td id='stile'>{$estrazioni['Nome']}</td>
                <td id='stile'>{$estrazioni['Cat']}</td>
                <td id='stile'>{$estrazioni['Reparto']}</td>
                <td id='stile'>{$estrazioni['Manutenzione']}</td>
                <td id='stile'>{$estrazioni['UltimaMan']}</td>
                <td id='stile'>{$estrazioni['ProxMan']}</td>
                <td id='stile' style='display:none;'>{$estrazioni['identificativo']}</td>
                </tr>
            ";
                } elseif ($pastDate->format('md') > $today->format('md')) {
                    //futuro
                } else {
                    //oggi
                    $my_conn = new PDO('sqlite:manutentori.db');
                    $query = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=1 WHERE id='{$estrazioni['id']}'");
                    $query->execute();
                    echo "<tr>
                <td id='stile'>{$estrazioni['Sigla']}</td>
                <td id='stile'>{$estrazioni['Nome']}</td>
                <td id='stile'>{$estrazioni['Cat']}</td>
                <td id='stile'>{$estrazioni['Reparto']}</td>
                <td id='stile'>{$estrazioni['Manutenzione']}</td>
                <td id='stile'>{$estrazioni['UltimaMan']}</td>
                <td id='stile'>{$estrazioni['ProxMan']}</td>
                <td id='stile' style='display:none;'>{$estrazioni['identificativo']}</td>
                </tr>
            ";
                }
            }






        }
    }
}


*/





















