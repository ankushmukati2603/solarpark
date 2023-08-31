@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <div class="pagetitle">

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active"><a
                            href="{{URL::to(Auth::getDefaultDriver().'/recieved-progress-report')}}">Progress
                            Report Data</a></li>
                </ol>
            </nav>
        </div>

        <strong class="md-3">
            <h3 class="text-center">Development of Solar Parks and Ultra Mega Solar Power Projects</h3>
            <hr><br>
        </strong>

        @if(session()->has('message'))
        <div class="alert alert-dark">
            {{ session()->get('message') }}
        </div>
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
        @endforeach
        @endif
        <form action="{{url(Auth::getDefaultDriver().'/recieved-progress-report')}}" method="post">@csrf
            <div class="col-md-12">
                <table class="table table-bordered1">
                    <tr class="bg-primary text-light">
                        <td colspan="4">Advance Search</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="" class="font-weight-bold">Select Report Type <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="report_type" onchange="showsubcategory(this.value)">
                                <option value="">~~~~~~Select~~~~~~</option>
                                <option value="1">Tender</option>
                                <option value="2">Under Implementation</option>
                                <option value="3">Commissioning</option>
                            </select>
                        </td>

                        <td colspan="2">
                            <span id="subReport" style="display:none">
                                <label>Select Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="report_sub_type" id="report_sub_type"
                                    onchange="hideAdvanceSearch(this.value)">
                                    <option value="">~~~~~~Select~~~~~~</option>
                                    <option value="new_report">New Report</option>
                                    <option value="rooftop_report">Rooftop Report</option>
                                </select>
                            </span>
                        </td>

                    </tr>
                    <tr id="searchBox">
                        <td width="25%">
                            <label>Agency Name</label>
                            <input type="text" name="agency_name" placeholder="Enter Agency" id="txtName"
                                class="form-control " value="{{$generalData['general']['agency_name'] ?? ''}}">
                        </td>
                        <td width="25%">
                            <label>State<span class="error"></span></label>
                            <select class="form-control  select" id="txtState" name="state"
                                onchange="getDistrictByState(this.value,'')">
                                <option disabled selected>Select State</option>
                                @foreach($states as $state)
                                <option value="{{$state->code }}">
                                    {{$state->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td width="25%">
                            <label>District<span class="error"></span></label>
                            <select class="form-control  select" id="district_id" name="district_id">
                                <option value="" selected>Select District</option>
                            </select>
                        </td>
                        <td width="25%">
                            <label>Submitted On</label>
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right alldatepicker "
                                    id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="date" value="">
                            </div>
                        </td>
                    </tr>

                    <tr>

                        <td colspan="4">
                            <button class="btn btn-md btn-primary mt-3 " type="submit">Search</button>
                            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/recieved-progress-report')}}"
                                class="btn btn-danger mt-3 "><i class="fa fa-refresh " aria-hidden="true"></i>
                                Reset</a>

                        </td>
                    </tr>
                </table>

            </div>

        </form>
        <div class="clearfix"></div><br>
        <table class="table table-bordered">
            @if(!Empty($tenderDetails))
            @if($tenderDetails[1]['report_type']==3 && $tenderDetails[1]['report_sub_type']=='rooftop_report')
            @include('backend/state-implementing-agency/commisioning/_searchListRoofTop')

            @else



            @include('backend/state-implementing-agency/commisioning/_searchListOther')


            @endif

            <!-- <a href=" {{URL::to('developerData')}}">Form</a> -->
            @else
            <tr>
                <td colspan="11">No Record Found</td>
            </tr>
            @endif
            <!-- Endif for  rooftop_report condition-->
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
<script>
function showsubcategory(val) {
    $('#subReport').hide();
    $('#searchBox').show();
    if (val == 3) {
        $('#subReport').show();


    }

}

function hideAdvanceSearch(val) {
    $('#searchBox').show();
    if (val == 'rooftop_report') {
        $('#searchBox').hide();
    }
}
</script>
<script src="{{asset('public/js/custom.js')}}"></script>