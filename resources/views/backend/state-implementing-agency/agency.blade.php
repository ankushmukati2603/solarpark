@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency/Add')}}" class="btn btn-success"
                            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add Agency</a>
                        <h1>Agency Management</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th width="5%">S.No</th>
                                <th width="15%">Agency Name</th>
                                <th width="25%">Contact Person Details</th>
                                <th width="20%">Address</th>
                                <th>State</th>
                                <th>District</th>
                                <th width="5%">Action</th>
                            </tr>
                            @if(!$agencyList->isEmpty())
                            @foreach($agencyList as $agency)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $agency->agency_name }}</td>
                                <td>
                                    Name : {{ $agency->contact_person_name }}<br>
                                    Email : {{ $agency->contact_person_email }} <br>
                                    Number : {{ $agency->contact_person_number }}
                                </td>
                                <td>{{ $agency->agency_address}}</td>
                                <td>{{ $agency->state_name}}</td>
                                <td>{{ $agency->district_name }}</td>
                                <td><a
                                        href=" {{URL::to(Auth::getDefaultDriver().'/Agency/Edit/'.$agency->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">No Record Found</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    {{$agencyList->links()}}
                </div>
            </div>

    </main>
</section>
<!-- </section> -->
@endsection