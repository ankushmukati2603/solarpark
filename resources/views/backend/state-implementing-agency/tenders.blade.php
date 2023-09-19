@inject('general', 'App\Http\Controllers\Backend\SNA\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <a href="javascript:;" id="reportExcel" class="btn btn-danger"
                            style="margin-right: 5px;float:right"><i class="fa fa-download" aria-hidden="true"></i>
                            Export Commissioned Report</a>
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Tenders/Add')}}" class="btn btn-success"
                            style="margin-right: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add Tender</a>

                        <h1>Tender Management</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th>S.No</th>
                                <th>Tender No</th>
                                <th width="15%">NIT No</th>
                                <th>Scheme Type</th>
                                <th width="20%">Tender Title</th>
                                <th>Capacity(MW)</th>
                                <th>Pre Bid Meeting</th>
                                <th>Last Date of Bid Submission</th>
                                <th>Published Date</th>
                                <th width="10%">Status</th>
                                <th>MNRE Remarks</th>
                                <th width="8%">Action</th>
                            </tr>
                            @foreach($tenderList as $tender)
                            <?php
                            $countLocations=\App\Models\SelectedBidderProject::where('tender_id',$tender->id)->count();
                            $countCommissionedLocations=\App\Models\SelectedBidderProject::where('tender_id',$tender->id)->whereNotNull('commissioned_details')->count();
                            
                            ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $tender->tender_no }}</td>
                                <td>{{ $tender->nit_no }}</td>
                                <td>{{ $tender->scheme_type}}</td>
                                <td>{{ $tender->tender_title }}</td>
                                <td>{{ $tender->capacity }}</td>
                                <td>{{ date("d M Y",strtotime($tender->pre_bid_meeting_date)) }}</td>
                                <td>{{ date("d M Y",strtotime($tender->bid_submission_date)) }}</td>
                                <td>{{ date("d M Y",strtotime($tender->nit_date)) }}</td>
                                <td>{{$general->tenderStatus($tender->tender_status,$tender->id)}}</td>
                                <td>{{ $tender->mnre_remarks ?? '--' }}</td>
                                <td>
                                    @if($tender->tender_status !=4 || $countLocations>$countCommissionedLocations )<a
                                        href=" {{URL::to(Auth::getDefaultDriver().'/Tenders/Edit/'.$tender->id)}}"
                                        class="btn btn-danger" target="_blank"><i class="fa-solid fa-pencil"></i></a>
                                    @endif
                                    @if($tender->tender_status ==4)
                                    <a href=" {{URL::to(Auth::getDefaultDriver().'/TenderPreview/'.base64_encode($tender->id))}}"
                                        target="_blank" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                    @endif






                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    {{ $tenderList->links() }}
                </div>
            </div>
            <span id="exceldata" style="display:none;"></span>
    </main>
</section>
<!-- </section> -->

@endsection
@push('backend-js')
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
$('#reportExcel').on('click', function() {
    $('#loading-bg-ajax').removeClass('hide');

    $.ajax({
        type: 'GET',
        url: baseUrl + '/{{Auth::getDefaultDriver()}}/tenderexcelreport',
        success: function(data) {
            $('#loading-bg-ajax').addClass('hide');
            if (data.status == 'error') {
                $('#exceldata').html('Error');
            } else {
                $('#exceldata').html(data.result);
                ExportToExcel('xlsx');
            }
        }
    });
});

function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('stakeHoldersTable1');
    var wb = XLSX.utils.table_to_book(elt, {
        sheet: "sheet1"
    });
    var wscols = [{
        wpx: 100
    }];
    wb['cols'] = wscols;
    return dl ?
        XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        }) :
        XLSX.writeFile(wb, fn || ('tenderdetail.' + (type || 'xlsx')));
}
</script>
@endpush