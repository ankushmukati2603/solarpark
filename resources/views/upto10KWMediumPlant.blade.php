@extends('layouts.masters.home')
@section('content')
@section('title', 'Consumer Interest Form')
<div class="container-fluid" style="width: 90%">
    <div class="row">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="col-md-12">
            <div class="frontPagesBox">
                <div class="box box-primary">
                    <form id="consumerInterestForm" action="{{URL::to('mediumBiogasPlants')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="box-header with-border text-right">
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-center"> Proposal for Medium Biogas Plants ( Above 25 M^3
                                        to 25 M^3) - Upto 10 KW</h3>
                                </div><br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Name of state Govt. Nodal Deptt. / Nodal Agency / BDTC/ KVIC other  Approved Organization') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="organization_name" value="{{$consumer['organization_name'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('organization_name') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Address of state Govt. Nodal Deptt./Nodal Agency/BDTC/ KVIC other Approved Organization') }}
                                            <span class="error">*</span></label>

                                        <textarea class="form-control" {{$editable ?? ''}} name="organization_address"
                                            cols="30" rows="2"
                                            placeholder="Address Write here...">{{$consumer['organization_address'] ?? ''}}</textarea>
                                        <span class="text-danger">{{ $errors->first('organization_address') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Name of project executing organization/agency (if other than SNA/SND./BDTC/ KVIC)') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="project_name" value="{{$consumer['project_name'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('project_name') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Address of project executing organization/agency (if other than SNA/SND./BDTC/ KVIC)') }}
                                            <span class="error">*</span></label>

                                        <textarea class="form-control" {{$editable ?? ''}} name="project_address"
                                            cols="30" rows="2"
                                            placeholder="Address Write here...">{{$consumer['project_address'] ?? ''}}</textarea>
                                        <span class="text-danger">{{ $errors->first('project_address') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Details of site indicating location and address with expected load and use of electricity or biogas for thermal applications') }}
                                            <span class="error">*</span></label>

                                        <textarea class="form-control" {{$editable ?? ''}} name="applications_details"
                                            cols="30" rows="2"
                                            placeholder="Address Write here...">{{$consumer['applications_details'] ?? ''}}</textarea>
                                        <span class="text-danger">{{ $errors->first('applications_details') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Capacity of biogas plant (cubic meter per day/per hour)') }}
                                            <span class="error">*</span></label>

                                        <input type="text" class="form-control required" name="capacity"
                                            value="{{$consumer['capacity'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('capacity') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">

                                        <label for="name">Mention details of cattles
                                            <span class="error">*</span></label>
                                    </div>
                                    <div class="col-md-4">


                                        <input type="text" class="form-control required"
                                            name="cattles_details[no_adult]" placeholder=" Number of Adults" value="">
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control required" name="cattles_details[age]"
                                            placeholder="  Number of cattles smaller than 5 yrs" value="">

                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control required" name="cattles_details[weight]"
                                            placeholder=" Total number of dung in kg" value="">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('name') }}</span>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">

                                        <label
                                            for="name">{{ __('Any other source of waste (goats, pigs, poultry diary effluent, food, kitchen, Agro/ Food processing waste etc.)') }}
                                            <span class="error">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control required"
                                            name="other_sources[No_animals]" placeholder=" Number of animals/birds"
                                            value="">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control required" name="other_sources[weight]"
                                            placeholder=" Total number of dropping in kg" value="">

                                    </div>

                                    <span class="text-danger">{{ $errors->first('other_sources') }}</span>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Name of manufacturer/supplier and cost of 100% biogas engines, DG-Genset and associated control panel etc') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="manufacturer_name" value="{{$consumer['manufacturer_name'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('manufacturer_name') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="name">{{ __('Required daily demand /power in KWh/day') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="required_daily_power"
                                            value="{{$consumer['required_daily_power'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('required_daily_power') }}</span>

                                    </div>
                                </div>
                                <div style="clear:both"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Required amount of biogas generation daily( in cubic metre) including cooking/ heating/cooling etc.(Kcal requirement per day for thermal energy applications)') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="biogas_generation" value="{{$consumer['biogas_generation'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('biogas_generation') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><br>
                                        <label
                                            for="name">{{ __('No. of biogas plants units with capacity of each cubic metre proposed') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="no_of_plants" value="{{$consumer['no_of_plants'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('no_of_plants') }}</span>

                                    </div>
                                </div>
                                <div style="clear:both"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Estimated actual cost worked out by concerned user agency /manufacturer and verified by concerned SND / SNA / KVIC /BDTC etc') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="actual_cost" value="{{$consumer['actual_cost'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('actual_cost') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><br>
                                        <label
                                            for="name">{{ __('Proposed operational hours per day entirely based on Biogas (100% biogas utilization basis)') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="operational_hours" value="{{$consumer['operational_hours'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('operational_hours') }}</span>

                                    </div>
                                </div>
                                <div style="clear:both"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Total estimated project cost (in Rs.)') }}
                                            <span class="error">*</span></label>

                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="project_cost" value="{{$consumer['project_cost'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('project_cost') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __('Amount of CFA  worked out as per the approved rates and norms of scheme of BPGTP (in Rs.)') }}
                                            <span class="error">*</span></label>

                                        <input type="text" class="form-control required" name="amount_of_cfa"
                                            value="{{$consumer['projecamount_of_cfat_cost'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('amount_of_cfa') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <label for=""> Upload Undertaking on Non- Judical Stamp/e - Stamp
                                            paper</label>(<span class="text-primary">Only specified format is allowed in
                                            PDF</span>)

                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" id="formFile" name="undertaking">
                                        <a href="" style='float: right;
                                           margin-top: -8px;'>Download Sample File</a>
                                        <span class="text-danger">{{ $errors->first('undertaking') }}</span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="checkbox" id="" name="authorized" value="1">
                                    <label for="vehicle1"> I authorize that entered information in proposal are
                                        correct and verified</label> <br>
                                    <span class="text-danger">{{ $errors->first('authorized') }}</span>
                                </div>


                                <div class="card-title text-center">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit" value="save" class="btn btn-success" id="">
                                        <a href="" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>




                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@include('modals.consumerInstallerAssociation')
@endsection
<!-- @section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>
@endsection -->