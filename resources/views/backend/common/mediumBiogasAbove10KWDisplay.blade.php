@extends('layouts.masters.backend')
@section('content')
@section('title', ' Proposal for Medium Biogas Plants ( Above 25 M^3 to 25 M3) - Above 10 KW')
<div class="col-md-12">
      @include('layouts.partials.backend._flash')
    <div class="frontPagesBox">
        <div class="box box-primary">
              <form action="{{url('mnre/medium/above/add-remarks')}}" method="post">
                <input type="hidden" name="medium_above_plant_id" value="{{$consumer['id']}}">
                @csrf
                <div class="box-header with-border text-right">
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td width="65%">Beneficiary name </td>
                            <th width="35%">{{$consumer['beneficiary_name'] ?? ''}}

<span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="beneficiary_name" value="Please enter correct information for beneficiary name"> @elseif($consumer_log && $consumer_log->beneficiary_name==1)<input type="checkbox" checked name="beneficiary_name" value="Please enter correct information for beneficiary name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>

                            </th>
                        <tr>
                            <td>Beneficiary Address</td>
                            <th>{{$consumer['beneficiary_address'] ?? ''}}
                                <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="beneficiary_address" value="Please enter correct information for beneficiary address"> @elseif($consumer_log && $consumer_log->beneficiary_address==1)<input type="checkbox" checked name="beneficiary_address" value="Please enter correct information for beneficiary address"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                 @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        </tr>
                        <tr>
                            <td>GPS of Plant site </td>
                            <th>{{$consumer['gps'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="gps" value="Please enter correct information for gps"> @elseif($consumer_log && $consumer_log->gps==1)<input type="checkbox" checked name="gps" value="Please enter correct information for gps"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Contact Number of Plant site</td>
                            <th>{{$consumer['contact_number'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="contact_number" value="Please enter correct contact number"> @elseif($consumer_log && $consumer_log->contact_number==1)<input type="checkbox" checked name="contact_number" value="Please enter correct contact number"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Name of address of the State Agency/BDTC who propose to undertake the work
                            </td>
                            <th>{{$consumer['state_agency_name'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="state_agency_name" value="Please enter correct information for state agency name"> @elseif($consumer_log && $consumer_log->state_agency_name==1)<input type="checkbox" checked name="state_agency_name" value="Please enter correct information for state agency name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <th>
                                @if($consumer['category'] == 'A')
                                <span>General/SC/ST/Others</span>
                                @elseif($consumer['category'] == 'B')
                                <span>Private</span>
                                @elseif($consumer['category'] == 'C')
                                <span>Government</span>
                                @else
                                <span>Others</span>
                                @endif
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="category" value="Please enter correct category"> @elseif($consumer_log && $consumer_log->category==1)<input type="checkbox" checked name="category" value="Please enter correct category"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                  @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Proposed use of generated power with detailed configuration</td>
                            <th>{{$consumer['generated_power'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="generated_power" value="Please enter correct information for generated power"> @elseif($consumer_log && $consumer_log->generated_power==1)<input type="checkbox" checked name="generated_power" value="Please enter correct information for generated power"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Mode of use and total requirement of power (kWh/day)/total requirements of
                                biogas (cu.m.per day)</td>
                            <th>{{$consumer['required_biogas'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="required_biogas" value="Please enter correct information for required biogas"> @elseif($consumer_log && $consumer_log->required_biogas==1)<input type="checkbox" checked name="required_biogas" value="Please enter correct information for required biogas"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Proposed size of Biogas plant (m3)</td>
                            <th>{{$consumer['plant_size'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="plant_size" value="Please enter correct plant size"> @elseif($consumer_log && $consumer_log->plant_size==1)<input type="checkbox" checked name="plant_size" value="Please enter correct plant size"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Available population of cattle</td>
                            <th>Adult :{{$consumer['cattles']['adults']}}<br>
                                Small :{{$consumer['cattles']['small']}}<br>
                                Dug in Kg :{{$consumer['cattles']['dug_in_kg']}}
                            </th>
                        </tr>
                        <tr>
                            <td>Any other source of waste like goats, pigs, poultry dairy effluent , food & kitchen ,
                                Agro/ Food processing waste etc</td>
                            <th>Animals: {{$consumer['other_sources']['animals'] ?? ''}}<br>
                                Dropping: {{$consumer['other_sources']['dropping'] ?? ''}}
                            </th>
                        </tr>
                        <tr>
                            <td>Contact Number of Plant site</td>
                            <th>{{$consumer['contact_number'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="contact_number" value="Please enter correct contact number"> @elseif($consumer_log && $consumer_log->contact_number==1)<input type="checkbox" checked name="contact_number" value="Please enter correct contact number"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                              @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Agricultural waste (in kg)</td>
                            <th>{{$consumer['agricultural_waste'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="agricultural_waste" value="Please enter correct agricultural waste"> @elseif($consumer_log && $consumer_log->agricultural_waste==1)<input type="checkbox" checked name="agricultural_waste" value="Please enter correct agricultural waste"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Other degradable biomass (in kg)</td>
                            <th><a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['raw_material_file'])}}">View</a>
                                     <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="raw_material_file" value="Please enter correct raw material file"> @elseif($consumer_log && $consumer_log->raw_material_file==1)<input type="checkbox" checked name="raw_material_file" value="Please enter correct  raw material file"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                     @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                               
                            </th>
                        </tr>
                        <tr>
                            <td>Number of latrine attached</td>
                            <th>{{$consumer['latrine_attached_no'] ?? ''}}
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="latrine_attached_no" value="Please enter correct latrine attached no"> @elseif($consumer_log && $consumer_log->latrine_attached_no==1)<input type="checkbox" checked name="latrine_attached_no" value="Please enter correct latrine attached no"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                 @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Number of users</td>
                            <th>{{$consumer['users_no'] ?? ''}}
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="users_no" value="Please enter correct users no"> @elseif($consumer_log && $consumer_log->users_no==1)<input type="checkbox" checked name="users_no" value="Please enter correct users_no"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                 @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Availability of land for proposed biogas plant and housing
                                generator</td>
                            <th>{{$consumer['land_for_plant'] ?? ''}}
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="land for plant" value="Please enter correct information for land for plant"> @elseif($consumer_log && $consumer_log->land_for_plant==1)<input type="checkbox" checked name="land_for_plant" value="Please enter correct information for land for plant"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                 @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Procurement and commissioning details</td>
                            <th>
                                <a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['commissioning_procurement_detail'])}}">View</a>
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="commissioning_procurement_detail" value="Please enter correct information for Procurement and commissioning details"> @elseif($consumer_log && $consumer_log->commissioning_procurement_detail==1)<input type="checkbox" checked name="commissioning_procurement_detail" value="Please enter correct information for Procurement and commissioning details"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                 @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Estimated quantum of power to be generated through biogas plant,
                                keeping in view the minimum 10 hours daily operation of the proposed power plant
                                entirely based on Biogas generation</td>
                            <th>{{$consumer['quantum_power'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="quantum_power" value="Please enter correct information for quantum power"> @elseif($consumer_log && $consumer_log->quantum_power==1)<input type="checkbox" checked name="quantum_power" value="Please enter correct information for quantum power"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Proposed electrical load distribution with biogas power plant</td>
                            <th><a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['power_documents'])}}">View</a>
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="power_documents" value="Please upload correct information for power documents"> @elseif($consumer_log && $consumer_log->power_documents==1)<input type="checkbox" checked name="power_documents" value="Please upload correct information for power documents"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                 @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Types of engine proposed for power generation</td>
                            <th>{{$consumer['engine_type'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="engine_type" value="Please enter correct information for engine type"> @elseif($consumer_log && $consumer_log->engine_type==1)<input type="checkbox" checked name="engine_type" value="Please enter correct information for engine type"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Capacity of engine/dual fuel (used with bio fuel only)/Biogas micro
                                turbines etc. (in kVA)</td>
                            <th>{{$consumer['engine_capacity'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="engine_capacity" value="Please enter correct information for engine capacity"> @elseif($consumer_log && $consumer_log->engine_capacity==1)<input type="checkbox" checked name="engine_capacity" value="Please enter correct information for engine capacity"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>cost of biogas engine or dual fuel engine</td>
                            <th><a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['biogas_engine_file'])}}">View</a>
                                     <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="biogas_engine_file" value="Please upload correct information for biogas engine file"> @elseif($consumer_log && $consumer_log->biogas_engine_file==1)<input type="checkbox" checked name="biogas_engine_file" value="Please enter correct information for biogas engine file"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                     @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Cost of proposed biogas plant (in Rs)</td>
                            <th>{{$consumer['plant_cost'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="plant_cost" value="Please enter correct information for plant cost"> @elseif($consumer_log && $consumer_log->plant_cost==1)<input type="checkbox" checked name="plant_cost" value="Please enter correct information for plant cost"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Manure Management and Handling system including safe and neat disposal
                                for sale of Bio-manure</td>
                            <th>{{$consumer['manure_management'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="manure_management" value="Please enter correct information for manure management"> @elseif($consumer_log && $consumer_log->manure_management==1)<input type="checkbox" checked name="manure_management" value="Please enter correct information for manure management"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Approximate cost of electricity may be generated through Biogas (kWh/
                                day)</td>
                            <th>{{$consumer['electricity_cost'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="electricity_cost" value="Please enter correct information for electricity cost"> @elseif($consumer_log && $consumer_log->electricity_cost==1)<input type="checkbox" checked name="electricity_cost" value="Please enter correct information for electricity cost"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>funding of projects</td>
                            <th><a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['project_funding'])}}">View</a>
                                     <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="project_funding" value="Please enter correct information for project funding"> @elseif($consumer_log && $consumer_log->project_funding==1)<input type="checkbox" checked name="project_funding" value="Please enter correct information for project funding"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                     @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Source of funds for meeting operation and maintenance cost of
                                system</td>
                            <th>{{$consumer['maintenance_funds'] ?? ''}}
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="maintenance_funds" value="Please enter correct information for maintenance funds"> @elseif($consumer_log && $consumer_log->maintenance_funds==1)<input type="checkbox" checked name="maintenance_funds" value="Please enter correct information for maintenance funds"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                 @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Undertaking from State Nodal Deptt/Agencies/BDTC</td>
                            <th><a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['undertaking_nodal_ajency'])}}">View</a>
                                     <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="undertaking_nodal_ajency" value="Please enter correct information for undertaking nodal ajency"> @elseif($consumer_log && $consumer_log->undertaking_nodal_ajency==1)<input type="checkbox" checked name="undertaking_nodal_ajency" value="Please enter correct information for undertaking nodal ajency"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                     @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Mechanism to transfer the power plant to user / panchayat/ Society/
                                Entrepreneur etc. by SNA/SND/BDTC after specific period if applicable for the
                                project proposal</td>
                            <th>{{$consumer['mechanism_to_transfer'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="mechanism_to_transfer" value="Please enter correct information for mechanism to transfer"> @elseif($consumer_log && $consumer_log->mechanism_to_transfer==1)<input type="checkbox" checked name="mechanism_to_transfer" value="Please enter correct information for mechanism to transfer"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Any other information regarding the project</td>
                            <th>{{$consumer['project_information'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="project_information" value="Please enter correct information for project information"> @elseif($consumer_log && $consumer_log->project_information==1)<input type="checkbox" checked name="beneficiary_address" value="Please enter correct information for project information"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                             @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Undertaking on Non- Judical Stamp/e
                                -Stamp paper</td>
                            <th><a
                                    href="{{url('storage/documents/systems/BiogasAbove10KW/'.$consumer['undertaking'])}}">View</a>
                                     <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="undertaking" value="Please enter correct information for undertaking"> @elseif($consumer_log && $consumer_log->undertaking==1)<input type="checkbox" checked name="undertaking" value="Please enter correct information for undertaking"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                     @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                        <td>Status</td>
                        <th colspan="3">
                            @if($consumer->status==0 || $consumer->status==2)
                            <input type="radio" name="status" class="status" id="approved" @if($consumer->status==1) checked @endif value='1'> Verified
                            <input type="radio" style="margin-left: 30px;" name="status" class="status" id="partial_approved" @if($consumer->status==2) checked @endif value='2'> Send Back For Correction <span style="color:red;">(please do checkbox check for incorrect detail)</span>
                            <input type="radio" style="margin-left: 30px;" name="status" class="status" id="reject" @if($consumer->status==3) checked @endif  value='3'> Reject
                            @elseif($consumer->status==1)
                            <span style="color:green;">Verified</span>
                             @elseif($consumer->status==3)
                             <span style="color:red;">Rejected</span>
                              @elseif($consumer->status==4)
                             <span style="color:blue;">Forwarded</span>
                             @endif
                    </th>
                    </tr>
                    </tr>
                    <tr>
                        <td>Remarks{{$consumer->status}}</td>
                        <th colspan="3">
                            @if($consumer->status==2 || $consumer->status==0)
                            <textarea name="comment" id="sna_remarks">{{$consumer->sna_remarks}}</textarea>
                            @elseif($consumer->status==1) <span style="color:green;">{{$consumer->sna_remarks}}</span>
                             @elseif($consumer->status==3) <span style="color:red;">{{$consumer->sna_remarks}}</span>
                              @elseif($consumer->status==4) <span style="color:green;">{{$consumer->sna_remarks}}</span>
                              @endif
                      
                    </th>
                    </tr>
                      @if($consumer->status==4)
                    <tr>
                        <td>Remarks To MNRE</td>
                        <th colspan="3">
                           <span style="color:blue;">{{$consumer->mnre_remarks_by_sna}}</span>
                        </th>
                    </tr>
                       @endif
                     @if($consumer->status==2 || $consumer->status==0)
                    <tr>
                        <td></td>
                        <th colspan="3">
                            <input type="submit" name="submit" id="submit" value="Status Update">
                    </th>
                    </tr>
              @endif
               @if($consumer->status==1)
                    <tr>
                        <td></td>
                        <th colspan="3">
                           <span id="forwardToMnre_{{$consumer->id}}"><a class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" onclick="popup({{$consumer->id}})">Forward To MNRE</a></span> 
                    </th>
                    </tr>
              @endif
<tr>
                        <td></td>
                        <th colspan="3">
                          <a href="{{URL::to(Auth::getDefaultDriver().'/viewAbove-10KW/')}}"<button type="button" class="btn btn-primary">Back</button></a>
                    </th>
                    </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </div>
</div> -->
///popup ///
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Remarks</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form name="ajax-contact-form" id="ajax-contact-form" method="post" action="javascript:void(0)">
            <input type="hidden" name="small_biogas_id" id="small_biogas_id" value="">
            <input type="hidden" name="status" id="mnre_status" value="">
            <textarea name="mnre_remarks_by_sna" id="mnre_remarks_by_sna"></textarea>

            <input type="submit" id="popup_submit" name="popup_submit" value="Forward to Mnre">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
     var arr = [];
      $(document).ready(function(){
       
        var sna_remarks = $("#sna_remarks").val();
        if(sna_remarks!='')
        {
           arr = sna_remarks.split(",");
        }
       
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                arr.push($(this).val());
                $("#sna_remarks").val(arr);
            }
            else if($(this).prop("checked") == false){
                 var x = arr.indexOf($(this).val());
                arr.splice(x,1);
                 $("#sna_remarks").val(arr);

            }

        });
         });

  $("#approved").click(function(){
    arr = [];
  $(".approved_reject1").show();
  $(".approved_reject1").html('<img src="http://localhost/biogas_live/public/images/checked.png" width="16" height="16" >');
  $("input:checkbox").each(function() {
            this.checked = false;
        });
  $(".papproved").hide();
  $("#sna_remarks").val("Proposal has been verified");
});
   $("#partial_approved").click(function(){ 
  $(".approved_reject1").hide();
  $(".papproved").show();
});
  $("#reject").click(function(){
    arr = [];
  $(".approved_reject1").show();
   $(".approved_reject1").html('<img src="http://localhost/biogas_live/public/images/cross.png" width="16" height="16" >');
  $(".papproved").hide();
   $("input:checkbox").each(function() {
            this.checked = false;
        });
  $("#sna_remarks").val("Proposal has been rejected");
});
    $("#submit").click(function(){
        var sna_remarks = $("#sna_remarks").val();
        var status = $(".status").val();
        var error=0;
        if ($('input[name="status"]:checked').length == 0) {
         alert('please select status');
         return false;
        }
        if(sna_remarks=="")
        {
            alert('please enter remarks');
            return false;
        }
    });
    
</script>
///popup jquery
<script>
    function popup(id)
    { 
       
       $("#small_biogas_id").val(id);
       $("#mnre_status").val(4);
    }
   
</script>
<script>
if ($("#ajax-contact-form").length > 0) {
$("#ajax-contact-form").validate({
  rules: {
    mnre_remarks_by_sna: {
    required: true,
    maxlength: 200
  },
  },
  messages: {
  mnre_remarks_by_sna: {
    required: "Please enter remarks",
    maxlength: "Your name maxlength should be 200 characters long."
  },
  
  },
  submitHandler: function(form) {
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
      $.ajax({
        url: "{{url('mnre/medium/above/save')}}",
        type: "POST",
        data: $('#ajax-contact-form').serialize(),
        datatpe:'html',
        success: function( response ) {
            if(response)
            {
            $('#ajax-contact-form')[0].reset();
           alert('Forworded to Mnre status has been updated successfully');
           $('#myModal').modal('toggle'); 
           window.location = '{{URL::to(Auth::getDefaultDriver().'/viewAbove-10KW/')}}';
       }

        }
       });
  }
  })
}
</script>
@include('modals.consumerInstallerAssociation')
@endsection
<!-- @section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>
@endsection -->