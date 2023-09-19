<?php $general = app('App\Http\Controllers\Backend\REIA\MainController'); ?>

<?php $__env->startSection('content'); ?>

<section class="section dashboard">

    <main id="main" class="main">
        <section class="form_sctn">
            <div class="row">

            </div>
            <div class="row">

                <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>Progress Report</h1>
                            <hr style="color: #959595;">
                        </div>
                        <!-- <div class="pagetitle">
            <h1></h1>
            <nav>
                <ol class="breadcrumb">

                </ol>
            </nav>
        </div> -->
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="row   register_form">
                                    <div class="col-xl-12">
                                        <div class="col-xxl-12 section-tittle">
                                            <div class="register_hdng_text"></div>
                                        </div>
                                        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <form
                                            action="<?php echo e(URL::to(Auth::getDefaultDriver().'/new-reia-progress-report/')); ?>"
                                            method="post">
                                            <?php echo csrf_field(); ?>

                                            <div class="row ">
                                                <div class="col-md-12 progress_report_form"
                                                    style="background: #f7f7f7; border: 1px solid #dedede; padding-top: 20px; padding-bottom: 20px; border-radius: 8px;box-shadow: 0 0 15px #0000001f;">
                                                    <div class="row">
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Name of Scheme <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="scheme_id"
                                                                name="scheme_id">
                                                                <?php $__currentLoopData = $schemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($reia->scheme_id ==
                                                                $scheme->id): ?>
                                                                <option value="<?php echo e($scheme->id); ?>" <?php if($reia->scheme_id ==
                                                                    $scheme->id): ?> selected readonly
                                                                    <?php endif; ?>><?php echo e($scheme->scheme_name); ?>

                                                                </option>
                                                                <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </select>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>State <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="state_id" name="state_id"
                                                                onchange="getDistrictByState(this.value, '')">
                                                                <option value="">Select State</option>
                                                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($state->code); ?>" <?php if($reia->state_id ==
                                                                    $state->code): ?> selected <?php endif; ?>><?php echo e($state->name); ?>

                                                                </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>District <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="district_id"
                                                                name="district_id"
                                                                onchange="getSubDistrictByDistrict(this.value,'')">
                                                                <option value="">Select District</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Type of Project <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="project_type"
                                                                name="project_type">
                                                                <option value="">Select Project</option>
                                                                <option value="Solar" <?php if($reia->project_type ==
                                                                    'Solar'): ?> selected <?php endif; ?>>Solar</option>
                                                                <option value="Wind" <?php if($reia->project_type == 'Wind'): ?>
                                                                    selected <?php endif; ?>>Wind</option>
                                                                <option value="Hybrid" <?php if($reia->project_type ==
                                                                    'Hybrid'): ?> selected <?php endif; ?>>Hybrid</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Tender Capacity (MW)
                                                                    <span class="text-danger">*</span></strong></label>
                                                            <div style="position: relative;">
                                                                <input placeholder="Tender Capacity ( MW )"
                                                                    name="tender_capacity" id="tender_capacity"
                                                                    type="number" step="any" class="form-control"
                                                                    value="<?php echo e($reia->tender_capacity ?? ''); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Date of Tender <span
                                                                        class="text-danger">*</span>
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <input name="tender_date" id="tender_date" type="date"
                                                                    class="form-control"
                                                                    value="<?php echo e($reia->tender_date ?? ''); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Date of LOA <span
                                                                        class="text-danger">*</span>
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <input placeholder="Date of LOA" name="loa_date"
                                                                    id="loa_date" type="date" class="form-control"
                                                                    value="<?php echo e($reia->loa_date ?? ''); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>SCoD <span
                                                                        class="text-danger">*</span>
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <input placeholder="Date of Notice inviting Tender"
                                                                    name="scod" id="scod" type="date"
                                                                    class="form-control" value="<?php echo e($reia->scod ?? ''); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Present Status
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <textarea type="text" placeholder="Remarks"
                                                                    name="remark" id="remark" type="text"
                                                                    class="form-control"><?php echo e($reia->remark ?? ''); ?></textarea>
                                                            </div>
                                                        </div>


                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Bidder Name<span class="text-danger">*</span>
                                                                    </th>
                                                                    <th>Bidder Capacity (MW)<span
                                                                            class="text-danger">*</span></th>
                                                                    <th>Date of PPA<span class="text-danger">*</span>
                                                                    </th>
                                                                    <th>PPA Capacity (MW)<span
                                                                            class="text-danger">*</span></th>
                                                                    <th><span class="text-danger"></span></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody">
                                                                <?php if($reia['ppa_capacity']!=null): ?>
                                                                <?php for($i=0;$i < count($reia['bidder_id']);$i++): ?> <tr
                                                                    id="">
                                                                    <td width="" class="row-index">
                                                                        <select name="bidder_id[]" id="bidder_id"
                                                                            class="form-control  number">
                                                                            <option value="">Choose Bidder</option>
                                                                            <?php $__currentLoopData = $bidders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                            <option value="<?php echo e($bidder->id); ?>"
                                                                                <?php if($reia['bidder_id'][$i]==$bidder->id): ?>
                                                                                selected <?php endif; ?>><?php echo e($bidder->bidder_name); ?>

                                                                            </option>

                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <span name="bidder_id.0"></span>
                                                                    </td>

                                                                    <td width="">
                                                                        <input type="number" step="any" min="0"
                                                                            name="select_bidders_capacity[]"
                                                                            id="txtgeneralLatitude" class="form-control"
                                                                            value="<?php echo e($reia['select_bidders_capacity'][$i]); ?>">

                                                                        <span name="select_bidders_capacity.0"></span>

                                                                    </td>
                                                                    <td width="" class="row-index">
                                                                        <input
                                                                            placeholder="Date of Notice inviting Tender"
                                                                            name="ppa_date[]" id="ppa_date" type="date"
                                                                            class="form-control"
                                                                            value="<?php echo e($reia['ppa_date'][$i]); ?>">
                                                                        <span name="ppa_date.0"></span>
                                                                    </td>

                                                                    <td width=""> <input
                                                                            placeholder="Date of Notice inviting Tender (MW)"
                                                                            name="ppa_capacity[]" id="ppa_capacity"
                                                                            type="number" step="any"
                                                                            class="form-control"
                                                                            value="<?php echo e($reia['ppa_capacity'][$i]); ?>">
                                                                        <span name="ppa_capacity.0"></span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if($i==0): ?>
                                                                        <button class="btn btn-md btn-primary"
                                                                            id="addBtn" type="button">
                                                                            Add new Row
                                                                        </button>
                                                                        <?php else: ?>
                                                                        <button class="btn btn-danger remove"
                                                                            type="button">Remove</button>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    </tr>
                                                                    <?php endfor; ?>
                                                                    <?php else: ?>

                                                                    <tr id="">
                                                                        <td width="" class="row-index">
                                                                            <select name="bidder_id[]" id="bidder_id"
                                                                                class="form-control  number">
                                                                                <option value="">Choose Bidder</option>
                                                                                <?php $__currentLoopData = $bidders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($bidder->id); ?>">
                                                                                    <?php echo e($bidder->bidder_name); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                            <span name="bidder_id.0"></span>
                                                                        </td>

                                                                        <td width="">
                                                                            <input type="number" step="any" min="0"
                                                                                name="select_bidders_capacity[]"
                                                                                id="txtgeneralLatitude"
                                                                                class="form-control" value="">

                                                                            <span
                                                                                name="select_bidders_capacity.0"></span>

                                                                        </td>
                                                                        <td width="" class="row-index">
                                                                            <input
                                                                                placeholder="Date of Notice inviting Tender"
                                                                                name="ppa_date[]" id="ppa_date"
                                                                                type="date" class="form-control"
                                                                                value="">
                                                                            <span name="ppa_date.0"></span>
                                                                        </td>

                                                                        <td width=""> <input
                                                                                placeholder="PPA Capacity (MW)"
                                                                                name="ppa_capacity[]" id="ppa_capacity"
                                                                                type="number" step="any"
                                                                                class="form-control" value="">
                                                                            <span name="ppa_capacity.0"></span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <button class="btn btn-md btn-primary"
                                                                                id="addBtn" type="button">
                                                                                Add new Row
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    <?php endif; ?>
                                                            </tbody>
                                                        </table>

                                                        <div class="col-xxl-12 text-center pt-3 pb-3">
                                                            <input type="button" name="save"
                                                                class="mt-1 btn btn-success" value="Save as draft"
                                                                onclick="submitMe(this)">
                                                            <input type="button" name="submit"
                                                                class="mt-1 btn btn-success" value="Submit"
                                                                onclick="submitMe(this)">


                                                            <input type="hidden" name="editId"
                                                                value="<?php echo e($general->encodeid($id) ?? ''); ?>">
                                                            <input type="hidden" name="final" id="final" value="0">
                                                            <input type="submit" id="submit" name="save"
                                                                style="display:none;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<script>
$(document).ready(function() {
    var rowIdx = 0;
    // jQuery button click event to add a row
    $('#addBtn').on('click', function() {
        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
         <td class="row-index">
         <select name="bidder_id[]" id="bidder_id" class="form-control  number">
                    <option value="">Choose Bidder</option>
                    <?php $__currentLoopData = $bidders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bidder->id); ?>"><?php echo e($bidder->bidder_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span name="bidder_id.${rowIdx}"></span>
            </td>
            
            <td> <input type="number" step="any" min="0" name="select_bidders_capacity[]"
                    id="txtgeneralLatitude" class="form-control"
                    value="">
                    <span name="select_bidders_capacity.${rowIdx}"></span>
            </td>
            <td width="" class="row-index">
            <input placeholder="Date of Notice inviting Tender" name="ppa_date[]"  id="ppa_date" type="date" 
            class="form-control" >
                <span name="ppa_date.0"></span>
            </td>

            <td width=""> <input placeholder="Date of Notice inviting Tender (MW)" name="ppa_capacity[]"  
            id="ppa_capacity" type="number" step="any"  class="form-control" value="" >
                <span name="ppa_capacity.0"></span>
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

function submitMe(dt) {
    // alert($(dt).attr('name'));
    if ($(dt).attr('name') == 'submit') {
        $('#final').val(1);
    } else {
        $('#final').val(0);
    }
    $('#submit').trigger("click");
}

$(document).ready(function() {
    //alert('hi');
    getDistrictByState('<?php echo e($reia->state_id); ?>', '<?php echo e($reia->district_id); ?>');
    getSubDistrictByDistrict('<?php echo e($reia->district_id); ?>',
        '<?php echo e($reia->sub_district_id); ?>');

});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}

.row.progress_report_form {
    background: #f7f7f7;
    border: 1px solid #dedede;
    padding-top: 20px;
    padding-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px #0000001f;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/reia/progress_report/progressReport.blade.php ENDPATH**/ ?>