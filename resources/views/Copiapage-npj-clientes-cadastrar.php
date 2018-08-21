<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/InicializarCliente.php");
    
    require_once 'php/ui/buttons/WithIcon.php';
    $submit = new WithIcon("","");
    $submit->setType("submit");
    $submit->setName(" Validar & Salvar");
    $submit->setIco("fa fa-save");
    $submit->getClasses()->setColor("primary");
    $submit->getClasses()->setType("clean");
    
    $limpar = new WithIcon("","");
    $limpar->setType("button");
    $limpar->setName(" Limpar");
    $limpar->setIco("fa fa-eraser");
    $limpar->setOnClick("cleanForm(this)");
    $limpar->setValue("form-pessoa-fisica");
    $limpar->getClasses()->setColor("primary");
    $limpar->getClasses()->setType("clean");
    
    $tabPessoaFisica = "<li><a href='#tab-1' class='active'><span class='icon-user'></span> Física</a></li>";
    $tabPessoaJuridica = "<li><a href='#tab-2'><span class='icon-briefcase'></span> Jurídica</a></li>";
    $activePJuridica = "";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>                        
        <title>Unifil - Cadastrar clientes</title>            
        <?php 
            echo $metaSection;
            echo $styleInclude;
        ?>
    </head>
    <body>
    <?php 
        session_start();
    
        if (isset($_SESSION['form_hash'])){
            $form_hash = $_SESSION['form_hash'];    
        }

        $cliente = new Cliente();
        $mostrarAlerta = false;

        if(isset($_POST["idCliente"])){
//            echo "idCliente" . print_r($_POST["idCliente"]);
            $service = new ServiceCliente();
            $cliente = $service->findById($_POST["idCliente"]);
            $submit->setName(" Validar & Atualizar");;
            if(isset($_POST["tpPessoa"])){
                $tipo = $_POST["tpPessoa"];
                $limpar->setDisable(true);
                if($tipo === "f"){
                    $tabPessoaJuridica = null;
                } else if($tipo === "j"){
                    $tabPessoaFisica = null;
                    $tabPessoaJuridica = "<li><a href='#tab-2'class='active'><span class='icon-briefcase'></span> Jurídica</a></li>";
                    $activePJuridica = "active";
                }
            }
    //        $_POST = array();
    //        session_unset();
        }

        if (isset($_POST["formulario"])) {
            require_once("php/controller/cliente/inserir-pessoa.php");
//            $formulario = $_POST["formulario"];
//            if ($formulario == "pFisica"){
//                
//                $cliente = new Cliente();
//            } else if($formulario == "pJuridica"){
//                require_once("php/controller/cliente/inserir-pessoa-juridica.php");
//                $cliente = new Cliente();
//            }
        }
    ?>
    <pre>
    <?php
        print_r($cliente);
//        if($mostrarAlerta){
//            $nmCliente = $cliente->getNmCliente();
//            echo "<body onload='showAlerta()'>";
//            echo "<button id='alerta' type='button' class='btn btn-primary btn-clean notify esconder' data-notify-type='success' data-notify-layout='top' data-notify='<strong>Cliente $nmCliente </strong>Salvo com sucesso!'>aaaaaaaaaa</button>";
//        } else {
//            echo "<body>";
//        }
    ?>
    </pre>
        <!-- APP WRAPPER -->
        <div class="app">
           
            <!-- START APP CONTAINER -->
            <div class="app-container"> 
                <?php /*SIDEBAR*/ echo $defaultFixed; ?>
                         
                <!-- START APP RESIZABLE CONTENT -->
                <div class="app-content">
                    <?php /*HEADER*/ echo $defaultHeader; ?>

                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page">
                        <div class="icon icon-lg">
                            <span class="icon-new-tab"></span>
                        </div>
                        <div class="title">
                            <h2>Cadastro de clientes</h2>
                        <!--                            <p>Awesome feature with tabbed content</p>-->
                        </div>
                        <!--<div class="heading-elements">
                        <a href="#" class="btn btn-danger" id="page-like"><span class="app-spinner loading"></span> loading...</a>
                        <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">$24</span> Purchase</a>
                        </div>-->
                    </div>
                    <div class="app-heading-container app-heading-bordered bottom">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Principal</a></li>
                            <li><a href="page-npj-clientes-cadastrar.php">Cadastrar</a></li>
                            <li class="active">Pessoa</li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADING -->   

                    <!-- START CONTENT TABS -->
                    <div class="app-content-tabs">
                        <ul>                            
                            <!--<li><a href="#tab-1" class="active"><span class="icon-user"></span> Física</a></li>-->
                            <?php echo $tabPessoaFisica; ?>
                            <?php echo $tabPessoaJuridica; ?>
                            <!--<li><a href="#tab-2"><span class="icon-briefcase"></span> Jurídica</a></li>-->
                        </ul>
                    </div>
                    <!-- END CONTENT TABS -->
                    <?php 
                        if (!is_null($tabPessoaFisica)) {
                            echo
                    '<!-- START CONTAINER -->',
                    '<div class="container app-content-tab active" id="tab-1">',

                        '<!-- BLOCK -->',
                        '<div class="block">',
                            '<!-- START HEADING -->',
                            '<div class="app-heading app-heading-small">',
                                '<div class="icon">',
                                    '<span class="icon-user"></span>',
                                '</div>',
                                '<div class="title">',
                                    '<h2>Cadastro de pessoa física</h2>',
                                    '<!--                                    <p>Curabitur sollicitudin porttitor erat</p>-->',
                                '</div>',                        
                                '<div class="heading-elements">',
                                    '<!--<a href="#" class="btn btn-default btn-clean">Settings</a>',
                                    '<a href="#" class="btn btn-default btn-clean">Limpar</a>',
                                    'onClick="cleanForm(this)" value="form-pessoa-fisica"-->'.
                                    $limpar->getButton().
                                '</div>',
                            '</div>',
                            '<!-- END START HEADING -->',
                            '<form id="form-pessoa-fisica" class="form-horizontal" role="form" method="POST" action>',
                                '<div class="col-lg-12">',
                                    '<label>Nome</label>',
                                    '<input class="form-control" name="nome" data-validation="required" placeholder="" required value="'. $cliente->getNmCliente().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-6">',
                                    '<label>RG</label>',
                                    '<input class="form-control" name="rg" data-validation="required" data-validation-length="min8"  placeholder="" required value="'. $cliente->getNrDocumento1().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                    '<!--                                    data-validation="length" data-validation-length="min5"-->',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-6">',
                                    '<label>CPF</label>',
                                    '<input class="mask_cpf form-control" name="cpf" data-validation="cpf" placeholder="" required value="'.$cliente->getNrDocumento2().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                '</div>',
                            
                                    '<div class="col-lg-8">',
                                        '<label>Logradouro</label>',
                                        '<input class="form-control" name="nmLogradouro" data-validation="required" placeholder="" required value="'.$cliente->getNmlogradouro().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                        '<span class="help-block">*</span>',
                                    '</div>',
                            
                                    '<div class="col-lg-4">',
                                        '<label>Nº</label>',
                                        '<input class="form-control" name="nrLogradouro" data-validation="number" placeholder="" required value="'.$cliente->getNrlogradouro().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                        '<span class="help-block">*</span>',
                                    '</div>',
                                
                                '<div class="col-lg-6">',
                                    '<label>Complemento</label>',
                                    '<input type="text" name="complemento" class="form-control" value="'.$cliente->getDsComplemento().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                '</div>',
                                '<div class="col-lg-6">',
                                    '<label>Bairro</label>',
                                    '<input type="text" name="bairro" class="form-control" value="'.$cliente->getNmBairro().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Fone</label>',
                                    '<input class="mask_fone form-control" name="fone" data-validation="custom" data-validation-regexp="\(\d{3}\)\s\d{4}\-\d{4}" required value="'.$cliente->getNrfone().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*(033) 3333-3333</span>',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Celular</label>',
                                    '<input type="text" name="cel" class="mask_cel form-control" value="'.$cliente->getNrCelular().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">(099) 99999-9999</span>',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Fax</label>',
                                    '<input type="text" name="fax" class="mask_fone form-control" value="'.$cliente->getNrfax().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">(099) 9999-9999</span>',
                                '</div>',
                                '<div class="col-lg-12">',
                                    '<label>E-mail</label>',
                                    '<input class="form-control" name="email" data-validation="email" placeholder="seuemail@dominio.com" required value="'.$cliente->getDsEmail().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="form-group margin-top-20">',
                                    '<input type="hidden" name="formulario" value="pFisica"/>';
                                    if(!is_null($cliente->getIdCliente())){
                                        echo
                                            '<input type="hidden" name="idCliente" value="'.$cliente->getIdCliente().'"/>';
                                    }
//                                    <button class="btn btn-primary btn-clean" type="submit"><span class="fa fa-save"/> Validar & Salvar</button>
                            echo $submit->getButton().
                                '</div>',
                            '</form>',
                        '</div>',
                        '<!-- END BLOCK -->',
                    '</div>',
                    '<!-- END CONTAINER -->';
                        }
                        if (!is_null($tabPessoaJuridica)) {
                            echo 
                    '<!-- START CONTAINER -->',
                    '<div class="container app-content-tab '.$activePJuridica.'" id="tab-2">',
                        '<!-- BLOCK -->',
                        '<div class="block">',
                            '<!-- START HEADING -->',
                            '<div class="app-heading app-heading-small">',
                                '<div class="icon">',
                                    '<span class="icon-briefcase"></span>',
                                '</div>',
                                '<div class="title">',
                                    '<h2>Cadastro de pessoa jurídica</h2>',
                                    '<!--                                    <p>Curabitur sollicitudin porttitor erat</p>-->',
                                '</div>',
                                '<div class="heading-elements">'.
                                    $limpar->setValue("form-pessoa-juridica").
                                    $limpar->getButton().
                                '</div>',
                            '</div>',
                            '<!-- END START HEADING -->',

                            '<form id="form-pessoa-juridica" class="form-horizontal" role="form" action method="post">',
                                '<div class="col-lg-12">',
                                    '<label>Razão Social</label>',
                                    '<!--                                       <input type="text" class="form-control">-->',
                                    '<input name="razaoSocial" class="form-control" data-validation="required" placeholder="" required value="'. $cliente->getNmCliente() .'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-8">',
                                    '<label>Inscrição Estadual</label>',
                                    '<input name="iEstadual" class="form-control" data-validation="required" placeholder="" required value="'. $cliente->getNrDocumento1().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>CNPJ</label>',
                                    '<!--<input type="text" class="form-control">-->',
                                    '<input name="cnpj" class="mask_cnpj form-control" data-validation="cnpj" placeholder="" required value="'.$cliente->getNrDocumento2().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-8">',
                                    '<label>Logradouro</label>',
                                    '<input name="nmLogradouro" class="form-control" data-validation="required" placeholder="" required value="'.$cliente->getNmlogradouro().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Nº</label>',
                                    '<input name="nrLogradouro" class="form-control" data-validation="number" placeholder="" required value="'.$cliente->getNrlogradouro().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-6">',
                                    '<label>Complemento</label>',
                                    '<input name="complemento" type="text" class="form-control" value="'.$cliente->getDsComplemento().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                '</div>',
                                '<div class="col-lg-6">',
                                    '<label>Bairro</label>',
                                    '<input name="bairro" type="text" class="form-control" value="'.$cliente->getNmBairro().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Fone</label>    ',
                                    '<input name="fone" class="mask_fone form-control" data-validation="custom" data-validation-regexp="\(\d{3}\)\s\d{4}\-\d{4}" placeholder="" required value="'.$cliente->getNrfone().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">*(033) 3333-3333</span>',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Celular</label>',
                                    '<input name="cel" type="text" class="mask_cel form-control" value="'.$cliente->getNrCelular().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)"> <!--onBlur="showAtributos(this)"-->',
                                    '<span class="help-block">(99) 99999-9999</span>',
                                '</div>',
                                '<div class="col-lg-4">',
                                    '<label>Fax</label>',
                                    '<input name="fax" type="text" class="mask_fone form-control" value="'.$cliente->getNrfax().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
                                    '<span class="help-block">(033) 3333-3333</span>',
                                '</div>',
                                '<div class="col-lg-12">',
                                    '<label>E-mail</label>',
                                    '<input name="email" class="form-control" data-validation="email" placeholder="seuemail@dominio.com" required value="'.$cliente->getDsEmail().'" onFocus="inputFocus(this)" onfocusout="inputFocusOut(this)">',
'<!--                                   <input type="text" class="form-control">-->',
                                    '<span class="help-block">*</span>',
                                '</div>',
                                '<div class="col-lg-12">',
                                    '<label>Contato</label>',
                                    '<input name="contato" type="text" class="form-control" value="'.$cliente->getNmContato().'">',
                                '</div>',
                                '<div class="form-group margin-top-20">',
                                    '<input type="hidden" name="formulario" value="pJuridica"/>';
                                    if(!is_null($cliente->getIdCliente())){
                                        echo 
                                            '<input type="hidden" name="idCliente" value="'.$cliente->getIdCliente().'"/>';
                                    }
//                                    <button class="btn btn-primary btn-clean" type="submit"><span class="fa fa-save"/> Validar & Salvar</button>
                            echo $submit->getButton().    
                                '</div>',
                            '</form>',
                        '</div>',
                        '<!-- END BLOCK -->',
                    '</div>',
                    '<!-- END CONTAINER -->';
                        }
                    ?>
                </div>
                <!-- END APP CONTENT -->
            </div>
            <!-- END APP CONTAINER -->
             <?php /*SIDEPANEL*/ echo $defaultSidePane; ?>
        </div>
        <!-- END APP WRAPPER -->                
        <!-- START APP SCRIPTS -->
        <?php
            echo $scriptImportanteInclude;
            echo $scriptAppInclude;
            echo $acoesSimples;
            echo $alertaNotificacao;
            echo $validador;
            echo $mascara;
            echo $controleCliente;
        ?>
        
        <!-- END APP SCRIPTS -->
        
        <script type="text/javascript">
            
            
            $.validate({
                modules : 'date,file,location',
                onValidate: function(){
                    
                    delayBeforeFire(function(){                                                
                        app.spy();
                    },100);
                                        
                }
            });
        </script>
    </body>
</html>