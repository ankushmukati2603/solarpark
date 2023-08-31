<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">General Details</label></h5>
    <div class="row pb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Developer Name<span class="text-danger">*</span></label>
            <input type="text" placeholder="Developer Name" name="developer_name" id="txtgeneralLatitude"
                class="form-control  number" value="{{$generalData['general']['developer_name'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label> CEO/Head Name<span class="text-danger">*</span></label>
            <input type="text" placeholder="CEO/Head Name" name="head_name" id="txtgeneralLatitude"
                class="form-control  number" value="{{$generalData['general']['head_name'] ?? ''}}">
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <label>CEO Name<span class="text-danger">*</span></label>
            <input type="text" placeholder="CEO Name " name="ceo_name" id="txtgeneralLatitude" class="form-control"
                value="{{$generalData['general']['ceo_name'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label for="address"><strong>Office Address</strong><span class="text-danger">*</span></label>
            <textarea rows="3" class="form-control " id="txtAddress" name="office_address"
                value="{{$generalData['general']['office_address'] ?? ''}}">{{$generalData['general']['office_address'] ?? ''}}</textarea>

        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label> Office Contact No<span class="text-danger">*</span></label>
            <input type="text" minlength="6" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                name="contact_number" id="" placeholder=" Office Contact No" class="form-control"
                value="{{$generalData['general']['contact_number'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Mobile Number<span class="text-danger">*</span></label>
            <input type="text" name="mobile_number" id="" minlength="10" maxlength="10"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Mobile Number"
                class="form-control" value="{{$generalData['general']['mobile_number'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" name="email" id="txtgeneralLongitude" placeholder="Email" class="form-control  number"
                value="{{$generalData['general']['email'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Project Capacity (MW)<span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" name="project_capacity" id="" class="form-control"
                value="{{$generalData['general']['project_capacity'] ?? ''}}">
        </div>
        <div class="col-md-4">
            <label for="name" class="pb-2">Inside Solar Park<span class="text-danger">*</span></label>
            <br>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="inside_solar_park" value="A"
                        @if(($generalData['general']['inside_solar_park'] ?? '' )=='A' ) checked @endif checked> Yes
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="inside_solar_park" value="B"
                        @if(($generalData['general']['inside_solar_park'] ?? '' )=='B' ) checked @endif>
                    No
                </label>
            </div>
        </div>
    </div>
</div>