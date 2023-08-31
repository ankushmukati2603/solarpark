<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Name of DISCOM<span class="error">*</span></label>
        <input type="text" placeholder="Name" name="discom_name" id="txtgeneralLatitude" class="form-control  number"
            value="{{$generalData['selectedBidders']['discom_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('discom_name') }}</span>
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Substation Name<span class="error">*</span></label>
        <input type="text" placeholder="Name" name="substation_name" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['selectedBidders']['substation_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('substation_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Substation Voltage Level<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="substation_voltage_level" id="txtgeneralLongitude"
            placeholder="00.00" class="form-control  number"
            value="{{$generalData['discoveredTariffs']['substation_voltage_level'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('substation_voltage_level') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Feeder Name<span class="error">*</span></label>
        <input type="text" placeholder="Name" name="feeder_name" id="txtgeneralLatitude" class="form-control  number"
            value="{{$generalData['selectedBidders']['feeder_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('feeder_name') }}</span>
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Feeder Voltage<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="feeder_voltage" id="txtgeneralLongitude" placeholder="00.00"
            class="form-control  number" value="{{$generalData['discoveredTariffs']['feeder_voltage'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('feeder_voltage') }}</span>
    </div>

</div>