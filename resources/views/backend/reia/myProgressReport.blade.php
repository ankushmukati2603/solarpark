@extends('layouts.masters.backend')
@section('content')


<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Monthly Progress Report For REIAs/States</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Monthly Progress Report For REIAs/States</li>
                </ol>
            </nav>
        </div>
        <strong>
            <h1 class="text-center">{{auth::user()->name}}</h1>
        </strong>
        <strong>
            <h4 class="text-center">Monthly Progress Report For REIAs/States</h4>
        </strong>
        @include('layouts.partials.backend._flash')
        <form action="{{url(Auth::getDefaultDriver().'/progress-report')}}" method="post">@csrf
            <div class="row col-md-12">
                <div class="col-md-3">

                    <label>Submitted From</label>
                    <div class="input-group date">
                        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                            placeholder="MM-DD-YYYY" name="filter[from_date]" value="{{$filters['from_date']??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Submitted To</label>
                    <div class="input-group date">
                        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                            placeholder="MM-DD-YYYY" name="filter[to_date]" value="{{$filters['to_date']??''}}">
                    </div>
                </div><!-- comment -->
                <div class="col-md-3">
                    <label>State</label>
                    <div class="input-group">
                        <select class="form-control" id="state_id" name="filter[state_id]"
                            onchange="getDistrictByState(this.value, '')">
                            <option value="">Select</option>
                            @foreach($states as $state)
                            <option @if($state['code']==@$filters['state_id']) selected @endif value="{{$state->code}}">
                                {{$state->name}}</option>
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
                        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                            placeholder="MM-DD-YYYY" name="filter[tender_date]" value="{{$filters['tender_date']??''}}">
                    </div>
                </div><!-- comment -->

                <div class="col-md-3">
                    <label>Scheme Name</label>
                    <div class="input-group date">
                        <input type="text" class="form-control pull-right alldatepicker " id=""
                            placeholder="Scheme Name" name="filter[scheme_name]"
                            value="{{$filters['scheme_name']??''}}">
                    </div>
                </div>

            </div>
            <div class="col-md-2">
                <button class="btn btn-sm btn-md btn-info pull-right" type="submit">Search</button>
                <a id="reseta" href="{{Request::fullUrl()}}" class="btn btn-sm btn-flat btn-danger pull-right">Reset</a>
            </div>
        </form>

        <div class="clearfix"></div><br>
        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/new-reia-progress-report')}}" class="btn btn-success"
            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Progress
            Report</a>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />

        <table class="table table-bordered display nowrap" id="example">
            <thead>
                <tr class="bg-dark text-dark">
                    <th>S.No</th>
                    <th>Name of Scheme</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Type of Project</th>
                    <th>Tender Capacity( MW )</th>
                    <th>Date & Time</th>
                    <th>Present Status</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach($progressDetails as $progressData)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$progressData->scheme_name}}</td>
                    <td>{{$progressData->state_name}}</td>
                    <td>{{$progressData->district_name}}</td>
                    <td>{{$progressData->project_type}}</td>
                    <td>{{$progressData->tender_capacity}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($progressData->created_date))}}</td>
                    <td>{{$progressData->status}}</td>

                    <td>
                        <a
                            href="{{URL::to(Auth::getDefaultDriver().'/reia-progress-report/edit/'.base64_encode($progressData->id))}}">Edit</a>
                        |
                        <a href="{{URL::to(Auth::getDefaultDriver().'/previewprogressreport/'.base64_encode($progressData->id))}}"
                            target="_blank">View</a>
                    </td>
                </tr>
                <!-- "{{URL::to(Auth::getDefaultDriver().'/previewprogressreport/'.base64_encode($progressData->id))}}" -->
                @endforeach
            </tbody>

        </table>
    </main>
</section>

@endsection
@push('backend-js')

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
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