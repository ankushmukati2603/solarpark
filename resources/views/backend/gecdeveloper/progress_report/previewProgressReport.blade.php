@extends('layouts.masters.backend')
@section('content')
@section('title', 'Received Report')

<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>GEC Report Preview
                        </h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr>
                                <th width="25%">Report Date (Month/Year)</th>
                                <td>{{$gecReportData->month}}/{{$gecReportData->year}}</td>
                            </tr>
                            <tr>
                                <th>Package Name</th>
                                <td>{{$gecReportData->package_name ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Project Type</th>
                                <td>
                                    @if($gecReportData->project_type==1)
                                    Line
                                    @elseif($gecReportData->project_type==2)
                                    SS
                                    @elseif($gecReportData->project_type==3)
                                    Bays
                                    @elseif($gecReportData->project_type==4)
                                    Reactors
                                    @elseif($gecReportData->project_type==5)
                                    Procurement work
                                    @else
                                    Other
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Project Under Package</th>
                                <td>{{$gecReportData->project_under_package ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Mnre Sanction Date</th>
                                <td>{{$gecReportData->mnre_sanction_date ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Tender Notice Date</th>
                                <td>{{$gecReportData->tender_notice_date ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Last Submission Date</th>
                                <td>{{$gecReportData->last_submission_date ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Technical Bid Opening Date</th>
                                <td>{{$gecReportData->technical_bid_opening_date ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Financial Bid Opening Date</th>
                                <td>{{$gecReportData->financial_bid_opening_date ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Award Package Date</th>
                                <td>{{$gecReportData->award_package_date ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>DPR Cost(In Cr.)</th>
                                <td>{{$gecReportData->dpr_cost ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Awarded Cost(In Cr.)</th>
                                <td>{{$gecReportData->awarded_cost ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Package Expenditure Cost</th>
                                <td>{{$gecReportData->package_expenditure ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Financial Progress</th>
                                <td>{{$gecReportData->financial_progress ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Land Details</th>
                                <td>{{$gecReportData->land_detail ?? '--'}}</td>
                            </tr>
                            <tr>
                                <th>Forest Clearance Details</th>
                                <td>{{$gecReportData->forest_clearance_details ?? '--'}}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

    </main>

</section>

@endsection