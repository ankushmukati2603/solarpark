
<?php $__env->startSection('content'); ?>
<section class="section dashboard">
    <main id="main" class="main">


        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Selected Bidder</h1>
                        <hr style="color: #959595;">

                    </div>
                </div>
                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/SelectedBidder')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('backend/state-implementing-agency/tenderSearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <table class="table table-bordered" style="display:none" id="reversTable">
                        <tr>
                            <td colspan="5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Bidder<span class="text-danger">*</span></th>
                                            <th>Selected Bidders Capacity (MW)<span class="text-danger">*</span></th>
                                            <th>Bidders Selection Date<span class="text-danger">*</span></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr id="">
                                            <td width="50%" class="row-index">
                                                <select name="bidder_id[]" id="bidder_id0" class="form-control  number">
                                                    <option value="">Choose Bidder</option>
                                                    <?php $__currentLoopData = $bidderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($bidder->id); ?>"><?php echo e($bidder->bidder_name); ?>

                                                        [<?php echo e($bidder->state_name); ?>]</option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span name="bidder_id.0"></span>
                                            </td>
                                            <td width="40%"> <input type="number" step="any" min="0"
                                                    name="select_bidders_capacity[]" id="capacity_alloted_0"
                                                    class="form-control capacity_alloted" value=""
                                                    onkeyup="checlTotalCapacity();">
                                                <span name="select_bidders_capacity.0"></span>
                                            </td>
                                            <!-- <td width="30%"> <input type="date" name="bidder_selected_date[]"
                                                id="bidder_selected_date" class="form-control" value="">
                                            <span name="bidder_selected_date.0"></span>
                                        </td> -->
                                            <td class="text-center">
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
                </form>
            </div>

        </section>
    </main>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script>
function checlTotalCapacity() {
    var totalCapacity = $('#tender_capacity').html();
    // alert(totalCapacity);
    var sum = 0;
    $(".capacity_alloted").each(function() {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
        if (parseInt(totalCapacity) < sum) {
            alert('Total capacity should not be greater than Tender capacity i.e ' + totalCapacity + ' MW');
            this.value = '';
            return false;
        }
    });

}

function checkDuplicate(dt) {
    var id = $(dt).val();
    let count = $('#tbody tr').length;
    for (var i = 0; i < (count - 1); i++) {
        if ($('#bidder_id' + i).val() == id) {
            alert('Duplicate entry not allowed');
            $(dt).val('');
            return false;
        }
    }

}
$(document).ready(function() {
    // Denotes total number of rows
    //<td> <input type="date" name="bidder_selected_date[]" id="bidder_selected_date" class="form-control" value="">
    //      <span name="bidder_selected_date.${rowIdx}"></span>
    //</td>
    var rowIdx = 0;
    // jQuery button click event to add a row
    $('#addBtn').on('click', function() {
        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
            <td class="row-index">
                <select name="bidder_id[]" id="bidder_id${rowIdx}" class="form-control  number" onchange="checkDuplicate(this)">
                    <option value="">Choose Bidder</option>
                    <?php $__currentLoopData = $bidderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($bidder->id); ?>"><?php echo e($bidder->bidder_name); ?>

                        [<?php echo e($bidder->state_name); ?>]</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span name="bidder_id.${rowIdx}"></span>
            </td>
            
            <td> <input type="number" step="any" min="0" name="select_bidders_capacity[]"
                    id="capacity_alloted_${rowIdx}" class="form-control capacity_alloted"
                    value="" onkeyup="checlTotalCapacity();">
                    <span name="select_bidders_capacity.${rowIdx}"></span>
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
</script>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/selectedBidder.blade.php ENDPATH**/ ?>