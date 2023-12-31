@inject('general', 'App\Http\Controllers\Backend\REIA\MainController')
@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">
        <section class="form_sctn">
            <div class="row">

            </div>
            <div class="row">

                <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>Progress Report</h1>
                            <hr style="color: #959595;">
                        </div>
                        <!-- <div class="pagetitle">
            <h1></h1>
            <nav>
                <ol class="breadcrumb">

                </ol>
            </nav>
        </div> -->
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="row   register_form">
                                    <div class="col-xl-12">
                                        <div class="col-xxl-12 section-tittle">
                                            <div class="register_hdng_text"></div>
                                        </div>
                                        @include('layouts.partials.backend._flash')
                                        <form
                                            action="{{URL::to(Auth::getDefaultDriver().'/new-reia-progress-report/')}}"
                                            method="post">
                                            @csrf

                                            <div class="row ">
                                                <div class="col-md-12 progress_report_form"
                                                    style="background: #f7f7f7; border: 1px solid #dedede; padding-top: 20px; padding-bottom: 20px; border-radius: 8px;box-shadow: 0 0 15px #0000001f;">
                                                    <div class="row">
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Name of Scheme <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="scheme_id"
                                                                name="scheme_id">
                                                                @foreach($schemes as $scheme)
                                                                @if($reia->scheme_id ==
                                                                $scheme->id)
                                                                <option value="{{$scheme->id}}" @if($reia->scheme_id ==
                                                                    $scheme->id) selected readonly
                                                                    @endif>{{$scheme->scheme_name}}
                                                                </option>
                                                                @endif
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>State <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="state_id" name="state_id"
                                                                onchange="getDistrictByState(this.value, '')">
                                                                <option value="">Select State</option>
                                                                @foreach($states as $state)
                                                                <option value="{{$state->code}}" @if($reia->state_id ==
                                                                    $state->code) selected @endif>{{$state->name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>District <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="district_id"
                                                                name="district_id"
                                                                onchange="getSubDistrictByDistrict(this.value,'')">
                                                                <option value="">Select District</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Type of Project <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select class="form-control" id="project_type"
                                                                name="project_type">
                                                                <option value="">Select Project</option>
                                                                <option value="Solar" @if($reia->project_type ==
                                                                    'Solar') selected @endif>Solar</option>
                                                                <option value="Wind" @if($reia->project_type == 'Wind')
                                                                    selected @endif>Wind</option>
                                                                <option value="Hybrid" @if($reia->project_type ==
                                                                    'Hybrid') selected @endif>Hybrid</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Tender Capacity (MW)
                                                                    <span class="text-danger">*</span></strong></label>
                                                            <div style="position: relative;">
                                                                <input placeholder="Tender Capacity ( MW )"
                                                                    name="tender_capacity" id="tender_capacity"
                                                                    type="number" step="any" class="form-control"
                                                                    value="{{$reia->tender_capacity ?? ''}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Date of Tender <span
                                                                        class="text-danger">*</span>
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <input name="tender_date" id="tender_date" type="date"
                                                                    class="form-control"
                                                                    value="{{$reia->tender_date ?? ''}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Date of LOA <span
                                                                        class="text-danger">*</span>
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <input placeholder="Date of LOA" name="loa_date"
                                                                    id="loa_date" type="date" class="form-control"
                                                                    value="{{ $reia->loa_date ?? ''}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>SCoD <span
                                                                        class="text-danger">*</span>
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <input placeholder="Date of Notice inviting Tender"
                                                                    name="scod" id="scod" type="date"
                                                                    class="form-control" value="{{ $reia->scod ?? ''}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                            <label class="pb-2" for="name"><strong>Present Status
                                                                </strong></label>
                                                            <div style="position: relative;">
                                                                <textarea type="text" placeholder="Remarks"
                                                                    name="remark" id="remark" type="text"
                                                                    class="form-control">{{ $reia->remark ?? ''}}</textarea>
                                                            </div>
                                                        </div>


                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Bidder Name<span class="text-danger">*</span>
                                                                    </th>
                                                                    <th>Bidder Capacity (MW)<span
                                                                            class="text-danger">*</span></th>
                                                                    <th>Date of PPA<span class="text-danger">*</span>
                                                                    </th>
                                                                    <th>PPA Capacity (MW)<span
                                                                            class="text-danger">*</span></th>
                                                                    <th><span class="text-danger"></span></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody">
                                                                @if($reia['ppa_capacity']!=null)
                                                                @for($i=0;$i < count($reia['bidder_id']);$i++) <tr
                                                                    id="">
                                                                    <td width="" class="row-index">
                                                                        <select name="bidder_id[]" id="bidder_id"
                                                                            class="form-control  number">
                                                                            <option value="">Choose Bidder</option>
                                                                            @foreach($bidders as $bidder)

                                                                            <option value="{{$bidder->id}}"
                                                                                @if($reia['bidder_id'][$i]==$bidder->id)
                                                                                selected @endif>{{$bidder->bidder_name}}
                                                                            </option>

                                                                            @endforeach
                                                                        </select>
                                                                        <span name="bidder_id.0"></span>
                                                                    </td>

                                                                    <td width="">
                                                                        <input type="number" step="any" min="0"
                                                                            name="select_bidders_capacity[]"
                                                                            id="txtgeneralLatitude" class="form-control"
                                                                            value="{{ $reia['select_bidders_capacity'][$i]}}">

                                                                        <span name="select_bidders_capacity.0"></span>

                                                                    </td>
                                                                    <td width="" class="row-index">
                                                                        <input
                                                                            placeholder="Date of Notice inviting Tender"
                                                                            name="ppa_date[]" id="ppa_date" type="date"
                                                                            class="form-control"
                                                                            value="{{ $reia['ppa_date'][$i]}}">
                                                                        <span name="ppa_date.0"></span>
                                                                    </td>

                                                                    <td width=""> <input
                                                                            placeholder="Date of Notice inviting Tender (MW)"
                                                                            name="ppa_capacity[]" id="ppa_capacity"
                                                                            type="number" step="any"
                                                                            class="form-control"
                                                                            value="{{ $reia['ppa_capacity'][$i]}}">
                                                                        <span name="ppa_capacity.0"></span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if($i==0)
                                                                        <button class="btn btn-md btn-primary"
                                                                            id="addBtn" type="button">
                                                                            Add new Row
                                                                        </button>
                                                                        @else
                                                                        <button class="btn btn-danger remove"
                                                                            type="button">Remove</button>
                                                                        @endif
                                                                    </td>
                                                                    </tr>
                                                                    @endfor
                                                                    @else

                                                                    <tr id="">
                                                                        <td width="" class="row-index">
                                                                            <select name="bidder_id[]" id="bidder_id"
                                                                                class="form-control  number">
                                                                                <option value="">Choose Bidder</option>
                                                                                @foreach($bidders as $bidder)
                                                                                <option value="{{$bidder->id}}">
                                                                                    {{$bidder->bidder_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <span name="bidder_id.0"></span>
                                                                        </td>

                                                                        <td width="">
                                                                            <input type="number" step="any" min="0"
                                                                                name="select_bidders_capacity[]"
                                                                                id="txtgeneralLatitude"
                                                                                class="form-control" value="">

                                                                            <span
                                                                                name="select_bidders_capacity.0"></span>

                                                                        </td>
                                                                        <td width="" class="row-index">
                                                                            <input
                                                                                placeholder="Date of Notice inviting Tender"
                                                                                name="ppa_date[]" id="ppa_date"
                                                                                type="date" class="form-control"
                                                                                value="">
                                                                            <span name="ppa_date.0"></span>
                                                                        </td>

                                                                        <td width=""> <input
                                                                                placeholder="PPA Capacity (MW)"
                                                                                name="ppa_capacity[]" id="ppa_capacity"
                                                                                type="number" step="any"
                                                                                class="form-control" value="">
                                                                            <span name="ppa_capacity.0"></span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <button class="btn btn-md btn-primary"
                                                                                id="addBtn" type="button">
                                                                                Add new Row
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                            </tbody>
                                                        </table>

                                                        <div class="col-xxl-12 text-center pt-3 pb-3">
                                                            <input type="button" name="save"
                                                                class="mt-1 btn btn-success" value="Save as draft"
                                                                onclick="submitMe(this)">
                                                            <input type="button" name="submit"
                                                                class="mt-1 btn btn-success" value="Submit"
                                                                onclick="submitMe(this)">


                                                            <input type="hidden" name="editId"
                                                                value="{{ $general->encodeid($id) ?? ''}}">
                                                            <input type="hidden" name="final" id="final" value="0">
                                                            <input type="submit" id="submit" name="save"
                                                                style="display:none;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    </main>
</section>
@endsection
@section('scripts')

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
<script>
$(document).ready(function() {
    var rowIdx = 0;
    // jQuery button click event to add a row
    $('#addBtn').on('click', function() {
        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
         <td class="row-index">
         <select name="bidder_id[]" id="bidder_id" class="form-control  number">
                    <option value="">Choose Bidder</option>
                    @foreach($bidders as $bidder)
                                        <option value="{{$bidder->id}}">{{$bidder->bidder_name}}</option>
                                        @endforeach
                </select>
                <span name="bidder_id.${rowIdx}"></span>
            </td>
            
            <td> <input type="number" step="any" min="0" name="select_bidders_capacity[]"
                    id="txtgeneralLatitude" class="form-control"
                    value="">
                    <span name="select_bidders_capacity.${rowIdx}"></span>
            </td>
            <td width="" class="row-index">
            <input placeholder="Date of Notice inviting Tender" name="ppa_date[]"  id="ppa_date" type="date" 
            class="form-control" >
                <span name="ppa_date.0"></span>
            </td>

            <td width=""> <input placeholder="Date of Notice inviting Tender (MW)" name="ppa_capacity[]"  
            id="ppa_capacity" type="number" step="any"  class="form-control" value="" >
                <span name="ppa_capacity.0"></span>
            </td>
            <td class="text-center">
                <button class="btn btn-danger remove"
                type="button">Remove</button>
                </td>
            </tr>`);
    });
    $('#tbody').on('click', '.remove', function() {
        var child = $(this).closest('tr').nextAll();
        child.each(function() {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
        });
        $(this).closest('tr').remove();
        rowIdx--;
    });
});

function submitMe(dt) {
    // alert($(dt).attr('name'));
    if ($(dt).attr('name') == 'submit') {
        $('#final').val(1);
    } else {
        $('#final').val(0);
    }
    $('#submit').trigger("click");
}

$(document).ready(function() {
    //alert('hi');
    getDistrictByState('{{$reia->state_id}}', '{{$reia->district_id}}');
    getSubDistrictByDistrict('{{ $reia->district_id }}',
        '{{$reia->sub_district_id }}');

});
</script>
@endpush
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}

.row.progress_report_form {
    background: #f7f7f7;
    border: 1px solid #dedede;
    padding-top: 20px;
    padding-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px #0000001f;
}
</style>
@endsection