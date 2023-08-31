<style>
.heading {
    text-align: left;
    font-size: 15px;
    background-color: lightblue;
}

table,
th,
td {
    border: 1px solid #ccc;
    text-align: left;
    border-collapse: collapse;
    padding: 4px;
    width: 100%;
    font-size: 12px;
}

th {
    font-weight: bold;
}

.bg-success {
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
</style>
@foreach($reportData['timeline'] as $data)

<div id="divToPrint">
    @if($data=='tender')
    @if(!empty($reportData['tender']))
    <table>
        <tr>
            <th colspan="4">
                <h3 class="text-center">Tender ID : {{$reportData['tender']['tender_no'] ?? '--'}}</h3>
            </th>
        </tr>

        <tr>
            <th colspan="4" class="heading bg-success text-light">
                Tender Details
                <span style="float:right">Published On
                    :{{date('d M Y', strtotime($reportData['tender_submitted_on'])) ?? ''}}
                </span>
            </th>
        </tr>
        <tr>
            <th width="20%">Tender NIT</th>
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
            <td colspan="3">{{$reportData['tender']['agency_name'] ?? '--'}}</td>
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


    @if($data=='ppapsa')
    @if(!empty($reportData['ppapsa']))
    <table class="table table-bordered table-striped text-left">
        <tr>
            <th colspan="4" class="heading bg-info text-dark">
                PPA/PSA Details
                <span style="float:right">Submitted On
                    :{{date('d M Y', strtotime($reportData['ppapsa_submitted_on'])) ?? ''}}
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
                        <th>PPA/PSA Date</th>
                        <th>PPA/PSA Signed State</th>
                        <th>PPA/PSA Duration</th>
                        <th>Electricity Per Unit Cost</th>
                    </tr>
                    @foreach($reportData['ppapsa'] as $bidder)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$bidder['bidder_name'] ?? '--'}}</td>
                        <td>{{$bidder['project_title'] ?? '--'}}</td>
                        <td>{{$bidder['state'] ?? '--'}}</td>
                        <td>@if($bidder['ppa_psa_date']!=''){{date('d M Y', strtotime($bidder['ppa_psa_date'])) ?? ''}}
                            @else
                            -- @endif</td>
                        <td>{{$bidder['signed_state'] ?? '--'}}</td>
                        <td>{{$bidder['duration_ppa'] ?? '--'}}</td>
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
            <td>{{$reportData['ra']['ra_capacity'] ?? '0'}}</td>
        </tr>
        <tr>
            <th>RA Date</th>
            <td>{{date('d M Y', strtotime($reportData['ra']['ra_date'])) ?? ''}}</td>
            <th>Awarded Capacty(MW)</th>
            <td>{{$reportData['ra']['capacity_awarded'] ?? '0'}}</td>

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
                <table class="table table-bordered table-striped">
                    <tr class="bg-gray text-dark">
                        <th>S.No</th>
                        <th>Bidder Name</th>
                        <th>Project Title</th>
                        <th>State</th>
                        <th>Schedule Commissiong Date</th>
                        <th>Commissioned Capacity (MW)</th>
                        <th>Actual Commissiong Date</th>
                        <th>Actual Commissioned Capacity (MW)</th>
                    </tr>
                    @foreach($reportData['commissioned'] as $bidder)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$bidder['bidder_name'] ?? '--'}}</td>
                        <td>{{$bidder['project_title'] ?? '--'}}</td>
                        <td>{{$bidder['state'] ?? '--'}}</td>
                        <td>@if($bidder['loi_loa_date']!=''){{date('d M Y', strtotime($bidder['loi_loa_date'])) ?? ''}}
                            @else
                            -- @endif</td>
                        <td>{{$bidder['commissioned_capacity'] ?? '--'}}</td>
                        <td>@if($bidder['actual_commissiong_date']!=''){{date('d M Y', strtotime($bidder['actual_commissiong_date'])) ?? ''}}
                            @else
                            -- @endif</td>
                        <td>{{$bidder['actual_commissioned_capacity'] ?? '--'}}</td>
                    </tr>

                    @endforeach
                </table>
            </td>
        </tr>
    </table>

    @endif
    @endif

    @endforeach

</div>