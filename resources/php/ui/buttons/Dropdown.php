<?php

/**
 * Botão tipo Dropdown (Dropbox)
 *
 * @author dmorita
 */
require_once 'Button.php';
class Dropdown extends Button {
    

    private function getLista($lista){
        $montarLista = "<ul class='dropdown-menu'>";
        foreach($lista as $valor){
            $montarLista = $montarLista.$valor;
        }
        $montarLista = $montarLista."</ul>";
        return $montarLista;
    }

    //exemplo lista
//                        "<li><a href='#'>Action</a></li>",
//                        "<li><a href='#'>Another action</a></li>",
//                        "<li><a href='#'>Something else here</a></li>",
//                        "<li role='separator' class='divider'></li>",
//                        "<li><a href='#'>Separated link</a></li>",
    public function createSingle($valores, $name) {
        $classes = parent::getClasses();
        echo    "<div class='btn-group open'>",
                    "<button type='button' class='btn ".$classes->getColor()." ".$classes->getSize()." dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>"
                        .$name."<span class='caret'></span>",
                    "</button>".
                    $this->getLista($valores).
                "</div>";
    }
    
    public function createSplit($valores, $name) {
        $classes = parent::getClasses();
        echo    "<div class='btn-group'>".
                    parent::getButton().
                    "<button type='button' class='btn ".$classes->getColor()." ".$classes->getSize()." dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>",
                        "<span class='caret'></span>",
                    "</button>".
                    $this->getLista($valores).
                "</div>";
    }
    
    public function createDropup ($valores, $name){
        $classes = parent::getClasses();
        echo    "<div class='btn-dropup'>".
                    parent::getButton().
//                    "<button type='button' class='btn ".parent::getColor()." ".parent::getSize()."'>".$name."</button>",
                    "<button type='button' class='btn ".$classes->getColor()." ".$classes->getSize()." dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>",
                        "<span class='caret'></span>",
                    "</button>".
                    $this->getLista($valores).
                "</div>";
    }
}
