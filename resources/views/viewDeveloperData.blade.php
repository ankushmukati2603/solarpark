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
        <th>Contact Person Name</th>
        <th>Contact No</th>
        <th>Email</th>
        <th>Action</th>

    </tr>
    @foreach($userDetail as $user)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{ $user->name_of_developer }}</td>
        <td>{{ $user->contact_person_name }}</td>
        <td>{{ $user->contact_no }}</td>
        <td>{{ $user->email }}</td>
        <td><a href="{{URL::to('developerData/Edit/'.$user->id)}}" class="btn btn-primary">Edit</a> | <a
                href="{{URL::to('deleteDeveloperData/Delete/'.$user->id)}}" class="btn btn-danger">Delete</a> </td>
    </tr>

    @endforeach
    <tr>
        <td colspan="6"><br><br></td>
    </tr>
    <a href="{{URL::to('developerData')}}">Form</a>
</table>
@endsection