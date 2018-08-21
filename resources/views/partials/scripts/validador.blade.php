<script type='text/javascript' src='/js/vendor/form-validator/jquery.form-validator.min.js'></script>
<script type="text/javascript">
    $.validate({
        modules : 'date,file,location',
        onValidate: function(){
            delayBeforeFire(function(){                                                
                app.spy();
            },100);  
        }
    });
</script>