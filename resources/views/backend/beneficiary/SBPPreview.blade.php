@extends('layouts.masters.backend')
@section('content')
@section('title', 'Small Biogas Plant')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
            <li class="breadcrumb-item active">Proposal for Small Biogas Plants (1 M^3 to 25 M^3)</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="row">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="col-md-12">
            <div class="frontPagesBox">
                <div class="box box-primary">
                    <form id="consumerInterestForm" action="{{URL::to(Auth::getDefaultDriver().'/smallBiogasPlants')}}"
                        method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-center"> Proposal for Small Biogas Plants (1 M^3 to 25
                                        M^3) <br>
                                        Application No. : {{$consumer['consumer_id'] ?? 'NA'}}</h3>
                                    <br>
                                </div>
                                <table class="table table-bordered table-striped">

                                    <tr>
                                        <th>Name</th>
                                        <td>{{$consumer['name'] ?? ''}}</td>
                                        <th>Contact Number</th>
                                        <td>{{$consumer['phone'] ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$consumer['email'] ?? ''}}</td>
                                        <th>Category</th>
                                        <td> @if($consumer->category == 'gen')
                                            <span>General</span>
                                            @elseif(($consumer->category == 'sc'))
                                            <span>SC</span>
                                            @elseif(($consumer->category == 'st'))
                                            <span>ST</span>
                                            @else
                                            <span>Not Defined</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>State</th>
                                        <td>{{$consumer['state_name'] ?? ''}}</td>
                                        <th>District</th>
                                        <td>{{$consumer['district_name'] ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub District</th>
                                        <td>{{$consumer['sub_districts_name'] ?? ''}}</td>
                                        <th>Block</th>
                                        <td>{{$consumer['blocks_name'] ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Village</th>
                                        <td>{{$consumer['village_name'] ?? ''}}</td>
                                        <th>Localbody Type</th>
                                        <td> @if($consumer->localbody_type == '2')
                                            <span>Urban</span>
                                            @else
                                            <span>Rural</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Panchayat</th>
                                        <td>{{$consumer['localbody_name'] ?? ''}}</td>
                                        <th>Ward No.</th>
                                        <td>{{$consumer['ward_name'] ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Post Office</th>
                                        <td>{{$consumer['post'] ?? ''}}</td>
                                        <th>House No.</th>
                                        <td>{{$consumer['house_no'] ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Do you require toilet linked biogas plants?</th>
                                        <td>
                                            @if($consumer->toilet_linked == '1')
                                            <span>yes</span>
                                            @else
                                            <span>No</span>
                                            @endif
                                        </td>
                                        <th> Do you already have a biogas plant installed?</th>
                                        <td>
                                            @if($consumer->existing_biogas_plant == '1')
                                            <span>yes</span>
                                            @else
                                            <span>No</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Do you require biogas slurry filter unit?</th>
                                        <td>
                                            @if($consumer->slurry_filter_unit == '1')
                                            <span>yes</span>
                                            @else
                                            <span>No</span>
                                            @endif
                                        </td>
                                        <th>Number of cattle available</th>
                                        <td>@if($consumer->cattle_available ==1) <span></span>@else No @endif<br>
                                            @if($consumer->cattle_available == '1')
                                            <span>Big Buffaloe: {{$consumer['number_of_cattles']['BuffaloesBig'] ?? ''}}
                                                <br>
                                                Small Buffaloe:
                                                {{$consumer['number_of_cattles']['BuffaloesSmall'] ?? ''}}<br>
                                                Big Cow: {{$consumer['number_of_cattles']['CowsBig'] ?? ''}}<br>
                                                Small Cow: {{$consumer['number_of_cattles']['CowsSmall'] ?? ''}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Comment</th>
                                        <td>{{$consumer['comment'] ?? ''}} </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
    .col-md-4 {
        display: inline-block;
    }
    </style>
    @include('modals.consumerInstallerAssociation')
    @endsection
    @push('backend-js')

    <script src="{{asset('public/js/custom.js')}}"></script>
    <script>
    $('input[name=cattle_available]').change(function() {
        var value = $('input[name=cattle_available]:checked').val();
        if (value == 0) {
            $('#cattle_id').hide();
        } else {
            $('#cattle_id').show();
        }
    });


    function setOrEditPriority(element) {
        let value = $(element).val();
        let systemId = $(element).data('system');
        ajaxcall('GET', {}, baseUrl + '/ajax/setOrEditPriority/' + systemId + '/' + value).then((resp) => {
            if (resp === 'SUCCESS') {
                window.location = '{{URL::to("/".Auth::getDefaultDriver()."/consumer-list")}}'
            }
        })
    }
    </script>

    @if(($consumer['final_submission'] ?? '') == '0')
    <script>
    $(document).ready(function() {
        getDistrictByState('{{ $consumer["state_id"] }}', '{{ $consumer["district_id"] }}');
        getSubDistrictByDistrict('{{ $consumer["district_id"] }}', '{{ $consumer["sub_district_id"] }}');
        getBlockByDistricts('{{ $consumer["district_id"] }}', '{{ $consumer["block"] }}');
        // block table k  column ka name
        getVillageBySubDistrict('{{ $consumer["sub_district_id"] }}', '{{ $consumer["village"] }}');
        getPanchayatByLocalbodies('{{$consumer["localbody_type"] }}', '{{ $consumer["panchayat"] }}');
        getWardByPanchayat('{{ $consumer["panchayat"] }}', '{{$consumer["ward_no"] }}');
    });
    </script>
    @endif
    @endpush