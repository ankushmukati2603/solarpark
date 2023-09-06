@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>STUs/CTUs List</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/stu-project-list')}}" method="post" id=" ">
                        @csrf
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                    <!-- <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button> -->
                </div>
            </div>

            <div class="clearfix"></div><br>
            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-stu-project')}}" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-primary text-light">
                    <th>S.No</th>
                    <th>STUs/CTUs Project Name</th>
                    <th>Developer Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>PAN Number</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Sub-District</th>
                    <th>Village</th>
                    <th>Action</th>
                </tr>
                @foreach($stuProjectDetails as $stuProjectList)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $stuProjectList->project_name }}</td>
                    <td>{{ $stuProjectList->developer_name }}</td>
                    <td>{{ $stuProjectList->email }}</td>
                    <td>{{ $stuProjectList->mobile_number }}</td>
                    <td>{{ $stuProjectList->pan_no }}</td>
                    <td>{{ $stuProjectList->state_name }}</td>
                    <td>{{ $stuProjectList->district_name }}</td>
                    <td>{{ $stuProjectList->sub_districts_name }}</td>
                    <td>{{ $stuProjectList->village_name }}</td>
                    <td>
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-solar-park/'.$stuProjectList->id)}}"
                            class="text-danger">Edit</a> |
                        <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $stuProjectList->id }}">View</a>

                        <div class="modal fade" id="exampleModal{{ $stuProjectList->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Project Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>STUs/CTUs Project Name</th>
                                                <td>
                                                    {{ $stuProjectList->project_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Developer Name</th>
                                                <td>{{ $stuProjectList->developer_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>
                                                    {{ $stuProjectList->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Number</th>
                                                <td>{{ $stuProjectList->mobile_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>PAN No.</th>
                                                <td>
                                                    {{ $stuProjectList->pan_no }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>State Name</th>
                                                <td>{{ $stuProjectList->state_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>District Name</th>
                                                <td>
                                                    {{ $stuProjectList->district_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Sub-District Name</th>
                                                <td>{{ $stuProjectList->sub_districts_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Village Name</th>
                                                <td>
                                                    {{ $stuProjectList->village_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $stuProjectList->address }}</td>
                                            </tr>
											
               

                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>

                </tr>
                @endforeach
                <!-- <tr>
                    <td colspan="11">No Record Found</td>
                </tr> -->
            </table>
    </main>
</section>
<!-- </section> -->
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush