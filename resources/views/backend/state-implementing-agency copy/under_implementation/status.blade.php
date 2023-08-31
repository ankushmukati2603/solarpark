<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Status</label></h5>
    <div class="row pb-3">
        <div class="col-md-6 pb-4">
            <label>Interconnection Point/s/s and Voltage Level<span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" name="voltage_level" id="txtgeneralLatitude" class="form-control"
                value="{{$generalData['status']['voltage_level'] ?? ''}}">
        </div>
        <div class="col-md-6 pb-4">
            <label>LTOA Operationalization Date<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="ltoa_date" value="{{$generalData['status']['ltoa_date'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <label>Status of Stage 2 Connectivity<span class="text-danger">*</span></label>
            <textarea name="stage2_status" id="" cols="30" class="form-control"
                rows="2">{{$generalData['status']['stage2_status'] ?? ''}}</textarea>
        </div>
        <div class="col-md-6 pb-4">
            <label>Status of LTA & Target Region<span class="text-danger">*</span></label>
            <textarea name="lta_status" id="" cols="30" class="form-control"
                rows="2">{{$generalData['status']['lta_status'] ?? ''}}</textarea>
        </div>

        <div class="col-md-12 pb-4">
            <label>Status of Transmisison line from project site to Sub station(by developer)<span
                    class="text-danger">*</span></label>
            <textarea name="sub_station_status" id="" cols="30" class="form-control"
                rows="2">{{$generalData['status']['sub_station_status'] ?? ''}}</textarea>
        </div>
    </div>
</div>