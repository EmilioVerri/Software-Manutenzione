<?php

include ("funzioniGiorni.php");



class Manutenzione
{

    public $sigla;

    public $nome;

    public $cat;

    public $reparto;

    public $manutenzione;

    public $identificativo;



    public function __construct($sigla, $nome, $cat, $reparto, $manutenzione, $identificativo)
    {
        $this->sigla = $sigla;
        $this->nome = $nome;
        $this->cat = $cat;
        $this->reparto = $reparto;
        $this->manutenzione = $manutenzione;
        $this->identificativo = $identificativo;
    }






    //da implementare controllo sulla sigla, quella deve essere univoca
    public function aggiungiManutenzione()
    {
        if (isset($_POST['Aggiungi'])) {
            $today = strtotime('today');
            $UltimaMan = date('d/m/Y', $today);
            $prossimaMan = estraigiorni($this->manutenzione);
            $indentificativoIntero = (int) $this->identificativo;
            $InScadenz=0;
            $my_conn = new PDO('sqlite:manutentori.db');
            $query = $my_conn->prepare("INSERT INTO 'manutenzioni' ('Sigla','Nome','Cat','Reparto','Manutenzione','UltimaMan','ProxMan','identificativo','InScadenza') 
           VALUES ('{$this->sigla}','{$this->nome}','{$this->cat}','{$this->reparto}','{$this->manutenzione}','{$UltimaMan}','{$prossimaMan}','{$indentificativoIntero}','{$InScadenz}')");
            $query->execute();
        }
    }





    //da modificare le date della manutenzione
    public function modificaManutenzione()
    {
        if (isset($_POST["Modifica"])) {
            $today = strtotime('today');
            $UltimaMan = date('d/m/Y', $today);
            $prossimaMan = estraigiorni($this->manutenzione);
            $indentificativoIntero = (int) $this->identificativo;
            $my_conn = new PDO('sqlite:manutentori.db');
            $query = $my_conn->prepare("UPDATE manutenzioni SET Sigla='{$this->sigla}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
            $query = $my_conn->prepare("UPDATE manutenzioni SET Nome='{$this->nome}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
            $query = $my_conn->prepare("UPDATE manutenzioni SET Cat='{$this->cat}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
            $query = $my_conn->prepare("UPDATE manutenzioni SET Reparto='{$this->reparto}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
            $query = $my_conn->prepare("UPDATE manutenzioni SET Manutenzione='{$this->manutenzione}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
            $query = $my_conn->prepare("UPDATE manutenzioni SET UltimaMan='{$UltimaMan}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
            $query = $my_conn->prepare("UPDATE manutenzioni SET ProxMan='{$prossimaMan}' WHERE identificativo='{$this->identificativo}'");
            $query->execute();
        }
    }


}

?>