<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.validate.min.js')}}"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="{{asset('public/js/password-validation.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
    var baseUrl = {!! json_encode(url('/')) !!}
    var validator = '';
</script>
<script type="text/javascript" src="{{asset('public/js/common.js')}}"></script>
@stack('backend-js')
