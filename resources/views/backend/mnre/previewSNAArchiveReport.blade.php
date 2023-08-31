@extends('layouts.masters.backend')
@section('content')
@section('title', 'Received Report')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<section class="section dashboard">

    <main id="main" class="main">



        <style>
        .heading {
            text-align: left;
            font-size: 25px;
            background-color: lightblue;
        }
        </style>
        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1>Archive SNA Report</h1>
                </th>
            </tr>
            <tr>
                <th>Year</th>
                <td>{{$Archivepreview->year ?? ''}}</td>
                <th>SNA Name</th>
                <td>{{$Archivepreview->sna_name ?? ''}}</td>

            </tr>
            <tr>
                <th>Developer Name</th>
                <td>{{$Archivepreview->developer_name ?? ''}}</td>
                <th>Solar Park Name</th>
                <td>{{$Archivepreview->solar_park_name ?? ''}}</td>
            </tr>
            <tr>
                <th>CEO Name</th>
                <td>{{$Archivepreview->ceo_name ?? ''}}</td>
                <th>Address</th>
                <td>{{$Archivepreview->address ?? ''}}</td>
            </tr>
            <tr>
                <th>Office Contact Number</th>
                <td>{{$Archivepreview->office_contact_number ?? ''}}</td>
                <th>Project Capacity (in MW)</th>
                <td>{{$Archivepreview->project_capacity}}</td>
            </tr>
            <tr>
                <th>Project Solar Park?l</th>
                <td>{{$Archivepreview->project_solarpark ?? ''}}</td>
                <th>Project Type</th>
                <td>{{$Archivepreview->project_type ?? ''}}</td>
            </tr>
            <tr>
                <th>Module Type</th>
                <td>{{$Archivepreview->module_type ?? ''}}</td>
                <th>Make Module</th>
                <td>{{$Archivepreview->make_module ?? ''}}</td>
            </tr>
            <tr>
                <th>Scheme From</th>
                <td>{{$Archivepreview->scheme_from ?? ''}}</td>
                <th>Email ID</th>
                <td>{{$Archivepreview->email ?? ''}}</td>
            </tr>
            <tr>
                <th>Project Location</th>
                <td>{{$Archivepreview->project_location ?? ''}}</td>
                <th>Mobile Number</th>
                <td>{{$Archivepreview->mobile_number ?? ''}}</td>
            </tr>


            <tr>
                <th>District</th>
                <td>{{$Archivepreview->project_district ?? ''}}</td>
                <th>Project-Tehsil-Taluka</th>
                <td>{{$Archivepreview->project_tehsil_taluka ?? ''}}</td>

            </tr>

            <tr>
                <th>Project Longitude</th>
                <td>{{$Archivepreview->project_longitude ?? ''}}</td>
                <th>Project Latitude</th>
                <td>{{$Archivepreview->project_latitude ?? ''}}</td>
            </tr>

            <tr>
                <th>Mode of Sale Power</th>
                <td>{{$Archivepreview->mode_of_sale_power ?? ''}}</td>
                <th>PPA Tenure </th>
                <td>{{$Archivepreview->ppa_tenure ?? ''}}</td>
            </tr>




            <tr>
                <th>Source of water for park</th>
                <td>{{$Archivepreview['water_facilities']['source_water'] ?? ''}}</td>
                <th>Substation Name</th>
                <td>{{$Archivepreview->substation_name ?? ''}}
                </td>
            </tr>
            <tr>
                <th>Substation Voltage Level</th>
                <td>{{$Archivepreview->substation_voltage_level ?? ''}}</td>
                <th>Feeder Name </th>
                <td>{{$Archivepreview->feeder_name ?? ''}}</td>
            </tr>
            <tr>
                <th>Feeder Voltage</th>
                <td>{{$Archivepreview->feeder_voltage ?? ''}}</td>
                <th>Commissioning AC Capacity </th>
                <td>{{$Archivepreview->commi_ac_capacity ?? ''}}</td>
            </tr>
            <tr>
                <th>Commissioning DC Capacity</th>
                <td> {{$Archivepreview->commi_dc_capacity ?? ''}}</td>
                <th>commissioning Date </th>
                <td>{{$Archivepreview->commissioning_date  ?? ''}}</td>
            </tr>
            <tr>
                <th>Financial Year</th>
                <td> {{$Archivepreview->financial_year ?? ''}}</td>
                <th> </th>
                <td></td>
            </tr>
            <tr>
                <td><br><br><br></td>
            </tr>
        </table>
    </main>
</section>
@endsection
<script>
$(document).ready(function() {
    $(".btn").click(function() {
        $("#sel1").modal('show');
    });
});
</script>
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush