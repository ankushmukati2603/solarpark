@extends('layouts.masters.backend')
@section('title', 'Change Password')
@section('content')


<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </nav>
        </div>
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Change Password</h1>
                    <hr style="color: #959595;">
                    <form action="{{$submitUrl}}" id="changePasswordForm1" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">{{ __('Current Password') }} <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="current_password" autocomplete="off">

                        </div>
                        <div class="form-group">
                            <label for="new_password">{{ __('New Password') }} <span
                                    class="text-danger">*</span></label>
                            <input type="password" data-placement="bottom" data-toggle="popover" data-trigger="focus"
                                data-html="true" data-content='<div id="errors"></div>'
                                class="form-control required passwordStrength" minlength="6" id="new_password"
                                name="new_password" autocomplete="off">

                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">{{ __('Confirm Password') }} <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation" autocomplete="off">

                        </div>
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
<script src="{{asset('public/js/custom.js')}}"></script>
<script type="text/javascript">
$(function() {
    $('#changePasswordForm').validate();
    $("#new_password_confirmation").rules('add', {
        equalTo: "#new_password",
        messages: {
            equalTo: "Not matched with password."
        }
    });
});
</script>
@endpush