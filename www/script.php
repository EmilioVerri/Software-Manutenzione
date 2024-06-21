<?php

include ('./classi/ClasseStorico.php');

$storico = new Storico($_POST['data'], $_POST['esito'], $_POST['note'], $_POST['identificativoPerStorico']);
$storico->aggiungiStorico();
$_SESSION['show'] = 0;


//da finire la gestione dello storico 