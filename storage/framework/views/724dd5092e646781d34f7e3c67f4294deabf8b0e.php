
<?php $__env->startSection('content'); ?>

<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Commissioned Details</h1>
                    <hr style="color: #959595;">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/Commissioned')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row tenderBlock1">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Select Tender <span class="text-danger">*</span></label></div>
                                <div class=""><select name="tender" id="tender_id" class="form-control tenderSelectBox">
                                        <option value="">Select Tender</option>
                                        <?php $__currentLoopData = $tenderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(base64_encode($tender->id)); ?>">
                                            [<?php echo e($tender->tender_no); ?>] - <?php echo e($tender->nit_no); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <i id="bidderloader"></i>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Select Bidder <span class="text-danger">*</span></label></div>
                                <div id="bidders_list"><select name="bidders" id="bidders"
                                        class="form-control tenderSelectBox">
                                        <option value="">Choose Bidder</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="ppaTbale" style="display:none;">
                            <span id="ppaData"></span>
                        </table>

                    </form>
                </div>
            </div>
        </div>

    </section>
</main>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script>
$('#tender_id').on('change', function() {
    var tender = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (tender) {
        $('#ppaData').html('');
        $.ajax({
            type: 'GET',
            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/ajaxtenderBidder/' + tender,
            success: function(data) {
                $('#loading-bg-ajax').addClass('hide');
                if (data.status == 'error') {
                    $('#bidders').html(data.result);
                } else {
                    $('#bidders').html(data.result);

                }
            }
        });
    } else {
        alert('Please select Tender');
        $('#loading-bg-ajax').addClass('hide');
    }

});
$('#bidders').on('change', function() {
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/ajaxSelectedBidderRecordsImplemented/' +
                bidders + '/' +
                tender_id,
            success: function(data) {
                $('#loading-bg-ajax').addClass('hide');
                if (data.status == 'success') {
                    $('#ppaTbale').hide();
                    $('#ppaData').html(data.result);
                } else {
                    $('#ppaData').html('');
                    $('#ppaTbale').show();

                }
            }
        });
    } else {
        alert('Please select Bidders');
        $('#loading-bg-ajax').addClass('hide');
    }
});
</script>


<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/commissioned.blade.php ENDPATH**/ ?>