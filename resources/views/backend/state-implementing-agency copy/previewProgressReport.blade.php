@extends('layouts.masters.backend')
@section('content')
@section('title', 'Progress Report')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/';
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
                    <a href="{{ URL::to(Auth::getDefaultDriver().'/recieved-progress-report')}}" class="btn btn-success"
                        style="float:right">Back</a>
                </th>
            </tr>
            @if($previewData->report_type==1)

            <tr>
                <th colspan="4" class="heading1 bg-primary text-light">
                    General
                </th>
            </tr>
            <tr>
                <th>Agency</th>
                <td>{{$previewData['general']['agency_name'] ?? ''}}</td>
                <th>Scheme Type</th>
                <td> @if($previewData['general']['scheme_type'] == '1')
                    <span>State</span>
                    @else
                    <span>Central</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{$previewData['general']['contact_person_name'] ?? ''}}</td>
                <th>Email ID</th>
                <td>{{$previewData['general']['email'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Mobile Number</th>
                <td>{{$previewData['general']['mobile_number'] ?? ''}}</td>
                <th>Bidding Agency</th>
                <td>{{$previewData['general']['bidding_agency'] ?? ''}}</td>
            </tr>
            <tr>
                <th>State</th>
                <td>{{$previewData->state ?? ''}}</td>
                <th>District</th>
                <td>{{$previewData->district ?? ''}}</td>
            </tr>
            <tr>

                <th>Sub District</th>
                <td>{{$previewData->sub_district ?? ''}}</td>
                <th>Village</th>
                <td>{{$previewData->village ?? ''}}</td>
            </tr>
            <tr>
                <th>Latitude</th>
                <td>{{$previewData['general']['latitude'] ?? ''}}</td>
                <th>Longitude</th>
                <td>{{$previewData['general']['longitude'] ?? ''}}</td>
            </tr>

            <tr>
                <th colspan="4" class="heading1 bg-primary text-light">
                    Tender
                </th>
            </tr>
            <tr>
                <th>Tendered Capacity (MW)</th>
                <td>{{$previewData['tender']['tender_capacity'] ?? ''}}</td>
                <th>Date of NIT</th>
                <td>{{ date('d M Y', strtotime($previewData['tender']['nit_date'])) ?? ''}}</td>
            </tr>
            <tr>
                <th>Date of RFS</th>
                <td>{{$previewData['tender']['rfs_date'] ?? ''}}</td>
                <th>Date of Pre Bid Meeting</th>
                <td>{{date('d M Y', strtotime($previewData['tender']['pre_bid_meeting_date'])) ?? ''}}</td>
            </tr>
            <tr>
                <th>Last date of Bid Submission</th>
                <td>{{date('d M Y', strtotime($previewData['tender']['bid_submission_last_date'])) ?? ''}}</td>

            </tr>
            <tr>
                <th colspan="4" class="heading1 bg-primary text-light">
                    Reverse Auction
                </th>
            </tr>
            <tr>
                <th>Date of RA/e-RA</th>
                <td>{{date('d M Y', strtotime($previewData['reverse_auction']['ra_e_ra_date'])) ?? ''}}</td>
                <th>Awarded Capacity (MW)</th>
                <td>{{$previewData['reverse_auction']['reverseauction_capacity'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading1 bg-primary text-light">
                    Cancelled Tenders
                </th>
            </tr>
            <tr>
                <th>Cancel Tender Date</th>
                <td>{{date('d M Y', strtotime($previewData['reverse_auction']['cancel_tender_date'])) ?? ''}}</td>
                <th>Capacity (MW)</th>
                <td>{{$previewData['cancelled_tenders']['cancel_tender_capacity'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
                <td>{{$previewData['cancelled_tenders']['cancelled_tender_remarks'] ?? ''}}</td>

            </tr>
            </tr>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Selected Bidder
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-warning text-light">
                                <th class="text-center">S.No.</th>
                                <th class="text-center">Company Name</th>
                                <th class="text-center">Selected Bidders Capacity (MW)</th>
                                <th class="text-center">Date of LoI/LoA</th>
                                <th class="text-center">Tariff</th>
                                <th class="text-center">Date of PPA/PSA</th>
                                <th class="text-center">PPA/PSA Capacity (MW)</th>
                                <th class="text-center">Name of State in PPA/PSA Signed</th>
                                <th class="text-center">Name of DISCOM who have signed PPA/PSA</th>
                                <th class="text-center">Per Unit cost of electricity as per said PPA</th>
                                <th class="text-center">Duration of PPA</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if(!empty($previewData['selectedBidders']['company_name']))
                            @for($i=0;$i<=count($previewData['selectedBidders']['company_name'])-1;$i++) <tr>
                                <td>{{$i+1}}</td>
                                <td class="row-index text-center">
                                    {{$previewData['selectedBidders']['company_name'][$i] ?? ''}}</td>
                                <td>{{$previewData['selectedBidders']['select_bidders_capacity'][$i] ?? ''}}</td>
                                <td>{{date('d M Y', strtotime($previewData['selectedBidders']['loi_loa_date'][$i])) ?? ''}}
                                </td>
                                <td>{{$previewData['selectedBidders']['tariff'][$i] ?? ''}}</td>
                                <td>{{date('d M Y', strtotime($previewData['selectedBidders']['ppa_psa_date'][$i])) ?? ''}}
                                </td>
                                <td>{{$previewData['selectedBidders']['ppa_psa_capacity'][$i] ?? ''}}</td>
                                <td>{{$previewData['selectedBidders']['ppa_psa_state_name'][$i] ?? ''}}</td>
                                <td>{{$previewData['selectedBidders']['ppa_signed_discom_name'][$i] ?? ''}}</td>
                                <td>{{$previewData['selectedBidders']['ppa_electricity_unit'][$i] ?? ''}}</td>
                                <td>{{$previewData['selectedBidders']['ppa_duration'][$i] ?? ''}}</td>
            </tr>
            @endfor
            @endif
            </tbody>
        </table>
        </td>
        </tr>
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">Commissioning</th>
        </tr>
        <tr>
            <th>Scheduled Date of Commissioning as per PPA</th>
            <td>{{date('d M Y', strtotime($previewData['commissioning']['scheduled_date '])) ?? ''}}</td>
            <th>Extended/Actual Date of Commissioning</th>
            <td>{{date('d M Y', strtotime($previewData['commissioning']['extended_date'])) ?? ''}}</td>
        </tr>
        <tr>
            <th>Capacity Commissioned as per scheduled date of Commissioning (MW)</th>
            <td>{{date('d M Y', strtotime($previewData['commissioning']['capacity_commissioned_date'])) ?? ''}}</td>
            <th>Capacity Commissioned after scheduled date of Commissioning (MW)</th>
            <td>{{$previewData['commissioning']['date_inprincuple_approval'] ?? ''}}</td>

        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Additiomnal Information
            </th>
        </tr>
        <tr>
            <th>Issues/ Remarks</th>
            <td colspan="3"> {{$previewData->additional_information ?? ''}}</td>
        </tr>
        @endif
        @if($previewData->report_type==2)
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                General
            </th>
        </tr>
        <tr>
            <th>Tender</th>
            <td colspan="3">
                @if($previewData['general']['tender'] == 'ORG')
                <span>Tender ORG</span>

                @else
                <span>Tender STATES</span>

                @endif
            </td>

        </tr>
        <tr>
            <th>Developer Name</th>
            <td>{{$previewData['general']['developer_name'] ?? ''}}</td>
            <th>CEO/HEAD Name</th>
            <td>{{$previewData['general']['head_name'] ?? ''}}</td>
        </tr>
        <tr>
            <!-- <th>Scheme Name</th>
            <td>{{$previewData['general']['scheme_name'] ?? ''}}</td> -->
            <th>Office Address</th>
            <td colspan="3">{{$previewData['general']['office_address'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Office Contact Number</th>
            <td>{{$previewData['general']['contact_number'] ?? ''}}</td>
            <th>Mobile Number</th>
            <td>{{$previewData['general']['mobile_number'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Email ID</th>
            <td>{{$previewData['general']['email'] ?? ''}}</td>
            <th>Project Capacity</th>
            <td>{{$previewData['general']['project_capacity'] ?? ''}}</td>
        </tr>

        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Project Location
            </th>
        </tr>
        <tr>
            <th>State</th>
            <td>{{$previewData->state ?? ''}}</td>
            <th>District</th>
            <td>{{$previewData->district ?? ''}}</td>
        </tr>
        <tr>
            <th>Sub District</th>
            <td>{{$previewData->sub_district ?? ''}}</td>
            <th>Village</th>
            <td>{{$previewData->village ?? ''}}</td>
        </tr>
        <tr>
            <th>Latitude</th>
            <td>{{$previewData['project_location']['latitude'] ?? ''}}</td>
            <th>Longitude</th>
            <td>{{$previewData['project_location']['longitude'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Inside Solar Park</th>
            <td colspan="3">{{$previewData['project_location']['inside_solar_park'] ?? ''}}</td>

        </tr>

        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Date
            </th>
        </tr>
        <tr>
            <th>RFS Date</th>
            <td>{{date('d M Y', strtotime($previewData['date']['rfs_date'])) ?? ''}}</td>
            <th>RA Date</th>
            <td>{{date('d M Y', strtotime($previewData['date']['ra_date'])) ?? ''}}</td>
        </tr>
        <tr>
            <th>LOI Date</th>
            <td>{{date('d M Y', strtotime($previewData['date']['loi_date'])) ?? ''}}</td>
            <th>PPA Date</th>
            <td>{{date('d M Y', strtotime($previewData['date']['ppa_date'])) ?? ''}}</td>
        </tr>
        <tr>
            <th>Scheduled Commisioning Date</th>
            <td>{{date('d M Y', strtotime($previewData['date']['scheduled_commisioning_date'])) ?? ''}}</td>
            <th>Extended Commisioning Date</th>
            <td>{{date('d M Y', strtotime($previewData['date']['extended_commisioning_date']))  ?? ''}}</td>
        </tr>

        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Status
            </th>
        </tr>
        <tr>
            <th>Voltage Level</th>
            <td>{{$previewData['solar_project_status']['voltage_level'] ?? ''}}</td>
            <th>Stage 2 Status</th>
            <td>{{$previewData['solar_project_status']['stage2_status'] ?? ''}}</td>
        </tr>
        <tr>
            <th>LTA Status</th>
            <td>{{$previewData['solar_project_status']['lta_status'] ?? ''}}</td>
            <th>LTOA Date</th>
            <td>{{date('d M Y', strtotime($previewData['solar_project_status']['ltoa_date']))  ?? ''}}</td>
        </tr>
        <tr>
            <th>Sub Station Status</th>
            <td colspan="3">{{$previewData['solar_project_status']['sub_station_status'] ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Scheduled Date
            </th>
        </tr>
        <tr>
            <th>Scheduled Transmission Date</th>
            <td colspan="3">
                {{date('d M Y', strtotime($previewData['scheduled_transmission_date']['scheduled_transmission_date']))  ?? ''}}
            </td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Extended Date
            </th>
        </tr>
        <tr>
            <th>Extended Commissioning Date</th>
            <td colspan="3">
                {{date('d M Y', strtotime($previewData['extended_commissioning_date']['extended_commissioning_date']))  ?? ''}}
            </td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Additiomnal Information
            </th>
        </tr>
        <tr>
            <th>Issues/ Remarks</th>
            <td>{{$previewData->additional_information ?? ''}}</td>
        </tr>

        @endif
        @if($previewData->report_type==3 && $previewData->report_sub_type=='new_report')
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                General
            </th>
        </tr>
        <tr>
            <th>Developer Name</th>
            <td>{{$previewData['general']['developer_name'] ?? ''}}</td>
            <th>CEO Name</th>
            <td>{{$previewData['general']['ceo_name'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Office Address</th>
            <td>{{$previewData['general']['office_address'] ?? ''}}</td>
            <th>Office Contact Number</th>
            <td>{{$previewData['general']['office_number'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Mobile Number</th>
            <td>{{$previewData['general']['mobile_number'] ?? ''}}</td>
            <th>Email ID</th>
            <td>{{$previewData['general']['email'] ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Project Location
            </th>
        </tr>
        <tr>
            <th>State</th>
            <td>{{$previewData->state ?? ''}}</td>
            <th>District</th>
            <td>{{$previewData->district ?? ''}}</td>
        </tr>
        <tr>
            <th>Sub District</th>
            <td>{{$previewData->sub_district ?? ''}}</td>
            <th>Village</th>
            <td>{{$previewData->village ?? ''}}</td>
        </tr>
        <tr>
            <th>Latitude</th>
            <td>{{$previewData['project_location']['latitude'] ?? ''}}</td>
            <th>Longitude</th>
            <td>{{$previewData['project_location']['longitude'] ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Project in Solar Park
            </th>
        </tr>
        <tr>
            <th>Projects in Solar Park</th>
            <td>
                @if($previewData['project_solar_park']['solar_park_project'] == 'NO')
                <span>No</span>

                @else
                <span>Yes</span>

                @endif
            </td>
            <th>Solar Park Name</th>
            <td> <span>{{$previewData['project_solar_park']['solarpark_name'] ?? 'NA'}}</span>
            </td>
        </tr>

        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Project Type
            </th>
        </tr>
        <tr>
            <th>Project Type</th>
            <td>

                @if($previewData['project_type']['project_type_gm'] != null &&
                $previewData['project_type']['project_type_rt']!= null )
                <span>Ground Mounted And Rooftop</span>
                @elseif(($previewData['project_type']['project_type_gm'] ?? '' )==1)
                <span>Ground Mounted</span>
                @elseif(($previewData['project_type']['project_type_rt'] ?? '' )==2)
                <span>Rooftop</span>
                @else
                <span>Other</span>
                @endif
            </td>
            <th>Type of Module</th>
            <td> @if($previewData['project_type']['type_of_module'] == 'THIN')
                <span>Thin</span>
                @elseif($previewData['project_type']['type_of_module'] == 'POLY' )
                <span>Poly</span>
                @elseif($previewData['project_type']['type_of_module'] == 'MONO' )
                <span>Mono</span>
                @else
                <span>Other</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Module Make</th>
            <td colspan="3">{{$previewData['project_type']['module_remarks'] ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Scheme Details
            </th>
        </tr>
        <tr>
            <th>Scheme</th>
            <td> @if($previewData['scheme_details']['scheme_from'] == 'CENTRAL')
                <span>Central</span>

                @else($previewData['scheme_details']['scheme_from'] == 'STATE' )
                <span>State</span>
                @endif
            </td>
            <th>Mode of sale of power</th>
            <td> @if($previewData['scheme_details']['select_sale_capacity'] == 'CAPTIVE')
                <span>Cptive</span>

                @elseif($previewData['scheme_details']['select_sale_capacity'] == 'PPA' )
                <span>PPA</span>
                @else
                <span>Third party sale</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Tenure of PPA</th>
            <td>{{$previewData['scheme_details']['tenure_ppa'] ?? ''}}</td>
            <th>Electricity Per Unit Cost</th>
            <td>{{$previewData['scheme_details']['electricity_per_unit_cost'] ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Project Details
            </th>
        </tr>
        <tr>
            <th>Discom Name</th>
            <td>{{$previewData['project_details']['discom_name'] ?? ''}}</td>
            <th>Substation Name</th>
            <td>{{$previewData['project_details']['substation_name'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Substation Voltage Level</th>
            <td>{{$previewData['project_details']['substation_voltage_level'] ?? ''}}</td>
            <th>Feeder Name</th>
            <td>{{$previewData['project_details']['feeder_name'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Feeder Voltage</th>
            <td colspan="3">{{$previewData['project_details']['feeder_voltage'] ?? ''}}</td>

        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Commossioning Details
            </th>
        </tr>
        <tr>
            <th>Commissioned AC Capacity (MW)</th>
            <td>{{$previewData['commissioning']['commissioned_ac_capacity'] ?? ''}}</td>
            <th>Commissioned DC Capacity (MWp)</th>
            <td>{{$previewData['commissioning']['commissioned_dc_capacity'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Date of Commissioning</th>
            <td>{{date('d M Y', strtotime($previewData['commissioning']['commissioning_date'])) ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1  bg-primary text-light">
                Additiomnal Information
            </th>
        </tr>
        <tr>
            <th>Issues/ Remarks</th>
            <td>{{$previewData->additional_information ?? ''}}</td>
        </tr>



        <tr>
            <td colspan="4"><br><br><br></td>
        </tr>
        @endif
        @if($previewData->report_type==3 && $previewData->report_sub_type=='rooftop_report')
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                Ground Mounted
            </th>
        </tr>
        <tr>
            <th>Ground Mounted No.</th>
            <td>{{$previewData['rooftopdata']->gm_number ?? ''}}</td>
            <th>Ground Mounted Capacity (MW)</th>
            <td>{{$previewData['rooftopdata']->gm_capacity ?? ''}}</td>
        </tr>

        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                Consumers
            </th>
        </tr>
        <tr>
            <th>Consumer Number</th>
            <td>{{$previewData['rooftopdata']->consumer_number ?? ''}}</td>
            <th>Consumer Capacity</th>
            <td>{{$previewData['rooftopdata']->cunsumer_capacity ?? ''}}</td>
        </tr>

        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                13th Finance Commission
            </th>
        </tr>
        <tr>
            <th>Finance Commission No</th>
            <td>{{$previewData['rooftopdata']->fc_number ?? ''}}</td>
            <th>Finance Commission Capacity</th>
            <td>{{$previewData['rooftopdata']->fc_capacity ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                IPDS
            </th>
        </tr>
        <tr>
            <th>IPDS No.</th>
            <td>{{$previewData['rooftopdata']->ipds_number ?? ''}}</td>
            <th>IPDS Capacity</th>
            <td>{{$previewData['rooftopdata']->ipds_capacity ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                IPDS
            </th>
        </tr>
        <tr>
            <th>Surya Raltha No.</th>
            <td>{{$previewData['rooftopdata']->sr_number ?? ''}}</td>
            <th>Surya Raltha Capacity</th>
            <td>{{$previewData['rooftopdata']->sr_capacity ?? ''}}</td>
        </tr>
        <tr>
            <th colspan="4" class="heading1 bg-primary text-light">
                Submission Details
            </th>
        </tr>
        <tr>
            <th>Submitted On</th>
            <td colspan="3">{{$previewData['submitted_on'] ?? ''}}</td>

        </tr>

        @endif
        </table>
    </main>
</section>
@endsection