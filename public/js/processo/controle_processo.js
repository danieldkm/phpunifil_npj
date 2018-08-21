class Processo {

    constructor(url, urlf) {
        this.urlp = url + "/";
        this.urlf = urlf + "/";
    }

    exluir(id) {

        var token = $('meta[name="csrf-token"]').attr('content');
        var request = $.ajax({
            url: this.urlp + id,
            type: "delete",
            data: {id: id, _token: token}
        });
        
        request.done(function (msg) {
            swal({
                    title: "Sucesso!",
                    text: "Processo excluído com sucesso!",
                    type: "success",
                    showConfirmButton: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        if(msg.indexOf("Processo") == -1){
                            swal({
                                title: "Processo com Processo",
                                text: "Cliente tem processo vinculado a ele, para excluír deve deletar o processo do mesmo!",
                                type: "warnig",
                                confirmButtonText: 'Sim',
                                showConfirmButton: true
                            });
                        } else {
                            $('#sortable-data').DataTable()
                                               .row( $("#"+msg) )
                                               .remove()
                                               .draw();    
                        }
                    }
              });
        });

        request.fail(function (jqXHR, textStatus) {
            swal("Erro!", "Erro ao tentar excluir o Cliente!", "error");
        });
    }


    inserir_processo(btnP, frmP, isUpdate, id){
        let titulo, texto, textoSucesso, textoErro1, textoErro2, urlp, urlf, aux_urlf = this.urlf;;
        if(isUpdate){
            titulo = "Atualizar Processo";
            texto = "Tem certeza que deseja atualizar?";
            textoSucesso = "Processo atualizado com sucesso!";
            textoErro1 = "Erro ao tentar atualizar o Processo!";
            textoErro2 = "Processo não foi atualizado!";
            urlp = this.urlp + id;
            metodo = "put";
        } else {
            titulo = "Cadastrar Processo";
            texto = "Tem certeza que deseja cadastrar?";
            textoSucesso = "Processo cadastrado com sucesso!";
            textoErro1 = "Erro ao tentar cadastrar o Processo!";
            textoErro2 = "Processo não foi cadastrado!";
            urlp = this.urlp;
            metodo = "post";
        }
        
        // console.log($("#" + frmP).serialize());
        // console.log("sq_funcionario " + $("#select-coordenador").val());
        // console.log(JSON.stringify(alunos));
        // console.log(urlp);
        // for (let i = 0; i < alunos.length; i++){
        //     console.log("["+i+"]=" + alunos[i]);
        // }
        
         swal({ title: titulo
                ,text: texto
                ,type: 'info'
                ,showCancelButton: true
                ,confirmButtonText: 'Sim'
                ,cancelButtonColor: '#DD6B55'
                ,cancelButtonText: 'Não'
                ,showConfirmButton: true
            }).then(function(){
                var request = $.ajax({
                    url: urlp,
                    type: metodo,
                    data: $("#" + frmP).serialize() + "&sq_funcionario=" + $("#select-coordenador").val() + "&jsonAlunos=" + JSON.stringify(alunos)
                });

                request.done(function (msg) {
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
                    swal("Erro!", textStatus, "error");
                });
            }, function (dismiss){
                swal('Cancelado!',  textoErro2, 'warning');
            }
        );
        return false;
    }
}

// var table_client;

// function requisitar_busca_cliente(id){
//     var token = $('meta[name="csrf-token"]').attr('content');
    
//     var request = $.ajax({
//         url: "/npj/processo/selecionarCliente",
//         type: "post",
//         data: {id: id, _token: token}
// //                    dataType: html
//     });
    
//     request.done(function (msg) {
// //        console.log("msg: " + msg);
//         swal({
//                 title: "Sucesso!",
//                 text: "Processo excluído com sucesso!",
//                 type: "success",
//                 closeOnConfirm: true
//             },
//             function(isConfirm){
//                 if (isConfirm) {
//                     if(msg.indexOf("Processo") !== -1){
//                         swal({
//                             title: "Processo com Processo",
//                             text: "Cliente tem processo vinculado a ele, para excluír deve deletar o processo do mesmo!",
//                             type: "warnig",
//                             confirmButtonText: 'Sim',
//                             closeOnConfirm: true
//                         });
//                     } else {
//                         $('#sortable-data').DataTable()
//                                            .row( $("#"+msg) )
//                                            .remove()
//                                            .draw();    
//                     }
//                 }
//           });
//     });
//     request.fail(function (jqXHR, textStatus) {
//         swal("Erro!", "Erro ao tentar excluir o Cliente!", "error");
//     });
// }

// function selecionarCliente(id){
//     swal({
//           title: 'Buscar cliente',
//           input: 'text',
//           showCancelButton: true,
//           inputValidator: function (value) {
//             return new Promise(function (resolve, reject) {
//                 console.log('informando o nome ');
//               if (value) {
//                   value = 'trocando valor';
//                 resolve()
//               } else {
//                 reject('Informe o nome do cliente')
//               }
//             })
//           }
//         }).then(function (result) {
//             var token = $('meta[name="csrf-token"]').attr('content');
    
//             var request = $.ajax({
//                 url: "/npj/processo/buscarCliente",
//                 type: "post",
//                 data: {nm_cliente: result, _token: token}
//         //                    dataType: html
//             });
        
            
//           swal({
//             type: 'error',
//             html: 'Cliente não existe: ' + result
//           })
//         })
    
// //    swal({
// //          title: 'Buscar Cliente',
// //          input: 'cliente',
// //          showCancelButton: true,
// //          confirmButtonText: 'Submit',
// //          showLoaderOnConfirm: true,
// //          preConfirm: function (cliente) {
// //            return new Promise(function (resolve, reject) {
// //              setTimeout(function() {
// //                if (cliente === 'taken@example.com') {
// //                  reject('This email is already taken.')
// //                } else {
// //                  resolve()
// //                }
// //              }, 2000)
// //            })
// //          },
// //          allowOutsideClick: false
// //        }).then(function (cliente) {
// //          swal({
// //            type: 'success',
// //            title: 'Ajax request finished!',
// //            html: 'Submitted email: ' + cliente
// //          })
// //        });
    
    
    
// }


// function exluir_processo(id) {
    
//     var token = $('meta[name="csrf-token"]').attr('content');
    
//     var request = $.ajax({
//         url: "/npj/processo/deleta",
//         type: "post",
//         data: {id: id, _token: token}
// //                    dataType: html
//     });
    
//     request.done(function (msg) {
// //        console.log("msg: " + msg);
//         swal({
//                 title: "Sucesso!",
//                 text: "Processo excluído com sucesso!",
//                 type: "success",
//                 closeOnConfirm: true
//             },
//             function(isConfirm){
//                 if (isConfirm) {
//                     if(msg.indexOf("Processo") !== -1){
//                         swal({
//                             title: "Processo com Processo",
//                             text: "Cliente tem processo vinculado a ele, para excluír deve deletar o processo do mesmo!",
//                             type: "warnig",
//                             confirmButtonText: 'Sim',
//                             closeOnConfirm: true
//                         });
//                     } else {
//                         $('#sortable-data').DataTable()
//                                            .row( $("#"+msg) )
//                                            .remove()
//                                            .draw();    
//                     }
//                 }
//           });
//     });
//     request.fail(function (jqXHR, textStatus) {
//         swal("Erro!", "Erro ao tentar excluir o Cliente!", "error");
//     });
// }


// function inserir_processo(btnP, frmP, isUpdate){
//     if(isUpdate){
//         titulo = "Atualizar Processo";
//         texto = "Tem certeza que deseja atualizar?";
//         textoSucesso = "Processo atualizado com sucesso!";
//         textoErro1 = "Erro ao tentar atualizar o Processo!";
//         textoErro2 = "Processo não foi atualizado!";
//     } else {
//         titulo = "Cadastrar Processo";
//         texto = "Tem certeza que deseja cadastrar?";
//         textoSucesso = "Processo cadastrado com sucesso!";
//         textoErro1 = "Erro ao tentar cadastrar o Processo!";
//         textoErro2 = "Processo não foi cadastrado!";
//     }
//     console.log($("#" + frmP).serialize());
//     console.log("sq_funcionario " + $("#select-coordenador").val());
//     console.log(JSON.stringify(alunos));
//     for (let i = 0; i < alunos.length; i++){
//         console.log("["+i+"]=" + alunos[i]);
//     }
    
//      swal({ title: titulo
//             ,text: texto
//             ,type: 'info'
//             ,showCancelButton: true
// //            ,confirmButtonColor: '#DD6B55'
//             ,confirmButtonText: 'Sim'
//             ,cancelButtonColor: '#DD6B55'
//             ,cancelButtonText: 'Não'
//             ,closeOnConfirm: false
//             ,closeOnCancel: false
//         }).then(function(){
//             var request = $.ajax({
//                 url: "/npj/processos",
//                 type: "post",
//                 data: $("#" + frmP).serialize() + "&sq_funcionario=" + $("#select-coordenador").val() + "&jsonAlunos=" + JSON.stringify(alunos)
//             });

//             request.done(function (msg) {
//                 console.log(msg);
// //                swal({
// //                        title: "Sucesso!",
// //                        text: textoSucesso,
// //                        type: "success",
// //                        closeOnConfirm: true
// //                    },
// //                    function(isConfirm){
// //                        if (isConfirm) {
// //                            if(isUpdate){
// //                                window.location.replace("/npj/processo/cadastro");
// //                            } else {
// //                                cleanForm($("#"+btnP)[0]);
// //                            }
// //                        }
// //                  });
//             });

//             request.fail(function (jqXHR, textStatus) {
//                 swal("Erro!", textStatus, "error");
//             });
//         }, function (dismiss){
//             swal('Cancelado!',  textoErro2, 'warning');
//         }
//     );

//     return false; // prevent further bubbling of event
    
// }


// //Inicio do controle da tabela de alunos
// var aluno = {
//     nrMatricula:"",
//     nmAluno: ""
// };

// var alunos = [];
// var indiceAlunos = 0;

// function excluirAluno(linha){
//     var i = linha.parentNode.parentNode.rowIndex;
//     document.getElementById("tabelaAluno").deleteRow(i);
//     if((i-1) != -1 ){
//         alunos.splice(i-1,1);
//         indiceAlunos--;
//     }
//     if(alunos.length == 0){
//         let div = document.getElementById("divAluno");
//         let divHead = document.getElementById("divHeadAluno");
//         let tabela = document.getElementById("tabelaAluno");
//         div.removeChild(divHead);
//         div.removeChild(tabela);
        
//         let divAluno = document.getElementById("divAluno");
//         divAluno.className = "";
//     }
// }


// function adicionarAluno(a){
//     //console.log($("#select-aluno").val());
//     //console.log($("#select-aluno").find("option:selected").text());
//     let tmpAluno = Object.assign({}, aluno);
//     tmpAluno.nrMatricula = $("#select-aluno").val();
//     tmpAluno.nmAluno = $("#select-aluno").find("option:selected").text();


//     let existe = false;
    
//     for (let i = 0; i < alunos.length; i++){
//         if (alunos[i].nrMatricula === tmpAluno.nrMatricula && alunos[i].nmAluno === tmpAluno.nmAluno){
//             existe = true;
// //            console.log("aluno ja existe " + tmpAluno);
//             document.getElementById("btnAvisoAluno").click();
//         }
//     }

//     if (!existe){
//         alunos[indiceAlunos] = tmpAluno;
//         indiceAlunos++;
//         let tmp_tabela = document.getElementById("tabelaAluno");
//         if(tmp_tabela == null){
//             let divHead = document.createElement("div");
//             divHead.className = "app-heading app-heading-small";
//             divHead.id = "divHeadAluno";
//             let divTitle = document.createElement("div");
//             divTitle.className = "title";
//             let h5 = document.createElement("h5");
//             h5.innerHTML = "Tabela de alunos";
//             let p = document.createElement("p");
//             p.innerHTML = "Alunos relacionados a este processo";

//             divTitle.appendChild(h5);
//             divTitle.appendChild(p);
//             divHead.appendChild(divTitle);
//             let divAluno = document.getElementById("divAluno");
//             divAluno.className = "col-lg-12 block";
//             divAluno.appendChild(divHead);

//             var tabelaAluno = document.createElement("table");
//             tabelaAluno.id = "tabelaAluno";
//             tabelaAluno.className = "table table-hover table-bordered";
//             var thead = document.createElement("thead");
// //            var tbody = document.createElement("tbody");


//             let tr = document.createElement("tr");
//             let th = document.createElement("th");
//             th.innerHTML = "Matrícula";
//             tr.appendChild(th);
//             th = document.createElement("th");
//             th.innerHTML = "Nome";
//             tr.appendChild(th);
//             th = document.createElement("th");
//             th.innerHTML = "Excluir aluno";
//             tr.appendChild(th);
//             thead.appendChild(tr);

//             tabelaAluno.appendChild(thead);
//             divAluno.appendChild(tabelaAluno);
//             adicionarLinha();
            
//         } else {
//             adicionarLinha();
//         }
//     }
// }

// function adicionarLinha(){
//     var tabelaAluno = document.getElementById("tabelaAluno");
// //    var tbody = document.createElement("tbody");
//     var tbody = document.getElementById("tabelaAluno").tBodies[0];
//     if (tbody == null || tbody == undefined) {
//         tbody = document.createElement("tbody");
//     }
//     tr = document.createElement("tr");
//     let td = document.createElement("td");
//     let span = document.createElement('span');
//     span.innerHTML = $("#select-aluno").val();
//     td.appendChild(span);
//     tr.appendChild(td);

//     td = document.createElement("td");
//     span = document.createElement('span');
//     span.innerHTML = $("#select-aluno").find("option:selected").text();
//     td.appendChild(span);
//     tr.appendChild(td);

//     let button = document.createElement("button");
//     button.className = "btn btn-primary btn-clean";
//     button.type = "button";
//     button.addEventListener('click', function() {
//         excluirAluno(this);
//     }, false);
    
//     span = document.createElement("span");
//     span.className = "fa fa-user-times";
//     button.appendChild(span);
//     td = document.createElement("td");
//     td.appendChild(button);
//     tr.appendChild(td);

//     tbody.appendChild(tr);
//     tabelaAluno.appendChild(tbody);
// }

// //Fim do controle da tabela de alunos

// //Inicio do controle de busca de alunos
// var tempo;
// var buscarValor = "";
// var t;
// var timeout = 1000;
// var lAlunos = [];
// var indiceLAluno = 0;

// function executarChamada(valor, input){
//     if(valor !== null){
//         var token = $('meta[name="csrf-token"]').attr('content');
//         showLoadingModal(nmLoading);
        
// //        lAlunos.length = 0;
//         var request = $.ajax({
//             url: "/npj/processo/buscarAlunos",
//             type: "post",
//             data: {valor: valor, _token: token}
//         //                    dataType: html
//         });

//         request.done(function (msg) {
// //                                    console.log("msg: " + msg);
//             var objs = JSON.parse(msg);
// //                                    console.log("objs: " + objs[0].nmAluno);
//             if(objs != null){
//                 if (lAlunos.length === 0) {
//                     var select = document.getElementById("select-aluno");
//                     while (select.firstChild) {
//                         select.removeChild(select.firstChild);
//                     }  
//                 }
//                 let existe = false;
//                 for (let i = 0; i < objs.length; i++){
//                     existe = false;
//                 //                                console.log("objs: " + objs[i].nmAluno);
// //                    console.log("ajax-tttt"+lAlunos[i].length);
//                      for(let j = 0; j < lAlunos.length; j++){
//                         if(lAlunos[j].nome.toUpperCase().indexOf(objs[i].nmAluno) >= 0 && lAlunos[j].matricula.toUpperCase().indexOf(objs[i].nrMatricula) >= 0){
//                            existe = true;
//                            break;
//                         }
//                     }
//                     if(!existe){
//                         $("#select-aluno").append('<option value="'+objs[i].nrMatricula+'">'+objs[i].nrMatricula+' - '+objs[i].nmAluno+'</option>');
//                         $("#select-aluno").selectpicker("refresh");
//                         let tmpAluno = Object.assign({}, aluno);
//                         tmpAluno.matricula = objs[i].nrMatricula;
//                         tmpAluno.nome = objs[i].nmAluno;
//                         lAlunos[indiceLAluno] = tmpAluno;
//                         indiceLAluno++;
//                     }
//                 }
//             }
//             hideLoadingModal(nmLoading);
//             input.readOnly = false;
//         });
//         request.fail(function (jqXHR, textStatus) {
//             hideLoadingModal(nmLoading);
//             input.readOnly = false;
//             console.log("Erro ao tentar buscar os alunos " + textStatus);
            
//         });
//     }
// }

// function buscarAlunos(valor){
// //    console.log(valor.value);
//     var startTime = new Date();
//     var startMsec =  startTime.getHours() + startTime.getMinutes() + startTime.getSeconds();
//     console.log("hours:" + startTime.getHours());
//     console.log("Minutes:" + startTime.getMinutes());
//     console.log("seconds:" + startTime.getSeconds());
//     let tempo_corrido;
//     if(tempo != null){
//         //                   console.log("passados " + (startMsec));
//         tempo_corrido = (startMsec - tempo);
//         //                   console.log("tempo_corrido " + (tempo_corrido));
//     } else {
//         //                    console.log("iniciou em " + startMsec);
//         tempnamo = startMsec;
//     }
//     //                document.write(elapsed);
//     //                setInterval(Function("slide();"), 3000);
//     let existe = false;
//     let valorBusca = valor.value.trim().toUpperCase();
//     for(let i = 0; i < lAlunos.length; i++){
//         let tmpNome = lAlunos[i].nome.substring(0, lAlunos[i].nome.indexOf(' '));
//         if(tmpNome.toUpperCase().indexOf(valorBusca) >= 0){
//            existe = true;
//            break;
//         }
//     }

//     if(!existe){
//         t = setTimeout(function(){
//             //                   console.log("iniciar timeout " + tempo_corrido + " > " + (timeout / 1000) + " buscarValor " + buscarValor);
//             if(buscarValor === ""){
//                 buscarValor = valor.value.trim();
//                 //                        console.log("chamar ajax " + buscarValor); 
//                 valor.readOnly = true;
//                 executarChamada(buscarValor, valor);
//             }

//             if(tempo_corrido > (timeout / 1000) && buscarValor != valor.value.trim()){
//                 //                       console.log("tempo_corrido1 " + tempo_corrido);
//                 tempo = startMsec;
//                 buscarValor = valor.value.trim();
//                 //                        console.log("chamarajax " + buscarValor);
//                 valor.readOnly = true;
//                 executarChamada(buscarValor, valor);
//             } else {
//                 tempo = startMsec;
//             //                       console.log("tempo_corrido2 " + tempo_corrido);
//             }
//             clearTimeout(t);
//         }, timeout);
//     }

// }
// //Fim do controle de busca de alunos

// function findBy(txt) {
//     showLoadingModal(idLoading);
//     var token = $('meta[name="csrf-token"]').attr('content');
//     var request = $.ajax({
//         url: "/npj/processos",
//         type: "get",
//         data: {texto: txt, _token: token}
// //                    dataType: html , _token: token
//     });
//     request.done(function (msg) {
// //        console.log("msg:" + msg);
//         let lista = JSON.parse(msg);
// //        console.log(lista);
//         popularTabela(lista);
//         hideLoadingModal(idLoading);
//     });
    
//     request.fail(function (jqXHR, textStatus) {
//         console.log("fail");
//         console.log(textStatus);
//         hideLoadingModal(idLoading);
//     });
// }

// var tabela;

// function arrayElements(element, index, array) {
//     addProcesso(element);
// }

// function popularTabela(processos){
//     tabela = $('#sortable-data').DataTable();
//     tabela.clear();
//     processos.forEach(arrayElements);
//     tabela.columns.adjust().draw();
// //    $('.app-sidebar').css("display","block");
// }

// function addProcesso(processo){
//     var token = $('meta[name="csrf-token"]').attr('content');
    
//     var i = tabela.row.add( [
//             processo.NR_PROCESSO,
//             processo.NM_CLIENTE,
//             processo.DS_POLO_ATIVO,
//             processo.DS_POLO_PASSIVO,
//             "<form id='" + processo.ID_PROCESSO + "editar' action='/npj/processos/form/edit' method='post'>"+
//                 "<input type='hidden' name='id' value='" + processo.ID_PROCESSO + "'/>" +
//                 "<input type='hidden' name='_token' value='" + token + "'/>" +
//                 "<button class='btn btn-primary btn-clean' type='button' onclick=dialogEditar('" + processo.ID_PROCESSO + "')>" + 
//                     "<span class='fa fa-pencil'/>" +
//                 "</button>" +
//             "</form>",
//             "<button class='btn btn-primary btn-clean' onclick=dialogExcluir(" + processo.ID_PROCESSO + ")><span class='fa fa-user-times'/></button>",
//             "<form id='" + processo.ID_PROCESSO + "arquivar' action='/npj/processos/arquivar' method='post'>" + 
//                 "<input type='hidden' name='id' value='" + processo.ID_PROCESSO + "'/>" +
//                 "<input type='hidden' name='_token' value='" + token + "'/>" +
//                 "<button class='btn btn-primary btn-clean' type='button' onclick=dialogArquivar('" + processo.ID_PROCESSO + "')><span class='fa fa-file-powerpoint-o'/></button>" +
//             "</form>"
//         ] ).index();
//     tabela.rows(i).nodes().to$().attr("id", processo.ID_PROCESSO);
// }

// function dialogEditar(id){
//     swal({
//         title: "Editar processo",
//         text: "Tem certeza que deseja editar o processo?",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Sim",
//         cancelButtonText: "Não"
//     }).then(function(){
// //        console.log('submeter');
//         document.getElementById(id + "editar").submit();
// //        var request = $.ajax({
// //            url: "/npj/processos/edit",
// //            type: "post",
// //            data: "id="+id
// //        });
// //
// //        request.done(function (msg) {
// //            swal({
// //                    title: "Sucesso!",
// //                    text: textoSucesso,
// //                    type: "success",
// //                    closeOnConfirm: true
// //                }).then (function(){
// //
// //                        if(isUpdate){
// //                            window.location.replace("/npj/clientes/form");
// //                        } else {
// //                            cleanForm($("#"+btnP)[0]);
// //                        }
// //                        // similar behavior as an HTTP redirect
// //                        // similar behavior as clicking on a link
// ////                                window.location.href = "http://stackoverflow.com";
// //
// //              });
// //        });
// //
// //        request.fail(function (jqXHR, textStatus) {
// //            swal("Erro!", textoErro1.textStatus, "error");
// //        });
        
        
        
//     }, function (dismiss) {
// //        console.log('nw submeter');
//         return false;
//     });
// }


// function dialogExcluir(id){
//     swal({	
//         title: "Excluir processo",
//         text: "Tem certeza que deseja excluir?",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Sim",
//         cancelButtonText: "Não"
//     }).then(function(){
//         var retorno = exluir_processo(id);
//         if (retorno == "erro") {
//             swal("Erro!",  "Processo não foi excluído", "error");
//         } else if (retorno == 'temProcesso'){
//             swal("Erro!",  'Processo não foi excluído', "error");
//         } else {
//             swal("Sucesso!", "Processo excluído com sucesso!", "success");
//         }
//     }, function (dismiss) {
//         swal('Cancelado!',  'Processo não foi excluído', 'error');
//     });
    
// }

// function dialogArquivar(){
//     swal({	
//         title: "Arquivar processo",
//         text: "Tem certeza que deseja arquivar o processo?",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Sim",
//         cancelButtonText: "Não"
//     }).then(function(){
// //        console.log('submeter');
//         document.getElementById(id + "arquivarProcesso").submit();
//     }, function (dismiss) {
// //        console.log('nw submeter');
//         return false;
//     });
// }

// function alterarCliente(){
//    id_cliente = $("#idCliente").val();
//    if (id_cliente == null){
//        selecionarCLiente();
//    } else {
//         swal({
//           title: 'Alterar cliente?',
//           text: "",
//           type: 'warning',
//           showCancelButton: true,
//           cancelButtonText: 'Não',
//           confirmButtonColor: '#3085d6',
//           cancelButtonColor: '#d33',
//           confirmButtonText: 'Alterar!'
//         }).then(function () {
//             window.location.href = "/npj/clientes";
//         }, function (dismiss) {
//           // dismiss can be 'cancel', 'overlay',
//           // 'close', and 'timer'
// //                      if (dismiss === 'cancel') {
// //                        swal(
// //                          'Cancelled',
// //                          'Your imaginary file is safe :)',
// //                          'error'
// //                        )
//           }
//         );   
//    }

// }