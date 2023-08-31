
<?php $__env->startSection('content'); ?>
<section class="section dashboard">
    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Signing of PSA</h1>
                        <hr style="color: #959595;">
                        <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/SigningOfPSA')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                    <div class=""><label>Select Tender <span class="text-danger">*</span></label></div>
                                    <div class=""><select name="tender" id="tender_id"
                                            class="form-control tenderSelectBox">
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
                                <tr class="bg-primary text-light">
                                    <th colspan="4">
                                        <h4>PPA/PSA Details</h4>
                                    </th>
                                </tr>
                                <span id="ppaData"></span>


                            </table>

                        </form>
                    </div>
                </div>

        </section>
    </main>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>

<script>
$('#tender_id').on('change', function() {
    var tender = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    $('#ppaData').html('');
    if (tender) {
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
    }

});
$('#bidders').on('change', function() {
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/ajaxSelectedBidderPSAData/' + bidders + '/' +
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
    }
});
</script>


<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/signingofppapsa.blade.php ENDPATH**/ ?>