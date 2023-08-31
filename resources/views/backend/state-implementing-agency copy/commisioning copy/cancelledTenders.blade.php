<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Cancel Tender Date<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="cancel_tender_date"
                value="{{$generalData['cancelledTenders']['cancel_tender_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('cancel_tender_date') }}</span>
    </div>


    <div class="col-md-4 col-sm-12">
        <label>Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="cancel_tender_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['cancelledTenders']['cancel_tender_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('cancel_tender_capacity') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-8">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
    </div>
    <div class="col-md-12" inline>
        <textarea name="cancelled_tender_remarks" id="" cols="30"
            rows="2">{{$generalData['cancelledTenders']['cancelled_tender_remarks'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('cancelled_tender_remarks') }}</span>
    </div>

</div>