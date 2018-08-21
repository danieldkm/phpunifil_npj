<?php
namespace app_unifil\Http\Html\util;

use app_unifil\Http\Html\Attribute;
use app_unifil\Http\Html\Document;
use app_unifil\Http\Html\Element;
use app_unifil\Http\Html\Table;
use app_unifil\Http\Html\TBody;
use app_unifil\Http\Html\THead;

class UtilDocument {
    
    private $document;
    
    public function createDocument(){
        $this->document = new Document();
        return $this->document;
    }
    
    public function createDocument2($type) {
		$this->document = new Document();
		$this->addDocument($this->createElement($type));
	}
    
    public function createElement($type) {
        $element = new Element();
		$element->setType($type);
		$element->setElements([]);
        $element->setAttributes([]);
		return $element;
	}
    
    public function createAttribute($name, $value) {
		$attribute = new Attribute();
		$attribute->setName($name);
		$attribute->setValue($value);
		return $attribute;
	}
    
    public function addDocument($element) {
		$this->document->setElement($element);
	}
    
    public function addElement($element, $attributes) {
        $element->setAttribute($attributes);
		$this->document->getElement()->getElements()[] = $element;
	}
}


