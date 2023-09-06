@extends('layouts.masters.backend')
@section('content')
<!-- @if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif -->
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <!-- <h1>Dashboard</h1> -->
            <nav>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li> -->
                    <!-- <li class="breadcrumb-item active">Progress Report Data</li> -->
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            @include('layouts.partials.backend._flash')

            <form action="{{URL::to(Auth::getDefaultDriver().'/add-stu-project')}}" method="post">
                            @csrf

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
                               

                                
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Tender/ Bidding Agency for RE Projects, if any </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Tender/ Bidding Agency for RE Projects, if any" name="project_name" type="text"
                                            class="form-control" value="{{$editedStuData->project_name ?? ''}}">
                                    </div>
                                </div>
                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Project Details(Name of Developer)</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Project Details(Name of Developer)" name="developer_name" type="text"
                                            class="form-control" value="{{$editedStuData->developer_name ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Capacity for connectivity applied (MW)</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Capacity for connectivity applied (MW)" name="developer_name" type="text"
                                            class="form-control" value="{{$editedStuData->developer_name ?? ''}}">

                                    </div>
                                </div>

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
                                    <label for="name"><strong>Email ID</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Email" name="email" type="text" class="form-control"
                                            value="{{$editedStuData->email ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>PAN Number</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="PAN Number" name="pan_no" id="number" type="text"
                                            class="form-control" value="{{$editedStuData->pan_no ?? ''}}">

                                    </div>
                                </div>
                                <h5 class="pb-3">Project Location</h5>
                                
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
                                            value="{{$editedStuData->solar_park_name ?? ''}}"> {{$editedStuData->address ?? ''}}</textarea>
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
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit"
                                        id='submit'>Submit</button>
                                </div>
                                <!-- <div class="pt-3" style="text-align:center;">User already have an account?<a
                                        href="{{URL::to('/log-in')}}">
                                        Login</a></div> -->
                        </form>
    </main>
</section>
<!-- </section> -->
@include('modals.consumerInstallerAssociation')
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

@endpush