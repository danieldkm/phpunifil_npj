<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/InicializarCliente.php");
    if (!isset($fullPath)){
        require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
    }
    require_once($fullPath."php/ui/modals/SweetAlert.php");
    require_once($fullPath."php/ui/buttons/WithIcon.php");
    
    
    $sa = new SweetAlert();
    $sa->setTitle("Excluir cliente");
    $sa->setText("Tem certeza que deseja excluir?");
    $sa->setSuccessText("Cliente excluído com sucesso!");
    $sa->setSuccessTitle("Sucesso!");
    $sa->setErrorText("Cliente não foi excluído");
    $sa->setErrorTitle("Cancelado!");
    
    
    
    $btExcluir = new WithIcon("", "fa fa-user-times");
    $btExcluir->getClasses()->setColor("primary");
    $btExcluir->getClasses()->setType("clean");
    
    $btIcon = new WithIcon("", "fa fa-pencil");
    $btIcon->getClasses()->setColor("primary");
    $btIcon->getClasses()->setType("clean");   
    
    echo 
            "<div id='tabelaPopulada'>".
//         "<html lang='pt-br'>".
//            "<head>".
//                "<meta charset='UTF-8'>".
//                "<title>Populando a tabela cliente</title>".
//            "</head>".
//         "<body>".
//            "<div>".
            "<table class='table table-striped table-bordered datatable-extended' id='sortable-data'>".
              "<thead>".
                  "<tr>".
                      "<th>Name</th>".
                      "<th>Tipo</th>".
                      "<th>Contato</th>".
                      "<th>E-mail</th>".
                      "<th>Telefone</th>".
                      "<th>Celular</th>".
                      "<th>Adicionar Processo</th>".
                      "<th>Editar</th>".
                      "<th>Excluir</th>".
                  "</tr>".
              "</thead>".
              "<tbody>";

    $service = new ServiceCliente();
    $clientes = $service->findAll();
    
    $btExcluir->setColor("primary");
    $btExcluir->setType("clean");
    $sa->setButton($btExcluir);
    foreach($clientes as $cli){
        echo 
                "<tr id='".$cli->getIdCliente()."'>".
                    utf8_encode("<td>".$cli->getNmCliente()."</td>").
                    "<td>".$cli->getTpPessoa()."</td>".
                    utf8_encode("<td>".$cli->getNmContato()."</td>").
                    "<td>".$cli->getDsEmail()."</td>".
                    "<td>".$cli->getNrFone()."</td>".
                    "<td>".$cli->getNrCelular()."</td>".
                    "<td>".
                        "<button class='btn btn-primary btn-clean'><span class='fa fa-file-powerpoint-o'/></button>".
                //        echo $sa->getConfirmAlert("");
                    "</td>".
                    "<td>".
                        "<form action='page-npj-clientes-cadastrar.php' method='post'>".
                            "<input type='hidden' name='idCliente' value='".$cli->getIdCliente()."'/>".
                            "<input type='hidden' name='tpPessoa' value='".$cli->getTpPessoa()."'/>".
                            "<button class='btn btn-primary btn-clean' type='submit'><span class='fa fa-pencil'/></button>".
                        "</form>".
                    "</td>".
                    "<td>".
                //                "<form action method='post'>", //='deletar-cliente.php'
                //                    "<input type='hidden' name='idCliente' value='".$cli->getIdCliente()."'/>",
                //                    "<button class='btn btn-primary btn-clean' onclick='showAlerta(true, \"popularTabela.php\")'><span class='fa fa-user-times'/></button>",
                        $sa->getConfirmAlert("", "exluir_cliente('".$cli->getIdCliente()."');").
                //                "</form>",
                    "</td>".
                "</tr>";
    }
    echo 
            "</tbody>".
         "</table>".
//            . "<script type='text/javascript' src='http://http://localhost:81/npj/js/vendor/datatables/jquery.dataTables.min.js'></script>'
//        <script type='text/javascript' src='http://http://localhost:81/npj/js/vendor/datatables/dataTables.bootstrap.min.js'></script>".
        "</div>";
//            $scriptImportanteInclude.
//            $tabela.
//            $scriptAppInclude.
//"</body></html></div>";
    
    
