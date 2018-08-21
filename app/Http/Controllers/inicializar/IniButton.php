<?php

namespace app_unifil\Http\Controllers\inicializar;

use Illuminate\Http\Request;
use app_unifil\Http\Controllers\Controller;

class IniButton extends Controller
{
    
    private $id;
    private $icon;
    private $name;
    private $onClick;
    private $color;
    private $value;
    
    public function getId(){
        return $this->id;
    }
    
    public function getIcon(){
        return $this->icon;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getOnClick(){
        return $this->onClick;
    }
    
    public function getColor(){
        return $this->color;
    }
    
    public function getValue(){
        return $this->value;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setColor($color){
        $this->color = $color;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setIcon($icon){
        $this->icon = $icon;
    }
    
    public function setOnClick($onClick){
        $this->onClick = $onClick;
    }
    
    public function setValue($value){
        $this->value = $value;
    }
    
}
