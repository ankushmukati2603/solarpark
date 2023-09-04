@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Signing of PSA</h1>
                        <hr style="color: #959595;">
                        <form action="{{URL::to(Auth::getDefaultDriver().'/SigningOfPSA')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                    <div class=""><label>Select Tender <span class="text-danger">*</span></label></div>
                                    <div class=""><select name="tender" id="tender_id"
                                            class="form-control tenderSelectBox">
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
                                <tr class="bg-primary text-light">
                                    <th colspan="4">
                                        <h4>PPA/PSA Details</h4>
                                    </th>
                                </tr>
                                <span id="ppaData"></span>


                            </table>

                        </form>
                    </div>
                </div>

        </section>
    </main>
</section>

@endsection
@push('backend-js')

<script>
function checkMaxCapacity() {
    var totalCapacity = $('#maxCapacity').html();
    // alert(totalCapacity);
    var sum = 0;
    $(".capacity_psa").each(function() {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
        if (parseInt(totalCapacity) < sum) {
            alert('Capacity should not be greater than assigned capacity i.e ' + totalCapacity + ' MW');
            this.value = '';
            return false;
        }
    });

}
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
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/ajaxSelectedBidderPSAData/' + bidders + '/' +
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
    }
});
</script>


<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>

@endpush