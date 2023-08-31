@extends('layouts.masters.home')
@section('content')
<div class="container">
    <div class="row">

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
    </div><br />
    <form action="{{URL::to('developerData')}}" method="post" enctype="multipart/form-data">
        <!-- {{URL::to('developerData')}} -->
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <table class="table table-bordered">
            <tr>
                <th colspan="2">Form</th>
            </tr>
            <tr>
                <td>Name of the Developer </td>
                <th>
                    <input type="name" name="name_of_developer" value="{{ $result->name_of_developer ?? '' }}"
                        id="name_of_developer" class="form-control">
                    <span class="text-danger">{{ $errors->first('name_of_developer') }}</span>
                </th>
            </tr>
            <tr>
                <td>Address </td>
                <th>
                    <input type="text" name="address" value="{{ $result->address ?? '' }}" id="address"
                        class="form-control">
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                </th>
            </tr>
            <tr>
                <td>Contact Person Name </td>
                <th>
                    <input type="name" name="contact_person_name" value="{{ $result->contact_person_name ?? '' }}"
                        id="contact_person_name" class="form-control">
                    <span class="text-danger">{{ $errors->first('contact_person_name') }}</span>
                </th>
            </tr>
            <tr>
                <td>Contact No </td>
                <th>
                    <input type="number" id="contact_no" value="{{ $result->contact_no ?? '' }}" name="contact_no"
                        class="form-control">

                    <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                </th>
            </tr>
            <tr>
                <td>Email </td>
                <th>
                    <input type="email" name="email" value="{{ $result->email ?? '' }}" id="email" class="form-control">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </th>
            </tr>
            <tr>
                <td>State </td>
                <th>
                    <select name="state_id" class="form-control" id="state">
                        <option value="">Select State</option>
                        @foreach($stateData as $state)
                        <option value="{{ $state->code}}" @if(isset($result->state_id) && $state->code==
                            $result->state_id)selected @endif>

                            {{ $state->name }}
                        </option>
                        <!-- state table se table ka name liya hai  -->
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                    <!-- developer table  se common column ka name liya hai -->
                </th>
            </tr>
            <tr>
                <td>District </td>
                <th>
                    <select name="district_id" class="form-control" id="district">
                        <!-- <option value="">Select District</option>
                        @foreach($districtData as $district)
                        <option value="{{ $district->code}}" @if(isset($result->district_id) && $district->code==
                            $result->district_id)selected @endif>

                            {{ $district->name }}</option>
                        state table se table ka name liya hai  
                        @endforeach -->
                    </select>
                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                </th>
            </tr>
            <tr>
                <td>Energy </td>
                <th>
                    <select name="energy_id" class="form-control" id="energy">
                        <option value="">Select Energy Type</option>
                        @foreach($energyData as $energy)
                        <option value="{{ $energy->id }}" @if(isset($result->energy_id) && $energy->id==
                            $result->energy_id)selected @endif >
                            <!-- $result controller m jaha id fatch ki h vaha s liya h jo ki view m b display kiya h jo var return view m display nhi kiye hote h unko blade file m nhi lete h -->
                            {{ $energy->energy_type }}
                        </option>
                        <!-- state table se table ka name liya hai  -->
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('energy_id') }}</span>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="editId" id="" value="{{ $result->id ?? '' }}">
                    <input type="submit" name="submit" value="submit" class="btn btn-success" id="">
                    <!-- <input type="submit" name="deleteId" value="delete" class="btn btn-danger" id=""> -->
                    <a href="{{URL::to('viewDeveloperData')}}" class="btn btn-primary">View</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#state').on('change', function() { // state jo h form m id le rahe h
        var stateID = $(this).val();
        var districtData = '<option value="">Select District</option>';
        if (stateID) {
            $.ajax({
                type: 'GET',
                url: baseUrl + '/ajax/district/' + stateID,
                //data: 'state_id=' + stateID,
                success: function(data) {
                    $.each(data, function(index, value) {
                        // statements
                        districtData += '<option value="' + value.code +
                            '">' + value.name +
                            '</option>';
                    });
                    $('#district').html(districtData);
                }
            });
        } else {
            $('#city').html('<option value="">Select state first</option>');
        }
    });
});
</script>
@endsection