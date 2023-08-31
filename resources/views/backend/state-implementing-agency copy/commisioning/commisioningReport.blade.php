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
                            <li class="active @if($generalData['general']!='')completed @endif"><a data-toggle="tab"
                                    href="#general"><b>General</b></a></li>
                            <li class=" @if($generalData['projectLocation']!='')completed @endif"><a data-toggle="tab"
                                    href="#projectLocation"><b>Project Location</b></a></li>
                            <li class=" @if($generalData['project_solar_park']!='')completed @endif"><a
                                    data-toggle="tab" href="#projectSolarPark"><b>Projects in Solar Park </b></a></li>
                            <li class=" @if($generalData['project_type']!='')completed @endif"><a data-toggle="tab"
                                    href="#projectType"><b>Project Type</b></a></li>
                            <li class=" @if($generalData['scheme_details']!='')completed @endif"><a data-toggle="tab"
                                    href="#schemeDetails"><b>Scheme Details </b></a></li>
                            <li class=" @if($generalData['project_details']!='')completed @endif"><a data-toggle="tab"
                                    href="#projectDetails"><b>Project Details</b></a></li>
                            <li class=" @if($generalData['commissioning']!='')completed @endif"><a data-toggle="tab"
                                    href="#commissioningDetails"><b>Commissioning</b></a></li>
                            <li class=" @if($generalData['additional_information']!='')completed @endif"><a
                                    data-toggle="tab" href="#additionalInformation"><b>Additional Information</b></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="general">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax" name="general">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/general')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
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
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="projectLocation">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/projectLocation')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_projectLocation" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="projectLocation" id="">
                                        <input type="hidden" name="next" value="projectSolarPark" id="">
                                        <button type="button" data-next="projectSolarPark"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="projectLocation"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="projectSolarPark">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="projectSolarPark">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/projectSolarPark')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_projectSolarPark" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="projectSolarPark" id="">
                                        <input type="hidden" name="next" value="projectType" id="">
                                        <button type="button" data-next="projectType" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="projectSolarPark"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="projectType">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1" name="projectType">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/projectType')

                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_projectType" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="projectType" id="">
                                        <input type="hidden" name="next" value="schemeDetails" id="">
                                        <button type="button" data-next="schemeDetails" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="projectType"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="schemeDetails">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1" name="schemeDetails">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/schemeDetails')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="schemeDetails" id="">
                                        <input type="hidden" name="next" value="projectDetails" id="">
                                        <button type="button" data-next="projectDetails"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="schemeDetails"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="projectDetails">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="projectDetails">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/projectDetails')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="projectDetails" id="">
                                        <input type="hidden" name="next" value="commissioningDetails" id="">
                                        <button type="button" data-next="commissioningDetails"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="projectDetails"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="commissioningDetails">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="commissioningDetails">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/commissioningDetails')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="commissioningDetails" id="">
                                        <input type="hidden" name="next" value="additionalInformation" id="">
                                        <button type="button" data-next="additionalInformation"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="commissioningDetails"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <div class="tab-pane " id="additionalInformation">
                                <form
                                    action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-commissioning-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="additionalInformation">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/commisioning/additionalInformation')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit" value="Save"
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
            color: #ccc !important border-radius: 50%;
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