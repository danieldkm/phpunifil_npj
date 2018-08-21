<?php

namespace app_unifil\Http\Controllers\inicializar;

use Illuminate\Http\Request;
use app_unifil\Http\Controllers\Controller;

class IniModalLoading extends Controller
{
    private $id;
    private $nameInclude;
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getNameInclude(){
        return $this->nameInclude;
    }
    
    public function setNameInclude($include){
        $this->nameInclude = $include;
    }
}
