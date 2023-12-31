@inject('general', 'App\Http\Controllers\Backend\REIA\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1 class="text-center">Monthly Progress Report For REIAs </h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered table-striped text-left">
                            <tr>
                                <th colspan="4">
                                    <h1>Application Detail : {{$data->month ?? ''}}, {{$data->year ?? ''}}</h1>
                                    <a href="{{ URL::to(Auth::getDefaultDriver().'/progress-report')}}"
                                        class="btn btn-success" style="float:right">Back</a>
                                </th>
                            </tr>
                            <tr>
                                <th>Name of Scheme</th>
                                <td>{{$data['scheme_name']}}</td>
                                <th>State</th>
                                <td>{{$data->state_name ?? ''}}</td>

                            </tr>
                            <tr>
                                <th>District</th>
                                <td>{{$data->district_name ?? ''}}</td>
                                <th>Type of Project</th>
                                <td>{{$data->project_type ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Tender Capacity (MW)</th>
                                <td>{{$data->tender_capacity ?? ''}}</td>
                                <th>Date of Tender</th>
                                <td>{{date('d-m-Y', strtotime($data->tender_date ?? ''))}}</td>
                            </tr>
                            <tr>
                                <th>Date of LOA</th>
                                <td>{{date('d-m-Y', strtotime($data->loa_date ?? ''))}}</td>
                                <th>SCoD</th>
                                <td>{{date('d-m-Y', strtotime($data->scod ?? ''))}}</td>
                            </tr>
                            <tr>
                                <th>Present Status</th>
                                <td>{{$data->remark ?? ''}}</td>
                                <th></th>
                                <td></td>
                            </tr>
                            <tr class="bg-primary text-light">
                                <td colspan="4">
                                    <h3>Bidder Details</h3>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Bidder Name</th>
                                            <th>Bidder Capacity (MW)</th>
                                            <th>Date of PPA</th>
                                            <th>PPA Capacity (MW)</th>
                                        </tr>

                                        @for ($i = 0; $i < count($data['bidder_id']); $i++) <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{ $general->getBidderName($data['bidder_id'][$i]) }}</td>
                                            <td>{{ $data['select_bidders_capacity'][$i] }}</td>
                                            <td>{{ $data['ppa_date'][$i] }}</td>
                                            <td>{{ $data['ppa_capacity'][$i] }}</td>
                            </tr>

                            @endfor
                        </table>
                        </td>
                        @if($data->mnre_remarks!='')
                        <tr class="bg-primary text-light">
                            <td colspan="4">
                                <h3>MNRE Remark</h3>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3">Present Status : {{$data->mnre_remarks ?? ''}}</th>
                            <th colspan="2">Date/Time : {{$data->mnre_remark_date ?? ''}}</th>
                        </tr>
                        @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
@endsection
@push('backend-js')

@endpush
<style>
.error {
    color: red
}
</style>
<!-- <script src="{{asset('public/js/custom.js')}}"></script> -->