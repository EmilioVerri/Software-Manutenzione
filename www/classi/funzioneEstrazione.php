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
            </tr>";
    }
}


?>