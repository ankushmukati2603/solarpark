@inject('general', 'App\Http\Controllers\Backend\MNRE\ReportController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>SNA Tender Details</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-success text-light">
                                    <th>S.No</th>
                                    <th>Tender No</th>
                                    <th width="15%">NIT No</th>
                                    <th>Scheme Type</th>
                                    <th width="20%">Tender Title</th>
                                    <th>Capacity(MW)</th>
                                    <th>Pre Bid Meeting</th>
                                    <th>Last Date of Bid Submission</th>
                                    <th>Tender Published Date</th>
                                    <th width="15%">MNRE Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($snaReportDetails as $tender)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tender->tender_no }}</td>
                                    <td>{{ $tender->nit_no }}</td>
                                    <td>{{ $tender->scheme_type}}</td>
                                    <td>{{ $tender->tender_title }}</td>
                                    <td>{{ $tender->capacity }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->pre_bid_meeting_date)) }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->bid_submission_date)) }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->nit_date)) }}</td>

                                    <td>{{ $tender->mnre_remarks ?? '--' }}</td>
                                    <td><a
                                            href=" {{URL::to(Auth::getDefaultDriver().'/Preview-Sna-Report/'.$general->encodeid($tender->id))}}">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
    </main>
</section>
<!-- </section> -->

@endsection