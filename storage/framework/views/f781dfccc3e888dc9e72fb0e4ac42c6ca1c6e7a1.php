
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>Recieved Report
                            Development of Solar Parks and Ultra Mega Solar Power Projects
                        </h1>

                        <hr style="color: #959595;">
                        <form action="<?php echo e(url(Auth::getDefaultDriver().'/progress-report')); ?>" method="post"><?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label>State<span class="error"></span></label>
                                        <select class="form-control  select" id="txtState" name="state"
                                            onchange="getDistrictByState(this.value,'')">
                                            <option disabled selected>Select State</option>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($state->code); ?>" <?php if(isset($generalData['general']['state']
                                                ) && $state->
                                                code==$generalData['general']['state']): ?>selected
                                                <?php endif; ?>>
                                                <?php echo e($state->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('state')); ?></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>District<span class="error"></span></label>
                                        <select class="form-control  select" id="district_id" name="district_id"
                                            onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                            <option value="" selected>Select District</option>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('district_id')); ?></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Submitted On</label>
                                        <div class="input-group date">
                                            <input type="date" class="form-control pull-right alldatepicker "
                                                id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="date"
                                                value="">
                                        </div>
                                        <span class="text-danger"><?php echo e($errors->first('date')); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="col-md-3 col-sm-12">
                                    <label>Park Name<span class="text-danger">*</span></label>
                                    <input type="text" name="park_name" placeholder="Name" id="txtName"
                                        class="form-control " value="<?php echo e($generalData['general']['park_name'] ?? ''); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('park_name')); ?></span>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label>Approved Capacity (in MW)<span class="error"></span></label>
                                    <input type="number" step="any" min="0" name="capacity" id="txtgeneralLatitude"
                                        class="form-control" value="">
                                    <span class="text-danger"><?php echo e($errors->first('capacity')); ?></span>
                                </div>
                                <div class="col-md-2 pb-3"><br>
                                    <button class="btn btn-md btn-info pull-right" type="submit">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="clearfix"></div><br>


                        <table class="table table-bordered">
                            <tr class=" bg-primary">
                                <th>S.No</th>
                                <th>Park Name</th>
                                <th width="15%">Progress Report (Month , Year)</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Solar Power Park Developer</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <!-- <th>Approved Capacity (in MW)</th> -->
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Remarks by MNRE</th>
                                <th>Action</th>
                            </tr>
                            <?php if(!Empty($progressDetails)): ?>
                            <?php $generalData='' ?>
                            <?php $__currentLoopData = $progressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progressData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $generalData=json_decode($progressData['general']); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($progressData['park_name']); ?></td>
                                <td>
                                    <?php echo e(date("F", mktime(0, 0, 0, $progressData['month'], 10))); ?>,
                                    <?php echo e($progressData['year']); ?>

                                </td>
                                <td><?php echo e($progressData['state_name']); ?></td>
                                <td><?php echo e($progressData['district_name']); ?></td>
                                <td><?php echo e($generalData->park_developer_name); ?></td>
                                <td><?php echo e($generalData->email ?? ''); ?></td>
                                <td><?php echo e($generalData->mobile_number); ?></td>
                                <td><?php echo e($progressData['submitted_on']); ?></td>
                                <td> <?php if($progressData['final_submission'] == '1'): ?>
                                    <span>Submitted</span>
                                    <?php else: ?>
                                    <span>Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td></td>
                                <td><?php if($progressData['final_submission']==0): ?>
                                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report/'.$progressData['id'])); ?>"
                                        class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                    <?php else: ?>
                                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/preview-progress-report/'.$progressData['id'])); ?>"
                                        class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="11">No Record Found</td>
                            </tr>
                            <?php endif; ?>

                            <!-- <a href=" <?php echo e(URL::to('developerData')); ?>">Form</a> -->
                        </table>
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
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/myProgressReport.blade.php ENDPATH**/ ?>