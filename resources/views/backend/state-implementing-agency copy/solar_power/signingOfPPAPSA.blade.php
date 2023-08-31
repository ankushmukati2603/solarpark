<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Signing of PPA/PSA</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('signing_of_ppa_psa','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Date of PPA/PSA<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="ppa_psa_date"
                value="{{$generalData['signingOfPPAPSA']['ppa_psa_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('ppa_psa_date') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="ppa_psa_capacity" id="txtgeneralLatitude" class="form-control"
            value="{{$generalData['signingOfPPAPSA']['ppa_psa_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ppa_psa_capacity') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Name of State in PPA/PSA Signed<span class="error">*</span></label>
        <input type="text" placeholder="Name" name="ppa_psa_state_name" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['signingOfPPAPSA']['ppa_psa_state_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ppa_psa_state_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Name of DISCOM who have signed PPA/PSA<span class="error">*</span></label>
        <input type="text" placeholder="Name" name="ppa_signed_discom_name" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['signingOfPPAPSA']['ppa_signed_discom_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ppa_signed_discom_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Per Unit cost of electricity as per said PPA <span class="error">*</span></label>
        <input type="number" placeholder="per Unit Cost" name="ppa_electricity_unit" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['signingOfPPAPSA']['ppa_electricity_unit'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ppa_electricity_unit') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Duration of PPA<span class="error">*</span></label>
        <input type="text" placeholder="PPA Duration" name="ppa_duration" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['signingOfPPAPSA']['ppa_duration'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('ppa_duration') }}</span>
    </div>

</div>