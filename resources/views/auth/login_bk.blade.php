@extends('layouts.masters.home')
@section('content')
<section class="register_page bg_fade">

    <div class="container-fluid px-5">
        <div class="row pb-5 pt-5">
            <div class="col-xxl-3"></div>
            <div class="col-xxl-6 pt-5 ">
                <div class="row   register_form">

                    <div class="col-xl-5 left_blk">
                        <div><a href="{{url('sandes')}}"><img src="{{ URL::asset('public/images/sandes_app_img.png')}}"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xl-7 right_blk">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text">State Central Agencies Login</div>
                        </div>
                        <form action="{{ route('login') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>User Email ID*</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Login Email" name="email" type="text" class="form-control">
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>Password</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Password" name="password" type="password"
                                            class="form-control">
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="name"><strong>Select User Type </strong></label>
                                            <select name="user_type" class="form-control required mb-15" id="user_type"
                                                required>
                                                <!-- <option>Select User Type</option>
                                                <option value="MNRE">MNRE</option> -->
                                                <option value="STATEIMPLEMENTINGAGENCY" selected>STATE IMPLEMENTING
                                                    AGENCY
                                                </option>
                                                <option value="SECI">SECI</option>
                                                <!-- <option value="INSPECTOR">INSPECTOR</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if(count($errors))
                                    <div class="alert alert-danger alert-validations text-center">
                                        @foreach ($errors->all() as $error)
                                        <span class="fs12">{{ $error }}</span><br>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 text-center">
                                    <button type="submit" id="btn-login" class="btn btn-success btn-lg">Login</button>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-12 text-secondary pb-3 text-center">
                                    <a href="{{route('reset.password')}}">Forgot
                                        your password?</a>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

            </div>
            <div class="col-xxl-2"></div>
        </div>
    </div>
</section>



@endsection
@section('scripts')
<script>
$(function() {
    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
})
</script>
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
@endsection