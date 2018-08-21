<?php


namespace app_unifil\Http\Html;

use app_unifil\Http\Html\Element;

class Document {
    
    private $element;
    
    public function __construct(){
        $this->element = new Element();
    }
    
    public function getElemet(){
        return $this->element;
    }
    
    public function setElement($element){
        $this->element = $element;
        
    }
}