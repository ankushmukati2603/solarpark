@extends('layouts.masters.backend')
@section('content')



<section class="section dashboard">
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Solar Rooftop</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to(Auth::getDefaultDriver().'/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Solar Rooftop</li>
                </ol>
            </nav>
        </div>
        <div class="row pb-3">
            <div class="col-lg-12">
                <div class="row app_progrs_rprt">


                    <form action="{{URL::to(Auth::getDefaultDriver().'/solar-rooftop-Report')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf



                        <h3 class="text-center"> Solar Rooftop (Year Wise)</h3>
                        <hr>

                        <!-- <div class="clearfix"></div><br> -->
                        <!-- <div class="tab-content"><br> -->
                        <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4">Year Wise Breakup(In MW)</th>
                            </tr>
                            <tr>
                                <td width="15%"><label for="">Upto 2010</label></td>
                                <td colspan="3">
                                    <select class="form-control" name="financial_year" id="" style="width:60%">
                                        <option value="">Select</option>
                                        <?php for($j=2024;$j>2009;$j--) {?>
                                        <option value="<?=$j?>"><?=$j?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <!-- <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <td width="15%"></td>
                                <td></td>
                                <td width="15%"></td>
                                <td></td>
                            </tr>
                        </table> -->


                        <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4">Ground Mounted</th>
                            </tr>
                            <tr>
                                <td width="15%"><label>Ground Mounted No.<span class="text-danger">*</span></label></td>
                                <td><input type="text" placeholder="Ground Mounted Number" name="gm_number"
                                        id="txtgeneralLatitude" class="form-control" value=""></td>
                                <td width="15%"><label>Ground Mounted Capacity (MW)<span
                                            class="text-danger">*</span></label>
                                </td>
                                <td><input type="number" step="any" placeholder="Ground Mounted Capacity" min="0.0"
                                        name="gm_capacity" id="txtgeneralLatitude" class="form-control  number"
                                        value=""></td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4">Consumers</th>
                            </tr>
                            <tr>
                                <td width="15%"><label>Consumer Number<span class="text-danger">*</span></label></td>
                                <td>
                                    <input type="text" placeholder="Consumer Number" name="consumer_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </td>
                                <td width="15%">
                                    <label>Consumer Capacity<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="number" placeholder="Cunsumer Capacity" min="0" s
                                        name="cunsumer_capacity" step="any" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4">13<sup>th</sup> Finance Commission</th>
                            </tr>
                            <tr>
                                <td width="15%">
                                    <label>Finance Commission No.<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Finance Commission Number" name="fc_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </td>
                                <td width="15%">
                                    <label>Finance Commission Capacity<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="number" placeholder="Finance Commission Capacity" min="0"
                                        name="fc_capacity" step="any" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4">IPDS</th>
                            </tr>
                            <tr>
                                <td width="15%">
                                    <label>IPDS No.<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="text" placeholder="IPDS Number" name="ipds_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </td>
                                <td width="15%">
                                    <label>IPDS Capacity<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="number" placeholder="IPDS Capacity" name="ipds_capacity"
                                        id="txtgeneralLatitude" step="any" class="form-control  number" value="">
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr class="bg-primary text-light">
                                <th colspan="4">Surya Raltha</th>
                            </tr>
                            <tr>
                                <td width="15%">
                                    <label>Surya Raltha No.<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Surya Raltha Number" name="sr_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </td>
                                <td width="15%">
                                    <label>Surya Raltha Capacity<span class="text-danger">*</span></label>
                                </td>
                                <td>
                                    <input type="number" placeholder="Surya Raltha Capacity" min="0" name="sr_capacity"
                                        id="txtgeneralLatitude" step="any" class="form-control  number" value="">
                                </td>
                            </tr>
                        </table>
                        <div class="row1 text-center">

                            <!-- </div> -->
                            <button type="submit" value="Submit" name="submit"
                                class="btn btn-flat btn-success  ">Submit</button>
                            <input type="hidden" name="rf_id" id="" value="{{$id??''}}">
                        </div>
                </div>
            </div>
            </form>

        </div>
        </div>

    </main>
</section>

@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush