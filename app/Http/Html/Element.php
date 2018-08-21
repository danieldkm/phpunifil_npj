<?php

namespace app_unifil\Http\Html;

use Table;

class Element {
    
    private $elements;
    private $attributes;
    private $type;
    
    public function getElements(){
        return $this->elements;
    }
    
    public function setElements($elements){
        $this->elements = $elements;
    }

    public function getAttributes(){
        return $this->attributes;
    }
    
    public function setAttributes($attributes){
        $this->attributes = $attributes;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
    }
    
}