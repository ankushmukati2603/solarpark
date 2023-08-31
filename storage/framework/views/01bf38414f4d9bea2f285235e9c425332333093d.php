<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('external_transmission_system','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">External Transmission System</h5>
    <br>

    <div class="col-sm-12">
        <label for="name" class="pb-2"> Responsibility for external transmission system
            <span class="text-danger">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ext_responsibility" value="A"
                    <?php if(($generalData['external_transmission_system']['ext_responsibility'] ?? '' )=='A' ): ?> checked
                    <?php endif; ?> checked> CTU
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ext_responsibility" value="B"
                    <?php if(($generalData['external_transmission_system']['ext_responsibility'] ?? '' )=='B' ): ?> checked
                    <?php endif; ?>>
                STU
            </label>
        </div>
        <span class="text-danger"><?php echo e($errors->first('ext_responsibility')); ?></span>
    </div>
    <div class="col-md-12">
        <label for="name" class="pb-2"> Whether applied for connectivity/LTA to STU/CTU
            <span class="text-danger">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="whether_applied" value="A"
                    <?php if(($generalData['external_transmission_system']['whether_applied'] ?? '' )=='A' ): ?> checked <?php endif; ?>
                    checked> Yes
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="whether_applied" value="B"
                    <?php if(($generalData['external_transmission_system']['whether_applied'] ?? '' )=='B' ): ?> checked <?php endif; ?>>
                No
            </label>
        </div>
        <span class="text-danger"><?php echo e($errors->first('whether_applied')); ?></span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-12 pb-4">
        <label>Details of external transmission system<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="external_details" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['external_transmission_system']['external_details'] ?? ''); ?></textarea>
        <label for="" class="text-primary"> Please mention,requirement of transformers,length of lines,pooling
            substation
            details, LILO, distance from STU/CTU, or any other arrangement of proposed system and progress made so
            far</label>
        <span class="text-danger"><?php echo e($errors->first('external_details')); ?></span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Status of tender & schedule for completion of external transmission system work &progress made so
            far<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="external_status" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['external_transmission_system']['external_status'] ?? ''); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('external_status')); ?></span>
    </div>

    <div class="col-md-12 pb-4">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="ext_remarks" id="" cols="10" class="form-control"
            rows="3"><?php echo e($generalData['external_transmission_system']['ext_remarks'] ?? ''); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('ext_remarks')); ?></span>
    </div>
</div><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/external_transmission_system.blade.php ENDPATH**/ ?>