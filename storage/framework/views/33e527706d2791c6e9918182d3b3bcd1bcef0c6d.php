<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('financial_closure','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Financial Closure</h5>
    <br>

    <div class="col-md-12 pb-4">
        <label>Details of Financial Closure of Solar Park (arrangement of 90% of fund of total park cost)<span
                class="text-danger">*</span><span class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="financial_closure_details" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['financial_closure']['financial_closure_details'] ?? ''); ?></textarea>
    </div>
    <div class="col-md-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="financial_closure_remarks" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['financial_closure']['financial_closure_remarks'] ?? ''); ?></textarea>
    </div>
</div><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/financial_closure.blade.php ENDPATH**/ ?>