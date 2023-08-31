@extends('layouts.masters.home')
@section('content')
<div class="container">
    <div class="box box-primary frontPagesBox">
        <div class="box-body">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            State Implementing Agencies
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <strong>
                                <a
                                    href="{{url('public/downloadables/state_implementing_agency_registration_form.docx')}}"><i
                                        class="fa fa-download" aria-hidden="true"></i> Implementing Agency Registration
                                    Form</a><br>
                                <a href="{{url('public/downloadables/implementing_agency_demand_form.docx')}}"><i
                                        class="fa fa-download" aria-hidden="true"></i> Implementing Agency
                                    Demand
                                    Request Form</a><br>
                                <a
                                    href="{{url('public/downloadables/Implementing_agency_sanction_application_requestForm.docx')}}"><i
                                        class="fa fa-download" aria-hidden="true"></i> Implementing Agency
                                    Sanction
                                    Request Form
                                </a>
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Local Bodies
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <strong><a href="{{url('public/downloadables/localbody_registration_form.docx')}}"><i
                                        class="fa fa-download" aria-hidden="true"></i> Local Body Registration
                                    Form</a></strong><br>
                            <a href="{{url('public/downloadables/demand_assesment_form.docx')}}"><i
                                    class="fa fa-download" aria-hidden="true"></i> Local Body Demand Request
                                Form</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            Installers
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <strong><a
                                    href="{{url('public/downloadables/Installer_registration_request_form.docx')}}"><i
                                        class="fa fa-download" aria-hidden="true"></i> Installer Registration
                                    Form</a></strong>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseFour">
                            Inspectors
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingFour">
                        <div class="accordion-body">
                            <strong><a
                                    href="{{url('public/downloadables/inspector_registration_request_form.docx')}}"><i
                                        class="fa fa-download" aria-hidden="true"></i> Inspector Registration
                                    Form</a></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection