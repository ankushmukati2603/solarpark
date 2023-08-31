@extends('layouts.masters.backend')
@section('content')
@section('title', 'Consumer Interest Form')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/BioDocument/';
@endphp
<div class="container-fluid" style="width: 90%">
    <div class="row">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Proposal for Medium Biogas Plants ( Upto 4 class="pb-3"5 M^3 to
                        25 M3) - Upto 10 KW</li>
                </ol>
            </nav>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <section class="section dashboard">
            <div class="row">
                <form id="consumerInterestForm" action="{{URL::to(Auth::getDefaultDriver().'/mediumBiogasPlants')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="pb-3">Proposal for Medium Biogas Plants ( Upto 4 class="pb-3"5 M^3 to 25 M3) - Upto 10 KW
                        </h2>
                        <div class="col-lg-12 form_main_stng">
                            <div class="row form_cmn_stng">
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Name of Project executing organisation/agency (If other than SNA/SND/BDTC/KVIC)">
                                        <label for="name" class="ellipse">Name of state Govt. Nodal Deptt. / Nodal
                                            Agency..
                                            <span class="error">*</span> <i class="fa-solid fa-circle-info"></i>
                                        </label>

                                        <input type="text" class="form-control required" name="organization_name"
                                            value="{{$consumer['organization_name'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('organization_name') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Address of Project executing organisation/agency (If other than SNA/SND/BDTC/KVIC)">
                                        <label for="name" class="ellipse">Address of state Govt. Nodal Deptt./Nodal
                                            Agency....
                                            <span class="error">*</span> <i class="fa-solid fa-circle-info"></i>
                                        </label>

                                        <textarea class="form-control" name="organization_address" cols="30" rows="1"
                                            placeholder="Address Write here..."
                                            value="{{$consumer['organization_address'] ?? ''}}">{{$consumer['organization_address'] ?? ''}}</textarea>
                                        <span class="text-danger">{{ $errors->first('organization_address') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Name of Project executing organisation/agency (If other than SNA/SND/BDTC/KVIC)">
                                        <label for="name" class="ellipse">Name of Project executing org
                                            <span class="error">*</span> <i class="fa-solid fa-circle-info"></i>
                                        </label>

                                        <input type="text" class="form-control required" name="project_name"
                                            value="{{$consumer['project_name'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('project_name') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Address of Project executing organisation/agency (If other than SNA/SND/BDTC/KVIC)">
                                        <label for="name" class="ellipse">Address of Project executing org
                                            <span class="error">*</span> <i class="fa-solid fa-circle-info"></i>
                                        </label>

                                        <textarea class="form-control" name="project_address" cols="30" rows="1"
                                            placeholder="Address Write here..."
                                            value="{{$consumer['project_address'] ?? ''}}">{{$consumer['project_address'] ?? ''}}</textarea>
                                        <span class="text-danger">{{ $errors->first('project_address') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-12">
                                    <div class="form-group pb-4">
                                        <label for="name">Details of site indicating location and address with expected
                                            load
                                            and use of electricity or biogas for thermal applications
                                            <span class="">*</span></label>

                                        <textarea class="form-control" name="applications_details" cols="25" rows="2"
                                            placeholder="Details Write here..."
                                            value="{{$consumer['applications_details'] ?? ''}}">{{$consumer['applications_details'] ?? ''}}</textarea>
                                        <span class="text-danger">{{ $errors->first('applications_details') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Proposed use of generated power with detailed configuration ">
                                        <label for="name" class="ellipse">Capacity of biogas plant (cubic meter per
                                            day/per
                                            hour)
                                            <span class="error">*</span> <i class="fa-solid fa-circle-info"></i></label>
                                        <input type="number" class="form-control required" name="capacity"
                                            value="{{$consumer['capacity'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('capacity') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-12">

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="name">Mention Details of cattles
                                                <span class="error">*</span></label>
                                        </div>
                                        <div class="col-md-12 inner_table_form mb-3 mt-2">
                                            <div class="row">
                                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">

                                                    <input type="text" class="form-control required"
                                                        name="cattles_details[no_adult]" placeholder="  2"
                                                        value="{{$consumer['cattles_details']['no_adult'] ?? '0'}}">
                                                    <span class="text-danger"></span>
                                                </div>


                                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">

                                                    <input type="text" class="form-control required"
                                                        name="cattles_details[age]" placeholder=" 1"
                                                        value="{{$consumer['cattles_details']['age'] ?? '0'}}">
                                                    <span class="text-danger"></span>
                                                </div>

                                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">

                                                    <input type="text" class="form-control required"
                                                        name="cattles_details[weight]" placeholder=" 3"
                                                        value="{{$consumer['cattles_details']['weight'] ?? '0'}}">
                                                </div>
                                                <div class="col-md-12">
                                                    @error('cattles_details.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <!-- <span class="text-danger"></span> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">

                                        <label for="name">Any other source of waste like goats, pigs, poultry dairy
                                            effluent
                                            , food &amp; kitchen , Agro/ Food processing waste etc.
                                            <span class="error">*</span></label>
                                    </div>
                                    <div class="col-md-12 inner_table_form mb-3 mt-2">
                                        <div class="row">
                                            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">

                                                <input type="text" class="form-control required"
                                                    name="other_sources[No_animals]" placeholder=" 10"
                                                    value="{{$consumer['other_sources']['No_animals'] ?? '0'}}">
                                            </div>
                                            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">

                                                <input type="text" class="form-control required"
                                                    name="other_sources[weight]" placeholder=" 20"
                                                    value="{{$consumer['other_sources']['weight'] ?? '0'}}">
                                            </div>
                                            <div class="col-md-12">
                                                @error('other_sources.*')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Name of manufacturer/supplier and cost of 100% biogas engines, Dg-Genset and associated control panel etc">
                                        <label for="" class="ellipse">Name of manufacturer/supplier... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input type="text" class="form-control required" name="manufacturer_name"
                                            placeholder=" Name of manufacturer/supplier"
                                            value="{{$consumer['manufacturer_name'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('manufacturer_name') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Required daily demand/ power in KWh/day ">
                                        <label for="" class="ellipse">Required daily demand/ powe... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input type="number" step="any" class="form-control required"
                                            name="required_daily_power"
                                            placeholder=" Required daily demand/ power in KWh/day "
                                            value="{{$consumer['required_daily_power'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('required_daily_power') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Required amount of biogas generation daily (in cubic metre) including cooking/heating /cooling etc (Kcal requirement per day for thermal energy applications) ">
                                        <label for="" class="ellipse">Required amount of biogas gene... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input type="number" class="form-control required" name="biogas_generation"
                                            placeholder=" 76" value="{{$consumer['biogas_generation'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('biogas_generation') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="No. of Biogas plants units with capacity of each cubic metre proposed ">
                                        <label for="" class="ellipse">No. of Biogas plants units with cap...<i
                                                class="fa-solid fa-circle-info"></i> </label>
                                        <input type="number" step="any" class="form-control required"
                                            name="no_of_plants" placeholder=" 76"
                                            value="{{$consumer['no_of_plants'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('no_of_plants') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Estimated actual cost worked out by concerned user agency / manufacturer and verified by concerened SND / SNA / KVIC / BDTC etc">
                                        <label for="" class="ellipse">Estimated actual cost worked... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input type="number" class="form-control required" name="actual_cost"
                                            placeholder=" 55" value="{{$consumer['actual_cost'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('actual_cost') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Proposed operational hours per day entirely based on Biogas (100 % biogas utilization basis) ">
                                        <label for="" class="ellipse">Proposed operational hours per... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input type="number" step="any" class="form-control required"
                                            name="operational_hours" placeholder=" 55 "
                                            value="{{$consumer['operational_hours'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('operational_hours') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Total estimated project cost (in Rs.) ">
                                        <label for="" class="ellipse">Total estimated project cost... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input type="number" class="form-control required" name="project_cost"
                                            placeholder=" 76" value="{{$consumer['project_cost'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('project_cost') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Amount of CFA worked out as per the approved rates and norms of scheme of BPGTP (in Rs.)  ">
                                        <label for="" class="ellipse">No. of Biogas plants units with cap...<i
                                                class="fa-solid fa-circle-info"></i> </label>
                                        <input type="number" step="any" class="form-control required"
                                            name="amount_of_cfa" placeholder=" 76"
                                            value="{{$consumer['amount_of_cfa'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('amount_of_cfa') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="form-group" data-bs-toggle="tooltip"
                                        title="Upload Undertaking on Non- Judical Stamp/e -Stamp paper only specified format is allowed in PDF">
                                        <label for="">Upload Undertaking on Non- Judical... <i
                                                class="fa-solid fa-circle-info"></i></label>
                                        <input class="form-control" type="file" id="formFile" name="undertaking"
                                            value="{{$consumer['undertaking'] ?? ''}}">
                                        @if(isset($consumer['undertaking']) && $consumer['undertaking']!='')
                                        <a href="{{URL::to($docBaseUrl.$consumer['undertaking'])}}">View File</a>
                                        @endif
                                        <span class="text-danger">{{ $errors->first('undertaking') }}</span>
                                    </div>
                                </div>
                                <div class="col-xxl-12">
                                    <input type="checkbox" id="" name="authorized" value="1" @if(($consumer->authorized
                                    ?? '') ==1)checked @endif>
                                    <label for="vehicle1"> I authorize that entered information in proposal are
                                        correct and verified</label> <br>
                                    <span class="text-danger">{{ $errors->first('authorized') }}</span>
                                </div>


                                <div class="col-xxl-12 text-center pt-3 pb-3">
                                    <input type="submit" name="save" value="save" class="btn btn-success" id="">
                                    <input type="hidden" name="editId" value="{{$consumer->id ?? 0}}">
                                    @if(($consumer['final_submission'] ?? '') == '0')
                                    <input type="submit" {{$editable ?? ''}}
                                        class="mt-1 btn btn-success @if($consumer['final_submission']=='0') @else hidden  @endif"
                                        value="Final Submission" name="final_submission"
                                        onclick="if (confirm('Are You Sure ? Once You Submit Your Application, You Will Not Update it Latter')) {}else{return false;}">
                                    @endif
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </section>
    </div>
</div>


@include('modals.consumerInstallerAssociation')
@endsection
<!-- @section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>
@endsection -->