<?php
    
    
    $inicial->setTitulo("UniFil - Cadastro de processos");
    $inicial->getBtnLimpar()->setValue("form-processo");
    $formId = "form-processo";
    $btnNmForm = "Validar & Salvar";
    $nmCliente = "";
    $isUpdate = "false";

//    session_start();
    
    if (!is_null($processo->ID_PROCESSO)) {
        $btnNmForm = "Validar & Atualizar"; 
        $isUpdate = "true";
    }
?>

@extends('partials.layouts.default-without-footer', ["hasClass" => true , "class" => "modal-open"])

@section('content')
   @push('css')
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
       @include("partials.styles.{$inicial->getModalLoading()->getNameInclude()}")
   @endpush
    @include('partials.headers.default')
    <pre>
        <?php
           print_r($processo);
            
        ?>
    </pre>
    @include("partials.ui.loadings.{$inicial->getModalLoading()->getNameInclude()}", ["isHide" => false])
<!--    <button class="btn btn-primary btn-clean" id="animado" onClick="flipAnimated('animado')" type="button">Teste</button>-->
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="icon icon-lg">
            <span class="icon-new-tab"></span>
        </div>
        <div class="title">
            <h2>{{{$inicial->getSubTitulo()}}}</h2>
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
            <li><a href="/npj/processo/cadastro">Cadastrar</a></li>
            <li class="active">Processo</li>
        </ul>
    </div>
    <!-- END PAGE HEADING -->       
   
    <!-- BLOCK -->
    <div class="block">
        <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="icon">
                <span class="fa fa-file-powerpoint-o"></span>
            </div>
            <div class="title">
                <h2>{{{$inicial->getSubTitulo()}}}</h2>
                <!--                                    <p>Curabitur sollicitudin porttitor erat</p>-->
            </div>
            <div class="heading-elements">
                @include('partials.ui.buttons.with-icon')
            </div>
        </div>
        <!-- END HEADING -->
        <!-- START FORMS -->
        <div class="container">
            <form id="{{{$formId}}}" class="form-horizontal" role="form" method="post" onSubmit="return processo.inserir_processo('{{{$inicial->getBtnLimpar()->getId()}}}', '{{{$formId}}}', {{{$isUpdate}}}, {{$processo->ID_PROCESSO}})">
                <div class="form-group">
                    <div class="col-lg-6"> 
                        <label>Nº do Processo</label>
                        <input class="form-control" name="nrProcesso" placeholder="" value="{{{$processo->NR_PROCESSO}}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Vara</label>
                        <input type="text" class="form-control" name="vara" placeholder="" value="{{{$processo->DS_VARA}}}" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8">
                        <label>Cliente</label>
                        <div class="input-group">
                            <span class="input-group-btn">
<!--                                <button class="btn btn-primary btn-clean" data-toggle="modal" data-target="#modal-default" type="button" ></button> data-toggle="modal" data-target="#modal-default" data-backdrop="static"-->
                                <button type="button" class="btn btn-primary btn-clean" onclick="alterarCliente()"><span class="fa fa-binoculars"/></button>
                            </span>
                            @if (!is_null($processo->ID_CLIENTE))
                                <input type="hidden" id="idCliente" name="idCliente" value="{{{$processo->ID_CLIENTE}}}">
                            @else
                                <input type="hidden" id="idCliente" name="idCliente" value="{{{$cliente->ID_CLIENTE}}}">
                            @endif
                            <input type="text" class="form-control" placeholder="Cliente" name="cliente"  data-validation="required" value="{{{$cliente->NM_CLIENTE}}}" disabled>
                        </div>
                        <span class="help-block">*</span>
                    </div>
                    <div class="col-lg-4">
                        <label>Data da 1º Audiência</label>
                        <div class="input-group">
                            <input type="text" class="form-control bs-datepicker" name="dataAudiencia" value="{{{$processo->DT_PRIM_AUDIENCIA}}}">
                            <span class="input-group-addon">
                                <span class="icon-calendar-full"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <label>Comarca</label>
                        <input type="text" class="form-control" name="comarca" placeholder="" value="{{{$processo->DS_COMARCA}}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Cartório</label>
                        <input type="text" class="form-control" name="cartorio" placeholder="" value="{{{$processo->DS_CARTORIO}}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <label>Polo Ativo</label>
                        <input type="text" class="form-control" name="poloAtivo" placeholder="" value="{{{$processo->DS_POLO_ATIVO}}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Polo Passivo</label>
                        <input type="text" class="form-control" name="poloPassivo" placeholder="" value="{{{$processo->DS_POLO_PASSIVO}}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <label>Professor Orientador *</label>
<!--                        <select class="bs-select form-control" data-live-search="true" value="$processo->SQ_FUNCIONARIO" data-validation="required" required form="{{$formId}}" name="orientador">-->
                        <select id="select-coordenador" class="bs-select" data-live-search="true">
                            @forelse($orientadores as $orientador)
                                @if ($processo->SQ_FUNCIONARIO == $orientador->SQ_ORIENTADOR)
                                    <option value="{{{$orientador->SQ_ORIENTADOR}}}" selected="selected">{{{$orientador->NM_ORIENTADOR}}}</option>
                                @else
                                    <option value="{{{$orientador->SQ_ORIENTADOR}}}">{{{$orientador->NM_ORIENTADOR}}}</option>
                                @endif
                            @empty
                                <option value="Vazio">Vazio</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Alunos *</label>
                        <div class="form-group">
                            <div class="col-lg-9">
                                <select class="bs-select" id="select-aluno" data-live-search="true" data-validation="required" >
                                    @if (!is_null($alunos))
                                        @forelse($alunos as $aluno)
                                            <option value="{{{$aluno->nrMatricula}}}">{{{$aluno->nmAluno}}}</option>
                                        @empty
                                            <option value="Vazio">Digite o nome para popular</option>
                                        @endforelse
                                    @else
                                        <option value="Vazio">Digite o nome para popular</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <button id="btnAdicionarAluno" class="btn btn-primary btn-clean" type="button" onclick="flipAnimated(this.id); adicionarAluno(this);"><span class="fa fa-graduation-cap"/>Adicionar aluno</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div id="divAluno">
                         @if (!is_null($alunos))
                           <div class="app-heading app-heading-small" id="divHeadAluno"><div class="title"><h5>Tabela de alunos</h5><p>Alunos relacionados a este processo</p></div></div>
                           <table id="tabelaAluno" class="table table-hover table-bordered">
                               <thead>
                                   <tr>
                                       <th>Matrícula</th>
                                       <th>Nome</th>
                                       <th>Excluir aluno</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @forelse($alunos as $a)
                                <tr>
                                    <td><span>{{{$a->nrMatricula}}}</span></td>
                                    <td><span>{{{$a->nmAluno}}}</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-clean" onclick="excluirAluno(this)" type="button">
                                            <span class="fa fa-user-times"></span>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                ?>
                            <!--$a->nmAluno-$a->nrMatricula -->
                            @empty
                            <!--VAZIO-->
                            @endforelse
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>    
                <div class="form-group margin-top-20">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if (!is_null($processo->ID_PROCESSO))
                        <?php 
                            $id = Crypt::encryptString($processo->ID_PROCESSO);
                        ?>
                        <input type="hidden" name="id" value="{{{$id}}}"/>
                    @endif
                    <button id="btnSalvar" class="btn btn-primary btn-clean" type="submit" onclick="return flipAnimated(this.id);"><span class="fa fa-save"/> {{{$btnNmForm}}}</button>
                </div>
            </form>
            <!-- END FORMS -->
        </div>
    </div>
    <!-- END BLOCK -->
<!--    {{{$inicial->getModalLoading()->getNameInclude()}}}-->
    <!-- START MODAL LOADING TYPE 1 -->
    
<!--    <button id="btn-close-modal" onclick="closeModal()" style="display: none;"/>-->
    <!-- END MODAL LOADING TYPE 1 -->
    <input id="btnAvisoAluno" type="hidden" class="btn btn-default notify" data-notify-type="warning" data-notify="<strong>Aviso!</strong>Aluno já relacionado(a)!">
    
    @push('javascript')
        @include('partials.scripts.validador')
        @include('partials.scripts.date-picker')
        @include('partials.scripts.select')
        @include('partials.scripts.page-inicial')
        @include('partials.scripts.noty')
        <script type="text/javascript" src="/js/processo/controle_processo.js"></script>
         
        <script>
            var processo = new Processo("{{route('npj.processos')}}", "{{route('npj.processos.form')}}");
            var aluno = {
                nrMatricula:"",
                nmAluno: ""
            };

            var alunos = [];
            var indiceAlunos = 0;
            let tmpAluno;

            @if(!is_null($alunos))
                @forelse($alunos as $a) 

            tmpAluno = Object.assign({}, aluno);
            tmpAluno.nrMatricula = "{{{$a->nrMatricula}}}";
            tmpAluno.nmAluno = "{{{$a->nmAluno}}}";
            alunos[indiceAlunos] = tmpAluno;
            indiceAlunos++;  
                @empty    
                @endforelse
            @endif 
                
           var nmLoading = "{{{$inicial->getModalLoading()->getId()}}}";
           
            
            function closeBlock(){
//                setTimeout($.unblockUI, 1000);
                $.unblockUI;
            }
           
            function teste2(){
                console.log("testeSwal");
                swal({
                  title: 'Input something',
                  input: 'text',
                  showCancelButton: true,
                  inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {
                      if (value) {
                        resolve()
                      } else {
                        reject('You need to write something!')
                      }
                    })
                  }
                }).then(function (result) {
                  swal({
                    type: 'success',
                    html: 'You entered: ' + result
                  })
                });
            }
            
             function alterarCliente(){
                id_cliente = $("#idCliente").val();
                if (id_cliente == null){
                    selecionarCLiente();
                } else {
                     swal({
                       title: 'Alterar cliente?',
                       text: "",
                       type: 'warning',
                       showCancelButton: true,
                       cancelButtonText: 'Não',
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Alterar!'
                     }).then(function () {
                         window.location.href = "/npj/clientes";
                     }, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                       // 'close', and 'timer'
             //                      if (dismiss === 'cancel') {
             //                        swal(
             //                          'Cancelled',
             //                          'Your imaginary file is safe :)',
             //                          'error'
             //                        )
                       }
                     );   
                }
            }

//Inicio do controle da tabela de alunos
            function excluirAluno(linha){
                var i = linha.parentNode.parentNode.rowIndex;
                document.getElementById("tabelaAluno").deleteRow(i);
                if((i-1) != -1 ){
                    alunos.splice(i-1,1);
                    indiceAlunos--;
                }
                if(alunos.length == 0){
                    let div = document.getElementById("divAluno");
                    let divHead = document.getElementById("divHeadAluno");
                    let tabela = document.getElementById("tabelaAluno");
                    div.removeChild(divHead);
                    div.removeChild(tabela);
                    
                    let divAluno = document.getElementById("divAluno");
                    divAluno.className = "";
                }
            }

            function adicionarAluno(a){
                let tmpAluno = Object.assign({}, aluno);
                tmpAluno.nrMatricula = $("#select-aluno").val();
                tmpAluno.nmAluno = $("#select-aluno").find("option:selected").text();

                let existe = false;
                
                for (let i = 0; i < alunos.length; i++){
                    if (alunos[i].nrMatricula === tmpAluno.nrMatricula && alunos[i].nmAluno === tmpAluno.nmAluno){
                        existe = true;
                        document.getElementById("btnAvisoAluno").click();
                    }
                }

                if (!existe){
                    alunos[indiceAlunos] = tmpAluno;
                    indiceAlunos++;
                    let tmp_tabela = document.getElementById("tabelaAluno");
                    if(tmp_tabela == null){
                        let divHead = document.createElement("div");
                        divHead.className = "app-heading app-heading-small";
                        divHead.id = "divHeadAluno";
                        let divTitle = document.createElement("div");
                        divTitle.className = "title";
                        let h5 = document.createElement("h5");
                        h5.innerHTML = "Tabela de alunos";
                        let p = document.createElement("p");
                        p.innerHTML = "Alunos relacionados a este processo";

                        divTitle.appendChild(h5);
                        divTitle.appendChild(p);
                        divHead.appendChild(divTitle);
                        let divAluno = document.getElementById("divAluno");
                        divAluno.className = "col-lg-12 block";
                        divAluno.appendChild(divHead);

                        var tabelaAluno = document.createElement("table");
                        tabelaAluno.id = "tabelaAluno";
                        tabelaAluno.className = "table table-hover table-bordered";
                        var thead = document.createElement("thead");

                        let tr = document.createElement("tr");
                        let th = document.createElement("th");
                        th.innerHTML = "Matrícula";
                        tr.appendChild(th);
                        th = document.createElement("th");
                        th.innerHTML = "Nome";
                        tr.appendChild(th);
                        th = document.createElement("th");
                        th.innerHTML = "Excluir aluno";
                        tr.appendChild(th);
                        thead.appendChild(tr);

                        tabelaAluno.appendChild(thead);
                        divAluno.appendChild(tabelaAluno);
                        adicionarLinha();
                        
                    } else {
                        adicionarLinha();
                    }
                }
            }

            function adicionarLinha(){
                var tabelaAluno = document.getElementById("tabelaAluno");
                var tbody = document.getElementById("tabelaAluno").tBodies[0];
                if (tbody == null || tbody == undefined) {
                    tbody = document.createElement("tbody");
                }
                tr = document.createElement("tr");
                let td = document.createElement("td");
                let span = document.createElement('span');
                span.innerHTML = $("#select-aluno").val();
                td.appendChild(span);
                tr.appendChild(td);

                td = document.createElement("td");
                span = document.createElement('span');
                span.innerHTML = $("#select-aluno").find("option:selected").text();
                td.appendChild(span);
                tr.appendChild(td);

                let button = document.createElement("button");
                button.className = "btn btn-primary btn-clean";
                button.type = "button";
                button.addEventListener('click', function() {
                    excluirAluno(this);
                }, false);
                
                span = document.createElement("span");
                span.className = "fa fa-user-times";
                button.appendChild(span);
                td = document.createElement("td");
                td.appendChild(button);
                tr.appendChild(td);

                tbody.appendChild(tr);
                tabelaAluno.appendChild(tbody);
            }
//Fim do controle da tabela de alunos
//Inicio do controle de busca de alunos
         var tempo;
         var buscarValor = "";
         var t;
         var timeout = 1000;
         var lAlunos = [];
         var indiceLAluno = 0;

         function executarChamada(valor, input){
             if(valor !== null){
                 var token = $('meta[name="csrf-token"]').attr('content');
                 showLoadingModal(nmLoading);

         //        lAlunos.length = 0;
                 var request = $.ajax({
                     url: "/npj/processo/buscarAlunos",
                     type: "post",
                     data: {valor: valor, _token: token}
                 //                    dataType: html
                 });

                 request.done(function (msg) {
         //                                    console.log("msg: " + msg);
                     var objs = JSON.parse(msg);
         //                                    console.log("objs: " + objs[0].nmAluno);
                     if(objs != null){
                         if (lAlunos.length === 0) {
                             var select = document.getElementById("select-aluno");
                             while (select.firstChild) {
                                 select.removeChild(select.firstChild);
                             }  
                         }
                         let existe = false;
                         for (let i = 0; i < objs.length; i++){
                             existe = false;
                         //                                console.log("objs: " + objs[i].nmAluno);
         //                    console.log("ajax-tttt"+lAlunos[i].length);
                              for(let j = 0; j < lAlunos.length; j++){
                                 if(lAlunos[j].nome.toUpperCase().indexOf(objs[i].nmAluno) >= 0 && lAlunos[j].matricula.toUpperCase().indexOf(objs[i].nrMatricula) >= 0){
                                    existe = true;
                                    break;
                                 }
                             }
                             if(!existe){
                                 $("#select-aluno").append('<option value="'+objs[i].nrMatricula+'">'+objs[i].nrMatricula+' - '+objs[i].nmAluno+'</option>');
                                 $("#select-aluno").selectpicker("refresh");
                                 let tmpAluno = Object.assign({}, aluno);
                                 tmpAluno.matricula = objs[i].nrMatricula;
                                 tmpAluno.nome = objs[i].nmAluno;
                                 lAlunos[indiceLAluno] = tmpAluno;
                                 indiceLAluno++;
                             }
                         }
                     }
                     hideLoadingModal(nmLoading);
                     input.readOnly = false;
                 });
                 request.fail(function (jqXHR, textStatus) {
                     hideLoadingModal(nmLoading);
                     input.readOnly = false;
                     console.log("Erro ao tentar buscar os alunos " + textStatus);

                 });
             }
         }

         function buscarAlunos(valor){
         //    console.log(valor.value);
             var startTime = new Date();
             var startMsec =  startTime.getHours() + startTime.getMinutes() + startTime.getSeconds();
             console.log("hours:" + startTime.getHours());
             console.log("Minutes:" + startTime.getMinutes());
             console.log("seconds:" + startTime.getSeconds());
             let tempo_corrido;
             if(tempo != null){
                 //                   console.log("passados " + (startMsec));
                 tempo_corrido = (startMsec - tempo);
                 //                   console.log("tempo_corrido " + (tempo_corrido));
             } else {
                 //                    console.log("iniciou em " + startMsec);
                 tempnamo = startMsec;
             }
             //                document.write(elapsed);
             //                setInterval(Function("slide();"), 3000);
             let existe = false;
             let valorBusca = valor.value.trim().toUpperCase();
             for(let i = 0; i < lAlunos.length; i++){
                 let tmpNome = lAlunos[i].nome.substring(0, lAlunos[i].nome.indexOf(' '));
                 if(tmpNome.toUpperCase().indexOf(valorBusca) >= 0){
                    existe = true;
                    break;
                 }
             }

             if(!existe){
                 t = setTimeout(function(){
                     //                   console.log("iniciar timeout " + tempo_corrido + " > " + (timeout / 1000) + " buscarValor " + buscarValor);
                     if(buscarValor === ""){
                         buscarValor = valor.value.trim();
                         //                        console.log("chamar ajax " + buscarValor); 
                         valor.readOnly = true;
                         executarChamada(buscarValor, valor);
                     }

                     if(tempo_corrido > (timeout / 1000) && buscarValor != valor.value.trim()){
                         //                       console.log("tempo_corrido1 " + tempo_corrido);
                         tempo = startMsec;
                         buscarValor = valor.value.trim();
                         //                        console.log("chamarajax " + buscarValor);
                         valor.readOnly = true;
                         executarChamada(buscarValor, valor);
                     } else {
                         tempo = startMsec;
                     //                       console.log("tempo_corrido2 " + tempo_corrido);
                     }
                     clearTimeout(t);
                 }, timeout);
             }

         }
 //Fim do controle de busca de alunos
            
        </script>
    @endpush
    
    
    
@stop


