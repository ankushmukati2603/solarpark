@extends('layouts.masters.backend')
@section('content')


<section class="section dashboard form_sctn">
    <main id="main" class="main">
        <div class="pagetitle">

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Progress Report</li>
                </ol>
            </nav>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-dark">
            {{ session()->get('message') }}
        </div>
        @endif



        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1 class="text-center">Development of Solar Parks and Ultra Mega Solar Power Projects <br>
                        <h4 class="text-center">Progress Report</h4>
                    </h1>

                    <a href="javascript:;" onclick="$('#advance_search').toggle()"
                        style="color:blue;float:right">Advance
                        Search</a>
                    <form action="{{url(Auth::getDefaultDriver().'/my-progress-report')}}" method="post"
                        style="display:none" id="advance_search">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>State </label></div>
                                <div class=""><select class="form-control  select" id="txtState" name="state"
                                        onchange="getDistrictByState(this.value,'')">
                                        <option disabled selected>Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->code }}" @if(isset($generalData['general']['state'] )
                                            && $state->
                                            code==$generalData['general']['state'])selected
                                            @endif>
                                            {{$state->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>District </div>
                                <div class=""><select class="form-control  select" id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                        <option value="" selected>Select District</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Submitted On </div>
                                <div class=""> <input type="date" class="form-control pull-right alldatepicker "
                                        id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="date" value="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Park Name </div>
                                <div class=""><input type="text" name="park_name" placeholder="Name" id="txtName"
                                        class="form-control " value="{{$generalData['general']['park_name'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Approved Capacity (in MW) </div>
                                <div class=""><input type="number" step="any" min="0" name="capacity"
                                        id="txtgeneralLatitude" class="form-control" value="">
                                    <span class="text-danger">{{ $errors->first('capacity') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3"><br>
                                <button class="btn btn-md btn-info pull-right" type="submit">Search</button>

                            </div>


                        </div>
                    </form>
                    <hr>
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>

                                <th>S.No</th>
                                <th>Park Name</th>
                                <th>Month, Year</th>
                                <th>State</th>
                                <th>District</th>
                                <th>SPPD</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Remarks by MNRE</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!Empty($progressDetails))
                            @php $generalData='' @endphp
                            @foreach($progressDetails as $progressData)
                            @php $generalData=json_decode($progressData['general']); @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $progressData['park_name'] }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $progressData['month'], 10)) }},
                                    {{ $progressData['year'] }}
                                </td>
                                <td>{{ $progressData['state_name'] }}</td>
                                <td>{{ $progressData['district_name'] }}</td>
                                <td>{{ $generalData->park_developer_name ?? '' }}</td>
                                <td>{{ $generalData->email ?? ''}}</td>
                                <td>{{ $generalData->mobile_number ?? '' }}</td>
                                <td>
                                    @if($progressData['submitted_on'] == '')
                                    Not Submitted Yet
                                    @else
                                    {{$progressData['submitted_on']}}
                                    @endif

                                </td>
                                <td> @if($progressData['final_submission'] == '1')
                                    Submitted
                                    @else
                                    Draft
                                    @endif
                                </td>
                                <td> @if($progressData['remarks'] == '')
                                    No Remark Yet
                                    @else
                                    {{$progressData['remarks']}}
                                    @endif
                                </td>
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

                            @endif
                        </tbody>
                    </table><br>
                    <span class="text-center"><a href="{{URL::to('/'.Auth::getDefaultDriver().'/new-progress-report')}}"
                            class="btn btn-success" style="margin-right:5px;"><i class="fa fa-plus"
                                aria-hidden="true"></i>Progress Report</a></span>
                </div>
            </div>
        </div>

    </main>
</section>

@endsection

<script src="{{asset('public/js/custom.js')}}"></script>