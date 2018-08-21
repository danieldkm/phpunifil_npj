<?php

//require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/model/Cliente.php");
//require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/service/ServiceCliente.php");
$formulario = "";
if (isset($_POST["formulario"])){
    $formulario = $_POST["formulario"];
}

function uniquePost($posted, $formulario) {
    $descricao = "";
    if ($formulario === "pFisica"){
        $descricao = $posted['nome'].$posted['rg'].$posted['cpf'].$posted['nmLogradouro'].$posted['nrLogradouro'].$posted['bairro'].$posted['fone'].$posted['cel'].$posted['fax'].$posted['email'].$posted['complemento'];
    }else if ($formulario === "pJuridica"){
        $descricao = $posted['razaoSocial'].$posted['iEstadual'].$posted['cnpj'].$posted['nmLogradouro'].$posted['nrLogradouro'].$posted['bairro'].$posted['fone'].$posted['cel'].$posted['fax'].$posted['email'].$posted['complemento'].$posted['contato'];
    }
    
    if (isset($_SESSION['form_hash']) && $_SESSION['form_hash'] == md5($descricao) ) { //se form_hash não for vazio e for igual ao md5 então retorna false pq o cliente ja foi adicionado
        $mostrarAlerta = false;
        return false;
    }
    $_SESSION['form_hash'] = md5($descricao);
//    $form_hash = md5($descricao);
    return true;
}

if (uniquePost($_POST, $formulario)) {
    if (isset($_POST["nome"])){$cliente->setNmCliente($_POST["nome"]);}
    if (isset($_POST["rg"])){$cliente->setNrDocumento1($_POST["rg"]);}
    if (isset($_POST["cpf"])){$cliente->setNrDocumento2($_POST["cpf"]);}
    if (isset($_POST["nmLogradouro"])){$cliente->setNmLogradouro($_POST["nmLogradouro"]);}
    if (isset($_POST["nrLogradouro"])){$cliente->setNrLogradouro($_POST["nrLogradouro"]);}
    if (isset($_POST["bairro"])){$cliente->setNmBairro($_POST["bairro"]);}
    if (isset($_POST["fone"])){$cliente->setNrFone($_POST["fone"]);}
    if (isset($_POST["cel"])){$cliente->setNrCelular($_POST["cel"]);}
    if (isset($_POST["fax"])){$cliente->setNrFax($_POST["fax"]);}
    if (isset($_POST["email"])){$cliente->setDsEmail($_POST["email"]);}
    if (isset($_POST["complemento"])){$cliente->setDsComplemento($_POST["complemento"]);}
    if (isset($_POST["razaoSocial"])){$cliente->setNmCliente($_POST["razaoSocial"]);}
    if (isset($_POST["iEstadual"])){$cliente->setNrDocumento1($_POST["iEstadual"]);}
    if (isset($_POST["cnpj"])){$cliente->setNrDocumento2($_POST["cnpj"]);}
    if (isset($_POST["contato"])){$cliente->setNmContato($_POST["contato"]);}    
    
    if ($formulario === "pFisica"){
        $cliente->setTpPessoa("f");
    }else if ($formulario === "pJuridica"){
        $cliente->setTpPessoa("j");
    }
//    echo "                                                     ----------           ";;
//    print_r($cliente);
//    echo "<script>console.log('inserir ou atualizar cliente')</script>";
    $mostrarAlerta = true;
    
    $service = new ServiceCliente();
//    echo "cliente->getIdCliente()" . $cliente->getIdCliente();
    if(!is_null($cliente->getIdCliente())){
//        echo "atualizar ";
        $service->atualizar($cliente);
        $cliente = new Cliente();
    } else {
//        echo "inserir ";
        $service->inserir($cliente);
        $cliente = new Cliente();
    }
    
    $_POST = null;
}

?>

