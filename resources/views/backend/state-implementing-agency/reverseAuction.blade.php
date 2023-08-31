@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Reverse Auction</h1>
                        <hr style="color: #959595;">
                    </div>
                    <form action="{{URL::to(Auth::getDefaultDriver().'/ReverseAuction')}}" method="POST">
                        @csrf
                        @include('backend/state-implementing-agency/tenderSearch')
                        <div class="row" style="display:none" id="reversTable">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Reverse Auction Date <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><input type="date" name="ra_date" id="ra_date" class="form-control"
                                        value="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Reverse Auction Type <span class="text-danger">*</span></label>
                                </div>
                                <div class="">
                                    <select name="ra_type" id="ra_type" class="form-control">
                                        <option value="">Select RA Type</option>
                                        <option value="Full">Full</option>
                                        <option value="Partial">Partial</option>
                                    </select>
                                    <input type="hidden" name="cap_awarded_full" id="cap_awarded_full" value="" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3" style="display:none" id="cap_row">
                                <div class=""><label class="cap_awd" style="display:none">Capacity Awarded(MW) <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class=""><span class="cap_awd" style="display:none">
                                        <input type="number" step="any" name="capacity_awarded" id="capacity_awarded"
                                            class="form-control" value=""></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3" style="display:none" id="cap_row_1">
                                <div class=""><label>RA Capacity(MW) <span class="text-danger">*</span></label></div>
                                <div class="" id="ra_capacity_total"></div>
                            </div>
                            <div class="col-xl-12" style="display:none" id="submit_form">
                                <div class=" pt-4 text-center">
                                    <input type="hidden" id="page_type" name="page_type" value="{{$page ?? ''}}">
                                    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/ReverseAuction')}}"
                                        class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</section>

@endsection
@push('backend-js')
<script>
$('#ra_type').on('change', function() {
    $('.cap_awd').hide();
    $('#cap_row').hide();
    $('#cap_row_1').hide();
    $('#ra_capacity_total').html('');
    $('#submit_form').hide();
    $('#ra_capacity').val($('#tender_capacity').text());
    $('#cap_awarded_full').val($('#tender_capacity').text());
    if (this.value == "Partial") {
        $('.cap_awd').show();
        $('#cap_row').show();
        $('#cap_row_1').show();

        $('#capacity_awarded').val('');
    } else {
        $('#submit_form').show();

        $('#ra_capacity_total').html($('#tender_capacity').text());
    }
});
$("#capacity_awarded").blur(function() {
    $('#submit_form').hide();
    var capacity_awarded = $('#capacity_awarded').val();
    var tender_capacity = $('#tender_capacity').text()
    var ra_capacity = 0;
    // alert(capacity_awarded + '------' + tender_capacity);
    if (parseInt(capacity_awarded) > parseInt(tender_capacity)) {
        alert('Awarded capacity should not be greater than tender capacity');
        $('#ra_capacity_total').html('');
    } else {
        ra_capacity = tender_capacity - capacity_awarded;
        $('#ra_capacity_total').html(Number(ra_capacity).toFixed(2));
        $('#submit_form').show();
    }

});
</script>
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>

@endpush