@extends('layouts.masters.backend')
@section('content')
@section('title', 'Tender Report')
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
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    General
                </th>
            </tr>
            <tr>
                <th>Agency Name</th>
                <td>{{$previewData->agency_name }}</td>
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
                <th>Contact Person Name (in MW)</th>
                <td>{{$previewData['general']['contact_person_name']}}</td>
            </tr>
            <tr>
                <th>Mobile Number</th>
                <td>{{$previewData['general']['mobile_number'] ?? ''}}</td>
                <th>Scheme Type</th>
                <td>{{$previewData['general']['scheme_type'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Bidding_agency</th>
                <td>{{$previewData['general']['bidding_agency'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Tender
                </th>
            </tr>
            <tr>
                <th>Tender Capacity</th>
                <td>{{$previewData['tender']['tender_capacity'] ?? ''}}</td>
                <th>NIT Date</th>
                <td>{{$previewData['tender']['nit_date'] ?? ''}}</td>
            </tr>
            <tr>
                <th>RFS Date</th>
                <td>{{$previewData['tender']['rfs_date'] ?? ''}}</td>
                <th>Pre Bid Meeting Date</th>
                <td>{{$previewData['tender']['pre_bid_meeting_date'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Bid Submission Last Date</th>
                <td>{{$previewData['tender']['bid_submission_last_date'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Reverse Auction
                </th>
            </tr>
            <tr>
                <th>RA E RA Date</th>
                <td>{{$previewData['reverseAuction']['ra_e_ra_date'] ?? ''}}</td>
                <th>Reverseauction Capacity</th>
                <td>{{$previewData['reverseAuction']['reverseauction_capacity'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Cancelled Tenders
                </th>
            </tr>
            <tr>
                <th>Cancel Tender Date</th>
                <td>{{$previewData['cancelledTenders']['cancel_tender_date'] ?? ''}}</td>
                <th>Cancel Tender Capacity</th>
                <td>{{$previewData['cancelledTenders']['cancel_tender_capacity'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Cancelled Tender Remarks</th>
                <td colspan="3">{{$previewData['cancelledTenders']['cancelled_tender_remarks'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Selected Bidders
                </th>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Commissioning
                </th>
            </tr>
            <tr>
                <th>Scheduled Date of Commissioning as per PPA</th>
                <td>{{$previewData['commissioning']['scheduled_date'] ?? ''}}</td>
                <th>Extended/Actual Date of Commissioning</th>
                <td>{{$previewData['commissioning']['extended_date'] ?? ''}}</td>
            </tr>
            <tr>
                <th>Capacity Commissioned as per scheduled date of Commissioning (MW)</th>
                <td>{{$previewData['commissioning']['capacity_commissioned_date'] ?? ''}}</td>
                <th>Capacity Commissioned after scheduled date of Commissioning (MW)</th>
                <td>{{$previewData['commissioning']['date_inprincuple_approval'] ?? ''}}</td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-dark text-light">
                    Additional Information
                </th>
            </tr>
            <tr>
                <th>Issues/ Remarks</th>
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
        </table>
    </main>
</section>
@endsection