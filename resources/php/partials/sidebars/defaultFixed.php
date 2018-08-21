<?php
    if(!isset($fullPath)){
        require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
    }
    require_once $fullPath.'php/partials/navigation/navigationList.php';
    $defaultFixed = 
        "<!--START SIDEBAR-->".
            "<div class='app-sidebar app-navigation app-navigation-fixed scroll app-navigation-style-default app-navigation-open-hover dir-left' data-type='close-other'>".
            "<a href='index.php' class='app-navigation-logo'>".
                "Unifil na prática muito mais experiência".
                "<button class='app-navigation-logo-button mobile-hidden' data-sidepanel-toggle='.app-sidepanel'><span class='icon-alarm'></span> <span class='app-navigation-logo-button-alert'>7</span></button>".
            "</a>".
            $navigationList.    
        "</div>".
        "<!--END SIDEBAR-->";