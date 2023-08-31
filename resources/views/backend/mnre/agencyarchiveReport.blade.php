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
                    <li class="breadcrumb-item active"><a
                            href="{{URL::to(Auth::getDefaultDriver().'/view-agency-archive-report')}}">View Archive
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
            <form action="{{URL::to(Auth::getDefaultDriver().'/agency-archive-report')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <div class="row col-md-12">
                            <div class="col-md-12">

                                <h3> Add Archive Agencies Report</h3>
                            </div>

                            <th width="20%">
                                <label for="name" class="pb-2">
                                    Select Report Type <span class="text-danger">*</span>

                                </label>
                            </th>
                            <td colspan="2">
                                <select name="report_type" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Detailed Report</option>
                                    <option value="2">Financial Year Report</option>
                                </select>
                            </td>
                    </tr>
                    <!-- <tr id="report_type" style="display:none">
                        <td></td>
                        <td>
                            <label class="form-check-label">
                                <input type="radio" name="report" value="new_report" checked> Add Report
                            </label>
                            <label class="form-check-label">
                                <input type="radio" name="report" value="rooftop_report">Solar Rooftop
                                Report
                            </label>
                        </td>

                    </tr> -->
                    <tr>
                        <th><label for="">Select Month And Year</label></th>
                        <td colspan="2">
                            <input type="date" class="form-control" name="select_year" style="width:60%">
                        </td>

                    </tr>
                    <tr>
                        <th><label for="">Select SNA</label></th>
                        <td colspan="2">
                            <select class="form-control" name="sna_name">
                                <option value="0" selected>Select</option>
                                @foreach($agencyusersDetail as $agencyusersDetail)
                                <option value="{{$agencyusersDetail->id }}">
                                    {{$agencyusersDetail->name }}@if($agencyusersDetail->sna_type ==0)
                                    (OLD)
                                    @else
                                    (NEW)
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <th><label for="">Upload Report <span class="text-primary">(Upload Only CSV and Excel
                                    format)</span><span class="text-danger">*</span></label></th>
                        <td colspan="2">

                            <input type="file" class="form-control" name="upload_file">
                        </td>
                    </tr>


                </table>
                <button type="submit" value="Submit" name="submit" class="btn btn-flat btn-success">Submit</button>
            </form>
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