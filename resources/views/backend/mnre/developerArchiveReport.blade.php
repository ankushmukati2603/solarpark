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
                    <li class="breadcrumb-item active"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Archive
                            Report</a></li>

                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif
            <form action="{{URL::to(Auth::getDefaultDriver().'/developer-archive-report')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <div class="row col-md-12">
                            <div class="col-md-12">

                                <h3> Add Archive Developer Report</h3>
                            </div>
                    <tr>
                        <th width="20%"><label for="">Select Month And Year</label></th>
                        <td id="month_id">
                            <label for="">Select Month <span class="text-danger">*</span></label>
                            <select class="form-control" name="month"><?php for($i=1;$i<=12;$i++) {?>
                                <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?>

                                </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td style="" id="year_id">
                            <label for="">Select Year <span class="text-danger">*</span></label>
                            <select class="form-control" name="year"><?php for($j=2023;$j>2005;$j--) {?>
                                <option value="<?=$j?>"><?=$j?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="">Select Developer</label></th>
                        <td colspan="2">
                            <select class="form-control" name="developer_name">
                                <option value="0" selected>Select</option>
                                @foreach($developerDetail as $developerDetail)
                                <option value="{{$developerDetail->id }}">
                                    {{$developerDetail->developer_name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="">Select Solar Park Name</label></th>
                        <td>
                            <br>
                            <select class="form-control" name="solar_park_name">
                                <option value="0" selected>Select</option>
                                @foreach($developerparkDetail as $developerparkDetail)
                                <option value="{{$developerparkDetail->id }}">
                                    {{$developerparkDetail->solar_park_name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td width="25%">
                            <label for="">Upload Report <span class="text-primary">(Upload Only CSV and Excel
                                    format)</span><span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="upload_file">
                        </td>
                    </tr>
                </table>
                <button type="submit" value="Submit" name="submit" class="btn btn-flat btn-success">Submit</button>
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