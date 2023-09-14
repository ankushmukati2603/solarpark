@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Feedback</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Feedback</h1>

                        <hr style="color: #959595;">
                        <form action="{{URL::to(Auth::getDefaultDriver().'/feedback')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 pb-3">
                                    <div class=""><label>Name</label></div>
                                    <div class=""><input type="text" class="form-control" readonly
                                            value="{{Auth::user()->name ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 pb-3">
                                    <div class=""><label>Email ID</label></div>
                                    <div class=""><input type="text" class="form-control" readonly
                                            value="{{Auth::user()->email ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 pb-3">
                                    <div class=""><label>Contact Number</label></div>
                                    <div class=""><input type="text" class="form-control" readonly
                                            value="{{Auth::user()->contact_no ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 pb-3">
                                    <div class=""><label>Feedback <span class="text-danger">*</span></label></div>
                                    <div class=""><textarea class="form-control" rows="5" name="message" id="message"
                                            @if(($getFeedback->message ?? '')!='') readonly @endif>{{ $getFeedback->message ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class=" pt-4 text-center">
                                        @if(($getFeedback->message ?? '')=='')
                                        <input type="submit" name="submit" class="btn btn-success" value="Save" />
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/feedback')}}"
                                            class="btn btn-danger">Reset</a>
                                        @endif


                                    </div>
                                </div>
                            </div>
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
@endpush