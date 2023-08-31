@extends('layouts.masters.home')
@section('content')
<div class="container">
    <div class="row">
    </div><br />
    <form action="{{URL::to('solarProjectData')}}" method="post" enctype="multipart/form-data">
        <!-- {{URL::to('developerData')}} -->
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <table class="table table-bordered">
            <tr>
                <th colspan="2">Form</th>
            </tr>
            <tr>
                <td>Name of the Developer </td>
                <th>
                    <select name="developer_id" class="form-control" id="">
                        <option value="">Select name</option>
                        @foreach($developer as $data)
                        <option value="{{ $data->id }}">{{ $data->name_of_developer }} </option>
                        <!-- state table se table ka name liya hai -->
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('developer_id') }}</span>
                </th>
            </tr>
            <tr>
                <td>Shareholding </td>
                <th>
                    <input type="number" step="0.01" name="shareholding" value="" id="shareholding"
                        class="form-control">
                    <span class="text-danger">{{ $errors->first('shareholding') }}</span>
                </th>
            </tr>
            <tr>
                <td>Latitude </td>
                <th>
                    <input type="text" name="latitude" value="" id="latitude" class="form-control">
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                </th>
            </tr>
            <tr>
                <td>Longitude </td>
                <th>
                    <input type="text" id="longitude" value="" name="longitude" class="form-control">

                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                </th>
            </tr>
            <tr>
                <td>Area Of Land Holding </td>
                <th>
                    <input type="number" step="0.001" name="area_of_land_holding" value="" id="area_of_land_holding"
                        class="form-control">
                    <span class="text-danger">{{ $errors->first('area_of_land_holding') }}</span>
                </th>
            </tr>
            <tr>
                <td>Project Type</td>
                <th>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_project" id="type_project" value="1" />
                        <label class="form-check-label" for="">Solar Park</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_project" id="type_project" value="2" />
                        <label class="form-check-label" for="">Non Solar Projrct</label>
                    </div>
                    <span class="text-danger">{{ $errors->first('type_project') }}</span>
                </th>
            </tr>
            <tr>
                <td>Tarrif </td>
                <th>
                    <input type="number" step="0.01" name="tarrif" value="" id="tarrif" class="form-control">
                    <span class="text-danger">{{ $errors->first('tarrif') }}</span>
                </th>
            </tr>
            <tr>
                <td> Energy Type </td>
                <th>
                    <select name="energy_id" class="form-control" id="" style="width: 50%">
                        <option value="">Select Energy</option>
                        @foreach($energyData as $energy)
                        <option value="{{ $energy->id }}">{{ $energy->energy_type }} </option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('energy_id') }}</span>

                    <label for="">Capacity (KW)</label>
                    <input type="number" name="capacity" value="" id="capacity" class="form-control" style="width: 50%">
                    <span class="text-danger">{{ $errors->first('capacity') }}</span>
                </th>
            </tr>

            <tr>
                <td>Name of Discom </td>
                <th>
                    <select name="discom_id" class="form-control" id="">
                        <option value="">Select Name</option>
                        @foreach($discomData as $data)
                        <option value="{{ $data->id }}">{{ $data->discom_name }} </option>
                        <!-- state table se table ka name liya hai -->
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('discom_id') }}</span>
                </th>
            </tr>
            <tr>
                <td>Quantam Sale Of Power (hr.)</td>
                <th>
                    <input type="number" name="quantam_of_sale_of_power" value="" id="quantam_of_sale_of_power"
                        class="form-control">
                    <span class="text-danger">{{ $errors->first('quantam_of_sale_of_power') }}</span>
                </th>
            </tr>
            <tr>
                <td>PPA Tenure (Year)</td>
                <th>
                    <input type="number" name="ppa_tenure" value="" id="ppa_tenure" class="form-control">
                    <span class="text-danger">{{ $errors->first('ppa_tenure') }}</span>
                </th>
            </tr>
            <tr>
                <td>Start Of PPA (Date)</td>
                <th>
                    <input type="date" name="start_of_ppa" value="" id="start_of_ppa" class="form-control">
                    <span class="text-danger">{{ $errors->first('start_of_ppa') }}</span>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <!-- <input type="hidden" name="editId" id="" value="{{ $result->id ?? '' }}"> -->
                    <input type="submit" name="submit" value="submit" class="btn btn-success" id="">
                    <!-- <input type="submit" name="deleteId" value="delete" class="btn btn-danger" id=""> -->
                    <a href="{{URL::to('viewsolarData')}}" class="btn btn-primary">View</a>
                </td>
            </tr>
            <tr>
                <td colspan="6"><br><br></td>
            </tr>
        </table>
    </form>
</div>
</div>

@endsection
<!-- @section('scripts')
<script>
$(function() {
    $("#solar_capacity_box").click(
        function() {
            if ($(this).is(":checked")) {
                $("#solar_capacity").show();
            } else {
                $("#solar_capacity").hide();
            }
        }
    );
    $("#wind_capacity_box").click(
        function() {
            if ($(this).is(":checked")) {
                $("#wind_capacity").show();
            } else {
                $("#wind_capacity").hide();
            }
        }
    );
    $("#battery_capacity_box").click(
        function() {
            if ($(this).is(":checked")) {
                $("#battery_capacity").show();
            } else {
                $("#battery_capacity").hide();
            }
        }
    );




}); -->
<!-- // $(document).ready(function() {
// $('#state').on('change', function() { // state jo h form m id le rahe h
// var stateID = $(this).val();
// var districtData = '<option value="">Select District</option>';
// if (stateID) {
// $.ajax({
// type: 'GET',
// url: baseUrl + '/ajax/district/' + stateID,
// //data: 'state_id=' + stateID,
// success: function(data) {
// $.each(data, function(index, value) {
// // statements
// districtData += '<option value="' + value.code +
//                             '">' + value.name +
    // '</option>';
// });
// $('#district').html(districtData);
// }
// });
// } else {
// $('#city').html('<option value="">Select state first</option>');
// }
// });
// }); -->
<!-- </script> -->
@endsection