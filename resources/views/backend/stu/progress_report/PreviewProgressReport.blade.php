@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <strong>
            <h4 class="text-center">Monthly Progress Report Preview</h4>
        </strong>

        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                </th>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-green text-light">
                    General
                </th>
            </tr>
            <tr>
                <th>Tender/ Bidding Agency for RE Projects</th>
                <td>{{$data['tender_bidding_agency']}}</td>
                <th>Project Details(Name of Developer)</th>
                <td>{{$data->developer_name ?? ''}}</td>
            </tr>
            <tr>
                <th>Capacity for connectivity applied (MW)</th>
                <td>{{$data->capacity_connectivity ?? ''}}</td>
                <th>State</th>
                <td>{{$data->state_name ?? ''}}</td>
            </tr>
            <tr>
                <th>District</th>
                <td>{{$data->district_name ?? ''}}</td>
                <th>Sub Station Location District</th>
                <td>{{$data->sub_station ?? ''}}</td>
            </tr>
            <tr>
                <th>Connectivity Basis</th>
                <td>{{$data->connectivity_basis ?? ''}}</td>
                <th>LTA operationalization date </th>
                <td>{{date('d-m-Y', strtotime($data->lta_operationalization_date ?? ''))}}</td>
            </tr>
            <tr>
                <th>Capacity commissioned in the current month (MW)</th>
                <td>{{$data->capacity_commissioned ?? ''}}</td>
                <th>Cumulative Capacity Commissioned (MW)</th>
                <td>{{$data->cumulative_capacity ?? ''}}</td>
            </tr>
            <tr>
                <th>Cumulative Capacity Commissioned Date</th>
                <td>{{date('d-m-Y', strtotime($data->cumulative_capacity_date ?? ''))}}</td>
                <th>Remarks </th>
                <td>{{$data->remark ?? ''}}</td>
            </tr>
        </table>
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
<script src="{{asset('public/js/custom.js')}}"></script>