@extends('layouts.masters.backend')
@section('content')
@section('title', 'Medium Biogas Interest Form')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/BiogasAbove10KW/';
@endphp
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
            <li class="breadcrumb-item active">Form</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="row">
        <form id="consumerInterestForm" action="{{URL::to(Auth::getDefaultDriver().'/mediumBiogasPlantsAbove10KW')}}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <h4 class="pb-3">Proposal for Medium Biogas Plants ( Above 25 M^3 to 25 M3) - Above 10 KW</h2>

                <div class="col-lg-12 form_main_stng">
                    <div class="row form_cmn_stng">
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Beneficiary name
                                    <span class="error">*</span></label>

                                <input type="text" class="form-control required" name="beneficiary_name"
                                    value="{{Auth::user()->name}}">
                                <span class="text-danger">{{ $errors->first('beneficiary_name') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Beneficiary Address
                                    <span class="error">*</span></label>

                                <textarea class="form-control" name="beneficiary_address" cols="30" rows="1"
                                    placeholder="Address Write here..."
                                    value="{{$consumer['beneficiary_address'] ?? ''}}">{{$consumer['beneficiary_address'] ?? ''}}</textarea>
                                <span class="text-danger">{{ $errors->first('beneficiary_address') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">GPS of Plant site
                                    <span class="error">*</span></label>

                                <input type="text" class="form-control required" name="gps"
                                    value="{{$consumer['gps'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('gps') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Contact Number of Plant site
                                    <span class="error">*</span></label>

                                <input type="number" class="form-control required" name="contact_number"
                                    value="{{$consumer['contact_number'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="form-group pb-4">
                                <label for="name">Name of address of the State Agency/BDTC who propose to undertake the
                                    work
                                    <span class="">*</span></label>

                                <textarea class="form-control" name="state_agency_name" cols="25" rows="2"
                                    placeholder="Address Write here..."
                                    value="{{$consumer['state_agency_name'] ?? ''}}">{{$consumer['state_agency_name'] ?? ''}}</textarea>
                                <span class="text-danger">{{ $errors->first('state_agency_name') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Select Category
                                    <span class="error">*</span></label>

                                <select class="form-control  required" id="" name="category">
                                    <option value="">Select Category</option>
                                    <option value="A" @if(($consumer->category ?? '') ==
                                        'A') selected
                                        @endif> General/SC/ST/Others</option>
                                    <option value="B" @if(($consumer->category ?? '') == 'B') selected
                                        @endif> Private</option>
                                    <option value="C" @if(($consumer->category ?? '') == 'C')
                                        selected
                                        @endif> Government</option>
                                    <option value="D" @if(($consumer->category ?? '') ==
                                        'D') selected
                                        @endif> Public Organization</option>
                                    <option value="Others"> Others</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            </div>
                        </div>


                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip"
                                title="Proposed use of generated power with detailed configuration ">
                                <label for="name" class="ellipse">Proposed use of generated power...
                                    <span class="error">*</span> <i class="fa-solid fa-circle-info"></i></label>
                                <input type="text" class="form-control required" name="generated_power"
                                    value="{{$consumer['generated_power'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('generated_power') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip"
                                title="Mode of use and total requirement of power (kWh/day)/total requirements of biogas (cu.m.per day)">
                                <label for="name" class="ellipse">Mode of use and total req...
                                    <span class="error">*</span> <i class="fa-solid fa-circle-info"></i></label>
                                <input type="number" step="any" class="form-control required" name="required_biogas"
                                    value="{{$consumer['required_biogas'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('required_biogas') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Proposed size of Biogas plant (m3)
                                    <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="plant_size"
                                    value="{{$consumer['plant_size'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('plant_size') }}</span>
                            </div>
                        </div>

                        <div class="col-xxl-12">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="name">Available population of cattle
                                        <span class="error">*</span></label>
                                </div>
                                <div class="col-md-12 inner_table_form mb-3 mt-2">
                                    <div class="row">
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                            <label for="name">Number of Adults
                                                <span class="error">*</span></label>
                                            <input type="text" class="form-control required" name="cattles[adults]"
                                                placeholder=" Number of Adults"
                                                value="{{$consumer['cattles']['adults'] ?? ''}}">

                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                            <label for="name">Number of cattles smaller than 5 yrs
                                                <span class="error">*</span></label>
                                            <input type="text" class="form-control required" name="cattles[small]"
                                                placeholder="  Number of cattles smaller than 5 yrs"
                                                value="{{$consumer['cattles']['small']?? ''}}">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                            <label for="name">Total number of dung in kg
                                                <span class="error">*</span></label>
                                            <input type="text" class="form-control required" name="cattles[dug_in_kg]"
                                                placeholder=" Total number of dung in kg"
                                                value="{{$consumer['cattles']['dug_in_kg'] ?? ''}}">
                                            <span class="text-danger"></span>

                                        </div>
                                        <div class="col-md-12">
                                            @error('cattles.*')
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

                                <label for="name">Any other source of waste like goats, pigs, poultry dairy effluent ,
                                    food
                                    &amp;
                                    kitchen , Agro/ Food processing waste etc.
                                    <span class="error">*</span></label>
                            </div>
                            <div class="col-md-12 inner_table_form mb-3 mt-2">
                                <div class="row">
                                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                        <label for="name">Number of animals/birds
                                            <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="other_sources[animals]"
                                            placeholder=" Number of animals/birds"
                                            value="{{$consumer['other_sources']['animals'] ?? ''}}">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                                        <label for="name">Total number of dropping in kg
                                            <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="other_sources[dropping]"
                                            placeholder=" Total number of dropping in kg"
                                            value="{{$consumer['other_sources']['dropping'] ?? ''}}">
                                        <span class="text-danger"></span>
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
                            <div class="form-group">
                                <div class="col-md-12">

                                    <label for="">Agricultural waste (in kg)</label>
                                    <input type="number" class="form-control required" name="agricultural_waste"
                                        placeholder="waste" value="{{$consumer['agricultural_waste'] ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('agricultural_waste') }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip"
                                title="Please upload file consisting of details of each raw material.  Only PDF format is accepted.">
                                <label for="">Other degradable biomass (in kg) <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input class="form-control" type="file" id="formFile" name="raw_material_file"
                                    value="{{$consumer['raw_material_file'] ?? ''}}">
                                @if(isset($consumer['raw_material_file']) &&
                                $consumer['raw_material_file']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['raw_material_file'])}}" style='float: right;
                                           '>View File</a>
                                @endif
                                <span class="text-danger">{{ $errors->first('raw_material_file') }}</span>
                                <!-- <input type="file" name="" id="" class="form-control"> -->
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Number of latrine attached</label>
                                <input type="number" class="form-control required" name="latrine_attached_no"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['latrine_attached_no'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('latrine_attached_no') }}</span>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Number of users</label>
                                <input type="number" class="form-control required" name="users_no"
                                    placeholder=" Total number of users" value="{{$consumer['users_no'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('users_no') }}</span>
                            </div>
                        </div>


                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Availability of land for proposed biogas plant and housing
              generator">
                                <label for="" class="ellipse">Availability of land for proposed bio... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input type="number" class="form-control required" name="land_for_plant"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['land_for_plant'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('land_for_plant') }}</span>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Name of proposed power generating system, Mechanism for manufacturers
              and operation &amp; Maintenance of the system suppliers to be given. Only PDF format is accepted.">
                                <label for="">Upload Procurement and commissioning details... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input class="form-control" type="file" id="formFile"
                                    name="commissioning_procurement_detail"
                                    value="{{$consumer['commissioning_procurement_detail'] ?? ''}}">
                                @if(isset($consumer['commissioning_procurement_detail']) &&
                                $consumer['commissioning_procurement_detail']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['commissioning_procurement_detail'])}}"
                                    style='float: right;'>View File</a>
                                @endif
                                <span
                                    class="text-danger">{{ $errors->first('commissioning_procurement_detail') }}</span>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Estimated quantum of power to be generated through biogas plant,
              keeping in view the minimum 10 hours daily operation of the proposed power plant
              entirely based on Biogas generation">
                                <label for="" class="ellipse">Estimated quantum of power to be... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input type="number" step="any" class="form-control required" name="quantum_power"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['quantum_power'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('quantum_power') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="" class="ellipse" value="" data-bs-toggle="tooltip"
                                    title="Proposed electrical load distribution with biogas power plant">Proposed
                                    electrical load
                                    distribut... <i class="fa-solid fa-circle-info"></i> </label>
                                <input class="form-control" type="file" id="formFile" name="power_documents"
                                    value="{{$consumer['power_documents'] ?? ''}}" data-bs-toggle="tooltip" title="Upload domestic, village industry, irrigation/agriculture,
                entire
                power to be used for self/ balanced surplus power/ biogas to be sold
                locally. Only PDF format is accepted.">
                                @if(isset($consumer['power_documents']) &&
                                $consumer['power_documents']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['power_documents'])}}" style='float: right;
                                          '>View File</a>
                                @endif
                                <span class="text-danger">{{ $errors->first('power_documents') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Types of engine proposed for power generation </label>
                                <input type="text" class="form-control required" name="engine_type"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['engine_type'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('engine_type') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="apacity of engine/dual fuel (used with bio fuel only)/Biogas
              micro
              turbines etc. (in kVA)">
                                <label for="" class="ellipse">Capacity of engine/dual fuel (use... <i
                                        class="fa-solid fa-circle-info"></i> </label>
                                <input type="number" step="any" class="form-control required" name="engine_capacity"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['engine_capacity'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('engine_capacity') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Upload cost of 100% biogas engine or dual fuel engine, coupled
              with
              Genset, associated Central panel and power room etc and cost of internal
              transmission system used for electrification. Only PDF format is accepted.">
                                <label for=""><span class="error">cost of biogas engine or dual fuel engine <i
                                            class="fa-solid fa-circle-info"></i>
                                    </span></label>
                                <input class="form-control" type="file" id="formFile" name="biogas_engine_file"
                                    value="{{$consumer['biogas_engine_file'] ?? ''}}">
                                @if(isset($consumer['biogas_engine_file']) &&
                                $consumer['biogas_engine_file']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['biogas_engine_file'])}}" style='float: right;
                                           '>View File</a>
                                @endif
                                <span class="text-danger">{{ $errors->first('biogas_engine_file') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Cost of proposed biogas plant (in Rs):</label>
                                <input type="number" step="any" class="form-control required" name="plant_cost"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['plant_cost'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('plant_cost') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Manure Management and Handling system including safe and neat
              disposal
              for sale of Bio-manure">
                                <label for="" class="ellipse">Manure Management and Handling... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input type="text" class="form-control required" name="manure_management"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['manure_management'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('manure_management') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Approximate cost of electricity may be generated through
              Biogas (kWh/
              day)">
                                <label for="" class="ellipse">Approximate cost of electricity may... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input type="number" class="form-control required" name="electricity_cost"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['electricity_cost'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('electricity_cost') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip"
                                title="Upload details of own funds, bank loan, central finance assistance and total cost. Only PDF format is accepted.">
                                <label for="" class="ellipse">Upload funding of projects <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input class="form-control" type="file" id="formFile" name="project_funding"
                                    value="{{$consumer['project_funding'] ?? ''}}">
                                @if(isset($consumer['project_funding']) && $consumer['project_funding']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['project_funding'])}}"
                                    style='float: right;'>View
                                    File</a>
                                @endif
                                <span class="text-danger">{{ $errors->first('project_funding') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="Source of funds for meeting operation and maintenance cost of
              system">
                                <label for="" class="ellipse">Source of funds for meeting opera... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input type="number" class="form-control required" name="maintenance_funds"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['maintenance_funds'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('maintenance_funds') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip" title="An undertaking to this effect from agency for procurement
              installation, operation and maintenance of the system on regular basis. Only PDF format is accepted.">
                                <label for="">Undertaking from State Nodal
                                    Deptt/Agencies/B... <i class="fa-solid fa-circle-info"></i></label>
                                <input class="form-control" type="file" id="formFile" name="undertaking_nodal_ajency"
                                    value="{{$consumer['undertaking_nodal_ajency'] ?? ''}}">
                                @if(isset($consumer['undertaking_nodal_ajency']) &&
                                $consumer['undertaking_nodal_ajency']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['undertaking_nodal_ajency'])}}"
                                    style='float: right; '>View File</a>
                                @endif
                                <span class="text-danger">{{ $errors->first('undertaking_nodal_ajency') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip"
                                title="Mechanism to transfer the power plant to user / panchayat/ Society/ Entrepreneur etc. by SNA/SND/BDTC after specific period if applicable for the project proposal">
                                <label for="">Mechanism to transfer the power plant to user <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input type="text" class="form-control required" name="mechanism_to_transfer"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['mechanism_to_transfer'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('mechanism_to_transfer') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Any other information regarding the project</label>
                                <input type="text" class="form-control required" name="project_information"
                                    placeholder=" Total number of dropping in kg"
                                    value="{{$consumer['project_information'] ?? ''}}">
                                <span class="text-danger">{{ $errors->first('project_information') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group" data-bs-toggle="tooltip"
                                title="Upload Undertaking on Non- Judical Stamp/e -Stamp paper">
                                <label for="">Upload Undertaking on Non- Judical... <i
                                        class="fa-solid fa-circle-info"></i></label>
                                <input class="form-control" type="file" id="formFile" name="undertaking"
                                    value="{{$consumer['undertaking'] ?? ''}}">
                                @if(isset($consumer['undertaking']) && $consumer['undertaking']!='')
                                <a href="{{URL::to($docBaseUrl.$consumer['undertaking'])}}"
                                    style='float: right;'>Download
                                    Sample File</a>
                                @endif

                                <span class="text-danger">{{ $errors->first('undertaking') }}</span>
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <input type="checkbox" id="" name="authorize" value="1" @if(($consumer->authorize ?? '')
                            ==1)checked @endif>
                            <label for="vehicle1"> I authorize that entered information in proposal are
                                correct and verified</label> <br>
                            <span class="text-danger">{{ $errors->first('authorize') }}</span>
                        </div>


                        <div class="col-xxl-12 text-center pt-3 pb-3">
                            <input type="submit" name="submit" value="save" class="btn btn-success btn-lg" id="">
                            <input type="hidden" name="editId" value="{{$consumer->id ?? 0}}">
                            @if(($consumer['final_submission'] ?? '') == '0')
                            <input type="submit"
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

<style>
.col-md-4 {
    display: inline-block;
}
</style>
@include('modals.consumerInstallerAssociation')
@endsection
<!-- @section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>
@endsection -->