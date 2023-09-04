@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Project Location</h1>
        </div>
        <section class="section dashboard">
            <form action="{{URL::to(Auth::getDefaultDriver().'/ProjectLocation')}}" method="POST">
                @csrf

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="15%">Select Tender <span class="text-danger">*</span></th>
                            <td width="35%">
                                <select name="tender" id="tender_id" class="form-control tenderSelectBox">
                                    <option value="">Select Tender</option>
                                    @foreach($tenderList as $tender)
                                    <option value="{{ base64_encode($tender->id) }}">
                                        [{{ $tender->tender_no }}] - {{ $tender->nit_no }}
                                    </option>
                                    @endforeach
                                </select>
                                <i id="bidderloader"></i>
                                <!-- <button class="btn btn-primary" id="searchTender" on>Search</button> -->
                            </td>
                            <th width="15%">Select Bidder<span class="text-danger">*</span></th>
                            <td width="35%" id="bidders_list">
                                <select name="bidders" id="bidders" class="form-control tenderSelectBox">
                                    <option value="">Choose Bidder</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" id="ppaTbale" style="display:none;">
                    <tr class="bg-primary text-light">
                        <th colspan="4">
                            <h4>Project Location</h4>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>State <span class="text-danger">*</span></th>
                                        <th>Districts <span class="text-danger">*</span></th>
                                        <th>Tehsil <span class="text-danger">*</span> </th>
                                        <th>Village<span class="text-danger">*</span></th>
                                        <th>Latitude <span class="text-danger">*</span></th>
                                        <th>Longitude <span class="text-danger">*</span></th>
                                        <th>Project Location Given Date <span class="text-danger">*</span></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr id="">
                                        <td class="row-index" width="10%">Project 1</td>
                                        <td width="15%"> <select name="state[]" id="state" class="form-control"
                                                onchange="getDistrictByState(this.value,'')">
                                                <option value="">Choose State</option>
                                                @foreach($states as $state)
                                                <option value="{{$state->code}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                            <span name="state.0"></span>
                                        </td>
                                        <td width="15%">
                                            <select name="district_id[]" id="district_id" class="form-control"
                                                onchange="getSubDistrictByDistrict(this.value,'')">
                                                <option value="" selected>Select District</option>
                                            </select>
                                            <span name="district_id.0"></span>
                                        </td>

                                        <td width="15%">
                                            <select class="form-control" id="sub_district_id" name="sub_district_id[]"
                                                onchange="getVillageBySubDistrict(this.value,'')">
                                                <option value="" selected>Select Sub-District</option>
                                            </select>
                                            <span name="sub_district_id.0"></span>
                                        </td>
                                        <td width="15%"> <select class="form-control " id="village_id"
                                                name="village_id[]">
                                                <option value="" selected>Select Village</option>
                                            </select>
                                            <span name="village_id.0"></span>
                                        </td>
                                        <td width="15%"> <input type="text" placeholder="Enter Latitude" name="lat[]"
                                                id="lat" class="form-control " value="">
                                            <span name="lat.0"></span>
                                        </td>
                                        <td width="15%"> <input type="text" placeholder="Enter Longitude" name="lng[]"
                                                id="lng" class="form-control " value="">
                                            <span name="lng.0"></span>
                                        </td>
                                        <td width="15%"> <input type="date" name="project_location_date[]"
                                                id="project_location_date" class="form-control " value="">
                                            <span name="project_location_date.0"></span>
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-md btn-primary" id="addBtn" type="button"> +
                                            </button>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="hidden" id="page_type" name="page_type" value="{{$page ?? ''}}">
                            <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                        </td>
                    </tr>


                </table>
                <span id="ppaData"></span>
            </form>
        </section>
    </main>
</section>

@endsection
@push('backend-js')
<script>
$(document).ready(function() {
    // Denotes total number of rows
    var rowIdx = 0;
    // jQuery button click event to add a row
    $('#addBtn').on('click', function() {
        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
        <td class="row-index">Project ${rowIdx+1}</td>
            <td> <select name="state[]" id="state${rowIdx}" class="form-control"
                    onchange="getDistrictByState(this.value,'',${rowIdx})">
                    <option value="">Choose State</option>
                    @foreach($states as $state)
                    <option value="{{$state->code}}">{{$state->name}}</option>
                    @endforeach
                </select>
                <span name="state.${rowIdx}"></span>
            </td>
            <td>
                <select name="district_id[]" id="district_id${rowIdx}" class="form-control"
                    onchange="getSubDistrictByDistrict(this.value,'',${rowIdx})">
                    <option value="" selected>Select District</option>
                </select>
                <span name="district_id.${rowIdx}"></span>
            </td>

            <td>
                <select class="form-control" id="sub_district_id${rowIdx}" name="sub_district_id[]"
                    onchange="getVillageBySubDistrict(this.value,'',${rowIdx})">
                    <option value="" selected >Select Sub-District</option>
                </select>
                <span name="sub_district_id.${rowIdx}"></span>
            </td>
            <td>  <select class="form-control " id="village_id${rowIdx}" name="village_id[]">
                        <option value="" selected >Select Village</option>
                    </select>
                <span name="village_id.${rowIdx}"></span>
            </td>
            <td> <input type="text" placeholder="Enter Latitude" name="lat[]" id="lat"
                    class="form-control " value="">
                <span name="lat.${rowIdx}"></span>
            </td>
            <td> <input type="text" placeholder="Enter Longitude" name="lng[]" id="lng"
                    class="form-control " value="">
                <span name="lng.${rowIdx}"></span>
            </td>
            <td> <input type="date" name="project_location_date[]"
                    id="project_location_date" class="form-control " value="">
                <span name="project_location_date.${rowIdx}"></span>
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
</script>
<script>
$('#tender_id').on('change', function() {
    var tender = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    $('#ppaData').html('');
    if (tender) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/ajaxtenderBidder/' + tender,
            success: function(data) {
                $('#loading-bg-ajax').addClass('hide');
                if (data.status == 'error') {
                    $('#bidders').html(data.result);
                } else {
                    $('#bidders').html(data.result);

                }
            }
        });
    } else {
        alert('Please select Tender');
    }

});
$('#bidders').on('change', function() {
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/getSelectedBidderProjectData/' + bidders +
                '/' +
                tender_id,
            success: function(data) {
                $('#bidderloader').html('');
                $('#loading-bg-ajax').addClass('hide');
                if (data.status == 'success') {
                    $('#ppaTbale').hide();
                    $('#ppaData').html(data.result);
                } else {
                    $('#ppaData').html('');
                    $('#ppaTbale').show();

                }
            }
        });
    } else {
        alert('Please select Bidders');
    }
});
</script>


<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>

@endpush