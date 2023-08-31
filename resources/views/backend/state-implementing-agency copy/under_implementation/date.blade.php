<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Dates</label></h5>
    <div class="row pb-3">
        <div class="col-md-4 pb-4">
            <label>Date Issue of RfS<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="" placeholder="MM-DD-YYYY"
                    name="rfs_date" value="{{$generalData['date']['rfs_date'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4 pb-4">
            <label>Date Issue of RA<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="" placeholder="MM-DD-YYYY"
                    name="ra_date" value="{{$generalData['date']['ra_date'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4 pb-4">
            <label>Date issue of LOI<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="" placeholder="MM-DD-YYYY"
                    name="loi_date" value="{{$generalData['date']['loi_date'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4 pb-4">
            <label>Date of PPA<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="" placeholder="MM-DD-YYYY"
                    name="ppa_date" value="{{$generalData['date']['ppa_date'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4 pb-4">
            <label>Scheduled Commissioning Date of Solar Project<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="" placeholder="MM-DD-YYYY"
                    name="scheduled_commisioning_date"
                    value="{{$generalData['date']['scheduled_commisioning_date'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4 pb-4">
            <label>Extended Commissioning Date of Solar Project(if any)<span class="text-danger">*</span></label>
            <div class="input-group date">
                <input type="date" class="form-control pull-right alldatepicker " id="" placeholder="MM-DD-YYYY"
                    name="extended_commisioning_date"
                    value="{{$generalData['date']['extended_commisioning_date'] ?? ''}}">
            </div>
        </div>

    </div>
</div>