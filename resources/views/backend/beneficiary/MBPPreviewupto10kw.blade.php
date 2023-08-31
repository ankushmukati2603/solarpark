@extends('layouts.masters.backend')
@section('content')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/BioDocument/';
@endphp
@section('title', ' Proposal for Medium Biogas Plants ( Above 25 M^3 to 25 M3) - Above 10 KW')
<div class="col-md-12">
    <div class="frontPagesBox">
        <div class="box box-primary">
            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Proposal for Medium Biogas Plants ( Upto 4 class="pb-3"5 M^3
                            to
                            25 M3) - Upto 10 KW</li>
                    </ol>
                </nav>
            </div>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <form id="consumerInterestForm" action="{{URL::to(Auth::getDefaultDriver().'/mediumBiogasPlants')}}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-header with-border text-right">
                    <h3 class="card-title text-center"> Proposal for Medium Biogas Plants ( Above 25 M^3
                        to 25 M^3) - Upto 10 KW <br> Application No. : {{$consumer['application_id'] ?? 'NA'}}</h3>
                </div><br>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Name of state Govt. Nodal Deptt. / Nodal Agency / BDTC/ KVIC other Approved
                                Organization </td>
                            <th>{{$consumer['organization_name'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Address of state Govt. Nodal Deptt./Nodal Agency/BDTC/ KVIC other Approved
                                Organization</td>
                            <th>{{$consumer['organization_address'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Name of project executing organization/agency (if other than SNA/SND./BDTC/ KVIC)</td>
                            <th>{{$consumer['project_name'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Address of project executing organization/agency (if other than SNA/SND./BDTC/ KVIC)
                            </td>
                            <th>{{$consumer['project_address'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Details of site indicating location and address with expected load and use of
                                electricity or biogas for thermal applications</td>
                            <th>{{$consumer['applications_details'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Capacity of biogas plant (cubic meter per day/per hour)</td>
                            <th>{{$consumer['capacity'] ?? ''}}</th>
                        </tr>

                        <tr>
                            <td>Mention details of cattles</td>
                            <th>Adult: {{$consumer['cattles_details']['no_adult'] ?? ''}}<br>
                                Age: {{$consumer['cattles_details']['age'] ?? ''}}<br>
                                Weight: {{$consumer['cattles_details']['weight'] ?? ''}}
                            </th>
                        </tr>
                        <tr>
                            <td>Any other source of waste (goats, pigs, poultry diary effluent, food, kitchen, Agro/
                                Food processing waste etc.)</td>
                            <th>Animals: {{$consumer['other_sources']['No_animals'] ?? ''}}<br>
                                Weight: {{$consumer['other_sources']['weight'] ?? ''}}</th>
                        </tr>

                        <tr>
                            <td>Name of manufacturer/supplier and cost of 100% biogas engines, DG-Genset and associated
                                control panel etc')</td>
                            <th>{{$consumer['manufacturer_name'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Required daily demand /power in KWh/day')</td>
                            <th>{{$consumer['required_daily_power'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Required amount of biogas generation daily( in cubic metre) including cooking/
                                heating/cooling etc.(Kcal requirement per day for thermal energy applications)</td>
                            <th>{{$consumer['biogas_generation'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>No. of biogas plants units with capacity of each cubic metre proposed</td>
                            <th>{{$consumer['no_of_plants'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Estimated actual cost worked out by concerned user agency /manufacturer and verified by
                                concerned SND / SNA / KVIC /BDTC etc</td>
                            <th>{{$consumer['actual_cost'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Proposed operational hours per day entirely based on Biogas (100% biogas utilization
                                basis)</td>
                            <th>{{$consumer['operational_hours'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Total estimated project cost (in Rs.)</td>
                            <th>{{$consumer['project_cost'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td>Amount of CFA worked out as per the approved rates and norms of scheme of BPGTP (in Rs.)
                            </td>
                            <th>{{$consumer['amount_of_cfa'] ?? ''}}</th>
                        </tr>
                        <tr>
                            <td> Upload Undertaking on Non- Judical Stamp/e - Stamp
                                paper</td>
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