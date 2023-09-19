@inject('general', 'App\Http\Controllers\Backend\SNA\TenderController')
@extends('layouts.masters.backend')
@section('content')
@section('title', 'Progress Report')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/';
@endphp
<section class="section dashboard">

    <main id="main" class="main">

        <style>
        .heading {
            text-align: left;
            font-size: 25px;
            background-color: lightblue;
        }
        </style>
        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1 class="text-center">Tender ID : {{$tender->tender_no ?? '--'}}</h1>
                    <a href="{{ URL::to(Auth::getDefaultDriver().'/Sna-Reports')}}" class="btn btn-success"
                        style="float:right">Back</a>
                </th>
            </tr>

            <tr>
                <th colspan="4" class="heading1 bg-primary text-light">
                    Tender Details
                </th>
            </tr>
            <tr>
                <th width="20%">Tender NIT</th>
                <td width="30%">{{$tender->nit_no ?? '-'}}</td>
                <th width="20%">Scheme Type</th>
                <td width="30%">{{$tender->scheme_type ?? '-'}}</td>

            </tr>
            <tr>
                <th>Title</th>
                <td>{{$tender->tender_title ?? '-'}}</td>
                <th>Capacity(MW)</th>
                <td>{{$tender->tenderCapcity ?? '-'}}</td>
            </tr>
            <tr>
                <th>NIT Date</th>
                <td>{{date('d M Y', strtotime($tender->nit_date)) ?? ''}}</td>
                <th>RFS Date</th>
                <td>{{date('d M Y', strtotime($tender->rfs_date)) ?? ''}}</td>
            </tr>
            <tr>
                <th>Pre Bid Meeting Date</th>
                <td>{{date('d M Y', strtotime($tender->pre_bid_meeting_date)) ?? ''}}</td>
                <th>Bid Submission Date</th>
                <td>{{date('d M Y', strtotime($tender->bid_submission_date)) ?? ''}}</td>
            </tr>
            <tr>
                <th>Additional Information</th>
                <td>{{$tender->additional_information ?? '-'}}</td>
                <th>Tender Status</th>
                <td>
                    @if($tender->tender_status ==1)
                    Tender
                    @elseif($tender->tender_status ==2)
                    Under Implementation
                    @elseif($tender->tender_status==3)
                    Implemented
                    @elseif($tender->tender_status==4)
                    Commissioned
                    @elseif($tender->tender_status==5)
                    Cancelled
                    @else

                    @endif
                </td>
            </tr>
            @if(!empty($tender->c_capacity))
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Cancellation Details
                </th>
            </tr>
            <tr>
                <th>Tender Cancel Type</th>
                <td>{{$tender->cancel_type ?? '-'}}</td>
                <th>Cancelled Capacity(MW)</th>
                <td>{{$tender->cancel_capacity ?? '0'}}</td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td>{{$tender->c_capacity ?? '0'}}</td>
                <th>Date of Cancel</th>
                <td>{{date('d M Y', strtotime($tender->cancel_date)) ?? ''}}</td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td colspan="3">{{$tender->cancel_remark ?? 'NA'}}</td>
            </tr>
            @endif
            @if(!empty($tender->ra_capacity))
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Reverse Auction Details
                </th>
            </tr>
            <tr>
                <th>RA Type</th>
                <td>{{$tender->ra_type ?? '-'}}</td>
                <th>RA Capacity(MW)</th>
                <td>{{$tender->ra_capacity ?? '0'}}</td>
            </tr>
            <tr>
                <th>RA Date</th>
                <td>{{date('d M Y', strtotime($tender->ra_date)) ?? ''}}</td>
                <th>Awarded Capacty(MW)</th>
                <td>{{$tender->capacity_awarded ?? '0'}}</td>

            </tr>
            @endif
            @if(!empty($selectedBidderData))
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Bidder Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered">
                        <tr class="bg-success text-light">
                            <th width="5%">S.No</th>
                            <th>Bidder Name</th>
                            <th>Agency Name</th>
                            <th>Capacity</th>

                        </tr>
                        @foreach($selectedBidderData as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder->bidder_name ?? 'NA'}}</td>
                            <td>{{$bidder->agency_name ?? 'NA'}}</td>
                            <td>{{$bidder->capacity ?? 'NA'}} MW</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>

            @endif
            @if(!empty($bidderProjectLocationData))
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Bidder Projects Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered  text-center">
                        <tr class="bg-success text-light text-center">
                            <th rowspan="2">S.No</th>
                            <th rowspan="2">Bidder Name</th>
                            <th rowspan="2">Project Title</th>
                            <th rowspan="2">State</th>


                            <th colspan="6">Signing of PSA</th>
                            <th colspan="4">Signing of PPA</th>


                            <th rowspan="2">LOI/LOA Date</th>
                        </tr>
                        <tr class="bg-success text-light text-center">
                            <th>Date of PSA</th>
                            <th>PSA Capacity (MW)</th>
                            <th>Name of State in PSA Signed</th>
                            <th>Name of DISCOM who have signed PSA</th>
                            <th>Per Unit cost of electricity as per said PSA</th>
                            <th>Duration of PSA(In Years)</th>

                            <th>Effective Date of PPA</th>
                            <th>Capacity (MW) </th>
                            <th>Per Unit cost of electricity as per said PPA</th>
                            <th>Duration of PPA(In Years)</th>
                        </tr>
                        @foreach($bidderProjectLocationData as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder->bidder_name ?? 'NA'}}</td>
                            <td>{{$bidder->project_title ?? 'NA'}}</td>
                            <td>{{$bidder->state ?? 'NA'}}</td>


                            <td>{{$bidder->ppa_psa_date ? date('d M Y', strtotime($bidder->ppa_psa_date)) : 'NA'}}</td>
                            <td>{{$bidder->ppa_psa_capacity ?? 'NA'}}</td>
                            <td>{{$bidder->signed_state ?? 'NA'}}</td>
                            <td>{{$bidder->discom_name ?? 'NA'}}</td>
                            <td>{{$bidder->electricity_per_unit_cost ?? 'NA'}}</td>
                            <td>{{$bidder->duration_ppa ?? 'NA'}}</td>

                            <td>{{$bidder->ppa_date ? date('d M Y', strtotime($bidder->ppa_date)) : 'NA'}}</td>
                            <td>{{$bidder->ppa_capacity ?? 'NA'}}</td>
                            <td>{{$bidder->ppa_electricity_per_unit_cost ?? 'NA'}}</td>
                            <td>{{$bidder->duration_ppa ?? 'NA'}}</td>

                            <td>{{$bidder->loi_loa_date ? date('d M Y', strtotime($bidder->loi_loa_date)) : 'NA'}}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
            @endif


            <!-- Projects Commissioning Details -->
            @if(!empty($commissioningData) && $tender->tender_status > 2)
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Projects Commissioning Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered" id="ppaTbale">

                        <tr class="text-center bg-success text-light">
                            <th>Bidder Name</th>
                            <th>Project Name</th>
                            <th>State</th>
                            <th>Scheduled Commissioning Date (as per PPA)</th>
                            <th>Scheduled Commissioning Date (Revised/ extended)</th>
                            <th>Commissioned Capacity (MW)</th>
                            <th>Actual Commissioning Date</th>
                            <th>Actual Commissioned Capacity (MW)</th>
                        </tr>

                        <tbody class="text-center">
                            @php $j=0; $class=""; @endphp
                            @foreach($commissioningData as $rdata)
                            @php $i=0;$j++;
                            if($j%2==1){$class="bg-success1 text-light1";}
                            @endphp
                            @foreach($rdata['commissionedData'] as $data)
                            @php $i++; @endphp
                            @if($i==1)
                            <tr class="{{$class}}">
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['bidder_name']}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['project_title']}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['state']}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">
                                    {{$general->dateFormat($rdata['schedule_commissiong_date'])}}
                                </td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">
                                    {{$general->dateFormat($rdata['revised_schedule_commissiong_date'])}}</td>
                                <td rowspan="{{count($rdata['commissionedData'])}}">{{$rdata['commissioned_capacity']}}
                                </td>
                                <td>{{$general->dateFormat($data['actual_commissiong_date'])}}</td>
                                <td>{{$data['actual_commissioned_capacity']}}</td>
                            </tr>
                            @else
                            <tr class="{{$class}}">
                                <td>{{$general->dateFormat($data['actual_commissiong_date'])}}</td>
                                <td>{{$data['actual_commissioned_capacity']}}</td>
                            </tr>
                            @endif
                            @endforeach

                            @endforeach

                        </tbody>
                    </table>
                </td>
            </tr>
            @endif


            <!-- Projects Implementation Details -->
            @if(!empty($bidderProjectLocationData) && $tender->tender_status > 3)
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Projects Implementation Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered  text-center">
                        <tr class="bg-success text-light text-center">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>Capacity (MW)</th>
                            <th>Status of Stage 2 Connectivity</th>
                            <th>Status of LTA & Target Region</th>
                            <th>LTOA Operationalization Date</th>
                            <th>Status of Transmisison line from <br>
                                project site to Sub stattion (By Developer)</th>
                            <th>Interconnection Point/S/S <br> voltage level</th>
                        </tr>

                        @foreach($bidderProjectLocationData as $bidder)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder->bidder_name ?? 'NA'}}</td>
                            <td>{{$bidder->project_title ?? 'NA'}}</td>
                            <td>{{$bidder->commissioned_capacity ?? 'NA'}}</td>

                            <td>{{$bidder->status_stage_two ?? 'NA'}}</td>
                            <td>{{$bidder->status_lta ?? 'NA'}}</td>
                            <td>{{ $bidder->ltoa_date ? date('d M Y', strtotime($bidder->ltoa_date)) : 'NA'}}</td>
                            <td>{{$bidder->status_transmisison_line ?? 'NA'}}</td>
                            <td>{{$bidder->interconnection_vol_level ?? '--'}}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
            @endif

            <!-- Projects Commissioned Details -->
            @if(!empty($bidderProjectLocationData) && $tender->tender_status ==4)
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Projects Commissioned Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered  text-center">
                        <tr class="bg-success text-light text-center">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>Capacity (MW)</th>
                            <th>Project Type</th>
                            <th>Type of Module</th>
                            <th>Module Make</th>
                            <th>Substation Name</th>
                            <th>Substation Voltage Level (KV)</th>
                            <th>Feeder Name</th>
                            <th>Feeder Voltage (KV)</th>
                            <th>Projects in Solar Park</th>
                            <th>Commissioned AC Capacity</th>
                            <th>Commissioned DC Capacity</th>
                        </tr>

                        @foreach($bidderProjectLocationData as $bidder)
                        @php $commissionedData = json_decode($bidder->commissioned_details, true);
                        $solarprojectname="NA";
                        if(($commissionedData['have_solar_project'] ?? '')=='Yes'){
                        $solarprojectname=$commissionedData['solar_park_name'];
                        }
                        @endphp

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bidder->bidder_name ?? 'NA'}}</td>
                            <td>{{$bidder->project_title ?? 'NA'}}</td>
                            <td>{{$bidder->commissioned_capacity ?? 'NA'}}</td>

                            <td>{{$commissionedData['project_type'] ?? 'NA'}}</td>
                            <td>{{$commissionedData['module_type'] ?? 'NA'}}</td>
                            <td>{{$commissionedData['module_make'] ?? 'NA'}}</td>
                            <td>{{$commissionedData['substation_name'] ?? 'NA'}}</td>
                            <td>{{$commissionedData['substation_voltage'] ?? 'NA'}}</td>
                            <td>{{$commissionedData['feeder_name'] ?? 'NA'}}</td>
                            <td>{{$commissionedData['feeder_voltage'] ?? 'NA'}}</td>
                            <td>{{ $commissionedData['have_solar_project'] ?? 'NA'}}<br> Project Name :
                                {{$solarprojectname}}
                            </td>
                            <td>{{ $commissionedData['ac_voltage'] ?? 'NA'}}</td>
                            <td>{{ $commissionedData['dc_voltage'] ?? 'NA'}}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
            </tr>
            @endif

            @if($tender['mnre_remarks']!='')
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    MNRE Remark
                </th>
            </tr>
            <tr>
                <th colspan="2">Remark : {{ $tender['mnre_remarks'] ?? '' }}</th>
                <th colspan="2">Date/Time : {{ $tender['mnre_remark_date'] ?? '' }}</th>

            </tr>
            @else
            <tr>
                <td colspan="4"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Add Remarks
                    </button>
                </td>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <form action="{{ URL::to(Auth::getDefaultDriver().'/mnreRemarkSna') }}" id="formFileAjax"
                        method="POST">
                        @csrf
                        <div class="row1 app_progrs_rprt1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="dropdown" style="display:none">
                                            <label for="">Select Status <span class="text-danger">*</span></label>
                                            <select class="form-control" aria-label="Default select example"
                                                name="mnre_status">
                                                <option value=''>Select</option>
                                                <option value="1" selected>Approve</option>
                                                <option value="2">Partial Approve</option>
                                                <option value="3">Reject</option>
                                            </select>
                                        </div> <br>
                                        <label for=""> Remark <span class="text-danger">*</span></label>
                                        <textarea name="mnre_remarks" class="form-control" id="" cols="5"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="hidden" name="editId" value="{{$general->encodeid($tender_id)}}">
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </tr>
            @endif

        </table>
    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush