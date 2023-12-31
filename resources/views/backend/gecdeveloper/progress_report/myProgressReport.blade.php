@inject('general', 'App\Http\Controllers\Backend\Mnre\MainController')
@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>Green Energy Coridor (GEC Phase II)</h1>
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/new-gec-progress-report')}}"
                            class="btn btn-success" style="float: right;"><i class="fa fa-plus"
                                aria-hidden="true"></i>Progress
                            Report</a>

                        <hr style="color: #959595;">
                        <form action="{{url(Auth::getDefaultDriver().'/progress-report')}}" method="post">@csrf
                            <div class="row col-md-12 ">
                                <div class="col-md-6">
                                    <label>Submitted On<span class="error">*</span></label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control alldatepicker "
                                            id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="date" value="">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('date') }}</span>
                                </div>
                                <div class="col-md-4"><br>
                                    <button class="btn btn-md btn-info" type="submit">Search</button>
                                </div>
                            </div>

                        </form>

                        <div class="clearfix"></div><br>


                        <table class="table table-bordered">
                            <tr class=" bg-success text-light">
                                <th>S.No</th>
                                <th>Report <br>
                                    Month / Year
                                </th>
                                <th>Project Type</th>
                                <th>MNRE Sanction Date</th>
                                <th>Tender Notice Date</th>
                                <th>DPR Cost (In Cr)</th>
                                <th>Awarded Cost (In Cr)</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Remarks by MNRE</th>
                                <th>Action</th>
                            </tr>
                            @if(!Empty($progressDetails))
                            @php $generalData='' @endphp
                            @foreach($progressDetails as $progressData)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$progressData['month'] .'/'. $progressData['year']}}</td>
                                <td>
                                    @if($progressData['project_type']==1)
                                    Line
                                    @elseif($progressData['project_type']==2)
                                    SS
                                    @elseif($progressData['project_type']==3)
                                    Bays
                                    @elseif($progressData['project_type']==4)
                                    Reactors
                                    @elseif($progressData['project_type']==5)
                                    Procurement work
                                    @else
                                    Other
                                    @endif

                                </td>
                                <td>{{$progressData['mnre_sanction_date'] ?? '--' }}</td>
                                <td>{{$progressData['tender_notice_date'] ?? '--' }}</td>
                                <td>{{$progressData['dpr_cost'] ?? '--' }}</td>
                                <td>{{$progressData['awarded_cost'] ?? '--' }}</td>
                                <td>{{$progressData['entry_date'] ?? '--' }}</td>
                                <td>@if($progressData['status']==1)
                                    Reviewd
                                    @else
                                    Pending
                                    @endif</td>
                                <td>{{$progressData['gecmnre_remark'] ?? 'NA' }}</td>
                                <td>@if($progressData->final_submission ==0)
                                    <a href="{{URL::to(Auth::getDefaultDriver().'/application/progress_report/'.$general->encodeid($progressData['id']))}}"
                                        class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                    @else
                                    <a href="{{URL::to(Auth::getDefaultDriver().'/preview-progress-report/'.$general->encodeid($progressData['id']))}}"
                                        class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11">No Record Found</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                </div>
            </div>

    </main>
    <style>
    .col-md-3 {
        flex: 0 0 auto;
        width: 25%;
        display: inline-block !important;
    }
    </style>
</section>
@endsection
<style>
.error {
    color: red
}
</style>
<script src="{{asset('public/js/custom.js')}}"></script>