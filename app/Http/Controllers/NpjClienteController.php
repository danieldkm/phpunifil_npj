<?php

namespace app_unifil\Http\Controllers;

use Request;
use DB;
use app_unifil\NpjCliente;
use app_unifil\NpjProcesso;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use app_unifil\Http\Controllers\inicializar\Inicializar;


class NpjClienteController extends Controller
{
    private $npjClientes;
    private $npjClientes2;
    private static $cliente;
    private $inicial;
    
    public function __construct(){
        self::$cliente = new NpjCliente();
        $this->inicial = new Inicializar();
    }
    
    public function findAll(){
        $this->npjClientes = NpjCliente::all();
        //        $this->npjClientes = DB::select('select * from NPJ_CLIENTES');
    }
    public function findByName(){
        if(csrf_token() == Request::input("_token")){
            $this->findAll();
            if (Request::has("name")) {
                $name = Request::input("name");
//                $lista2 = collect();
                if ($name === " "){
                    echo $this->npjClientes->values();
                } else {
                    echo collect($this->npjClientes)->filter(function ($item) use ($name) {
                                                    return false !== stristr($item->NM_CLIENTE, $name);
                                                })->values();
//                    $lista = collect($this->npjClientes)->filter(function ($item) use ($name) {
//                                                    return false !== stristr($item->NM_CLIENTE, $name);
//                                                });
//                                        echo collect($this->npjClientes)->filter(function ($item) use ($name) {
//                                                    return false !== stristr($item->NM_CLIENTE, $name);
//                                                })->values();
//                    $found = $this->npjClientes2->search(function ($item, $key) {
//                            return $item->id_cliente == $cli->id_cliente;
//                        });
//
                }
            } else {
                echo $this->npjClientes->values();
            }
            
            
        } else {
            return view('page-npj-clientes')->with('clientes', $this->npjClientes)->with('inicial', $this->inicial);
        } 
    }
    
    public function viewCadastro(){
        // if(csrf_token() == Request::input("_token")){
            if (Request::has("id")){
//                self::$cliente = NpjCliente::find($this->descryptId(Request::input("id")));
                self::$cliente = NpjCliente::find(Request::input("id"));
            }
        // }
//        $this->findByNome("%Daniel%");
//        $this->findAll();
//        print_r($this->npjClientes);
//        echo count($this->npjClientes);
//        foreach ($this->npjClientes as $cli) {
//            echo $cli->NM_CLIENTE;
//            echo " === ";
//        }
//        echo self::$cliente;
        return view('page-npj-clientes-cadastrar')->with('cliente', self::$cliente)->with('inicial', $this->inicial);
    }

    public function viewClientes(){
        return view('page-npj-clientes')->with('inicial', $this->inicial);
    }
    
    private function uniquePost($posted, $formulario) {
        $descricao = "";
        if ($formulario === "pFisica"){
            $descricao = $posted['nome'].$posted['rg'].$posted['cpf'].$posted['nmLogradouro'].$posted['nrLogradouro'].$posted['bairro'].$posted['fone'].$posted['cel'].$posted['fax'].$posted['email'].$posted['complemento'];
        }else if ($formulario === "pJuridica"){
            $descricao = $posted['razaoSocial'].$posted['ie'].$posted['cnpj'].$posted['nmLogradouro'].$posted['nrLogradouro'].$posted['bairro'].$posted['fone'].$posted['cel'].$posted['fax'].$posted['email'].$posted['complemento'].$posted['contato'];
        }

        if (Request::session()->exists("form_hash") && Request::session("form_hash") == md5($descricao) ) { //se form_hash não for vazio e for igual ao md5 então retorna false pq o cliente ja foi adicionado
            $mostrarAlerta = false;
            return false;
        }
        Request::session()->put("form_hash", md5($descricao));
    //    $form_hash = md5($descricao);
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $formulario = Request::input("formulario");
            
            if($formulario === "pFisica"){
                $posted = ["nome" => Request::input('nome')
                      ,"rg" => Request::input('rg')
                      ,"cpf" => Request::input('cpf')
                      ,"nmLogradouro" => Request::input('nmLogradouro')
                      ,"nrLogradouro" => Request::input('nrLogradouro')
                      ,"bairro" => Request::input('bairro')
                      ,"fone" => Request::input('fone')
                      ,"cel" => Request::input('cel')
                      ,"fax" => Request::input('email')
                      ,"complemento" => Request::input('complemento')];
            } else if($formulario === "pJuridica") {
                $posted = ["razaoSocial" => Request::input('razaoSocial')
                      ,"ie" => Request::input('ie')
                      ,"cnpj" => Request::input('cnpj')
                      ,"nmLogradouro" => Request::input('nmLogradouro')
                      ,"nrLogradouro" => Request::input('nrLogradouro')
                      ,"bairro" => Request::input('bairro')
                      ,"fone" => Request::input('fone')
                      ,"cel" => Request::input('cel')
                      ,"fax" => Request::input('email')
                      ,"complemento" => Request::input('complemento')
                      ,"contato" => Request::input('contato')];
            }

            if ($this->uniquePost($_POST, $formulario) && csrf_token() == Request::input("_token")) {        
//                self::CLIENTE = new NpjCliente();

                if ($formulario === "pFisica"){
//                    $cliente->ID_CLIENTE = Request::input('nome');
                    self::$cliente->NM_CLIENTE = Request::input('nome');
                    self::$cliente->NR_DOCUMENTO_1 = Request::input('rg');  
                    self::$cliente->NR_DOCUMENTO_2 = Request::input('cpf');
                    self::$cliente->TP_PESSOA = "f";
                } else if ($formulario === "pJuridica") {
//                    $cliente->ID_CLIENTE = Request::input('razaoSocial');
                    self::$cliente->NM_CLIENTE = Request::input('razaoSocial');
                    self::$cliente->NR_DOCUMENTO_1 = Request::input('ie');
                    self::$cliente->NR_DOCUMENTO_2 = Request::input('cnpj');
                    self::$cliente->NM_CONTATO = Request::input('contato');
                    self::$cliente->TP_PESSOA = "j";
                }


                self::$cliente->NM_LOGRADOURO = Request::input('nmLogradouro');
                self::$cliente->NR_LOGRADOURO = Request::input('nrLogradouro');
                self::$cliente->NM_BAIRRO = Request::input('bairro');
                self::$cliente->NR_FONE = Request::input('fone');
                self::$cliente->NR_CELULAR = Request::input('cel');
                self::$cliente->NR_FAX = Request::input('fax');
                self::$cliente->DS_EMAIL = Request::input('email');
                self::$cliente->DS_COMPLEMENTO = Request::input('complemento');


                if(Request::has("id")){
                    $idCliente = Request::input("id");
//                    $id = $this->descryptId($idCliente);
                    $atualizarCliente = NpjCliente::find($idCliente);
                    $atualizarCliente->NM_CLIENTE     = self::$cliente->NM_CLIENTE;
                    $atualizarCliente->NR_DOCUMENTO_1 = self::$cliente->NR_DOCUMENTO_1;
                    $atualizarCliente->NR_DOCUMENTO_2 = self::$cliente->NR_DOCUMENTO_2;
                    $atualizarCliente->TP_PESSOA      = self::$cliente->TP_PESSOA;
                    $atualizarCliente->NM_CONTATO     = self::$cliente->NM_CONTATO;
                    $atualizarCliente->NM_LOGRADOURO  = self::$cliente->NM_LOGRADOURO;
                    $atualizarCliente->NR_LOGRADOURO  = self::$cliente->NR_LOGRADOURO;
                    $atualizarCliente->NM_BAIRRO      = self::$cliente->NM_BAIRRO;
                    $atualizarCliente->NR_FONE        = self::$cliente->NR_FONE;
                    $atualizarCliente->NR_CELULAR     = self::$cliente->NR_CELULAR;
                    $atualizarCliente->NR_FAX         = self::$cliente->NR_FAX;
                    $atualizarCliente->DS_EMAIL       = self::$cliente->DS_EMAIL;
                    $atualizarCliente->DS_COMPLEMENTO = self::$cliente->DS_COMPLEMENTO;
                    $atualizarCliente->save();
                } else {   
                    self::$cliente->save();
                }
//                echo "cliente ". $cliente;
                
                echo self::$cliente;
//                return redirect()->action('NpjClienteController@viewCadastro');
//                return view('page-npj-clientes-cadastrar')->with('cliente', self::$cliente);
            }
        } catch(Exception $e){
            echo "Erro('".$e."') ao tentar inserir na tabela NPJ_CLIENTES, entrar em contato com o TI da UniFil.";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($formulario === "pFisica"){

            self::$cliente->NM_CLIENTE = Request::input('nome');
            self::$cliente->NR_DOCUMENTO_1 = Request::input('rg');  
            self::$cliente->NR_DOCUMENTO_2 = Request::input('cpf');
            self::$cliente->TP_PESSOA = "f";
        } else if ($formulario === "pJuridica") {

            self::$cliente->NM_CLIENTE = Request::input('razaoSocial');
            self::$cliente->NR_DOCUMENTO_1 = Request::input('ie');
            self::$cliente->NR_DOCUMENTO_2 = Request::input('cnpj');
            self::$cliente->NM_CONTATO = Request::input('contato');
            self::$cliente->TP_PESSOA = "j";
        }


        self::$cliente->NM_LOGRADOURO = Request::input('nmLogradouro');
        self::$cliente->NR_LOGRADOURO = Request::input('nrLogradouro');
        self::$cliente->NM_BAIRRO = Request::input('bairro');
        self::$cliente->NR_FONE = Request::input('fone');
        self::$cliente->NR_CELULAR = Request::input('cel');
        self::$cliente->NR_FAX = Request::input('fax');
        self::$cliente->DS_EMAIL = Request::input('email');
        self::$cliente->DS_COMPLEMENTO = Request::input('complemento');


        $idCliente = Request::input($id);
//                    $id = $this->descryptId($idCliente);
        $atualizarCliente = NpjCliente::find($idCliente);
        $atualizarCliente->NM_CLIENTE     = self::$cliente->NM_CLIENTE;
        $atualizarCliente->NR_DOCUMENTO_1 = self::$cliente->NR_DOCUMENTO_1;
        $atualizarCliente->NR_DOCUMENTO_2 = self::$cliente->NR_DOCUMENTO_2;
        $atualizarCliente->TP_PESSOA      = self::$cliente->TP_PESSOA;
        $atualizarCliente->NM_CONTATO     = self::$cliente->NM_CONTATO;
        $atualizarCliente->NM_LOGRADOURO  = self::$cliente->NM_LOGRADOURO;
        $atualizarCliente->NR_LOGRADOURO  = self::$cliente->NR_LOGRADOURO;
        $atualizarCliente->NM_BAIRRO      = self::$cliente->NM_BAIRRO;
        $atualizarCliente->NR_FONE        = self::$cliente->NR_FONE;
        $atualizarCliente->NR_CELULAR     = self::$cliente->NR_CELULAR;
        $atualizarCliente->NR_FAX         = self::$cliente->NR_FAX;
        $atualizarCliente->DS_EMAIL       = self::$cliente->DS_EMAIL;
        $atualizarCliente->DS_COMPLEMENTO = self::$cliente->DS_COMPLEMENTO;
        $atualizarCliente->save();
        
        echo $atualizarCliente;
    }
    
    public function cadastrar(){
        try {
            $formulario = Request::input("formulario");
            
            if($formulario === "pFisica"){
                $posted = ["nome" => Request::input('nome')
                      ,"rg" => Request::input('rg')
                      ,"cpf" => Request::input('cpf')
                      ,"nmLogradouro" => Request::input('nmLogradouro')
                      ,"nrLogradouro" => Request::input('nrLogradouro')
                      ,"bairro" => Request::input('bairro')
                      ,"fone" => Request::input('fone')
                      ,"cel" => Request::input('cel')
                      ,"fax" => Request::input('email')
                      ,"complemento" => Request::input('complemento')];
            } else if($formulario === "pJuridica") {
                $posted = ["razaoSocial" => Request::input('razaoSocial')
                      ,"ie" => Request::input('ie')
                      ,"cnpj" => Request::input('cnpj')
                      ,"nmLogradouro" => Request::input('nmLogradouro')
                      ,"nrLogradouro" => Request::input('nrLogradouro')
                      ,"bairro" => Request::input('bairro')
                      ,"fone" => Request::input('fone')
                      ,"cel" => Request::input('cel')
                      ,"fax" => Request::input('email')
                      ,"complemento" => Request::input('complemento')
                      ,"contato" => Request::input('contato')];
            }

            if ($this->uniquePost($_POST, $formulario) && csrf_token() == Request::input("_token")) {        
//                self::CLIENTE = new NpjCliente();

                if ($formulario === "pFisica"){
//                    $cliente->ID_CLIENTE = Request::input('nome');
                    self::$cliente->NM_CLIENTE = Request::input('nome');
                    self::$cliente->NR_DOCUMENTO_1 = Request::input('rg');  
                    self::$cliente->NR_DOCUMENTO_2 = Request::input('cpf');
                    self::$cliente->TP_PESSOA = "f";
                } else if ($formulario === "pJuridica") {
//                    $cliente->ID_CLIENTE = Request::input('razaoSocial');
                    self::$cliente->NM_CLIENTE = Request::input('razaoSocial');
                    self::$cliente->NR_DOCUMENTO_1 = Request::input('ie');
                    self::$cliente->NR_DOCUMENTO_2 = Request::input('cnpj');
                    self::$cliente->NM_CONTATO = Request::input('contato');
                    self::$cliente->TP_PESSOA = "j";
                }


                self::$cliente->NM_LOGRADOURO = Request::input('nmLogradouro');
                self::$cliente->NR_LOGRADOURO = Request::input('nrLogradouro');
                self::$cliente->NM_BAIRRO = Request::input('bairro');
                self::$cliente->NR_FONE = Request::input('fone');
                self::$cliente->NR_CELULAR = Request::input('cel');
                self::$cliente->NR_FAX = Request::input('fax');
                self::$cliente->DS_EMAIL = Request::input('email');
                self::$cliente->DS_COMPLEMENTO = Request::input('complemento');


                if(Request::has("id")){
                    $idCliente = Request::input("id");
//                    $id = $this->descryptId($idCliente);
                    $atualizarCliente = NpjCliente::find($idCliente);
                    $atualizarCliente->NM_CLIENTE     = self::$cliente->NM_CLIENTE;
                    $atualizarCliente->NR_DOCUMENTO_1 = self::$cliente->NR_DOCUMENTO_1;
                    $atualizarCliente->NR_DOCUMENTO_2 = self::$cliente->NR_DOCUMENTO_2;
                    $atualizarCliente->TP_PESSOA      = self::$cliente->TP_PESSOA;
                    $atualizarCliente->NM_CONTATO     = self::$cliente->NM_CONTATO;
                    $atualizarCliente->NM_LOGRADOURO  = self::$cliente->NM_LOGRADOURO;
                    $atualizarCliente->NR_LOGRADOURO  = self::$cliente->NR_LOGRADOURO;
                    $atualizarCliente->NM_BAIRRO      = self::$cliente->NM_BAIRRO;
                    $atualizarCliente->NR_FONE        = self::$cliente->NR_FONE;
                    $atualizarCliente->NR_CELULAR     = self::$cliente->NR_CELULAR;
                    $atualizarCliente->NR_FAX         = self::$cliente->NR_FAX;
                    $atualizarCliente->DS_EMAIL       = self::$cliente->DS_EMAIL;
                    $atualizarCliente->DS_COMPLEMENTO = self::$cliente->DS_COMPLEMENTO;
                    $atualizarCliente->save();
                } else {   
                    self::$cliente->save();
                }
//                echo "cliente ". $cliente;
                
                echo self::$cliente;
//                return redirect()->action('NpjClienteController@viewCadastro');
//                return view('page-npj-clientes-cadastrar')->with('cliente', self::$cliente);
            }
        } catch(Exception $e){
            echo "Erro('".$e."') ao tentar inserir na tabela NPJ_CLIENTES, entrar em contato com o TI da UniFil.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $idCliente = Request::input($id);
        try {
            
//                $id = Crypt::decryptString($idCliente);
            $processo = NpjProcesso::where("ID_CLIENTE", "=", $idCliente)->first();
            
            if(is_null($processo)){
                $cliente = NpjCliente::find($idCliente);
                $cliente->delete();
                echo $idCliente;
            } else {
                echo "Existe Processo(".$processo->ID_PROCESSO.") para esse cliente";
            }
            
        } catch (DecryptException $e) {
            echo $e;
        } catch (Exception $e) {
            echo $e;
        }
    }

    
    public function deletar(){
        
        // if(csrf_token() == Request::input("_token")){
            $idCliente = Request::input("id");
            try {
                
//                $id = Crypt::decryptString($idCliente);                  
                $processo = NpjProcesso::where("ID_CLIENTE", "=", $idCliente)->first();
                
                if(is_null($processo)){
                    $cliente = NpjCliente::find($idCliente);
                    $cliente->delete();
                    echo $idCliente;    
                } else {
                    echo "Existe Processo(".$processo->ID_PROCESSO.") para esse cliente";
                }
                
                
            } catch (DecryptException $e) {
                echo $e;
            } catch (Exception $e) {
                echo $e;
            }
        // }
    }
    
    public function editar(){
        return view('page-npj-clientes-cadastrar');
    }
    
    public function descryptId($id){
        return Crypt::decryptString($id);
    }

    public function getTabela(){
        $this->findAll();
        
//        $this->protector = new Protector();
        
//        $this->inicial->setHasOnLoad(false);
        $tabela =   "<div id='tabelaPopulada'>".
                        "<table class='table table-bordered datatable-extended table-hover' id='sortable-data'>".
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
        /*
        ID_CLIENTE
        NM_CLIENTE
        NM_CONTATO
        NR_DOCUMENTO_1
        NR_DOCUMENTO_2
        TP_PESSOA
        NM_LOGRADOURO
        NR_LOGRADOURO
        NM_BAIRRO
        NR_FONE
        NR_CELULAR
        NR_FAX
        DS_EMAIL
        DS_COMPLEMENTO
        */
        
        foreach ($this->npjClientes as $cli) {
            $id = Crypt::encryptString($cli->ID_CLIENTE);
            
            $tabela .=          "<tr id='".$id."'>".
                                    utf8_encode("<td>".$cli->NM_CLIENTE."</td>").
                                    "<td>".$cli->TP_PESSOA."</td>".
                                    utf8_encode("<td>".$cli->NM_CONTATO."</td>").
                                    "<td>".$cli->DS_EMAIL."</td>".
                                    "<td>".$cli->NR_FONE."</td>".
                                    "<td>".$cli->NR_CELULAR."</td>".
                                    "<td>".
                                        "<form id='".$id."vincularProcesso' action='/npj/cliente/vincularProcesso' method='post'>".
                                            "<input type='hidden' name='id' value='".$id."'/>".
                                            "<input type='hidden' name='_token' value='".csrf_token()."'/>".
//                                            "<button class='btn btn-primary btn-clean' type='submit'><span class='fa fa-file-powerpoint-o'/></button>".
                                            "<button class='btn btn-primary btn-clean' type='button' onclick=\"swal({	title: 'Vincular processo'".
                                                                                                                    ",text: 'Tem certeza que deseja vincular um processo?'".
                                                                                                                    ",type: 'warning'".
                                                                                                                    ",showCancelButton: true".
                                                                                                                    ",confirmButtonColor: '#DD6B55'".
                                                                                                                    ",confirmButtonText: 'Sim'".
                                                                                                                    ",cancelButtonText: 'Não'".
                                                                                                                "}).then(".
                                                                                                                "function(){".
                                                                                                                    "console.log('submeter');". "document.getElementById('".$id."vincularProcesso').submit();".
                                                                                                                "}, function (dismiss) {".
                                                                                                                    "console.log('nw submeter');".
                                                                                                                    "return false;".
                                                                                                                "}".
                                                                                                                ");".
                                                                                                        "\"><span class='fa fa-file-powerpoint-o'/></button>".
                                        "</form>".
                                    "</td>".
                                    "<td>".
                                        "<form id='".$id."editarCliente' action='/npj/cliente/editar' method='post'>".
                                            "<input type='hidden' name='id' value='".$id."'/>".
                                            "<input type='hidden' name='_token' value='".csrf_token()."'/>".
//                                            "<button class='btn btn-primary btn-clean' type='submit'><span class='fa fa-pencil'/></button>".
                                            "<button class='btn btn-primary btn-clean' type='button' onclick=\"swal({	title: 'Editar cliente'".
                                                                                                                    ",text: 'Tem certeza que deseja editar o cliente?'".
                                                                                                                    ",type: 'warning'".
                                                                                                                    ",showCancelButton: true".
                                                                                                                    ",confirmButtonColor: '#DD6B55'".
                                                                                                                    ",confirmButtonText: 'Sim'".
                                                                                                                    ",cancelButtonText: 'Não'".
                                                                                                                "}).then(".
                                                                                                                "function(){".
                                                                                                                    "console.log('submeter');". "document.getElementById('".$id."editarCliente').submit();".
                                                                                                                "}, function (dismiss) {".
                                                                                                                    "console.log('nw submeter');".
                                                                                                                    "return false;".
                                                                                                                "}".
                                                                                                                ");".
                                                                                                        "\"><span class='fa fa-pencil'/></button>".
                                        "</form>".
                                    "</td>".
                                    "<td>".
                //                "<form action method='post'>", //='deletar-cliente.php'
                //                    "<input type='hidden' name='idCliente' value='".$cli->getIdCliente()."'/>",
                
                      
                                    "<button class='btn btn-primary btn-clean' onclick=\"swal({	title: 'Excluir cliente'".
                                                                                                ",text: 'Tem certeza que deseja excluir?'".
                                                                                                ",type: 'warning'".
                                                                                                ",showCancelButton: true".
                                                                                                ",confirmButtonColor: '#DD6B55'".
                                                                                                ",confirmButtonText: 'Sim'".
                                                                                                ",cancelButtonText: 'Não'".
//                                                                                                ",confirmButtonClass: 'btn btn-success'".
//                                                                                                ",cancelButtonClass: 'btn btn-danger'".
//                                                                                                ",buttonsStyling: false".
                                                                                            "}).then(".
                                                                                            "function(){".
                                                                                                "var retorno = exluir_cliente('".$id."');".
                                                                                                "if (retorno == 'erro') {".
                                                                                                    "swal('Erro!',  'Cliente não foi excluído', 'error');".
                                                                                                "} else if (retorno == 'temProcesso'){".    
                                                                                                    "swal('Erro!',  'Cliente não foi excluído', 'error');".
                                                                                                "} else {".
                                                                                                    "swal('Sucesso!', 'Cliente excluído com sucesso!', 'success');".
                                                                                                "}".
                                                                                            "}, function (dismiss) {".
                                                                                                "swal('Cancelado!',  'Cliente não foi excluído', 'error');".
                                                                                            "}".
                                                                                            ");".
                                                                                    "\"><span class='fa fa-user-times'/></button>".
                //                $sa->getConfirmAlert("", "exluir_cliente('".$cli->getIdCliente()."');").
                //                "</form>",
                                    "</td>".
                                "</tr>";
        }
        $tabela .=          "</tbody>".
                        "</table>".
                    "</div>";
        
//        return view('page-npj-clientes-buscar')
//            ->with('tabela', $tabela)
//            ->with('inicial', $this->inicial);
        
        return view('page-npj-clientes')->with('clientes', $this->npjClientes)->with('inicial', $this->inicial);
        
    }
   
    
}
