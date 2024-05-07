<?php

include("funzioniGiorni.php");



class Manutenzione{
    
public $sigla;

public $nome;

public $cat;

public $reparto;

public $manutenzione;



public function __construct($sigla,$nome,$cat,$reparto,$manutenzione){
    $this->sigla=$sigla;
    $this->nome=$nome;
    $this->cat=$cat;
    $this->reparto=$reparto;
    $this->manutenzione=$manutenzione;
}







public function aggiungiManutenzione(){
    if (isset($_POST['Aggiungi'])){
        $today = strtotime('today');
        $UltimaMan = date('d/m/Y', $today);
        $prossimaMan=estraigiorni($this->manutenzione);
        $my_conn = new PDO('sqlite:manutentori.db');
       $query = $my_conn->prepare("INSERT INTO 'manutenzioni' ('Sigla','Nome','Cat','Reparto','Manutenzione','UltimaMan','ProxMan') 
       VALUES ('{$this->sigla}','{$this->nome}','{$this->cat}','{$this->reparto}','{$this->manutenzione}','{$UltimaMan}','{$prossimaMan}')");
      $query->execute();
    }
}




}

?>