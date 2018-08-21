<?php

require_once('GenericDAO.php');
require_once('iCLUD.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/npj/php/model/Cliente.php');
class DAOCliente extends GenericDAO implements iCLUD {//extends GenericDAO {
    
    private $conexao;
    
    function inserir ($cliente){
       parent::doQuery($cliente->getQueryInsert());
//        $mysqli = Conexao::getConexao();
//        $query = $mysqli->query($cliente->getQueryInsert());
//        echo 'Registros afetados: ' . $query->affected_rows;
//        mysqli_query($conexao, $cliente.getQueryInsert());
//        echo $cliente->getQueryInsert();
//        mysql_close($conexao);
    }
    
    function atualizar($cliente){
       parent::doQuery($cliente->getQueryUpdate());
//        $mysqli = Conexao::getConexao();
//        $query = $mysqli->query($cliente->getQueryUpdate());
//        echo 'Registros afetados: ' . $query->affected_rows;
//        mysql_close($conexao);
    }
    
    function deletar($cliente){
        parent::doQuery($cliente->getQueryDelete());
//        $conexao = Conexao::getConexao();
//        mysql_query($conexao, $cliente.getQueryDelete());
//        mysql_close($conexao);        
    }
    
    function findAll(){
        $mysqli = Conexao::getConexao();
        $query = "SELECT * FROM NPJ_CLIENTES";
        $clientes = new ArrayObject();
        if ($result = $mysqli->query($query)) {

            /* fetch object array */
            while ($obj = $result->fetch_object("Cliente")) {
                $clientes->append($obj);
            }

            /* free result set */
            $result->close();
        }

        /* close connection */
        $mysqli->close();
        return $clientes;
    }
    
    function findById($id){
        $mysqli = Conexao::getConexao();
        $query = "SELECT * FROM NPJ_CLIENTES WHERE ID_CLIENTE = ".$id;
        if ($result = $mysqli->query($query)) {
            
            while ($obj = $result->fetch_object("Cliente")){
                $cliente = $obj;
            }

            $result->close();
        }
        /* close connection */
        $mysqli->close();
        return $cliente;
    }

}