<?php

namespace app_unifil\Http\Controllers;

use Request;
use DB;
//use Illuminate\Support\Facades\DB;
use app_unifil\NpjProcesso;
use app_unifil\NpjCliente;
use app_unifil\NpjAlunoProcesso;
use app_unifil\CacAlunosCurso;
use app_unifil\CacAlunos;
use app_unifil\Alunos;
use app_unifil\Http\Controllers\inicializar\Inicializar;
use app_unifil\NpjOrientador;

use app_unifil\Http\Html\util\UtilDocument;
use app_unifil\Http\Html\Attribute;
use app_unifil\Http\Html\Document;
use app_unifil\Http\Html\Element;
use app_unifil\Http\Html\Table;
use app_unifil\Http\Html\TBody;
use app_unifil\Http\Html\THead;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
//use Illuminate\Support\Collection;



class NpjProcessoController extends Controller
{
    private static $processo;
    private $npjProcessos;
    private $inicial;
    private $alunos;
    private $util;
    
    public function __construct(){
        self::$processo = new NpjProcesso();
        $this->inicial = new Inicializar();
        $this->inicial->subTitulo = 'Cadastro de processo';
    }
    
    public function findAll(){
        $this->npjProcessos = NpjProcesso::all();
        $this->findNmCliente();
    }
    
    public function findById($id){
        $this->npjProcessos = NpjProcesso::ofId($id)->get();
//        $this->npjProcessos = NpjProcesso::find($id);
        $this->findNmCliente();
    }
    
    public function findByNrProcesso($nr){
//        $this->npjProcessos = NpjProcesso::ofNrProcesso($nr)->get();
        $this->npjProcessos = NpjProcesso::where("NR_PROCESSO", "LIKE", $nr)->get();
        $this->findNmCliente();
    }
    
    public function findByArquivado(){
        $this->npjProcessos = NpjProcesso::ofArquivado('S')->get();
        $this->findNmCliente();
    }
    
    public function findNmCliente(){
        if(!is_null($this->npjProcessos)){
            foreach($this->npjProcessos as $processo){
                $processo->setAttribute('NM_CLIENTE', $this->findByNomeCliente($processo->ID_CLIENTE));
            }    
        }
    }
    
    public function findByNomeCliente($idCliente){
        return NpjCliente::find($idCliente)->NM_CLIENTE;
    }
    
    public function findByParam(){
        if(csrf_token() == Request::input("_token")){
            
            if (Request::has("texto")) {
                $texto = Request::input("texto");
                $atributo = null;
                
                if (false !== stristr($texto, ":")) {
                    $upperStr = strtoupper($texto);
                    $atributo = substr($upperStr, 0, strpos($upperStr, ":"));
                    $texto = substr($texto, strpos($texto, ":") + 1, strlen($texto));
                }
//                echo $atributo.':'.$texto;
                $this->findAll();
//                if (is_null($atributo)) {
//                    $this->findByNrProcesso("%$texto%");
////                    echo collect($this->npjProcessos)->where('NR_PROCESSO', 'LIKE', "%$texto%")->values();
//                    echo $this->npjProcessos->values();
//                } else {
                    echo collect($this->npjProcessos)->filter(
                                            function ($item) use ($texto, $atributo) {
                                                if (is_null($atributo)) {
                                                    return false !== stristr($item->NR_PROCESSO, $texto);
                                                } else {
                                                    if ($atributo === "ID_PROCESSO"){
                                                        return $item->ID_PROCESSO == $texto;
                                                    } else if ($atributo === "ID_CLIENTE") {
                                                        return $item->ID_CLIENTE == $texto;
                                                    } else if ($atributo === "CLIENTE") {
                                                        return false !== stristr($item->NM_CLIENTE, $texto);
                                                    } else if ($atributo === "PROCESSO") {
                                                        return false !== stristr($item->NR_PROCESSO, $texto);
    //                                                    return $item->ID_PROCESSO == $texto;
                                                    }
                                                }
                                            })->values();    
//                }
            } else {
                if (is_null($this->npjProcessos)) {
                    echo "[]";
                } else {
                    echo $this->npjProcessos->values();
                }
            }
        } else {
            echo view('page-npj-processos')
            ->with('inicial', $this->inicial);
//            ->with('json', $json);
        }
    }
    
    public function findJoinCliente(){
        $coluna = "NM_CLIENTE";
//        DB::select(DB::raw('select * from users''));
//        $this->npjProcessos = NpjProcesso::select(NpjProcesso::raw("select np.*, nc.NM_CLIENTE from NPJ_PROCESSOS np, NPJ_CLIENTES nc WHERE np.ID_CLIENTE = nc.ID_CLIENTE"));
        $testes = DB::table('NPJ_PROCESSOS')
            ->join('NPJ_CLIENTES', 'NPJ_CLIENTES.ID_CLIENTE', '=', 'NPJ_PROCESSOS.ID_CLIENTE')->get();
        
        echo "INICIAR LOOP ".sizeof($testes);
//        foreach ($testes as $pro) {
//            echo $pro;
//        }
        //$this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
//        $this->$npjProcessos = NpjProcesso::OfCliente()->get();
//        $this->$npjProcessos = NpjProcesso::join("NPJ_CLIENTES","NPJ_PROCESSOS.ID_CLIENTE", "=", "NPJ_CLIENTES.ID_CLIENTE")
//        $pro = $this->npjProcessos[1]->joinCliente()->get();
//        $this->belongsTo('User', 'local_key', 'parent_key');
        
//        User::select("users.*","items.id as itemId","jobs.id as jobId")
//            ->join("items","items.user_id","=","users.id")
//            ->join("jobs",function($join){
//                $join->on("jobs.user_id","=","users.id")
//                    ->on("jobs.item_id","=","items.id");
//            })
//            ->get();
//        $this->$npjProcessos = NpjProcesso::table('NPJ_PROCESSOS')
//            ->join('NPJ_CLIENTES', 'NPJ_CLIENTES.ID_CLIENTE', '=','NPJ_PROCESSOS.ID_CLIENTE')
//            ->select('NPJ_PROCESSOS.*', 'NPJ_CLIENTES.NM_CLIENTE')
//            ->get();
        //        $this->npjClientes = DB::select('select * from NPJ_CLIENTES');
    }
    
    public function buscarAlunos(){
        $valor = Request::input("valor");
        $this->findAlunos(strtoupper($valor));
//        echo count($this->alunos);
//        foreach($this->alunos as $a){
//            echo $a->nrMatricula;
//        }
        echo json_encode($this->alunos);
    }
    
    private function findAlunos($valor){
//        $cacAlunosCurso = CacAlunosCurso::all();
//        $cacAlunosCurso = CacAlunosCurso::limit(100)->offset(100)->get();
        $cacAlunosCurso = CacAlunosCurso::where('ID_CURSO', '=', 29)->get();
        
        foreach($cacAlunosCurso as $calc) {
            $cacAlunos = CacAlunos::find($calc->SQ_ALUNO);
            if(strpos($cacAlunos->NM_ALUNO, $valor) !== false){
                $aluno = new Alunos();
//                echo $calc->NR_MATRICULA ."-";
                $aluno->nrMatricula = $calc->NR_MATRICULA;
                $aluno->sqAluno = $calc->SQ_ALUNO;
                $aluno->nmAluno = $cacAlunos->NM_ALUNO;
                $this->alunos[] = $aluno;
            }
        }
    }
    
    public function viewCadastro(){
        
//        $this->findAlunos("aaaaaaaaaaaaaa");
        // if(csrf_token() == Request::input("_token")){
            $this->alunos = array();
            $cliente = null;
            if (Request::has("id")){
//                Crypt::decryptString(Request::input("id"));
//                self::$processo = NpjProcesso::find(Request::input("id"));
                $processo = NpjProcesso::find(Request::input("id"));
                $cliente = NpjCliente::find($processo->ID_CLIENTE);
//                $tmp_matriculas = NpjAlunoProcesso::OfIdProcesso(self::$processo->ID_PROCESSO)->get();
                $tmp_matriculas = NpjAlunoProcesso::OfIdProcesso($processo->ID_PROCESSO)->get();
                
                foreach($tmp_matriculas as $aux_matricula){
//                    $cacAlunosCurso = CacAlunosCurso::where('NR_MATRICULA',"'".$aux_matricula->NR_MATRICULA."'")->get();
                    $cacAlunosCurso = CacAlunosCurso::find($aux_matricula->NR_MATRICULA);
                    
                    $cacAlunos = CacAlunos::find($cacAlunosCurso->SQ_ALUNO);
                    $aluno = new Alunos();
                    $aluno->nrMatricula = $aux_matricula->NR_MATRICULA;
                    $aluno->sqAluno = $cacAlunos->SQ_ALUNO;
                    $aluno->nmAluno = $cacAlunos->NM_ALUNO;
                    $aluno->idProcesso = $processo->ID_PROCESSO;
                    $this->alunos[] = $aluno;
                }
            }
            $this->inicial->subTitulo = "Atualizar Processo (".Request::input("id").")";
            return view('page-npj-processos-form')
    //            ->with('processo', self::$processo)
                ->with('processo', $processo)
                ->with('cliente', $cliente)
                ->with('orientadores', NpjOrientador::All())
                ->with('alunos', $this->alunos)
                ->with('inicial', $this->inicial);
        // }
        
        // return null;
    }
    
    public function viewArquivado(){
        
    }
    
        
    public function vincularCliente(){
//        $clientes = NpjCliente::all();
//        $tabela_cliente = //"<div id='tabelaPopulada'>".
//                        "<table class='table table-bordered datatable-extended table-hover' id='sortable-data'>".
//                            "<thead>".
//                                "<tr>".
//                                    "<th>ID</th>".
//                                    "<th>Cliente</th>".
//                                "</tr>".
//                            "</thead>".
//                            "<tbody>";
//        foreach ($clientes as $cli) {
//            $tabela_cliente .= "<tr><td>".$cli->ID_CLIENTE."</td>".$cli->NM_CLIENTE."</tr>";
//        }
//        $tabela_cliente .="</tbody></table>";
//        $cacAlunosCurso = CacAlunosCurso::all();
        
//        $testes = DB::select('select * from CAC_ALUNOS_CURSO calc, CAC_ALUNOS calu where active = ?', [1]);
//        $testes = DB::select('select calc.* from CAC_ALUNOS_CURSO calc, CAC_ALUNOS calu where calc.SQ_ALUNO = calu.SQ_ALUNO');
//        $teste = CacAlunosCurso::has('CAC_ALUNOS.SQ_ALUNO', '=', 'CAC_ALUNOS_CURSO.SQ_ALUNO')->get();
//            $this->model->has('quote', '<', 1)->orderBy('created_at', 'desc')->get();
//        $calc = new CacAlunosCurso();
//        $testes = $calc->has('CAC_ALUNOS.SQ_ALUNO', '=', 'CAC_ALUNOS_CURSO.SQ_ALUNO')->get();
//        $this->findAlunos("Aaaaaaaaaaaaaaaaaaaaaa");
        if (Request::has("id")){
            $id = Request::input("id");
//            $idCliente = Crypt::decryptString($id);
            $cliente = NpjCliente::find($id);
            return view('page-npj-processos-form')
                ->with('cliente', $cliente)
                ->with('inicial', $this->inicial)
                ->with('processo', self::$processo)
                ->with('alunos', $this->alunos)
                ->with('orientadores', NpjOrientador::All());
        } else {
            return view('page-npj-processos-form')
                ->with('cliente', null)
                ->with('inicial', $this->inicial)
                ->with('processo', self::$processo)
                ->with('alunos', $this->alunos)
                ->with('orientadores', NpjOrientador::All());
        }
    }
    
    public function cadastrar(){
        $tmp = json_decode(Request::input("jsonAlunos"));
        echo "ok" . $tmp[0]->matricula;
        try {
            
            if (csrf_token() == Request::input("_token")) {
                self::$processo = new NpjProcesso();
//nrProcesso=&vara=&idCliente=5944&dataAudiencia=&comarca=&cartorio=&poloAtivo=&poloPassivo=&_token=yaoFs34GkKsNKneiQ1DLPGjrqsolABNemkGtBeHZ
                self::$processo->NR_PROCESSO       = Request::input('nrProcesso');
                self::$processo->DS_VARA           = Request::input('vara');
                self::$processo->ID_CLIENTE        = Request::input('idCliente');
                self::$processo->DT_PRIM_AUDIENCIA = Request::input('dataAudiencia');
                self::$processo->DS_COMARCA        = Request::input('comarca');
                self::$processo->DS_POLO_PASSIVO   = Request::input('poloPassivo');
                self::$processo->DS_POLO_ATIVO     = Request::input('poloAtivo');
                self::$processo->DS_CARTORIO       = Request::input('cartorio');
                self::$processo->SQ_FUNCIONARIO    = Request::input('sq_funcionario');
                
                $jsonAlunos = json_decode(Request::input('jsonAlunos'));
                

                if(Request::has("id")){
                    $idProcesso = Request::input("id");
                    $id = Crypt::decryptString($idProcesso);
                    $atualizarProcesso = NpjProcesso::find($id);
                    $atualizarProcesso->ID_CLIENTE        = self::$processo->ID_CLIENTE;
                    $atualizarProcesso->NR_PROCESSO       = self::$processo->NR_PROCESSO;
                    $atualizarProcesso->SQ_FUNCIONARIO    = self::$processo->SQ_FUNCIONARIO;
                    $atualizarProcesso->DS_VARA           = self::$processo->DS_VARA;
                    $atualizarProcesso->DS_COMARCA        = self::$processo->DS_COMARCA;
                    $atualizarProcesso->DS_CARTORIO       = self::$processo->DS_CARTORIO;
                    $atualizarProcesso->DS_POLO_ATIVO     = self::$processo->DS_POLO_ATIVO;
                    $atualizarProcesso->DS_POLO_PASSIVO   = self::$processo->DS_POLO_PASSIVO;
                    $atualizarProcesso->DT_PRIM_AUDIENCIA = self::$processo->DT_PRIM_AUDIENCIA;
                    $atualizarProcesso->SN_ARQUIVADO      = self::$processo->SN_ARQUIVADO;
                    $atualizarProcesso->SN_ARQ_PERM       = self::$processo->SN_ARQ_PERM;
                    $atualizarProcesso->save();
                    echo "update realizado com sucesso";
                } else {
                    echo "insert realizado com sucesso";
                    self::$processo->save();
                    $novoProcesso = NpjProcesso::orderBy('ID_PROCESSO', 'desc')->first();
                    foreach($jsonAlunos as $aluno) {
                        $npjAlunoProcesso = new NpjAlunoProcesso();
                        $npjAlunoProcesso->ID_PROCESSO = $novoProcesso->ID_PROCESSO;
                        $npjAlunoProcesso->NR_MATRICULA = $aluno->matricula;
                        $npjAlunoProcesso->save();
                    }
                    
                }
                
                
                
                echo "Finalizado";
//                echo self::$processo;
//                return redirect()->action('NpjClienteController@viewCadastro');
//                return view('page-npj-clientes-cadastrar')->with('cliente', self::$cliente);
            }
        } catch(Exception $e){
            echo "Erro('".$e."') ao tentar inserir na tabela NPJ_PROCESSOS, entrar em contato com o TI da UniFil.";
        }
    }

    // public function atualizar(){

    //     if (Request::has("id")){

    //         $updtCliente = json_decode(Request::input("jsonCliente"));

    //         $cliente = NpjCliente::find(Request::input("id"));

    //         $cliente.

    //         $cliente = NpjCliente::find($processo->ID_CLIENTE);
    //         $tmp_matriculas = NpjAlunoProcesso::OfIdProcesso($processo->ID_PROCESSO)->get();
            
    //         foreach($tmp_matriculas as $aux_matricula){
    //             $cacAlunosCurso = CacAlunosCurso::find($aux_matricula->NR_MATRICULA);
    //             $cacAlunos = CacAlunos::find($cacAlunosCurso->SQ_ALUNO);
    //             $aluno = new Alunos();
    //             $aluno->nrMatricula = $aux_matricula->NR_MATRICULA;
    //             $aluno->sqAluno = $cacAlunos->SQ_ALUNO;
    //             $aluno->nmAluno = $cacAlunos->NM_ALUNO;
    //             $aluno->idProcesso = $processo->ID_PROCESSO;
    //             $this->alunos[] = $aluno;
    //         }
    //     }
    // }
    
    private function criarTh($value){
        $th = $this->util->createElement("th");
        $atrTh[] = $this->util->createAttribute("text",$value);
        $th->setAttributes($atrTh);
        return $th;
    }
    
    public function getElementTable(){
        $this->util = new UtilDocument();
        $documento = $this->util->createDocument();
        
        $div = $this->util->createElement("div");
        
        $atrDiv[] = $this->util->createAttribute("id","tabelaPopulada");
        $div->setAttributes($atrDiv);
        
        $table = new Table();
        
        $atrTable[] = $this->util->createAttribute("class","table table-bordered datatable-extended table-hover");
        $atrTable[] = $this->util->createAttribute("id","sortable-data");
        $table->setAttributes($atrTable);
        
        $tmpHead = $this->util->createElement("thead");
        $thead = new THead();
        $thead->setElement($tmpHead);
            
        $tr = $this->util->createElement("tr");
        $elemenstTr[] = $this->criarTh("Nº de processo");
        $elemenstTr[] = $this->criarTh("Cliente");
        $elemenstTr[] = $this->criarTh("Polo aivo");
        $elemenstTr[] = $this->criarTh("Polo passivo");
        $elemenstTr[] = $this->criarTh("Editar");
        $elemenstTr[] = $this->criarTh("Excluir");
        $elemenstTr[] = $this->criarTh("Arquivar");
        $tr->setElements($elemenstTr);
                
        $thead->setElement($tr);
        $table->setTHead($thead);
        
        
        
        
        $elementsDiv[] = $table;
        $div->setElements($elementsDiv);
        $documento->setElement($div);
        
//        return json_encode($documento);
        return $documento;
    }
    
    public function getTabela(){
        $this->findAll();
        $json = $this->getElementTable();
        $tabela =   "<div id='tabelaPopulada'>".
                        "<table class='table table-bordered datatable-extended table-hover' id='sortable-data'>".
                            "<thead>".
                                "<tr>".
                                    "<th>Nº de processo</th>".
                                    "<th>Cliente</th>".
                                    "<th>Polo aivo</th>".
                                    "<th>Polo passivo</th>".
                                    "<th>Editar</th>".
                                    "<th>Excluir</th>".
                                    "<th>Arquivar</th>".
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
        
        foreach ($this->npjProcessos as $pro) {
            $id = Crypt::encryptString($pro->ID_PROCESSO);
            
            
            $tabela .=          "<tr id='".$id."'>".
                                    utf8_encode("<td>".$pro->NR_PROCESSO."</td>").
                                    utf8_encode("<td>".$this->findByNomeCliente($pro->ID_CLIENTE)."</td>").
                                    utf8_encode("<td>".$pro->DS_POLO_ATIVO."</td>").
                                    utf8_encode("<td>".$pro->DS_POLO_PASSIVO."</td>").
                                    "<td>".
                                        "<form id='".$pro->NR_PROCESSO."editarProcesso' action='/npj/processo/editar' method='post'>".
                                            "<input type='hidden' name='id' value='".$id."'/>".
                                            "<input type='hidden' name='_token' value='".csrf_token()."'/>".
                                            "<button class='btn btn-primary btn-clean' type='button' onclick=\"swal({	title: 'Editar processo'".
                                                                                                                    ",text: 'Tem certeza que deseja editar o processo?'".
                                                                                                                    ",type: 'warning'".
                                                                                                                    ",showCancelButton: true".
                                                                                                                    ",confirmButtonColor: '#DD6B55'".
                                                                                                                    ",confirmButtonText: 'Sim'".
                                                                                                                    ",cancelButtonText: 'Não'".
                                                                                                                "}).then(".
                                                                                                                "function(){".
                                                                                                                    "console.log('submeter');". "document.getElementById('".$pro->NR_PROCESSO."editarProcesso').submit();".
                                                                                                                "}, function (dismiss) {".
                                                                                                                    "console.log('nw submeter');".
                                                                                                                    "return false;".
                                                                                                                "}".
                                                                                                                ");".
                                                                                                        "\"><span class='fa fa-pencil'/></button>".
                                        "</form>".
                                    "</td>".
                                    "<td>".
                                    "<button class='btn btn-primary btn-clean' onclick=\"swal({	title: 'Excluir processo'".
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
                                                                                                "var retorno = exluir_processo('".$id."');".
                                                                                                "if (retorno == 'erro') {".
                                                                                                    "swal('Erro!',  'Processo não foi excluído', 'error');".
                                                                                                "} else if (retorno == 'temProcesso'){".    
                                                                                                    "swal('Erro!',  'Processo não foi excluído', 'error');".
                                                                                                "} else {".
                                                                                                    "swal('Sucesso!', 'Processo excluído com sucesso!', 'success');".
                                                                                                "}".
                                                                                            "}, function (dismiss) {".
                                                                                                "swal('Cancelado!',  'Processo não foi excluído', 'error');".
                                                                                            "}".
                                                                                            ");".
                                                                                    "\"><span class='fa fa-user-times'/></button>".
                                    "</td>".
                                    "<td>".
                                        "<form '".$pro->NR_PROCESSO."arquivarProcesso' action='/npj/processo/vincularProcesso' method='post'>".
                                            "<input type='hidden' name='id' value='".$id."'/>".
                                            "<input type='hidden' name='_token' value='".csrf_token()."'/>".
//                                            "<button class='btn btn-primary btn-clean' type='submit'><span class='fa fa-file-powerpoint-o'/></button>".
                                            "<button class='btn btn-primary btn-clean' type='button' onclick=\"swal({	title: 'Arquivar processo'".
                                                                                                                    ",text: 'Tem certeza que deseja arquivar o processo?'".
                                                                                                                    ",type: 'warning'".
                                                                                                                    ",showCancelButton: true".
                                                                                                                    ",confirmButtonColor: '#DD6B55'".
                                                                                                                    ",confirmButtonText: 'Sim'".
                                                                                                                    ",cancelButtonText: 'Não'".
                                                                                                                "}).then(".
                                                                                                                "function(){".
                                                                                                                    "console.log('submeter');".
                                                                                                                    "document.getElementById('".$pro->NR_PROCESSO."arquivarProcesso').submit();".
                                                                                                                "}, function (dismiss) {".
                                                                                                                    "console.log('nw submeter');".
                                                                                                                    "return false;".
                                                                                                                "}".
                                                                                                                ");".
                                                                                                        "\"><span class='fa fa-file-powerpoint-o'/></button>".
                                        "</form>".
                                    "</td>".
                                "</tr>";
        }
        $tabela .=          "</tbody>".
                        "</table>".
                    "</div>";
        
        return view('page-npj-processos-buscar')
            ->with('tabela', $tabela)
            ->with('inicial', $this->inicial)
            ->with('json', $json);
    }
    
    
    public function deletar(){
        
        if(csrf_token() == Request::input("_token")){
            $idProcesso = Request::input("id");
            try {
                
                $id = Crypt::decryptString($idProcesso);                  
                $aluno = NpjAlunoProcesso::where("ID_PROCESSO", "=", $id)->first();
                
                if(is_null($aluno)){
                    $processo = NpjProcesso::find($id);
                    $processo->delete();
                    echo $idCliente;    
                } else {
                    echo "Erro: Existe Aluno(".$aluno->ID_ALUNO_PROC.") para esse Processo";
                }
                
                
            } catch (DecryptException $e) {
                echo $e."erro";
            } catch (Exception $e) {
                echo $e."erro";
            }
        }
    }
    
    public function atualizar(){
        $this->vincularCliente(Request::input('id'));
    }
    
    public function buscarCliente(){
//        $id = Request::input("id");
//        $idCliente = descryptId($id);
        $nm_cliente = Request::input("nm_cliente");
        $clientes = NpjCliente::OfNome($nmCliente)->get();
//        $cli = NpjCLiente::find($idCliente);
        
        echo $clientes->NM_CLIENTE;
        
    }
}
