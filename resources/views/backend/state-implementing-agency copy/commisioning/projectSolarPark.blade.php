<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Projects in Solar Park</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('project_solar_park','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <div class="col-sm-12">
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" id="" name="solar_park_project" value="NO"
                    @if(($generalData['project_solar_park']['solar_park_project'] ?? '' )=='NO' ) checked @endif />No
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" id="other" class="form-check-input" name="solar_park_project" value="YES"
                    @if(($generalData['project_solar_park']['solar_park_project'] ?? '' )=='YES' ) checked @endif /> Yes
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('detail') }}</span>
    </div>
    <div class="col-md-8">
        <!-- <label>if yes, name of Solar Park<span class="text-danger">*</span></label> -->

        <input
            style="display: @if(($generalData['project_solar_park']['solar_park_project'] ?? '' )=='YES' ) block @else none @endif"
            class="form-control" placeholder="if yes, name of Solar Park" type="text" name="solarpark_name"
            value="{{$generalData['project_solar_park']['solarpark_name'] ?? ''}}" id="solarparkname" />
    </div>
</div>
<script>
$("input[name='solar_park_project']").change(function() {
    // alert($(this).val());
    if ($(this).val() == "YES") {
        $("#solarparkname").show();
    } else {
        $("#solarparkname").hide();
        $("#solarparkname").val('');

    }
});
</script>