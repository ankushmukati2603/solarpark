@extends('layouts.masters.backend')
@section('title', 'Profile')
@section('content')


    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to(Auth::getDefaultDriver()) }}">Home</a></li>
                <li class="breadcrumb-item active">Employee Request</li>
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
                                type="button" role="tab" aria-controls="home" aria-selected="true">Employee Request
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Apply for
                                Hospitality
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#role"
                                type="button" role="tab" aria-controls="role" aria-selected="false"> Refreshment
                                Requirement(s) From NIC-Hospitality
                            </button>
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
                                        <input type="text" class="form-control" name="emp_name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Code</label>
                                        <input type="text" class="form-control" name="emp_code" />
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Email *</label>
                                        <input type="email" class="form-control" name="email" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Designation *</label>
                                        <input type="text" class="form-control" name="designation" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Date of Joining*</label>
                                        <input type="text" class="form-control" name="join_govt" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Date of Superannuation*</label>
                                        <input type="text" class="form-control" name="superannuation_date " required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <button type="submit" id="submit" class="btn btn-success btn-lg">Update</button> --}}

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
                                        <label>Select Expenditure Source (Fund) </label>
                                        <input type="text" class="form-control" name="expenditure_type" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Prior Approval</label>
                                        <input type="text" class="form-control" name="Select Prior Approval"
                                            required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Meeting Subject </label>
                                        <input type="text" class="form-control" name="meeting_subject" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Meeting Date</label>
                                        <input type="text" class="form-control" name="meeting_date" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Meeting Time</label>
                                        <input type="text" class="form-control" name="meeting_time" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Meeting Place</label>
                                        <input type="text" class="form-control" name="meeting_place" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Entitlement Amount</label>
                                        <input type="text" class="form-control" name="entitlement_amount" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Balance Amount</label>
                                        <input type="text" class="form-control" name="balance_amount" required />
                                    </div>
                                </div>


                            </form>

                        </div>
                        <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ URL::to('permanent/update_professional_profile') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        &nbsp;
                                    </div>
                                </div>
                                {{-- <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree"> --}}
                                <div class="panel-body">
                                    <input type="hidden" name="request_user_id" value="1">
                                    <input type="hidden" name="approved_user_id" value="1">
                                    <div class="p-4 card">
                                        <table id="myTable" class="order-list table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="mx-5">Bill no.</th>
                                                    <th scope="col" class="mx-5">Bill date.</th>
                                                    <th scope="col" class="mx-5">Item</th>
                                                    <th scope="col" class="mx-5">Quantity</th>
                                                    <th scope="col" class="mx-5">Amount</th>
                                                    <th scope="col" class="mx-5">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="dynamicRow">
                                                    <td><input type="text" name="bill_date[]" id="bill_date"
                                                            class="form-control ml-1" readonly
                                                            value="<?php echo rand(100000, 999999) . '-' . date('m-Y'); ?>" /></td>
                                                    <td><input type="text" name="bill_no[]" id="bill_no"
                                                            class="form-control ml-1" readonly
                                                            value="<?= date('d-m-Y') ?>" /></td>

                                                    <td>
                                                        <select id="item_1"
                                                            class="form-control variable_priority unique required"
                                                            name="item[]"
                                                            onchange="onchangeSelect(this); setemployee_requestLimit(this);"
                                                            required>
                                                            <option value="" selected>Item Choose...</option>
                                                            @if ($employee_request)
                                                                @foreach ($employee_request as $employee_request)
                                                                    <option value="{{ $employee_request->id }}"
                                                                        data-quantity_issued="{{ Ucfirst($employee_request->quantity_issued) }}">
                                                                        {{ Ucfirst($employee_request->item) }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity_issued[]"
                                                            id="quantity_issued_1" class="form-control text-bold ml-1"
                                                            required />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="amount[]" id="amount_1"
                                                            class="form-control ml-1" required="" />
                                                        <!--<input type="number" name="quantity[]" id="quantity_1" class="form-control ml-1" onchange="return onchangeValidate (this)" required/>-->
                                                    </td>

                                                    <td> <input type="button" id="addrow" value="Add Row"
                                                            class="btn btn-info ml-2" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Total Quantity(in kg/no.)</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Total Amount</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required value="1"
                                        name="certified" id="flexCheckDefault">
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
    </script>

@endsection
