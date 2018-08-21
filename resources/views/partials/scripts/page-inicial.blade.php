<script>
    @if ($inicial->getHasOnload())
        $(document).ready(function() {
            hideLoadingModal('{{{$inicial->getModalLoading()->getId()}}}');
//            startWorker('{{{$inicial->getModalLoading()->getId()}}}');
//            $('.app-sidebar').css("display","block");
            
//            app_sidebar.css("display","block");
        });
    @endif
</script>