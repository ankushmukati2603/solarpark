<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('external_power_system','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">External Power Evacuation System</h5>
    <br>

    <div class="col-md-12 pb-4">
        <label>Details of completion of external transmission activities<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="external_transmission" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['external_power_evacuation_system']['external_transmission'] ?? '')); ?></textarea>
        <label for="" class="text-primary">Please include completion deadline of activities in the scope of
            CTU/STU</label><br>
        <span class="text-danger"><?php echo e($errors->first('external_transmission')); ?></span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Delay (if any) along with reason<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="delay_external_transmission" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['external_power_evacuation_system']['delay_external_transmission'] ?? '')); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('delay_external_transmission')); ?></span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="external_transmission_remarks" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['external_power_evacuation_system']['external_transmission_remarks'] ?? '')); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('external_transmission_remarks')); ?></span>
    </div>
</div><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/external_power_evacuation_system.blade.php ENDPATH**/ ?>