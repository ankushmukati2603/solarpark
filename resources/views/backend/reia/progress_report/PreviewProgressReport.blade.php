
@inject('general', 'App\Http\Controllers\Backend\REIA\MainController')
@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Monthly Progress Report Preview For REIAs/States</h1>
            
        </div>
       
        <strong>
            <h4 class="text-center">Monthly Progress Report Preview For REIAs/States</h4>
        </strong>
     

        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <!-- <h1>Application Detail</h1> -->
                    <!-- <a href="{{ URL::to(Auth::getDefaultDriver().'/my-progress-report')}}" class="btn btn-success"style="float:right">Back</a> -->
                </th>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-green text-light">
                    General
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
                <td colspan="4" >
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

                        @for ($i = 0; $i < count($data['bidder_id']); $i++)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{ $general->getBidderName($data['bidder_id'][$i]) }}</td>
                                <td>{{ $data['select_bidders_capacity'][$i] }}</td>
                                <td>{{ $data['ppa_date'][$i] }}</td>
                                <td>{{ $data['ppa_capacity'][$i] }}</td>
                            </tr> 
                        @endfor
                    </table>
                </td>
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
<!-- <script src="{{asset('public/js/custom.js')}}"></script> -->
