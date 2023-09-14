@inject('general', 'App\Http\Controllers\Backend\SNA\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>Tender Cancelled</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-primary text-light">
                                    <th>S.No</th>
                                    <th>Agency Name</th>
                                    <th>Tender No</th>
                                    <th width="15%">NIT No</th>
                                    <th>Scheme Type</th>
                                    <th width="20%">Tender Title</th>
                                    <th>Capacity(MW)</th>
                                    <th>Cancel Type</th>
                                    <th>Cancelled Capacity(MW)</th>
                                    <th>Cancelled Date</th>
                                    <th width="15%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cancelTenderList as $tender)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $tender->agency_name ?? '' }}</td>
                                    <td>{{ $tender->tender_no ?? '' }}</td>
                                    <td>{{ $tender->nit_no ?? '' }}</td>
                                    <td>{{ $tender->scheme_type ?? ''}}</td>
                                    <td>{{ $tender->tender_title ?? '' }}</td>
                                    <td>{{ $tender->capacity ?? '' }}</td>
                                    <td>{{ $tender->cancel_type ?? '' }}</td>
                                    <td>{{ $tender->cancel_capacity ?? '' }}</td>
                                    <td>{{ date("d M Y",strtotime($tender->cancel_date)) }}</td>
                                    <td>{{ $tender->cancel_remark ?? '' }}</td>

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