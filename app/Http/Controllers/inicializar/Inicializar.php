<?php

namespace app_unifil\Http\Controllers\inicializar;

use Illuminate\Http\Request;
use app_unifil\Http\Controllers\Controller;

class Inicializar extends Controller
{
    
    private $btnLimpar;
    private $titulo;
    private $subtitulo;
    private $modalLoading;
    private $hasOnLoad;
    private $onLoad;
    
    public function __construct(){
        $this->setTitulo("UniFil");
        $this->btnLimpar = new IniButton();
        $this->btnLimpar->setId("btnLimpar");
        $this->btnLimpar->setIcon("fa fa-eraser");
        $this->btnLimpar->setName("Limpar");
        $this->btnLimpar->setOnClick("cleanForm(this);"); //whenClick('btnLimpar');
        $this->btnLimpar->setColor("btn-primary btn-clean");
        
        $this->modalLoading = new IniModalLoading();
        $this->modalLoading->setId("modal-loading-3");
        $this->modalLoading->setNameInclude("loading-type3"); //partials.ui.loadings.
        
        $this->hasOnLoad = true;
        $this->onLoad = "hideLoadingModal('".$this->modalLoading->getId()."')";
    }
    
    public function getBtnLimpar(){
        return $this->btnLimpar;
    }
    
    public function setBtnLimpar($btnLimpar){
        $this->btnLimpar = $btnLimpar;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    public function getSubTitulo(){
        return $this->subTitulo;
    }
    
    public function setSubTitulo($subTitulo){
        $this->subTitulo = $subTitulo;
    }
    
    public function getTipoLoading(){
        return $this->titulo;
    }
    
    public function setTipoLoading($tipo){
        $this->tipoLoading = $tipo;
    }
    
     public function getModalLoading(){
        return $this->modalLoading;
    }
    
    public function setModalLoading($modalLoading){
        $this->modalLoading = $modalLoading;
    }
    
    public function getHasOnLoad(){
        return $this->hasOnLoad;
    }
    
    public function setHasOnLoad($hasOnLoad){
        $this->hasOnLoad = $hasOnLoad;
    }
    
    public function getOnLoad(){
        return $this->onLoad;
    }
    
    public function setOnLoad($onLoad){
        $this->onLoad = $onLoad;
    }
}
