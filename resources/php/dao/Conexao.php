<?php

class Conexao {
        
    const url = "172.30.1.2";
    const usuario = "root";
    const senha = "UniBBC1204";
    const dataBase = "dbifl";
    
    
    public static function getConexao() {
        try{
            $conexao = new mysqli(self::url, self::usuario, self::senha, self::dataBase);
        /* check connection */
            if (mysqli_connect_errno()) {
//                printf("Connect failed: %s\n", mysqli_connect_error());
                trigger_error(mysqli_connect_error());;
                exit();
            }
            return $conexao;
        } catch (Exception $ex) {
            null;
        }
    }
    
}