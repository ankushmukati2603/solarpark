<?php $general = app('App\Http\Controllers\Backend\Mnre\MainController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Feedback</h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-dark text-dark">
                                    <th>S.No</th>
                                    <th>User Type</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Contact Number</th>
                                    <th width="20%">Feedback</th>
                                    <th>Submitted On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $feedbacklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(ucfirst($feedback->user_type) ?? '--'); ?></td>
                                    <td><?php echo e($feedback->name ?? '--'); ?></td>
                                    <td><?php echo e($feedback->email ?? '--'); ?></td>
                                    <td><?php echo e($feedback->contact_no ?? '--'); ?></td>
                                    <td><?php echo e($feedback->message ?? '--'); ?></td>
                                    <td><?php echo e($feedback->created_date ?? '--'); ?></td>
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
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/feedbacklist.blade.php ENDPATH**/ ?>