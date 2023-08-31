<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Extended Date</label></h5>
    <div class="row pb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Extended Commissioning Date(if any)<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="extended_commissioning_date"
                    value="{{$generalData['extendedDate']['extended_commissioning_date'] ?? ''}}">
            </div>
        </div>
    </div>
</div>