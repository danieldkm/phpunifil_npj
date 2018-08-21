<?php
    if (!isset($path)){
        require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
    }
    $scriptAppInclude =
                "<!-- APP SCRIPTS -->".
                "<script type='text/javascript' src='".$path."js/app.js'></script>".
                "<script type='text/javascript' src='".$path."js/app_plugins.js'></script>".
                "<script type='text/javascript' src='".$path."js/app_demo.js'></script>".
                "<!-- END APP SCRIPTS -->";