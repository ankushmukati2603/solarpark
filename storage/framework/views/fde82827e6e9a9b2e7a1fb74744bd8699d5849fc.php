
<?php $__env->startSection('title', 'Change Password'); ?>
<?php $__env->startSection('content'); ?>
<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-6 col-xl-6 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Change Password</h1>
                    <hr style="color: #959595;">

                    <form action="<?php echo e($submitUrl); ?>" id="changePasswordForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group pt-3">
                            <label for="current_password"><?php echo e(__('Current Password')); ?> <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="current_password" id="current_password"
                                autocomplete="off" required>
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
                        <div class="form-group pt-3">
                            <label for="new_password"><?php echo e(__('New Password')); ?> <span
                                    class="text-danger">*</span></label>
                            <input type="password" data-placement="bottom" data-toggle="popover" data-trigger="focus"
                                data-html="true" data-content='<div id="errors"></div>'
                                class="form-control required passwordStrength" minlength="6" id="new_password"
                                name="new_password" autocomplete="off">
                            <span style="color:red;font-style: italic;font-size:12px;">Password should be taken atleast
                                1 uppercase, atleast 1 lowercase, atleast 1 digit ,atleast 1 special characters</span>
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
                        <div class="form-group pt-3">
                            <label for="new_password_confirmation"><?php echo e(__('Confirm Password')); ?> <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" required id="new_password_confirmation"
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
                        <div class="text-center pt-3"><input type="submit" class="mt-1 btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
Session::put('random_session_id1',time().rand('10000', '99999'));
Session::put('random_session_id2',rand());
?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script>
$(document).ready(function() {
    // $('#current_password,#new_password,#new_password_confirmation').bind("cut copy paste",function(e) {
    //     e.preventDefault();
    // });
});
</script>
<script src="<?php echo e(asset('public/js/crypto-js.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/aes.min.js')); ?>"></script>
<script type="text/javascript">
document.querySelector('#changePasswordForm').addEventListener('submit', (e) => {
    e.preventDefault();

    // var id = document.getElementById("email");      
    // var pwd = document.getElementById("password");
    // var id1 = <?php echo e(Session::get('random_session_id2')); ?>+id.value+<?php echo e(Session::get('random_session_id1')); ?>;
    // var pwd1 = <?php echo e(Session::get('random_session_id2')); ?>+pwd.value+<?php echo e(Session::get('random_session_id1')); ?>;

    // var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    // var iv =  CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");


    // var encId = CryptoJS.AES.encrypt(id1, key, {iv,padding: CryptoJS.pad.ZeroPadding,});
    // var encPwd = CryptoJS.AES.encrypt(pwd1, key, {iv,padding: CryptoJS.pad.ZeroPadding,});
    // id.value = encId.toString();
    // pwd.value = encPwd.toString();
    // var loginForm = document.getElementById("formLogin");
    // loginForm.submit();



    var current_password = document.getElementById("current_password").value;

    var new_password = document.getElementById("new_password").value;
    var new_password_confirmation = document.getElementById("new_password_confirmation").value;

    var current_password1 = {
        {
            Session::get('random_session_id2')
        }
    } + current_password + {
        {
            Session::get('random_session_id1')
        }
    };

    var new_password1 = {
        {
            Session::get('random_session_id2')
        }
    } + new_password + {
        {
            Session::get('random_session_id1')
        }
    };
    var new_password_confirmation1 = {
        {
            Session::get('random_session_id2')
        }
    } + new_password_confirmation + {
        {
            Session::get('random_session_id1')
        }
    };

    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
    var enccurrent_password = CryptoJS.AES.encrypt(current_password1, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });

    var encnew_password = CryptoJS.AES.encrypt(new_password1, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    var encnew_password_confirmation = CryptoJS.AES.encrypt(new_password_confirmation1, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });

    //alert(encPwd.toString());
    $('#current_password').val(enccurrent_password.toString());
    $('#new_password').val(encnew_password.toString());
    $('#new_password_confirmation').val(encnew_password_confirmation.toString());

    var loginForm = document.getElementById("changePasswordForm");
    loginForm.submit();
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/changePassword.blade.php ENDPATH**/ ?>