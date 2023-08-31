<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Highest Tariff<span class="error">*</span></label>
        <input type="number" placeholder="" step="any" min="0" name="highest_tariff" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['discoveredTariffs']['highest_tariff'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('highest_tariff') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">

        <label>Lowest Tariff <span class="error">*</span></label>
        <input type="number" placeholder="" step="any" min="0" name="lowest_tariff" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['discoveredTariffs']['lowest_tariff'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('lowest_tariff') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Weighted Average<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="weighted_average" id="txtgeneralLongitude" placeholder="00.00"
            class="form-control  number" value="{{$generalData['discoveredTariffs']['weighted_average'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('weighted_average') }}</span>
    </div>
</div>