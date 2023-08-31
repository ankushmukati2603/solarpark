@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-body">
                        <form id="" action="" method="POST">
                            @csrf
                            <p style="text-align: right;">
                                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}"
                                    class="mt-1 btn btn-primary">change password</a>
                            </p>
                            <div class="row">
                                <!-- <div class="col-md-4 col-sm-12">
                            <label for="user_code">{{ __('User Code') }} <span class="error">*</span></label>
                            <input type="text" class="form-control" name="user_code" value="{{$user->user_code}}">
                            @error('user_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->

                                <div class="col-md-4 col-sm-12">

                                    <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                        disabled>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <label for="name">{{ __('Name') }} <span class="error">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- <div class="col-md-4 col-sm-12">
                                    <label for="name_of_solar_park">{{ __('Solar Park Name') }} <span
                                            class="error">*</span></label>
                                    <input type="text" class="form-control" name="name_of_solar_park"
                                        value="{{$user->name_of_solar_park}}">
                                    @error('name_of_solar_park')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> -->
                                <div class="col-md-4 col-sm-12">
                                    <label for="contact_no">{{ __('Contact No') }} <span class="error">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label>State<span class="error"> * </span></label>
                                    <select class="form-control  select21" id="txtState" name="state"
                                        onchange="getDistrictByState(this.value,'')">
                                        <option disabled selected>Select</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->code }}" @if($user->state_id==$state->code) selected
                                            @endif>
                                            {{$state->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label>District<span class="error"> * </span></label>
                                    <select class="form-control " id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                        <option value="" selected>Select District</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <label>Sub District<span class="error"> * </span></label>
                                    <select class="form-control  select21" id="sub_district_id" name="sub_district_id"
                                        onchange="getVillageBySubDistrict(this.value,'')">
                                        <option value="" selected disabled>Select Sub-District</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <label>Village<span class="error"> * </span></label>
                                    <select class="form-control  select1" id="village_id" name="village">
                                        <option value="" selected disabled>Select Village</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('village') }}</span>
                                </div>

                                <div class="col-md-4 col-sm-12 mb-4">
                                    <label>Latitude<span class="text-danger"> * </span></label>
                                    <input type="number" placeholder="00.00000" step="any" min="0" name="latitude"
                                        id="txtgeneralLatitude" class="form-control  number"
                                        value="{{$user->latitude}}">
                                </div>

                                <div class="col-md-4 col-sm-12 mb-4">
                                    <label>Longitude<span class="text-danger"> * </span></label>
                                    <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude"
                                        placeholder="00.00000" class="form-control  number"
                                        value="{{$user->longitude}}">
                                </div>
                            </div>

                            <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
        .col-md-4 {
            display: inline-block;
        }
        </style>
    </main>
</section>
<style>
.error {
    color: red
}
</style>
@endsection
@push('backend-js')

@if($user->state_id > 0)

<script>
$(document).ready(function() {
    //alert('hi');
    getDistrictByState('{{$user->state_id}}', '{{$user->district_id}}');
    getSubDistrictByDistrict('{{ $user->district_id }}',
        '{{$user->sub_district_id }}');

    // // block table k  column ka name
    getVillageBySubDistrict('{{$user->sub_district_id }}',
        '{{ $user->village }}');

});
</script>
@endif

<script>
$(function() {
    $('#editProfileForm').validate();
});
</script>
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush