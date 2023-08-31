@extends('layouts.masters.home')
@section('content')
@if(session()->has('message'))
<div class="alert alert-dark">
    {{ session()->get('message') }}
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>S.No</th>
        <th>Name of the Developer</th>
        <th>Shareholding</th>
        <th>Latitude </th>
        <th>Longitude</th>
        <th>Area Of Land Holding</th>
        <th>Project Type</th>
        <th>Tarrif</th>
        <th>Energy Type</th>
        <th>State</th>
        <th>District</th>
        <th>Capacity</th>
        <th>Name of Discom</th>
        <th>Quantam Sale Of Power (hr.)</th>
        <th>PPA Tenure (Year) </th>
        <th>Start Of PPA (Date) </th>
        <th>Action</th>
    </tr>
    @foreach($userData as $user)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{ $user->name_of_developer }}</td>
        <td>{{ $user->shareholding }}</td>
        <td>{{ $user->latitude }}</td>
        <td>{{ $user->longitude }}</td>
        <td>{{ $user->area_of_land_holding }}</td>
        <td>{{ $user->type_project }}</td>
        <td>{{ $user->tarrif }}</td>
        <td>{{ $user->energy_type }}</td>
        <td>{{ $user->state_name }}</td>
        <td>{{ $user->district_name }}</td>
        <td>{{ $user->capacity }}</td>
        <td>{{ $user->discom_name }}</td>
        <td>{{ $user->quantam_of_sale_of_power }}</td>
        <td>{{ $user->ppa_tenure }}</td>
        <td>{{ $user->start_of_ppa }}</td>
        <td><a href="" class="btn btn-primary">Edit</a></td>
    </tr>

    @endforeach
    <tr>
        <td colspan="6"><br><br></td>
    </tr>
</table>
@endsection