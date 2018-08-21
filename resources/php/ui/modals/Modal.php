<?php

/**
 *
 * @author dmorita
 */
require_once $_SERVER["DOCUMENT_ROOT"]."/npj/php/ui/buttons/Button.php";
class Modal {
    
    private $size;
    private $cor;
    private $disable;
    private $button;
    
    private $titulo;
    private $header;
    private $body;
    private $footer;
    
    public function __construct() {
        $this->setDisable(false);
        $this->button = new Button();
        $this->setBody("<p>body vazio</p>");
    }
    
    public function createButton($id, $name){
        if ($this->getDisable()){
            $this->button->createCustomButtom("data-toggle='modal' data-target='#".$id."' data-backdrop='static'", $name);
        } else {
            $this->button->createCustomButtom("data-toggle='modal' data-target='#".$id."'", $name);
        }
        
    }
        
    public function createModal($id) {
        $modal = 
"<div class='modal fade' id='".$id."' tabindex='-1' role='dialog' aria-labelledby='modal-primary-header' style='display: none;'>".
    "<div class='modal-dialog ".$this->getSize()." ".$this->getCor()."' role='document'>";
        if (!$this->getDisable()){
            $modal = $modal . "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='icon-cross'></span></button>";
        }
        $modal = $modal .
        "<div class='modal-content'>".
            "<div class='modal-header'>".
                $this->getHeader($this->getTitulo()).
            "</div>".
            "<div class='modal-body'>".
                $this->getBody().
            "</div>".
            "<div class='modal-footer'>".
                $this->getFooter().
//                <button type='button' class='btn btn-link' data-dismiss='modal'>Close</button>
//                <button type='button' class='btn btn-primary'>Submit</button>
            "</div>".
        "</div>".
    "</div>".
"</div>";
        echo $modal;
    }
    
     public function setHeader($header){
        $this->header = $header;
    }
    
    function getHeader($titulo) {
        if (is_null($this->header)){
            return "<h4 class='modal-title' id='modal-primary-header'>".$titulo."</h4>";
        } else {
            return $this->header;
        }
    }
    
    function getBody() {
        return $this->body;
    }

    function setBody($body) {
        $this->body = $body;
    }
    
    function getFooter() {
        if (is_null($this->footer)){
            return "<button type='button' class='btn btn-link' data-dismiss='modal'>Close</button>".
                         "<button type='button' class='btn ".$this->getButton()->getColor()."'>Submit</button>";
        } else {
            return $this->footer;
        }
        
    }

    function setFooter($footer) {
        $this->footer = $footer;
    }
    
    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function getSize() {
        return $this->size;
    }

    function getCor() {
        return $this->cor;
    }

    function getDisable() {
        return $this->disable;
    }

    function setSize($size) {
        $this->size = $size;
        if($size === "small"){
            $this->size = "modal-sm";
        } else if($size === "default"){
            $this->size = "";
        } else if($size === "large"){
            $this->size = "modal-lg";
        } else if($size === "full"){
            $this->size = "modal-fw";
        }
    }

    function setCor($cor) {
        if ($cor === "default") {
            $this->cor = "";
            $this->button->setColor("default");
        } else if ($cor === "primary") {
            $this->cor = "modal-primary";
            $this->button->setColor("primary");
        } else if ($cor === "success") {
            $this->cor = "modal-success";
            $this->button->setColor("success");
        } else if ($cor === "info") {
            $this->cor = "modal-info";
            $this->button->setColor("info");
        } else if ($cor === "warning") {
            $this->cor = "modal-warning";
            $this->button->setColor("warning");
        } else if ($cor === "danger") {
            $this->cor = "modal-danger";
            $this->button->setColor("danger");
        } else {
            $this->cor = "";
            $this->button->setColor("default");
        }
    }

    function setDisable($disable) {
        $this->disable = $disable;
    }
    
    function getButton() {
        return $this->button;
    }

    function setButton($button) {
        $this->button = $button;
    }



//    //modals
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-clean">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-backdrop-disable" data-backdrop="static">Open Modal</button>
//    
//    //sizing
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-small">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-large">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-full">Open Modal</button>
//            
//            
//    //colors 
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-primary">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-info">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-success">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-warning">Open Modal</button>
//    <button class="btn btn-default" data-toggle="modal" data-target="#modal-danger">Open Modal</button>
            
//            
//    //popover
//    <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" title="" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Top">
//    <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" title="" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Left">
//    <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" title="" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Right">
//    <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" title="" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Bottom">
}

