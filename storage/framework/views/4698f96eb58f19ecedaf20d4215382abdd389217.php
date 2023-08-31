
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Solar Park List</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Solar Park List
                            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/add-solar-park')); ?>"
                                class="btn btn-success" style="float: right;"><i class="fa fa-plus"
                                    aria-hidden="true"></i>
                                Add New Park</a>
                        </h1>

                        <hr style="color: #959595;">


                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th>S.No</th>
                                <th>Park Name</th>
                                <th>Developer Name</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>PAN Number</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Sub-District</th>
                                <th>Village</th>
                                <th>Action</th>
                            </tr>
                            <?php $__currentLoopData = $mnreuserDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mnreuserList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($mnreuserList->solar_park_name); ?></td>
                                <td><?php echo e($mnreuserList->developer_name); ?></td>
                                <td><?php echo e($mnreuserList->email); ?></td>
                                <td><?php echo e($mnreuserList->mobile_number); ?></td>
                                <td><?php echo e($mnreuserList->pan_no); ?></td>
                                <td><?php echo e($mnreuserList->state_name); ?></td>
                                <td><?php echo e($mnreuserList->district_name); ?></td>
                                <td><?php echo e($mnreuserList->sub_districts_name); ?></td>
                                <td><?php echo e($mnreuserList->village_name); ?></td>
                                <td>
                                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/add-solar-park/'.$mnreuserList->id)); ?>"
                                        class="text-danger">Edit</a> |
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?php echo e($mnreuserList->id); ?>">View</a>

                                    <div class="modal fade" id="exampleModal<?php echo e($mnreuserList->id); ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Project Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Solar Park Name</th>
                                                            <td>
                                                                <?php echo e($mnreuserList->solar_park_name); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Developer Name</th>
                                                            <td><?php echo e($mnreuserList->developer_name); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>
                                                                <?php echo e($mnreuserList->email); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mobile Number</th>
                                                            <td><?php echo e($mnreuserList->mobile_number); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>PAN No.</th>
                                                            <td>
                                                                <?php echo e($mnreuserList->pan_no); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>State Name</th>
                                                            <td><?php echo e($mnreuserList->state_name); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>District Name</th>
                                                            <td>
                                                                <?php echo e($mnreuserList->district_name); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sub-District Name</th>
                                                            <td><?php echo e($mnreuserList->sub_districts_name); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Village Name</th>
                                                            <td>
                                                                <?php echo e($mnreuserList->village_name); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td><?php echo e($mnreuserList->address); ?></td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <?php echo e($mnreuserDetail->links()); ?>

                    </div>
                </div>
            </div>
    </main>
</section>
<!-- </section> -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/beneficiary/solarParkList.blade.php ENDPATH**/ ?>