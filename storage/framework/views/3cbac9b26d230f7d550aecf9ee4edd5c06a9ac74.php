
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Edit Profile'); ?>
<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Edit Profile</h1>
                    <hr style="color: #959595;">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/edit-profile')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-md-6 col-sm-12 pb-3">

                                <label for="email"><?php echo e(__('Email')); ?> <span class="error">*</span></label>
                                <input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" readonly>
                            </div>

                            <div class="col-md-6 col-sm-12 pb-3">
                                <label for="name">SNA Name <span class="error">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>">
                            </div>
                            <div class="col-md-6 col-sm-12 pb-3">
                                <label for="email">Contact Person Name <span class="error">*</span></label>
                                <input type="text" class="form-control" name="contact_person"
                                    value="<?php echo e($user->contact_person); ?>">
                            </div>
                            <div class="col-md-6 col-sm-12 pb-3">
                                <label for="contact_no">Contact Person Number <span class="error">*</span></label>
                                <input type="text" class="form-control" name="phone" value="<?php echo e($user->phone); ?>">

                            </div>

                            <div class="col-md-126 col-sm-12 pb-3">
                                <label for="email">Address <span class="error">*</span></label>
                                <textarea name="address" id="address" cols="30" rows="5"
                                    class="form-control"><?php echo e($user->address); ?></textarea>
                            </div>

                            <div class="col-md-6 col-sm-12 pb-3">
                                <label>State<span class="error"> * </span></label>
                                <select class="form-control  select21" id="txtState" name="state"
                                    onchange="getDistrictByState(this.value,'')">
                                    <option disabled selected>Select</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state->code); ?>" <?php if($user->state_id==$state->code): ?> selected
                                        <?php endif; ?>>
                                        <?php echo e($state->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 pb-3">
                                <label>District<span class="error"> * </span></label>
                                <select class="form-control " id="district_id" name="district_id"
                                    onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                    <option value="" selected>Select District</option>
                                </select>
                            </div>


                        </div>

                        <input type="submit" id="submit" class="mt-1 btn btn-primary" value="Submit">

                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/change-password')); ?>"
                            class="text-primary">Click here change
                            password..!!</a>

                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.error {
    color: red
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>

<?php if($user->state_id > 0): ?>

<script>
$(document).ready(function() {
    //alert('hi');
    getDistrictByState('<?php echo e($user->state_id); ?>', '<?php echo e($user->district_id); ?>');
    getSubDistrictByDistrict('<?php echo e($user->district_id); ?>',
        '<?php echo e($user->sub_district_id); ?>');

    // // block table k  column ka name
    getVillageBySubDistrict('<?php echo e($user->sub_district_id); ?>',
        '<?php echo e($user->village); ?>');

});
</script>
<?php endif; ?>

<script>
// $(function() {
//     $('#editProfileForm').validate();
// });
// 
</script>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/editProfile.blade.php ENDPATH**/ ?>