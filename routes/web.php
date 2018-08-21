<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
})->middleware('auth');

//Route::get('/login', function () {
//    return view('login');
//});

Route::get('/teste', function () {
    return view('home');
});

//Cliente
//Route::get('/npj/cliente'                  , 'NpjClienteController@getTabela')->middleware('auth');
//Route::get('/npj/cliente/busca'            , 'NpjClienteController@findByName')->middleware('auth');
//Route::get('/npj/cliente/cadastro'         , 'NpjClienteController@viewCadastro')->middleware('auth');
//Route::post('/npj/cliente/inserir'         , 'NpjClienteController@cadastrar')->middleware('auth');
//Route::post('/npj/cliente/editar'          , 'NpjClienteController@viewCadastro')->middleware('auth');
//Route::post('/npj/cliente/deleta'          , 'NpjClienteController@deletar')->middleware('auth');
//Route::post('/npj/cliente/vincularProcesso', 'NpjProcessoController@vincularProcesso')->middleware('auth');

// Route::get('/npj/clientes'                   , 'NpjClienteController@findByName')->middleware('auth');
// Route::post('/npj/clientes'                  , 'NpjClienteController@cadastrar')->middleware('auth');
// Route::get('/npj/clientes/form'              , 'NpjClienteController@viewCadastro')->middleware('auth');
// Route::post('/npj/clientes/form/edit'        , 'NpjClienteController@viewCadastro')->middleware('auth');
// Route::delete('/npj/clientes'                , 'NpjClienteController@deletar')->middleware('auth');

$this->group(['prefix' => 'npj/clientes', 'namespace' => 'npj\clientes', 'middleware' => 'auth'], function(){

    $this->post('/'         , 'NpjClienteController@store');
	$this->put('/{id}'      , 'NpjClienteController@update');
	$this->delete('/{id}'   , 'NpjClienteController@destroy');
    
    $this->get('/form/{id?}', 'NpjClienteController@viewCadastro')->name('npj.clientes.form');
    $this->get('/'          , 'NpjClienteController@viewClientes')->name('npj.clientes'); 
    $this->get('/{name}'    , 'NpjClienteController@findByName')->name('npj.clientes.findbyname');
	
});

// $this->group(['namespace' => 'npj\clientes', 'middleware' => 'auth'], function(){
//     $this->get('/form/{id?}', 'NpjClienteController@viewCadastro'); //{{route('npj/clientes/form')}}
//     $this->get('/'    , 'NpjClienteController@viewClientes'); //{{route('npj/clientes')}}
// });


//Processo
//Route::get('/npj/processo/cadastro' , 'NpjProcessoController@viewCadastro')->middleware('auth');
//Route::post('/npj/processo/inserir' , 'NpjProcessoController@cadastrar')->middleware('auth');
//Route::post('/npj/processo/editar'  , 'NpjProcessoController@viewCadastro')->middleware('auth');
//Route::post('/npj/processo/deleta'  , 'NpjProcessoController@deletar')->middleware('auth');
//Route::get('/npj/processo/busca'    , 'NpjProcessoController@getTabela')->middleware('auth');
//Route::get('/npj/processo/arquivado', 'NpjProcessoController@viewArquivado')->middleware('auth');
//Route::post('/npj/processo/buscarCliente', 'NpjProcessoController@buscarCliente')->middleware('auth');
//Route::post('/npj/processo/buscarAlunos', 'NpjProcessoController@buscarAlunos')->middleware('auth');

$this->group(['prefix' => 'npj/processos', 'namespace' => 'npj\processos', 'middleware' => 'auth'], function(){

    $this->post('/'                     , 'NpjProcessoController@store');
    $this->put('/{id}'                  , 'NpjProcessoController@update');
    $this->delete('/{id}'               , 'NpjProcessoController@destroy');

    $this->get('{parametros?}'         , 'NpjProcessoController@viewProcessos')->name('npj.processos');
    $this->post('form/{id?}'           , 'NpjProcessoController@viewCadastro')->name('npj.processos.form');
    $this->post('vincular/{idCliente?}' , 'NpjProcessoController@vincular')->name('npj.processos.vincular');

});

$this->group(['prefix' => 'npj/alunos', 'namespace' => 'npj\alunos', 'middleware' => 'auth'], function(){

    $this->get('/{name}'    , 'NpjClienteController@findByName')->name('npj.clientes.findbyname');
    
});


// Route::get('/npj/processos/form'             , 'NpjProcessoController@viewCadastro')->middleware('auth');
// Route::post('/npj/processos/form/edit'  , 'NpjProcessoController@viewCadastro')->middleware('auth');
// Route::get('/npj/processos'                  , 'NpjProcessoController@findByParam')->middleware('auth');
// Route::post('/npj/processos'                 , 'NpjProcessoController@cadastrar')->middleware('auth');
// Route::put('/npj/processos/{id}'             , 'NpjProcessoController@atualizar')->middleware('auth');

// Route::post('/npj/processos/arquivar'        , 'NpjProcessoController@arquivar')->middleware('auth');
// Route::post('/npj/processos/vincular/cliente', 'NpjProcessoController@vincularCliente')->middleware('auth');
// Route::get('/npj/processos/form/arquivado', 'NpjProcessoController@viewArquivado')->middleware('auth');

// Route::post('/npj/processo/inserir' , 'NpjProcessoController@cadastrar')->middleware('auth');
// Route::post('/npj/processo/editar'  , 'NpjProcessoController@viewCadastro')->middleware('auth');
// Route::post('/npj/processo/deleta'  , 'NpjProcessoController@deletar')->middleware('auth');

// Route::post('/npj/processo/buscarCliente', 'NpjProcessoController@buscarCliente')->middleware('auth');
// Route::post('/npj/processo/buscarAlunos', 'NpjProcessoController@buscarAlunos')->middleware('auth');

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/teste', function(){
    return view('home');
});


//Route::error(function(Illuminate\Session\InvalidArgumentException $exception)
//{
//    return view('index');
////    return Redirect::back()->withInput()->with('error', 'Your session was expired');
//}); 
    
//Route::error(function(Illuminate\Session\TokenMismatchException $exception)
//{
//    return Redirect::back();
////    return Redirect::back()->withInput()->with('error', 'Your session was expired');
//});
