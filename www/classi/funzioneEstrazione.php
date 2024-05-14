<?php
function estraiManutenzione()
{
    $my_conn = new PDO('sqlite:manutentori.db');
    $query = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $estrazioni) {
        echo "<tr>
                <td id='stile'>{$estrazioni['Sigla']}</td>
                <td id='stile'>{$estrazioni['Nome']}</td>
                <td id='stile'>{$estrazioni['Cat']}</td>
                <td id='stile'>{$estrazioni['Reparto']}</td>
                <td id='stile'>{$estrazioni['Manutenzione']}</td>
                <td id='stile'>{$estrazioni['UltimaMan']}</td>
                <td id='stile'>{$estrazioni['ProxMan']}</td>
                <td id='stile' style='display:none;'>{$estrazioni['identificativo']}</td>
            </tr>";
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
function estraiScadenzaNonScadenzaPrecedente()
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
            $stringDate = $estrazioni['UltimaMan'];
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













