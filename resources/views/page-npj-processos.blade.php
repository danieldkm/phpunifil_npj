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
    <pre>
        <?php
//            print_r($json);
            
        ?>
    </pre>
    @include("partials.ui.loadings.{$inicial->getModalLoading()->getNameInclude()}", ["isHide" => false])
    <!-- START PAGE HEADING hideLoad()-->
    <div class="app-heading app-heading-bordered app-heading-page">                        
        <div class="title">
            <h1>Buscar processos</h1>
            <p></p>
        </div>
        <!--<div class="heading-elements">
            <a href="#" class="btn btn-danger" id="page-like"><span class="app-spinner loading"></span> loading...</a>
            <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">$24</span> Purchase</a>
        </div>-->
    </div>
    <div class="app-heading-container app-heading-bordered bottom">
        <ul class="breadcrumb">
            <li><a href="/index.php">Principal</a></li>
    <!--                            <li><a href="#">Components</a></li>-->
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
                    <h5>Tabela de processos</h5>
    <!--                                    <p>Add class <code>datatable-extended</code> to get full-featured sortable table.</p>-->
                </div>
<!--
                <div class="heading-elements">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-icon-fixed dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bars"></span> Export Data</button>
                        <ul class="dropdown-menu dropdown-left">
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'json',escape:'false'});"><img src='/img/icons/json.png' width="24"> JSON</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src='/img/icons/json.png' width="24"> JSON (ignoreColumn)</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'json',escape:'true'});"><img src='/img/icons/json.png' width="24"> JSON (with Escape)</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'xml',escape:'false'});"><img src='/img/icons/xml.png' width="24"> XML</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'sql'});"><img src='/img/icons/sql.png' width="24"> SQL</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'csv',escape:'false'});"><img src='/img/icons/csv.png' width="24"> CSV</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'txt',escape:'false'});"><img src='/img/icons/txt.png' width="24"> TXT</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'excel',escape:'false'});"><img src='/img/icons/xls.png' width="24"> XLS</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'doc',escape:'false'});"><img src='/img/icons/word.png' width="24"> Word</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'powerpoint',escape:'false'});"><img src='/img/icons/ppt.png' width="24"> PowerPoint</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'png',escape:'false'});"><img src='/img/icons/png.png' width="24"> PNG</a></li>
                            <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'pdf',escape:'false'});"><img src='/img/icons/pdf.png' width="24"> PDF</a></li>
                        </ul>
                    </div> 
                </div>
-->
                <div class="container">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <label for="Buscar processos">Buscar processos</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="popup" class="col-lg-11 popup" onclick="showHint('hintBusca')">
                            <input id="txtBusca" class="form-control" type="text" />
                            <span class="popuptext" id="hintBusca">É possível realizar a busca por parâmetro, que são:<br>processo:valor<br>id_processo:valor<br>cliente:valor<br>id_cliente:valor</span>
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
                <?php 
//                    echo $tabela;
//                    echo $loading;
//                    require_once 'php/controller/cliente/popularTabela.php'; 
                ?>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER -->
    
    
    @push('javascript')
        @include('partials.scripts.table')
        @include('partials.scripts.table-export')
        @include('partials.scripts.page-inicial')
        <script type='text/javascript' src='/js/processo/controle_processo.js'></script>
        <script>
            var idLoading = "{{$inicial->getModalLoading()->getId()}}";
            var processo = new Processo("{{route('npj.processos')}}", "{{route('npj.processos.form')}}");

            function findBy(txt) {
                showLoadingModal(idLoading);
                var token = $('meta[name="csrf-token"]').attr('content');
                var request = $.ajax({
                    url: "{{route('npj.processos')}}/" + txt,
                    type: "get",
                    data: {texto: txt, _token: token}
                });
                request.done(function (msg) {
                    let lista = JSON.parse(msg);
                    popularTabela(lista);
                    hideLoadingModal(idLoading);
                });
                
                request.fail(function (jqXHR, textStatus) {
                    hideLoadingModal(idLoading);
                });
            }

            var tabela;

            function arrayElements(element, index, array) {
                addProcesso(element);
            }

            function popularTabela(processos){
                tabela = $('#sortable-data').DataTable();
                tabela.clear();
                processos.forEach(arrayElements);
                tabela.columns.adjust().draw();
            }
            
           
            function addProcesso(processo){
                var token = $('meta[name="csrf-token"]').attr('content');
                
                var i = tabela.row.add( [
                        processo.NR_PROCESSO,
                        processo.NM_CLIENTE,
                        processo.DS_POLO_ATIVO,
                        processo.DS_POLO_PASSIVO,
                        "<form id='" + processo.ID_PROCESSO + "editar' action='{{route('npj.processos.form')}}/" + processo.ID_PROCESSO + "' method='post'>"+
                            "<input type='hidden' name='id' value='" + processo.ID_PROCESSO + "'/>" +
                            "<input type='hidden' name='_token' value='" + token + "'/>" +
                            "<button class='btn btn-primary btn-clean' type='button' onclick=dialogEditar('" + processo.ID_PROCESSO + "')>" + 
                                "<span class='fa fa-pencil'/>" +
                            "</button>" +
                        "</form>",
                        "<button class='btn btn-primary btn-clean' onclick=dialogExcluir(" + processo.ID_PROCESSO + ")><span class='fa fa-user-times'/></button>",
                        "<form id='" + processo.ID_PROCESSO + "arquivar' action='/npj/processos/arquivar' method='post'>" + 
                            "<input type='hidden' name='id' value='" + processo.ID_PROCESSO + "'/>" +
                            "<input type='hidden' name='_token' value='" + token + "'/>" +
                            "<button class='btn btn-primary btn-clean' type='button' onclick=dialogArquivar('" + processo.ID_PROCESSO + "')><span class='fa fa-file-powerpoint-o'/></button>" +
                        "</form>"
                    ] ).index();
                tabela.rows(i).nodes().to$().attr("id", processo.ID_PROCESSO);
            }

            function dialogEditar(id){
                swal({
                    title: "Editar processo",
                    text: "Tem certeza que deseja editar o processo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não"
                }).then(function(){
            //        console.log('submeter');
                    document.getElementById(id + "editar").submit();
            //        var request = $.ajax({
            //            url: "/npj/processos/edit",
            //            type: "post",
            //            data: "id="+id
            //        });
            //
            //        request.done(function (msg) {
            //            swal({
            //                    title: "Sucesso!",
            //                    text: textoSucesso,
            //                    type: "success",
            //                    closeOnConfirm: true
            //                }).then (function(){
            //
            //                        if(isUpdate){
            //                            window.location.replace("/npj/clientes/form");
            //                        } else {
            //                            cleanForm($("#"+btnP)[0]);
            //                        }
            //                        // similar behavior as an HTTP redirect
            //                        // similar behavior as clicking on a link
            ////                                window.location.href = "http://stackoverflow.com";
            //
            //              });
            //        });
            //
            //        request.fail(function (jqXHR, textStatus) {
            //            swal("Erro!", textoErro1.textStatus, "error");
            //        });
                    
                }, function (dismiss) {
                    return false;
                });
            }


            function dialogExcluir(id){
                swal({  
                    title: "Excluir processo",
                    text: "Tem certeza que deseja excluir?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não"
                }).then(function(){
                    var retorno = processo.exluir(id);
                    if (retorno == "erro") {
                        swal("Erro!",  "Processo não foi excluído", "error");
                    } else if (retorno == 'temProcesso'){
                        swal("Erro!",  'Processo não foi excluído', "error");
                    } else {
                        swal("Sucesso!", "Processo excluído com sucesso!", "success");
                    }
                }, function (dismiss) {
                    swal('Cancelado!',  'Processo não foi excluído', 'error');
                });
                
            }

            function dialogArquivar(){
                swal({  
                    title: "Arquivar processo",
                    text: "Tem certeza que deseja arquivar o processo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não"
                }).then(function(){
            //        console.log('submeter');
                    document.getElementById(id + "arquivarProcesso").submit();
                }, function (dismiss) {
            //        console.log('nw submeter');
                    return false;
                });
            }

        </script>
    @endpush
    
@stop