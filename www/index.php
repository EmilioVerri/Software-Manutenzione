<?php
include ('./classi/ClasseManutenzioni.php');
include ('./classi/funzioneEstrazione.php');
include ('./classi/ClasseStorico.php');
include ('./classi/funzioniPDF.php');

// Funzione per controllare il formato della data

session_start();
$my_conn = new PDO('sqlite:manutentori.db');

if (isset($_SESSION['show'])) {

} else {
    $_SESSION['show'] = 0;
}


/*echo "fatto";
die;*/

function stessoMese($data, $meseInput)
{
  $dateParts = explode("/", $data);
  // Extract the month from the array (second element)
  $mese = $dateParts[1];
  if ($mese == $meseInput) {
    $value = "ok";
    return $value;
  } else {
    $value = "nonok";
    return $value;
  }
}


if (isset($_POST['okStorico'])) {

    if (isset($_POST['identificativoPerStorico']) && $_POST['identificativoPerStorico'] != false) {


        $query = $my_conn->prepare("SELECT * FROM manutenzioni WHERE identificativo={$_POST['identificativoPerStorico']}");
        $query->execute();
        foreach ($query as $row) {
            $dataItalianaDue = $row['ProxMan'];
            $dataItalianaArrayDue = explode("/", $dataItalianaDue);
            $tempDue = $dataItalianaArrayDue[0];
            $dataItalianaArrayDue[0] = $dataItalianaArrayDue[1];
            $dataItalianaArrayDue[1] = $tempDue;

            $dataItalianaReversedDue = implode("/", $dataItalianaArrayDue);

            // Convertire la data italiana in timestamp UNIX
            $timestampDue = strtotime($dataItalianaReversedDue);

              
              if(isset($_POST['data'])){
                // Recupera la data dalla POST
              $data_ricevuta = $_POST['data'];
                // Controlla se la data è nel formato corretto
                if (!is_data_formato_valido($data_ricevuta)) {
                   echo "<script>
                   alert('Formato data non valido');
                   document.location.href='./index.php';
                   </script>";
                   exit;
                  }
            
                    // Controlla se la data è valida (esiste realmente)
              $giorno = substr($data_ricevuta, 0, 2);
              $mese = substr($data_ricevuta, 3, 2);
              $anno = substr($data_ricevuta, 6, 4);
              
              if (!checkdate($mese, $giorno, $anno)) {
                // Se la data non è valida, ricarica la pagina
                //header('Location: ' . $_SERVER['HTTP_REFERER']);
                echo "<script>
                alert('Formato data non valido');
                document.location.href='./index.php';
                </script>";
                exit;
              }
              }





            $dataItalianaTre = $_POST['data'];
            $dataItalianaArrayTre = explode("/", $dataItalianaTre);
            $tempTre = $dataItalianaArrayTre[0];
            $dataItalianaArrayTre[0] = $dataItalianaArrayTre[1];
            $dataItalianaArrayTre[1] = $tempTre;

            $dataItalianaReversedTre = implode("/", $dataItalianaArrayTre);

            // Convertire la data italiana in timestamp UNIX
            $timestampTre = strtotime($dataItalianaReversedTre);
            $data = $_POST['data'];
            $esito = $_POST['esito'];
            $note = $_POST['note'];
            $identificativoPerStorico = $_POST['identificativoPerStorico'];

            if ($timestampTre < $timestampDue) {
                $_SESSION['show'] = 0;
                echo "<script>if(confirm('Stai Facendo una manutenzione prima della sua Scadenza, Vuoi Procedere?')){document.location.href='./script.php?data=" . $data . "&esito=" . $esito . "&note=" . $note . "&identificativo=" . $identificativoPerStorico . "'}else{document.location.href='./index.php'};</script>";
                $_SESSION['show'] = 0;
            }elseif($timestampTre == $timestampDue){
                $_SESSION['show'] = 0;
                echo "<script>document.location.href='./script.php?data=" . $data . "&esito=" . $esito . "&note=" . $note . "&identificativo=" . $identificativoPerStorico . "';</script>";
            }
             else {
                $_SESSION['show'] = 0;

                //inserita qua dentro le info della classe aggiungiStorico()

                $queryInfo = $my_conn->prepare("INSERT INTO 'storici' ('data','esito','note','manutenzione') VALUES ('{$data}','{$esito}','{$note}','{$identificativoPerStorico}')");
                $queryInfo->execute();

                $secondquery = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE identificativo='{$identificativoPerStorico}'");
                $secondquery->execute();

                foreach ($secondquery as $row) {

                    $ProxMan = $row['ProxMan'];
                    $GiorniManutenzione = $row['Manutenzione'];

                    $value = prossimaManutenzione($data, $GiorniManutenzione);

                    $query = $my_conn->prepare("UPDATE manutenzioni SET UltimaMan='{$data}' WHERE identificativo='{$identificativoPerStorico}'");
                    $query->execute();


                    $query = $my_conn->prepare("UPDATE 'manutenzioni' SET ProxMan='{$value}' WHERE identificativo='{$identificativoPerStorico}'");
                    $query->execute();


                }

                //$storico = new Storico($_POST['data'], $_POST['esito'], $_POST['note'], $_POST['identificativoPerStorico']);
                //$storico->aggiungiStorico();
            }


            $_SESSION['show'] = 0;
        }





    } else {
        ?>
        <script>
            alert('Seleziona uno Storico');
        </script>
        <?php
        $_SESSION['show'] = 0;
    }

}






$manScadute = $my_conn->prepare("SELECT * FROM manutenzioni");
$manScadute->execute();


foreach ($manScadute as $row) {
    $dataItaliana = $row['ProxMan'];
    $dataItalianaArray = explode("/", $dataItaliana);
    $temp = $dataItalianaArray[0];
    $dataItalianaArray[0] = $dataItalianaArray[1];
    $dataItalianaArray[1] = $temp;

    $dataItalianaReversed = implode("/", $dataItalianaArray);

    // Convertire la data italiana in timestamp UNIX
    $timestamp = strtotime($dataItalianaReversed);

    $today = strtotime('today');

    $info = 1;
    $info2 = 0;



    if ($timestamp <= $today) {


            $queryUpdate = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=$info WHERE identificativo={$row['identificativo']}");
            $queryUpdate->execute();
    }else{
        $queryUpdate = $my_conn->prepare("UPDATE manutenzioni SET InScadenza=$info2 WHERE identificativo={$row['identificativo']}");
        $queryUpdate->execute();
    }
}


if (isset($_POST['eliminaStorico']) && isset($_POST['idElimaStorico'])) {
    if (empty($_POST['idElimaStorico'])) {
        ?>
        <script>
            alert('Seleziona uno Storico');
        </script>
        <?php
        $_SESSION['show'] = 0;

    } else {
        //come identificativo a sto giro gli passo ID dello storico
        $storico = new Storico($_POST['idDataStorico'], $_POST['idEsitoStorico'], $_POST['idNoteStorico'], $_POST['idElimaStorico']);
        $storico->eliminaStorico();
        $_SESSION['show'] = 0;
    }

}




if(isset($_POST['macchineEffettuateInData'])||isset($_POST['macchineInProgrammaPerData'])){
    // Recupera la data dalla POST
  $data_ricevuta = $_POST['dataPerPulsantiMacchine'];
    // Controlla se la data è nel formato corretto
    if (!is_data_formato_valido($data_ricevuta)) {
        $_SESSION['show'] = 0;
       echo "<script>
       alert('Formato data non valido');
       document.location.href='./index.php';
       </script>";
       exit;
      }

        // Controlla se la data è valida (esiste realmente)
  $giorno = substr($data_ricevuta, 0, 2);
  $mese = substr($data_ricevuta, 3, 2);
  $anno = substr($data_ricevuta, 6, 4);
  
  if (!checkdate($mese, $giorno, $anno)) {
    // Se la data non è valida, ricarica la pagina
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    $_SESSION['show'] = 0;
    echo "<script>
    alert('Formato data non valido');
    document.location.href='./index.php';
    </script>";
    exit;
  }
  }









//INIZIO GESTIONE BUTTON PDF

if (isset($_POST['tutteLeMacchine'])) {
    if (isset($_POST['Password']) && $_POST['Password'] == "9999") {
        tutteLeMacchinePDF();
    } else {
        ?>
        <script>
            alert('Password sbagliata');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
} elseif (isset($_POST['storicoMacchina'])) {
    if (isset($_POST['Password']) && $_POST['Password'] == "9999") {

        if ($_POST['codice'] != "") {
            $identificativo = $_POST['identificativoPerStorico'];
            $codice = $_POST['codice'];
            storicoMacchinaPDF($identificativo, $codice);
        } else {
            ?>
            <script>
                alert('Seleziona una macchina');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Password sbagliata');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
} elseif (isset($_POST['macchineEffettuateInData'])) {
    if (isset($_POST['Password']) && $_POST['Password'] == "9999") {

        if ($_POST['dataPerPulsantiMacchine'] != "") {
            $dataInput = $_POST['dataPerPulsantiMacchine'];
            macchineEffettuateInData($dataInput);
        } else {
            ?>
            <script>
                alert('Inserisci una data');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Password sbagliata');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
} elseif (isset($_POST['macchineInProgrammaPerData'])) {
    if (isset($_POST['Password']) && $_POST['Password'] == "9999") {
        if ($_POST['dataPerPulsantiMacchine'] != "") {
            $dataInputProg = $_POST['dataPerPulsantiMacchine'];
            macchineInProgrammaPerData($dataInputProg);
        } else {
            ?>
            <script>
                alert('Inserisci una data');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Password sbagliata');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
} elseif (isset($_POST['riepilogoMensile'])) {
    if (isset($_POST['Password']) && $_POST['Password'] == "9999") {
        if ($_POST['periodo'] != "") {
            $periodoDaEstrarre = $_POST['periodo'];
            riepilogoMensile($periodoDaEstrarre);
        } else {
            ?>
            <script>
                alert('Problema pulsante data');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Password sbagliata');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
}



//FINE GESTIONE BUTTON TUTTE LE MACCHINE




if (isset($_POST['Aggiungi'])) {
    if (isset($_POST['checkbox-group'])) {
        $valore = estraiIdentificativo();
        if ($valore == 0) {
        } elseif ($valore !== 0) {
            $info = $valore + 1;
        } else {
        }

        $manutenzione = new Manutenzione($_POST['codice'], $_POST['descrizioneAttrezzatura'], $_POST['categoria'], $_POST['reparto'], $_POST['checkbox-group'], $info);
        $manutenzione->aggiungiManutenzione();

    } else {
        ?>
        <script>
            alert('Periodo non inserito');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
}



if (isset($_POST['Modifica'])) {
    if (isset($_POST['checkbox-group'])) {
        $manutenzione = new Manutenzione($_POST['codice'], $_POST['descrizioneAttrezzatura'], $_POST['categoria'], $_POST['reparto'], $_POST['checkbox-group'], $_POST['identificativo2']);
        $manutenzione->modificaManutenzione();
    } else {
        ?>
        <script>
            alert('Periodo non inserito');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
}




if (isset($_POST['Elimina'])) {
    if (isset($_POST['checkbox-group'])) {
        $manutenzione = new Manutenzione($_POST['codice'], $_POST['descrizioneAttrezzatura'], $_POST['categoria'], $_POST['reparto'], $_POST['checkbox-group'], $_POST['identificativo2']);
        $manutenzione->eliminaManutenzione();
    } else {
        ?>
        <script>
            alert('Periodo non inserito');
        </script>
        <?php
    }
    $_SESSION['show'] = 0;
}





if (isset($_POST['Clear'])) {
    $_SESSION['show'] = 0;
}











?>

<!DOCTYPE html>
<html>

<head>
    <!--Da finire l'implementazione-->
    <script src=''></script>
    <title>Baxter Application</title>

    <link rel="stylesheet" href="css.css">




    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/js/uikit-icons.min.js"></script>
</head>

<body style="background-color: rgb(223,223,223);">
    <form method="post" id="myForm" name="ricerca" style="background-color: rgb(223,223,223);">
        <div class="uk-grid uk-grid-match">
            <!--INIZIO zona grigia centrale-->
            <div class="uk-width-4-5 uk-card uk-card-default"
                style="height:800px; background-color: rgb(255, 224,192);box-shadow: inset 0 4px 8px; overflow:auto">
                <table id="table">
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Descrizione Attrezzatura</th>
                            <th>Reparto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><input type="text" id="codice" name="codice"
                                    style="border: 2px solid white; box-shadow: 2px 2px 0px rgb(254, 191, 128);"></td>
                            <td align="center"><input type="text" id="descattrz" name="descrizioneAttrezzatura"
                                    style="border: 2px solid white; box-shadow: 2px 2px 0px rgb(254, 191, 128);"></td>
                            <td align="center"><input type="text" id="reparto" name="reparto"
                                    style="border: 2px solid white; box-shadow: 2px 2px 0px rgb(254, 191, 128);"></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>

                            <td colspan=2>
                                <!-- Tabella dei Giorni-->
                                <table class="uk-table uk-table-responsive">
                                    <tr>
                                        <td><input type="radio" name="checkbox-group" value="Giornaliero" id="checkbox">
                                            <font size="2">Giornaliero</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Settimanale" id="checkbox">
                                            <font size="2">Settimanale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Quindicinale"
                                                id="checkbox">
                                            <font size="2">Quindicinale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Mensile" id="checkbox">
                                            <font size="2">Mensile</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="4settimane" id="checkbox">
                                            <font size="2">4 settimane</font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="checkbox-group" value="Bimestrale" id="checkbox">
                                            <font size="2">Bimestrale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Trimestrale" id="checkbox">
                                            <font size="2">Trimestrale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Semestrale" id="checkbox">
                                            <font size="2">Semestrale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="9mesi" id="checkbox">
                                            <font size="2">9 mesi</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="4mesi" id="checkbox">
                                            <font size="2">4 mesi</font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="checkbox-group" value="Annuale" id="checkbox">
                                            <font size="2">Annuale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Quinquennale"
                                                id="checkbox">
                                            <font size="2">Quinquennale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Settennale" id="checkbox">
                                            <font size="2">Settennale</font>
                                        </td>
                                        <td><input type="radio" name="checkbox-group" value="Decennale" id="checkbox">
                                            <font size="2">Decennale</font>
                                        </td>
                                    </tr>



                                </table>
                                <!--FINE della tabella dei Giorni-->
                            </td>
                            <td>
                                <!--tabella che identifica Ultima manutenzione e prossima manutenzione-->
                                <table class="uk-table uk-table-responsive"
                                    style="background-color: rgb(254, 191, 128); box-shadow: inset 0 4px 8px;">
                                    <tr>
                                        <td>
                                            <font size="2">Ultima <br>Manutenzione</font>
                                        </td>
                                        <td><input type="text" id="ultimaManutenzione" name="ultimamanutenzione" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <font size="2">Prossima <br>manutenzione</font>
                                        </td>
                                        <td><input type="text" id="proxManutenzione" name="proxManutenzione" readonly></td>
                                    </tr>
                                </table>
                                <!--FINE tabella che identifica Ultima manutenzione e prossima manutenzione-->
                            </td>




                        </tr>
                        <tr>

                            <input type="hidden" name="identificativo" id="identificativo" value="
                            <?php
                            if (isset($_POST['Aggiungi'])) {
                                $valore = estraiIdentificativo();
                                if ($valore == 0) {
                                } elseif ($valore !== 0) {
                                    echo $info = $valore + 1;

                                } else {
                                }
                            }

                            ?>
                            ">



                            <input type="hidden" name="identificativo2" id="identificativo2" value="">


                            <td colspan=2><button value="Aggiungi" type="submit" name="Aggiungi"
                                    style="background-color: rgb(223,223,223)">
                                    <span
                                        style="display: flex;flex-direction: column;align-items: center; background-color: rgb(223,223,223)">
                                        <img src=".\image\Aggiungi.png" alt="Aggiungi">
                                        Aggiungi
                                    </span>
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button value="Modifica" style="background-color: rgb(223,223,223)" type="submit"
                                    name="Modifica">
                                    <span
                                        style="display: flex;flex-direction: column;align-items: center; background-color: rgb(223,223,223)">
                                        <img src=".\image\Modifica.png" alt="Modifica">
                                        Modifica
                                    </span>
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button value="Elimina" style="background-color: rgb(223,223,223)" type="submit"
                                    name="Elimina">
                                    <span
                                        style="display: flex;flex-direction: column;align-items: center; background-color: rgb(223,223,223)">
                                        <img src=".\image\Elimina.png" alt="Elimina">
                                        Elimina
                                    </span>
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button value="Clear" style="background-color: rgb(223,223,223)" type="submit"
                                    name="Clear"> <!-- chiedere a cosa servirà -->
                                    <span
                                        style="display: flex;flex-direction: column;align-items: center; background-color: rgb(223,223,223)">
                                        <img src=".\image\Clear.png" alt="Clear">
                                        Clear
                                    </span>
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>
                            <td>
                                <div class="table-header">Categoria</div>
                                <select name="categoria" id="idMenuSelect">
                                    <option value="L.B.Produzione">L.B.Produzione</option>
                                    <option value="L.B.Manutenzione">L.B.Manutenzione</option>
                                    <option value="SoloPianoManutenzione">SoloPianoManutenzione</option>
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                                <?php


                                if ($_SESSION['show'] == 1) {
                                    $_SESSION['show'] = 0;
                                    ?>
                                    <input type="checkbox" id="myCheckbox" name="myCheckbox" checked>
                                    <!--scadenza manutenzione-->
                                    <input type="submit" value="Submit" id="submitButton" style="display:none;"
                                        name="submitButton">
                                    <?php


                                } else {
                                    $_SESSION['show'] = 1;

                                    ?>
                                    <input type="checkbox" id="cambiami" name="cambiami">
                                    <!--scadenza manutenzione-->
                                    <input type="submit" value="Submit" style="display:none;" id="subitCambiami"
                                        name="subitCambiami">
                                    <?php

                                }
                                ?>





                                <font size="2">Visualizza solo manutenzioni in scadenza o scadute</font>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <table class="table-ext">
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <div class="divinterno">
                                                <table class="table-int" id="scorribile">
                                                    <thead>
                                                        <tr>
                                                            <th id="change">Sigla</th>
                                                            <th id="change">Nome</th>
                                                            <th id="change">Cat.</th>
                                                            <th id="change">Reparto</th>
                                                            <th id="change">Manutenzione</th>
                                                            <th id="change">Ultima Man.</th>
                                                            <th id="change">Prox Man.</th>
                                                        </tr>
                                                    </thead>
                                                    <?php

                                                    if ($_SESSION['show'] == 1) {
                                                        //echo "sono dentro";
                                                    
                                                        estraiManutenzione();



                                                    } else {
                                                        estraiManutenzioneScadute();
                                                    }




                                                    ?>
                                                </table><!--Table-int-->
                                            </div>
                                        </td><!--/colspan tabella ext-->
                                    </tr>
                                </tbody>
                            </table><!--/table-ext-->
                        </tr>

                        <tr>

                        </tr>
                    </tbody>

                </table>
            </div>
            <!--FINE zona grigia centrale-->


            <!--INIZIO zona rossa laterale-->
            <div class="uk-width-1-5 uk-card uk-card-default"
                style="background-color: rgb(223,223,223); box-shadow: inset 0 4px 8px; height: 800px;">
                <table>
                    <tr>
                        <td style="background-color: rgb(223,223,223);box-shadow: inset 0 2px 3px;">
                            <label>
                                <font size="3px">Password</font>
                            </label>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <input type="password" placeholder="Inserisci password" name="Password">
                                <img src=".\image\faccina.png" alt="Immagine" class="image"
                                    style="width:25%;margin: 0 auto;">
                            </span>
                        </td>
                    </tr>
                    <tr>

                    </tr>

                    <tr>
                        <td style="background-color: rgb(255,193,194);box-shadow: inset 0 2px 3px;">
                            <br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit" name="tutteLeMacchine"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\TutteLeMacchine.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>

                            </span>
                            <br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit" name="storicoMacchina"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\StoricoMacchina.png" alt="Immagine" class="image"
                                        style="margin: 0;width:80%">
                                </button>
                            </span>
                            <br>
                        </td>
                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <td style="background-color: rgb(255,193,194);box-shadow: inset 0 2px 3px;">
                            <br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit" name="macchineEffettuateInData"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\MacchineEffettuateInData.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>
                            </span>
                            <br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit" name="macchineInProgrammaPerData"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\MacchineInProgrammaPerData.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>
                                <br>
                                <input type="text" name="dataPerPulsantiMacchine" id="date"
                                    style="width:80%; height:120%">
                            </span>
                            <br>
                        </td>
                    </tr>
                </table>
            </div>
            <!--FINE Zona rossa laterale-->




            <!--INIZIO Zona Gialla in fondo-->
            <div class="uk-width-4-5 uk-card uk-card-default"
                style="height:450px; background-color: rgb(255, 255,191);box-shadow: inset 0 4px 8px;">
                <div class="container">
                    <h1>
                        <font size="4px"><strong>&nbsp;&nbsp;<i id="informazione"></i></strong>
                        </font>
                    </h1>
                    <table>
                        <tr>
                            <td><label for="input1">Data</label></td>
                            <td><label for="input2">Esito</label></td>
                            <td><label for="input3">Note</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="data" id="yourInputFieldId" style="height:20px;"></td>
                            <td><input type="text" name="esito" id="input2" style="height:20px;"></td>
                            <td><input type="text" name="note" id="input3" style="width:300px;height:20px;"></td>
                            <input type="hidden" name="identificativoPerStorico" id="identificativoPerStorico">
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="okStorico" value="okStorico"
                                    style="background-color: rgb(255, 255,191); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    &nbsp;&nbsp;<img src=".\image\OK.png" alt="Image 1" style="width: 100px;"><br><br>
                                </button>

                                <button type="submit" name="eliminaStorico"
                                    style="background-color: rgb(255, 255,191); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    &nbsp;&nbsp;<img src=".\image\ELIMINA2.png" alt="Image 1" style="width: 100px;">
                                </button>
                                <input type="text" name="idElimaStorico" id="idElimaStorico" style="display:none">
                                <input type="text" name="idDataStorico" id="idDataStorico" style="display:none">
                                <input type="text" name="idEsitoStorico" id="idEsitoStorico" style="display:none">
                                <input type="text" name="idNoteStorico" id="idNoteStorico" style="display:none">
                            </td>
                            <td colspan="4" style="padding-top: 10px;">
                                <table class="table-ext">
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <div class="divinterno">

                                                    <table id="daPopolare" class="daPopolare table-int">
                                                        <thead>
                                                            <tr>
                                                                <th id="change" style="width:50%;">Data</th>
                                                                <th id="change" style="width:50%;">Esito</th>
                                                                <th id="change" style="width:50%;">Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="cancella">

                                                        </tbody>

                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                        </tr>
                    </table>

                    </tr>

                    <tr>

                    </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <!--Fine zona gialla in fondo-->


            <!--INIZIO zona ARANCIONE laterale-->
            <div class="uk-width-1-5 uk-card uk-card-default"
                style="background-color: rgb(223,223,223); box-shadow: inset 0 4px 8px;height:450px;display: flex; justify-content: center; align-items: center;">
                <table style="background-color: rgb(255,223,193);">
                    <tr>

                        <td><br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit" name="riepilogoMensile"
                                    style="background-color: rgb(255,223,193); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\RiepilogoMensile.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>
                            </span>
                            <br>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <select name="periodo" id="mySelect">
                                    <option value="01">Gennaio</option>
                                    <option value="02">Febbraio</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Aprile</option>
                                    <option value="05">Maggio</option>
                                    <option value="06">Giugno</option>
                                    <option value="07">Luglio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Settembre</option>
                                    <option value="10">Ottobre</option>
                                    <option value="11">Novembre</option>
                                    <option value="12">Dicembre</option>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <script>
                        const selectElement = document.getElementById('mySelect'); // Sostituisci 'mySelect' con l'ID del tuo elemento select
                        const currentYear = new Date().getFullYear(); // Ottiene l'anno corrente

                        for (let option of selectElement.options) {
                            const optionText = option.textContent; // Ottiene il testo dell'opzione
                            const newOptionText = optionText + ' - ' + currentYear; // Aggiunge l'anno corrente al testo dell'opzione
                            option.textContent = newOptionText; // Aggiorna il testo dell'opzione
                        }
                    </script>
                    <tr>
                        <td>







                            <?php
                            $data = date('d-m-Y');

                            $meseInput = date('m', strtotime($data)); // Esempio di utilizzo di date() e strtotime()
                            


                            


                            $my_conn = new PDO('sqlite:manutentori.db');
                            $secondquery = $my_conn->prepare("SELECT * FROM 'storici'");
                            $secondquery->execute();
                            $data = array(
                            );
                            $countManutenzioni = 0;
                            foreach ($secondquery as $row) {

                                $dataMese = $row['data'];

                                $stessoMese = stessoMese($dataMese, $meseInput);
                                if ($stessoMese == "ok") {


                                    $identificativo = $row['manutenzione'];
                                    $my_conn = new PDO('sqlite:manutentori.db');
                                    $firstquery = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE identificativo='{$identificativo}'");
                                    $firstquery->execute();

                                    foreach ($firstquery as $raw) {
                                        $info = array($raw['Sigla'], $raw['Nome'], $raw['Cat'], $raw['Reparto'], $raw['Manutenzione'], $dataMese);
                                        array_push($data, $info);
                                        $countManutenzioni++;
                                    }
                                } else {

                                }

                            }


                            ?>

                            <!--<input type="text" id="date">  SE METTO ID =DATE MI STAMPA LA DATA DI OGGI IN AUTOMATICO-->
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <input type="text" style="" id="manutTOTEST" value="<?php echo $countManutenzioni; ?> Manutenzioni"
                                    readonly><!--CHIEDERE A COSA SERVE PERCHE' HO UN PO' DI DUBBI-->
                            </span>
                            <br>
                        </td>
                    </tr>
                </table>
                <button type="submit" onclick="window.close()"
                    style="background-color: rgb(223,223,223); border: 0; padding: 0; display: inline-block;"><img
                        src=".\image\Chiudi.png"></button>
            </div>

            <!--FINE Zona ARANCIONE laterale-->




        </div>










        <script src="js.js"></script>

    </form>
</body>



</html>