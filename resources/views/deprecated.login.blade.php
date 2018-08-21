<!DOCTYPE html>
<html lang="en">
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
                        <form action="/validate" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="login" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Senha">
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="app-checkbox">
                                            <label><input type="checkbox" name="app-checkbox-1" value="0"> Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <button class="btn btn-success btn-block">Logar</button>
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