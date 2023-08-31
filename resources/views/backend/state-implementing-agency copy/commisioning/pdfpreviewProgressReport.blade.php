<!-- <div class="pagetitle">
    <h1></h1>
</div> -->

@php $data['general'] = json_decode($data->general, true); @endphp
@php $data['internal_infrastructure'] = json_decode($data->internal_infrastructure, true); @endphp
@php $data['road'] = json_decode($data->road, true); @endphp
@php $data['water_facilities'] = json_decode($data->water_facility, true); @endphp
@php $data['drainage_system'] = json_decode($data->drainage_facility, true); @endphp
@php $data['fencing_boundary'] = json_decode($data->fencing, true); @endphp
@php $data['telecommunication_facilities'] = json_decode($data->telecommunication_facility, true); @endphp
@php $data['internal_transmission_system'] = json_decode($data->internal_transmission_system, true); @endphp
@php $data['external_transmission_system'] = json_decode($data->external_transmission_system, true); @endphp
@php $data['solar_projects'] = json_decode($data->solar_projects, true); @endphp
@php $data['financial_closure'] = json_decode($data->financial_closure, true); @endphp
@php $data['award_of_work'] = json_decode($data->award_of_work, true); @endphp
@php $data['solar_park_completion'] = json_decode($data->solarpark_completion, true); @endphp
@php $data['external_power_evacuation_system'] = json_decode($data->external_power_system, true); @endphp
@php $data['solar_project_completion'] = json_decode($data->solar_project_completion, true); @endphp
@php $data['attachments'] = json_decode($data->attachments, true);@endphp
@php $data['additional_information'] = $data->additional_information;
@endphp
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/';
@endphp



<style>
.heading {
    text-align: left;
    font-size: 25px;
    background-color: lightblue;
}
</style>
<table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-right">
    <tr>
        <th colspan="4">
            <h1>Application Detail</h1>
        </th>
    </tr>
    <tr>
        <th colspan="4" class="heading">
            General
        </th>
    </tr>
    <tr>
        <th>Park Name</th>
        <td>{{$data->park_name }}</td>
        <th>State</th>
        <td>{{$data['general']['state'] ?? ''}}</td>

    </tr>
    <tr>
        <th>District</th>
        <td>{{$data['general']['district'] ?? ''}}</td>
        <th>Sub District</th>
        <td>{{$data['general']['sub_district'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Village</th>
        <td>{{$data['general']['village'] ?? ''}}</td>
        <th>Latitude</th>
        <td>{{$data['general']['latitude'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Longitude</th>
        <td>{{$data['general']['longitude'] ?? ''}}</td>
        <th>Approved Capacity (in MW)</th>
        <td>{{$data->capacity}}</td>
    </tr>
    <tr>
        <th>Date of In-Principle Approval</th>
        <td>{{$data['general']['date'] ?? ''}}</td>
        <th>Solar Power Park Developer Name (SPPD)</th>
        <td>{{$data['general']['park_developer_name'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Office Address</th>
        <td>{{$data['general']['address'] ?? ''}}</td>
        <th>Office Contact Number</th>
        <td>{{$data['general']['office_contact_number'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Concerned Person Name</th>
        <td>{{$data['general']['concerned_person_name'] ?? ''}}</td>
        <th>Email ID</th>
        <td>{{$data['general']['email'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Office/ Landline Number</th>
        <td>{{$data['general']['telephone_number'] ?? ''}}</td>
        <th>Mobile Number</th>
        <td>{{$data['general']['mobile_number'] ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Internal Infrastructure
        </th>
    </tr>

    <tr>
        <th>DPR Status</th>
        <td> @if($data['internal_infrastructure']['dpr_status'] == 'A')
            <span>DPR Under Preparation</span>
            @elseif($data['internal_infrastructure']['dpr_status'] == 'B')
            <span>DPR Submitted</span>
            @elseif($data['internal_infrastructure']['dpr_status'] == 'C')
            <span> DPR Under Revision</span>
            @else
            $data['internal_infrastructure']['dpr_status'] == 'D'
            <span>DPR Approved</span>
            @endif
        </td>
        <th>Land Status</th>
        <td>

            @if($data['internal_infrastructure']['land_status_aquired'] != null &&
            $data['internal_infrastructure']['land_status_identified']!= null )
            <span>Land Identified And Land Acquired </span>
            @elseif(($data['internal_infrastructure']['land_status_aquired'] ?? '' )==2)
            <span>Land Acquired </span>
            @elseif(($data['internal_infrastructure']['land_status_identified'] ?? '' )==1)
            <span>Land Identified </span>
            @else
            <span>NA</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Land Acquired (In Acres)</th>
        <td>{{$data['internal_infrastructure']['land_acquired_acres'] ?? ''}}</td>
        <th>Government Land</th>
        <td>
            @if($data['internal_infrastructure']['govt_land'] == 'A')
            <span>Land Identified</span>

            @else($data['internal_infrastructure']['govt_land'] == 'B' )
            <span>Land Acquired</span>
            @endif
        </td>
    </tr>

    <tr>
        <th>Private Land</th>
        <td>@if($data['internal_infrastructure']['private_land'] == 'A')
            <span>Land Identified</span>

            @else($data['internal_infrastructure']['private_land'] == 'B' )
            <span>Land Acquired</span>
            @endif
        </td>
        <th>Any Others</th>
        <td>{{$data['internal_infrastructure']['others'] ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Road
        </th>
    </tr>

    <tr>
        <th>Approach road to the park Status of Road</th>
        <td> @if($data['road']['road_status'] == 'A')
            <span>Already available</span>
            @elseif($data['road']['road_status'] == 'B')
            <span>New road to be developed</span>
            @else($data['road']['road_status'] == 'C')
            <span>Only rework/modification of road</span>
            @endif
        </td>
        <th>Length of approach road up to the park boundary (in km)</th>
        <td>{{$data['road']['park_boundary'] ?? ''}}
        </td>
    </tr>
    <tr>
        <th>Length of access road to each plot inside the park (in km)</th>
        <td>{{$data['road']['road_distance'] ?? ''}}</td>
        <th>Status </th>
        <td>{{$data['road']['work_status'] ?? ''}}</td>
    </tr>



    <tr>
        <th colspan="4" class="heading">
            Water Facilities
        </th>
    </tr>
    <!-- {{$data['water_facilities']['source_water'] ?? ''}} -->
    <tr>
        <th>Source of water for park</th>
        <td>{{$data['water_facilities']['source_water'] ?? ''}}</td>
        <th>Details of water requirements</th>
        <td>{{$data['water_facilities']['required_water'] ?? ''}}
        </td>
    </tr>
    <tr>
        <th>Proposed system and progress made so far</th>
        <td>{{$data['water_facilities']['proposed_system'] ?? ''}}</td>
        <th>Status </th>
        <td>{{$data['water_facilities']['status'] ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Drainage Facility
        </th>
    </tr>


    <tr>
        <th>Details of proposed drainage system (including length in km)</th>
        <td>{{$data['drainage_system']['drainage_system_details'] ?? ''}}</td>
        <th>Status </th>
        <td>{{$data['drainage_system']['tender_status'] ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Fencing
        </th>
    </tr>


    <tr>
        <th>Details of of fencing/boundary (including length)</th>
        <td> {{$data['fencing_boundary']['fencing_details'] ?? ''}}</td>
        <th>Status </th>
        <td>{{$data['fencing_boundary']['fencing_status']  ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Telecommunication Facilities
        </th>
    </tr>

    <tr>
        <th>Details of telecommunication facilities</th>
        <td> {{$data['telecommunication_facilities']['tele_facility_details'] ?? ''}}</td>
        <th>Status </th>
        <td>{{$data['telecommunication_facilities']['tender_progress_status']  ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Internal Transmission System
        </th>
    </tr>

    <tr>
        <th>Details of internal transmission system</th>
        <td> {{$data['internal_transmission_system']['int_transmission_detail'] ?? ''}}</td>
        <th> Proposed connection point</th>
        <td> @if($data['internal_transmission_system']['connection_point'] == 'A')
            <span>CTU</span>
            @else($data['internal_transmission_system']['connection_point'] == 'B')
            <span>STU</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Whether applied for connectivity/LTA to STU/CTU</th>
        <td> @if($data['internal_transmission_system']['whether_applied'] == 'A')
            <span>YES</span>
            @else($data['internal_transmission_system']['whether_applied'] == 'B')
            <span>NO</span>
            @endif
        </td>
        <th>Capacity for which connectivity granted (in MW) </th>
        <td>{{$data['internal_transmission_system']['connectivity_capacity']  ?? ''}}</td>
    </tr>

    <tr>
        <th>Capacity for which LTA granted (in MW))</th>
        <td> {{$data['internal_transmission_system']['lta_capacity'] ?? ''}}

        </td>
        <th>Status </th>
        <td>{{$data['internal_transmission_system']['internal_transmission_status']  ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            External Transmission System
        </th>
    </tr>

    <tr>
        <th> Responsibility for external transmission system</th>
        <td> @if($data['external_transmission_system']['ext_responsibility'] == 'A')
            <span>CTU</span>
            @else($data['external_transmission_system']['ext_responsibility'] == 'B')
            <span>STU</span>
            @endif
        </td>
        <th>Details of external transmission system</th>
        <td> {{$data['external_transmission_system']['external_details'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td colspan="3">{{$data['external_transmission_system']['external_status']  ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Solar Projects
        </th>
    </tr>

    <tr>
        <th> Plan for setting up of solar projects inside solar in</th>
        <td> @if($data['solar_projects']['detail'] == 'A')
            <span> EPC Mode</span>
            @elseif($data['solar_projects']['detail'] == 'B')
            <span>Developer Mode</span>
            @elseif($data['solar_projects']['detail'] == 'C')
            <span>Third Party</span>
            @else($data['solar_projects']['detail'] == 'D')
            <span> Any Other</span>
            @endif
        </td>
        <th>Tendering Agency for Solar Projects</th>
        <td> {{$data['solar_projects']['agency'] ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="pagetitle">
            Details of Tender, Tariff Discovered and details of bidders
        </th>
    </tr>

    <tr>
        <th>Date of NIT</th>
        <td>{{$data['solar_projects']['nit_date']  ?? ''}}</td>
        <th>Name of successful bidders</th>
        <td>{{$data['solar_projects']['bidders_name']  ?? ''}}</td>
    </tr>
    <tr>
        <th>Capacity (MW)</th>
        <td>{{$data['solar_projects']['TD_capacity']  ?? ''}}</td>
        <th>Tariff (in Rs/kWh)</th>
        <td>{{$data['solar_projects']['tariff']  ?? ''}}</td>
    </tr>
    <tr>
        <th>Name of successful bidders/Solar Project Developers</th>
        <td>{{$data['solar_projects']['spds_name_loa']  ?? ''}}</td>
        <th>Capacity (MW)</th>
        <td>{{$data['solar_projects']['capacity_loa']  ?? ''}}</td>
    </tr>
    <tr>
        <th colspan="4" class="heading">
            Financial Closure
        </th>
    </tr>
    <tr>
        <th>Details of Financial Closure of Solar Park (arrangement of 90% of fund of total park cost)</th>
        <td colspan="4"> {{$data['financial_closure']['financial_closure_details'] ?? ''}}</td>
        <!-- <th>Status </th>
        <td>{{$data['financial_closure']['financial_closure_remarks']  ?? ''}}</td> -->
    </tr>
    <tr>
        <th colspan="4" class="heading">
            Award of Work
        </th>
    </tr>

    <tr>
        <th>Details of tender, award of work for pooling stations, transmission lines and associated systems</th>
        <td> {{$data['award_of_work']['award_work_details'] ?? ''}}</td>
        <th> Whether work for poling stations, transmission lines, awarded</th>
        <td> @if($data['award_of_work']['whether_awarded'] == 'A')
            <span>Yes</span>
            @else($data['award_of_work']['whether_awarded'] == 'B')
            <span>No</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Details of material received at site for pooling stations and other work of Solar Park</th>
        <td> {{$data['award_of_work']['pooling_stations'] ?? ''}}</td>
        <th>Status</th>
        <td colspan="3">{{$data['award_of_work']['aow_status']  ?? ''}}</td>
    </tr>

    <tr>
        <th colspan="4" class="heading">
            Solar park Completion
        </th>
    </tr>

    <tr>
        <th> Whether the internal infrastructure of park development activities are completed</th>
        <td> @if($data['solar_park_completion']['developement_activities'] == 'A')
            <span>Yes</span>
            @else($data['solar_park_completion']['developement_activities'] == 'B')
            <span>No</span>
            @endif
        </td>
        <th>Date of In-Principle Approval</th>
        <td>{{$data['solar_park_completion']['date_inprincuple_approval'] ?? ''}}</td>
    </tr>
    <tr>
        <th>Details of material received at site for pooling stations and other work of Solar Park</th>
        <td> {{$data['solar_park_completion']['solarPark_work_details'] ?? ''}}</td>
        <th>Delay (if any) along with reason</th>
        <td> {{$data['solar_park_completion']['SPC_delay'] ?? ''}}</td>
    </tr>
    <tr>
        <th colspan="4" class="heading">
            External Power Evacuation System
        </th>
    </tr>
    <tr>
        <th>Details of completion of external transmission activities</th>
        <td> {{$data['external_power_evacuation_system']['external_transmission'] ?? ''}}</td>
        <th> Delay (if any) along with reason</th>
        <td> {{$data['external_power_evacuation_system']['delay_external_transmission'] ?? ''}}</td>
    </tr>
    <tr>
        <th colspan="4" class="heading">
            Solar Project Completion
        </th>
    </tr>
    <tr>
        <th>Details of completion of external transmission activities</th>
        <td> {{$data['solar_project_completion']['solar_project_completion_details'] ?? ''}}</td>
        <th> Delay (if any) along with reason</th>
        <td> {{$data['solar_project_completion']['delay_solar_project'] ?? ''}}</td>
    </tr>
    <tr>
        <th colspan="4" class="heading">
            Attachments
        </th>
    </tr>
    <tr>
        <th>Photo of site/land development and related activities, before and after completion of activities</th>
        <td>@php $i=0; @endphp
            @foreach($data['attachments']['site_photo'][$i] as $value)
            @php $i++; @endphp
            <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
            @endforeach
        </td>

        <th>Photo of roads, water system, drainage system, before and after completion of activities</th>
        <td> @php $j=0; @endphp
            @foreach($data['attachments']['road_photo'][$j] as $value)
            @php $j++; @endphp
            <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Photo of internal power evacuation systems, pooling substations, lines or associated activates, before and
            after completion of activities</th>
        <td> @php $l=0; @endphp
            @foreach($data['attachments']['ipes_photo'][$l] as $value)
            @php $l++; @endphp
            <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
            @endforeach
        </td>

        <th>Photo of external transmission system, grid substations, lines or associated activates, before and after
            completion of activities</th>
        <td>@php $m=0; @endphp
            @foreach($data['attachments']['exts_photo'][$m] as $value)
            <@php $m++; @endphp <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View
                File</a>
                @endforeach
        </td>
    </tr>
    <tr>
        <th>Photo of solar projects or associated activates, before and after completion of activities</th>
        <td colspan="4"> @php $n=0; @endphp
            @foreach($data['attachments']['solar_project_photo'][$n] as $value)
            @php $n++; @endphp
            <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
            @endforeach
        </td>
    </tr>


    <tr>
        <td colspan="4"><br><br></td>
    </tr>
    <tr>
        <td colspan="4">Signatory <br>...............................</td>
    </tr>

</table>