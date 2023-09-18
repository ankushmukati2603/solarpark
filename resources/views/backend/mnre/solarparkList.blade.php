@inject('general', 'App\Http\Controllers\Backend\Mnre\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Solar Park</h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-dark text-dark">
                                    <th>S.No</th>
                                    <th>SPPD Name</th>
                                    <th>Developer Name</th>
                                    <th>Solar Park</th>
                                    <th>Email ID</th>
                                    <th>Contact Number</th>
                                    <th width="20%">Address</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solarparkList as $park)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $park->beneficiary_name ?? '--' }}</td>
                                    <td>{{ $park->developer_name ?? '--'}}</td>
                                    <td>{{ $park->solar_park_name ?? '--'}}</td>
                                    <td>{{ $park->email ?? '--' }}</td>
                                    <td>{{ $park->mobile_number ?? '--' }}</td>
                                    <td>{{ $park->address ?? '--' }}</td>
                                    <td>{{ $park->state_name ?? '--' }}</td>
                                    <td>{{ $park->district_name ?? '--' }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>
</section>
@endsection