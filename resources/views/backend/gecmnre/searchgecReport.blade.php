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
        <form action="{{url(Auth::getDefaultDriver().'/gec-progress-report')}}" method="post">@csrf
            <div class="col-md-12">

                <div class="col-md-3 col-sm-12">
                    <label>Submitted On<span class="text-danger">*</span></label>
                    <div class="input-group date">
                        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                            placeholder="MM-DD-YYYY" name="date" value="">
                    </div>
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                </div>
            </div>
            <!-- <div class="clearfix"></div><br> -->
            <div class="col-md-3 col-sm-12">
                <label>project Under Package<span class="text-danger">*</span></label>
                <input type="text" name="project_under_package" placeholder="Name" id="txtName" class="form-control "
                    value="{{$generalData->project_under_package ?? ''}}">
                <span class="text-danger">{{ $errors->first('project_under_package') }}</span>
            </div>
            <div class="col-md-3 col-sm-12">
                <label>Package Name<span class="error"></span></label>
                <input type="text" name="package_name" id="txtgeneralLatitude" class="form-control"
                    value="{{$generalData->package_name ?? ''}}">
                <span class="text-danger">{{ $errors->first('package_name') }}</span>
            </div>
            <div class="col-md-2">
                <button class="btn btn-md btn-info pull-right" type="submit">Search</button>
            </div>
        </form>

        <div class="clearfix"></div><br>

        <table class="table table-bordered">
            <tr class=" bg-dark text-light">
                <th>S.No</th>
                <th>Package Number</th>
                <th width="15%">Package Name</th>
                <th>Project Under Package</th>
                <th>Project Type</th>
                <th>DPR Cost</th>
                <th>Awarded Cost</th>
                <!-- <th>Mobile Number</th> -->
                <th>Package Expenditure</th>
                <th>Financial Progress</th>
                <th>Forest Clearance Details</th>
                <th>Action</th>
            </tr>
            @foreach($progressDetails as $progressDetails)

            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$progressDetails->package_no }}</td>
                <td>{{$progressDetails->package_name }}</td>
                <td>{{$progressDetails->project_under_package }}</td>
                <td>{{$progressDetails->project_type }}</td>
                <td>{{$progressDetails->dpr_cost }}</td>
                <td>{{$progressDetails->awarded_cost }}</td>
                <!-- <td>{{$progressDetails->awarded_cost }}</td> -->
                <td>{{$progressDetails->package_expenditure }}</td>
                <td>{{$progressDetails->financial_progress }}</td>
                <td>{{$progressDetails->forest_clearance_details }}</td>
                <td>@if($progressDetails['final_submission']==0)
                    <a href="{{URL::to(Auth::getDefaultDriver().'/application/progress_report/'.$progressDetails['id'])}}"
                        class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                    @else
                    <a href="{{URL::to(Auth::getDefaultDriver().'/preview-gec-report/'.$progressDetails['id'])}}"
                        class="btn btn-primary"><i class="fa fa-eye"></i></a>

                    @endif
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