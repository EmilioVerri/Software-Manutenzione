<?php


class Storico
{

    public $data;

    public $esito;

    public $note;

    public $manutenzione;



    public function __construct($data, $esito, $note, $manutenzione)
    {
        $this->data = $data;
        $this->esito = $esito;
        $this->note = $note;
        $this->manutenzione = $manutenzione;
    }


    public function aggiungiStorico()
    {
      /*  if (isset($_POST['okStorico'])) {  //rimossa perchè faceva crashare sqlite

            $manutConv = (int) $this->manutenzione;
            $dataConv = (string) $this->data;
            $my_conn = new PDO('sqlite:manutentori.db');


          //tolgo la query e la metto prima perchè crasha sqlite
           // $queryInfo = $my_conn->prepare("INSERT INTO 'storici' ('id','data','esito','note','manutenzione') VALUES ('{$dataConv}','{$esito}','{$note}','{$manutConv}')");
           // $queryInfo->execute();


            //se dico al programma che la manutenzione è stata fatta in quella data, rimando la manutenzione della data che mi ha dato
            //quindi devo fare una query che va a rimandare la data, faccio una query su manutenzioni, prima recupero i dati della manutenzione e poi successivamente 
            //aggiorno i dati della stessa
            $my_conn = new PDO('sqlite:manutentori.db');

            $secondquery = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE identificativo='{$manutConv}'");
            $secondquery->execute();

            foreach ($secondquery as $row) {

                $ProxMan = $row['ProxMan'];
                $GiorniManutenzione = $row['Manutenzione'];

                $value = prossimaManutenzione($ProxMan, $GiorniManutenzione);






                $query = $my_conn->prepare("UPDATE manutenzioni SET UltimaMan='{$dataConv}' WHERE identificativo='{$manutConv}'");
                $query->execute();


                $query = $my_conn->prepare("UPDATE 'manutenzioni' SET ProxMan='{$value}' WHERE identificativo='{$manutConv}'");
                $query->execute();


            }
        }*/
    }

    public function eliminaStorico(){
        $my_conn = new PDO('sqlite:manutentori.db');
        $query = $my_conn->prepare("DELETE FROM storici WHERE id={$this->manutenzione}");
        $query->execute();
    }




}