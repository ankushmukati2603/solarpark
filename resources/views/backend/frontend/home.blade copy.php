@extends('layouts.masters.home')
@section('content')
<div id="home-container" class="container-fluid">
    <div id="home-msg" class="col-sm-8 col-sm-offset-2">
        <h2 class="fs38 title">Welcome to Biogas Application Portal</h2>
        <div class="mt-70"><a href="{{url('consumer-interest-form')}}" class="btn btn-default btn-interest">REGISTER
                YOUR INTEREST</a></div>
    </div>
</div>
@endsection