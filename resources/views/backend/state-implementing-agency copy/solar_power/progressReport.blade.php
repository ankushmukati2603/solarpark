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
                        <div class="row">
                            <ul id="application-tabs" class="nav nav-tabs">
                                <li class="active @if($generalData['general']!='')completed @endif"><a data-toggle="tab"
                                        href="#general"><b>General</b></a></li>
                                <li class=" @if($generalData['tender']!='')completed @endif"><a data-toggle="tab"
                                        href="#tender"><b>Tenders/NIT/RFS</b></a></li>
                                <li class=" @if($generalData['reverseAuction']!='')completed @endif"><a
                                        data-toggle="tab" href="#reverseAuction"><b>Reverse Auction</b></a></li>
                                <li class=" @if($generalData['cancelledTenders']!='')completed @endif"><a
                                        data-toggle="tab" href="#cancelledTenders"><b>Cancelled Tenders</b></a>
                                </li>
                                <li class=" @if($generalData['selectedBidders']!='')completed @endif"><a
                                        data-toggle="tab" href="#selectedBidders"><b>Selected Bidders</b></a>
                                </li>
                                <!-- <li><a data-toggle="tab" href="#discoveredTariffs"><b>Discovered Tariffs</b></a></li>
                            <li><a data-toggle="tab" href="#signingOfPPAPSA"><b>Signing of PPA/PSA</b></a></li> -->
                                <li class=" @if($generalData['commissioning']!='')completed @endif"><a data-toggle="tab"
                                        href="#commissioning"><b>Commissioning</b></a></li>
                                <li><a data-toggle="tab" href="#additionalInformation"><b>Additional
                                            Information</b></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="general">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax" name="general">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/general')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                            <input type="submit" name="submit" id="submit_general" value="Save"
                                                class="btn btn-flat btn-success" />
                                            <input type="hidden" name="type" value="general" id="">
                                            <input type="hidden" name="next" value="tender" id="">
                                            <button type="button" data-next="tender" class="btn btn-flat btn-primary"
                                                onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                                value="1" name="general"> Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="tab-pane " id="tender">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax1" name="tender">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/tender')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                            <button type="button" class="btn btn-flat btn-danger"
                                                onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                                value="1" name="general"> Back</button>
                                            <input type="submit" name="submit" id="submit_tender" value="Save"
                                                class="btn btn-flat btn-success" />
                                            <input type="hidden" name="type" value="tender" id="">
                                            <input type="hidden" name="next" value="reverseAuction" id="">
                                            <button type="button" data-next="reverseAuction"
                                                class="btn btn-flat btn-primary"
                                                onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                                value="1" name="tender"> Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="tab-pane " id="reverseAuction">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                        name="reverseAuction">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/reverseAuction')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                            <button type="button" class="btn btn-flat btn-danger"
                                                onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                                value="1" name="tender"> Back</button>
                                            <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                                class="btn btn-flat btn-success" />
                                            <input type="hidden" name="type" value="reverseAuction" id="">
                                            <input type="hidden" name="next" value="cancelledTenders" id="">
                                            <button type="button" data-next="cancelledTenders"
                                                class="btn btn-flat btn-primary"
                                                onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                                value="1" name="reverseAuction"> Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="tab-pane " id="cancelledTenders">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                        name="cancelledTenders">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/cancelledTenders')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                            <button type="button" class="btn btn-flat btn-danger"
                                                onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                                value="1" name="reverseAuction"> Back</button>

                                            <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                                class="btn btn-flat btn-success" />
                                            <input type="hidden" name="type" value="cancelledTenders" id="">
                                            <input type="hidden" name="next" value="selectedBidders" id="">
                                            <button type="button" data-next="selectedBidders"
                                                class="btn btn-flat btn-primary"
                                                onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                                value="1" name="cancelledTenders"> Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="tab-pane " id="selectedBidders">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                        name="selectedBidders">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/selectedBidders')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                            <button type="button" class="btn btn-flat btn-danger"
                                                onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                                value="1" name="cancelledTenders"> Back</button>

                                            <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                                class="btn btn-flat btn-success" />
                                            <input type="hidden" name="type" value="selectedBidders" id="">
                                            <input type="hidden" name="next" value="commissioning" id="">
                                            <button type="button" data-next="commissioning"
                                                class="btn btn-flat btn-primary"
                                                onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                                value="1" name="selectedBidders"> Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <!-- <div class="tab-pane " id="discoveredTariffs">
                                <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="discoveredTariffs">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/solar_power/discoveredTariffs')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button>
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="discoveredTariffs" id="">
                                        <input type="hidden" name="next" value="signingOfPPAPSA" id="">
                                        <button type="button" data-next="signingOfPPAPSA"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="discoveredTariffs"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="tab-pane " id="signingOfPPAPSA">
                                <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                    name="signingOfPPAPSA">
                                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                    @csrf
                                    @include('backend/state-implementing-agency/solar_power/signingOfPPAPSA')
                                    <div class="clearfix"></div>
                                    <div class="col-md-12"><br>
                                        <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button>
                                        <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="signingOfPPAPSA" id="">
                                        <input type="hidden" name="next" value="commissioning" id="">
                                        <button type="button" data-next="commissioning" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="signingOfPPAPSA"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div> -->
                                <div class="tab-pane " id="commissioning">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                        name="commissioning">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/commissioning')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                            <button type="button" class="btn btn-flat btn-danger"
                                                onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                                value="1" name="selectedBidders"> Back</button>

                                            <input type="submit" name="submit" id="submit_reverseAuction" value="Save"
                                                class="btn btn-flat btn-success" />
                                            <input type="hidden" name="type" value="commissioning" id="">
                                            <input type="hidden" name="next" value="additionalInformation" id="">
                                            <button type="button" data-next="additionalInformation"
                                                class="btn btn-flat btn-primary"
                                                onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                                value="1" name="commissioning"> Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="tab-pane " id="additionalInformation">
                                    <form action="{{ URL::to(Auth::getDefaultDriver().'/solar-Power-Report') }}"
                                        method="POST" enctype="multipart/form-data" id="formFileAjax1"
                                        name="additionalInformation">
                                        <input type="hidden" name="editId" value="{{$id ?? ''}}">
                                        @csrf
                                        @include('backend/state-implementing-agency/solar_power/additionalInformation')
                                        <div class="clearfix"></div>
                                        <div class="col-md-12"><br>
                                            <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">save</button> -->
                                            <button type="button" class="btn btn-flat btn-danger"
                                                onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                                value="1" name="commissioning"> Back</button>

                                            <input type="submit" name="submit" id="submit_reverseAuction"
                                                value="Final Submit" class="btn btn-flat btn-success" />
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