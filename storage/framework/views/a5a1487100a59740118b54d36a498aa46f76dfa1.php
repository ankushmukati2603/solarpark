
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>MNRE</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/mnre-list')); ?>" method="post" id=" ">
                        <?php echo csrf_field(); ?>
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                    <!-- <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button> -->
                </div>
            </div>

            <div class="clearfix"></div><br>
            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/mnre-form')); ?>" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-dark text-dark">
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Designation Name</th>
                    <th>User Type</th>
                    <!-- <th>Action</th> -->
                </tr>
                <?php $__currentLoopData = $mnreuserDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mnreuserList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($mnreuserList->name); ?></td>
                    <td><?php echo e($mnreuserList->email); ?></td>
                    <td><?php echo e($mnreuserList->mobile_number); ?></td>
                    <td><?php echo e($mnreuserList->designation_name); ?></td>
                    <td>
                        <?php if($mnreuserList->user_code ==0): ?>
                        admin
                        <?php elseif($mnreuserList->user_code ==1): ?>
                        Solar Park
                        <?php else: ?>
                        Solar Power
                        <?php endif; ?>
                    </td>
                    <!-- <td><a href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/mnre-form/Edit/'.$mnreuserList['id'])); ?>"
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
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/mnreList.blade.php ENDPATH**/ ?>