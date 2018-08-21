<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <div id="root">
            <input id="teste" type="text" id="input" v-model="message">
        </div>
        <div>
            <input id="teste1" class="form-control" data-validation="required" placeholder="Required">
        </div>

        <script src="https://unpkg.com/vue@2.3.4"></script>
        @include('partials.scripts-importante-include')
        @include('partials.scripts.validador')
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script>
            
            new Vue({
                
                e1: '#root',
                
                data: {
                    
                    message: 'Hello World!'
                    
                }
                
            })
            
        </script>
    </body>
</html>