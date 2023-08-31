@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Recieved Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Recieved Report</li>
                </ol>
            </nav>
        </div>
        <strong>
            <h1 class="text-center">Recieved Report</h1>
        </strong>
        <strong>
            <h4 class="text-center">Development of Solar Parks and Ultra Mega Solar Power Projects</h4>
        </strong><br>

        @if(session()->has('message'))
        <div class="alert alert-dark">
            {{ session()->get('message') }}
        </div>
        @endif


        <div class="clearfix"></div><br>

        <table class="table table-bordered">
            <tr class=" bg-primary text-light">
                <th>S.No</th>
                <th>Park Name</th>
                <th width="15%">Progress Report (Month , Year)</th>
                <th>State</th>
                <th>District</th>
                <th>Capacity</th>
                <th>Submitted On</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach($applicationDetail as $solarParkData)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $solarParkData['park_name'] }}</td>
                <td>
                    {{date("F", mktime(0, 0, 0, $solarParkData['month'], 10))}},
                    {{$solarParkData['year']}}
                </td>
                <td>{{ $solarParkData['state_name'] }}</td>
                <td>{{ $solarParkData['district_name'] }}</td>
                <td>{{ $solarParkData->capacity }}</td>
                <td>{{ $solarParkData['submitted_on'] }}</td>
                <td> @if($solarParkData['final_submission'] == '1')
                    <span>Submitted</span>
                    @else
                    <span>Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{URL::to(Auth::getDefaultDriver().'/preview-progress-report/'.$solarParkData['id'])}}"
                        class="btn btn-primary"><i class="fa fa-eye"></i></a>


                </td>
            </tr>
            @endforeach

        </table>

        <style>
        .col-md-3 {
            display: inline-block;
        }

        .col-md-2 {
            display: inline-block;
        }
        </style>
    </main>
</section>
@endsection
<script src="{{asset('public/js/custom.js')}}"></script>