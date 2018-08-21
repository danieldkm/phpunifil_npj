class Cliente {

    constructor(url, urlf) {
        this.urlc = url + "/";
        this.urlf = urlf + "/";
    }

    exluir_cliente(id) {
    
        var token = $('meta[name="csrf-token"]').attr('content');
        
        var request = $.ajax({
            url: this.urlc + id,
            type: "delete",
            data: {_token: token}
    //                    dataType: html
        });
        
        var retorno;
        
        request.done(function (msg) {
            
            if(msg.toUpperCase().indexOf("ERRO") !== -1){
                swal({
                    title: "Erro",
                    text: msg,
                    type: "Error",
                    confirmButtonText: 'Sim',
                    howConfirmButton: true
                });
                retorno = "Erro";
                
            } else if(msg.indexOf("Processo") !== -1){
                swal({
                    title: msg,
                    text: "Cliente tem processo vinculado a ele, para excluír deve deletar o processo do mesmo!",
                    type: "warning",
                    confirmButtonText: 'Sim',
                    showConfirmButton: true
                });
                retorno = "temProcesso";
            } else {
                // console.log("idCLiente:" + Number(msg));
                swal({
                    title: "Sucesso!",
                    text: "Cliente excluído com sucesso!",
                    type: "success"
                }).then (
                    function(){
                        $('#sortable-data').DataTable()
                                   .row( $("#"+Number(msg)) )
                                   .remove()
                                   .draw();
                    
                });
                retorno = "ok";
            }
        });
        
        request.fail(function (jqXHR, textStatus) {
            retorno = "erro";
        });
        
        
        return retorno;
    }


    inserir_cliente(btnP, frmP, isUpdate, id){
        let titulo = "", textoSucesso, textoErro1, textoErro2, metodo, aux_url, texto = "", aux_urlf = this.urlf;
        if(isUpdate){
            titulo = "Atualizar Cliente";
            texto = "Tem certeza que deseja atualizar?";
            textoSucesso = "Cliente atualizado com sucesso!";
            textoErro1 = "Erro ao tentar atualizar o Cliente!";
            textoErro2 = "Cliente não foi atualizado!";
            metodo = "put";
            aux_url = this.urlc + id;
        } else {
            titulo = "Cadastrar Cliente";
            texto = "Tem certeza que deseja cadastrar?";
            textoSucesso = "Cliente cadastrado com sucesso!";
            textoErro1 = "Erro ao tentar cadastrar o Cliente!";
            textoErro2 = "Cliente não foi cadastrado!";
            metodo = "post";
            aux_url = this.urlc;
        }

        swal({
            title: titulo,
            text: texto,
            type: "info",
            showCancelButton: true,
    //           ,confirmButtonColor: '#DD6B55'
            confirmButtonText: "Sim",
            cancelButtonColor: "#DD6B55",
            cancelButtonText: "Não"
        }).then(function(){
                
            var request = $.ajax({
                url: aux_url,
                type: metodo,
                data: $("#" + frmP).serialize()
            });

            request.done(function (msg) {
                // console.log(msg);
                if(msg.indexOf("erro") == -1) {
                    swal({
                        title: "Sucesso!",
                        text: textoSucesso,
                        type: "success",
                        showConfirmButton: true
                    }).then (function() {
                        if (isUpdate) {
                            window.location.replace(aux_urlf);
                        } else {
                            cleanForm($("#"+btnP)[0]);
                        }
                    });
                }
            });

            request.fail(function (jqXHR, textStatus) {
                swal("Erro!", textoErro1.textStatus, "error");
            });
        }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal('Cancelado!',  textoErro2, 'warning');
                }
                
            }
        );

        return false;
    }


    findByName(nmCliente) {
        showLoadingModal(idLoading);
        var token = $('meta[name="csrf-token"]').attr('content');
        var request = $.ajax({
            url: this.urlc + nmCliente,
            type: "get",
            data: {name: nmCliente, _token: token}
    //                    dataType: html , _token: token
        });
        
        request.done(function (msg) {
    //        console.log("msg:" + msg);
            
            let lista = JSON.parse(msg);
    //        console.log(lista);
            popularTabela2(lista);
            hideLoadingModal(idLoading);
        });
        
        request.fail(function (jqXHR, textStatus) {
            // console.log("fail");
            // console.log(textStatus);
            hideLoadingModal(idLoading);
        });
    }

}

// function exluir_cliente(id) {
    
//     var token = $('meta[name="csrf-token"]').attr('content');
    
//     var request = $.ajax({
//         url: "/npj/clientes/" + id,
//         type: "delete",
//         data: {_token: token}
// //                    dataType: html
//     });
    
//     var retorno;
    
//     request.done(function (msg) {
// //        swal("Sucesso!", "Cliente excluido com sucesso!" + msg, "success");
//         if(msg.toUpperCase().indexOf("ERRO") !== -1){
//             swal({
//                 title: "Erro",
//                 text: msg,
//                 type: "Error",
//                 confirmButtonText: 'Sim',
//                 closeOnConfirm: true
//             });
//             retorno = "Erro";
            
//         } else if(msg.indexOf("Processo") !== -1){
//             swal({
//                 title: "Cliente com Processo",
//                 text: "Cliente tem processo vinculado a ele, para excluír deve deletar o processo do mesmo!",
//                 type: "warnig",
//                 confirmButtonText: 'Sim',
//                 closeOnConfirm: true
//             });
//             retorno = "temProcesso";
//         } else {
//             swal({
//                 title: "Sucesso!",
//                 text: "Cliente excluído com sucesso!",
//                 type: "success"
//             }).then (
//                 function(){
//                     $('#sortable-data').DataTable()
//                                .row( $("#"+msg) )
//                                .remove()
//                                .draw();
                
//             });
//             retorno = "ok";
//         }
//     });
    
//     request.fail(function (jqXHR, textStatus) {
//         retorno = "erro";
//     });
    
    
//     return retorno;
// }


// function inserir_cliente(btnP, frmP, isUpdate, id){
//     if(isUpdate){
//         titulo = "Atualizar Cliente";
//         texto = "Tem certeza que deseja atualizar?";
//         textoSucesso = "Cliente atualizado com sucesso!";
//         textoErro1 = "Erro ao tentar atualizar o Cliente!";
//         textoErro2 = "Cliente não foi atualizado!";
//         metodo = "put";
//         aux_url = "/npj/clientes/" + id;
//     } else {
//         titulo = "Cadastrar Cliente";
//         texto = "Tem certeza que deseja cadastrar?";
//         textoSucesso = "Cliente cadastrado com sucesso!";
//         textoErro1 = "Erro ao tentar cadastrar o Cliente!";
//         textoErro2 = "Cliente não foi cadastrado!";
//         metodo = "post";
//         aux_url = "/npj/clientes";
//     }    
//      swal({
//          title: titulo,
//          text: texto,
//          type: "info",
//          showCancelButton: true,
// //            ,confirmButtonColor: '#DD6B55'
//          confirmButtonText: "Sim",
//          cancelButtonColor: "#DD6B55",
//          cancelButtonText: "Não"
//         }).then(function(){
//             var request = $.ajax({
//                 url: aux_url,
//                 type: metodo,
//                 data: $("#" + frmP).serialize()
//             });

//             request.done(function (msg) {
//                 swal({
//                         title: "Sucesso!",
//                         text: textoSucesso,
//                         type: "success",
//                         closeOnConfirm: true
//                     }).then (function(){

//                             if(isUpdate){
//                                 window.location.replace("/npj/clientes/form");
//                             } else {
//                                 cleanForm($("#"+btnP)[0]);
//                             }
//                             // similar behavior as an HTTP redirect
//                             // similar behavior as clicking on a link
// //                                window.location.href = "http://stackoverflow.com";

//                   });
//             });

//             request.fail(function (jqXHR, textStatus) {
//                 swal("Erro!", textoErro1.textStatus, "error");
//             });
//         }, function (dismiss){
//             if (dismiss === 'cancel') {
//                 swal('Cancelado!',  textoErro2, 'warning');
//             }
            
//         }
//     );

//     return false; // prevent further bubbling of event
    
// }


// function findByName(nmCliente){
//     showLoadingModal(idLoading);
//     var token = $('meta[name="csrf-token"]').attr('content');
//     var request = $.ajax({
//         url: "/npj/clientes/" + nmCliente,
//         type: "get",
//         data: {name: nmCliente, _token: token}
// //                    dataType: html , _token: token
//     });
    
//     request.done(function (msg) {
// //        console.log("msg:" + msg);
        
//         let lista = JSON.parse(msg);
// //        console.log(lista);
//         popularTabela2(lista);
//         hideLoadingModal(idLoading);
//     });
    
//     request.fail(function (jqXHR, textStatus) {
//         // console.log("fail");
//         // console.log(textStatus);
//         hideLoadingModal(idLoading);
//     });
// }

// var tabela;

// function arrayElements(element, index, array) {
// //    console.log("a[" + index + "] = " + element.NM_CLIENTE);
//     addCliente(element);
// }

// function popularTabela2(clientes){
//     tabela = $('#sortable-data').DataTable();
//     tabela.clear();
//     clientes.forEach(arrayElements);
    
// //    $('#container').css( 'display', 'block' );
// //    tabela = $('#sortable-data').DataTable({"sScrollX": "100%"});
//     tabela.columns.adjust().draw();
//     $('.app-sidebar').css("display","block");
// //    $('#sortable-data').DataTable({"sScrollX": "100%"});
// }

// function dialogVincularProcesso(id){
//     swal({
//         title: 'Vincular processo',
//         text: 'Tem certeza que deseja vincular um processo?',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#DD6B55',
//         confirmButtonText: 'Sim',
//         cancelButtonText: 'Não'
//     }).then(function(){
// //            console.log('submeter');
//             document.getElementById(id + 'vincularProcesso').submit();
//         }, 
//         function (dismiss) {
// //            console.log('nw submeter');
//             return false;
//         });
// }

// function dialogEditar(id){
//     swal({	
//         title: 'Editar cliente',
//         text: 'Tem certeza que deseja editar o cliente?',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#DD6B55',
//         confirmButtonText: 'Sim',
//         cancelButtonText: 'Não'
//     }).then(
//         function(){
// //            console.log('submeter'); 
//             document.getElementById(id + 'editar').submit();
//         }, function (dismiss) {
// //            console.log('nw submeter');
//             return false;
//         }
//     );
// }

// function dialogDeletar(id){
//    swal({	
//        title: 'Excluir cliente',
//        text: 'Tem certeza que deseja excluir?',
//        type: 'warning',
//        showCancelButton: true,
//        confirmButtonColor: '#DD6B55',
//        confirmButtonText: 'Sim',
//        cancelButtonText: 'Não'
//    }).then(
//        function(){
//            var retorno = exluir_cliente(id);
//            if (retorno == 'erro') {
//                swal('Erro!',  'Cliente não foi excluído', 'error');
//            } else if (retorno == 'temProcesso'){
//                swal('Erro!',  'Cliente não foi excluído', 'error');
//            } else {
//                swal('Sucesso!', 'Cliente excluído com sucesso!', 'success');
//            }
//        }, function (dismiss) {
//            swal('Cancelado!',  'Cliente não foi excluído', 'error');
//        }
//    ); 
// }

// function addCliente(cliente){
//     var token = $('meta[name="csrf-token"]').attr('content');
//     //npj/processos/{id?}/vincular/{idCli}
//     //npj/processos/{novo}/vincular/{idCli}
//     var i = tabela.row.add( [
//             cliente.NM_CLIENTE,
//             cliente.TP_PESSOA,
//             cliente.NM_CONTATO,
//             cliente.DS_EMAIL,
//             cliente.NR_FONE,
//             cliente.NR_CELULAR,
//             "<form id='" + cliente.ID_CLIENTE + "vincularProcesso' action='/npj/processos/vincular/cliente' method='post'>"+
//                 "<input type='hidden' name='id' value='" + cliente.ID_CLIENTE + "'/>" +
//                 "<input type='hidden' name='_token' value='" + token + "'/>" +
//                 "<button class='btn btn-primary btn-clean' type='button' onclick=dialogVincularProcesso('" + cliente.ID_CLIENTE + "')>" + 
//                     "<span class='fa fa-file-powerpoint-o'/>" +
//                 "</button>" +
//             "</form>",
//             "<form id='" + cliente.ID_CLIENTE + "editar' action='/npj/clientes/form/" + cliente.ID_CLIENTE + "' method='get'>" + 
//                 "<input type='hidden' name='id' value='" + cliente.ID_CLIENTE + "'/>" +
//                 "<input type='hidden' name='_token' value='" + token + "'/>" +
//                 "<button class='btn btn-primary btn-clean' type='button' onclick=dialogEditar('" + cliente.ID_CLIENTE + "')><span class='fa fa-pencil'/></button>" +
//             "</form>",
//             "<button class='btn btn-primary btn-clean' onclick=dialogDeletar('" + cliente.ID_CLIENTE + "')><span class='fa fa-user-times'/></button>"
//         ] ).index();
//     tabela.rows(i).nodes().to$().attr("id", cliente.ID_CLIENTE);
// }

// function buscarCliente(nome){
    
// }

// function startWorker() {
//     tabela = $('#sortable-data').DataTable();
//     findByName("daniel");
    
//     if(typeof(Worker) !== "undefined") {
        
//         if(typeof(w) == "undefined") {
//             console.log("iniciar o work");
//             w = new Worker("/js/cliente/worker_cliente.js");
//         }
        
//         w.onmessage = function(event) {
//             //document.getElementById("result").innerHTML = event.data;
//             console.log("onmessage:");
//             console.log(event.data);
// //            createTableCliente(event.data);
//         };
        
// //        w.addEventListener('message', function(e) {
// //            console.log(e.data);
// //            popularTabela(clientes);
// //        }, false);
        
// //        w.postMessage({'cmd': 'start', 'msg': 'just start', 'clientes': clientes});
//     } else {
// //        document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Workers...";
//         console.log("Sorry, your browser does not support Web Workers...");
//     }
// }
