<?php
    $inicial->setTitulo("UniFil - Cadastro de clientes");
//    $inicial->setHasOnLoad(false);
    $inicial->getBtnLimpar()->setValue("form-pessoa-fisica");

    $formPFId = "form-pessoa-fisica";
    $formPJId = "form-pessoa-juridica";
    
    $activeTabPFisica = "active"; 
    $activeTabPJuridica = "";

    $btnNmForm = "Validar & Salvar";
    $isUpdate = "false";

    session_start();
//    print_r($lista);
//    echo count($lista);
//    echo $lista[0].NM_CLIENTE;
    
?>

@extends('partials.layouts.default-without-footer', ["hasClass" => false])

@section('content')
    @push('css')
       @include("partials.styles.{$inicial->getModalLoading()->getNameInclude()}")
    @endpush
    @include('partials.headers.default')
    <pre>
        <?php
//            print_r($inicial);
        ?>
    </pre>
    @include("partials.ui.loadings.{$inicial->getModalLoading()->getNameInclude()}", ["isHide" => false])
<!--    {{$inicial->getModalLoading()->getNameInclude()}}-->
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
        <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">24</span> Purchase</a>
        </div>-->
    </div>
    <div class="app-heading-container app-heading-bordered bottom">
        <ul class="breadcrumb">
            <li><a href="/">Principal</a></li>
            <li><a href="{{route('npj.clientes.form')}}">Cadastrar</a></li>
            <li class="active">Pessoa</li>
        </ul>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START CONTENT TABS -->
    <div class="app-content-tabs">
        <ul>               
            @if (!is_null($cliente->ID_CLIENTE))
                @if ($cliente->TP_PESSOA == "f")
                    <li><a href="#tab-1" class="active"><span class="icon-user"></span> Física</a></li>
                    <?php $activeTabPFisica = "active"; $activeTabPJuridica = ""; $btnNmForm = "Validar & Atualizar"; $isUpdate = "true";?>
                @elseif ($cliente->TP_PESSOA == "j")
                    <li><a href="#tab-2" class="active"><span class="icon-briefcase"></span> Jurídica</a></li>
                    <?php $activeTabPFisica = ""; $activeTabPJuridica = "active"; $btnNmForm = "Validar & Atualizar"; $isUpdate = "true";?>
                @endif
            @else
                <li><a href="#tab-1" class="active"><span class="icon-user"></span> Física</a></li>
                <li><a href="#tab-2"><span class="icon-briefcase"></span> Jurídica</a></li>
            @endif
        </ul>
    </div>
    <!-- END CONTENT TABS -->
    
    
    <!-- START CONTAINER -->
    <div class="container app-content-tab {{{$activeTabPFisica}}}" id="tab-1">

        <!-- BLOCK -->
        <div class="block">
            <!-- START HEADING -->
            <div class="app-heading app-heading-small">
                <div class="icon">
                    <span class="icon-user"></span>
                </div>
                <div class="title">
                    <h2>Cadastro de pessoa física</h2>
                    <!--                                    <p>Curabitur sollicitudin porttitor erat</p>-->
                </div>
                <div class="heading-elements">
                   <?php $inicial->getBtnLimpar()->setId("btnPFisica"); ?>
                   @if (is_null($cliente->ID_CLIENTE))
                        @include('partials.ui.buttons.with-icon')
                   @endif
                </div>
            </div>
            <!-- END START HEADING -->
            <form id="{{{$formPFId}}}" class="form-horizontal" role="form" onSubmit="return cliente.inserir_cliente('{{{$inicial->getBtnLimpar()->getId()}}}', '{{{$formPFId}}}', {{{$isUpdate}}}, {{{$cliente->ID_CLIENTE}}})">  
                <div class="col-lg-12">
                    <label>Nome</label>
                    <input class="form-control" name="nome" data-validation="required" placeholder="" required value="{{{$cliente->NM_CLIENTE}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-6">
                    <label>RG</label>
                    <input class="form-control" name="rg" data-validation="required" data-validation-length="min8"  placeholder="" required value="{{$cliente->NR_DOCUMENTO_1}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-6">
                    <label>CPF</label>
                    <input class="mask_cpf form-control" name="cpf" data-validation="cpf" placeholder="" required value="{{{$cliente->NR_DOCUMENTO_2}}}">
                </div>
                    <div class="col-lg-8">
                        <label>Logradouro</label>
                        <input class="form-control" name="nmLogradouro" data-validation="required" placeholder="" required value="{{{$cliente->NM_LOGRADOURO}}}">
                        <span class="help-block">*</span>
                    </div>
                    <div class="col-lg-4">
                        <label>Nº</label>
                        <input class="form-control" name="nrLogradouro" data-validation="number" placeholder="" required value="{{{$cliente->NR_LOGRADOURO}}}">
                        <span class="help-block">*</span>
                    </div>
                <div class="col-lg-6">
                    <label>Complemento</label>
                    <input type="text" name="complemento" class="form-control" value="{{{$cliente->DS_COMPLEMENTO}}}">
                </div>
                <div class="col-lg-6">
                    <label>Bairro</label>
                    <input type="text" name="bairro" class="form-control" value="{{{$cliente->NM_BAIRRO}}}">
                </div>
                <div class="col-lg-4">
                    <label>Fone</label>
                    <input class="mask_fone form-control" name="fone" data-validation="custom" data-validation-regexp="\(\d{2}\)\s\d{4}\-\d{4}" required placeholder="(33) 3333-3333" value="{{{$cliente->NR_FONE}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-4">
                    <label>Celular</label>
                    <input type="text" name="cel" class="mask_celular form-control" value="{{{$cliente->NR_CELULAR}}}" placeholder="(99) 9999-99999">
                    <span class="help-block"></span>
                </div>
                <div class="col-lg-4">
                    <label>Fax</label>
                    <input type="text" name="fax" class="mask_fone form-control" value="{{{$cliente->NR_FAX}}}" placeholder="(33) 3333-3333">
                    <span class="help-block"></span>
                </div>
                <div class="col-lg-12">
                    <label>E-mail</label>
                    <input class="form-control" name="email" data-validation="email" placeholder="seuemail@dominio.com" required value="{{{$cliente->DS_EMAIL}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-12">
<!--                    <div class="form-group margin-top-20">-->
                        <input type="hidden" name="formulario" value="pFisica"/>
                        @if (!is_null($cliente->ID_CLIENTE))
                            <?php 
                                // $id = Crypt::encryptString($cliente->ID_CLIENTE);
                            ?>
                            <input type="hidden" name="id" value="{{{$cliente->ID_CLIENTE}}}"/>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary btn-clean" type="submit" ><span class="fa fa-save"/> {{{$btnNmForm}}}</button>
<!--                    </div>-->
                </div>
            </form>
        </div>
        <!-- END BLOCK -->
    </div>
    <!-- END CONTAINER -->

    <!-- START CONTAINER -->
    <div class="container app-content-tab {{{$activeTabPJuridica}}}" id="tab-2">
        <!-- BLOCK -->
        <div class="block">
            <!-- START HEADING -->
            <div class="app-heading app-heading-small">
                <div class="icon">
                    <span class="icon-briefcase"></span>
                </div>
                <div class="title">
                    <h2>Cadastro de pessoa jurídica</h2>
                    <!--                                    <p>Curabitur sollicitudin porttitor erat</p>-->
                </div>
                <div class="heading-elements">
                    <?php $inicial->getBtnLimpar()->setValue($formPJId); $inicial->getBtnLimpar()->setId("btnPJuridica"); ?>
                    @if (is_null($cliente->ID_CLIENTE))
                        @include('partials.ui.buttons.with-icon')
                    @endif
                </div>
            </div>
            <!-- END START HEADING -->
            <form id="{{{$formPJId}}}" class="form-horizontal" role="form" method="POST" onSubmit="return cliente.inserir_cliente('{{{$inicial->getBtnLimpar()->getId()}}}', '{{{$formPJId}}}', {{{$isUpdate}}}, {{{$cliente->ID_CLIENTE}}})">
                <div class="col-lg-12">
                    <label>Razão Social</label>
                    <input name="razaoSocial" class="form-control" data-validation="required" placeholder="" required value="{{{$cliente->NM_CLIENTE}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-8">
                    <label>Inscrição Estadual</label>
                    <input name="ie" class="form-control" data-validation="required" placeholder="" required value="{{{$cliente->NR_DOCUMENTO_1}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-4">
                    <label>CNPJ</label>
                    <!--<input type="text" class="form-control">-->
                    <input name="cnpj" class="mask_cnpj form-control" data-validation="cnpj" placeholder="" required value="{{{$cliente->NR_DOCUMENTO_2}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-8">
                    <label>Logradouro</label>
                    <input name="nmLogradouro" class="form-control" data-validation="required" placeholder="" required value="{{{$cliente->NM_LOGRADOURO}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-4">
                    <label>Nº</label>
                    <input name="nrLogradouro" class="form-control" data-validation="number" placeholder="" required value="{{{$cliente->NR_LOGRADOURO}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-6">
                    <label>Complemento</label>
                    <input name="complemento" type="text" class="form-control" value="{{{$cliente->DS_COMPLEMENTO}}}">
                </div>
                <div class="col-lg-6">
                    <label>Bairro</label>
                    <input name="bairro" type="text" class="form-control" value="{{{$cliente->NM_BAIRRO}}}">
                </div>
                <div class="col-lg-4">
                    <label>Fone</label>    
                    <input name="fone" class="mask_fone form-control" data-validation="custom" data-validation-regexp="\(\d{2}\)\s\d{4}\-\d{4}" placeholder="(33) 3333-3333" required value="{{{$cliente->NR_FONE}}}">
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-4">
                    <label>Celular</label>
                    <input name="cel" type="text" class="mask_celular form-control" value="{{{$cliente->NR_CELULAR}}}" placeholder="(99) 9999-99999"> <!--onBlur="showAtributos(this)"-->
                    <span class="help-block"></span>
                </div>
                <div class="col-lg-4">
                    <label>Fax</label>
                    <input name="fax" type="text" class="mask_fone form-control" value="{{{$cliente->NR_FAX}}}" placeholder="(33) 3333-3333">
                    <span class="help-block"></span>
                </div>
                <div class="col-lg-12">
                    <label>E-mail</label>
                    <input name="email" class="form-control" data-validation="email" placeholder="seuemail@dominio.com" required value="{{{$cliente->DS_EMAIL}}}">
<!--                                   <input type="text" class="form-control">-->
                    <span class="help-block">*</span>
                </div>
                <div class="col-lg-12">
                    <label>Contato</label>
                    <input name="contato" type="text" class="form-control" value="{{{$cliente->NM_CONTATO}}}">
                </div>
                <div class="col-lg-12">
<!--                    <div class="form-group margin-top-20">-->
                        <input type="hidden" name="formulario" value="pJuridica"/>
                        @if (!is_null($cliente->ID_CLIENTE))
                            <?php 
                                // $id = Crypt::encryptString($cliente->ID_CLIENTE);
                            ?>
                            <input type="hidden" name="id" value="{{{$cliente->ID_CLIENTE}}}"/>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary btn-clean" type="submit"><span class="fa fa-save"/> {{{$btnNmForm}}}</button>
<!--                    </div>-->
                </div>
            </form>
        </div>
        <!-- END BLOCK -->
    </div>
    <!-- END APP CONTENT -->
    
    @push('javascript')
        @include('partials.scripts-importante-include')
        @include('partials.scripts.validador')
        @include('partials.scripts.mascara')
        <script type="text/javascript" src="/js/cliente/controle_cliente.js"></script>
        <script>
            var cliente = new Cliente("{{route('npj.clientes')}}", "{{route('npj.clientes.form')}}");
        </script>
        @include('partials.scripts.page-inicial')  
    @endpush
@stop
