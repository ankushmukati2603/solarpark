@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Developer</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/developer-list')}}" method="post" id=" ">
                        @csrf
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                    <!-- <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button> -->
                </div>
            </div>


            <div class="clearfix"></div><br>
            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/developer')}}" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-dark text-light">
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Sub-District</th>
                    <th>Village</th>
                    <th>Action</th>
                </tr>
                @foreach($userDetail as $progressReport)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $progressReport->name }}</td>
                    <td>{{ $progressReport->email }}</td>
                    <td>{{ $progressReport->contact_no}}</td>
                    <td>{{ $progressReport->address }}</td>
                    <td>{{ $progressReport->state_id }}</td>
                    <td>{{ $progressReport->district_id }}</td>
                    <td>{{ $progressReport->sub_district_id}}</td>
                    <td>{{ $progressReport->village }}</td>
                    <td><a href=" {{URL::to(Auth::getDefaultDriver().'/developer/Edit/'.$progressReport['id'])}}"
                            class="btn btn-primary">Edit</a> </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="11">No Record Found</td>
                </tr>
            </table>
    </main>
</section>
<!-- </section> -->
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush