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













