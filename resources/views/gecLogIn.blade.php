@extends('layouts.masters.home')
@section('content')

<section class="register_page bg_fade">

    <div class="container-fluid px-5">
        <div class="row pb-5 pt-5">
            <div class="col-xxl-3"></div>
            <div class="col-xxl-6 pt-5 ">
                <div class="row   register_form">

                    <div class="col-xl-5 left_blk">
                        <div><a href="{{url('sandes')}}"><img src="{{ URL::asset('public/images/sandes_app_img.png')}}"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xl-7 right_blk">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text">GEC Developer Login</div>
                        </div>
                        <form action="{{ route('login') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">

                                <div class="form-group1 col-lg-12">
                                    <input type="radio" id="contactChoice1" name="contact" value="email" checked />
                                    <label for="contactChoice1">Email</label>

                                    <input type="radio" id="contactChoice2" name="contact" value="phone" />
                                    <label for="contactChoice2">Phone</label>
                                </div>
                                <div class="form-group1 col-lg-12">
                                    <input placeholder="Mobile number" type="text" id="number" name="contact_no"
                                        class="form-control" autocomplete="off" style="display: none">
                                    <input placeholder="Email" type="text" id="txtemail" name="email"
                                        class="form-control">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="form-group1 col-lg-12">
                                    <div class="input-group mb-3 input-group-lg">

                                        <input placeholder="Password" type="password" id="txtpassword" name="password"
                                            class="form-control mt-3" autocomplete="off">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                </div>
                                <div class="mb-4">

                                    <div class="input-group1 mb-3" id="otpText" style="display:none">

                                        <input placeholder="Enter OTP" name="otp" id="enterOTP" type="password"
                                            class="form-control">

                                        <span id="msg" class="text-success"></span>
                                    </div>
                                </div>
                                @if(!env('DEV_ENVIRONMENT'))
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
                                @else
                                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                                @endif
                                <div class="d-grid">
                                    <button type="button" style="display:none" class="btn btn-success btn-lg"
                                        id="otpSend" onclick="loginOtp()">Send
                                        OTP</button>

                                    <button type="button" id="otpverify" style="display:none"
                                        class="btn btn-success btn-lg" onclick="userOTPVerified()">Verify OTP</button>
                                    <button type="submit" id="submitted" class="btn btn-success btn-lg">Submit</button>
                                </div>
                                <input type="hidden" name="user_type" id="user_type" value="GECDEVELOPER_EMAIL">

                                <!-- <div class="form-group col-lg-12">
                                    <label for="name"><strong>Username/Email ID*</strong></label>
                                    <div style="position: relative;">

                                        <input type="text" class="form-control " value="" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Username/Email ID*">
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>Password</strong></label>
                                    <div style="position: relative;">

                                        <input type="text" class="form-control " value="" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Password">
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="name"><strong>Enter Captcha Code </strong></label>
                                            <input type="text" class="form-control" name="CaptchaCode"
                                                placeholder="Enter your captcha here" autocomplete="off">
                                            <img src="https://hrd.mnre.gov.in/captcha-image.php" id="capt"
                                                style="height: 60px;margin-top: 20px;">
                                            <img src="https://hrd.mnre.gov.in/public/images.png"
                                                style="height:40px; cursor: pointer;" onclick="reload();">



                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!----Captcha-------------->
                            <!--div class="form-group row">
                                <div class="col-md-4">
                                <img src=captcha-image.php id="capt" style="height:40px;width:100px">
                                </div>
                                <div class="col-md-2">
                                <img src="/public/images.png" style="height:40px;width:40px" onClick=reload();>
                                </div>
                                <div class="col-md-6">
                                <input type="text"  class="form-control"  name="CaptchaCode">
                                        </div>
                            </div-->
                            <!------------------Captcha Code -->
                            <!-- <div class="row">
                                <div class="col-xl-12 text-center">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-12 text-secondary pb-3 text-center">
                                    <a href="#">Login</a> | <a href="#"> Forgot Password </a> | <a href="#">Forgot
                                        Username </a>
                                </div>
                            </div> -->


                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- <section class="bio_login_section">
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-lg-3 col-md-2"></div>
            <div class=" col-lg-6 col-md-8 biogas_login_form mt-5 mb-5">
                <div class="row">
                    <div class="col-lg-5 col-md-5 left_blk">
                        <div class="user_pswrd_icn"> <i class="fa-solid fa-user-tie"></i></div>
                    </div>
                    <div class="col-lg-7 col-md-7 right_blk pt-4 pb-5">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <h2 style="text-align: center;
            font-weight: 600;">Login</h2>
                        <form id="formLogin" action="{{ route('login') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}

                            <div>
                                <input type="radio" id="contactChoice1" name="contact" value="email" />
                                <label for="contactChoice1">Email</label>

                                <input type="radio" id="contactChoice2" name="contact" value="phone" checked />
                                <label for="contactChoice2">Phone</label>


                            </div> -->
<!-- <div>
                                <button type="submit">Submit</button>
                            </div> -->
<!-- <div class="mb-4 mt-3">

                                <div class="input-group mb-3 input-group-lg">

                                    <input placeholder="Mobile number" type="text" id="number" name="contact_no"
                                        class="form-control"> -->
<!-- <span class="input-group-text"><i class="fa-solid fa-user"></i></span> -->
<!-- </div>
                            </div>
                            <div class="mb-4 mt-3">

                                <div class="input-group mb-3 input-group-lg">

                                    <input placeholder="Email" type="text" id="txtemail" name="email"
                                        class="form-control" style="display: none"> -->
<!-- <span class="input-group-text"><i class="fa-solid fa-user"></i></span> -->
<!-- </div>
                            </div>
                            <div class="mb-4 mt-3">

                                <div class="input-group mb-3 input-group-lg">

                                    <input placeholder="Password" type="password" id="txtpassword" name="password"
                                        class="form-control" style="display: none"> -->
<!-- <span class="input-group-text"><i class="fa-solid fa-user"></i></span> -->
<!-- </div>
                            </div>
                            <div class="mb-4">

                                <div class="input-group mb-3 input-group-lg" id="otpText" style="display:none">

                                    <input placeholder="Enter OTP" name="otp" id="enterOTP" type="number"
                                        class="form-control">
                                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                    <span id="msg" class="text-success"></span>
                                </div>
                            </div>
                            @if(!env('DEV_ENVIRONMENT'))
                            <div class="col-sm-12 p-0">
                                <div class="captcha login-captcha col-sm-12">
                                    <?php 
                                    // echo captcha_img('flat'); 
                                    ?>
                                    <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                        aria-hidden="true"></i>
                                    <div class="clearfix"></div>
                                    <input type="text" id="captcha-input" class="form-control required" name="captcha"
                                        placeholder="Captcha">
                                </div>
                            </div>
                            @else
                            <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                            @endif
                            <div class="d-grid">
                                <button type="button" class="btn btn-success btn-lg" id="otpSend"
                                    onclick="loginOtp()">Send
                                    OTP</button>

                                <button type="button" id="otpverify" style="display:none" class="btn btn-success btn-lg"
                                    onclick="userOTPVerified()">Verify OTP</button>
                                <button type="submit" id="submitted" style="display:none"
                                    class="btn btn-success btn-lg">Submit</button>
                            </div>
                            <input type="hidden" name="user_type" id="user_type" value="BENEFICIARY_MOBILE"> -->
<!-- </form>
</div>
</div>
</div>
<div class="col-md-3"></div>
</div>
</div>
</section> -->
@endsection

@section('scripts')

<script>
$("input[type='radio']").change(function() {
    $('#user_type').val('');
    if ($(this).val() == "email") {
        $("#txtemail").show();
        $("#txtpassword").show();
        $("#number").hide();
        $("#otpverify").hide();
        $("#otpSend").hide();
        $("#submitted").show();
        $('#user_type').val('GECDEVELOPER_EMAIL');

    } else {
        $("#number").show();
        $("#txtpassword").hide();
        $("#txtemail").hide();

        $("#otpSend").show();
        $("#submitted").hide();
        $('#user_type').val('GECDEVELOPER_MOBILE');
    }

});

// $("input[type='radio']").change(function() {

//     if ($(this).val() == "phone") {

//     } else {
//         $("#txtemail").show();
//         $("#txtpassword").show();

//     }

// });

$(function() {
    // $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
})

function loginOtp() {
    var number = $('#number').val();
    if (number == '') {
        alert('Please enter Mobile number');
        return false;
    }
    if (number) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/geclogin-otp/' + number,
            success: function(data) {
                if (data.status == 'success') {
                    $("#otpSend").hide();
                    $("#otpverify").show();
                    $("#otpText").show();

                    $('#msg').html('OTP sent successfuly');
                } else {
                    //alert(data.massage);
                }
            }
        });
    }
}

function userOTPVerified() {
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
            url: baseUrl + '/ajax/gecuser-verify-otp/' + number + '/' + otp,
            //data: 'state_id=' + stateID,
            success: function(data) {
                if (data.status == 'success') {
                    //alert(data.massage);
                    $("#otpverify").hide();
                    $("#submitted").trigger('click');
                    $('#msg').html(data.massage);
                } else {
                    alert(data.massage);
                }
            }
        });
    }
}
</script>
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
@endsection