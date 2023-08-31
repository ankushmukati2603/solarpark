<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('solar_projects','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Solar Projects</h5>
    <br>

    <div class="col-sm-12">
        <label for="name" class="pb-2">Plan for setting up of solar projects inside solar in<span
                class="text-danger">*</span></label>
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
        <!-- <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" id="" name="detail" value="C"
                    @if(($generalData['solar_projects']['detail'] ?? '' )=='C' ) checked @endif /> EPC Mode </label>
        </div> -->
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" id="other" class="form-check-input" name="detail" value="D"
                    @if(($generalData['solar_projects']['detail'] ?? '' )=='D' ) checked @endif /> Any Other
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('detail') }}</span>
    </div>
    <div class="col-md-8">
        <!-- <label>Please specify details for others<span class="text-danger">*</span></label> -->
        <input style="display:none;" placeholder="Please specify details for others" type="text" class="form-control"
            name="otherDetails" id="otherDetails" />
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-12">
        <label>Tendering Agency for Solar Projects<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="agency" id="" cols="10" rows="3"
            class="form-control">{{$generalData['solar_projects']['agency'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('agency') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-sm-12">
        <label>Details of Tender, Tariff Discovered and details of bidders<span class="text-danger">*</span></label>
    </div><br>
    <div class="clearfix"></div>
    <div class="row col-md-12">
        <div class="col-md-6 pb-4">
            <label>Date of NIT<span class="text-danger">*</span></label>
            <div class="input-group date">

                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="nit_date"
                    value="{{$generalData['solar_projects']['nit_date'] ?? ''}}">
            </div>
            <span class="text-danger">{{ $errors->first('nit_date') }}</span>
        </div>

        <div class="col-md-6 pb-4">
            <label>Name of successful Bidder/Developer<span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="bidders_name"
                value="{{$generalData['solar_projects']['bidders_name'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('bidders_name') }}</span>
        </div>


        <div class="col-md-6">
            <label>Capacity (MW)<span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" name="TD_capacity" id="textTDcapacity" class="form-control"
                value="{{$generalData['solar_projects']['TD_capacity'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('TD_capacity') }}</span>
        </div>
        <div class="col-md-6">
            <label>Tariff (in Rs/kWh) <span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" id="" placeholder="" name="tariff" class="form-control"
                value="{{$generalData['solar_projects']['tariff'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('tariff') }}</span>
        </div>
    </div>



    <div class="col-md-12">
        <hr>
    </div>

    <div class="row col-md-12">
        <div class="col-md-12">
            <label>Date of Letter of Award (LoA)<span class="text-danger">*</span></label>
        </div>
        <div class="clearfix"></div><br>



        <div class="col-md-3 col-sm-12">
            <label>Name of successful bidder/Solar Project Developer
                <span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="spds_name_loa"
                value="{{$generalData['solar_projects']['spds_name_loa'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('spds_name_loa') }}</span>
        </div>

        <div class="col-md-3 col-sm-12">
            <label>Capacity (MW)
                <span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" class="form-control number " id="" placeholder=""
                name="capacity_loa" value="{{$generalData['solar_projects']['capacity_loa'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('capacity_loa') }}</span>
        </div>
        <div class="col-md-3 col-sm-12">
            <label>Date of PSA
                <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="psa_date"
                    value="{{$generalData['solar_projects']['psa_date'] ?? ''}}">
            </div>
            <span class="text-danger">{{ $errors->first('psa_date') }}</span>
        </div>

        <div class="col-md-3 col-sm-12">
            <label>Name of DISCOM
                <span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="discom_name"
                value="{{$generalData['solar_projects']['discom_name'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('discom_name') }}</span>
        </div>

        <!-- <div class="clearfix"></div>
        <div class="col-md-3 col-sm-12">
            <label>PSA Signature <span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="psa_signature"
                value="{{$generalData['solar_projects']['psa_signature'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('psa_signature') }}</span>
        </div> -->
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row col-md-12">
        <div class="col-sm-12">
            <label>Date of PPA <span class="text-danger">*</span></label>
        </div><br>

        <div class="clearfix"></div><br>
        <div class="col-md-4 pb-4">
            <label>Name of SPDs<span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="spds_name_ppa"
                value="{{$generalData['solar_projects']['spds_name_ppa'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('spds_name_ppa') }}</span>
        </div>

        <div class="col-md-4 pb-4">
            <label>Capacity (MW) <span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" class="form-control number " id="" placeholder=""
                name="ppa_capacity" value="{{$generalData['solar_projects']['ppa_capacity'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('ppa_capacity') }}</span>
        </div>

        <div class="col-md-4 pb-4">
            <label>Date of PPA <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="ppa_date"
                    value="{{$generalData['solar_projects']['ppa_date'] ?? ''}}">
            </div>
            <span class="text-danger">{{ $errors->first('ppa_date') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row col-md-12">
        <div class="clearfix"></div><br>
        <div class="col-sm-12">
            <label>Scheduled Date of Commissioning (SCoD) of Solar Project <span class="text-danger">*</span></label>
        </div><br>

        <div class="clearfix"></div><br>
        <div class="col-md-4 pb-4">
            <label>Name of SPDs<span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="spds_name_scod"
                value="{{$generalData['solar_projects']['spds_name_scod'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('spds_name_scod') }}</span>
        </div>

        <div class="col-md-4 pb-4">
            <label>Capacity (MW) <span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" class="form-control number " id="" placeholder=""
                name="scod_capacity" value="{{$generalData['solar_projects']['scod_capacity'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('scod_capacity') }}</span>
        </div>

        <div class="col-md-4 pb-4">
            <label>Date of SCoD <span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="scod_date"
                    value="{{$generalData['solar_projects']['scod_date'] ?? ''}}">
            </div>
            <span class="text-danger">{{ $errors->first('scod_date') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row col-md-12">
        <div class="clearfix"></div><br>
        <div class="col-sm-12">
            <label>Extended date of Solar Project Commissioning, if any<span class="text-danger">*</span></label>
        </div><br>

        <div class="clearfix"></div><br>
        <div class="col-md-4 pb-4">
            <label>Name of SPDs<span class="text-danger">*</span></label>
            <input type="text" class="form-control " id="" placeholder="" name="extended_spds_name"
                value="{{$generalData['solar_projects']['extended_spds_name'] ?? ''}}">

        </div>

        <div class="col-md-4 pb-4">
            <label>Capacity (MW) <span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" id="textExtendCapacity" placeholder="" name="extended_capacity"
                class="form-control" value="{{$generalData['solar_projects']['extended_capacity'] ?? ''}}">


        </div>
        <div class="col-md-4 pb-4">
            <label>Extended Date of SCoD<span class="text-danger">*</span></label>
            <div class="input-group date">
                <div class="input-group-addon">

                </div>
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="extended_date"
                    value="{{$generalData['solar_projects']['extended_date'] ?? ''}}">
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="solar_project_remarks" id="" cols="10" class="form-control"
            rows="2">{{$generalData['solar_projects']['solar_project_remarks'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('solar_project_remarks') }}</span>
    </div>


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