<script type="text/javascript" src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/dataTables.bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/bootstrap_5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/additional-methods.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/password-validation.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/select2.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/adminlte.min.js')); ?>"></script>

<script type="text/javascript">
var baseUrl = '<?php echo e(URL::to("/")); ?>';
var validator = '';
</script>
<script type="text/javascript" src="<?php echo e(asset('public/js/common.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/sweetalert2/sweetalert2.min.js?202206071444')); ?>"></script>


<!-- backend script Dashboard -->

<script src="<?php echo e(asset('public/js/bootstrap.bundle.min.js')); ?>"></script>



<!-- <script src="<?php echo e(asset('public/js/main.js')); ?>"></script> -->


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
            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/ajaxtender/' + page_type + '/' + tender,
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

<?php echo $__env->yieldPushContent('backend-js'); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/layouts/partials/backend/_scripts.blade.php ENDPATH**/ ?>