<?php 
    $inicial->setTitulo("UniFil - Buscar processos");
    session_start();
?>

@extends('partials.layouts.default-without-footer', ["hasClass" => true , "class" => "modal-open"])

@section('content')
    @push('css')
       @include("partials.styles.{$inicial->getModalLoading()->getNameInclude()}")
    @endpush
    @include('partials.headers.default')
    @include("partials.ui.loadings.{$inicial->getModalLoading()->getNameInclude()}", ["isHide" => false])
    <!-- START PAGE HEADING hideLoad()-->
    <div class="app-heading app-heading-bordered app-heading-page">                        
        <div class="title">
            <h1>Buscar processos</h1>
            <p></p>
        </div>
    </div>
    <div class="app-heading-container app-heading-bordered bottom">
        <ul class="breadcrumb">
            <li><a href="/index.php">Principal</a></li>
            <li class="active">Buscar</li>
        </ul>
    </div>
    <!-- END PAGE HEADING -->                 
    <!-- START PAGE CONTAINER -->
    <div class="container">
        <div class="block block-condensed">
            <!-- START HEADING -->
            <div class="app-heading app-heading-small">
                <div class="title">
                    <h5>Tabela de processos arquivados</h5>
                </div>
                <div class="container">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <label for="Buscar processos">Buscar processos</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="popup" class="col-lg-11 popup" onclick="showHint('hintBusca')">
                            <input id="txtBusca" class="form-control" type="text" />
                            <span class="popuptext" id="hintBusca">É possível realizar a busca por parâmetro, Exemplo:<br>processo:valor<br>cliente:valor</span>
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-primary btn-clean" onclick="findBy(document.getElementById('txtBusca').value)">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- END HEADING -->
            <div id="tabelaCliente" class="block-content">
                <table class='table table-bordered datatable-extended table-hover' id='sortable-data'>
                    <thead>
                        <tr>
                            <th>Nº de processo</th>
                            <th>Cliente</th>
                            <th>Polo aivo</th>
                            <th>Polo passivo</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                            <th>Arquivar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER -->
    
    
    @push('javascript')
        @include('partials.scripts.table')
        @include('partials.scripts.table-export')
        @include('partials.scripts.page-inicial')
        <script type='text/javascript' src='/js/processo/controle_processo.js'></script>
        <?php
            echo '<script> var idLoading = "'.$inicial->getModalLoading()->getId().'"; </script>';
        ?>
    @endpush
    
@stop