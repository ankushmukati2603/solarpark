@inject('general', 'App\Http\Controllers\Backend\Mnre\ReportController')
@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <strong>
            <h4 class="text-center">Monthly Progress Report Preview For STUs/CTUs</h4>
        </strong>

        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1>STU/CTU Name : {{$stuData['user_id'] ?? '--'}}<a
                            href="{{ URL::to(Auth::getDefaultDriver().'/Stu-Reports')}}" class="btn btn-success"
                            style="float:right">Back</a></h1>

                </th>
            </tr>
            <tr>
                <th width="20%">Tender/ Bidding Agency for RE Projects</th>
                <td>{{$stuData['tender_bidding_agency']}}</td>
                <th width="20%">Project Details(Name of Developer)</th>
                <td>{{$stuData->developer_name ?? ''}}</td>
            </tr>
            <tr>
                <th>Capacity for connectivity applied (MW)</th>
                <td>{{$stuData->capacity_connectivity ?? ''}}</td>
                <th>State</th>
                <td>{{$stuData->state_id ?? ''}}</td>
            </tr>
            <tr>
                <th>District</th>
                <td>{{$stuData->district_id ?? ''}}</td>
                <th>Sub Station Location District</th>
                <td>{{$stuData->sub_station ?? ''}}</td>
            </tr>
            <tr>
                <th>Connectivity Basis</th>
                <td>{{$stuData->connectivity_basis ?? ''}}</td>
                <th>LTA operationalization date </th>
                <td>{{date('d-m-Y', strtotime($stuData->lta_operationalization_date ?? ''))}}</td>
            </tr>
            <tr>
                <th>Capacity commissioned in the current month (MW)</th>
                <td>{{$stuData->capacity_commissioned ?? ''}}</td>
                <th>Cumulative Capacity Commissioned (MW)</th>
                <td>{{$stuData->cumulative_capacity ?? ''}}</td>
            </tr>
            <tr>
                <th>Cumulative Capacity Commissioned Date</th>
                <td>{{date('d-m-Y', strtotime($stuData->cumulative_capacity_date ?? ''))}}</td>
                <th>Remarks </th>
                <td>{{$stuData->remark ?? ''}}</td>
            </tr>
        </table>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Remarks
        </button>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ URL::to(Auth::getDefaultDriver().'/submitRemarkStu') }}" id="formFileAjax" method="POST">
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
                                <textarea name="mnre_remark" class="form-control" id="" cols="5" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" name="editId" value="{{$general->encodeid($stuData->id)}}">
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
<style>.error {
    color: red
}
</style>
<script src="{{asset('public/js/custom.js')}}"></script>