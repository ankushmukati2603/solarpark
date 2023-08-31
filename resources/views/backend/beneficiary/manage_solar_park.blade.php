@extends('layouts.masters.backend')
@section('content')
<!-- <section class="register_page bg_fade"> -->
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost:81/solar_park/beneficiary">Home</a></li>
                    <li class="breadcrumb-item active">Progress Report Data</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row   register_form">
                    <!-- @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif -->

                    <div class="col-xl-12">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text"></div>
                        </div>
                        <form action="{{URL::to(Auth::getDefaultDriver().'/manage-solar-park')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Solar Park Name</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Solar Park Name" name="park_name" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Developer Name</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Developer Name" name="developer_name" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Mobile Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                            name="contact_no" id="number" type="text" class="form-control">

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Email ID</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Email" name="email" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>PAN Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="PAN Number" minlength="6" maxlength="6" min="0"
                                            name="pan_no" id="number" type="number" class="form-control">

                                    </div>
                                </div>
                                <h5 class="pb-3">Project Location</h5>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>State</strong></label>
                                    <div style="position: relative;">
                                        <select class="form-control required select21" id="state_id" name="state_id"
                                            onchange="getDistrictByState(this.value,'')">
                                            <option value="">Select State</option>
                                            @foreach($states as $state)<option value="{{$state->code }}">
                                                {{$state->name }}
                                            </option>
                                            @endforeach
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
                                        <textarea name="address" id="" class="form-control" cols="10"
                                            rows="2"></textarea>
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
                                    <button type="submit" class="btn btn-success btn-lg" name="submit"
                                        id='submit'>Submit</button>
                                </div>
                                <!-- <div class="pt-3" style="text-align:center;">User already have an account?<a
                                        href="{{URL::to('/log-in')}}">
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
            <img class="footer_nic_logo" src="{{ URL::asset('public/images/footerNIC.png')}}">
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
@endsection
@section('scripts')
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
@endpush



<!-- <script src="{{asset('public/js/custom.js')}}"></script> -->
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