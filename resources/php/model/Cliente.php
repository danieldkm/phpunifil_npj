<?php

class Cliente {
    
    const nmTabela = "NPJ_CLIENTES";
    private $ID_CLIENTE;
    private $NM_CLIENTE;
    private $NM_CONTATO;
    private $NR_DOCUMENTO_1;
    private $NR_DOCUMENTO_2;
    private $TP_PESSOA;
    private $NM_LOGRADOURO;
    private $NR_LOGRADOURO;
    private $NM_BAIRRO;
    private $NR_FONE;
    private $NR_CELULAR;
    private $NR_FAX;
    private $DS_EMAIL;
    private $DS_COMPLEMENTO;
    
    
    function getQueryInsert(){
        return "INSERT INTO ".self::nmTabela."(NM_CLIENTE ,NM_CONTATO, NR_DOCUMENTO_1, NR_DOCUMENTO_2, TP_PESSOA, NM_LOGRADOURO, NR_LOGRADOURO, NM_BAIRRO, NR_FONE, NR_CELULAR, NR_FAX, DS_EMAIL, DS_COMPLEMENTO ) values ('"
            .$this->NM_CLIENTE."', '"
            .$this->NM_CONTATO."', '"
            .$this->NR_DOCUMENTO_1."', '"
            .$this->NR_DOCUMENTO_2."', '"
            .$this->TP_PESSOA."', '"
            .$this->NM_LOGRADOURO."', '"
            .$this->NR_LOGRADOURO."', '"
            .$this->NM_BAIRRO."', '"
            .$this->NR_FONE."', '"
            .$this->NR_CELULAR."', '"
            .$this->NR_FAX."', '"
            .$this->DS_EMAIL."', '"
            .$this->DS_COMPLEMENTO."')";
    }
    
    function getQueryUpdate(){
        return "UPDATE ".self::nmTabela
            ." SET NM_CLIENTE = '".$this->NM_CLIENTE."', ".
            "NM_CONTATO = '".$this->NM_CONTATO."', ".
            "NR_DOCUMENTO_1 = '".$this->NR_DOCUMENTO_1."', ".
            "NR_DOCUMENTO_2 = '".$this->NR_DOCUMENTO_2."', ".
            "TP_PESSOA = '".$this->TP_PESSOA."', ".
            "NM_LOGRADOURO = '".$this->NM_LOGRADOURO."', ".
            "NR_LOGRADOURO = '".$this->NR_LOGRADOURO."', ".
            "NM_BAIRRO = '".$this->NM_BAIRRO."', ".
            "NR_FONE = '".$this->NR_FONE."', ".
            "NR_CELULAR = '".$this->NR_CELULAR."', ".
            "NR_FAX = '".$this->NR_FAX."', ".
            "DS_EMAIL = '".$this->DS_EMAIL."', ".
            "DS_COMPLEMENTO = '".$this->DS_COMPLEMENTO."' WHERE ID_CLIENTE = ".$this->ID_CLIENTE;
    }
    
    function getQueryDelete(){
        return "DELETE FROM ".self::nmTabela." WHERE ID_CLIENTE = ".$this->getIdCliente();
    }
    
    
    function getIdCliente(){
        return $this->ID_CLIENTE;
    }
    
    function setIdCliente($idCliente){
        $this->ID_CLIENTE = $idCliente;
    }
    
    function getNmCliente(){
        return $this->NM_CLIENTE;
    }
    
    function setNmCliente($nmCliente){
        $this->NM_CLIENTE = $nmCliente;
    }
    
    function getNmContato(){
        return $this->NM_CONTATO;
    }
    
    function setNmContato($nmContato){
        $this->NM_CONTATO = $nmContato;
    }
    
    function getNrDocumento1(){
        return $this->NR_DOCUMENTO_1;
    }
    
    function setNrDocumento1($nrDocumento1){
        $this->NR_DOCUMENTO_1 = $nrDocumento1;
    }
    
    function getNrDocumento2(){
        return $this->NR_DOCUMENTO_2;
    }
    
    function setNrDocumento2($nrDocumento2){
        $this->NR_DOCUMENTO_2 = $nrDocumento2;
    }
    
    function getTpPessoa(){
        return $this->TP_PESSOA;
    }
    
    function setTpPessoa($tpPessoa){
        $this->TP_PESSOA = $tpPessoa;
    }
    
    function getNmlogradouro(){
        return $this->NM_LOGRADOURO;
    }
    
    function setNmlogradouro($nmlogradouro){
        $this->NM_LOGRADOURO = $nmlogradouro;
    }
    
    function getNrlogradouro(){
        return $this->NR_LOGRADOURO;
    }
    
    function setNrlogradouro($nrlogradouro){
        $this->NR_LOGRADOURO = $nrlogradouro;
    }
    
    function getNmBairro(){
        return $this->NM_BAIRRO;
    }
    
    function setNmBairro($nmBairro){
        $this->NM_BAIRRO = $nmBairro;
    }
    
    function getNrfone(){
        return $this->NR_FONE;
    }
    
    function setNrfone($nrfone){
        $this->NR_FONE = $nrfone;
    }
    
    function getNrCelular(){
        return $this->NR_CELULAR;
    }
    
    function setNrCelular($nrCelular){
        $this->NR_CELULAR = $nrCelular;
    }
    
    function getNrfax(){
        return $this->NR_FAX;
    }
    
    function setNrfax($nrfax){
        $this->NR_FAX = $nrfax;
    }
    
    function getDsEmail(){
        return $this->DS_EMAIL;
    }
    
    function setDsEmail($dsEmail){
        $this->DS_EMAIL = $dsEmail;
    }
    
    function getDsComplemento(){
        return $this->DS_COMPLEMENTO;
    }
    
    function setDsComplemento($dsComplemento){
        $this->DS_COMPLEMENTO = $dsComplemento;
    }
    
    function toString(){
        return 'ID_CLIENTE '. $this->ID_CLIENTE
                .'NM_CLIENTE '. $this->NM_CLIENTE
                .'NM_CONTATO '. $this->NM_CONTATO
                .'NR_DOCUMENTO_1 '. $this->NR_DOCUMENTO_1
                .'NR_DOCUMENTO_2 '. $this->NR_DOCUMENTO_2
                .'TP_PESSOA '. $this->TP_PESSOA
                .'NM_LOGRADOURO '. $this->NM_LOGRADOURO
                .'NR_LOGRADOURO '. $this->NR_LOGRADOURO
                .'NM_BAIRRO '. $this->NM_BAIRRO
                .'NR_FONE '. $this->NR_FONE
                .'NR_CELULAR '. $this->NR_CELULAR
                .'NR_FAX '. $this->NR_FAX
                .'DS_EMAIL '. $this->DS_EMAIL
                .'DS_COMPLEMENTO '. $this->DS_COMPLEMENTO;

    }

}
