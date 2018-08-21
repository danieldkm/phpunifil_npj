<?php 
    $inicial->setTitulo("UniFil - Buscar clientes");
    session_start();
//@extends('partials.layouts.default-without-footer', ["hasClass" => true , "class" => "modal-open"])
?>


@extends('partials.layouts.default', ["hasonload" => false])

@section('content')
    @push('css')
       
       @include("partials.styles.{$inicial->getModalLoading()->getNameInclude()}")
       @if ($inicial->getModalLoading()->getNameInclude() !== "loading-type3")
       @endif
    @endpush
    @include('partials.headers.default')
    @include("partials.ui.loadings.{$inicial->getModalLoading()->getNameInclude()}", ["isHide" => false])
    <!-- START PAGE HEADING hideLoad()-->
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
                    <example></example>
                    <h5>Tabela de clientes</h5>
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
                        <div class="col-lg-12" id="tv">
                            <label for="Buscar clientes">Buscar clientes</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="popup" class="col-lg-11 popup" onclick="showHint('hintBusca')">
                            <input id="txtBuscaCliente" class="form-control" type="text" />
                            <span class="popuptext" id="hintBusca">Informe o nome do cliente</span>
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-primary btn-clean" onclick="cliente.findByName(document.getElementById('txtBuscaCliente').value)">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END HEADING -->
            <!-- START TABLE CLIENTE -->
            <div id="tabelaCliente" class="block-content">
                <table class='table table-bordered datatable-extended table-hover' id='sortable-data' width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tipo</th>
                            <th>Contato</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Adicionar Processo</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- END TABLE CLIENTE -->
            <!-- <button onclick="startWorker({{{$inicial->getModalLoading()->getId()}}})">startWorker</button>  -->
        </div>
    </div>
    <!-- END PAGE CONTAINER -->
    
    @push('javascript')
        @include('partials.scripts.table')
        @include('partials.scripts.table-export')
        <script type='text/javascript' src='/js/cliente/controle_cliente.js'></script>
        <script>
            var idLoading = "{{$inicial->getModalLoading()->getId()}}";
            var cliente = new Cliente("{{route('npj.clientes')}}", "{{route('npj.clientes.form')}}");
            var tabela;

            function arrayElements(element, index, array) {
                addCliente(element);
            }

            function popularTabela2(clientes){
                tabela = $('#sortable-data').DataTable();
                tabela.clear();
                clientes.forEach(arrayElements);
                tabela.columns.adjust().draw();
                $('.app-sidebar').css("display","block");
            }

            function dialogVincularProcesso(id){
                swal({
                    title: 'Vincular processo',
                    text: 'Tem certeza que deseja vincular um processo?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then(function(){
                        document.getElementById(id + 'vincularProcesso').submit();
                    }, 
                    function (dismiss) {
                        return false;
                    });
            }

            function dialogEditar(id){
                swal({  
                    title: 'Editar cliente',
                    text: 'Tem certeza que deseja editar o cliente?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then(
                    function(){
                        document.getElementById(id + 'editar').submit();
                    }, function (dismiss) {
                        return false;
                    }
                );
            }

            function dialogDeletar(id) {
               swal({   
                   title: 'Excluir cliente',
                   text: 'Tem certeza que deseja excluir?',
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#DD6B55',
                   confirmButtonText: 'Sim',
                   cancelButtonText: 'Não'
               }).then(
                   function(){
                       var retorno = cliente.exluir_cliente(id);
                       if (retorno == 'erro') {
                           swal('Erro!',  'Cliente não foi excluído', 'error');
                       } else if (retorno == 'temProcesso'){
                           swal('Erro!',  'Cliente não foi excluído', 'error');
                       } else {
                           swal('Sucesso!', 'Cliente excluído com sucesso!', 'success');
                       }
                   }, function (dismiss) {
                       swal('Cancelado!',  'Cliente não foi excluído', 'error');
                   }
               ); 
            }

            function addCliente(cliente){
                var token = $('meta[name="csrf-token"]').attr('content');
                //npj/processos/{id?}/vincular/{idCli}
                //npj/processos/{novo}/vincular/{idCli}
                var i = tabela.row.add( [
                        cliente.NM_CLIENTE,
                        cliente.TP_PESSOA,
                        cliente.NM_CONTATO,
                        cliente.DS_EMAIL,
                        cliente.NR_FONE,
                        cliente.NR_CELULAR,
                        "<form id='" + cliente.ID_CLIENTE + "vincularProcesso' action='{{route('npj.processos.vincular')}}/" + cliente.ID_CLIENTE + "' method='post'>"+
                            "<input type='hidden' name='id' value='" + cliente.ID_CLIENTE + "'/>" +
                            "<input type='hidden' name='_token' value='" + token + "'/>" +
                            "<button class='btn btn-primary btn-clean' type='button' onclick=dialogVincularProcesso('" + cliente.ID_CLIENTE + "')>" + 
                                "<span class='fa fa-file-powerpoint-o'/>" +
                            "</button>" +
                        "</form>",
                        "<form id='" + cliente.ID_CLIENTE + "editar' action='{{route('npj.clientes.form')}}/" + cliente.ID_CLIENTE + "' method='get'>" + 
                            "<input type='hidden' name='id' value='" + cliente.ID_CLIENTE + "'/>" +
                            "<input type='hidden' name='_token' value='" + token + "'/>" +
                            "<button class='btn btn-primary btn-clean' type='button' onclick=dialogEditar('" + cliente.ID_CLIENTE + "')><span class='fa fa-pencil'/></button>" +
                        "</form>",
                        "<button class='btn btn-primary btn-clean' onclick=dialogDeletar('" + cliente.ID_CLIENTE + "')><span class='fa fa-user-times'/></button>"
                    ] ).index();
                tabela.rows(i).nodes().to$().attr("id", cliente.ID_CLIENTE);
            }

            function startWorker() {
                tabela = $('#sortable-data').DataTable();
                cliente.findByName("daniel");
                
                if(typeof(Worker) !== "undefined") {
                    
                    if(typeof(w) == "undefined") {
                        console.log("iniciar o work");
                        w = new Worker("/js/cliente/worker_cliente.js");
                    }
                    
                    w.onmessage = function(event) {
                        console.log("onmessage:");
                        console.log(event.data);
                    };
                } else {
                    console.log("Sorry, your browser does not support Web Workers...");
                }
            }
        </script>
        @include('partials.scripts.page-inicial')
    @endpush
    
@stop