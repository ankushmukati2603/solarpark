@extends('layouts.masters.home')
@section('content')
<div class="login-box text-center container-fluid">
    <h2>Reset Password</h2>
    <div id="loginform" class="mt-30 row">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <form method="POST" action="{{URL::to('reset-user-password')}}">
            @csrf
            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <select name="user_type" class="form-control required" id="user_type" onChange="hide_phone()">
                    <option selected="" disabled="">Select User Type</option>
                    <option value="MNRE">MNRE</option>
                    <option value="STATEIMPLEMENTINGAGENCY">Beneficiary</option>
                    <!-- <option value="LOCALBODY">LOCAL BODY</option>
                    <option value="INSTALLER">INSTALLER</option>
                    <option value="INSPECTOR">INSPECTOR</option> -->
                </select>
            </div>
            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <span class="fa fa-user form-control-feedback"></span>

                <input type="email" id="email" class="form-control " placeholder="Login email" name="email"
                    autocomplete="off" autofocus="">
            </div>

            <div class="form-group has-feedback col-sm-12 pr-0 pl-0" id="phone_div">
                <span class="fa fa-user form-control-feedback"></span>

                <input type="number" id="phone" minlength="10" maxlength="10" min="0" class="form-control required"
                    placeholder="Phone Number" name="phone" autocomplete="off" autofocus="">
            </div>


            <div class="clearfix"></div>


            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                submit
            </button>
            <a href="{{URL::to('sandes')}}">Download Sandes App to Receive OTP</a>


        </form>
    </div>
</div>
<script>
function hide_phone() {
    $('#phone_div').show();
    var utype = $("#user_type option:selected").text();
    if (utype == 'MNRE') {
        $('#phone_div').hide();
    }
}
</script>
@endsection