@extends('layouts.masters.backend')
@section('content')

<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Cancel Tender</h1>
                    <hr style="color: #959595;">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/CancelTender')}}" method="POST">
                        @csrf
                        @include('backend/state-implementing-agency/tenderSearch')
                        <table class="table table-bordered" style="display:none" id="reversTable">
                            <tr>
                                <th width="20%">Cancelled Date <span class="text-danger">*</span></th>
                                <td width="30%"><input type="date" name="cancel_date" id="cancel_date"
                                        class="form-control" value="">
                                </td>
                                <th width="20%">Cancel Tender Type <span class="text-danger">*</span></th>
                                <td>
                                    <select name="cancel_type" id="cancel_type" class="form-control">
                                        <option value="">Select Cancel Type</option>
                                        <option value="Full">Full</option>
                                        <option value="Partial">Partial</option>
                                    </select>
                                    <input type="hidden" name="cap_awarded_full" id="cap_awarded_full" value="" />
                                </td>
                            </tr>
                            <tr style="display:none" id="cap_row">

                                <th> <span class="cap_awd" style="display:none">Capacity Cancelled(MW) <span
                                            class="text-danger">*</span></span> </th>
                                <td> <span class="cap_awd" style="display:none">
                                        <input type="number" step="any" name="cancel_capacity" id="cancel_capacity"
                                            class="form-control" value=""></span></td>
                                <th>Capacity(MW) </th>
                                <td id="ra_capacity_total">
                                </td>
                            </tr>
                            <tr style="display:none1" id="cap_remark">

                                <th> <span class="cap_awd" style="display:none1">Remarks <span
                                            class="text-danger">*</span></span> </th>
                                <td colspan="3">
                                    <textarea name="cancel_remark" id="cancel_remark" class="form-control" cols="30"
                                        rows="5"></textarea>
                                </td>
                            </tr>
                            <tr style="display:none" id="submit_form">
                                <td colspan="4">
                                    <input type="hidden" id="page_type" name="page_type" value="{{$page ?? ''}}">
                                    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </section>
</main>


@endsection
@push('backend-js')
<script>
$('#cancel_type').on('change', function() {
    $('.cap_awd').hide();
    $('#cap_row').hide();
    $('#cap_remark').hide();
    $('#ra_capacity_total').html('');
    $('#submit_form').hide();
    $('#ra_capacity').val($('#tender_capacity').text());
    $('#cap_awarded_full').val($('#tender_capacity').text());
    if (this.value == "Partial") {
        $('.cap_awd').show();
        $('#cap_row').show();
        $('#cap_remark').show();
        $('#capacity_awarded').val('');
    } else {
        $('#submit_form').show();
        $('.cap_awd').show();
        $('#cap_remark').show();
        $('#ra_capacity_total').html($('#tender_capacity').text());
    }
});
$("#cancel_capacity").blur(function() {
    $('#submit_form').hide();
    var cancel_capacity = $('#cancel_capacity').val();
    var tender_capacity = $('#tender_capacity').text()
    var ra_capacity = 0;
    // if (parseInt(capacity_awarded) > parseInt(tender_capacity)) {
    if (parseInt(cancel_capacity) > parseInt(tender_capacity)) {
        alert('Cancel capcity should not greater then tender Capacity');

    } else {
        ra_capacity = tender_capacity - cancel_capacity;
        $('#ra_capacity_total').html(Number(ra_capacity).toFixed(2));
        $('#submit_form').show();
    }

});
</script>
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>

@endpush