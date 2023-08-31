@extends('layouts.masters.backend')
@section('content')
@section('title', 'Progress Report')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<section class="section dashboard">

    <main id="main" class="main">

        <style>
        .heading {
            text-align: left;
            font-size: 17px;
            color: #fff;
            background-color: #015296 !important;
        }
        </style>
        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1>Application Detail</h1>
                    <a href="{{ URL::to(Auth::getDefaultDriver().'/consolidate-report')}}" class="btn btn-success"
                        style="float:right">Back</a>
                </th>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    General
                </th>
            </tr>
            <tr>
                <th>Park Name</th>
                <td>{{$previewData->park_name }}</td>
                <th>State</th>
                <td>{{$previewData->state ?? ''}}</td>

            </tr>
            <tr>
                <th>District</th>
                <td>{{$previewData->district ?? ''}}</td>
                <th>Sub District</th>
                <td>{{$previewData->sub_district ?? ''}}</td>
            </tr>
            <tr>
                <th>Village</th>
                <td>{{$previewData->village ?? ''}}</td>
                <th>Latitude</th>
                <td>{{$previewData['general']['latitude'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td>{{$previewData['general']['longitude'] ?? ''}}</td>
                <th>Approved Capacity (in MW)</th>
                <td>{{$previewData->capacity}}</td>
            </tr>
            <tr>

                <th>Solar Power Park Developer Name (SPPD)</th>
                <td colspan="3">{{$previewData['general']['park_developer_name'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Office Address</th>
                <td>{{$previewData['general']['address'] ?? ''}}</td>
                <th>Office Contact Number</th>
                <td>{{$previewData['general']['office_contact_number'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Concerned Person Name</th>
                <td>{{$previewData['general']['concerned_person_name'] ?? ''}}</td>
                <th>Email ID</th>
                <td>{{$previewData['general']['email'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Office/ Landline Number</th>
                <td>{{$previewData['general']['telephone_number'] ?? ''}}</td>
                <th>Mobile Number</th>
                <td>{{$previewData['general']['mobile_number'] ?? ''}}</td>
            </tr>
            <tr>
                <th>DPR Status</th>
                <td colspan="3"> @if(($previewData['internal_infrastructure']['dpr_status'] ?? '') == 'A')
                    <span>DPR Under Preparation</span>
                    @elseif(($previewData['internal_infrastructure']['dpr_status'] ?? '') == 'B')
                    <span>DPR Submitted</span>
                    @elseif(($previewData['internal_infrastructure']['dpr_status'] ?? '') == 'C')
                    <span> DPR Under Revision</span>
                    @else
                    <span>DPR Approved</span>
                    @endif
                </td>

            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Internal Infrastructure
                </th>
            </tr>


            <tr>
                <th>Land Identified (In Acres)</th>
                <td>

                    {{$previewData['internal_infrastructure']['land_status_identified'] ?? ''}}
                </td>
                <th>Land Acquired (In Acres)</th>
                <td>{{$previewData['internal_infrastructure']['land_status_aquired'] ?? ''}}</td>
            </tr>
            <tr>

                <th>Government Land Identified (In Acres)</th>
                <td>
                    {{$previewData['internal_infrastructure']['govt_land_identified'] ?? ''}}


                </td>
                <th>Government Land Acquired (In Acres)</th>
                <td>
                    {{$previewData['internal_infrastructure']['govt_land_acquired'] ?? ''}}


                </td>
            </tr>

            <tr>

                <th>Private Land Identified (In Acres)</th>
                <td>{{$previewData['internal_infrastructure']['private_land_identified'] ?? ''}}
                </td>
                <th>Private Land Acquired (In Acres)</th>
                <td>{{$previewData['internal_infrastructure']['private_land_acquired'] ?? ''}}
                </td>

            </tr>
            <tr>
                <th colspan="2">Any Others</th>
                <td colspan="2">{{$previewData['internal_infrastructure']['others'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Road
                </th>
            </tr>

            <tr>
                <th>Approach road to the park Status of Road</th>
                <td colspan="3"> @if($previewData['internal_infrastructure']['road_status'] == 'A')
                    <span>Already available</span>
                    @elseif($previewData['internal_infrastructure']['road_status'] == 'B')
                    <span>New road to be developed</span>
                    @else($previewData['internal_infrastructure']['road_status'] == 'C')
                    <span>Only rework/modification of road</span>
                    @endif
                </td>

            </tr>
            <tr>
                <th>Length of approach road up to the park boundary (in km)</th>
                <td>{{$previewData['internal_infrastructure']['park_boundary'] ?? ''}}
                </td>
                <th>Length of access road to each plot inside the park (in km)</th>
                <td>{{$previewData['internal_infrastructure']['road_distance'] ?? ''}}</td>

            </tr>
            <tr>
                <th>Status </th>
                <td colspan="3">{{$previewData['internal_infrastructure']['work_status'] ?? ''}}</td>
            </tr>



            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Water Facilities
                </th>
            </tr>
            <!-- {{$previewData['water_facilities']['source_water'] ?? ''}} -->
            <tr>
                <th>Source of water for park</th>
                <td colspan="3">{{$previewData['internal_infrastructure']['source_water'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Details of water requirements</th>
                <td colspan="3">{{$previewData['internal_infrastructure']['required_water'] ?? ''}}
                </td>
            </tr>
            <tr>
                <th>Proposed system and progress made so far</th>
                <td colspan="3">{{$previewData['internal_infrastructure']['proposed_system'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Status </th>
                <td colspan="3">{{$previewData['internal_infrastructure']['status'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Drainage Facility
                </th>
            </tr>


            <tr>
                <th>Details of proposed drainage system (including length in km)</th>
                <td colspan="3">{{$previewData['internal_infrastructure']['drainage_system_details'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Status </th>
                <td colspan="3">{{$previewData['internal_infrastructure']['tender_status'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Fencing
                </th>
            </tr>


            <tr>
                <th>Details of of fencing/boundary (including length)</th>
                <td colspan="3"> {{$previewData['internal_infrastructure']['fencing_details'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Status </th>
                <td colspan="3">{{$previewData['internal_infrastructure']['fencing_status']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Telecommunication Facilities
                </th>
            </tr>

            <tr>
                <th>Details of telecommunication facilities</th>
                <td colspan="3"> {{$previewData['internal_infrastructure']['tele_facility_details'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Status of tender and schedule for completion and progress made so far </th>
                <td colspan="3">{{$previewData['internal_infrastructure']['tender_progress_status']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3">{{$previewData['internal_infrastructure']['telecomunication_remark']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Internal Transmission System
                </th>
            </tr>

            <tr>
                <th>Details of internal transmission system</th>
                <td colspan="3"> {{$previewData['internal_transmission_system']['int_transmission_detail'] ?? ''}}</td>
            </tr>
            <tr>
                <th> Proposed connection point</th>
                <td> @if($previewData['internal_transmission_system']['connection_point'] == 'A')
                    <span>CTU</span>
                    @else($previewData['internal_transmission_system']['connection_point'] == 'B')
                    <span>STU</span>
                    @endif
                </td>
                <th>Whether applied for connectivity/LTA to STU/CTU</th>
                <td> @if($previewData['internal_transmission_system']['whether_applied'] == 'A')
                    <span>YES</span>
                    @else($previewData['internal_transmission_system']['whether_applied'] == 'B')
                    <span>NO</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Details of external transmission system</th>
                <td colspan="3"> {{$previewData['internal_transmission_system']['external_details'] ?? ''}}</td>
            </tr>
            <tr>

                <th>Status of tender & schedule for completion of external transmission system work &progress made so
                    far </th>
                <td colspan="3">{{$previewData['internal_transmission_system']['internal_transmission_status']  ?? ''}}
                </td>
            </tr>



            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Solar Projects
                </th>
            </tr>

            <tr>
                <th> Plan for setting up of solar projects inside solar in</th>
                <td> @if($previewData['solar_projects']['detail'] == 'A')
                    <span> EPC Mode</span>
                    @elseif($previewData['solar_projects']['detail'] == 'B')
                    <span>Developer Mode</span>
                    @elseif($previewData['solar_projects']['detail'] == 'C')
                    <span>Third Party</span>
                    @else($previewData['solar_projects']['detail'] == 'D')
                    <span> Any Other</span>
                    @endif
                </td>
                <th>Tendering Agency for Solar Projects</th>
                <td> {{$previewData['solar_projects']['agency'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="pagetitle bg-warning">
                    Details of Tender, Tariff Discovered and details of bidders
                </th>
            </tr>

            <tr>
                <th>Date of NIT</th>
                <td>{{$previewData['solar_projects']['nit_date']  ?? ''}}</td>
                <th>Name of successful bidders</th>
                <td>{{$previewData['solar_projects']['bidders_name']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Capacity (MW)</th>
                <td>{{$previewData['solar_projects']['TD_capacity']  ?? ''}}</td>
                <th>Tariff (in Rs/kWh)</th>
                <td>{{$previewData['solar_projects']['tariff']  ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="pagetitle bg-warning">
                    Date of Letter of Award (LoA)
                </th>
            </tr>

            <tr>
                <th>Name of successful bidders/Solar Project Developers</th>
                <td>{{$previewData['solar_projects']['spds_name_loa']  ?? ''}}</td>
                <th>Capacity (MW)</th>
                <td>{{$previewData['solar_projects']['capacity_loa']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Date of PSA</th>
                <td>{{$previewData['solar_projects']['psa_date']  ?? ''}}</td>
                <th>Name of DISCOM</th>
                <td>{{$previewData['solar_projects']['discom_name']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="pagetitle bg-warning">
                    Details of PPA
                </th>
            </tr>

            <tr>
                <th>Name of SPDs</th>
                <td>{{$previewData['solar_projects']['spds_name_ppa']  ?? ''}}</td>
                <th>Capacity (MW)</th>
                <td>{{$previewData['solar_projects']['ppa_capacity']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Date of PPA</th>
                <td colspan="3">{{$previewData['solar_projects']['ppa_date']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="pagetitle bg-warning">
                    Scheduled Date of Commissioning (SCoD) of Solar Project
                </th>
            </tr>

            <tr>
                <th>Name of SPDs</th>
                <td>{{$previewData['solar_projects']['spds_name_scod']  ?? ''}}</td>
                <th>Capacity (MW)</th>
                <td>{{$previewData['solar_projects']['scod_capacity']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Date of SCoD</th>
                <td colspan="3">{{$previewData['solar_projects']['scod_date']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="pagetitle bg-warning">
                    Extended date of Solar Project Commissioning, if any
                </th>
            </tr>

            <tr>
                <th>Name of SPDs</th>
                <td>{{$previewData['solar_projects']['extended_spds_name']  ?? ''}}</td>
                <th>Capacity (MW)</th>
                <td>{{$previewData['solar_projects']['extended_capacity']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Extended Date of SCoD</th>
                <td colspan="3">{{$previewData['solar_projects']['extended_date']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3">{{$previewData['solar_projects']['solar_project_remarks']  ?? ''}}</td>
            </tr>





            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Financial Closure
                </th>
            </tr>
            <tr>
                <th>Details of Financial Closure of Solar Park (arrangement of 90% of fund of total park cost)</th>
                <td colspan="3"> {{$previewData['financial_closure']['financial_closure_details'] ?? ''}}</td>

            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3"> {{$previewData['financial_closure']['financial_closure_remarks'] ?? 'NA'}}</td>

            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Award of Work
                </th>
            </tr>

            <tr>
                <th>Details of tender, award of work for pooling stations, transmission lines and associated systems
                </th>
                <td colspan="3"> {{$previewData['award_of_work']['award_work_details'] ?? ''}}</td>
            </tr>
            <tr>
                <th> Whether work for poling stations, transmission lines, awarded</th>
                <td colspan="3"> @if($previewData['award_of_work']['whether_awarded'] == 'A')
                    <span>Yes</span>
                    @else($previewData['award_of_work']['whether_awarded'] == 'B')
                    <span>No</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Details of material received at site for pooling stations and other work of Solar Park</th>
                <td colspan="3"> {{$previewData['award_of_work']['pooling_stations'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Status, progress made so far</th>
                <td colspan="3">{{$previewData['award_of_work']['aow_status']  ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3">{{$previewData['award_of_work']['work_award_remarks']  ?? 'NA'}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Solar park Completion
                </th>
            </tr>

            <tr>
                <th> Whether the internal infrastructure of park development activities are completed</th>
                <td> @if($previewData['solar_park_completion']['developement_activities'] == 'A')
                    <span>Yes</span>
                    @else($previewData['solar_park_completion']['developement_activities'] == 'B')
                    <span>No</span>
                    @endif
                </td>
                <th>Date of In-Principle Approval</th>
                <td>{{$previewData['solar_park_completion']['date_inprincuple_approval'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Details of material received at site for pooling stations and other work of Solar Park</th>
                <td colspan="3"> {{$previewData['solar_park_completion']['solarPark_work_details'] ?? ''}}</td>
            </tr>

            <tr>
                <th>Delay (if any) along with reason</th>
                <td colspan="3"> {{$previewData['solar_park_completion']['SPC_delay'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3"> {{$previewData['solar_park_completion']['SPC_remarks'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    External Power Evacuation System
                </th>
            </tr>
            <tr>
                <th>Details of completion of external transmission activities</th>
                <td colspan="3"> {{$previewData['external_power_evacuation_system']['external_transmission'] ?? ''}}
                </td>
            </tr>
            <tr>
                <th> Delay (if any) along with reason</th>
                <td colspan="3">
                    {{$previewData['external_power_evacuation_system']['delay_external_transmission'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3">
                    {{$previewData['external_power_evacuation_system']['external_transmission_remarks'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Solar Project Completion
                </th>
            </tr>
            <tr>
                <th>Details of completion of external transmission activities</th>
                <td colspan="3"> {{$previewData['solar_project_completion']['solar_project_completion_details'] ?? ''}}
                </td>
            </tr>
            <tr>
                <th> Delay (if any) along with reason</th>
                <td colspan="3"> {{$previewData['solar_project_completion']['delay_solar_project'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td colspan="3">
                    {{$previewData['solar_project_completion']['solar_project_complation_remarks'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Status of Release of CFA
                </th>
            </tr>
            <tr>
                <th colspan="4">
                    <table class="table table-bordered">

                        <tbody>
                            <tr>
                                <th>S.NO.</th>
                                <th>Milestone</th>
                                <th>% of Subsidy Disbursed</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Release Date</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Total Eligible CFA</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Land Acquisition (Not less than 50% land acquired)</td>
                                <td>20%</td>
                                <td>{{$previewData['status_of_release_of_cfa']['land_acquisition_amount'] ?? '0'}}</td>
                                <td>{{$previewData['status_of_release_of_cfa']['land_acquisition_due_date'] ?? ''}}</td>
                                <td>{{$previewData['status_of_release_of_cfa']['land_acquisition_release_date'] ?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Financial Closure</td>
                                <td>20%</td>
                                <td>{{$previewData['status_of_release_of_cfa']['financial_closure_amount'] ?? '0'}}</td>
                                <td>{{$previewData['status_of_release_of_cfa']['financial_closure_due_date'] ?? ''}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['financial_closure_release_date'] ?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Award of Work for Pooling Stations</td>
                                <td>20%</td>
                                <td>{{$previewData['status_of_release_of_cfa']['aw_pooling_station_amount'] ?? '0'}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['aw_pooling_station_due_date'] ?? ''}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['aw_pooling_station_release_date'] ?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Receipt of Material on Site for Pooling Stations</td>
                                <td>25%</td>
                                <td>{{$previewData['status_of_release_of_cfa']['receipt_material_site_amount'] ?? '0'}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['receipt_material_site_due_date'] ?? ''}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['receipt_material_site_release_date'] ?? ''}}
                                </td>

                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Completion of Construction of Pooling Stations &amp; Land Development</td>
                                <td>15%</td>
                                <td>{{$previewData['status_of_release_of_cfa']['completion_construction_amount'] ?? '0'}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['completion_construction_due_date'] ?? ''}}
                                </td>
                                <td>{{$previewData['status_of_release_of_cfa']['completion_construction_release_date'] ?? ''}}
                                </td>

                            </tr>
                            <!-- <tr>
                                <td colspan="2">Total</td>
                                <td>100%</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr> -->
                        </tbody>
                    </table>
                </th>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Attachments
                </th>
            </tr>
            <tr>
                <th>Photo of site/land development and related activities, before and after completion of activities
                </th>
                <td>
                    @if(!empty($previewData['attachments']['site_photo']))
                    @php $i=0;@endphp
                    @foreach($previewData['attachments']['site_photo'][$i] as $value)
                    @php $i++; @endphp
                    <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
                    @endforeach
                    @endif
                </td>

                <th>Photo of roads, water system, drainage system, before and after completion of activities</th>
                <td> @if(!empty($previewData['attachments']['road_photo']))
                    @php $j=0; @endphp
                    @foreach($previewData['attachments']['road_photo'][$j] as $value)
                    @php $j++; @endphp
                    <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
                    @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <th>Photo of internal power evacuation systems, pooling substations, lines or associated activates,
                    before and
                    after completion of activities</th>
                <td>@if(!empty($previewData['attachments']['ipes_photo']))
                    @php $l=0; @endphp
                    @foreach($previewData['attachments']['ipes_photo'][$l] as $value)
                    @php $l++; @endphp
                    <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
                    @endforeach
                    @endif
                </td>

                <th>Photo of external transmission system, grid substations, lines or associated activates, before and
                    after
                    completion of activities</th>
                <td> @if(!empty($previewData['attachments']['exts_photo']))
                    @php $m=0; @endphp
                    @foreach($previewData['attachments']['exts_photo'][$m] as $value)
                    <@php $m++; @endphp <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>
                        View
                        File</a>
                        @endforeach
                        @endif
                </td>
            </tr>
            <tr>
                <th>Photo of solar projects or associated activates, before and after completion of activities</th>
                <td colspan="4">
                    @if(!empty($previewData['attachments']['solar_project_photo']))
                    @php $n=0; @endphp
                    @foreach($previewData['attachments']['solar_project_photo'][$n] as $value)
                    @php $n++; @endphp
                    <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
                    @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Additional Information
                </th>
            </tr>
            <tr>
                <th>Any issue of SPPD/SPD/STU/CTU which you want to highlight in MNRE/SECI, please upload a brief</th>
                <td>
                    @if($previewData['additional_information']!='')

                    <a href=" {{URL::to($docBaseUrl.$previewData['additional_information'])}}" target="_blank"
                        style='float: right;'>View File</a>

                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="4"><br><br></td>
            </tr>
            <tr>
                <td colspan="4">Signatory <br>...............................</td>
            </tr>

        </table>
    </main>
</section>
@endsection