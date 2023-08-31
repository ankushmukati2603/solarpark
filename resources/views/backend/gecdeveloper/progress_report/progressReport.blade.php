@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost:81/solar_park/beneficiary">Home</a></li>
                    <li class="breadcrumb-item active">Progress Report Data</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row   register_form">
                    <div class="col-xl-12">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text"></div>
                        </div>
                        @include('layouts.partials.backend._flash')
                        <form action="{{URL::to(Auth::getDefaultDriver().'/application/progress_report/')}}"
                            method="post">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Package No.</strong></label>
                                    <div style="position: relative;">
                                        <input type="text" name="package_no" class="form-control"
                                            placeholder="Package Number" value="{{$generalData->package_no ?? ''}}">

                                    </div>
                                </div>
                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Package Name</strong></label>
                                    <div style="position: relative;">
                                        <input type="text" name="package_name" class="form-control"
                                            placeholder="Package Name" value="{{$generalData->package_name ?? ''}}">

                                    </div>
                                </div>

                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Projects under the Package</strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Projects under the Package" name="project_under_package"
                                            type="text" class="form-control"
                                            value="{{$generalData->project_under_package ?? ''}}">
                                    </div>
                                </div>
                                <div class=" form-group col-lg-6">
                                    <label for="name"><strong>Project Type</strong></label>
                                    <select class="form-control" id="project_type" name="project_type">
                                        <option value="">Select Package Name</option>
                                        <option value="1">Line</option>
                                        <option value="2">SS</option>
                                        <option value="3">Bays</option>
                                        <option value="4">Reactors</option>
                                        <option value="5">Procurement Work</option>
                                        <option value="6">Others
                                        </option>
                                    </select>
                                </div>
                                @if($generalData['project_type_others']=='6')
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Others" name="project_type_others" id="project_type_others"
                                            type="text" class="form-control"
                                            value="{{$generalData->project_type_others ?? ''}}">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>MNRE sanction date
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input name="mnre_sanction_date" id="mnre_sanction_date" type="date"
                                            class="form-control" value="{{$generalData->mnre_sanction_date ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of Notice inviting Tender
                                        </strong></label>
                                    <div style="position: relative;">
                                        <input placeholder="Date of Notice inviting Tender" name="tender_notice_date"
                                            id="tender_notice_date" type="date" class="form-control"
                                            value="{{$generalData->tender_notice_date ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Last date of submission of Tenders
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Last date of submission of Tenders"
                                            name="last_submission_date" id="last_submission_date" type="date"
                                            class="form-control" value="{{$generalData->last_submission_date ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of opening Technical Bids
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Date of opening Technical Bids"
                                            name="technical_bid_opening_date" id="technical_bid_opening_date"
                                            type="date" class="form-control"
                                            value="{{$generalData->technical_bid_opening_date ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of opening Financial Bids
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Date of opening Financial Bids"
                                            name="financial_bid_opening_date" id="financial_bid_opening_date"
                                            type="date" class="form-control"
                                            value="{{$generalData->financial_bid_opening_date ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Date of Award of Package</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Date of Award of Package" name="award_package_date"
                                            id="award_package_date" type="date" class="form-control"
                                            value="{{$generalData->award_package_date ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Anticipated Commissioning Date as per Award letter
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Anticipated Commissioning Date as per Award letter"
                                            name="comm_date_award_letter" id="comm_date_award_letter" type="date"
                                            class="form-control" value="{{$generalData->comm_date_award_letter ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>DPR Cost as per Sanction (Rs. Crore)
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="DPR Cost as per Sanction (Rs. Crore)" name="dpr_cost"
                                            id="dpr_cost" type="text" class="form-control"
                                            value="{{$generalData->dpr_cost ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>"Awarded Cost(Rs. Crore)"
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Awarded Cost(Rs. Crore)" name="awarded_cost"
                                            id="awarded_cost" type="text" class="form-control"
                                            value="{{$generalData->awarded_cost  ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Physical Progress
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Physical Progress" name="physical_progess"
                                            id="physical_progess" type="text" class="form-control"
                                            value="{{$generalData->physical_progess ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Expenditure in Package (Rs. Crore)</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Expenditure in Package" name="package_expenditure"
                                            id="package_expenditure" type="text" class="form-control"
                                            value="{{$generalData->package_expenditure ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Financial Progress in % (Expenditure / Awarded
                                            Cost)</strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="Expenditure in Package" name="financial_progress" id=""
                                            type="text" class="form-control"
                                            value="{{$generalData->financial_progress ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Details of Land/Crop compensation fixation by District
                                            Authorities
                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input
                                            placeholder="Details of Land/Crop compensation fixation by District Authorities"
                                            name="land_detail" id="land_detail" type="text" class="form-control"
                                            value="{{$generalData->land_detail ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Details of Forest Clearance

                                        </strong></label>
                                    <div class="input-group mb-3">
                                        <input placeholder="PAN Number" name="forest_clearance_details"
                                            id="forest_clearance_details" type="text" class="form-control"
                                            value="{{$generalData->forest_clearance_details ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="name"><strong>Remarks / Issues, if any</strong></label>
                                    <div class="input-group mb-3">
                                        <textarea name="remark" id="remark"
                                            class="form-control">{{$generalData->remark ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12 text-center pt-3 pb-3">
                                    <input type="submit" id="submit"
                                        class="mt-1 btn btn-success @isset($editable) hidden @endisset" value="Save"
                                        onclick="">
                                    @if(($generalData->final_submission ?? '') == 0)
                                    <input type="button" class="mt-1 btn btn-success" name="final_submission"
                                        onclick="final_submission_save()" value="Final Submission">
                                    <input type="hidden" name="editId" value="{{$generalData->id ?? ''}}">
                                    <input type="hidden" name="submit_type" id="submit_type" value="0">
                                    @endif
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark  footer_nav">
    <div class="container-fluid d-flex justify-content-center">
        <div class="copyright-content d-flex align-items-center justify-content-center">
            <img class="footer_nic_logo" src="{{ URL::asset('public/images/footerNIC.png')}}">
            <div> Portal Content Managed by <strong> <a title="GoI, External Link that opens in a new window"
                        href="https://mnre.gov.in"><strong>Ministry of New and Renewable
                            Energy</strong></a></strong>
                <br><span>Designed, Developed and Hosted by <a title="NIC, External Link that opens in a new window"
                        href="https://www.nic.in"><strong class="highlight_text_blue">National Informatics
                            Centre (NIC)</strong></a></span>
            </div>
        </div>
    </div>
</nav>
@endsection
@section('scripts')

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>

<!-- sanjeev -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<script>
function final_submission_save() {
    if (confirm('Are You Sure ? Once You Submit Your Application, You Will Not Update it Latter')) {
        $('#submit_type').val(1);
        $('#submit').trigger('click');
    } else {
        return false;
    }
}
// $(function() {
//     $("#mnre_sanction_date").datepicker({
//         maxDate: 0,
//         dateFormat: 'dd/mm/yy',
//     });
//     $("#mnre_sanction_date,#tender_notice_date,#last_submission_date,#technical_bid_opening_date,#award_package_date,#comm_date_award_letter")
//         .datepicker({
//             dateFormat: 'dd/mm/yy',
//         });
// });
</script>

<!-- sanjeev -->
@endpush
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
@endsection