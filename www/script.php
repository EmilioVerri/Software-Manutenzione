<?php

include ('./classi/ClasseStorico.php');
include ('./classi/funzioniGiorni.php');

$my_conn = new PDO('sqlite:manutentori.db');

$data=$_GET['data'];
$esito=$_GET['esito'];
$note=$_GET['note'];
$identificativo=$_GET['identificativo'];


$queryInfo = $my_conn->prepare("INSERT INTO 'storici' ('data','esito','note','manutenzione') VALUES ('{$data}','{$esito}','{$note}','{$identificativo}')");
                $queryInfo->execute();

                $secondquery = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE identificativo='{$identificativo}'");
                $secondquery->execute();
    
                foreach ($secondquery as $row) {
    
                    //$ProxMan = $row['ProxMan'];
                    $GiorniManutenzione = $row['Manutenzione'];
    
                    $value = prossimaManutenzione($data, $GiorniManutenzione);
    
                    $query = $my_conn->prepare("UPDATE manutenzioni SET UltimaMan='{$data}' WHERE identificativo='{$identificativo}'");
                    $query->execute();
    
    
                    $query = $my_conn->prepare("UPDATE 'manutenzioni' SET ProxMan='{$value}' WHERE identificativo='{$identificativo}'");
                    $query->execute();
//$storico = new Storico($_POST['data'], $_POST['esito'], $_POST['note'], $_POST['identificativoPerStorico']);
//$storico->aggiungiStorico();
//$_SESSION['show'] = 0;




//da finire la gestione dello storico 

                }
                $_SESSION['show'] = 0;


                header('Location: .\index.php');

?>