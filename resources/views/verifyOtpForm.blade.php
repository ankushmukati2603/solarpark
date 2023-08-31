@extends('layouts.masters.home')
@section('content')
<section id="content">
    <div id="loader" class="overlay">
        <div class="overlay__inner">
            <div class="overlay__content">
                <span class="spinner"></span>
                <div class="clearfix mb-15"></div>
                <span class="colorWhite">Processing, Please wait</span>
            </div>
        </div>
    </div>
    <div class="login-box text-center container-fluid">
        <h2>Verify OTP</h2>
        <div id="loginform" class="mt-30 row">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <form method="POST" action="{{URL::to('verify-otp')}}">
                @csrf
                <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                    <input type="password" id="email" class="form-control required" minlength="0" maxlength="6"
                        placeholder="Enter Email OTP" name="email" autocomplete="off" autofocus="">
                </div>
                @if(session('user_type')!= 'MNRE')
                <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                    <input type="password" id="phone" class="form-control required" minlength="0" maxlength="6"
                        placeholder="Enter Phone OTP" name="phone" autocomplete="off" autofocus="">
                </div>
                @endif
                <div class="clearfix"></div>
                <div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Verify OTP
                </button>

            </form>
        </div>
    </div>
</section>
@endsection