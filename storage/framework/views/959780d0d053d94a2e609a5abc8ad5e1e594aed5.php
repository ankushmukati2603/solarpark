
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Edit Profile'); ?>
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </nav>
        </div>
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Edit Profile</h1>
                    <hr style="color: #959595;">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/edit-profile')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label for="email"><?php echo e(__('Email')); ?> <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="name"><?php echo e(__('Name')); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="contact_no"><?php echo e(__('Contact No')); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact_no" value="<?php echo e($user->contact_no); ?>">
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label>State<span class="text-danger">*</span></label>
                                <select class="form-control  select21" id="txtState" name="state"
                                    onchange="getDistrictByState(this.value,'')">
                                    <option disabled selected>Select</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state->code); ?>" <?php if($user->state==$state->code): ?>
                                        selected
                                        <?php endif; ?>>
                                        <?php echo e($state->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label>District<span class="text-danger">*</span></label>
                                <select class="form-control " id="district_id" name="district_id">
                                    <option value="" selected>Select District</option>
                                </select>

                            </div>

                        </div>

                        <p>If you want to change your password <a
                                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/change-password')); ?>"
                                class="text-primary">Click
                                Here</a>
                        </p>
                        <input type="submit" class="mt-1 btn btn-primary" id="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>

<?php if($user->state > 0): ?>

<script>
$(document).ready(function() {
    getDistrictByState('<?php echo e($user->state); ?>', '<?php echo e($user->district_id); ?>');


});
</script>
<?php endif; ?>
<!-- 
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script> -->
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/editProfile.blade.php ENDPATH**/ ?>