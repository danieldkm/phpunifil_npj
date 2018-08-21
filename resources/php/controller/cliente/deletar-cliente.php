<?php
    if (!isset($fullPath)){
        require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
    }
    require_once $fullPath."php/service/ServiceCliente.php";
    
    if(isset($_POST["idCliente"])){
        echo "<script>console.log('Excluir cliente: ".$_POST["idCliente"]."')</script>";
        $service = new ServiceCliente();
        $cliente = $service->findById($_POST["idCliente"]);
        $service->deletar($cliente);
        echo $cliente->getQueryDelete();
    }