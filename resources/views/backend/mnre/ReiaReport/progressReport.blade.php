@inject('general', 'App\Http\Controllers\Backend\Mnre\ReportController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1 class="text-center">Monthly Progress Report For REIAs/States </h1>
                        <hr style="color: #959595;">
                        @include('layouts.partials.backend._flash')
                        <form action="{{url(Auth::getDefaultDriver().'/progress-report')}}" method="post">@csrf
                            <div class="row col-md-12">
                                <div class="col-md-3">

                                    <label>Submitted From</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control pull-right alldatepicker "
                                            id="created_date" placeholder="MM-DD-YYYY" name="filter[from_date]"
                                            value="{{$filters['from_date']??''}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Submitted To</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control pull-right alldatepicker "
                                            id="created_date" placeholder="MM-DD-YYYY" name="filter[to_date]"
                                            value="{{$filters['to_date']??''}}">
                                    </div>
                                </div><!-- comment -->
                                <div class="col-md-3">
                                    <label>State</label>
                                    <div class="input-group">
                                        <select class="form-control" id="state_id" name="filter[state_id]"
                                            onchange="getDistrictByState(this.value, '')">
                                            <option value="">Select</option>
                                            @foreach($states as $state)
                                            <option @if($state['code']==@$filters['state_id']) selected @endif
                                                value="{{$state->code}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- comment -->
                                <div class="col-md-3">
                                    <label>Distict</label>
                                    <div class="input-group">
                                        <select class="form-control" id="district_id" name="filter[district_id]">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Date of Tender</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control pull-right alldatepicker "
                                            id="tender_date" placeholder="MM-DD-YYYY" name="filter[tender_date]"
                                            value="{{$filters['tender_date']??''}}">
                                    </div>
                                </div><!-- comment -->

                                <div class="col-md-3">
                                    <label>Scheme Name</label>
                                    <div class="input-group date">
                                        <select class="form-control" id="scheme_name" name="filter[scheme_name]">
                                            <option value="">Select</option>
                                            @foreach($schemes as $sc)
                                            <option value="{{$sc->id}}">{{$sc->scheme_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label> <br></label>
                                    <div>
                                        <button class="btn btn-sm btn-md btn-info pull-right"
                                            type="submit">Search</button>
                                        <a id="reseta" href="{{Request::fullUrl()}}"
                                            class="btn btn-sm btn-flat btn-danger pull-right">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        <table class="table table-bordered display nowrap" id="example">
                            <thead>
                                <tr class="bg-success text-light">
                                    <th style="display: none;">S.No</th>
                                    <th>Report Month</th>
                                    <th>Report Year</th>
                                    <th>Name of Scheme</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Type of Project</th>
                                    <th>Tender Capacity (MW)</th>
                                    <th>Submitted Date </th>
                                    <th>Present Status</th>
                                    <th>MNRE Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reiaProgressReportData as $progressData)
                                <tr>
                                    <td style="display: none;">{{$progressData->id}}</td>
                                    <td>{{ date("F", mktime(0, 0, 0, $progressData->month, 1 ))}}</td>
                                    <td>{{$progressData->year}}</td>
                                    <td>{{$progressData->scheme_id}}</td>
                                    <td>{{$progressData->state_id}}</td>
                                    <td>{{$progressData->district_id}}</td>
                                    <td>{{$progressData->project_type}}</td>
                                    <td>{{$progressData->tender_capacity}}</td>
                                    <td>{{date('d-m-Y', strtotime($progressData->created_date))}}</td>
                                    <td>{{$progressData->remark ?? 'NA'}}</td>
                                    <td>{{$progressData->mnre_remarks ?? 'NA'}}</td>
                                    <td><a href="{{URL::to(Auth::getDefaultDriver().'/Preview-Reia-Report/'.$general->encodeid($progressData->id))}}"
                                            target="_blank">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

@endsection
@push('backend-js')
<link rel="stylesheet" href="{{asset('public/datatable/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" href="{{asset('public/datatable/buttons.dataTables.min.css')}}" />
<script src="{{asset('public/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('public/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('public/datatable/buttons.html5.min.js')}}"></script>
<script>
$(document).ready(function() {
    var oTable = $('#example').DataTable({
        // ordering: 'desc',
        // ordering: true,
        order: [
            [0, 'desc']
        ],
        dom: 'Blfrtip',
        buttons: [{
                extend: 'pdf',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'csv',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excel',
                footer: false
            }


        ]
    });

});
</script>
@endpush
<style>
.error {
    color: red
}
</style>
<script src="{{asset('public/js/custom.js')}}"></script>