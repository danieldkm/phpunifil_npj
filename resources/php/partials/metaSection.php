<?php
    
if(!isset($path)){
    require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
}
    $metaSection = 
            "<!-- META SECTION -->".
            "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>".
            "<meta http-equiv='X-UA-Compatible' content='IE=edge'>".
            "<meta name='viewport' content='width=device-width, initial-scale=1'>".

            "<link rel='shortcut icon' href='".$path."favicon.ico' type='image/x-icon'>".
            "<link rel='icon' href='".$path."favicon.ico' type='image/x-icon'>".
            "<!-- END META SECTION -->";