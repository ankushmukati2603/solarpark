<?php $__env->startSection('content'); ?>

<section class="section dashboard">
    <main id="main" class="main">

        <section class="form_sctn">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>Change Password</h1>
                            <hr style="color: #959595;">
                        </div>


                        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                        <div class="clearfix"></div><br>
                        <!-- <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/add-bidder')); ?>" class="btn btn-success"
            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add Bidder</a> -->

                        <form action="<?php echo e($submitUrl); ?>" id="changePasswordForm" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">

                                <label for="current_password"><?php echo e(__('Current Password')); ?><span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="current_password" autocomplete="off">
                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password"><?php echo e(__('New Password')); ?><span
                                        class="text-danger">*</span></label>
                                <input type="password" data-placement="bottom" data-toggle="popover"
                                    data-trigger="focus" data-html="true" data-content='<div id="errors"></div>'
                                    class="form-control required passwordStrength" minlength="6" id="new_password"
                                    name="new_password" autocomplete="off">
                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation"><?php echo e(__('Confirm Password')); ?><span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" autocomplete="off">
                                <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                        </form>
    </main>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<!-- <script type="text/javascript">
$(function() {
    $('#changePasswordForm').validate();
    $("#new_password_confirmation").rules('add', {
        equalTo: "#new_password",
        messages: {
            equalTo: "Not matched with password."
        }
    });
});
</script> -->
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/reia/changePassword.blade.php ENDPATH**/ ?>