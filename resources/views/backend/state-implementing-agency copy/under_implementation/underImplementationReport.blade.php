@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
            integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
            crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
        </script>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row app_progrs_rprt">
                        <ul id="application-tabs" class="nav nav-tabs">
                            <li class="active  @if($generalData['general']!='')completed @endif"><a data-toggle="tab"
                                    href="#general"><b>General</b></a></li>
                            <li class=" @if($generalData['project_location']!='')completed @endif"><a data-toggle="tab"
                                    href="#projectLocation"><b>Project Location</b></a></li>
                            <li class=" @if($generalData['date']!='')completed @endif"><a data-toggle="tab"
                                    href="#date"><b>Dates</b></a></li>
                            <li class=" @if($generalData['status']!='')completed @endif"><a data-toggle="tab"
                                    href="#status"><b>Status</b></a>
                            <li class=" @if($generalData['scheduled']!='')completed @endif"><a data-toggle="tab"
                                    href="#scheduled"><b>Scheduled Date</b></a>
                            <li class=" @if($generalData['extendedDate']!='')completed @endif"><a data-toggle="tab"
                                    href="#extendedDate"><b>Extended Date</b></a></li>
                            <li><a data-toggle="tab" href="#additionalInformation"><b>Additional Information</b></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="general">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax" name="general">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/general')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_general" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="general" id="">
                                        <input type="hidden" name="next" value="projectLocation" id="">
                                        <button type="button" data-next="projectLocation"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="general"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="tab-pane " id="projectLocation">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="projectLocation">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/projectLocation')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_projectLocation" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="projectLocation" id="">
                                        <input type="hidden" name="next" value="date" id="">
                                        <button type="button" data-next="date" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="projectLocation"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="tab-pane " id="date">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1" name="date">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/date')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_date" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="date" id="">
                                        <input type="hidden" name="next" value="status" id="">
                                        <button type="button" data-next="status" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="date"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="tab-pane " id="status">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1" name="status">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/status')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="status" id="">
                                        <input type="hidden" name="next" value="scheduled" id="">
                                        <button type="button" data-next="scheduled" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="status"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="tab-pane " id="scheduled">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1" name="scheduled">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/scheduledDate')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="scheduled" id="">
                                        <input type="hidden" name="next" value="extendedDate" id="">
                                        <button type="button" data-next="extendedDate" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="scheduled"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="extendedDate">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1" name="extendedDate">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/extendedDate')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="extendedDate" id="">
                                        <input type="hidden" name="next" value="additionalInformation" id="">
                                        <button type="button" data-next="additionalInformation"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="extendedDate"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="tab-pane " id="additionalInformation">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solarpower-under-implementation') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="additionalInformation">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/under_implementation/additionalInformation')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="additionalInformation" id="">
                                        <!-- <input type="hidden" name="next" value="additionalInformation" id=""> -->
                                        <!-- <button type="button" data-next="" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="additionalInformation"> Next</button> -->
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </section>
        <style>
        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            color: #fff;
            cursor: default;
            background-color: #2174f1;
            border: 1px solid #fff;
            /* border-radius: 50%; */
            border-bottom-color: transparent;
        }

        .nav-tabs>li.completed>a,
        .nav-tabs>li.completed>a:focus,
        .nav-tabs>li.completed>a:hover {
            color: #fff;
            cursor: default;
            background-color: green;
            border: 1px solid #fff;
            color: #ccc !important;
            border-bottom-color: transparent;
        }
        </style>



    </main>
</section>

@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<!-- <script src="{{asset('public/js/form_custom.js')}}"></script> -->
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush