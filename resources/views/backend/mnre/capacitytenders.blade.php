@inject('general', 'App\Http\Controllers\Backend\SNA\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Capacity Tendered</h1>
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
                                    <th>Published Date</th>
                                    <th width="10%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tenderList as $tender)
                                <?php
                            $countLocations=\App\Models\SelectedBidderProject::where('tender_id',$tender->id)->count();
                            $countCommissionedLocations=\App\Models\SelectedBidderProject::where('tender_id',$tender->id)->whereNotNull('commissioned_details')->count();
                            
                            ?>
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $tender->tender_no }}</td>
                                    <td>{{ $tender->nit_no }}</td>
                                    <td>{{ $tender->scheme_type}}</td>
                                    <td>{{ $tender->tender_title }}</td>
                                    <td>{{ $tender->capacity }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->pre_bid_meeting_date)) }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->bid_submission_date)) }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->nit_date)) }}</td>
                                    <td>{{$general->tenderStatus($tender->tender_status,$tender->id)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</section>
@endsection