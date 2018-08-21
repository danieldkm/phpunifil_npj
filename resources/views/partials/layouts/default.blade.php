<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
       
        @if (!is_null($inicial))
            <title>{{{$inicial->getTitulo()}}}</title>
        @else
            <title>{{{$titulo}}}</title>
        @endif
        @include('partials.meta-section')
        @include('partials.style-include')
        @include('partials.styles.basic-css')
        @stack('css')
    </head>
    @if (!is_null($inicial))
         @if ($inicial->getHasOnload())
         @endif
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
            
<!--
            @if(Auth::check())
                <a href="{{ url('/login') }}" class="btn btn-danger navbar-btn navbar-right">Sair</a>
            @else
                <a href="{{ url('/') }}" class="btn btn-success navbar-btn navbar-right">Entrar</a>
            @endif
-->
            
<!--            @include('partials.footers.extended')-->
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