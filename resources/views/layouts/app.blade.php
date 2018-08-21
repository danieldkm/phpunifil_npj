<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>                        
        <title>UniFil - Login</title>       
        @include('partials.meta-section')
        @include('partials.style-include')
    </head>
    <body>        
        
        <!-- APP WRAPPER -->
        <div class="app app-fh">

            <!-- START APP CONTAINER -->
            <div class="app-container" style="background: url(assets/images/background/bg-1.jpg) center center no-repeat fixed;">
                
                <div class="app-login-box">                                        
                    <div class="app-login-box-user"><img src="img/user/no-image.png"></div>
                    <div class="app-login-box-title">
<!--
                        <div class="title">Already a member?</div>
                        <div class="subtitle">Sign in to your account</div>                        
-->
                    </div>
                    
                    <div class="app-login-box-container">
                       
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Senha">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>    
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="app-checkbox">
                                            <label><input type="checkbox" name="app-checkbox-1" value="0" {{ old('remember') ? 'checked' : '' }}> Lembrar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <button type="submit" class="btn btn-success btn-block">Logar</button>
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Esqueceu a senha?
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    
<!--
                    
                    <div class="app-login-box-or">
                        <div class="or">OR</div>
                    </div>
                    <div class="app-login-box-container">
                        <button class="btn btn-facebook btn-block">Connect With Facebook</button>
                        <button class="btn btn-twitter btn-block">Connect With Twitter</button>
                    </div>
-->
                    <div class="app-login-box-footer">
                        &copy; UniFil 2017. Todos os direitos reservados.
                    </div>
                </div>
                                
            </div>
            <!-- END APP CONTAINER -->
           
        </div>        
        <!-- END APP WRAPPER -->                
        
        @include('partials.scripts-importante-include')
        @include('partials.scripts-app-include')
    </body>
</html>
