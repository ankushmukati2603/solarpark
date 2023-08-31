<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">General Details</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Contact Person Details<span class="text-danger">*</span></label>
    </div><br>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">

        <label>Developer Name<span class="text-danger">*</span></label>
        <input type="text" placeholder="Developer Name" name="developer_name" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['general']['developer_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('developer_name') }}</span>
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">
        <label>Email<span class="text-danger">*</span></label>
        <input type="email" name="email" id="txtgeneralLongitude" placeholder="Email" class="form-control  number"
            value="{{$generalData['general']['email'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">

        <label>CEO Name<span class="text-danger">*</span></label>
        <input type="text" placeholder="CEO Name" name="ceo_name" id="ceo_name" class="form-control  number"
            value="{{$generalData['general']['ceo_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ceo_name') }}</span>
    </div>
    <div class="clearfix"></div><br>

    <div class="col-md-12 col-sm-12">
        <label for="address"><strong>Office Address</strong></label>
        <textarea class="form-control  number" cols="30" rows="5" name="office_address"
            id="office_address">{{$generalData['general']['office_address'] ?? ''}}</textarea>

    </div>
    <div class="clearfix"></div><br>

    <div class="col-md-4 col-sm-12">
        <label>Mobile Number<span class="text-danger">*</span></label>
        <input type="text" name="mobile_number" id="mobile_number" minlength="10" maxlength="10"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Mobile Number"
            class="form-control" value="{{$generalData['general']['mobile_number'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
    </div>
    <!-- <div class="clearfix"></div><br> -->

    <div class="col-md-4 col-sm-12">
        <label> Office Contact No<span class="text-danger">*</span></label>
        <input type="text" name="office_number" id="office_number" minlength="6" maxlength="13"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder=" Office Contact No"
            class="form-control" value="{{$generalData['general']['office_number'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('office_number') }}</span>
    </div>

    <div class="clearfix"></div><br>



</div>