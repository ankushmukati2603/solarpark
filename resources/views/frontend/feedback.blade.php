@extends('layouts.masters.home')
@section('content')

<section class="feedback_page bg_fade">
    <div class="container-fluid px-5">
        <div class="row pb-5">
            <div class="col-xxl-3"></div>
            <div class="col-xxl-6 ">
                <div class="row pt-5">
                    <div class="col-xxl-12 section-tittle">
                        <h2 class="">
                            <center>Feedback Form</center>
                        </h2>
                    </div>
                    <div class="col-xl-12 feedback_form">
                        <form class="form-contact" action="{{ route('feedback') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Select</strong></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select name="scheme_type" class="form-control ">
                                            <option value="">Please Select </option>
                                            <option value="1">Solar Park</option>
                                            <option value="2">Solar Power</option>
                                            <!-- <option value="3">National Renewable Energy Fellowship Scheme</option>
                                            <option value="4">Short Term Trainings and Skill Development in Renewable
                                                Energy</option> -->
                                        </select>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Name</strong></label>
                                    <input type="text" class="form-control " value="" id="name" name="name"
                                        autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="email"><strong>Email address</strong></label>
                                    <input type="email" class="form-control " value="" id="email" name="email"
                                        autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-lg-6">
                                    <label for="mobile"><strong>Mobile</strong></label>
                                    <input type="number"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="10" value="" class="form-control " id="contact_no" name="contact_no"
                                        autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="subject"><strong>Subject</strong></label>
                                    <input type="test" value="" class="form-control " id="subject" name="subject"
                                        autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"><strong>Feedback Message</strong></label>
                                    <div style="position: relative;">
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <select name="feedback_type" class="form-control ">
                                            <option value="">Please Select</option>
                                            <option value="1">Feedback</option>
                                            <option value="2">Query</option>
                                        </select>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12" style="min-height: 100px;">
                                    <label for="subject"><strong>Summary</strong></label>
                                    <textarea name="message" class="form-control "
                                        placeholder="Write Something..."></textarea>
                                    <span class="text-danger"></span>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
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
                            </div>
                            <div class="row">
                                <div class="col-xl-12 text-center">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success"
                                        autocomplete="off">
                                </div>
                            </div>



                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush
@section('scripts')

<script>
$(function() {
    //$('#formLogin').validate();
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