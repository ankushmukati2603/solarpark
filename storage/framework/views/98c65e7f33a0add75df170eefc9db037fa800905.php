
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Agency/Add')); ?>" class="btn btn-success"
                            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add Agency</a>
                        <h1>Agency Management</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th width="5%">S.No</th>
                                <th width="15%">Agency Name</th>
                                <th width="25%">Contact Person Details</th>
                                <th width="20%">Address</th>
                                <th>State</th>
                                <th>District</th>
                                <th width="5%">Action</th>
                            </tr>
                            <?php if(!$agencyList->isEmpty()): ?>
                            <?php $__currentLoopData = $agencyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($agency->agency_name); ?></td>
                                <td>
                                    Name : <?php echo e($agency->contact_person_name); ?><br>
                                    Email : <?php echo e($agency->contact_person_email); ?> <br>
                                    Number : <?php echo e($agency->contact_person_number); ?>

                                </td>
                                <td><?php echo e($agency->agency_address); ?></td>
                                <td><?php echo e($agency->state_name); ?></td>
                                <td><?php echo e($agency->district_name); ?></td>
                                <td><a
                                        href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/Agency/Edit/'.$agency->id)); ?>">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7">No Record Found</td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>

                    <?php echo e($agencyList->links()); ?>

                </div>
            </div>

    </main>
</section>
<!-- </section> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/agency.blade.php ENDPATH**/ ?>