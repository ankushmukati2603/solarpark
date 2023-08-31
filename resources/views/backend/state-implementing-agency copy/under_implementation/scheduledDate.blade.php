<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Scheduled Date</label></h5>
    <div class="row pb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Scheduled Commissioning Date of Transmission<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="scheduled_transmission_date"
                    value="{{$generalData['scheduled']['scheduled_transmission_date'] ?? ''}}">
            </div>
        </div>
    </div>
</div>