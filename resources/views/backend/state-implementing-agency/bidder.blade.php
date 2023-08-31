@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Bidder/Add')}}" class="btn btn-success"
                            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add Bidder</a>
                        <h1>Bidder Management</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th width="5%">S.No</th>
                                <th width="15%">Bidder Name</th>
                                <th width="15%">Agency Name</th>
                                <th width="10%">Email</th>
                                <th width="10%">Contact Number</th>
                                <th width="20%">Address</th>
                                <th width="10%">State</th>
                                <th width="10%">District</th>
                                <th width="5%">Action</th>
                            </tr>
                            @if(!$bidderList->isEmpty())
                            @foreach($bidderList as $bidder)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $bidder->bidder_name }}</td>
                                <td>{{ $bidder->agency_name }} <br>
                                    SPD : <b>{{$bidder->spd_name ?? 'NA'}}</b>

                                </td>
                                <td>{{ $bidder->bidder_email}}</td>
                                <td>{{ $bidder->bidder_number}}</td>
                                <td>{{ $bidder->address }}</td>
                                <td>{{ $bidder->state_name}}</td>
                                <td>{{ $bidder->district_name }}</td>
                                <td><a
                                        href=" {{URL::to(Auth::getDefaultDriver().'/Bidder/Edit/'.$bidder->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9">No Record Found</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    {{ $bidderList->links() }}
                </div>
            </div>

        </section>
    </main>
    <!-- </section> -->
    @endsection