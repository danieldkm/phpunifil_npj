<?php
   

class Padrao {
    
    
    function getScript($path){
        if (is_null($path)){
            echo "<!-- IMPORTANT SCRIPTS -->";
            echo "<script type='text/javascript' src='/npj/js/vendor/jquery/jquery.min.js'></script>";
            echo "<script type='text/javascript' src='/npj/js/vendor/jquery/jquery-ui.min.js'></script>";
            echo "<script type='text/javascript' src='/npj/js/vendor/bootstrap/bootstrap.min.js'></script>";
            echo "<script type='text/javascript' src='/npj/js/vendor/moment/moment.min.js'></script>";
            echo "<script type='text/javascript' src='/npj/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js'></script>";
            echo "<!-- END IMPORTANT SCRIPTS -->";

            echo "<!-- APP SCRIPTS -->";
            echo "<script type='text/javascript' src='/npj/js/app.js'></script>";
            echo "<script type='text/javascript' src='/npj/js/app_plugins.js'></script>";
            echo "<script type='text/javascript' src='/npj/js/app_demo.js'></script>";
            echo "<!-- END APP SCRIPTS -->";
            echo "<script type='text/javascript' src='/npj/js/app_demo_dashboard.js'></script>";    
        } else {
            echo "<!-- IMPORTANT SCRIPTS -->";
            echo "<script type='text/javascript' src='".$path."js/vendor/jquery/jquery.min.js'></script>";
            echo "<script type='text/javascript' src='".$path."js/vendor/jquery/jquery-ui.min.js'></script>";
            echo "<script type='text/javascript' src='".$path."js/vendor/bootstrap/bootstrap.min.js'></script>";
            echo "<script type='text/javascript' src='".$path."js/vendor/moment/moment.min.js'></script>";
            echo "<script type='text/javascript' src='".$path."js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js'></script>";
            echo "<!-- END IMPORTANT SCRIPTS -->";

            echo "<!-- APP SCRIPTS -->";
            echo "<script type='text/javascript' src='".$path."js/app.js'></script>";
            echo "<script type='text/javascript' src='".$path."js/app_plugins.js'></script>";
            echo "<script type='text/javascript' src='".$path."js/app_demo.js'></script>";
            echo "<!-- END APP SCRIPTS -->";
            echo "<script type='text/javascript' src='".$path."js/app_demo_dashboard.js'></script>";    
        }
    }
    
    
    function getSideBar(){
        echo   "<div class='app-sidebar app-navigation app-navigation-fixed scroll app-navigation-style-default app-navigation-open-hover dir-left' data-type='close-other'>
                    <a href='index.php' class='app-navigation-logo'>
                        Unifil na prática muito mais experiência
                        <button class='app-navigation-logo-button mobile-hidden' data-sidepanel-toggle='.app-sidepanel'><span class=icon-alarm'></span> <span class='app-navigation-logo-button-alert'>7</span></button>
                    </a>
                    <nav>
                        <ul>
                            <li class='title'>MAIN</li>
                            <li><a href='/npj/index.php'><span class='nav-icon-hexa text-bloody-100'>Pr</span>Principal</a></li>
                            <li class='title'>Núcleo</li>
                            <li>
                            <a href='#'><span class='nav-icon-hexa text-orange-300'>Npj</span> Núcleo de Práticas Júridicas <span class='label label-success label-bordered label-ghost'></span></a>
                            <ul>
                                <li>
                                    <a href='#'><span class='nav-icon-hexa text-yellow-100'>Cl</span> Clientes</a>
                                    <ul>                
                                        <li><a href='/npj/php/controller/cliente/page-npj-clientes-buscar.php'><span class='nav-icon-circle'>Bu</span> Buscar</a></li>
                                        <li><a href='/npj/php/controller/cliente/page-npj-clientes-cadastrar.php'><span class='nav-icon-circle'>Cd</span> Cadastrar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'><span class='nav-icon-hexa text-indigo-300'>Pr</span> Processos</a>
                                    <ul>                
                                        <li><a href='page-npj-processos-buscar.html'><span class='nav-icon-circle'>Bu</span> Buscar</a></li>
                                        <li><a href='page-npj-processos-arquivado.html'><span class='nav-icon-circle'>Aq</span> Arquivado</a></li>
                                    </ul>
                                </li>
                                <li><a href='#'><span class='nav-icon-hexa text-orange-300'>Ap</span> Acompanhamento</a></li>
                            </ul>
                            </li>
                            <li class='title'>Ajuda</li>
                            <li><a href='#'><span class='nav-icon-hexa text-yellow-100'>Sp</span>TI Suporte</a></li>
                            <li><a href='#'><span class='nav-icon-hexa text-yellow-100'>Si</span>TI Sistema</a></li>
                        </ul>
                    </nav>
                </div>";
    }
    
    
    function getAppHeader($path){
        echo   "    <div class='app-header'>
                        <ul class='app-header-buttons'>
                            <li class='visible-mobile'><a href='#' class='btn btn-link btn-icon' data-sidebar-toggle='.app-sidebar.dir-left'><span class='icon-menu'></span></a></li>
                            <li class='hidden-mobile'><a href='#' class='btn btn-link btn-icon' data-sidebar-minimize='.app-sidebar.dir-left'><span class='icon-menu'></span></a></li>
                        </ul>
                        <form class='app-header-search' action='' method='post'>        
                            <input type='text' name='keyword' placeholder='Search'>
                        </form>    
                    
                        <ul class='app-header-buttons pull-right'>
                            <li>
                                <div class='contact contact-rounded contact-bordered contact-lg contact-ps-controls'>
                                    <img src='".$path."assets/images/users/user_1.jpg' alt='John Doe'>
                                    <div class='contact-container'>
                                        <a href='#'>John Doe</a>
                                        <span>Administrator</span>
                                    </div>
                                    <div class='contact-controls'>
                                        <div class='dropdown'>
                                            <button type='button' class='btn btn-default btn-icon' data-toggle='dropdown'><span class='icon-cog'></span></button>                        
                                            <ul class='dropdown-menu dropdown-left'>
                                                <li><a href='#'><span class='icon-cog'></span> Settings</a></li> 
                                                <li><a href='#'><span class='icon-envelope'></span> Messages <span class='label label-danger pull-right'>+24</span></a></li>
                                                <li><a href='#'><span class='icon-users'></span> Contacts <span class='label label-default pull-right'>76</span></a></li>
                                                <li class='divider'></li>
                                                <li><a href='#'><span class='icon-exit'></span> Log Out</a></li> 
                                            </ul>
                                        </div>                    
                                    </div>
                                </div>
                            </li>        
                        </ul>
                    </div>";
    }
    
    
    function getPageHeading(){
        echo "";
    }
    
}

    