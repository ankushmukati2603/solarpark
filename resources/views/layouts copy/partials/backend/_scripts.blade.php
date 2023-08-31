<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/password-validation.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/adminlte.min.js')}}"></script>

<script type="text/javascript">
var baseUrl = '{{URL::to("/")}}';
var validator = '';
</script>
<script type="text/javascript" src="{{asset('public/js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/sweetalert2/sweetalert2.min.js?202206071444')}}"></script>





@stack('backend-js')