<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/model/Cliente.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/service/ServiceCliente.php");


function uniquePost($posted) {
    $descricao = $posted['razaoSocial'].$posted['iEstadual'].$posted['cnpj'].$posted['nmLogradouro'].$posted['nrLogradouro'].$posted['bairro'].$posted['fone'].$posted['cel'].$posted['fax'].$posted['email'].$posted['complemento'].$posted['contato']; //cliente salvo
    if (isset($_SESSION['form_hash']) && $_SESSION['form_hash'] == md5($descricao) ) { //se form_hash não for vazio e for igual ao md5 então retorna false pq o cliente ja foi adicionado
            $mostrarAlerta = false;
            return false;
    }
    $_SESSION['form_hash'] = md5($descricao);
//    $form_hash = md5($descricao);
    return true;
}



if (uniquePost($_POST)) {
    $cliente = new Cliente();
    if (isset($_POST["razaoSocial"])){$cliente->setNmCliente($_POST["razaoSocial"]);}
    if (isset($_POST["iEstadual"])){$cliente->setNrDocumento1($_POST["iEstadual"]);}
    if (isset($_POST["cnpj"])){$cliente->setNrDocumento2($_POST["cnpj"]);}
    if (isset($_POST["nmLogradouro"])){$cliente->setNmLogradouro($_POST["nmLogradouro"]);}
    if (isset($_POST["nrLogradouro"])){$cliente->setNrLogradouro($_POST["nrLogradouro"]);}
    if (isset($_POST["bairro"])){$cliente->setNmBairro($_POST["bairro"]);}
    if (isset($_POST["fone"])){$cliente->setNrFone($_POST["fone"]);}
    if (isset($_POST["cel"])){$cliente->setNrCelular($_POST["cel"]);}
    if (isset($_POST["fax"])){$cliente->setNrFax($_POST["fax"]);}
    if (isset($_POST["email"])){$cliente->setDsEmail($_POST["email"]);}
    if (isset($_POST["complemento"])){$cliente->setDsComplemento($_POST["complemento"]);}
    if (isset($_POST["contato"])){$cliente->setDsComplemento($_POST["contato"]);}
    $cliente->setTpPessoa("j");
    $mostrarAlerta = true;
}

?>

