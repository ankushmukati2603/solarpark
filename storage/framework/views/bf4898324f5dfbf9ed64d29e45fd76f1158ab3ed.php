<?php $general = app('App\Http\Controllers\Backend\Mnre\MainController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>GEC Progress Report
                        </h1>

                        <hr style="color: #959595;">
                        <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Package No.</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input type="text" name="package_no" class="form-control"
                                            placeholder="Package Number" value="<?php echo e($generalData->package_no ?? ''); ?>">

                                    </div>
                                </div>
                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Package Name</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input type="text" name="package_name" class="form-control"
                                            placeholder="Package Name" value="<?php echo e($generalData->package_name ?? ''); ?>">

                                    </div>
                                </div>

                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Projects under the Package</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input placeholder="Projects under the Package" name="project_under_package"
                                            type="text" class="form-control"
                                            value="<?php echo e($generalData->project_under_package ?? ''); ?>">
                                    </div>
                                </div>
                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Project Type</strong> <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="project_type" name="project_type">
                                        <option value="">Select Package Name</option>
                                        <option value="1">Line</option>
                                        <option value="2">SS</option>
                                        <option value="3">Bays</option>
                                        <option value="4">Reactors</option>
                                        <option value="5">Procurement Work</option>
                                        <option value="6">Others
                                        </option>
                                    </select>
                                </div>
                                <?php if($generalData['project_type_others']=='6'): ?>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Others" name="project_type_others" id="project_type_others"
                                            type="text" class="form-control"
                                            value="<?php echo e($generalData->project_type_others ?? ''); ?>">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>MNRE sanction date
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input name="mnre_sanction_date" id="mnre_sanction_date" type="date"
                                            class="form-control" value="<?php echo e($generalData->mnre_sanction_date ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of Notice inviting Tender
                                        </strong> <span class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input placeholder="Date of Notice inviting Tender" name="tender_notice_date"
                                            id="tender_notice_date" type="date" class="form-control"
                                            value="<?php echo e($generalData->tender_notice_date ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Last date of submission of Tenders
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Last date of submission of Tenders"
                                            name="last_submission_date" id="last_submission_date" type="date"
                                            class="form-control" value="<?php echo e($generalData->last_submission_date ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of opening Technical Bids
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Date of opening Technical Bids"
                                            name="technical_bid_opening_date" id="technical_bid_opening_date"
                                            type="date" class="form-control"
                                            value="<?php echo e($generalData->technical_bid_opening_date ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of opening Financial Bids
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Date of opening Financial Bids"
                                            name="financial_bid_opening_date" id="financial_bid_opening_date"
                                            type="date" class="form-control"
                                            value="<?php echo e($generalData->financial_bid_opening_date ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of Award of Package</strong> <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Date of Award of Package" name="award_package_date"
                                            id="award_package_date" type="date" class="form-control"
                                            value="<?php echo e($generalData->award_package_date ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Anticipated Commissioning Date as per Award letter
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Anticipated Commissioning Date as per Award letter"
                                            name="comm_date_award_letter" id="comm_date_award_letter" type="date"
                                            class="form-control" value="<?php echo e($generalData->comm_date_award_letter ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>DPR Cost as per Sanction (Rs. Crore)
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="DPR Cost as per Sanction (Rs. Crore)" name="dpr_cost"
                                            id="dpr_cost" type="number" step="any" class="form-control"
                                            value="<?php echo e($generalData->dpr_cost ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Awarded Cost(Rs. Crore)
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Awarded Cost(Rs. Crore)" name="awarded_cost"
                                            id="awarded_cost" type="number" step="any" class="form-control"
                                            value="<?php echo e($generalData->awarded_cost  ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Physical Progress
                                        </strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Physical Progress" name="physical_progess"
                                            id="physical_progess" type="text" class="form-control"
                                            value="<?php echo e($generalData->physical_progess ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Expenditure in Package (Rs. Crore)</strong> <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Expenditure in Package" name="package_expenditure"
                                            id="package_expenditure" type="number" step="any" class="form-control"
                                            value="<?php echo e($generalData->package_expenditure ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Financial Progress in % (Expenditure / Awarded
                                            Cost)</strong> <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Expenditure in Package" name="financial_progress" id=""
                                            type="number" step="any" class="form-control"
                                            value="<?php echo e($generalData->financial_progress ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Details of Land/Crop compensation fixation by District
                                            Authorities
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input
                                            placeholder="Details of Land/Crop compensation fixation by District Authorities"
                                            name="land_detail" id="land_detail" type="text" class="form-control"
                                            value="<?php echo e($generalData->land_detail ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Details of Forest Clearance

                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input name="forest_clearance_details" id="forest_clearance_details" type="text"
                                            class="form-control"
                                            value="<?php echo e($generalData->forest_clearance_details ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Remarks / Issues, if any</strong></label>
                                    <div class="input-group mb-3">
                                        <textarea name="remark" id="remark"
                                            class="form-control"><?php echo e($generalData->remark ?? ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12 text-center pt-3 pb-3">
                                    <input type="submit" id="submit"
                                        class="mt-1 btn btn-success <?php if(isset($editable)): ?> hidden <?php endif; ?>" value="Save"
                                        onclick="">
                                    <?php if(($generalData->final_submission ?? '') == 0): ?>
                                    <input type="button" class="mt-1 btn btn-success" name="final_submission"
                                        onclick="final_submission_save()" value="Final Submission">
                                    <input type="hidden" name="editId"
                                        value="<?php echo e($general->encodeid($generalData->id) ?? ''); ?>">
                                    <input type="hidden" name="submit_type" id="submit_type" value="0">
                                    <?php endif; ?>
                                </div>
                        </form>
                    </div>

                </div>
            </div>

    </main>
    <style>
    .col-md-3 {
        flex: 0 0 auto;
        width: 25%;
        display: inline-block !important;
    }
    </style>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>

<!-- sanjeev -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<script>
function final_submission_save() {
    if (confirm('Are You Sure ? Once You Submit Your Application, You Will Not Update it Latter')) {
        $('#submit_type').val(1);
        $('#submit').trigger('click');
    } else {
        return false;
    }
}
</script>

<!-- sanjeev -->
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/gecdeveloper/progress_report/progressReport.blade.php ENDPATH**/ ?>