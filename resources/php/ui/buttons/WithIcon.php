<?php

/**
 * Botão com icone
 *
 * @author dmorita
 */
require_once 'Button.php';
class WithIcon extends Button {
    
    private $lado = "";
    private $ico;
    
    public function __construct($nome, $icone){
        $this->nome = $nome;
        $this->ico = $icone;
        parent::setClasses(new Classes());
        parent::setTag("<button type='#type' class='btn #cColor#cSize#cType#cDisable' #onClick#value#disable><span class='#ico#lado'/>#name</button>");
    }
//    <button class="btn btn-primary btn-clean" type="button" onClick="cleanForm(this)" value="form-pessoa-juridica"><span class="fa fa-eraser"/> Limpar</button>
    public function getButton(){
        $classes = parent::getClasses();
        $botao = parent::getTag();
//                "<button type='#type' class='btn #cColor#cSize#cType#cDisable' #onClick#value><span class='#ico#lado'/>".$this->getName()."</button>";
        $botao = parent::buildButton($botao, $classes);
        
        //Icone
        $botao = str_replace("#ico", $this->getIco(), $botao);
        $botao = str_replace("#lado", ($this->getLado() === null || $this->getLado() === ""? null:" ".$this->getLado()), $botao);
        
        return $botao;
    }
    
//    public function createButton(){
//        echo "<button type='".$this->getType()."' class='btn ".$classes->getColor()." ".$classes->getSize()." ".$classes->getType()." ".$classes->getDisable()."'><span class='".$this->getIco()." ".$this->getLado()."'/>". $this->getName()."</button>";
//    }
    
    //@Overrride
//    public function getCustomButton($custom){
//        $classes = parent::getClasses();
//        return "<button type='".parent::getType()."' class='btn ".$classes->getColor()." ".$classes->getSize()." ".$classes->getType()."' ".$custom."><span class='".$this->getIco()." ".$this->getLado()."'></span>".parent::getName()."</button>";
//    }
    
//    public function getButtonIcon(){
//        $classes = parent::getClasses();
//        return "<button type='".parent::getType()."' class='btn ".$classes->getColor()." ".$classes->getSize()." ".$classes->getType()."'><span class='".$this->getIco()." ".$this->getLado()."'></span>".parent::getName()."</button>";
//    }
//    
//    public function createButtonIcon(){
//        $classes = parent::getClasses();
//        echo "<button type='".parent::getType()."' class='btn ".$classes->getColor()." ".$classes->getSize()." ".$classes->getType()."'><span class='".$this->getIco()." ".$this->getLado()."'></span>".parent::getName()."</button>";
//    }
    
    function getLado() {
        return $this->lado;
    }

    function getIco() {
        return $this->ico;
    }

    function setLado($lado) {
        if($lado === 1){
            $this->lado = "pull-right";
        } else {
            $this->lado = "";
        }
    }

    function setTipo($tipo) {
        if($tipo === 0){ //fixado
            parent::setType("btn-icon-fixed");
        }else if($tipo === 1){// apenas o ícone
            parent::setType("btn-icon");
        } else {
            parent::setType("");
        }
    }

    function setIco($icone) {
        $this->ico = $icone;
    }

}
