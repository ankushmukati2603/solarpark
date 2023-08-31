<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('solar_project_completion','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Solar Project Completion</h5>
    <br>
    <div class="clearfix"></div>
    <div class="col-md-12 pb-4">
        <label>Details of completion of solar projects activities<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="solar_project_completion_details" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['solar_project_completion']['solar_project_completion_details'] ?? ''); ?></textarea>
        <label for="" class="text-primary">Please include completion deadline of activities in the scope of
            SPD</label><br>
        <span class="text-danger"><?php echo e($errors->first('solar_project_completion_details')); ?></span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Delay (if any) along with reason<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="delay_solar_project" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['solar_project_completion']['delay_solar_project'] ?? ''); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('delay_solar_project')); ?></span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="solar_project_complation_remarks" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['solar_project_completion']['solar_project_complation_remarks'] ?? ''); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('solar_project_complation_remarks')); ?></span>
    </div>
</div><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/solar_project_completion.blade.php ENDPATH**/ ?>