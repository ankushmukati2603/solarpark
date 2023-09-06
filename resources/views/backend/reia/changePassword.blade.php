@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">
    <main id="main" class="main">

    <section class="form_sctn" >
            <div class="row">
            </div>
            <div class="row">
                <div class="col-xxl-6 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>Change Password</h1> 
                            <hr style="color: #959595;">
                        </div>

         <!-- <div class="pagetitle">
            <h1></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </nav>
        </div> -->
        <!-- <strong>
            <h1 class="text-center">REIA</h1>
        </strong> -->
        <!-- <strong>
            <h4 class="text-center">Bidder List</h4>
        </strong> -->
        @include('layouts.partials.backend._flash')
        
 
        <div class="clearfix"></div><br>
        <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-bidder')}}" class="btn btn-success"
            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add Bidder</a> -->

            <form action="{{$submitUrl}}" id="changePasswordForm" method="POST">
                    @csrf
                    <div class="form-group">
                  
                        <label for="current_password">{{ __('Current Password') }}<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="current_password" autocomplete="off">
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">{{ __('New Password') }}<span class="text-danger">*</span></label>
                        <input type="password" data-placement="bottom" data-toggle="popover" data-trigger="focus"
                            data-html="true" data-content='<div id="errors"></div>'
                            class="form-control required passwordStrength" minlength="6" id="new_password"
                            name="new_password" autocomplete="off">
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation" autocomplete="off">
                        @error('new_password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                </form>
    </main>
</section>

@endsection
@push('backend-js')
<!-- <script type="text/javascript">
$(function() {
    $('#changePasswordForm').validate();
    $("#new_password_confirmation").rules('add', {
        equalTo: "#new_password",
        messages: {
            equalTo: "Not matched with password."
        }
    });
});
</script> -->
@endpush



