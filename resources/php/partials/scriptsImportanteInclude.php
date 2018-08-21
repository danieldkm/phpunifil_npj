<?php
    if (!isset($path)){
        require_once($_SERVER["DOCUMENT_ROOT"]."/npj/php/partials/path.php");
    }
    $scriptImportanteInclude =
            "<!-- IMPORTANT SCRIPTS -->".
            "<script type='text/javascript' src='".$path."js/vendor/jquery/jquery.min.js'></script>".
            "<script type='text/javascript' src='".$path."js/vendor/jquery/jquery-ui.min.js'></script>".
            "<script type='text/javascript' src='".$path."js/vendor/bootstrap/bootstrap.min.js'></script>".
            "<script type='text/javascript' src='".$path."js/vendor/moment/moment.min.js'></script>".
            "<script type='text/javascript' src='".$path."js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js'></script>".
            "<!-- END IMPORTANT SCRIPTS -->";
?>