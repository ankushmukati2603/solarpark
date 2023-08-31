<label class="headLebels">Solar Projects

</label>
<br>
<div class="col-sm-12">
    <label for="name" class="pb-2">Plan for setting up of solar projects inside solar in<span
            class="error">*</span></label>
</div>
<div class="clearfix"></div>
<div class="col-sm-12">
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" id="" name="detail" value="A"
                @if(($generalData['solar_projects']['detail'] ?? '' )=='A' ) checked @endif checked> EPC Mode
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" id="" name="detail" value="B"
                @if(($generalData['solar_projects']['detail'] ?? '' )=='B' ) checked @endif /> Developer Mode
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" id="" name="detail" value="C"
                @if(($generalData['solar_projects']['detail'] ?? '' )=='C' ) checked @endif /> EPC Mode </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" id="other" class="form-check-input" name="detail" value="D"
                @if(($generalData['solar_projects']['detail'] ?? '' )=='D' ) checked @endif /> Any Other
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('detail') }}</span>
</div>
<div class="col-md-8">
    <!-- <label>Please specify details for others<span class="error">*</span></label> -->
    <input style="display:none;" placeholder="Please specify details for others" type="text" name="otherDetails"
        id="otherDetails" />
</div>
<div class="clearfix"></div><br>
<div class="col-md-8 col-sm-12">
    <label>Tendering Agency for Solar Projects<span class="error">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="agency" id="" cols="10" rows="2">{{$generalData['solar_projects']['agency'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('agency') }}</span>
</div>
<div class="col-md-12">
    <hr>
</div>
<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label>Details of Tender, Tariff Discovered and details of bidders<span class="error">*</span></label>
</div><br>
<div class="clearfix"></div><br>
<div class="col-md-3 col-sm-12">
    <label>Date of NIT<span class="error">*</span></label>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
            placeholder="MM-DD-YYYY" name="nit_date" value="{{$generalData['solar_projects']['nit_date'] ?? ''}}">
    </div>
    <span class="text-danger">{{ $errors->first('nit_date') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Name of successful bidders<span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="bidders_name"
        value="{{$generalData['solar_projects']['bidders_name'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('bidders_name') }}</span>
</div>


<div class="col-md-3 col-sm-12">
    <label>Capacity (MW)<span class="error">*</span></label>
    <input type="number" step="any" min="0" name="TD_capacity" id="textTDcapacity" class="form-control"
        value="{{$generalData['solar_projects']['TD_capacity'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('TD_capacity') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Tariff (in Rs/kWh) <span class="error">*</span></label>
    <input type="number" step="any" min="0" id="" placeholder="" name="tariff" class="form-control"
        value="{{$generalData['solar_projects']['tariff'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('tariff') }}</span>
</div>
<div class="col-md-12">
    <hr>
</div>

<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label>Date of Letter of Award (LoA)<span class="error">*</span></label>
</div><br>

<div class="clearfix"></div><br>

<div class="col-md-3 col-sm-12">
    <label>Name of successful bidders/Solar Project Developers
        <span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="spds_name_loa"
        value="{{$generalData['solar_projects']['spds_name_loa'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('spds_name_loa') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Capacity (MW)
        <span class="error">*</span></label>
    <input type="number" step="any" min="0" class="form-control number " id="" placeholder="" name="capacity_loa"
        value="{{$generalData['solar_projects']['capacity_loa'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('capacity_loa') }}</span>
</div>
<div class="col-md-3 col-sm-12">
    <label>Date of PSA
        <span class="error">*</span></label>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
            placeholder="MM-DD-YYYY" name="psa_date" value="{{$generalData['solar_projects']['psa_date'] ?? ''}}">
    </div>
    <span class="text-danger">{{ $errors->first('psa_date') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Name of DISCOM
        <span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="discom_name"
        value="{{$generalData['solar_projects']['discom_name'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('discom_name') }}</span>
</div>

<div class="clearfix"></div>
<div class="col-md-3 col-sm-12">
    <label>PSA Signature <span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="psa_signature"
        value="{{$generalData['solar_projects']['psa_signature'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('psa_signature') }}</span>
</div>
<div class="col-md-12">
    <hr>
</div>
<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label>Date of PPA <span class="error">*</span></label>
</div><br>

<div class="clearfix"></div><br>
<div class="col-md-3 col-sm-12">
    <label>Name of SPDs<span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="spds_name_ppa"
        value="{{$generalData['solar_projects']['spds_name_ppa'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('spds_name_ppa') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Capacity (MW) <span class="error">*</span></label>
    <input type="number" step="any" min="0" class="form-control number " id="" placeholder="" name="ppa_capacity"
        value="{{$generalData['solar_projects']['ppa_capacity'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('ppa_capacity') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Date of PPA <span class="error">*</span></label>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
            placeholder="MM-DD-YYYY" name="ppa_date" value="{{$generalData['solar_projects']['ppa_date'] ?? ''}}">
    </div>
    <span class="text-danger">{{ $errors->first('ppa_date') }}</span>
</div>
<div class="col-md-12">
    <hr>
</div>
<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label>Scheduled Date of Commissioning (SCoD) of Solar Project <span class="error">*</span></label>
</div><br>

<div class="clearfix"></div><br>
<div class="col-md-3 col-sm-12">
    <label>Name of SPDs<span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="spds_name_scod"
        value="{{$generalData['solar_projects']['spds_name_scod'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('spds_name_scod') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Capacity (MW) <span class="error">*</span></label>
    <input type="number" step="any" min="0" class="form-control number " id="" placeholder="" name="scod_capacity"
        value="{{$generalData['solar_projects']['scod_capacity'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('scod_capacity') }}</span>
</div>

<div class="col-md-3 col-sm-12">
    <label>Date of SCoD <span class="error">*</span></label>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
            placeholder="MM-DD-YYYY" name="scod_date" value="{{$generalData['solar_projects']['scod_date'] ?? ''}}">
    </div>
    <span class="text-danger">{{ $errors->first('scod_date') }}</span>
</div>
<div class="col-md-12">
    <hr>
</div>
<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label>Extended date of Solar Project Commissioning, if any<span class="error">*</span></label>
</div><br>

<div class="clearfix"></div><br>
<div class="col-md-4 col-sm-12">
    <label>Name of SPDs<span class="error">*</span></label>
    <input type="text" class="form-control " id="" placeholder="" name="extended_spds_name"
        value="{{$generalData['solar_projects']['extended_spds_name'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('extended_spds_name') }}</span>
</div>

<div class="col-md-4 col-sm-12">
    <label>Capacity (MW) <span class="error">*</span></label>
    <input type="number" step="any" min="0" id="textExtendCapacity" placeholder="" name="extended_capacity"
        class="form-control" value="{{$generalData['solar_projects']['extended_capacity'] ?? ''}}">

    <span class="text-danger">{{ $errors->first('extended_capacity') }}</span>
</div>
<div class="col-md-4 col-sm-12">
    <label>Extended Date of SCoD<span class="error">*</span></label>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
            placeholder="MM-DD-YYYY" name="extended_date"
            value="{{$generalData['solar_projects']['extended_date'] ?? ''}}">
    </div>
    <span class="text-danger">{{ $errors->first('extended_date') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="solar_project_remarks" id="" cols="10"
        rows="2">{{$generalData['solar_projects']['solar_project_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('solar_project_remarks') }}</span>
</div>






<style>
hr {
    border: 1px solid #000 !important;
}
</style>
<script>
$("input[name='detail']").change(function() {
    // alert($(this).val());
    if ($(this).val() == "D") {
        $("#otherDetails").show();
    } else {
        $("#otherDetails").hide();
    }
});
</script>