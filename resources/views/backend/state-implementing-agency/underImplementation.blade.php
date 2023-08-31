@extends('layouts.masters.backend')
@section('content')

<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Under Implementation</h1>
                    <hr style="color: #959595;">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/Under-Implementation')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Select Tender <span class="text-danger">*</span></label></div>
                                <div class=""><select name="tender" id="tender_id" class="form-control tenderSelectBox">
                                        <option value="">Select Tender</option>
                                        @foreach($tenderList as $tender)
                                        <option value="{{ base64_encode($tender->id) }}">
                                            [{{ $tender->tender_no }}] - {{ $tender->nit_no }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <i id="bidderloader"></i>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Select Bidder <span class="text-danger">*</span></label></div>
                                <div id="bidders_list"><select name="bidders" id="bidders"
                                        class="form-control tenderSelectBox">
                                        <option value="">Choose Bidder</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="ppaTbale" style="display:none;">
                            <span id="ppaData"></span>
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
$('#tender_id').on('change', function() {
    var tender = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (tender) {
        $('#ppaData').html('');
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
        $('#loading-bg-ajax').addClass('hide');
    }

});
$('#bidders').on('change', function() {
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/ajaxSelectedBidderRecords/' + bidders + '/' +
                tender_id,
            success: function(data) {
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
        $('#loading-bg-ajax').addClass('hide');
    }
});
</script>


<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>

@endpush