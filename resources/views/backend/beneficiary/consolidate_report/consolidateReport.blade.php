@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard form_sctn">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Consolidate Report Data</li>
                </ol>
            </nav>
        </div>
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1 class="text-center">Development of Solar Parks and Ultra Mega Solar Power Projects
                        <br>Consolidate Report
                    </h1>
                    <hr style="color: #959595;">
                    <form action="{{url(Auth::getDefaultDriver().'/consolidate-report')}}" method="post">@csrf
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>From</label></div>
                                <div class=""><input type="date" id="date" class="form-control" placeholder=""
                                        name="fromdata">
                                    <span class="text-danger">{{ $errors->first('fromDate') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>To</label></div>
                                <div><input type="date" id="date" class="form-control " placeholder="" name="todata">
                                    <span class="text-danger">{{ $errors->first('toDate') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Status</label></div>
                                <div><select name="status" class="form-control" id="status">
                                        <option value="" selected>Select Status</option>
                                        <option value="1">All</option>
                                        <option value="2">Submitted</option>
                                        <option value="3">Approved</option>
                                        <option value="4">Rejected</option>
                                        <option value="5">Send back for correct</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class=" pt-4 text-center1">
                                    <button class="btn btn-md btn-primary pull-right" type="submit">Search</button>
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/consolidate-report')}}"
                                        class="btn btn-danger">Reset</a>
                                </div>
                            </div>

                        </div>
                    </form>
                    <hr>
                    <table class="table table-bordered">
                        <tr class=" bg-primary text-light">
                            <th>S.No</th>
                            <th>Park Name</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Sub-District</th>
                            <th>Solar Power Park Developer</th>
                            <th>Email ID</th>
                            <th>Mobile Number</th>
                            <th>Submitted On</th>
                            <th>Status</th>
                            <!-- <th>Action Taken On</th>
                    <th>Remarks by MNRE</th> -->
                            <th>Action</th>
                        </tr>
                        @if(!empty($progressDetails))
                        @php $generalData=''; @endphp
                        @foreach($progressDetails as $progressData)
                        @php $generalData=json_decode($progressData['general']); @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $progressData['park_name'] }}</td>

                            <td>{{ $progressData['state_name'] }}</td>
                            <td>{{ $progressData['district_name'] }}</td>
                            <td>{{ $progressData['sub_district_name'] }}</td>
                            <td>{{ $generalData->park_developer_name ?? '' }}</td>
                            <td>{{ $generalData->email ?? ''}}</td>
                            <td>{{ $generalData->mobile_number ?? '' }}</td>
                            <td>{{ $progressData['submitted_on'] }}</td>
                            <td> @if($progressData['final_submission'] == '1')
                                <span>Submitted</span>
                                @else
                                <span>Draft</span>
                                @endif
                            </td>
                            <!-- <td></td>
                    <td></td> -->
                            <td>
                                <a href="{{URL::to(Auth::getDefaultDriver().'/preview-consolidate-report/'.$progressData['id'])}}"
                                    class="btn btn-primary btn-sm "><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </main>
</section>
@endsection
<script src="{{asset('public/js/custom.js')}}"></script>