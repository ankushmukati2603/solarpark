@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Monthly Progress Report Preview For REIAs/States</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Monthly Progress Report Preview For REIAs/States</li>
                </ol>
            </nav>
        </div>
       
        <strong>
            <h4 class="text-center">Monthly Progress Report Preview For REIAs/States</h4>
        </strong>
        @include('layouts.partials.backend._flash')
        <form action="{{url(Auth::getDefaultDriver().'/previewprogressreport/{id}')}}" method="post">
            @csrf

        </form>
        <table class="table table-bordered display nowrap" id="example" >
            <thead>
            <tr class="bg-dark text-dark">
             
                <th>Name of Scheme</th>
                <th>State</th>
                <th>District</th>
                <th>Type of Project</th>
                <th>Tender Capacity( MW )</th>
                <th>Date of Tender</th>
                <th>Date of LOA</th>
                <th>Bidder Name</th>
                <th>Bidder Capacity</th>
                <th>Date of PPA</th>
                <th>PPA Capacity</th>
                <th>SCoD</th>
                <th>Present Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
               
                <td>{{$progressDetails->scheme_name}}</td>
                <td>{{$progressDetails->state_name}}</td>
                <td>{{$progressDetails->district_name}}</td>
                <td>{{$progressDetails->project_type}}</td>
                <td>{{$progressDetails->tender_capacity}}</td>
                <td>{{$progressDetails->tender_date}}</td>
                <td>{{$progressDetails->loa_date}}</td>
                <td>{{$progressDetails->bidder_name}}</td>
                <td>{{$progressDetails->bidder_capacity}}</td>
                <td>{{$progressDetails->ppa_date}}</td>
                <td>{{$progressDetails->ppa_capacity}}</td>
                <td>{{$progressDetails->scod}}</td>
                <td>{{$progressDetails->status}}</td> 
            </tr>
            </tbody>
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
