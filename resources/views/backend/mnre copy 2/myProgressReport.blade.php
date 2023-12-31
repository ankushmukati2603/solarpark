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
        <form action="{{url(Auth::getDefaultDriver().'/progress-report')}}" method="post">@csrf
            <div class="col-md-12">
                <div class="col-md-3">
                    <label>State<span class="error"></span></label>
                    <select class="form-control  select" id="txtState" name="state"
                        onchange="getDistrictByState(this.value,'')">
                        <option disabled selected>Select State</option>
                        @foreach($states as $state)
                        <option value="{{$state->code }}" @if(isset($generalData['general']['state'] ) && $state->
                            code==$generalData['general']['state'])selected
                            @endif>
                            {{$state->name }}
                        </option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                </div>
                <div class="col-md-3">
                    <label>District<span class="error"></span></label>
                    <select class="form-control  select" id="district_id" name="district_id"
                        onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                        <option value="" selected>Select District</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                </div>
                <div class="col-md-3">
                    <label>Submitted On<span class="error">*</span></label>
                    <div class="input-group date">
                        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                            placeholder="MM-DD-YYYY" name="date" value="">
                    </div>
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="col-md-3 col-sm-12">
                <label>Park Name<span class="error">*</span></label>
                <input type="text" name="park_name" placeholder="Name" id="txtName" class="form-control "
                    value="{{$generalData['general']['park_name'] ?? ''}}">
                <span class="text-danger">{{ $errors->first('park_name') }}</span>
            </div>
            <div class="col-md-3 col-sm-12">
                <label>Approved Capacity (in MW)<span class="error">*</span></label>
                <input type="number" step="any" min="0" name="capacity" id="txtgeneralLatitude" class="form-control"
                    value="">
                <span class="text-danger">{{ $errors->first('capacity') }}</span>
            </div>
            <div class="col-md-2">
                <button class="btn btn-md btn-info pull-right" type="submit">Search</button>
            </div>

            <!-- <div class="col-md-3 col-sm-12">
        <label>Park Name<span class="error">*</span></label>
        <input type="text" name="park_name" placeholder="Park Name" id="txtName" class="form-control "
            value="{{$generalData['general']['park_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('park_name') }}</span>
    </div> -->
        </form>

        <div class="clearfix"></div><br>
        <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/new-progress-report')}}" class="btn btn-success"
    style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Progress
    Report</a> -->

        <table class="table table-bordered">
            <tr class=" bg-dark text-light">
                <th>S.No</th>
                <th>Park Name</th>
                <th width="15%">Progress Report (Month , Year)</th>
                <th>State</th>
                <th>District</th>
                <th>Solar Power Park Developer</th>
                <th>Email ID</th>
                <th>Mobile Number</th>
                <!-- <th>Approved Capacity (in MW)</th> -->
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
                <td>{{ $progressData['park_name'] }}</td>
                <td>
                    {{date("F", mktime(0, 0, 0, $progressData['month'], 10))}},
                    {{$progressData['year']}}
                </td>
                <td>{{ $progressData['state_name'] }}</td>
                <td>{{ $progressData['district_name'] }}</td>
                <td>{{ $generalData->park_developer_name }}</td>
                <td>{{ $generalData->email ?? ''}}</td>
                <td>{{ $generalData->mobile_number }}</td>
                <td>{{ $progressData['submitted_on'] }}</td>
                <td> @if($progressData['final_submission'] == '1')
                    <span>Submitted</span>
                    @else
                    <span>Draft</span>
                    @endif
                </td>
                <td></td>
                <td>@if($progressData['final_submission']==0)
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

            <!-- <a href=" {{URL::to('developerData')}}">Form</a> -->
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