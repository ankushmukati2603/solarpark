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
            font-size: 25px;
            background-color: lightblue;
        }
        </style>
        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1>Application Detail</h1>
                    <a href="{{ URL::to(Auth::getDefaultDriver().'/my-progress-report')}}" class="btn btn-success"
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
                <th>Date of In-Principle Approval</th>
                <td>{{$previewData['general']['date'] ?? ''}}</td>
                <th>Solar Power Park Developer Name (SPPD)</th>
                <td>{{$previewData['general']['park_developer_name'] ?? ''}}</td>
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
                <td>{{Auth::user()->email ?? ''}}</td>
            </tr>
            <tr>
                <th>Office/ Landline Number</th>
                <td>{{$previewData['general']['telephone_number'] ?? ''}}</td>
                <th>Mobile Number</th>
                <td>{{$previewData['general']['mobile_number'] ?? ''}}</td>

            </tr>
            <tr>
                <th>DPR Status</th>
                <td> @if($previewData['general']['dpr_status'] == 'A')
                    <span>DPR Under Preparation</span>
                    @elseif($previewData['general']['dpr_status'] == 'B')
                    <span>DPR Submitted</span>
                    @elseif($previewData['general']['dpr_status'] == 'C')
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
                <!--  -->
                <th>Land Status</th>
                <td>

                    @if($previewData['internal_infrastructure']['land_status_aquired'] != null &&
                    $previewData['internal_infrastructure']['land_status_identified']!= null )
                    <span>Land Identified And Land Acquired </span>
                    @elseif(($previewData['internal_infrastructure']['land_status_aquired'] ?? '' )==2)
                    <span>Land Acquired </span>
                    @elseif(($previewData['internal_infrastructure']['land_status_identified'] ?? '' )==1)
                    <span>Land Identified </span>
                    @else
                    <span>NA</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Land Acquired (In Acres)</th>
                <td>{{$previewData['internal_infrastructure']['land_acquired_acres'] ?? ''}}</td>
                <th>Government Land</th>
                <td>
                    @if($previewData['internal_infrastructure']['govt_land'] == 'A')
                    <span>Land Identified</span>

                    @else($previewData['internal_infrastructure']['govt_land'] == 'B' )
                    <span>Land Acquired</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Private Land</th>
                <td>@if($previewData['internal_infrastructure']['private_land'] == 'A')
                    <span>Land Identified</span>

                    @else($previewData['internal_infrastructure']['private_land'] == 'B' )
                    <span>Land Acquired</span>
                    @endif
                </td>
                <th>Any Others</th>
                <td>{{$previewData['internal_infrastructure']['others'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Road
                </th>
            </tr>

            <tr>
                <th>Approach road to the park Status of Road</th>
                <td> @if($previewData['road']['road_status'] == 'A')
                    <span>Already available</span>
                    @elseif($previewData['road']['road_status'] == 'B')
                    <span>New road to be developed</span>
                    @else($previewData['road']['road_status'] == 'C')
                    <span>Only rework/modification of road</span>
                    @endif
                </td>
                <th>Length of approach road up to the park boundary (in km)</th>
                <td>{{$previewData['road']['park_boundary'] ?? ''}}
                </td>
            </tr>
            <tr>
                <th>Length of access road to each plot inside the park (in km)</th>
                <td>{{$previewData['road']['road_distance'] ?? ''}}</td>
                <th>Status </th>
                <td>{{$previewData['road']['work_status'] ?? ''}}</td>
            </tr>



            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Water Facilities
                </th>
            </tr>
            <!-- {{$previewData['water_facilities']['source_water'] ?? ''}} -->
            <tr>
                <th>Source of water for park</th>
                <td>{{$previewData['water_facilities']['source_water'] ?? ''}}</td>
                <th>Details of water requirements</th>
                <td>{{$previewData['water_facilities']['required_water'] ?? ''}}
                </td>
            </tr>
            <tr>
                <th>Proposed system and progress made so far</th>
                <td>{{$previewData['water_facilities']['proposed_system'] ?? ''}}</td>
                <th>Status </th>
                <td>{{$previewData['water_facilities']['status'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Drainage Facility
                </th>
            </tr>


            <tr>
                <th>Details of proposed drainage system (including length in km)</th>
                <td>{{$previewData['drainage_system']['drainage_system_details'] ?? ''}}</td>
                <th>Status </th>
                <td>{{$previewData['drainage_system']['tender_status'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Fencing
                </th>
            </tr>


            <tr>
                <th>Details of of fencing/boundary (including length)</th>
                <td> {{$previewData['fencing_boundary']['fencing_details'] ?? ''}}</td>
                <th>Status </th>
                <td>{{$previewData['fencing_boundary']['fencing_status']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Telecommunication Facilities
                </th>
            </tr>

            <tr>
                <th>Details of telecommunication facilities</th>
                <td> {{$previewData['telecommunication_facilities']['tele_facility_details'] ?? ''}}</td>
                <th>Status </th>
                <td>{{$previewData['telecommunication_facilities']['tender_progress_status']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Internal Transmission System
                </th>
            </tr>

            <tr>
                <th>Details of internal transmission system</th>
                <td> {{$previewData['internal_transmission_system']['int_transmission_detail'] ?? ''}}</td>
                <th> Proposed connection point</th>
                <td> @if($previewData['internal_transmission_system']['connection_point'] == 'A')
                    <span>CTU</span>
                    @else($previewData['internal_transmission_system']['connection_point'] == 'B')
                    <span>STU</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Whether applied for connectivity/LTA to STU/CTU</th>
                <td> @if($previewData['internal_transmission_system']['whether_applied'] == 'A')
                    <span>YES</span>
                    @else($previewData['internal_transmission_system']['whether_applied'] == 'B')
                    <span>NO</span>
                    @endif
                </td>
                <th>Capacity for which connectivity granted (in MW) </th>
                <td>{{$previewData['internal_transmission_system']['connectivity_capacity']  ?? ''}}</td>
            </tr>

            <tr>
                <th>Capacity for which LTA granted (in MW))</th>
                <td> {{$previewData['internal_transmission_system']['lta_capacity'] ?? ''}}

                </td>
                <th>Status </th>
                <td>{{$previewData['internal_transmission_system']['internal_transmission_status']  ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    External Transmission System
                </th>
            </tr>

            <tr>
                <th> Responsibility for external transmission system</th>
                <td> @if($previewData['external_transmission_system']['ext_responsibility'] == 'A')
                    <span>CTU</span>
                    @else($previewData['external_transmission_system']['ext_responsibility'] == 'B')
                    <span>STU</span>
                    @endif
                </td>
                <th>Details of external transmission system</th>
                <td> {{$previewData['external_transmission_system']['external_details'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td colspan="3">{{$previewData['external_transmission_system']['external_status']  ?? ''}}</td>
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
                <th colspan="4" class="pagetitle">
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
                <th>Name of successful bidders/Solar Project Developers</th>
                <td>{{$previewData['solar_projects']['spds_name_loa']  ?? ''}}</td>
                <th>Capacity (MW)</th>
                <td>{{$previewData['solar_projects']['capacity_loa']  ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Financial Closure
                </th>
            </tr>
            <tr>
                <th>Details of Financial Closure of Solar Park (arrangement of 90% of fund of total park cost)</th>
                <td colspan="4"> {{$previewData['financial_closure']['financial_closure_details'] ?? ''}}</td>
                <!-- <th>Status </th>
        <td>{{$previewData['financial_closure']['financial_closure_remarks']  ?? ''}}</td> -->
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Award of Work
                </th>
            </tr>

            <tr>
                <th>Details of tender, award of work for pooling stations, transmission lines and associated systems
                </th>
                <td> {{$previewData['award_of_work']['award_work_details'] ?? ''}}</td>
                <th> Whether work for poling stations, transmission lines, awarded</th>
                <td> @if($previewData['award_of_work']['whether_awarded'] == 'A')
                    <span>Yes</span>
                    @else($previewData['award_of_work']['whether_awarded'] == 'B')
                    <span>No</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Details of material received at site for pooling stations and other work of Solar Park</th>
                <td> {{$previewData['award_of_work']['pooling_stations'] ?? ''}}</td>
                <th>Status</th>
                <td colspan="3">{{$previewData['award_of_work']['aow_status']  ?? ''}}</td>
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
                <td> {{$previewData['solar_park_completion']['solarPark_work_details'] ?? ''}}</td>
                <th>Delay (if any) along with reason</th>
                <td> {{$previewData['solar_park_completion']['SPC_delay'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    External Power Evacuation System
                </th>
            </tr>
            <tr>
                <th>Details of completion of external transmission activities</th>
                <td> {{$previewData['external_power_evacuation_system']['external_transmission'] ?? ''}}</td>
                <th> Delay (if any) along with reason</th>
                <td> {{$previewData['external_power_evacuation_system']['delay_external_transmission'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Solar Project Completion
                </th>
            </tr>
            <tr>
                <th>Details of completion of external transmission activities</th>
                <td> {{$previewData['solar_project_completion']['solar_project_completion_details'] ?? ''}}</td>
                <th> Delay (if any) along with reason</th>
                <td> {{$previewData['solar_project_completion']['delay_solar_project'] ?? ''}}</td>
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
                    @php $m++; @endphp <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>
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