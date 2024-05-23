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
        if (isset($_POST['okStorico'])) {

            $manutConv=(int)$this->manutenzione;
            $dataConv=(string)$this->data;
            $my_conn = new PDO('sqlite:manutentori.db');

            $query = $my_conn->prepare("INSERT INTO 'storici' ('data','esito','note','manutenzione') VALUES ('{$dataConv}','{$this->esito}','{$this->note}','{$manutConv}')");
            $query->execute();



            
        }
    }




}