<script src="/js/vendors.js"></script>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/modal.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/', ['lang' => Lang::getLocale()])) !!};
</script>
<!-- Scripts -->
<script>
$('div.alert').not('.alert-danger').delay(2000).slideUp(300);
</script>
