
<?php $__env->startSection('content'); ?>
<!-- <section class="register_page bg_fade"> -->
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost:81/stu-users">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row   register_form">
                    <!-- <?php if(session()->has('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message')); ?>

                    </div>
                    <?php endif; ?> -->

                    <div class="col-xl-12">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text"></div>
                        </div>
                        <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/add-stu-project')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>STUs/CTUs Project Name</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="STUs/CTUs Project Name" name="project_name" type="text"
                                            class="form-control" value="<?php echo e($editedStuData->project_name ?? ''); ?>">
                                    </div>
                                </div>
                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Developer Name</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Developer Name" name="developer_name" type="text"
                                            class="form-control" value="<?php echo e($editedStuData->developer_name ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Mobile Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                            name="contact_no" id="number" type="text" class="form-control"
                                            value="<?php echo e($editedStuData->mobile_number ?? ''); ?>">

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Email ID</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Email" name="email" type="text" class="form-control"
                                            value="<?php echo e($editedStuData->email ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>PAN Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="PAN Number" name="pan_no" id="number" type="text"
                                            class="form-control" value="<?php echo e($editedStuData->pan_no ?? ''); ?>">

                                    </div>
                                </div>
                                <h5 class="pb-3">Project Location</h5>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>State</strong></label>
                                    <div style="position: relative;">
                                    <select class="form-control required select21" id="state_id" name="state_id"
                                            onchange="getDistrictByState(this.value,'')">
                                            <option value="">Select State</option>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($state->code); ?>">
                                                <?php echo e($state->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>District</strong></label>
                                    <div style="position: relative;">
                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                        <select class="form-control required select21" id="district_id"
                                            name="district_id" onchange="getSubDistrictByDistrict(this.value,'')">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Sub-District</strong></label>
                                    <div style="position: relative;">
                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                        <select class="form-control  required select21" id="sub_district_id"
                                            name="sub_district_id" onchange="getVillageBySubDistrict(this.value,'')">
                                            <option value="" selected disabled>Select Sub-District</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Village</strong></label>
                                    <div style="position: relative;">
                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                        <select class="form-control  select21" id="village_id" name="village">
                                            <option value="" selected disabled>Select Village</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Address</strong></label>
                                    <div class="input-group mb-3">
                                        <textarea name="address" id="" class="form-control" cols="10" rows="2"
                                            value="<?php echo e($editedStuData->solar_park_name ?? ''); ?>"> <?php echo e($editedStuData->address ?? ''); ?></textarea>
                                        <!-- <input placeholder="Address" minlength="6" maxlength="6" min="0" name="pan_no"
                                            id="address" type="text" class="form-control"> -->

                                    </div>
                                </div>
                                <div class="mb-4" id="otpBlock" style="display: none">

                                    <input placeholder="Verify OTP" id="enterOTP" type="number" min="0" maxlegnth="6"
                                        class="form-control">
                                    <span id="msg" class="text-success"></span>

                                </div>


                                <!-- <div class="d-grid">
                                    <button type="button" class="btn btn-success btn-lg" id="sendOtp"
                                        onclick="sendOTP()">Send
                                        OTP</button>
                                </div> -->
                                <div class="d-grid">
                                    <!-- <button type="button" class="btn btn-success btn-lg" style="display:none"
                                        name="verifyOtp" id='verifyOtp' onclick="verifyOTP()">Verify
                                        OTP</button> -->
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit"
                                        id='submit'>Submit</button>
                                </div>
                                <!-- <div class="pt-3" style="text-align:center;">User already have an account?<a
                                        href="<?php echo e(URL::to('/log-in')); ?>">
                                        Login</a></div> -->
                        </form>
                    </div>



                </div>
                <!-- <div class="col-xxl-2"></div> -->
            </div>
        </div>

    </main>
</section>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark  footer_nav">
    <div class="container-fluid d-flex justify-content-center">
        <div class="copyright-content d-flex align-items-center justify-content-center">
            <img class="footer_nic_logo" src="<?php echo e(URL::asset('public/images/footerNIC.png')); ?>">
            <div> Portal Content Managed by <strong> <a title="GoI, External Link that opens in a new window"
                        href="https://mnre.gov.in"><strong>Ministry of New and Renewable
                            Energy</strong></a></strong>
                <br><span>Designed, Developed and Hosted by <a title="NIC, External Link that opens in a new window"
                        href="https://www.nic.in"><strong class="highlight_text_blue">National Informatics
                            Centre (NIC)</strong></a></span>
            </div>
        </div>
    </div>
</nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>



<!-- <script src="<?php echo e(asset('public/js/custom.js')); ?>"></script> -->
<script>
$(function() {
    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });

})

// function sendOTP() {
//     var number = $('#number').val();
//     if (number == '') {
//         alert('Please enter Mobile number');
//         return false;
//     }
//     if (number) {
//         $.ajax({
//             type: 'GET',
//             url: baseUrl + '/ajax/send-otp/' + number,
//             success: function(data) {
//                 if (data.status == 'success') {
//                     $("#sendOtp").hide();
//                     $("#verifyOtp").show();
//                     $("#otpBlock").show();
//                     $('#msg').html('OTP sent successfuly');
//                 } else {
//                     alert(data.massage);
//                     $('#number').val('');
//                 }
//             }
//         });
//     }
// }

// function verifyOTP() {
//     //alert('hi');
//     var number = $('#number').val();
//     var otp = $('#enterOTP').val();
//     if (number == '') {
//         alert('Please enter Mobile number');
//         return false;
//     }
//     if (otp == '') {
//         alert('Please enter Valid OTP');
//         return false;
//     }
//     if (otp) {
//         $.ajax({
//             type: 'GET',
//             url: baseUrl + '/ajax/verify-otp/' + number + '/' + otp,
//             //data: 'state_id=' + stateID,
//             success: function(data) {
//                 if (data.status == 'success') {
//                     alert(data.massage);
//                     $("#verifyOtp").hide();
//                     $('#submit').trigger('click');
//                 } else {
//                     alert(data.massage);
//                 }
//             }
//         });
//     }
// }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/stu/add_stu_project.blade.php ENDPATH**/ ?>