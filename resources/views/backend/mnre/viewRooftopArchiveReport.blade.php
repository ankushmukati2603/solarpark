@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <!-- <h1>Dashboard</h1> -->
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Archive
                            Report</a></li>

                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <form action="{{URL::to(Auth::getDefaultDriver().'/')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <div class="row col-md-12">
                            <div class="col-md-12">

                                <h3> Add Archive Agencies Report</h3>
                                <a href="{{URL::to(Auth::getDefaultDriver().'/agency-archive-report')}}"
                                    style=float:right; class="btn btn-primary">Add Archive
                                    Solar Rooftop Report</a>
                            </div>

                    <tr><br>
                        <th><label for="">Select SNA</label></th>
                        <td>
                            <select class="form-control" name="sna_name">
                                <option value="0" selected>Select</option>
                                @foreach($agencyReport as $agencyReport)
                                <option value="{{$agencyReport->id }}">
                                    {{$agencyReport->name }}@if($agencyReport->sna_type ==0)
                                    (OLD)
                                    @else
                                    (NEW)
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="submit" name="" value="search" class="form-control"></td>
                    </tr>

                </table>

            </form>
            <table class="table table-bordered">
                <tr>
                    <th>S No.</th>
                    <th>Year of Report</th>
                    <th>SNA Name</th>
                    <th>Solar Park Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Commissioning Date</th>
                    <!-- <th>Email</th>
                    <th>project Capacity</th>
                    <th>Project Location</th>
                    <th>project Tehsil</th> -->
                    <th>Action</th>
                </tr>
                @foreach($solarrooftopReport as $solarrooftopReport)
                <!-- @php $total = 0;
                $total=$solarrooftopReport->gm_capacity + $solarrooftopReport->rooftop_capacity;
                @endphp -->
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <!-- <td>{{ $solarrooftopReport->upto_date }}</td> -->
                    <td>{{ $solarrooftopReport->year }}</td>
                    <td>{{ $solarrooftopReport->sna_name }}</td>
                    <td>{{ $solarrooftopReport->solar_park_name }}</td>
                    <td>{{ $solarrooftopReport->mobile_number }}</td>
                    <td>{{ $solarrooftopReport->email }}</td>
                    <td>
                        {{$solarrooftopReport->commissioning_date}}
                    </td>
                    <td><a
                            href="{{URL::to(Auth::getDefaultDriver().'/preview-archive-snareport/'.$solarrooftopReport->id)}}">View</a>
                    </td>

                </tr>
                @endforeach
            </table>
    </main>
</section>
@include('modals.consumerInstallerAssociation')
@endsection
@push('backend-js')
<script>
$(document).ready(function() {
    $('input[type=radio][name=report_type]').change(function() {
        $("#report_type").hide();
        if (this.value == 1) {

        } else if (this.value == 2) {

        } else if (this.value == 3) {

            $("#report_type").show('slow');

        }
    });
});
$(document).ready(function() {
    $('input[type=radio][name=report]').change(function() {
        // $("#report_type").hide();
        $("#month_id").show();
        if (this.value == 'new_report') {

        } else if (this.value == 'rooftop_report') {
            $("#year_id").show('slow');
            $("#month_id").hide();
        }
    });
});
</script>
@endpush