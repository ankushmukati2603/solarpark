<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">General Details</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('date','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Contact Person Details<span class="error">*</span></label>
    </div><br>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">

        <label>Developer Name<span class="error">*</span></label>
        <input type="text" placeholder="Developer Name" name="developer_name" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['general']['developer_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('latitude') }}</span>
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">
        <label>Email<span class="error">*</span></label>
        <input type="email" name="email" id="txtgeneralLongitude" placeholder="Email" class="form-control  number"
            value="{{$generalData['general']['email'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('longitude') }}</span>
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">

        <label>CEO Name<span class="error">*</span></label>
        <input type="text" placeholder="CEO Name " name="ceo_name" id="txtgeneralLatitude" class="form-control  number"
            value="{{$generalData['general']['ceo_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ceo_name') }}</span>
    </div>
    <div class="clearfix"></div><br>

    <div class="col-md-4 col-sm-12">
        <label for="address"><strong>Office Address</strong></label>
        <input type="text" placeholder="Office Address " name="office_address" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['general']['office_address'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('office_address') }}</span>
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">
        <label>Mobile Number<span class="error">*</span></label>
        <input type="number" name="mobile_number" id="txtgeneralLatitude" placeholder="Mobile Number"
            class="form-control" value="{{$generalData['general']['mobile_number'] ?? ''}}">
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">
        <label> Office Contact No<span class="error">*</span></label>
        <input type="number" name="office_number" id="txtgeneralLatitude" placeholder=" Office Contact No"
            class="form-control" value="{{$generalData['general']['office_number'] ?? ''}}">
    </div>

    <!-- <div class="clearfix"></div><br>


    <div>
        <label>Project Location <span class="error">*</span></label>
    </div><br>


    <div class="col-md-4 col-sm-12">
        <label>District<span class="error">*</span></label>
        <select class="form-control" id="district_id" name="district_id"
            onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
            <option value="{{$generalData['general']['name'] ?? ''}}" selected>Select District</option>
        </select>
        <span class="text-danger">{{ $errors->first('district_id') }}</span>
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Sub District<span class="error">*</span></label>
        <select class="form-control" id="sub_district_id" name="sub_district_id"
            onchange="getVillageBySubDistrict(this.value,'')">
            <option value="{{$generalData['general']['name'] ?? ''}}" selected disabled>Select Sub-District</option>
        </select>
        <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
    </div>



    <div class="col-md-4 col-sm-12">
        <label>Village<span class="error">*</span></label>
        <select class="form-control " id="village_id" name="village">
            <option value="{{$generalData['general']['name'] ?? ''}}" selected disabled>Select Village</option>
        </select>
        <span class="text-danger">{{ $errors->first('village') }}</span>
    </div>

    <div class="clearfix"></div><br>

    <div class="col-md-4 col-sm-12">
        <label>Latitude<span class="error">*</span></label>
        <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['general']['name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('latitude') }}</span>
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Longitude<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
            class="form-control  number" value="{{$generalData['general']['name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('longitude') }}</span>
    </div> -->

</div>