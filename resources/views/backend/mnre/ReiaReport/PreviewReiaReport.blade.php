@inject('general', 'App\Http\Controllers\Backend\REIA\MainController')
@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Monthly Progress Report Preview For REIAs/States</h1>
        </div>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1>REIA Name : {{$data['reia_name'] ?? '--'}}<a
                            href="{{ URL::to(Auth::getDefaultDriver().'/Reia-Reports')}}" class="btn btn-success"
                            style="float:right">Back</a></h1>

                </th>
            </tr>
            <tr>
                <th>Name of Scheme</th>
                <td>{{$data['scheme_id'] ?? '--'}}</td>
                <th>State</th>
                <td>{{$data->state_id ?? ''}}</td>

            </tr>
            <tr>
                <th>District</th>
                <td>{{$data->district_id ?? ''}}</td>
                <th>Type of Project</th>
                <td>{{$data->project_type ?? ''}}</td>
            </tr>
            <tr>
                <th>Tender Capacity (MW)</th>
                <td>{{$data->tender_capacity ?? ''}}</td>
                <th>Date of Tender</th>
                <td>{{date('d-m-Y', strtotime($data->tender_date ?? ''))}}</td>
            </tr>
            <tr>
                <th>Date of LOA</th>
                <td>{{date('d-m-Y', strtotime($data->loa_date ?? ''))}}</td>
                <th>SCoD</th>
                <td>{{date('d-m-Y', strtotime($data->scod ?? ''))}}</td>
            </tr>
            <tr>
                <th>Present Status</th>
                <td>{{$data->remark ?? ''}}</td>
                <th></th>
                <td></td>
            </tr>
            <tr class="bg-primary text-light">
                <td colspan="4">
                    <h3>Bidder Details</h3>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered">
                        <tr>
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Bidder Capacity (MW)</th>
                            <th>Date of PPA</th>
                            <th>PPA Capacity (MW)</th>
                        </tr>

                        @for ($i = 0; $i < count($data['bidder_id']); $i++) <tr>
                            <td>{{$i+1}}</td>
                            <td>{{ $general->getBidderName($data['bidder_id'][$i]) }}</td>
                            <td>{{ $data['select_bidders_capacity'][$i] }}</td>
                            <td>{{ $data['ppa_date'][$i] }}</td>
                            <td>{{ $data['ppa_capacity'][$i] }}</td>
            </tr>
            @endfor
        </table>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Remarks
        </button>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ URL::to(Auth::getDefaultDriver().'/submitRemarkReia') }}" id="formFileAjax" method="POST">
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
                                <div class="dropdown">
                                    <label for="">Select Status <span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example" name="mnre_status">
                                        <option value=''>Select</option>
                                        <option value="1">Approve</option>
                                        <option value="2">Partial Approve</option>
                                        <option value="3">Reject</option>
                                    </select>
                                </div> <br>
                                <label for=""> Remark <span class="text-danger">*</span></label>
                                <textarea name="mnre_remarks" class="form-control" id="" cols="5" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" name="editId" value="{{$general->encodeid($data->id)}}">
                                <button type="submit" id="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </main>
</section>

@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush
<style>
.error {
    color: red
}
</style>
<!-- <script src="{{asset('public/js/custom.js')}}"></script> -->