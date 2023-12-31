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
                            <div class="register_hdng_text">State/Central Agencies Login</div>
                        </div>
                        <form action="{{ route('login') }}" method="POST" autocomplete="off" id="formLogin">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong> Email Id <span
                                                class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder=" Email Id" name="email" id="email" type="text"
                                            class="form-control">
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>Password <span
                                                class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Password" name="password" id="password" type="password"
                                            class="form-control">
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="name"><strong>Select Type <span
                                                        class="text-danger">*</span></strong></label>
                                            <select name="user_type" class="form-control required mb-15" id="user_type"
                                                required>
                                                <!-- <option>Select User Type</option>
                                                <option value="MNRE">MNRE</option> -->
                                                <option value="STATEIMPLEMENTINGAGENCY" selected>State Implementing
                                                    Agency ( SIA )
                                                </option>
                                                <option value="SECI">Solar Energy Corporation of India Limited ( SECI )
                                                </option>
                                                <option value="REIA">REIA's</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if(!env('DEV_ENVIRONMENT'))
                                <div class="col-sm-12 p-0">
                                    <div class="captcha login-captcha col-sm-12">
                                        <?php echo captcha_img('flat'); ?>
                                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                            aria-hidden="true"></i>
                                        <div class="clearfix"></div>
                                        <input type="text" id="captcha-input" class="form-control required"
                                            name="captcha" placeholder="Captcha">
                                    </div>
                                </div>
                                @else
                                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                                @endif
                                @if(count($errors))
                                <div class="form-group">
                                    <div class="alert alert-danger alert-validations text-center">
                                        @foreach ($errors->all() as $error)
                                        <span class="fs12">{{ $error }}</span><br>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
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
@php
Session::put('random_session_id1',time().rand('10000', '99999'));
Session::put('random_session_id2',time().rand('100000', '9999989'));
@endphp
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>




<script src="{{asset('public/js/crypto-js.min.js')}}"></script>
<script src="{{asset('public/js/aes.min.js')}}"></script>
<script type="text/javascript">
//    $(document).ready(function(){
//  $("#btn-login").click(function(){
//    alert("The paragraph was clicked.");
//  });
//});
document.querySelector('#formLogin').addEventListener('submit', (e) => {
    e.preventDefault();

    var id = document.getElementById("email");
    var pwd = document.getElementById("password");
    var id1 = {{Session::get('random_session_id2')}} + id.value + {{Session::get('random_session_id1')}};
    var pwd1 = {{Session::get('random_session_id2')}} + pwd.value + {{Session::get('random_session_id1')}};

    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
    
    var encId = CryptoJS.AES.encrypt(id1, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    var encPwd = CryptoJS.AES.encrypt(pwd1, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    // alert(encId+'----'+encPwd);
    id.value = encId.toString();
    pwd.value = encPwd.toString();
    var loginForm = document.getElementById("formLogin");
    loginForm.submit();
});
</script>
<script type="text/javascript">
$(function() {
    $('#refresh-captcha').click(function() {

        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
});
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