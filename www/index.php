<?php
include ('./classi/ClasseManutenzioni.php');
include ('./classi/funzioneEstrazione.php');





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

<body>
    <form method="post" id="myForm" name="ricerca">
        <div class="uk-grid uk-grid-match">
            <!--INIZIO zona grigia centrale-->
            <div class="uk-width-4-5 uk-card uk-card-default"
                style="height:700px; background-color: rgb(255, 224,192);box-shadow: inset 0 4px 8px;">
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
                                        <td><input type="text" id="ultimaManutenzione" name="ultimamanutenzione"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <font size="2">Prossima <br>manutenzione</font>
                                        </td>
                                        <td><input type="text" id="proxManutenzione" name="proxManutenzione"></td>
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
                                if (isset($_POST['submitButton'])) {
                                    estraiScadenzaNonScadenzaPrecedente();
                                }





                                //checkbox se ci sono scadenze o meno
                                $verifica = estraiScadenzaManutenzioniCheckbox();
                                if ($verifica == "ok") {
                                    ?>
                                    <input type="checkbox" id="myCheckbox" name="myCheckbox"> <!--scadenza manutenzione-->
                                    <input type="submit" value="Submit" id="submitButton" style="display:none;"
                                        name="submitButton">
                                    <?php
                                } else {
                                    ?>
                                    <input type="checkbox" id="cambiami" name="cambiami" checked>
                                    <!--scadenza manutenzione-->
                                    <input type="submit" value="Submit" style="display:none;" id="subitCambiami"
                                        name="subitCambiami">
                                    <?php
                                }
                                //fine checkbox se ci sono scadenze o meno
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
                                                    if (isset($_POST['submitButton'])) {
                                                        estraiScadenzaNonScadenza();
                                                    } elseif (isset($_POST['subitCambiami'])) {
                                                        estraiManutenzione();
                                                    } else {
                                                        estraiManutenzione();
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
            style="background-color: rgb(223,223,223); box-shadow: inset 0 4px 8px; overflow: auto; height: 700px;">
                <table>
                    <tr>
                        <td style="background-color: rgb(223,223,223);box-shadow: inset 0 2px 3px;">
                            <label>
                                <font size="3px">Password</font>
                            </label>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <input type="text" placeholder="Inserisci password">
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
                                <button type="submit"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\TutteLeMacchine.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>

                            </span>
                            <br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit"
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
                                <button type="submit"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\MacchineEffettuateInData.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>
                            </span>
                            <br>
                            <span style="display: flex;flex-direction: column;align-items: center;">
                                <button type="submit"
                                    style="background-color: rgb(255,193,194); border: none; padding: 0; display: inline-block; width:70%;height:70%">
                                    <img src=".\image\MacchineInProgrammaPerData.png" alt="Immagine" class="image"
                                        style="margin: 0; width:80%">
                                </button>
                                <br>
                                <input type="text" name="daConfigurare" style="width:80%; height:120%">
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
                            <td><input type="text" id="yourInputFieldId" style="height:20px;"></td>
                            <td><input type="text" id="input2" style="height:20px;"></td>
                            <td><input type="text" id="input3" style="width:300px;height:20px;"></td>
                        </tr>

                        <tr>
                            <td>
                            &nbsp;&nbsp;<img src=".\image\OK.png" alt="Image 1" style="width: 100px;"><br><br>


                            &nbsp;&nbsp;<img src=".\image\ELIMINA2.png" alt="Image 1" style="width: 100px;">
                            </td>
                            <td colspan="4" style="padding-top: 10px;">
                                <table class="table-ext">
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <div class="divinterno">
                                                    <table class="table-int" id="scorribile">
                                                        <thead>
                                                            <tr>
                                                                <th id="change">Data</th>
                                                                <th id="change">Esito</th>
                                                                <th id="change">Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
                                                        <tr>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                            <td id='stile'>prova</td>
                                                        </tr>
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
                style="background-color: rgb(255,223,193); box-shadow: inset 0 4px 8px;height:450px;display: flex; justify-content: center; align-items: center;">
                <table>
                    <tr>
                        <td><img src=".\image\RiepilogoMensile.png"></td>
                    </tr>
                    <tr>
                        <td>
                            <select>
                                <option>cioa</option>
                                <option>ciaone</option>
                                <option>cioetto</option>
                                <option>weila</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" id="date"></td>
                    </tr>

                    

                        <td>
                        <br>
                    <br><img src=".\image\Chiudi.png"></td>
                    
                </table>
            </div>
            <!--FINE Zona ARANCIONE laterale-->




        </div>

        <script src="js.js"></script>
    </form>
</body>


</html>