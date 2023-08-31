
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Developer</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/mnredeveloper-list')); ?>" method="post" id=" ">
                        <?php echo csrf_field(); ?>
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                    <!-- <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button> -->
                </div>
            </div>

            <div class="clearfix"></div><br>
            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/developer-mnre')); ?>" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-dark text-dark">
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Solar Park Name</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Sub-District</th>
                    <th>Village</th>
                    <th>User Type</th>
                    <!-- <th>Action</th> -->
                </tr>
                <?php $__currentLoopData = $developerDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $developerReport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($developerReport->name); ?></td>
                    <td><?php echo e($developerReport->email); ?></td>
                    <td><?php echo e($developerReport->contact_no); ?></td>
                    <td><?php echo e($developerReport->solar_park_name); ?></td>
                    <td><?php echo e($developerReport->state_name); ?></td>
                    <td><?php echo e($developerReport->district_name); ?></td>
                    <td><?php echo e($developerReport->sub_districts_name); ?></td>
                    <td><?php echo e($developerReport->village_name); ?></td>
                    <td>
                        <?php if($developerReport->user_type ==1): ?>
                        self
                        <?php elseif($developerReport->user_type ==2): ?>
                        Mnre
                        <?php else: ?>
                        Mnre
                        <?php endif; ?>
                    </td>
                    <!-- <td><a href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/developer-mnre/Edit/'.$developerReport['id'])); ?>"
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
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/developerList.blade.php ENDPATH**/ ?>