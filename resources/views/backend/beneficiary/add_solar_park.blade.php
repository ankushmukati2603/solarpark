@extends('layouts.masters.backend')
@section('content')
<!-- <section class="register_page bg_fade"> -->
<section class="section dashboard form_sctn">


    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Add Solar Park Detail</li>
                </ol>
            </nav>
        </div>
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Add Solar Park Detail</h1>
                    <hr style="color: #959595;">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/add-solar-park')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name"><strong>Solar Park Name</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Solar Park Name" name="park_name" type="text"
                                        class="form-control" value="{{$editedSPData->solar_park_name ?? ''}}">
                                </div>
                            </div>
                            <div class=" form-group col-lg-6">
                                <label for="name"><strong>Developer Name</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Developer Name" name="developer_name" type="text"
                                        class="form-control" value="{{$editedSPData->developer_name ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="name"><strong>Mobile Number</strong></label>
                                <div class="input-group mb-3">
                                    <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                        name="contact_no" id="number" type="text" class="form-control"
                                        value="{{$editedSPData->mobile_number ?? ''}}">

                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="name"><strong>Email ID</strong></label>
                                <div style="position: relative;">
                                    <input placeholder="Email" name="email" type="text" class="form-control"
                                        value="{{$editedSPData->email ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="name"><strong>PAN Number</strong></label>
                                <div class="input-group mb-3">
                                    <input placeholder="PAN Number" name="pan_no" id="number" type="text"
                                        class="form-control" value="{{$editedSPData->pan_no ?? ''}}">

                                </div>
                            </div>
                            <h5 class="pb-3">Project Location</h5>
                            <div class="form-group col-lg-6">
                                <label for="name"><strong>State</strong></label>
                                <div style="position: relative;">
                                    <select class="form-control required select21" id="state_id" name="state_id"
                                        onchange="getDistrictByState(this.value,'')">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->code }}" @if(($editedSPData->state ?? '')
                                            ==$state->code) selected @endif>
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
                                    <select class="form-control required select21" id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'')">
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
                                        value="{{$editedSPData->solar_park_name ?? ''}}"> {{$editedSPData->address ?? ''}}</textarea>
                                    <!-- <input placeholder="Address" minlength="6" maxlength="6" min="0" name="pan_no"
                                            id="address" type="text" class="form-control"> -->

                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class=" pt-4 text-center">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    <button type="submit" class="btn btn-success" name="submit"
                                        id='submit'>Save</button>
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/solar-park-list')}}"
                                        class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
</section>

@endsection
@section('scripts')
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>


@if(($id ?? '') != null)

<script>
$(document).ready(function() {

    getDistrictByState('{{ $editedSPData->state }}', '{{ $editedSPData->district }}');
    getSubDistrictByDistrict('{{ $editedSPData->district }}',
        '{{ $editedSPData->sub_district }}');
    getVillageBySubDistrict('{{ $editedSPData->sub_district }}',
        '{{ $editedSPData->village }}');

});
</script>
@endif

@endpush



@endsection