@extends('layouts.masters.backend')
@section('content')


<section class="section dashboard">

    <main id="main" class="main">




        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Gec Report Data</li>
                </ol>
            </nav>
        </div>
        <strong>
            <h1 class="text-center">Green Energy Coridor (GEC Phase II)</h1>
        </strong>
        <strong>
            <h4 class="text-center">Progress Report</h4>
        </strong>
        @include('layouts.partials.backend._flash')
        <form action="{{url(Auth::getDefaultDriver().'/progress-report')}}" method="post">@csrf
            <div class="col-md-12">
                <div class="col-md-3">
                    <label>Submitted On<span class="error">*</span></label>
                    <div class="input-group date">
                        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                            placeholder="MM-DD-YYYY" name="date" value="">
                    </div>
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-md btn-info pull-right" type="submit">Search</button>
            </div>
        </form>

        <div class="clearfix"></div><br>
        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/new-gec-progress-report')}}" class="btn btn-success"
            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Progress
            Report</a>

        <table class="table table-bordered">
            <tr class=" bg-dark text-light">
                <th>S.No</th>
                <th>Park Name</th>
                <th>State</th>
                <th>District</th>
                <th>Solar Power Park Developer</th>
                <th>Email ID</th>
                <th>Mobile Number</th>
                <th>Submitted On</th>
                <th>Status</th>
                <th>Remarks by MNRE</th>
                <th>Action</th>
            </tr>
            @if(!Empty($progressDetails))
            @php $generalData='' @endphp
            @foreach($progressDetails as $progressData)
            @php $generalData=json_decode($progressData['general']); @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                </td>
                <td></td>
                <td>@if($progressData->final_submission ==0)
                    <a href="{{URL::to(Auth::getDefaultDriver().'/application/progress_report/'.$progressData['id'])}}"
                        class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                    @else
                    <a href="{{URL::to(Auth::getDefaultDriver().'/preview-progress-report/'.$progressData['id'])}}"
                        class="btn btn-primary"><i class="fa fa-eye"></i></a>

                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="11">No Record Found</td>
            </tr>
            @endif
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
<style>
.error {
    color: red
}
</style>
<script src="{{asset('public/js/custom.js')}}"></script>