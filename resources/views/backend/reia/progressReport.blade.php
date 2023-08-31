@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Progress Report</h1>
            <nav>
                <ol class="breadcrumb">

                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row   register_form">
                    <div class="col-xl-12">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text"></div>
                        </div>
                        @include('layouts.partials.backend._flash')
                        <form action="{{URL::to(Auth::getDefaultDriver().'/new-reia-progress-report/')}}"
                              method="post">
                            @csrf
                            <div class="row ">
                                <div class="col-md-12 progress_report_form" style="background: #f7f7f7; border: 1px solid #dedede; padding-top: 20px; padding-bottom: 20px; border-radius: 8px;box-shadow: 0 0 15px #0000001f;">
                                <div class="row" >
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Scheme Name <span class="text-danger">*</span></strong></label>
                                    <select class="form-control" id="scheme_id" name="scheme_id">
                                        <option value="">Select Scheme</option>
                                        @foreach($schemes as $scheme)
                                        <option value="{{$scheme->id}}">{{$scheme->scheme_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>State <span class="text-danger">*</span></strong></label>
                                    <select class="form-control" id="state_id" name="state_id" onchange="getDistrictByState(this.value, '')">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->code}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>District <span class="text-danger">*</span></strong></label>
                                    <select class="form-control"id="district_id"
                                            name="district_id">
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Type of Project <span class="text-danger">*</span></strong></label>
                                    <select class="form-control" id="project_type" name="project_type">
                                        <option value="">Select Project</option>
                                        <option value="Solar">Solar</option>
                                        <option value="Wind">Wind</option>
                                        <option value="Hybrid">Hybrid</option> 
                                    </select>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Tender Capacity ( MW ) <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Tender Capacity ( MW )" name="tender_capacity"
                                               id="tender_capacity" type="text" class="form-control"
                                               value="">
                                    </div>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Date of Tender <span class="text-danger">*</span>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input name="tender_date" id="tender_date" type="date"
                                               class="form-control" value="{{$reia->tender_date??''}}">
                                    </div>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Date of LOA <span class="text-danger">*</span>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Date of Notice inviting Tender" name="loa_date"
                                               id="loa_date" type="date" class="form-control"
                                               value="{{$reia->loa_date??''}}">
                                    </div>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Bidder Name <span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                      
                                        <select class="form-control" id="bidder_id" name="bidder_id">
                                        <option value="">Select Bidders</option>
                                        @foreach($bidders as $bidder)
                                        <option value="{{$bidder->id}}">{{$bidder->bidder_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                 <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label  class="pb-2"for="name"><strong>Bidder Capacity ( MW )<span class="text-danger">*</span></strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Bidder Capacity ( MW )" name="bidder_capacity"  id="bidder_capacity" type="text" class="form-control" value="{{$reia->bidder_capacity??''}}" >
                                    </div>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Date of PPA <span class="text-danger">*</span>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Date of Notice inviting Tender" name="ppa_date"  id="ppa_date" type="date" class="form-control" >
                                    </div>
                                </div><!-- comment -->
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>PPA Capacity ( MW )<span class="text-danger">*</span>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Date of Notice inviting Tender ( MW )" name="ppa_capacity"  id="ppa_capacity" type="text" class="form-control" value="{{$reia->ppa_capacity??''}}" >
                                    </div>
                                </div><!-- comment -->
                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>SCoD <span class="text-danger">*</span>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Date of Notice inviting Tender" name="scod"
                                               id="scod" type="date" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                    <label class="pb-2" for="name"><strong>Present Status 
                                        </strong></label>
                                    <div style="position: relative;">
                                    <textarea type="text" placeholder="Present Status" name="status"
                                               id="status" type="textarea" class="form-control" value=""></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-xxl-12 text-center pt-3 pb-3">
                                <input type="submit" id="submit" name="save" class="mt-1 btn btn-success" value="Save as draft">
                                <input type="submit" id="submit" name="submit" class="mt-1 btn btn-success" value="Submit">
                                  
                                </div>
                               </div>
                            </div>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
@endsection
@section('scripts')

@push('backend-js')
<!-- <script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script> -->
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
@endpush
@endsection
@section('styles')
<style>
    label.error {
        bottom: initial;
        right: 0px;
        top: 35px;
    }
    .row.progress_report_form {
    background: #f7f7f7;
    border: 1px solid #dedede;
    padding-top: 20px;
    padding-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px #0000001f;
}
</style>
@endsection