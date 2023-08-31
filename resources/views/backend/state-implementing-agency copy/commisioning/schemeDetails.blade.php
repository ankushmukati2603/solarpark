<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Scheme Details</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Scheme
            <span class="text-danger">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="scheme_from" value="CENTRAL"
                    @if(($generalData['scheme_details']['scheme_from'] ?? '' )=='CENTRAL' ) checked @endif checked>
                Central
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">

                <input type="radio" class="form-check-input" name="scheme_from" value="STATE"
                    @if(($generalData['scheme_details']['scheme_from'] ?? '' )=='STATE' ) checked @endif> State
                Scheme
            </label>
        </div>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Mode of sale of power(captive/PPA/Third party sale)<span class="text-danger">*</span></label>
        <select class="form-control" id="txtState" name="select_sale_capacity">
            <option disabled selected>Select</option>

            <option value="CAPTIVE" @if(($generalData['scheme_details']['select_sale_capacity'] ?? '' )=='CAPTIVE' )
                selected @endif>
                Captive</option>
            <option value="PPA" @if(($generalData['scheme_details']['select_sale_capacity'] ?? '' )=='PPA' ) selected
                @endif>PPA</option>
            <option value="ANOTHER_PARTY" @if(($generalData['scheme_details']['select_sale_capacity'] ?? ''
                )=='ANOTHER_PARTY' ) selected @endif>Third party sale</option>

        </select>
    </div>
    <!-- <div class="col-md-4 col-sm-12">
        <label>Mode of sale of power(captive/PPA/Third party sale)
            Capacity (MW)<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="select_sale_capacity" id="txtgeneralLatitude" class="form-control"
            value="{{$generalData['scheme_details']['select_sale_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('select_sale_capacity') }}</span>
    </div> -->

    <div class="col-md-4 col-sm-12">
        <label>Tenure of PPA<span class="text-danger">*</span></label>
        <div class="input-group">

            <input type="number" class="form-control" placeholder="Enter in Years" min="0" name="tenure_ppa"
                value="{{$generalData['scheme_details']['tenure_ppa'] ?? ''}}">
        </div>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label> per unit cost of electricity as per the said PPA<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="electricity_per_unit_cost" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['scheme_details']['electricity_per_unit_cost'] ?? ''}}">
    </div>


</div>