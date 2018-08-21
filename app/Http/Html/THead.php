<?php

namespace app_unifil\Http\Html;

use Tr;

class THead {
    
    private $element;
        
    public function getElement(){
        return $this->element;
    }
    
    public function setElement($element){
        $this->element = $element;    
    }
    
}