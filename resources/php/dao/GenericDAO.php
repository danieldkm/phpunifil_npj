<?php

require_once('Conexao.php');
class GenericDAO {
    
    private $mysqli;
    
    public function doQuery($query){
        if (is_null($this->mysqli)){
            $this->mysqli = Conexao::getConexao();
        }
        $result = $this->mysqli->query($query);
//        echo 'Registros afetados: ' . $result->affected_rows;
    }
}
