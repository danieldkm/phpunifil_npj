<?php require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/InicializarCliente.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>UniFil - Buscar clientes</title>
        <?php /*META SECTION*/ echo $metaSection ?>
        <?php /*CSS INCLUDE*/ echo $styleInclude ?>
    </head>
    <body onload="hideLoad()">
        <!--<button id='alerta' type='button' class='btn btn-primary btn-clean notify' data-notify-type='error' data-notify-layout='top' data-notify='<strong>Cliente</strong>Excluído com sucesso!'>aaaaaaaaaaaaa</button>-->
        <button id='alerta' type='button' class='btn btn-primary btn-clean notify esconder' data-notify-type='success' data-notify-layout='top' data-notify='<strong>Cliente</strong>Excluído com sucesso!'>aaaaaaaaaa</button>
<!--        <div id="divAlerta">
            <button id='alerta' type='button' class='btn btn-primary btn-clean notify' data-notify-type='error' data-notify-layout='top' data-notify='<strong>Cliente</strong>Excluído com sucesso!'>aaaaaaaaaaaaa</button>
        </div>;-->
        <!-- APP WRAPPER -->
        <div class="app">            
            <!-- START APP CONTAINER -->
            <div class="app-container">
                <?php /*SIDEBAR*/ echo $defaultFixed; ?>
                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <?php /*HEADER*/ echo $defaultHeader; ?>
                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page">                        
                        <div class="title">
                            <h1>Buscar clientes</h1>
                            <p></p>
                        </div>
                        <!--<div class="heading-elements">
                            <a href="#" class="btn btn-danger" id="page-like"><span class="app-spinner loading"></span> loading...</a>
                            <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">$24</span> Purchase</a>
                        </div>-->
                    </div>
                    <div class="app-heading-container app-heading-bordered bottom">
                        <ul class="breadcrumb">
                            <li><a href="/index.html">Principal</a></li>
<!--                            <li><a href="#">Components</a></li>-->
                            <li class="active">Tables</li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADING -->                 
                    <!-- START PAGE CONTAINER -->
                    <div class="container">
                        <div class="block block-condensed">
                            <!-- START HEADING -->
                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>Tabela de clientes</h5>
<!--                                    <p>Add class <code>datatable-extended</code> to get full-featured sortable table.</p>-->
                                </div>
                                <div class="heading-elements">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-icon-fixed dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bars"></span> Export Data</button>
                                        <ul class="dropdown-menu dropdown-left">
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'json',escape:'false'});"><img src='/npj/img/icons/json.png' width="24"> JSON</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src='/npj/img/icons/json.png' width="24"> JSON (ignoreColumn)</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'json',escape:'true'});"><img src='/npj/img/icons/json.png' width="24"> JSON (with Escape)</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'xml',escape:'false'});"><img src='/npj/img/icons/xml.png' width="24"> XML</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'sql'});"><img src='/npj/img/icons/sql.png' width="24"> SQL</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'csv',escape:'false'});"><img src='/npj/img/icons/csv.png' width="24"> CSV</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'txt',escape:'false'});"><img src='/npj/img/icons/txt.png' width="24"> TXT</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'excel',escape:'false'});"><img src='/npj/img/icons/xls.png' width="24"> XLS</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'doc',escape:'false'});"><img src='/npj/img/icons/word.png' width="24"> Word</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'powerpoint',escape:'false'});"><img src='/npj/img/icons/ppt.png' width="24"> PowerPoint</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'png',escape:'false'});"><img src='/npj/img/icons/png.png' width="24"> PNG</a></li>
                                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'pdf',escape:'false'});"><img src='/npj/img/icons/pdf.png' width="24"> PDF</a></li>
                                        </ul>
                                    </div> 
                                </div>
                            </div>
                            <!-- END HEADING -->
                            <div id="tabelaCliente" class="block-content">
                                <?php 
                                    echo $loading;
                                    require_once 'php/controller/cliente/popularTabela.php'; 
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE CONTAINER -->
                </div>
                <!-- END APP CONTENT -->
            </div>
            <!-- END APP CONTAINER -->            
            <?php /*SIDEPANEL*/ echo $defaultSidePane; ?>
        </div>        
        <!-- END APP WRAPPER -->   
        
        <?php
            echo $scriptImportanteInclude;
            echo $scriptAppInclude;
            echo $acoesSimples;
            echo $tabela;
            echo $sweetalert;
            echo $controleCliente;
        ?>           
    </body>
</html>