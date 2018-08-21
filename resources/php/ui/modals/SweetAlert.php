<?php

/**
 * Description of SweetAlert
 * @url http://t4t5.github.io/sweetalert/
 * @author dmorita
 */
require_once $_SERVER["DOCUMENT_ROOT"]."/npj/php/ui/buttons/Button.php";
class SweetAlert {
    
    
    private $title;
    private $text;
    private $type; //"success", "error", "warning", "info"
    private $showCancelButton;
    private $confirmButtonColor;
    private $confirmButtonText;
    private $cancelButtonText;
    private $closeOnConfirm;
    private $closeOnCancel;
    private $isHtml;
    private $hasTimer;
    
    //input
    private $inputPlaceholder;
    private $TextInputError;
    
    
    private $successTitle;
    private $successText;
    
    private $errorTitle;
    private $errorText;
    
    private $button;
    private $status;
    
    private $imageUrl;
    
    public function __construct() {
        $this->button = new Button();
        $this->setType("warning");
        $this->setConfirmButtonColor("#DD6B55");
        $this->setCloseOnCancel(false);
        $this->setCloseOnConfirm(false);
        $this->setShowCancelButton(true);
        //trigger_error("Cannot divide by zero", E_USER_ERROR);
    }
    
    public function createBasicAlert($name){
        if (!is_null($this->getText())){
            echo "<button class='btn ".$this->getButton()->getClasses()->getColor()."' onclick=\"swal('".$this->getTitle()."', '".$this->getText()."');\">".$name."</button>";
        } else {
            echo "<button class='btn ".$this->getButton()->getClasses()->getColor()."' onclick='swal('".$this->getTitle()."');'>".$name."</button>";
        }
    }
    
    
    private function buildSwalConfirmAlert($acao){
        $swal =
        "swal({ ".
            "title: '".$this->getTitle()."',".
            "text: '".$this->getText()."',".
            "type: '".$this->getType()."',".
            "showCancelButton: ".($this->getShowCancelButton()?"true":"false").",";
        if (!is_null($this->getImageUrl())) {
            $swal = $swal . "imageUrl: ".$this->getImageUrl().",";
        }
        if (!is_null($this->getIsHtml())){
            $swal = $swal . "html: ".$this->getHtml().",";
        }
         $swal = $swal .
            "confirmButtonColor: '".$this->getConfirmButtonColor()."',".
            "confirmButtonText: '".$this->getConfirmButtonText()."',".
            "cancelButtonText: '".$this->getCancelButtonText()."',".
            "closeOnConfirm: ".($this->getCloseOnConfirm()?"true":"false").",".
            "closeOnCancel: ".($this->getCloseOnCancel()?"true":"false")."".
          "},".
          "function(isConfirm){".
            "if (isConfirm) {".
              $acao.   
              "swal('".$this->getSuccessTitle()."', '".$this->getSuccessText()."', 'success');".
            "} else {".
              "swal('".$this->getErrorTitle()."',  '".$this->getErrorText()."', 'warning');".
            "}".
          "});";
        return $swal;
    }
    
    private function buildInputAlert(){
        $swal = 
        "swal({".
            "title: '".$this->getTitle()."',".
            "text: '".$this->getText()."',".
            "type: 'input',".
            "showCancelButton: ".($this->getShowCancelButton()?"true":"false").",".
            "closeOnConfirm: ".($this->getCloseOnConfirm()?"true":"false").",".
            "animation: 'slide-from-top',".
            "inputPlaceholder: '".$this->getInputPlaceholder()."'".
          "},".
          "function(inputValue){".
            "if (inputValue === false) return false;".

            "if (inputValue === '') {".
              "swal.showInputError('".$this->getTextInputError()."');".
              "return false".
            "}".
            
            "swal('".$this->getSuccessTitle()."', 'Você escreveu: ' + inputValue, 'success');".
//            "swal('Nice!', 'You wrote: ' + inputValue, 'success');'".
          "});";
        return $swal;
    }
    
    private function getButtonAlert($name, $swal){
        $this->getButton()->setOnClick($swal);
        return $this->getButton()->getButton();
    }
    
    public function getConfirmAlert($name, $acao){
        return $this->getButtonAlert($name, $this->buildSwalConfirmAlert($acao));
    }

    private function createButtonAlert($name, $swal){
        echo "<button class='btn ".$this->getButton()->getClasses()->getColor()."' onclick=\"".$swal."\">".$name."</button>";
    }
    
    public function createConfirmAlert($name, $acao){
        $this->createButtonAlert($name, $this->buildSwalConfirmAlert($acao));
    }
    
    
    public function createInputAlert($name){
        $this->createButtonAlert($name, $this->buildInputAlert());
    }
    
    function getButton() {
        return $this->button;
    }

    function setButton($button) {
        $this->button = $button;
    }

    function getTitle() {
        return $this->title;
    }

    function getText() {
        return $this->text;
    }

    function getType() {
        return $this->type;
    }

    function getShowCancelButton() {
        return $this->showCancelButton;
    }

    function getConfirmButtonColor() {
        return $this->confirmButtonColor;
    }

    function getConfirmButtonText() {
        return $this->confirmButtonText;
    }

    function getCloseOnConfirm() {
        return $this->closeOnConfirm;
    }

    function getCloseOnCancel() {
        return $this->closeOnCancel;
    }

    function getSuccessTitle() {
        return $this->successTitle;
    }

    function getSuccessText() {
        return $this->successText;
    }

    function getErrorTitle() {
        return $this->errorTitle;
    }

    function getErrorText() {
        return $this->errorText;
    }

    function getStatus() {
        return $this->status;
    }

    function getImageUrl() {
        return $this->imageUrl;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setShowCancelButton($showCancelButton) {
        $this->showCancelButton = $showCancelButton;
    }

    function setConfirmButtonColor($confirmButtonColor) {
        $this->confirmButtonColor = $confirmButtonColor;
    }

    function setConfirmButtonText($confirmButtonText) {
        $this->confirmButtonText = $confirmButtonText;
    }

    function setCloseOnConfirm($closeOnConfirm) {
        $this->closeOnConfirm = $closeOnConfirm;
    }

    function setCloseOnCancel($closeOnCancel) {
        $this->closeOnCancel = $closeOnCancel;
    }

    function setSuccessTitle($successTitle) {
        $this->successTitle = $successTitle;
    }

    function setSuccessText($successText) {
        $this->successText = $successText;
    }

    function setErrorTitle($errorTitle) {
        $this->errorTitle = $errorTitle;
    }

    function setErrorText($errorText) {
        $this->errorText = $errorText;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    function getCancelButtonText() {
        return $this->cancelButtonText;
    }

    function setCancelButtonText($cancelButtonText) {
        $this->cancelButtonText = $cancelButtonText;
    }

    function getIsHtml() {
        return $this->isHtml;
    }

    function setIsHtml($isHtml) {
        $this->isHtml = $isHtml;
    }

    function getHasTimer() {
        return $this->hasTimer;
    }

    function setHasTimer($hasTimer) {
        $this->hasTimer = $hasTimer;
    }

    function getInputPlaceholder() {
        return $this->inputPlaceholder;
    }

    function setInputPlaceholder($inputPlaceholder) {
        $this->inputPlaceholder = $inputPlaceholder;
    }
    function getTextInputError() {
        return $this->TextInputError;
    }

    function setTextInputError($TextInputError) {
        $this->TextInputError = $TextInputError;
    }




    
}
//<button class="btn btn-default" onclick="swal('Here\'s a message!');">Open Alert</button>
//<button class="btn btn-default" onclick="swal('Here\'s a message!', 'It\'s pretty, isn\'t it?');">Open Alert</button>
//<button class="btn btn-default" onclick="swal('Good job!', 'You clicked the button!', 'success');">Open Alert</button>
//<button class="btn btn-default" onclick="swal({title: 'Auto close alert!', text: 'I will close in 2 seconds.', timer: 2000, showConfirmButton: false});">Open Alert</button>


