@inject('general', 'App\Http\Controllers\Backend\SNA\TenderController')
@extends('layouts.masters.backend')
@section('content')
@section('title', 'Progress Report')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/';
@endphp
<section class="section dashboard" id="divToPrint">

    <main id="main" class="main">

        <style>
        .heading {
            text-align: left;
            font-size: 25px;
            background-color: lightblue;
        }
        </style>
        <style type="text/css">
        @media print {

            table,
            th,
            td {
                border: 1px solid #ccc !important;
                text-align: left !important;
                border-collapse: collapse !important;
                padding: 4px !important;
                width: 100% !important;
                font-size: 12px !important;
                table-layout: fixed !important;
            }

            th {
                font-weight: bold;
            }

            .cls-success {
                background-color: #198754 !important;
            }

            .bg-primary {
                background-color: #015296 !important;
            }

            .text-light {
                color: #f8f9fa !important;
            }

            .bg-info {
                background-color: #0dcaf0 !important;
            }

            .bg-warning {
                background-color: #ffc107 !important;
            }

            #print {
                display: none;
            }

            .wid {
                width: 20% !important;
            }
        }
        </style>
        @foreach($reportData['timeline'] as $data)


        @if($data=='tender')
        @if(!empty($reportData['tender']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1 class="text-center">Tender ID : {{$reportData['tender']['tender_no'] ?? '--'}}</h1>
                    <a href="{{ URL::to(Auth::getDefaultDriver().'/Tenders')}}" class="btn btn-success"
                        style="float:right">Back</a>

                </th>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success cls-success text-light">
                    Tender Published
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['tender_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <th width="20%" class="wid">Tender NIT</th>
                <td width="30%">{{$reportData['tender']['nit_no'] ?? '-'}}</td>
                <th width="20%">Scheme Type</th>
                <td width="30%">{{$reportData['tender']['scheme_type'] ?? '-'}}</td>

            </tr>
            <tr>
                <th>Title</th>
                <td>{{$reportData['tender']['tender_title'] ?? '-'}}</td>
                <th>Capacity(MW)</th>
                <td>{{$reportData['tender']['capacity'] ?? '-'}} MW</td>
            </tr>
            <tr>
                <th>NIT Date</th>
                <td>{{date('d M Y', strtotime($reportData['tender']['nit_date'])) ?? ''}}</td>
                <th>RFS Date</th>
                <td>{{date('d M Y', strtotime($reportData['tender']['rfs_date'])) ?? ''}}</td>
            </tr>
            <tr>
                <th>Pre Bid Meeting Date</th>
                <td>{{date('d M Y', strtotime($reportData['tender']['pre_bid_meeting_date'])) ?? ''}}</td>
                <th>Bid Submission Date</th>
                <td>{{date('d M Y', strtotime($reportData['tender']['bid_submission_date'])) ?? ''}}</td>
            </tr>
            <tr>
                <th>Additional Information</th>
                <td>{{$reportData['tender']['additional_information'] ?? '-'}}</td>
                <th>Tender Status</th>
                <td>
                    @if($reportData['tender']['tender_status']==1)
                    Tender
                    @elseif($reportData['tender']['tender_status']==2)
                    Under Implimentation
                    @elseif($reportData['tender']['tender_status']==3)
                    Commissioned
                    @else
                    Cancelled
                    @endif
                </td>
            </tr>
            <tr>
                <th>Bidding Agency</th>
                <td>{{$reportData['tender']['agency_name'] ?? '--'}}</td>
                <th>SPD Name</th>
                <td>{{$reportData['tender']['sub_agency_name'] ?? 'NA'}}</td>
            </tr>
        </table>
        @endif
        @endif

        @if($data=='bidder')
        @if(!empty($reportData['bidder']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-primary text-light">
                    Bidders Participated
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['bidder_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Sub District</th>
                            <th>Village</th>
                            <th>Latitude/Longitude</th>
                            <th>Capacity (MW)</th>
                            <th>DISCOM Name</th>
                        </tr>
                        @foreach($reportData['bidder'] as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder['bidder_name'] ?? '--'}}</td>
                            <td>{{$bidder['project_title'] ?? '--'}}</td>
                            <td>{{$bidder['state'] ?? '--'}}</td>
                            <td>{{$bidder['district_id'] ?? '--'}}</td>
                            <td>{{$bidder['sub_district_id'] ?? '--'}}</td>
                            <td>{{$bidder['village_id'] ?? '--'}}</td>
                            <td>Lat : {{$bidder['lat'] ?? '--'}} <br> Lng : {{$bidder['lng'] ?? '--'}}</td>
                            <td>{{$bidder['ppa_psa_capacity'] ?? '--'}} </td>
                            <td>{{$bidder['discom_name'] ?? '--'}}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        @endif
        @endif


        @if($data=='ppa')
        @if(!empty($reportData['ppa']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-info text-dark">
                    PPA Details
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['ppa_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>Effective Date of PPA</th>
                            <th>Capacity (MW)</th>
                            <th>Per Unit cost of electricity as per said PPA</th>
                            <th>Duration of PPA(In Years) </th>
                        </tr>
                        @foreach($reportData['ppa'] as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder['bidder_name'] ?? '--'}}</td>
                            <td>{{$bidder['project_title'] ?? '--'}}</td>
                            <td>{{$bidder['state'] ?? '--'}}</td>
                            <td>@if($bidder['ppa_date']!=''){{date('d M Y', strtotime($bidder['ppa_date'])) ?? ''}}
                                @else
                                -- @endif</td>
                            <td>{{$bidder['ppa_capacity'] ?? '--'}} MW</td>
                            <td>{{$bidder['ppa_electricity_per_unit_cost'] ?? '--'}}</td>
                            <td>{{$bidder['duration_ppa'] ?? '--'}}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        @endif
        @endif

        @if($data=='psa')
        @if(!empty($reportData['psa']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-info text-dark">
                    PSA Details
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['psa_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>PSA Date</th>
                            <th>PSA Signed State</th>
                            <th>PSA Duration</th>
                            <th>Electricity Per Unit Cost</th>
                        </tr>
                        @foreach($reportData['psa'] as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder['bidder_name'] ?? '--'}}</td>
                            <td>{{$bidder['project_title'] ?? '--'}}</td>
                            <td>{{$bidder['state'] ?? '--'}}</td>
                            <td>@if($bidder['ppa_psa_date']!=''){{date('d M Y', strtotime($bidder['ppa_psa_date'])) ?? ''}}
                                @else
                                -- @endif</td>
                            <td>{{$bidder['signed_state'] ?? '--'}}</td>
                            <td>{{$bidder['duration_psa'] ?? '--'}} Year's</td>
                            <td>{{$bidder['electricity_per_unit_cost'] ?? '--'}}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        @endif
        @endif

        @if($data=='loa')
        @if(!empty($reportData['loa']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading text-dark" style="background-color:#0ecfa2 !important">
                    LOI/LOA Details
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['loa_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>LOI/LOA Date</th>
                        </tr>
                        @foreach($reportData['loa'] as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder['bidder_name'] ?? '--'}}</td>
                            <td>{{$bidder['project_title'] ?? '--'}}</td>
                            <td>{{$bidder['state'] ?? '--'}}</td>
                            <td>@if($bidder['loi_loa_date']!=''){{date('d M Y', strtotime($bidder['loi_loa_date'])) ?? ''}}
                                @else
                                -- @endif</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        @endif
        @endif

        @if($data=='ra')
        @if(!empty($reportData['ra']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-warning text-light">
                    Reverse Auction Details
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['ra_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <th>RA Type</th>
                <td>{{$reportData['ra']['ra_type'] ?? '-'}}</td>
                <th>RA Capacity(MW)</th>
                <td>{{$reportData['ra']['ra_capacity'] ?? '0'}} MW</td>
            </tr>
            <tr>
                <th>RA Date</th>
                <td>{{date('d M Y', strtotime($reportData['ra']['ra_date'])) ?? ''}}</td>
                <th>Awarded Capacty(MW)</th>
                <td>{{$reportData['ra']['capacity_awarded'] ?? '0'}} MW</td>

            </tr>
        </table>
        @endif
        @endif

        @if($data=='cancel')
        @if(!empty($reportData['cancel']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-danger text-light">
                    Tender Cancellation Details
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['cancel_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <th>Tender Cancel Type</th>
                <td>{{$reportData['cancel']['cancel_type'] ?? '-'}}</td>
                <th>Cancelled Capacity(MW)</th>
                <td>{{$reportData['cancel']['cancel_capacity'] ?? '0'}}</td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td>{{$reportData['cancel']['c_capacity'] ?? '0'}}</td>
                <th>Date of Cancel</th>
                <td>{{date('d M Y', strtotime($reportData['cancel']['cancel_date'])) ?? '--'}}</td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td colspan="3">{{$reportData['cancel']['cancel_remark'] ?? '--'}}</td>
            </tr>


        </table>
        @endif
        @endif

        @if($data=='commissioned')
        @if(!empty($reportData['commissioned']))
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading text-dark" style="background-color:#539b1c !important">
                    Commissioned Details Details
                    <span style="float:right">Submitted On
                        :{{date('d M Y', strtotime($reportData['commissioned_submitted_on'])) ?? ''}}
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered" id="ppaTbale">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th colspan="9">
                                    <h4>Tender Commissioning Details</h4>
                                </th>
                            </tr>
                        </thead>
                        <tr class="text-center">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Name</th>
                            <th>State</th>
                            <th>Scheduled commissioning Date (as per PPA)</th>
                            <th>Scheduled commissioning Date (Revised/ extended)</th>
                            <th>Commissioned Capacity (MW)</th>
                            <th>Actual Commissioning Date</th>
                            <th>Actual commissioned Capacity (MW)</th>
                        </tr>

                        <tbody class="text-center">
                            @php $j=0; $class=""; @endphp
                            @foreach($reportData['commissioned'] as $rdata)
                            @php $i=0;$j++;
                            if($j%2==1){$class="bg-success1 text-light1";}
                            @endphp
                            @foreach($rdata['commissionedData'] as $data)
                            @php $i++; @endphp
                            @if($i==1)
                            <tr class="{{$class}}">
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$j}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['bidder_name']}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['project_title']}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['state']}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">
                                    {{$general->dateFormat($rdata['schedule_commissiong_date'])}}
                                </td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">
                                    {{$general->dateFormat($rdata['revised_schedule_commissiong_date'])}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['commissioned_capacity']}}
                                </td>
                                <td>{{$general->dateFormat($data['actual_commissiong_date'])}}</td>
                                <td>{{$data['actual_commissioned_capacity']}}</td>
                            </tr>
                            @else
                            <tr class="{{$class}}">
                                <td>{{$general->dateFormat($data['actual_commissiong_date'])}}</td>
                                <td>{{$data['actual_commissioned_capacity']}}</td>
                            </tr>
                            @endif
                            @endforeach





                            @endforeach

                        </tbody>
                    </table>

                </td>
            </tr>
        </table>
        @endif
        @endif

        @endforeach
        <input type="button" value="Print" class="btn btn-primary text-center" id="print" onclick="PrintDiv();" />
    </main>

</section>

<script type="text/javascript">
function PrintDiv() {
    var divToPrint = document.getElementById('main');
    var popupWin = window.open('Report', '', 'width=1200,height=900');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}
</script>
@endsection