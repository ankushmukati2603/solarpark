<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">
    <section class="form_sctn" >
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
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost:81/solar_park/beneficiary">Home</a></li>
                    <li class="breadcrumb-item active">Progress Report Data</li>
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
                        <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/new-stu-progress_report')); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                          
                            <div class="row">
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>Tender/ Bidding Agency for RE Projects, if any <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Tender/ Bidding Agency for RE Projects, if any" name="tender_bidding_agency" type="text"
                                            class="form-control" value="<?php echo e($editProgressData->tender_bidding_agency ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('tender_bidding_agency')); ?></span>
                                </div></br>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>Project Details(Name of Developer)<span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Project Details (Name of Developer)" name="developer_name" type="text"
                                            class="form-control" value="<?php echo e($editProgressData->developer_name ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('developer_name')); ?></span>
                                </div></br>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>Capacity for connectivity applied (MW)<span class="text-danger">*</span></strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Capacity for connectivity applied (MW)" name="capacity_connectivity" type="text"
                                            class="form-control" value="<?php echo e($editProgressData->capacity_connectivity ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('capacity_connectivity')); ?></span>
                                </div></br>

                                <h5 class="pb-3">Project Location</h5>
                                
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>State <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                    <select class="form-control" id="state_id" name="state_id" onchange="getDistrictByState(this.value, '')">
                                        <option value="">Select State</option>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($state->code); ?>"  <?php if($editProgressData->state_id == $state->code): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('state_id')); ?></span>
                                </div></br>
                                
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>District <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                        <select class="form-control required select21" id="district_id"
                                            name="district_id" onchange="getSubDistrictByDistrict(this.value,'')">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('district_id')); ?></span>
                                </div></br>
                                
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>Sub-District <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                        <select class="form-control  required select21" id="sub_district_id"
                                            name="sub_district_id" onchange="getVillageBySubDistrict(this.value,'')">
                                            <option value="" selected disabled>Select Sub-District</option>

                                        </select>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('sub_district_id')); ?></span>
                                </div></br>
                               
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label for="name"><strong>Sub Station Location District <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Sub Station Location District" name="sub_station" type="text"
                                            class="form-control" value="<?php echo e($editProgressData->developer_name ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('sub_station')); ?></span>
                                </div></br>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Connectivity Basis <span class="text-danger">*</span></strong></label>
                                    <select class="form-control" id="connectivity_basis" name="connectivity_basis" >
                                        <option value="">Select Project</option>
                                        <option value="LTA"  <?php if($editProgressData->connectivity_basis == 'LTA'): ?> selected <?php endif; ?> >LTA</option>
                                        <option value="PPA" <?php if($editProgressData->connectivity_basis == 'PPA'): ?> selected <?php endif; ?> >PPA</option>
                                        <option value="BG" <?php if($editProgressData->connectivity_basis == 'BG'): ?> selected <?php endif; ?> >BG</option> 
                                        <option value="LAND" <?php if($editProgressData->connectivity_basis == 'LAND'): ?> selected <?php endif; ?> >LAND</option>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('connectivity_basis')); ?></span>
                                </div></br>


                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong> LTA operationalization date  <span class="text-danger">*</span>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input name="lta_operationalization_date" id="lta_operationalization_date" type="date"
                                               class="form-control" value="<?php echo e($editProgressData->lta_operationalization_date ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('lta_operationalization_date')); ?></span>
                                </div></br>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong> Capacity commissioned in the current month (MW), if any<span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Capacity commissioned in the current month(MW), if any" name="capacity_commissioned"
                                               id="capacity_commissioned" type="number" class="form-control"
                                               value="<?php echo e($editProgressData->capacity_commissioned ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('capacity_commissioned')); ?></span>
                                </div></br>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Cumulative Capacity Commissioned (MW), if any<span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Capacity commissioned in the current month(MW), if any" name="cumulative_capacity"
                                               id="cumulative_capacity" type="number" class="form-control"
                                               value="<?php echo e($editProgressData->cumulative_capacity ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('cumulative_capacity')); ?></span>
                                </div></br>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Cumulative Capacity Commissioned Date<span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Cumulative Capacity Commissioned Date" name="cumulative_capacity_date"
                                               id="cumulative_capacity_date" type="date" class="form-control"
                                               value="<?php echo e($editProgressData->cumulative_capacity_date ?? ''); ?>">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('cumulative_capacity_date')); ?></span>
                                </div></br>

                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Remarks / Issues, if any <span class="text-danger">*</span></strong></label>
                                    <div class="input-group mb-3">
                                        <textarea name="remark" id="remark"
                                            class="form-control"><?php echo e($editProgressData->remark ?? ''); ?></textarea>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('remark')); ?></span>
                                </div></br>
                                <div class="col-xxl-12 text-center pt-3 pb-3">
                                    <!-- <input type="submit" id="submit"
                                        class="mt-1 btn btn-success <?php if(isset($editable)): ?> hidden <?php endif; ?>" value="Save">
                                        <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>"> -->

                                <input type="submit" name="save" class="mt-1 btn btn-success" value="Save as draft" >
                                <input type="submit" name="submit" class="mt-1 btn btn-success" value="Submit">
                            
                                <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                <input type="hidden" name="final" id="final" value="0">

                                <!-- <input type="submit" id="submitytr" name="save" > -->
                                    <!-- <?php if(($newGecData->final_submission ?? '') == 0): ?>
                                    <input type="button" class="mt-1 btn btn-success" name="final_submission"
                                        onclick="final_submission_save()" value="Final Submission">
                                    <input type="hidden" name="editId" value="<?php echo e($newGecData->id ?? ''); ?>">
                                    <input type="hidden" name="submit_type" id="submit_type" value="0">
                                    <?php endif; ?>  -->
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark  footer_nav">
    <div class="container-fluid d-flex justify-content-center">
        <div class="copyright-content d-flex align-items-center justify-content-center">
            <img class="footer_nic_logo" src="<?php echo e(URL::asset('public/images/footerNIC.png')); ?>">
            <div> Portal Content Managed by <strong> <a title="GoI, External Link that opens in a new window"
                        href="https://mnre.gov.in"><strong>Ministry of New and Renewable
                            Energy</strong></a></strong>
                <br><span>Designed, Developed and Hosted by <a title="NIC, External Link that opens in a new window"
                        href="https://www.nic.in"><strong class="highlight_text_blue">National Informatics
                            Centre (NIC)</strong></a></span>
            </div>
        </div>
    </div>
</nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->startPush('backend-js'); ?>
<!-- <script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script> -->
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>

<!-- sanjeev -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<script>

$(document).ready(function() {
    //alert('hi');
    getDistrictByState('<?php echo e($editProgressData->state_id); ?>', '<?php echo e($editProgressData->district_id); ?>');
    getSubDistrictByDistrict('<?php echo e($editProgressData->district_id); ?>',
        '<?php echo e($editProgressData->sub_district_id); ?>');

});


function submitMe(dt){
    // alert($(dt).attr('name'));
    if($(dt).attr('name') =='submit'){
        $('#final').val(0);
    }else{
        $('#final').val(1);
    }
    $('#submit').trigger("click");
}

// function final_submission_save() {
//     if (confirm('Are You Sure ? Once You Submit Your Application, You Will Not Update it Latter')) {
//         $('#submit_type').val(1);
//         $('#submit').trigger('click');
//     } else {
//         return false;
//     }
// }

// $(function() {
//     $("#mnre_sanction_date").datepicker({
//         maxDate: 0,
//         dateFormat: 'dd/mm/yy',
//     });
//     $("#mnre_sanction_date,#tender_notice_date,#last_submission_date,#technical_bid_opening_date,#award_package_date,#comm_date_award_letter")
//         .datepicker({
//             dateFormat: 'dd/mm/yy',
//         });
// });
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
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/stu/progress_report/progressReport.blade.php ENDPATH**/ ?>