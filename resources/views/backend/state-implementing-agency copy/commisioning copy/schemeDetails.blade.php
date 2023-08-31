<div>
    <div class="clearfix"></div><br>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Scheme
            <span class="error">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="dpr_status" value="A"
                    @if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='A' ) checked @endif checked>
                Central
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">

                <input type="radio" class="form-check-input" name="dpr_status" value="B"
                    @if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='B' ) checked @endif> State
                Scheme
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('dpr_status') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Mode of sale of power(captive/PPA/Third party sale)
            Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="select_sale_capacity" id="txtgeneralLatitude" class="form-control"
            value="{{$generalData['select_sale_capacity']['select_sale_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('select_sale_capacity') }}</span>
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Tenure of PPA<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="loi_loa_date"
                value="{{$generalData['selectedBidders']['loi_loa_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('loi_loa_date') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label> per unit cost of electricity as per the said PPA<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="electricity_per_unit_cost" id="txtgeneralLatitude"
            class="form-control"
            value="{{$generalData['electricity_per_unit_cost']['electricity_per_unit_cost'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('electricity_per_unit_cost') }}</span>
    </div>


</div>