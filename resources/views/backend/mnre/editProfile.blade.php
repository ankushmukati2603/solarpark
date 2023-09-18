@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </nav>
        </div>
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Edit Profile</h1>
                    <hr style="color: #959595;">
                    <form action="{{ URL::to(Auth::getDefaultDriver().'/edit-profile')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="contact_no">{{ __('Contact No') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact_no" value="{{$user->contact_no}}">
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label>State<span class="text-danger">*</span></label>
                                <select class="form-control  select21" id="txtState" name="state"
                                    onchange="getDistrictByState(this.value,'')">
                                    <option disabled selected>Select</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->code }}" @if($user->state==$state->code)
                                        selected
                                        @endif>
                                        {{$state->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label>District<span class="text-danger">*</span></label>
                                <select class="form-control " id="district_id" name="district_id">
                                    <option value="" selected>Select District</option>
                                </select>

                            </div>

                        </div>

                        <p>If you want to change your password <a
                                href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}"
                                class="text-primary">Click
                                Here</a>
                        </p>
                        <input type="submit" class="mt-1 btn btn-primary" id="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>

@if($user->state > 0)

<script>
$(document).ready(function() {
    getDistrictByState('{{$user->state}}', '{{$user->district_id}}');


});
</script>
@endif
<!-- 
<script src="{{asset('public/js/custom.js')}}"></script> -->
@endpush