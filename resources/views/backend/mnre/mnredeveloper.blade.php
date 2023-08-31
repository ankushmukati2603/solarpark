@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Developer</h1>
            <nav>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li> -->
                    <!-- <li class="breadcrumb-item active">Progress Report Data</li> -->
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/developer-mnre')}}" method="post"
                        id="formFileAjax">
                        @csrf
                        <div class="row">
                            <!-- @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif -->
                            <div class="col-md-4 col-sm-12">
                                <label for="name"><strong>Name</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Name" name="name" type="text" class="form-control"
                                        value="{{$developerdetails->name ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="name"><strong>Mobile Number</strong></label>
                                <div class="input-group mb-6">
                                    <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                        name="mobile_number" id="number" type="text" class="form-control"
                                        value="{{$developerdetails->mobile_number ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="name"><strong>Email ID</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Email" name="email" type="text" class="form-control"
                                        value="{{$developerdetails->email ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                            </div>

                            <div class="clearfix"></div><br>
                            <div class="col-md-4 col-sm-12">
                                <label for="solar_park_name"><strong>Solar Park Name</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Solar Park Name" name="solar_park_name" type="text"
                                        class="form-control" value="{{$developerdetails->solar_park_name ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('solar_park_name') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 mb-4">
                                <label for="name"><strong>State</strong></label>
                                <div style="position: relative;">
                                    <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                    <select class="form-control 
                                        required " id="state_id" name="state_id"
                                        onchange="getDistrictByState(this.value,'')">
                                        <option value="{{$developerdetails->state_id ?? ''}}">Select State</option>
                                        @foreach($states as $state)<option value="{{$state->code }}">
                                            {{$state->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="name"><strong>District</strong></label>
                                <div style="position: relative;">
                                    <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                    <select class="form-control
                                        required select21" id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'')">
                                        <option value="{{$developerdetails->district_id ?? ''}}">Select District
                                        </option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                </div>
                            </div>
                            <!-- <div class="clearfix"></div><br> -->
                            <div class="col-md-4 col-sm-12">
                                <label for="name"><strong>Sub-District</strong></label>
                                <div style="position: relative;">
                                    <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                    <select class="form-control  required select21" id="sub_district_id"
                                        name="sub_district_id" onchange="getVillageBySubDistrict(this.value,'')">
                                        <option value="{{$developerdetails->sub_district_id ?? ''}}" selected disabled>
                                            Select Sub-District</option>

                                    </select>
                                    <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="name"><strong>Village</strong></label>
                                <div style="position: relative;">
                                    <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                    <select class="form-control  select21" id="village_id" name="village">
                                        <option value="{{$developerdetails->village ?? ''}}" selected disabled>
                                            Select
                                            Village</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('village') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-4">
                                <label>User Type<span class="error">*</span></label>
                                <select class="form-control" name="user_type" id="user_type">
                                    <option value="">Select User Type</option>
                                    <option value="1" @if(($generalData['general']['user_type'] ?? '' )=='1' ) selected
                                        @endif>Self
                                    </option>
                                    <option value="2" @if(($generalData['general']['user_type'] ?? '' )=='2' ) selected
                                        @endif>Mnre
                                    </option>

                                </select>
                            </div>
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                    <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button>
                </div>
            </div>
            </div>

            <div class="clearfix"></div><br>
            <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/developer-list')}}" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Show List </a> -->

    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush