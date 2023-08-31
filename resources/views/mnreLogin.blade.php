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
                            <div class="register_hdng_text">MNRE Login</div>
                        </div>
                        <form id="formLogin" action="{{ route('login') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>User Email ID</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input placeholder="Login Email" name="email" id="email" type="text"
                                            class="form-control">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name"><strong>Password</strong> <span
                                            class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input placeholder="Password" name="password" id="password" type="password"
                                            class="form-control">
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <input type="hidden" name="user_type" id="user_type" value="MNRE" />
                                <div class="form-group">
                                    <!-- <div class="row">
                                        <div class="col-lg-12">
                                            <label for="name"><strong>Select User Type </strong></label>
                                            <select name="" class="form-control required mb-15" id=""
                                                required>
                                                <option selected disabled>Select User Type</option>
                                                <option value="MNRE" selected>MNRE</option>
                                                 
                                            </select>
                                        </div>
                                    </div> -->
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
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-12 text-center">
                                    <button type="submit" id="btn-login" class="btn btn-success btn-lg">Login</button>
                                    <span id="tk"></span>
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
<script src="{{asset('public/js/crypto-js.min.js')}}"></script>
<script src="{{asset('public/js/aes.min.js')}}"></script>
@section('scripts')
<script>
function createToken() {
    if ($('#email').val() != '') {

        $('#loadingImg').removeClass('hidden');

        var token = makeid(20);
        $.ajax({
            type: "POST",
            url: "ajax/generate-token/" + token,
            data: {
                token: token,
            },
            processData: false,
            contentType: false,
            success: function(response) {
                $('#tk').html(token);
                $('#loadingImg').addClass('hidden');
            },
        });
    }



}
document.querySelector('#formLogin').addEventListener('submit', (e) => {
    e.preventDefault();

    var id = document.getElementById("email");
    var pwd = document.getElementById("password");
    var token = document.getElementById("tk").innerText;

    pwd.value = pwd.value + '-' + token;
    //alert(pwd.value);
    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");


    var encId = CryptoJS.AES.encrypt(id.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    var encPwd = CryptoJS.AES.encrypt(pwd.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    id.value = encId.toString();
    pwd.value = encPwd.toString();
    var loginForm = document.getElementById("formLogin");
    loginForm.submit();

});
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