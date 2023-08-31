@extends('layouts.masters.backend')
@section('content')
@section('title', ' Proposal for Medium Biogas Plants ( Above 25 M^3 to 25 M3) - Above 10 KW')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/BiogasAbove10KW/';
@endphp
<div class="col-md-12">
    <div class="frontPagesBox">
        <div class="box box-primary">
            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Proposal for Medium Biogas Plants ( Above 25 M^3
                            to 25 M^3) - Above 10 KW</li>
                    </ol>
                </nav>
            </div>
            <form id="consumerInterestForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-header with-border text-right">
                    <h3 class="card-title text-center"> Proposal for Medium Biogas Plants ( Above 25 M^3
                        to 25 M^3) - Above 10 KW <br> Application No. : {{$consumer['application_id'] ?? 'NA'}}</h3>
                </div><br>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td width="65%">Beneficiary name </td>
                            <th width="35%">{{$consumer['beneficiary_name'] ?? ''}}</th>
                        <tr>
                            <td>Beneficiary Address</td>
                            <th>{{$consumer['beneficiary_address'] ?? ''}}</th>
                        </tr>
                        </tr>
                        <tr>
                            <td>GPS of Plant site </td>
                            <th>{{$consumer['gps'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Contact Number of Plant site</td>
                            <th>{{$consumer['contact_number'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Name of address of the State Agency/BDTC who propose to undertake the work
                            </td>
                            <th>{{$consumer['state_agency_name'] ?? ''}}</th>
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
                            </th>
                        </tr>
                        <tr>
                            <td>Proposed use of generated power with detailed configuration</td>
                            <th>{{$consumer['generated_power'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Mode of use and total requirement of power (kWh/day)/total requirements of
                                biogas (cu.m.per day)</td>
                            <th>{{$consumer['required_biogas'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Proposed size of Biogas plant (m3)</td>
                            <th>{{$consumer['plant_size'] ?? ''}}</th>
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
                            <th>{{$consumer['contact_number'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Agricultural waste (in kg)</td>
                            <th>{{$consumer['agricultural_waste'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Other degradable biomass (in kg)</td>
                            <th><a href="{{URL::to($docBaseUrl.$consumer['raw_material_file'])}}">View</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Number of latrine attached</td>
                            <th>{{$consumer['latrine_attached_no'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Number of users</td>
                            <th>{{$consumer['users_no'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Availability of land for proposed biogas plant and housing
                                generator</td>
                            <th>{{$consumer['land_for_plant'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Procurement and commissioning details</td>
                            <th>
                                <a
                                    href="{{URL::to($docBaseUrl.$consumer['commissioning_procurement_detail'])}}">View</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Estimated quantum of power to be generated through biogas plant,
                                keeping in view the minimum 10 hours daily operation of the proposed power plant
                                entirely based on Biogas generation</td>
                            <th>{{$consumer['quantum_power'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Proposed electrical load distribution with biogas power plant</td>
                            <th><a href="{{URL::to($docBaseUrl.$consumer['power_documents'])}}">View</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Types of engine proposed for power generation</td>
                            <th>{{$consumer['engine_type'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Capacity of engine/dual fuel (used with bio fuel only)/Biogas micro
                                turbines etc. (in kVA)</td>
                            <th>{{$consumer['engine_capacity'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>cost of biogas engine or dual fuel engine</td>
                            <th><a href="{{URL::to($docBaseUrl.$consumer['biogas_engine_file'])}}">View</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Cost of proposed biogas plant (in Rs)</td>
                            <th>{{$consumer['plant_cost'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Manure Management and Handling system including safe and neat disposal
                                for sale of Bio-manure</td>
                            <th>{{$consumer['manure_management'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Approximate cost of electricity may be generated through Biogas (kWh/
                                day)</td>
                            <th>{{$consumer['electricity_cost'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>funding of projects</td>
                            <th><a href="{{URL::to($docBaseUrl.$consumer['project_funding'])}}">View</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Source of funds for meeting operation and maintenance cost of
                                system</td>
                            <th>{{$consumer['maintenance_funds'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Undertaking from State Nodal Deptt/Agencies/BDTC</td>
                            <th><a href="{{URL::to($docBaseUrl.$consumer['undertaking_nodal_ajency'])}}">View</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Mechanism to transfer the power plant to user / panchayat/ Society/
                                Entrepreneur etc. by SNA/SND/BDTC after specific period if applicable for the
                                project proposal</td>
                            <th>{{$consumer['mechanism_to_transfer'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Any other information regarding the project</td>
                            <th>{{$consumer['project_information'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Undertaking on Non- Judical Stamp/e
                                -Stamp paper</td>
                            <th><a href="{{URL::to($docBaseUrl.$consumer['undertaking'])}}">View</a>
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

@include('modals.consumerInstallerAssociation')
@endsection
<!-- @section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>
@endsection -->