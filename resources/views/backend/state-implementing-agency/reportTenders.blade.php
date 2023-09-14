@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tender Report</h1>
        </div>
        <section class="section dashboard">
            <table class="table table-striped">
                <form action="{{URL::to(Auth::getDefaultDriver().'/TenderReport')}}" method="post">
                    @csrf
                    <tr>
                        <th width="20%">
                            <label for="">From Date</label>
                            <input type="date" class="form-control" name="fromdate" />
                        </th>
                        <th width="20%">
                            <label for="">To Date </label>
                            <input type="date" class="form-control" name="todate" />
                        </th>
                        <th width="20%">
                            <label for="">Tender ID </label>
                            <select name="tender_id" class="form-control">
                                <option value="">Select Tender ID</option>
                                @foreach($searchFilters['tenders'] as $tender)
                                <option value="{{$tender['id']}}">{{$tender['tender_no']}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th width="20%">
                            <label for="">State </label>
                            <select name="state_id" id="state_id" class="form-control">
                                <option value="">Choose State</option>
                                @foreach($searchFilters['states'] as $state)
                                <option value="{{$state['code']}}">{{$state['name']}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <label for="">Bidding Agency </label>
                            <select name="agency_id" id="agency_id" class="form-control">
                                <option value="">Choose Agency</option>
                                @foreach($searchFilters['agencies'] as $agency)
                                <option value="{{$agency['id']}}">{{$agency['agency_name']}}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                    <tr>


                        <th colspan="5">
                            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/TenderReport')}}" class="btn btn-danger"
                                style="float:right;margin-left:5px">Reset</a>
                            <input type="submit" name="submit" id="submit1" value="Search" class="btn btn-success"
                                style="float:right">

                        </th>
                    </tr>
                </form>
            </table>
            <table class="table table-bordered table-striped" id="reportTable" style="width:100%">
                <thead>
                    <tr class="bg-primary text-light">
                        <th width="5%" class="hide">S.No</th>
                        <th width="10%">Tender ID</th>
                        <th width="10%">State</th>
                        <th width="35%">Bidders Agency</th>
                        <th width="15%">Description</th>
                        <th width="10%">Submitted On</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($reportData)>0)
                    @foreach($reportData as $data)
                    <tr>
                        <td class="hide">{{$loop->iteration}}</td>
                        <td>{{$data['tender_no'] ?? ''}}</td>
                        <td>{{$data['state'] ?? ''}}</td>
                        <td>{{$data['agency_name'] ?? ''}} <br>
                            SPA : <b>{{$data['sub_agency_name'] ?? 'NA'}}</b>
                        </td>
                        <td>
                            @if($data['action_type']=='tender')
                            <span class="text-success">Tender Published</span>
                            @elseif($data['action_type']=='ra')
                            <span class="text-warning">Reverse Auction</span>
                            @elseif($data['action_type']=='cancel')
                            <span class="text-danger">Tender Cancelled</span>
                            @elseif($data['action_type']=='bidder')
                            <span class="text-primary">Bidders Participated</span>
                            @elseif($data['action_type']=='psa')
                            <span class="text-info">PSA Details Submitted</span>
                            @elseif($data['action_type']=='ppa')
                            <span class="text-info">PPA Details Submitted</span>
                            @elseif($data['action_type']=='loa')
                            <span style="color:#0ecfa2 !important">LOA/LOI Details Submitted</span>
                            @elseif($data['action_type']=='commissioned')
                            <span style="color:#539b1c !important">Commissioned Details Submitted</span>
                            @else
                            Other
                            @endif
                        </td>
                        <td>{{ date("d-F-Y",strtotime($data['action_date'])) ?? ''}}</td>
                        <td>
                            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/ReportView/'.base64_encode($data['id']).'/'.base64_encode($data['tender_id']))}}"
                                target="_blank">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a
                                href="{{URL::to('/'.Auth::getDefaultDriver().'/DownloadReport/'.base64_encode($data['id']).'/'.base64_encode($data['tender_id']))}}">
                                <i class="fa fa-file-pdf-o text-danger"> | PDF</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>


        </section>
    </main>
</section>
@endsection
@push('backend-js')

<script>
$(document).ready(function() {
    $('#reportTable').DataTable({
        search: {
            return: true,
        },
        order: [
            [0, 'desc']
        ],
    });
});
</script>

@endpush