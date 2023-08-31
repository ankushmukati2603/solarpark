<div>
    <div class="clearfix"></div><br>
    <!-- 
    <div class="col-md-4 col-sm-12">
        <label>Date of RA/e-RA <span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="ra_e_ra_date"
                value="{{$generalData['reverseAuction']['ra_e_ra_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('ra_e_ra_date') }}</span>
    </div>


    <div class="col-md-4 col-sm-12">
        <label>Tendered Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="reverseauction_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['reverseAuction']['reverseauction_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('reverseauction_capacity') }}</span>
    </div> -->
    <label>Projects in Solar Park<span class="error">*</span></label>
    <div class="col-sm-12">
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" id="" name="detail" value="C"
                    @if(($generalData['solar_projects']['detail'] ?? '' )=='C' ) checked @endif />No </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" id="other" class="form-check-input" name="detail" value="D"
                    @if(($generalData['solar_projects']['detail'] ?? '' )=='D' ) checked @endif /> yes
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('detail') }}</span>
    </div>
    <div class="col-md-8">
        <!-- <label>if yes, name of Solar Park<span class="error">*</span></label> -->
        <input style="display:none;" class="form-control" placeholder="if yes, name of Solar Park" type="text"
            name="otherDetails" id="otherDetails" />
    </div>
</div>
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