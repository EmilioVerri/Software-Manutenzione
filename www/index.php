<?php



include ('./classi/ClasseManutenzioni.php');
include ('./classi/funzioneEstrazione.php');



?>


<!DOCTYPE html>
<html>

<head>
    <title>Baxter Application</title>

    <link rel="stylesheet" href="css.css">




    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.9/dist/js/uikit-icons.min.js"></script>
</head>

<body>
    <div class="uk-grid uk-grid-match">
        <div class="uk-width-4-5 uk-card uk-card-default"
            style="height:700px; background-color: rgb(255, 224,192);box-shadow: inset 0 4px 8px;">
            <table>
                <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Descrizione Attrezzatura</th>
                        <th>Reparto</th>
                    </tr>
                </thead>
                <form method="post">
                    <tbody>
                        <tr>
                            <td align="center"><input type="text" id="input1" name="codice"
                                    style="border: 2px solid white; box-shadow: 2px 2px 0px rgb(254, 191, 128);"></td>
                            <td align="center"><input type="text" id="input1" name="descrizioneAttrezzatura"
                                    style="border: 2px solid white; box-shadow: 2px 2px 0px rgb(254, 191, 128);"></td>
                            <td align="center"><input type="text" id="input1" name="reparto"
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
                                        <td><input type="text" name="ultimamanutenzione"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <font size="2">Prossima <br>manutenzione</font>
                                        </td>
                                        <td><input type="text" name="ultimamanutenzione"></td>
                                    </tr>
                                </table>
                                <!--FINE tabella che identifica Ultima manutenzione e prossima manutenzione-->
                            </td>




                        </tr>
                        <tr>
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
                                    name="Clear">
                                    <span
                                        style="display: flex;flex-direction: column;align-items: center; background-color: rgb(223,223,223)">
                                        <img src=".\image\Clear.png" alt="Clear">
                                        Clear
                                    </span>
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>
                            <td>
                                <div class="table-header">Categoria</div>
                                <select name="categoria">
                                    <option value="L.B. Produzione">L.B. Produzione</option>
                                    <option value="L.B. Manutenzione">L.B. Manutenzione</option>
                                    <option value="Solo Piano Manutenzione">Solo Piano Manutenzione</option>
                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" value="scadenzaManutenzioni">
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
                                                    <thead >
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
                                                    if(isset($_POST['Aggiungi'])){
                                                        estraiManutenzione();
                                                    }else{
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
                </form>
            </table>
        </div>



        <div class="uk-width-1-5 uk-card uk-card-default" style="height:700px;">
            Large
        </div>
    </div>

    <script src="js.js"></script>
</body>

</html>





<?php

if (isset($_POST['Aggiungi'])) {
    if (isset($_POST['checkbox-group'])) {
        $manutenzione = new Manutenzione($_POST['codice'], $_POST['descrizioneAttrezzatura'], $_POST['categoria'], $_POST['reparto'], $_POST['checkbox-group']);
        $prova = $manutenzione->aggiungiManutenzione();
    } else {
        ?>
        <script>
            alert('Periodo non inserito');
        </script>
        <?php
    }
}


?>