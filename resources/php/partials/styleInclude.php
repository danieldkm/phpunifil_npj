<?php
    if (!isset($path)){
        require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
    }
    $styleInclude =
            "<!-- CSS INCLUDE -->".
            "<link rel='stylesheet' href='".$path."css/styles.css'>".
            "<!-- EOF CSS INCLUDE -->";