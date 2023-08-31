@extends('layouts.masters.backend')
@section('title', 'Profile')
@section('content')


<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to(Auth::getDefaultDriver()) }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">

        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="col-lg-12">
            <div class="row">

                <?php
                    //print_r($userprofile);
                    ?>


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Personal Details
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Organization
                            Details</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>


                        <form action="{{ URL::to('permanent/update_profile') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee Name *</label>
                                    <input type="text" class="form-control" name="emp_name" required
                                        value="{{ $beneficiary->first_name . ' ' . $beneficiary->last_name }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee Code</label>
                                    <input type="text" class="form-control" name="emp_code"
                                        value="{{ $beneficiary->emp_code }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of birth *</label>
                                    @if (!empty($userprofile->dob))
                                    {{ date('m/d/Y', strtotime($userprofile->dob)) }}
                                    @endif
                                    <input type="date" class="form-control" name="dob" required
                                        value="@if (!empty($userprofile->dob)) {{ date('Y-m-d', strtotime($userprofile->dob)) }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" name="email" required
                                        value="{{ $beneficiary->email }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile *</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" required
                                        value="{{ $beneficiary->contact_number }}"
                                        onfocusout="validate(this.value,{{ $beneficiary->contact_number }})" />
                                </div>
                            </div>

                            <div class="col-md-6" id="otpBlock" style="display: none">

                                <input placeholder="Verify OTP" id="enterOTP" type="number" min="0" maxlegnth="6"
                                    class="form-control">
                                <span id="msg" class="text-success"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Joining *</label>
                                    <input type="date" class="form-control" name="dt_joining" required
                                        value="@if (!empty($userprofile->dt_joining)) {{ date('Y-m-d', strtotime($userprofile->dt_joining)) }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Joining in current designation</label>
                                    <input type="date" class="form-control" name="dt_joining_current_designation"
                                        value="@if (!empty($userprofile->dt_joining_current_designation)) {{ date('Y-m-d', strtotime($userprofile->dt_joining_current_designation)) }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Retirement</label>
                                    <input type="date" class="form-control" name="dt_retirement"
                                        value="@if (!empty($userprofile->dt_retirement)) {{ date('Y-m-d', strtotime($userprofile->dt_retirement)) }} @endif" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" name="tel_no"
                                        value="@if (!empty($userprofile->telephone)) {{ $userprofile->telephone }} @endif" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Intercom Number </label>
                                    <input type="text" class="form-control" name="intercom_number"
                                        value="@if (!empty($userprofile->intercom_number)) {{ $userprofile->intercom_number }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department/Division/Domain *</label>
                                    <input type="text" class="form-control" name="personal_department"
                                        value="@if (!empty($userprofile->personal_department)) {{ $userprofile->personal_department }} @endif" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation *</label>
                                    <input type="text" class="form-control" name="designation" required
                                        value="{{ $beneficiary->designation }}" />
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Floor number where you are sitting *</label>
                                    <input type="text" class="form-control" name="floor_no" required
                                        value="@if (!empty($userprofile->floor_number)) {{ $userprofile->floor_number }} @endif" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cabin No</label>
                                    <input type="text" class="form-control" name="cabin_no"
                                        value="@if (!empty($userprofile->cabin_number)) {{ $userprofile->cabin_number }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-success btn-lg">Update</button>

                                    <button type="button" class="btn btn-success btn-lg" id="sendOtp"
                                        style="display:none;" onclick="sendOTP()">Send
                                        OTP</button>

                                    <button type="button" class="btn btn-success btn-lg" style="display:none"
                                        name="verifyOtp" id='verifyOtp' onclick="verifyOTP()">Verify
                                        OTP</button>


                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ URL::to('permanent/update_professional_profile') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department/Division/Domain </label>
                                    <input type="text" class="form-control" name="dept" required
                                        value="@if (!empty($userprofile->department_division_domain)) {{ $userprofile->department_division_domain }} @endif" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reporting/Nodal/Forwarding Officer Name</label>
                                    <input type="text" class="form-control" name="reporting_officer_name" required
                                        value="@if (!empty($userprofile->reporting_officer_name)) {{ $userprofile->reporting_officer_name }} @endif" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reporting/Nodal/Forwarding Officer Email</label>
                                    <input type="text" class="form-control" name="reporting_officer_email" required
                                        value="@if (!empty($userprofile->reporting_officer_email)) {{ $userprofile->reporting_officer_email }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reporting/Nodal/Forwarding Officer Mobile</label>
                                    <input type="text" class="form-control" name="reporting_officer_mobile" required
                                        value="@if (!empty($userprofile->reporting_officer_mobile)) {{ $userprofile->reporting_officer_mobile }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reporting/Nodal/Forwarding Officer Telephone</label>
                                    <input type="text" class="form-control" name="reporting_officer_telephone" required
                                        value="@if (!empty($userprofile->reporting_officer_telephone)) {{ $userprofile->reporting_officer_telephone }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reporting/Nodal/Forwarding Officer Designation</label>
                                    <input type="text" class="form-control" name="reporting_officer_designation"
                                        required
                                        value="@if (!empty($userprofile->reporting_officer_designation)) {{ $userprofile->reporting_officer_designation }} @endif" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" required value="1"
                                            name="certified" @if (!empty($userprofile->certifiled) &&
                                        $userprofile->certifiled == 1) checked @endif
                                        id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Certified/Declaration - This is to certify that entered information is
                                            correct and verified
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-success btn-lg">Update</button>




                                </div>
                            </div>


                        </form>



                    </div>

                </div>



            </div>
        </div>
    </div>
</section>

<script>
//$('#sidebar').hide();
function verifyOTP() {
    //alert('hi');
    var number = $('#mobile').val();
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
                    $('#submit').show();
                } else {
                    alert(data.massage);
                }
            }
        });
    }
}


function sendOTP() {
    var number = $('#mobile').val();
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


function validate(new_mobile, old_mobile) {
    // alert(new_mobile);
    //alert(old_mobile);
    if (new_mobile != old_mobile) {
        $('#submit').hide();
        $('#sendOtp').show();

    }
}

function validate_form() {
    alert('hi');
    var existEmail = '<?php echo $beneficiary->email; ?>';
    var existMobile = '<?php echo $beneficiary->contact_number; ?>';
    alert(existEmail);
    alert(existMobile);
    return false;
}
</script>

@endsection