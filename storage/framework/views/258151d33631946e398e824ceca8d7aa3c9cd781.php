
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Agency</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/agency-list')); ?>" method="post" id=" ">
                        <?php echo csrf_field(); ?>
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                    <!-- <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button> -->
                </div>
            </div>

            <div class="clearfix"></div><br>
            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/agency-mnre')); ?>" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-dark text-dark">
                    <th>S.No</th>
                    <th>SNA Name</th>
                    <!-- <th>Agency Type</th> -->
                    <th>Contact Number</th>
                    <th>Email ID</th>
                    <th>Office Addess</th>
                    <th>Zip Code</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Sub-District</th>
                    <th>Village</th>
                    <!-- <th>Action</th> -->
                </tr>

                <?php $__currentLoopData = $agencyDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agencyList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($agencyList->name); ?></td>
                    <!-- <td><?php echo e($agencyList->agency_type); ?></td> -->
                    <td><?php echo e($agencyList->phone); ?></td>
                    <td><?php echo e($agencyList->email); ?></td>
                    <td><?php echo e($agencyList->office_addess); ?></td>
                    <td><?php echo e($agencyList->zipcode); ?></td>
                    <td><?php echo e($agencyList->state_name); ?></td>
                    <td><?php echo e($agencyList->district_name); ?></td>
                    <td><?php echo e($agencyList->sub_districts_name); ?></td>
                    <td><?php echo e($agencyList->village_name); ?></td>

                    <!-- <td><a href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/deveagency-mnreloper/Edit/'.$agencyList['id'])); ?>"
                            class="btn btn-primary">Edit</a> </td> -->
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- <tr>
                    <td colspan="11">No Record Found</td>
                </tr> -->
            </table>
    </main>
</section>
<!-- </section> -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/agencyList.blade.php ENDPATH**/ ?>