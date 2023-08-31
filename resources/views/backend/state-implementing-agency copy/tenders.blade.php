@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tender Management</h1>
        </div>
        <section class="section dashboard">


            <div class="clearfix"></div><br>
            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Tenders/Add')}}" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-primary text-light">
                    <th>S.No</th>
                    <th>Tender No</th>
                    <th width="20%">NIT No</th>
                    <th>Scheme Type</th>
                    <th width="20%">Tender Title</th>
                    <th>Capacity(MW)</th>
                    <th>Pre Bid Meeting</th>
                    <th>Last Date of Bid Submission</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($tenderList as $tender)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $tender->tender_no }}</td>
                    <td>{{ $tender->nit_no }}</td>
                    <td>{{ $tender->scheme_type}}</td>
                    <td>{{ $tender->tender_title }}</td>
                    <td>{{ $tender->capacity }}</td>
                    <td>{{ date("d M Y",strtotime($tender->pre_bid_meeting_date)) }}</td>
                    <td>{{ date("d M Y",strtotime($tender->bid_submission_date)) }}</td>
                    <td>
                        @if($tender->tender_status ==1)
                        Tender
                        @elseif($tender->tender_status ==2)
                        Partially Implementation
                        @else

                        @endif

                    </td>
                    <td><a href=" {{URL::to(Auth::getDefaultDriver().'/developer/Edit/'.$tender['id'])}}"
                            class="btn btn-primary">Edit</a> </td>
                </tr>
                @endforeach
                <!-- <tr>
                    <td colspan="11">No Record Found</td>
                </tr> -->
            </table>
    </main>
</section>
<!-- </section> -->
@endsection