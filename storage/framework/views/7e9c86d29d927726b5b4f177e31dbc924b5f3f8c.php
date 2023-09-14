<?php $__env->startSection('content'); ?>


<section class="section dashboard form_sctn">
    <main id="main" class="main">
        <div class="pagetitle">

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Progress Report</li>
                </ol>
            </nav>
        </div>
        <?php if(session()->has('message')): ?>
        <div class="alert alert-dark">
            <?php echo e(session()->get('message')); ?>

        </div>
        <?php endif; ?>



        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1 class="text-center">Development of Solar Parks and Ultra Mega Solar Power Projects <br>
                        <h4 class="text-center">Progress Report</h4>
                    </h1>

                    <a href="javascript:;" onclick="$('#advance_search').toggle()"
                        style="color:blue;float:right">Advance
                        Search</a>
                    <form action="<?php echo e(url(Auth::getDefaultDriver().'/my-progress-report')); ?>" method="post"
                        style="display:none" id="advance_search">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>State </label></div>
                                <div class=""><select class="form-control  select" id="txtState" name="state"
                                        onchange="getDistrictByState(this.value,'')">
                                        <option disabled selected>Select State</option>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($state->code); ?>" <?php if(isset($generalData['general']['state'] )
                                            && $state->
                                            code==$generalData['general']['state']): ?>selected
                                            <?php endif; ?>>
                                            <?php echo e($state->name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('state')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>District </div>
                                <div class=""><select class="form-control  select" id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                        <option value="" selected>Select District</option>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('district_id')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Submitted On </div>
                                <div class=""> <input type="date" class="form-control pull-right alldatepicker "
                                        id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="date" value="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Park Name </div>
                                <div class=""><input type="text" name="park_name" placeholder="Name" id="txtName"
                                        class="form-control " value="<?php echo e($generalData['general']['park_name'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Approved Capacity (in MW) </div>
                                <div class=""><input type="number" step="any" min="0" name="capacity"
                                        id="txtgeneralLatitude" class="form-control" value="">
                                    <span class="text-danger"><?php echo e($errors->first('capacity')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3"><br>
                                <button class="btn btn-md btn-info pull-right" type="submit">Search</button>

                            </div>


                        </div>
                    </form>
                    <hr>
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>

                                <th>S.No</th>
                                <th>Park Name</th>
                                <th>Month, Year</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Solar Power Park Developer</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Remarks by MNRE</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!Empty($progressDetails)): ?>
                            <?php $generalData='' ?>
                            <?php $__currentLoopData = $progressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progressData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $generalData=json_decode($progressData['general']); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($progressData['park_name']); ?></td>
                                <td><?php echo e(date('F', mktime(0, 0, 0, $progressData['month'], 10))); ?>,
                                    <?php echo e($progressData['year']); ?>

                                </td>
                                <td><?php echo e($progressData['state_name']); ?></td>
                                <td><?php echo e($progressData['district_name']); ?></td>
                                <td><?php echo e($generalData->park_developer_name ?? ''); ?></td>
                                <td><?php echo e($generalData->email ?? ''); ?></td>
                                <td><?php echo e($generalData->mobile_number ?? ''); ?></td>
                                <td>
                                    <?php if($progressData['submitted_on'] == ''): ?>
                                    Not Submitted Yet
                                    <?php else: ?>
                                    <?php echo e($progressData['submitted_on']); ?>

                                    <?php endif; ?>

                                </td>
                                <td> <?php if($progressData['final_submission'] == '1'): ?>
                                    Submitted
                                    <?php else: ?>
                                    Draft
                                    <?php endif; ?>
                                </td>
                                <td> <?php if($progressData['remarks'] == ''): ?>
                                    No Remark Yet
                                    <?php else: ?>
                                    <?php echo e($progressData['remarks']); ?>

                                    <?php endif; ?>
                                </td>
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

                            <?php endif; ?>
                        </tbody>
                    </table><br>
                    <span class="text-center"><a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/new-progress-report')); ?>"
                            class="btn btn-success" style="margin-right:5px;"><i class="fa fa-plus"
                                aria-hidden="true"></i>Progress Report</a></span>
                </div>
            </div>
        </div>

    </main>
</section>

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/myProgressReport.blade.php ENDPATH**/ ?>