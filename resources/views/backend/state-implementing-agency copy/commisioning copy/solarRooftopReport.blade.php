@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <div class="row pb-3">
            <div class="col-lg-12">
                <div class="row app_progrs_rprt">
                    <section class="section dashboard">
                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                        @endif
                        <form action="{{URL::to(Auth::getDefaultDriver().'/report-type')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-center"> Solar Rooftop (Year Wise)</h3>

                            <div class="clearfix"></div><br>
                            <div class="tab-content"><br>
                                <h6>Year Wise Breakup(In MW)</h6>
                                <div class="col-md-3 col-sm-6" style="display:inline-block">
                                    <label for="">Upto 2010</label>
                                    <select class="form-control" name="financial_year"
                                        id=""><?php for($j=2024;$j>2005;$j--) {?>
                                        <option value="<?=$j?>"><?=$j?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div><br>
                                <h6> Ground Mounted</h6>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Ground Mounted No.<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Ground Mounted Number" name="gm_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Ground Mounted Capacity<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Ground Mounted Capacity" name="gm_capacity"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="clearfix"></div><br>
                                <h6>Consumers</h6>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Consumer Number<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Consumer Number" name="consumer_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Cunsumer Capacity<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Cunsumer Capacity" name="cunsumer_capacity"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="clearfix"></div><br>
                                <h6> 13th Finance Commission</h6>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Finance Commission No.<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Finance Commission Number" name="fc_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Finance Commission Capacity<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Finance Commission Capacity" name="fc_capacity"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="clearfix"></div><br>
                                <h6>IPDS</h6>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>IPDS No.<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="IPDS Number" name="ipds_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>IPDS Capacity<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="IPDS Capacity" name="ipds_capacity"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="clearfix"></div><br>
                                <h6>Surya Raltha</h6>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Surya Raltha No.<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Surya Raltha Number" name="sr_number"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-4" style="display:inline-block">
                                    <label>Surya Raltha Capacity<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Surya Raltha Capacity" name="sr_capacity"
                                        id="txtgeneralLatitude" class="form-control  number" value="">
                                </div>
                            </div>
                            <button type="submit" value="Submit" name="submit"
                                class="btn btn-flat btn-success">Submit</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>

    </main>
</section>

@endsection