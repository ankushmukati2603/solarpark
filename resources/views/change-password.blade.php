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
        <h2>Change Password</h2>
        <div id="loginform" class="mt-30 row">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <form method="POST" action="{{URL::to('change-password')}}">
                @csrf
                <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                    <input type="password" id="password" class="form-control required" placeholder="Enter New password"
                        name="password" autocomplete="off" autofocus="">
                </div>

                <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                    <input type="password" id="confirm-password" class="form-control required"
                        placeholder="Enter confirm password" name="confirm-password" autocomplete="off" autofocus="">
                </div>

                <div class="clearfix"></div>
                <div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
    </div>
</section>
@endsection