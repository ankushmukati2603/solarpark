
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/js/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('public/js/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('public/js/base_forms_validation.js') }}"></script>
<script src="{{ URL::asset('public/js/password-validation.js') }}"></script>
<script src="{{ URL::asset('public/js/icheck.min.js') }}"></script>
<script src="{{ URL::asset('public/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ URL::asset('public/js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('public/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.2/dist/Chart.min.js"></script>
<script type="text/javascript">
    var baseUrl = {!! json_encode(url('/')) !!}
    var validator = '';
    @if(Session::has('msg'))
        $('#msgModal').modal('show');
    @endif
</script>
<script src="{{ URL::asset('public/js/common.js') }}"></script>
