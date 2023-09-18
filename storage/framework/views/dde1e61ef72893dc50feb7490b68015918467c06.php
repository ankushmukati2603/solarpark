<?php $general = app('App\Http\Controllers\Backend\Mnre\MainController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Solar Park</h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-dark text-dark">
                                    <th>S.No</th>
                                    <th>SPPD Name</th>
                                    <th>Developer Name</th>
                                    <th>Solar Park</th>
                                    <th>Email ID</th>
                                    <th>Contact Number</th>
                                    <th width="20%">Address</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $solarparkList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $park): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($park->beneficiary_name ?? '--'); ?></td>
                                    <td><?php echo e($park->developer_name ?? '--'); ?></td>
                                    <td><?php echo e($park->solar_park_name ?? '--'); ?></td>
                                    <td><?php echo e($park->email ?? '--'); ?></td>
                                    <td><?php echo e($park->mobile_number ?? '--'); ?></td>
                                    <td><?php echo e($park->address ?? '--'); ?></td>
                                    <td><?php echo e($park->state_name ?? '--'); ?></td>
                                    <td><?php echo e($park->district_name ?? '--'); ?></td>
                                    <td></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/solarparkList.blade.php ENDPATH**/ ?>