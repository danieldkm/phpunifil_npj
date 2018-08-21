<?php

/**
 * Principais caracteristicas do botão
 *
 * @author dmorita
 */
require_once $_SERVER["DOCUMENT_ROOT"]."/npj/php/ui/Classes.php";
class Button {

    protected $size;
    protected $color;
    protected $type = "button";
    protected $disable = false;
    protected $name;
    protected $classes;
    protected $onClick;
    protected $value;
    protected $custom;
    
    protected $tag = "<button type='#type' class='btn #cColor#cSize#cType#cDisable' #onClick#value#disable>#name</button>";
    
    public function __construct() {
        $this->setClasses(new Classes());
        $this->setCustom("<button type='button' class='btn #color #type #size' #attributes  >#tags#name</button>");
    }
    
    public function getButton(){
        return "<button type='".$this->getType()."' class='btn ".$this->getClasses()->getColor()." ".$this->getClasses()->getSize()." ".$this->getClasses()->getType()." ".$this->getDisable()."'>". $this->getName()."</button>";
    }
    
    public function createButton(){
        echo "<button type='".$this->getType()."' class='btn ".$this->getClasses()->getColor()." ".$this->getClasses()->getSize()." ".$this->getClasses()->getType()." ".$this->getDisable()."'>". $this->getName()."</button>";
    }
    
    public function getCustomButton($custom){
        return "<button type='button' class='btn ".$this->getClasses()->getColor()." ".$this->getClasses()->getSize()." ".$this->getClasses()->getType()." ".$this->getClasses()->getDisable()."' ".$custom.">".$this->getName()."</button>";
    }
    
    public function createCustomButtom($custom){
        echo "<button type='button' class='btn ".$this->getClasses()->getColor()." ".$this->getClasses()->getSize()." ".$this->getClasses()->getType()." ".$this->getClasses()->getDisable()."' ".$custom.">".$this->getName()."</button>";
    }
    
    public function withAtribute($attributes){
        $this->setCustom(str_replace("#attributes",$attributes, $this->getCustom()));
        return $this;
    }
    
    public function withName($name){
        $this->setCustom(str_replace("#name",$name, $this->getCustom()));
        return $this;
    }
    
    public function withTags($tags){
        $this->setCustom(str_replace("#tags",$tags, $this->getCustom()));
        return $this;
    }
    
    protected function buildButton($tag, $classes){
        $botao = $tag;
        $botao = str_replace("#type", $this->getType(), $botao);
        $botao = str_replace("#name", $this->getName(), $botao);

        //Classes
        $botao = str_replace("#cColor", $classes->getColor(), $botao);
        $botao = str_replace("#cSize", ($classes->getSize() === null || $classes->getSize() === ""? null : " ".$classes->getSize()), $botao);
        $botao = str_replace("#cType", ($classes->getType() === null || $classes->getType() === ""? null : " ".$classes->getType()), $botao);
        $botao = str_replace("#cDisable", ($classes->getDisable() === null || $classes->getDisable() === ""? null :" ".$classes->getDisable()), $botao);
        //Atributes
        $botao = str_replace("#onClick", ($this->getOnClick() === null || $this->getOnClick() === ""? null:" onclick=\"".$this->getOnClick()."\""), $botao);
        $botao = str_replace("#value", ($this->getValue() === null || $this->getValue() === ""? null:" value=\"".$this->getValue()."\""), $botao);
        $botao = str_replace("#disable", ($this->getDisable()? " disabled" : null), $botao);
        return $botao;
    }
    
    function getSize() {
        return $this->size;
    }

    function getColor() {
        return $this->color;
    }

    function getType() {
        return $this->type;
    }

    function setSize($size) {
        $this->size = $size;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setType($type) {
        $this->type = $type;
    }
    
    function getDisable() {
        return $this->disable;
    }

    function setDisable($disable) {
        $this->disable = $disable;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    private function cleanCustom(){
//        $this->setCustom(str_replace("#attributes","", $this->getCustom()));
//        $this->setCustom(str_replace("#name","", $this->getCustom()));
//        $this->setCustom(str_replace("#tags","", $this->getCustom()));
    }
    
    function getCustom() {
        if (strpos($this->custom, "#")){
            $this->cleanCustom();
        }
        $this->setCustom(str_replace("#color","", $this->getCustom()));
        $this->setCustom(str_replace("#size","", $this->getCustom()));
        $this->setCustom(str_replace("#type","", $this->getCustom()));
        
        return $this->custom;
    }

    function setCustom($custom) {
        $this->custom = $custom;
    }
    
    function getClasses() {
        return $this->classes;
    }

    function setClasses($classes) {
        $this->classes = $classes;
    }
    
    function getOnClick() {
        return $this->onClick;
    }

    function setOnClick($onClick) {
        $this->onClick = $onClick;
    }

    function getValue() {
        return $this->value;
    }

     function setValue($value) {
        $this->value = $value;
    }
    function getTag() {
        return $this->tag;
    }

    function setTag($tag) {
        $this->tag = $tag;
    }


    
}



