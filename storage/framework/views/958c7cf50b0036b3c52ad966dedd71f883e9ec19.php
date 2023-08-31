
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Consumer Interest Form'); ?>
<section class="register_page bg_fade">

    <div class="container-fluid px-5">
        <div class="row pb-5 pt-5">
            <div class="col-xxl-2"></div>
            <div class="col-xxl-8 ">
                <div class="row   register_form">

                    <?php if(session()->has('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="col-xl-4 left_blk">
                        <div><a href="<?php echo e(url('sandes')); ?>"><img src="<?php echo e(URL::asset('public/images/sandes_app_img.png')); ?>"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 right_blk">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text">REGISTER</div>
                        </div>
                        <form action="<?php echo e(URL::to('user-registration')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Name</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Name" name="name" type="text" class="form-control" required>
                                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Select Scheme</strong></label>
                                    <div style="position: relative;">
                                        <select name="scheme_name" id="" class="form-control">
                                            <option value="">Select Scheme</option>
                                            <option value="1">Solar Park </option>
                                            <option value="2">GEC </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Mobile Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                            name="contact_no" id="number" type="text" class="form-control">
                                        <span class="text-danger"><?php echo e($errors->first('contact_no')); ?></span>

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Email ID</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Email" name="email" type="text" class="form-control">
                                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>PAN Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="PAN Number" name="pan_no" id="number" type="text"
                                            class="form-control">
                                        <span class="text-danger"><?php echo e($errors->first('pan_no')); ?></span>

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>State</strong></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select class="form-control required select21" id="state_id" name="state_id"
                                            onchange="getDistrictByState(this.value,'')">

                                            <option value="">Select State</option>
                                            <?php $__currentLoopData = $stateData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($state->code); ?>">
                                                <?php echo e($state->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('state_id')); ?></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>District</strong></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select class="form-control required select21" id="district_id"
                                            name="district_id" onchange="getSubDistrictByDistrict(this.value,'')">
                                            <option value="">Select District</option>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('district_id')); ?></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Sub-District</strong></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select class="form-control  required select21" id="sub_district_id"
                                            name="sub_district_id" onchange="getVillageBySubDistrict(this.value,'')">
                                            <option value="" selected disabled>Select Sub-District</option>

                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('sub_district_id')); ?></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Village</strong></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select class="form-control  select21" id="village_id" name="village">
                                            <option value="" selected disabled>Select Village</option>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('village')); ?></span>
                                    </div>
                                </div>



                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Address</strong></label>
                                    <div class="input-group mb-3">
                                        <textarea name="address" id="" class="form-control" cols="10"
                                            rows="2"></textarea>
                                        <!-- <input placeholder="Address" minlength="6" maxlength="6" min="0" name="pan_no"
                                            id="address" type="text" class="form-control"> -->
                                        <span class="text-danger"><?php echo e($errors->first('pan_no')); ?></span>

                                    </div>
                                </div>
                                <div class="mb-4" id="otpBlock" style="display: none">

                                    <input placeholder="Verify OTP" id="enterOTP" type="number" min="0" maxlegnth="6"
                                        class="form-control">
                                    <span id="msg" class="text-success"></span>

                                </div>


                                <?php if(!env('DEV_ENVIRONMENT')): ?>
                                <div class="col-sm-12 p-0">
                                    <div class="captcha login-captcha col-sm-12">
                                        <?php echo captcha_img('flat'); ?>
                                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                            aria-hidden="true"></i>
                                        <div class="clearfix"></div>
                                        <input type="text" id="captcha-input" class="form-control required"
                                            name="captcha" placeholder="Captcha">
                                    </div>
                                </div>
                                <span class="text-danger"><?php echo e($errors->first('captcha')); ?></span>
                                <?php else: ?>
                                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                                <?php endif; ?>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-success btn-lg" id="sendOtp"
                                        onclick="sendOTP()">Send
                                        OTP</button>
                                </div>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-success btn-lg" style="display:none"
                                        name="verifyOtp" id='verifyOtp' onclick="verifyOTP()">Verify
                                        OTP</button>
                                    <button type="submit" class="btn btn-success btn-lg" style="display:none"
                                        id='submit'>Submit Now</button>
                                </div>
                                <div class="pt-3" style="text-align:center;">User already have an account?<a
                                        href="<?php echo e(URL::to('/log-in')); ?>">
                                        Login</a></div>
                        </form>
                    </div>


                </div>
                <div class="col-xxl-2"></div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<script>
$(function() {
    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });

})

function sendOTP() {
    var number = $('#number').val();
    if (number == '') {
        alert('Please enter Mobile number');
        return false;
    }
    if (number) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/send-otp/' + number,
            success: function(data) {
                if (data.status == 'success') {
                    $("#sendOtp").hide();
                    $("#verifyOtp").show();
                    $("#otpBlock").show();
                    $('#msg').html('OTP sent successfuly');
                } else {
                    alert(data.massage);
                    $('#number').val('');
                }
            }
        });
    }
}

function verifyOTP() {
    //alert('hi');
    var number = $('#number').val();
    var otp = $('#enterOTP').val();
    if (number == '') {
        alert('Please enter Mobile number');
        return false;
    }
    if (otp == '') {
        alert('Please enter Valid OTP');
        return false;
    }
    if (otp) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/verify-otp/' + number + '/' + otp,
            //data: 'state_id=' + stateID,
            success: function(data) {
                if (data.status == 'success') {
                    alert(data.massage);
                    $("#verifyOtp").hide();
                    $('#submit').trigger('click');
                } else {
                    alert(data.massage);
                }
            }
        });
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('modals.consumerInstallerAssociation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('styles'); ?>
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/userRegistration.blade.php ENDPATH**/ ?>