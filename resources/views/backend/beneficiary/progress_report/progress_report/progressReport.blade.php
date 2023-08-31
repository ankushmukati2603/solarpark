@extends('layouts.masters.backend')
@section('content')
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
            <div class="row">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" id="tabUL">
                    <li class="active @if($generalData['general']!='')completed @endif"><a href="#general" role="tab"
                            data-toggle="tab">General</a></li>
                    <li class="@if($generalData['internal_infrastructure']!='')completed @endif"><a
                            href="#internal_infrastructure" role="tab" data-toggle="tab">Internal Infrastructure</a>
                    </li>
                    <li class="@if($generalData['road']!='')completed @endif"><a href="#road" role="tab"
                            data-toggle="tab">Road</a></li>
                    <li class="@if($generalData['water_facilities']!='')completed @endif"><a href="#water_facilities"
                            role="tab" data-toggle="tab">Water Facilities</a></li>
                    <li class="@if($generalData['drainage_system']!='')completed @endif"><a href="#drainage_system"
                            role="tab" data-toggle="tab">Drainage System</a></li>
                    <li class="@if($generalData['fencing_boundary']!='')completed @endif"><a href="#fencing_boundary"
                            role="tab" data-toggle="tab">Fencing Boundary</a></li>
                    <li class="@if($generalData['telecommunication_facilities']!='')completed @endif"><a
                            href="#telecommunication_facilities" role="tab" data-toggle="tab">Telecommunication
                            Facilities</a>
                    </li>
                    <li class="@if($generalData['internal_transmission_system']!='')completed @endif"><a
                            href="#internal_transmission_system" role="tab" data-toggle="tab">Internal Transmission
                            System</a>
                    </li>
                    <li class="@if($generalData['external_transmission_system']!='')completed @endif"><a
                            href="#external_transmission_system" role="tab" data-toggle="tab">External Transmission
                            System</a>
                    </li>
                    <li class="@if($generalData['solar_projects']!='')completed @endif"><a href="#solar_projects"
                            role="tab" data-toggle="tab">Solar Projects</a></li>
                    <li class="@if($generalData['financial_closure']!='')completed @endif"><a href="#financial_closure"
                            role="tab" data-toggle="tab">Financial Closure</a></li>
                    <li class="@if($generalData['award_of_work']!='')completed @endif"><a href="#award_of_work"
                            role="tab" data-toggle="tab">Award of Work</a></li>
                    <li class="@if($generalData['solar_park_completion']!='')completed @endif"><a
                            href="#solar_park_completion" role="tab" data-toggle="tab">Solar Park Completion</a></li>
                    <li class="@if($generalData['external_power_evacuation_system']!='')completed @endif"><a
                            href="#external_power_evacuation_system" role="tab" data-toggle="tab">External Power
                            Evacuation System</a>
                    </li>
                    <li class="@if($generalData['solar_project_completion']!='')completed @endif"><a
                            href="#solar_project_completion" role="tab" data-toggle="tab">Solar Project Completion</a>
                    </li>
                    <li class="@if($generalData['attachments']!='')completed @endif"><a href="#attachments" role="tab"
                            data-toggle="tab">Attachments</a></li>
                    <li class="@if($generalData['additional_information']!='')completed @endif"><a
                            href="#additional_information" role="tab" data-toggle="tab">Additional Information</a></li>
                    <li class=""><a href="#final_submission" role="tab" data-toggle="tab">Final Submission</a></li>
                </ul>
                <!-- Tab panes -->

                <div class="tab-content">


                    <div class="tab-pane active" id="general">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="general">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/general')
                            <div class="clearfix"></div>
                            <div class="col-md-12"><br>
                                <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                <input type="submit" name="submit" id="submit_general" value="Save"
                                    class="btn btn-flat btn-success" />
                                <input type="hidden" name="type" value="general" id="">
                                <input type="hidden" name="next" value="internal_infrastructure" id="">
                                <button type="button" data-next="internal_infrastructure"
                                    class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="general"> Next</button>

                            </div>
                            <div class="clearfix"></div>
                        </form>

                    </div>
                    <div class="tab-pane" id="internal_infrastructure">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax"
                            name="internal_infrastructure">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/internal_infrastructure')
                            <div class="clearfix"></div>
                            <div class="col-md-12"><br>
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="general"> Back</button>

                                <input type="hidden" name="type" value="internal_infrastructure" id="">
                                <input type="hidden" name="next" value="road" id="">

                                <input type="submit" name="submit_internal_infrastructure"
                                    id="submit_internal_infrastructure" value="Save" class="btn btn-flat btn-success" />


                                <button type="button" data-next="road" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="internal_infrastructure"> Next</button>
                            </div>

                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="road">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="road">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/road')
                            <input type="hidden" name="type" value="road" id="">
                            <input type="hidden" name="next" value="water_facilities" id="">
                            <div class="clearfix"></div>
                            <div class="col-md-3">

                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1">
                                    Back</button>

                                <input type="submit" name="submit_road" id="submit_road" value="Save"
                                    class="btn btn-flat btn-success" />
                                <button type="button" data-next="water_facilities" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="road"> Next</button>
                            </div>

                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="water_facilities">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="water_facilities">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/water_facilities')
                            <div class="clearfix"></div>
                            <div class="col-md-3">
                                <input type="hidden" name="type" value="water_facilities" id="">
                                <input type="hidden" name="next" value="drainage_system" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="road"> Back</button>
                                <input type="submit" name="submit_water_facilities" id="submit_water_facilities"
                                    value="Save" class="btn btn-flat btn-success" />

                                <button type="button" data-next="drainage_system" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="water_facilities"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="drainage_system">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="drainage_system">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/drainage_system')
                            <div class="clearfix"></div>

                            <div class="col-md-3">
                                <input type="hidden" name="type" value="drainage_system" id="">
                                <input type="hidden" name="next" value="fencing_boundary" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="water_facilities"> Back</button>

                                <input type="submit" name="submit_drainage_system" id="submit_drainage_system"
                                    value="Save" class="btn btn-flat btn-success" />

                                <button type="button" data-next="fencing_boundary" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="drainage_system"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="fencing_boundary">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="fencing_boundary">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/fencing_boundary')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="fencing_boundary" id="">
                                <input type="hidden" name="next" value="telecommunication_facilities" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="drainage_system"> Back</button>

                                <input type="submit" name="submit_fencing_boundary" id="submit_fencing_boundary"
                                    value="Save" class="btn btn-flat btn-success" />

                                <button type="button" data-next="telecommunication_facilities"
                                    class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="fencing_boundary"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="telecommunication_facilities">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax"
                            name="telecommunication_facilities">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/telecommunication_facilities')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="telecommunication_facilities" id="">
                                <input type="hidden" name="next" value="internal_transmission_system" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="fencing_boundary"> Back</button>

                                <input type="submit" name="submit_telecommunication_facilities"
                                    id="submit_telecommunication_facilities" value="Save"
                                    class="btn btn-flat btn-success" />

                                <button type="button" data-next="internal_transmission_system"
                                    class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="telecommunication_facilities"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="internal_transmission_system">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax"
                            name="internal_transmission_system">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/internal_transmission_system')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="internal_transmission_system" id="">
                                <input type="hidden" name="next" value="external_transmission_system" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="telecommunication_facilities"> Back</button>

                                <input type="submit" name="submit_internal_transmission_system"
                                    id="submit_internal_transmission_system" value="Save"
                                    class="btn btn-flat btn-success" />

                                <button type="button" data-next="external_transmission_system"
                                    class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="internal_transmission_system"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="external_transmission_system">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax"
                            name="external_transmission_system">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/external_transmission_system')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="external_transmission_system" id="">
                                <input type="hidden" name="next" value="solar_projects" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="internal_transmission_system"> Back</button>

                                <input type="submit" name="submit_external_transmission_system"
                                    id="submit_external_transmission_system" value="Save"
                                    class="btn btn-flat btn-success" />

                                <button type="button" data-next="solar_projects" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="external_transmission_system"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="solar_projects">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="solar_projects">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/solar_projects')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="solar_projects" id="">
                                <input type="hidden" name="next" value="financial_closure" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="external_transmission_system"> Back</button>

                                <input type="submit" name="submit_solar_projects" id="submit_solar_projects"
                                    value="Save" class="btn btn-flat btn-success" />

                                <button type="button" data-next="financial_closure" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="solar_projects"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="financial_closure">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="financial_closure">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/financial_closure')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="financial_closure" id="">
                                <input type="hidden" name="next" value="award_of_work" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="solar_projects"> Back</button>

                                <input type="submit" name="submit_financial_closure" id="submit_financial_closure"
                                    value="Save" class="btn btn-flat btn-success" />

                                <button type="button" data-next="award_of_work" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="financial_closure"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="award_of_work">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="award_of_work">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/award_of_work')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="award_of_work" id="">
                                <input type="hidden" name="next" value="solar_park_completion" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="financial_closure"> Back</button>

                                <input type="submit" name="submit_award_of_work" id="submit_award_of_work" value="Save"
                                    class="btn btn-flat btn-success" />

                                <button type="button" data-next="solar_park_completion" class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="award_of_work"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="solar_park_completion">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="solar_park_completion">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/solar_park_completion')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="solar_park_completion" id="">
                                <input type="hidden" name="next" value="external_power_evacuation_system" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="award_of_work"> Back</button>

                                <input type="submit" name="submit_solar_park_completion"
                                    id="submit_solar_park_completion" value="Save" class="btn btn-flat btn-success" />

                                <button type="button" data-next="external_power_evacuation_system"
                                    class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="solar_park_completion"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="external_power_evacuation_system">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax"
                            name="external_power_evacuation_system">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/external_power_evacuation_system')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="external_power_evacuation_system" id="">
                                <input type="hidden" name="next" value="solar_project_completion" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="solar_park_completion"> Back</button>

                                <input type="submit" name="submit_external_power_evacuation_system"
                                    id="submit_external_power_evacuation_system" value="Save"
                                    class="btn btn-flat btn-success" />

                                <button type="button" data-next="solar_project_completion"
                                    class="btn btn-flat btn-primary"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="external_power_evacuation_system"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="solar_project_completion">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax"
                            name="solar_project_completion">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/solar_project_completion')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="solar_project_completion" id="">
                                <input type="hidden" name="next" value="attachments" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="external_power_evacuation_system"> Back</button>

                                <input type="submit" name="submit_solar_project_completion"
                                    id="submit_solar_project_completion" value="Save"
                                    class="btn btn-flat btn-success" />


                                <button type="button" class="btn btn-flat btn-primary" data-next="attachments"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="solar_project_completion"> Next</button>
                                <div>
                                    <br><br><br>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="attachments">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="attachments">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/attachments')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="attachments" id="">
                                <input type="hidden" name="next" value="additional_information" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="solar_project_completion"> Back</button>

                                <input type="submit" name="submit_attachments" id="submit_attachments" value="Save"
                                    class="btn btn-flat btn-success" />

                                <button type="button" class="btn btn-flat btn-primary"
                                    data-next="additional_information"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="attachments"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="additional_information">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="additional_information">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/additional_information')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="additional_information" id="">
                                <input type="hidden" name="next" value="final_submission" id="">
                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="attachments"> Back</button>

                                <input type="submit" name="submit_additional_information"
                                    id="submit_additional_information" value="Save" class="btn btn-flat btn-success" />

                                <button type="button" class="btn btn-flat btn-primary" data-next="final_submission"
                                    onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');" value="1"
                                    name="additional_information"> Next</button>
                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="final_submission">
                        <form action="{{ URL::to(Auth::getDefaultDriver().'/application/progress_report') }}"
                            method="POST" enctype="multipart/form-data" id="formFileAjax" name="additional_information">
                            <input type="hidden" name="editId" value="{{$id ?? ''}}">
                            @csrf
                            @include('backend/beneficiary/progress_report/final_submission')
                            <div class="clearfix"></div>
                            <div class="col-md-3 pt-15">
                                <input type="hidden" name="type" value="final_submission" id="">

                                <button type="button" class="btn btn-flat btn-danger"
                                    onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');" value="1"
                                    name="additional_information"> Back</button>

                                <input type="submit" name="submit_final_submission" id="submit_final_submission"
                                    value="Final Submission" class="btn btn-flat btn-success" />

                            </div>
                            <div>
                                <br><br><br>
                                <div class="clearfix"></div>
                            </div>
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
    border-radius: 50%;
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





@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush