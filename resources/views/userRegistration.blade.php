@extends('layouts.masters.home')
@section('content')
@section('title', 'Consumer Interest Form')
<section class="register_page bg_fade">

    <div class="container-fluid px-5">
        <div class="row pb-5 pt-5">
            <div class="col-xxl-2"></div>
            <div class="col-xxl-8 ">
                <div class="row   register_form">

                    <div class="col-xl-4 left_blk">
                        <div><a href="{{url('sandes')}}"><img src="{{ URL::asset('public/images/sandes_app_img.png')}}"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 right_blk">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text">REGISTERATION</div>
                        </div>
                        <form action="{{URL::to('user-registration')}}" method="post">
                            @csrf

                            <div class="row">

                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>User Type</strong> <span class="text-danger">*</span>
                                    </label>
                                    <div style="position: relative;">
                                        <select name="usertype" id="usertype" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="1">SNA's </option>
                                            <option value="2">STU's </option>
                                            <option value="3">SPPD's </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6" id="schemeBox">
                                    <label for="name"><strong>Select Scheme</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <select name="scheme_name" id="scheme_name" class="form-control">
                                            <option value="">Select Scheme</option>
                                            <option value="1">Solar Park </option>
                                            <option value="2">GEC </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Full Name</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input placeholder="Full Name" name="name" type="text" class="form-control">

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Mobile Number</strong> <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                            name="contact_no" id="number" type="text" class="form-control"
                                            style="width: 100%;">

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Email ID</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input placeholder="Email" name="email" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6" id="panBox">
                                    <label for="name"><strong>PAN Number</strong> <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="PAN Number" name="pan_no" id="pan_no" type="password"
                                            class="form-control" style="width: 100%;">

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>State</strong> <span class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select class="form-control  select21" id="state_id" name="state_id"
                                            onchange="getDistrictByState(this.value,'')">

                                            <option value="">Select State</option>
                                            @foreach($stateData as $state)<option value="{{$state->code }}">
                                                {{$state->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>District</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select class="form-control  select21" id="district_id" name="district_id"
                                            onchange="getSubDistrictByDistrict(this.value,'')">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>Address</strong> <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <textarea name="address" id="" class="form-control" cols="10" rows="5"
                                            style="width: 100%;"></textarea>
                                        <!-- <input placeholder="Address" minlength="6" maxlength="6" min="0" name="pan_no"
                                            id="address" type="text" class="form-control"> -->

                                    </div>
                                </div>

                                @if(!env('DEV_ENVIRONMENT'))
                                <div class="col-sm-12 p-0">
                                    <div class="captcha login-captcha col-sm-12">
                                        <?php echo captcha_img('flat'); ?>
                                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                            aria-hidden="true"></i>
                                        <div class="clearfix"></div>
                                        <input type="text" id="captcha-input" class="form-control " name="captcha"
                                            placeholder="Captcha">
                                    </div>
                                </div>
                                <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                @else
                                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                                @endif
                            </div>
                            <div class="d-grid">

                                <input type="submit" class="btn btn-success btn-lg" id='submit' value="Register Now">
                            </div>
                            <div class="pt-3" style="text-align:center;">User already have an account?<a
                                    href="{{URL::to('/log-in')}}">
                                    Login</a></div>
                        </form>
                    </div>


                </div>
                <div class="col-xxl-2"></div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
<style>
span#valid-error-form {
    color: #ed0000 !important;
    font-size: 12px;
}
</style>
@section('scripts')

<script>
$(function() {
    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });

})

$('#usertype').on('change', function() {
    $('#schemeBox').hide();
    $('#panBox').hide();
    let usertype = $('#usertype').val();
    if (usertype) {
        if (usertype == 1) { // STU
            $('#schemeBox').show();
        }
        if (usertype == 3) { //SPPD
            $('#panBox').show();
        }
    } else {
        alert('Please select usertype');
    }

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
@endsection

@endsection