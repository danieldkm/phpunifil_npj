<?php

/**
 * Description of Classes
 *
 * @author dmorita
 */
class Classes {
    
    private $color;
    private $type;
    private $disable;
    private $size;
    
    public function __construct() {
        $this->setColor("default");
        $this->setType("default");
        $this->setDisable(false);
        $this->setSize("");
    }

    function getColor() {
        return $this->color;
    }

    function getType() {
        return $this->type;
    }

    function getDisable() {
        return $this->disable;
    }

    function getSize() {
        return $this->size;
    }

    function setDisable($disable) {
        if ($disable){
            $this->disable = "btn-block";
        } else {
            $this->disable = "";
        }
    }

    function setSize($size) {
        $this->size = $size;
        if ($size === "default") {
            $this->size = "";
        } else if ($size === "large") {
            $this->size = "btn-lg";
        } else if ($size === "small") {
            $this->size = "btn-sm";
        } else if ($size === "xmall") {
            $this->size = "btn-xs";
        } else {
            $this->size = "";
        }
    }

    function setColor($color) {
        if ($color === "default") {
            $this->color = "btn-default";
        } else if ($color === "primary") {
            $this->color = "btn-primary";
        } else if ($color === "success") {
            $this->color = "btn-success";
        } else if ($color === "info") {
            $this->color = "btn-info";
        } else if ($color === "warning") {
            $this->color = "btn-warning";
        } else if ($color === "danger") {
            $this->color = "btn-danger";
        } else if ($color === "link") {
            $this->color = "btn-link";
        } else {
            $this->color = $color;
        }
    }

    function setType($type) {
//        $this->type = $type;
        if($type === "default"){
            $this->type = "";
        } else if($type === "clean"){
            $this->type = "btn-clean";
        } else if($type === "rounded"){
            $this->type = "btn-rounded";
        } else {
            $this->type = "";
        }
    }
}
