
<?php $__env->startSection('content'); ?>

<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Tender Commissioning</h1>
                    <hr style="color: #959595;">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/TenderCommissioning')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
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
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Select Bidder <span class="text-danger">*</span></label></div>
                                <div id="bidders_list"><select name="bidders" id="bidders"
                                        class="form-control tenderSelectBox">
                                        <option value="">Choose Bidder</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Select Project <span class="text-danger">*</span></label></div>
                                <div><select name="projects" id="projects" class="form-control tenderSelectBox">
                                        <option value="">Choose Bidder</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered" style="display:none" id="reversTable">
                            <tr>
                                <td colspan="5">
                                    <table class="table table-bordered">

                                        <thead>
                                            <tr class="bg-primary text-light">
                                                <th>Scheduled commissioning Date (as per PPA) <span
                                                        class="text-danger">*</span>
                                                </th>
                                                <th> Scheduled commissioning Date (Revised/ extended)</th>
                                                <th colspan="2">Commissioned Capacity (MW) <spanclass="text-danger">
                                                        *</span>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tr>
                                            <th><input type="date" name="schedule_commissiong_date"
                                                    id="schedule_commissiong_date" class="form-control" value="">
                                            </th>
                                            <th><input type="date" name="revised_schedule_commissiong_date"
                                                    id="revised_schedule_commissiong_date" class="form-control"
                                                    value=""></th>
                                            <th colspan="2"><input type="number" step="any" min="0"
                                                    name="commissioned_capacity" id="commissioned_capacity"
                                                    class="form-control" value=""
                                                    placeholder="Enter Commissioned Capacity (MW)"></th>

                                        </tr>
                                        <tr>
                                            <th colspan="4">
                                                <br>
                                            </th>
                                        </tr>
                                        <tr class="bg-primary text-light">
                                            <th>Actual Commissiong Date<span class="text-danger">*</span></th>
                                            <th>Actual Commissiong Capacity (MW)<span class="text-danger">*</span>
                                            </th>

                                            <th colspan="2"></th>
                                        </tr>
                                        <tbody id="tbody">
                                            <tr id="">
                                                <td width="33%" class="row-index">
                                                    <input type="date" name="actual_commissiong_date[]"
                                                        id="txtgeneralLatitude" class="form-control" value="">
                                                    <span name="actual_commissiong_date.0"></span>
                                                </td>

                                                <td width="33%"> <input type="number" step="any" min="0"
                                                        name="actual_commissioned_capacity[]" id="txtgeneralLatitude"
                                                        class="form-control" value=""
                                                        placeholder="Enter Actual Commissioned Capacity (MW)">
                                                    <span name="actual_commissioned_capacity.0"></span>
                                                </td>
                                                <td colspan="2" class="text-center">
                                                    <button class="btn btn-md btn-primary" id="addBtn" type="button">
                                                        Add new Row
                                                    </button>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <input type="hidden" id="page_type" name="page_type" value="<?php echo e($page ?? ''); ?>">
                                    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                </td>
                            </tr>
                        </table>

                        <span id="ppaData"></span>

                    </form>
                </div>
            </div>
        </div>

    </section>
</main>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script>
$(document).ready(function() {

    var rowIdx = 0;
    // jQuery button click event to add a row
    $('#addBtn').on('click', function() {
        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
         <td class="row-index">
                <input type="date" name="actual_commissiong_date[]" id="txtgeneralLatitude" class="form-control" value="">
                <span name="actual_commissiong_date.${rowIdx}"></span>
            </td>
            <td> <input type="number" step="any" min="0" name="actual_commissioned_capacity[]"
                    id="txtgeneralLatitude" class="form-control"
                    value="" placeholder="Enter Actual Commissioned Capacity (MW)">
                    <span name="actual_commissioned_capacity.${rowIdx}"></span>
            </td>
            <td class="text-center">
                <button class="btn btn-danger remove"
                type="button">Remove</button>
                </td>
            </tr>`);
    });
    $('#tbody').on('click', '.remove', function() {
        var child = $(this).closest('tr').nextAll();
        child.each(function() {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
        });
        $(this).closest('tr').remove();
        rowIdx--;
    });
});
$('#tender_id').on('change', function() {
    $('#ppaTbale').html('');
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
        $('#projects').html('<option value="">Choose Tender</option>');
        $('#bidders').html('<option value="">Choose Tender</option>');

    }

});
$('#bidders').on('change', function() {
    $('#ppaTbale').html('');
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/ajaxGetProjectListByBidder/' + bidders + '/' +
                tender_id,
            success: function(data) {
                $('#loading-bg-ajax').addClass('hide');
                if (data.status == 'success') {
                    $('#projects').html(data.result);
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
$('#projects').on('change', function() {
    $('#ppaTbale').html('');
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    var project_id = $('#projects').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/ajaxGetCommissionDetails/' + project_id,
            success: function(data) {
                $('#loading-bg-ajax').addClass('hide');
                // alert(
                //     "TypeError: filter is not a function in JavaScript.Uncaught (in promise) TypeError: Failed to fetch at XNm(m = f6apvd: 8: 451) at FOm(m = f6apvd: 18: 729) at jPm(m = f6apvd: 43: 318) at _.dPm.LJc(m = f6apvd: 42: 273) at m = m, m_i, i20jfd,lKrWxc, hkjXJ, gYOl6d, HXLjIb, DL8jZe, xaQcye, J41knb, oRmHt, E1P0kd,xivAT, ZUhrff, M184fc, Z16oCd, bfl9hd, dIhbmc, Gi2hff, wHcxDd, wS0DLb,Q8AZuf, V88ABc, Nzme9: 46: 2383 "
                // );
                // console.log(
                //     'TypeError: filter is not a function in JavaScript.Uncaught (in promise) TypeError: Failed to fetch at XNm(m = f6apvd: 8: 451) at FOm(m = f6apvd: 18: 729) at jPm(m = f6apvd: 43: 318) at _.dPm.LJc(m = f6apvd: 42: 273) at m = m, m_i, i20jfd,lKrWxc, hkjXJ, gYOl6d, HXLjIb, DL8jZe, xaQcye, J41knb, oRmHt, E1P0kd,xivAT, ZUhrff, M184fc, Z16oCd, bfl9hd, dIhbmc, Gi2hff, wHcxDd, wS0DLb,Q8AZuf, V88ABc, Nzme9: 46: 2383 '
                // );
                // return false;
                if (data.status == 'success') {
                    $('#ppaTbale').show();
                    $('#ppaData').html(data.result);

                } else {
                    $('#ppaData').html('');
                    $('#reversTable').show();

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
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/state-implementing-agency/tendercommissioning.blade.php ENDPATH**/ ?>