@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Solar Park List</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Solar Park List
                            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-solar-park')}}"
                                class="btn btn-success" style="float: right;"><i class="fa fa-plus"
                                    aria-hidden="true"></i>
                                Add New Park</a>
                        </h1>

                        <hr style="color: #959595;">


                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th>S.No</th>
                                <th>Park Name</th>
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
                            @foreach($mnreuserDetail as $mnreuserList)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $mnreuserList->solar_park_name }}</td>
                                <td>{{ $mnreuserList->developer_name }}</td>
                                <td>{{ $mnreuserList->email }}</td>
                                <td>{{ $mnreuserList->mobile_number }}</td>
                                <td>{{ $mnreuserList->pan_no }}</td>
                                <td>{{ $mnreuserList->state_name }}</td>
                                <td>{{ $mnreuserList->district_name }}</td>
                                <td>{{ $mnreuserList->sub_districts_name }}</td>
                                <td>{{ $mnreuserList->village_name }}</td>
                                <td>
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-solar-park/'.$mnreuserList->id)}}"
                                        class="text-danger">Edit</a> |
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $mnreuserList->id }}">View</a>

                                    <div class="modal fade" id="exampleModal{{ $mnreuserList->id }}" tabindex="-1"
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
                                                            <th>Solar Park Name</th>
                                                            <td>
                                                                {{ $mnreuserList->solar_park_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Developer Name</th>
                                                            <td>{{ $mnreuserList->developer_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>
                                                                {{ $mnreuserList->email }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mobile Number</th>
                                                            <td>{{ $mnreuserList->mobile_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>PAN No.</th>
                                                            <td>
                                                                {{ $mnreuserList->pan_no }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>State Name</th>
                                                            <td>{{ $mnreuserList->state_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>District Name</th>
                                                            <td>
                                                                {{ $mnreuserList->district_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sub-District Name</th>
                                                            <td>{{ $mnreuserList->sub_districts_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Village Name</th>
                                                            <td>
                                                                {{ $mnreuserList->village_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>{{ $mnreuserList->address }}</td>
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
                        </table>
                        {{ $mnreuserDetail->links() }}
                    </div>
                </div>
            </div>
    </main>
</section>
<!-- </section> -->
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush