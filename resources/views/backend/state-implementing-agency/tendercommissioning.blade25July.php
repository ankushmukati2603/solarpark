@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tender Commissioning</h1>
        </div>
        <section class="section dashboard">
            <form action="{{URL::to(Auth::getDefaultDriver().'/TenderCommissioning')}}" method="POST">
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
                            <h4>Tender Commissioning Details</h4>
                        </th>
                    </tr>
                    <span id="ppaData"></span>
                </table>
                <span id="ppaData"></span>
            </form>
        </section>
    </main>
</section>

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
    }

});
$('#bidders').on('change', function() {
    var bidders = $('#bidders').val();
    var tender_id = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
    if (bidders) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/ajaxTenderComissioningData/' + bidders + '/' +
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