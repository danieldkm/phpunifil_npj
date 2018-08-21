<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{{$inicial->getTitulo()}}}</title>
        @include('partials.meta-section')
        @include('partials.style-include')
        @include('partials.styles.basic-css')
        @stack('css')
<!--
        include('partials.scripts-importante-include')
        include('partials.scripts-app-include')
-->
        @if ($inicial->getHasOnload())
        <script>
//            function initApp(){
//                $.blockUI({
//                    message: "<div id='load'><div>O</div><div>D</div><div>N</div><div>A</div><div>G</div><div>E</div><div>R</div><div>R</div><div>A</div><div>C</div></div>",
//                    css: { border: 'none' }
//                });
//            }
        </script> 
        <script>    
//            $(window).load(function() {
//                initApp();
//            })
        </script>
        @endif    
    </head>
    @if ($inicial->getHasOnload())
<!--        <body onload="{{{$inicial->getOnLoad()}}}">-->
        <body>
    @elseif ($hasClass)
        <body class="{{{$class}}}">
    @else
        <body>
    @endif
        <!-- APP WRAPPER -->
        
        <div class="app">
            <!-- START APP CONTAINER -->
            <div class="app-container">
                @include('partials.sidebars.default-fixed')
                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    @yield('content')
                </div>
                <!-- END APP CONTENT -->
            </div>
            <!-- END APP CONTAINER -->
            
            @include('partials.sidepanels.default')
            
            <!-- APP OVERLAY -->
            <div class="app-overlay"></div>
            <!-- END APP OVERLAY -->
        </div>        
        <!-- END APP WRAPPER -->
        @include('partials.scripts.basic-scripts')
        @stack('javascript')
    </body>
</html>