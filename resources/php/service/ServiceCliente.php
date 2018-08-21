<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/npj/php/dao/DAOCliente.php');
class ServiceCliente {
    
    private $dao;
    
    public function __construct(){
        $this->dao = new DAOCliente();
    }
    
    function inserir ($cliente){
        $this->dao->inserir($cliente);
    }
    
    function atualizar($cliente){
        $this->dao->atualizar($cliente);
    }
    
    function deletar($cliente){
        $this->dao->deletar($cliente);
    }
    
    function findAll(){
        return $this->dao->findAll();
    }
        
    function findById($id){
        return $this->dao->findById($id);
    }

}
