<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap_5.min.js')}}"></script>
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


<!-- backend script Dashboard -->

<script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>



<!-- <script src="{{asset('public/js/main.js')}}"></script> -->
<script>
$(document).ready(function() {
    $('#example').DataTable({

    });
});
</script>
<style>
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.3em 0.5em !important;

}

li.paginate_button.active a {
    background-color: #e5e5e5;
    padding: 3px 7px;
    /* border-radius: 10px; */
    border: 1px solid #ccc;
}
</style>

<script>
$('#tender').on('change', function() {
    // $("#searchTender").click(function() {
    var tender = $('#tender').val();
    var page_type = $('#page_type').val();
    $('#reversTable').hide();
    var output = '';
    $('#tenderDetails').html('Loading....');
    if (tender) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/ajaxtender/' + page_type + '/' + tender,
            success: function(data) {
                if (data.status == 'error') {
                    $('#tenderDetails').html('No Record Found.');
                } else {
                    $('#tenderDetails').html(data.result);
                    if (data.tenderData == null) {
                        $('#reversTable').show();
                    }
                }
            }
        });
    } else {
        alert('Please select Tender');
    }

});
$(document).ready(function() {
    $(".tenderSelectBox").select2();
});
</script>

@stack('backend-js')