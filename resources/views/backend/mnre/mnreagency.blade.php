@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Agency</h1>
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
                    <form action="{{URL::to(Auth::getDefaultDriver().'/agency-mnre')}}" method="post" id="formFileAjax">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-4">
                                <label>Agency Name<span class="error">*</span></label>
                                <input type="text" name="agency_name" placeholder="Agency Name" id="agency_name"
                                    class="form-control " value="{{$agencyData->agency_name ?? ''}}">
                                <span class="text-danger">{{ $errors->first('agency_name') }}</span>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-4">
                                <label>Agency Type<span class="error">*</span></label>
                                <select class="form-control" name="agency_type" id="">
                                    <option value="">Select Agency Type</option>
                                    <option value="1" @if(($agencyData->agency_type ?? '' )=='1' )
                                        selected @endif>A
                                    </option>
                                    <option value="2" @if(($agencyData->agency_type ?? '' )=='2' )
                                        selected @endif>B
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4 col-sm-12 mb-4">
                                <label for="name"><strong>Email ID</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Email" name="email" type="text" class="form-control"
                                        value="{{$developerdetails->email ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 mb-4">
                                <label for="name"><strong>Contact Number</strong></label>
                                <div class="input-group mb-6">
                                    <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                        name="phone" id="number" type="text" class="form-control"
                                        value="{{$developerdetails->phone ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-4">
                                <label for="office_addess"><strong>Office Addess</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Office Addess" name="office_addess" type="text"
                                        class="form-control" value="{{$developerdetails->office_addess ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('office_addess') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-4">
                                <label>Zip Code<span class="text-danger">*</span></label>
                                <input type="number" step="any" min="0" name="zipcode" id="txtgeneralLongitude"
                                    placeholder="000000" class="form-control  number"
                                    value="{{$generalData['projectLocation']['longitude'] ?? ''}}">
                            </div>

                            <div id="home" class=" tab-pane active">
                                <h5> <label class="headLebels">Location</label></h5>
                                <div class="row pb-3">

                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label for="name"><strong>State</strong></label>
                                        <div style="position: relative;">
                                            <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                            <select class="form-control 
                                        required " id="state_id" name="state_id"
                                                onchange="getDistrictByState(this.value,'')">
                                                <option value="{{$developerdetails->state_id ?? ''}}">Select State
                                                </option>
                                                @foreach($states as $state)<option value="{{$state->code }}">
                                                    {{$state->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select class="form-control" id="district_id" name="district_id"
                                            onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                            <option value="" selected>Select District</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Sub District<span class="text-danger">*</span></label>
                                        <select class="form-control" id="sub_district_id" name="sub_district_id"
                                            onchange="getVillageBySubDistrict(this.value,'')">
                                            <option value="" selected disabled>Select Sub-District</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Village<span class="text-danger">*</span></label>
                                        <select class="form-control " id="village_id" name="village">
                                            <option value="" selected disabled>Select Village</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>SNA Type<span class="error">*</span></label>
                                        <select class="form-control" name="sna_type" id="">
                                            <option value="">Select SNA Type</option>
                                            <option value="0" @if(($generalData['general']['sna_type'] ?? '' )=='0' )
                                                selected @endif>OLD SNA
                                            </option>
                                            <option value="1" @if(($generalData['general']['sna_type'] ?? '' )=='1' )
                                                selected @endif>NEW SNA
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div><br>
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                                Now</button>
                        </div>
                </div>
            </div>
            </form>


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