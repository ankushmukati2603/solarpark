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
                                <select name="tender" id="tender_id" class="form-control">
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
                                <select name="bidders" id="bidders" class="form-control">
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
                    <tr>
                        <th width="20%">Schedule Commissiong Date <span class="text-danger">*</span></th>
                        <td width="30%">
                            <input type="date" class="form-control pull-right alldatepicker "
                                id="schedule_commissiong_date" placeholder="MM-DD-YYYY" name="schedule_commissiong_date"
                                value="">
                        </td>
                        <th width="20%">Commissioned Capacity(MW) <span class="text-danger">*</span></th>
                        <td width="30%">
                            <input type="number" step="any" class="form-control" id="commissioned_capacity"
                                placeholder="Enter Commissioned Capacity(MW)" name="commissioned_capacity" value="">
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Actual Commissiong Date <span class="text-danger">*</span></th>
                        <td width="30%">
                            <input type="date" class="form-control pull-right alldatepicker "
                                id="actual_commissiong_date" placeholder="MM-DD-YYYY" name="actual_commissiong_date"
                                value="">
                        </td>
                        <th width="20%">Actual Commissioned Capacity(MW) <span class="text-danger">*</span></th>
                        <td width="30%">
                            <input type="number" step="any" class="form-control" id="actual_commissioned_capacity"
                                placeholder="Enter Actual Commissioned Capacity(MW)" name="actual_commissioned_capacity"
                                value="">
                        </td>
                    </tr>

                    <tr>
                        <th colspan="4">
                            <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                        </th>
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
$('#tender_id').on('change', function() {
    var tender = $('#tender_id').val();
    $('#loading-bg-ajax').removeClass('hide');
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