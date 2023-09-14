<?php $__env->startSection('content'); ?>

<section class="section dashboard form_sctn">

    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Consolidate Report</li>
                </ol>
            </nav>
        </div>
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1 class="text-center">Development of Solar Parks and Ultra Mega Solar Power Projects
                        <br>Consolidate Report
                    </h1>
                    <hr style="color: #959595;">
                    <form action="<?php echo e(url(Auth::getDefaultDriver().'/consolidate-report')); ?>" method="post"><?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>From</label></div>
                                <div class=""><input type="date" id="date" class="form-control" placeholder=""
                                        name="fromdata">
                                    <span class="text-danger"><?php echo e($errors->first('fromDate')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>To</label></div>
                                <div><input type="date" id="date" class="form-control " placeholder="" name="todata">
                                    <span class="text-danger"><?php echo e($errors->first('toDate')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Status</label></div>
                                <div><select name="status" class="form-control" id="status">
                                        <option value="" selected>Select Status</option>
                                        <option value="1">All</option>
                                        <option value="2">Submitted</option>
                                        <option value="3">Approved</option>
                                        <option value="4">Rejected</option>
                                        <option value="5">Send back for correct</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class=" pt-4 text-center1">
                                    <button class="btn btn-md btn-primary pull-right" type="submit">Search</button>
                                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/consolidate-report')); ?>"
                                        class="btn btn-danger">Reset</a>
                                </div>
                            </div>

                        </div>
                    </form>
                    <hr>
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr class=" bg-primary text-light">
                                <th>S.No</th>
                                <th>Park Name</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Sub-District</th>
                                <th>Solar Power Park Developer</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($progressDetails)): ?>
                            <?php $generalData=''; ?>
                            <?php $__currentLoopData = $progressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progressData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $generalData=json_decode($progressData['general']); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($progressData['park_name']); ?></td>

                                <td><?php echo e($progressData['state_name']); ?></td>
                                <td><?php echo e($progressData['district_name']); ?></td>
                                <td><?php echo e($progressData['sub_district_name']); ?></td>
                                <td><?php echo e($generalData->park_developer_name ?? ''); ?></td>
                                <td><?php echo e($generalData->email ?? ''); ?></td>
                                <td><?php echo e($generalData->mobile_number ?? ''); ?></td>
                                <td><?php echo e($progressData['submitted_on']); ?></td>
                                <td> <?php if($progressData['final_submission'] == '1'): ?>
                                    <span>Submitted</span>
                                    <?php else: ?>
                                    <span>Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/preview-consolidate-report/'.$progressData['id'])); ?>"
                                        class="btn btn-primary btn-sm "><i class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </main>
</section>
<?php $__env->stopSection(); ?>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/consolidate_report/consolidateReport.blade.php ENDPATH**/ ?>