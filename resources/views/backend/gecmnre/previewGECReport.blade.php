@extends('layouts.masters.backend')
@section('content')
@section('title', 'Received Report')
@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
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
                    <h1>Application Detail</h1>
                    <!-- <a href="{{ URL::to(Auth::getDefaultDriver().'/my-progress-report')}}" class="btn btn-success"style="float:right">Back</a> -->
                </th>
            </tr>
            <tr>
                <th>Package Number</th>
                <td>{{$progressDetailspreview->package_no ?? ''}}</td>
                <th>Package Name</th>
                <td>{{$progressDetailspreview->package_name ?? ''}}</td>
            </tr>
            <tr>
                <th>Project Under The Package</th>
                <td>{{$progressDetailspreview->project_under_package ?? ''}}</td>
                <th>Project Type</th>
                <td>{{$progressDetailspreview->project_type ?? ''}}</td>
            </tr>
            <tr>
                <th>MNRE sanction date</th>
                <td>{{$progressDetailspreview->mnre_sanction_date ?? ''}}</td>
                <th>Date of Notice inviting Tender</th>
                <td>{{$progressDetailspreview->tender_notice_date ?? ''}}</td>
            </tr>
            <tr>
                <th>Last date of submission of Tenders</th>
                <td>{{$progressDetailspreview->last_submission_date ?? ''}}</td>
                <th>Date of opening Technical Bids</th>
                <td>{{$progressDetailspreview->technical_bid_opening_date ?? ''}}</td>
            </tr>
            <tr>
                <th>Date of opening Financial Bids</th>
                <td>{{$progressDetailspreview->financial_bid_opening_date ?? ''}}</td>
                <th>Date of Award of Package</th>
                <td>{{$progressDetailspreview->award_package_date ?? ''}}</td>
            </tr>
            <tr>
                <th>Anticipated Commissioning Date as per Award letter</th>
                <td>{{$progressDetailspreview->comm_date_award_letter ?? ''}}</td>
                <th>DPR Cost as per Sanction (Rs. Crore)</th>
                <td>{{$progressDetailspreview->dpr_cost ?? ''}}</td>
            </tr>
            <tr>
                <th>Awarded Cost(Rs. Crore)</th>
                <td>{{$progressDetailspreview->awarded_cost ?? ''}}</td>
                <th>Physical Progress</th>
                <td>{{$progressDetailspreview->physical_progess ?? ''}}</td>
            </tr>
            <tr>
                <th>Expenditure in Package (Rs. Crore)</th>
                <td>{{$progressDetailspreview->package_expenditure ?? ''}}</td>
                <th>Financial Progress in % (Expenditure / Awarded Cost)</th>
                <td>{{$progressDetailspreview->financial_progress ?? ''}}</td>
            </tr>
            <tr>
                <th>Details of Land/Crop compensation fixation by District Authorities</th>
                <td>{{$progressDetailspreview->land_detail ?? ''}}</td>
                <th>Details of Forest Clearance</th>
                <td>{{$progressDetailspreview->forest_clearance_details ?? ''}}</td>
            </tr>
            <tr>
                <th>Remarks / Issues, if any</th>
                <td colspan="3">{{$progressDetailspreview->remark ?? ''}}</td>
            </tr>
            <tr>
                <td><br><br><br></td>
            </tr>
            <tr class="bg-dark text-light" style="background-color:{{$color}} !important">
                <th>
                    Status
                </th>
                <td colspan="3">{{$progressDetailspreview->status ?? ''}}</td>
            </tr>
            <tr class="bg-dark text-light" style="background-color:{{$color}} !important">
                <th>
                    GECMNRE Remark
                </th>
                <td colspan="3">{{$progressDetailspreview->gecmnre_remark ?? ''}}</td>
            </tr>
            <td colspan="4"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Remarks
                </button>
                <!-- <button type="button" class="btn btn-lg btn-primary"> Remarks</button> -->
            </td>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form action="{{ URL::to(Auth::getDefaultDriver().'/preview-gec-report') }}" id="formFileAjax"
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
                                    <div class="dropdown">
                                        <label for="">Select Status</label>
                                        <select class="form-control" aria-label="Default select example" name="status">
                                            <option value=''>Select</option>
                                            <option value="1">Approve</option>
                                            <option value="2">Partial Approve</option>
                                            <option value="3">Reject</option>
                                        </select>
                                    </div> <br>
                                    <label for=""> Remark</label>
                                    <textarea name="gecremark" class="form-control" id="" cols="5" rows="3"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <input type="hidden" name="editId" value="{{$progressDetailspreview->id}}">
                                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            </tr>

        </table>
    </main>
</section>
@endsection
<script>
$(document).ready(function() {
    $(".btn").click(function() {
        $("#sel1").modal('show');
    });
});
</script>
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush