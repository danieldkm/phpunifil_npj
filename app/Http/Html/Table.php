<?php

namespace app_unifil\Http\Html;

use app_unifil\Http\Html\THead;
use app_unifil\Http\Html\TBody;

class Table {
    
    private $thead;
    private $tbody;
    private $type;
    private $attributes;
    
    public function __construct(){
        $this->thead = new THead();
        $this->tbody = new TBody();
    }
    
    public function getTHead(){
        return $this->thead;
    }
    
    public function setTHead($thead){
        $this->thead = $thead;
    }
    
    public function getTBody(){
        return $this->tbody;
    }
    
    public function setTBody($tbody){
        $this->$tbody = $tbody;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
    }
    
    public function getAttributes(){
        return $this->attributes;
    }
    
    public function setAttributes($attributes){
        $this->attributes = $attributes;
    }
    
}