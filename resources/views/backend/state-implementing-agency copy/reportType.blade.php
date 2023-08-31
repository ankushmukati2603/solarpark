@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <!-- <h1>Dashboard</h1> -->
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active"><a
                            href="{{URL::to(Auth::getDefaultDriver().'/recieved-progress-report')}}">Progress
                            Report Data</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{URL::to(Auth::getDefaultDriver().'/report-type')}}">Report Type</a>
                    </li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif
            <form action="{{URL::to(Auth::getDefaultDriver().'/report-type')}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row col-md-12">
                    <div class="clearfix"></div><br>
                    <div class="col-md-12">
                        <h1 class="text-center">All Grid Connected Solar Capacity</h1>
                        <h3 class="text-center"> Add Progress Report</h3>
                    </div>
                    <label for="name" class="pb-2">
                        Select Report Type <span class="text-danger">*</span>

                    </label>
                    <br>
                    <div class="col-md-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="report_type" value="1"
                                @if(($generalType['report_type_select']['report_type'] ?? '' )=='1' ) checked @endif
                                checked> Tender
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="report_type" value="2"
                                @if(($generalType['report_type_select']['report_type'] ?? '' )=='2' ) checked @endif>
                            Under Implementation
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="report_type" value="3"
                                @if(($generalType['report_type_select']['report_type'] ?? '' )=='3' ) checked @endif>
                            Commissioning
                        </label>
                    </div>
                    <div class="clearfix"></div><br>
                    <span id="report_type" style="display:none">
                        <hr>
                        <div class="col-md-2" style="display:inline-block">
                            <label class="form-check-label">
                                <input type="radio" name="report" value="new_report" checked> Add Report
                            </label>
                        </div>
                        <div class="col-md-2" style="display:inline-block">
                            <label class="form-check-label">
                                <input type="radio" name="report" value="rooftop_report">Solar Rooftop Report
                            </label>
                        </div>
                    </span>
                    <div class="clearfix"></div><br>
                    <hr>
                    <div style="clear:both"></div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-md-3 col-sm-6 " style="display:inline-block" id="month_id">
                                <label for="">Select Month <span class="text-danger">*</span></label>
                                <select class="form-control" name="month"><?php for($i=1;$i<=12;$i++) {?>
                                    <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6" style="display:inline-block" id="year_id">
                                <label for="">Select Year <span class="text-danger">*</span></label>
                                <select class="form-control" name="year"><?php for($j=2023;$j>2005;$j--) {?>
                                    <option value="<?=$j?>"><?=$j?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6" style="display:none;">
                                <label for="">Select Developer</label>
                                <select class="form-control" name="developer">
                                    <option value="0" selected>Select</option>
                                    @foreach($developer as $developers)
                                    <option value="{{$developers->id }}">
                                        {{$developers->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('developer') }}</span>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
                <div class="clearfix"></div><br>
                <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/solarPowerReport')}}" class="btn btn-success"></i>
                    Next</a> -->
                <button type="submit" value="Submit" name="submit" class="btn btn-flat btn-success">Next</button>
                <!-- <input type="hidden" name="editId" value=""> -->
                <!-- {{$progressData->id ?? ''}} -->
                <!-- </div> -->
            </form>
    </main>
</section>
@include('modals.consumerInstallerAssociation')
@endsection
@push('backend-js')
<script>
$(document).ready(function() {
    $('input[type=radio][name=report_type]').change(function() {
        $("#report_type").hide();
        if (this.value == 1) {

        } else if (this.value == 2) {

        } else if (this.value == 3) {

            $("#report_type").show('slow');

        }
    });
});
$(document).ready(function() {
    $('input[type=radio][name=report]').change(function() {
        // $("#report_type").hide();
        $("#month_id").show();
        if (this.value == 'new_report') {

        } else if (this.value == 'rooftop_report') {
            $("#year_id").show('slow');
            $("#month_id").hide();
        }
    });
});
</script>
@endpush