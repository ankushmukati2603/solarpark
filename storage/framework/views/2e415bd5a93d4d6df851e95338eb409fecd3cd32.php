<div class="row">
    <div class="col-xl-2 col-lg-6 col-md-12 pb-3">
        <div class=""><label>Select Tender <span class="text-danger">*</span></label></div>

    </div>
    <div class="col-xl-10 col-lg-6 col-md-12 pb-3">
        <div class=""> <?php if(!$tenderList->isEmpty()): ?>
            <select name="tender" id="tender" class="form-control tenderSelectBox"
                style="width:90%;display: inline-block;">
                <option value="">Select Tender</option>
                <?php $__currentLoopData = $tenderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(base64_encode($tender->id)); ?>">
                    <?php echo e($tender->nit_no); ?> - [<?php echo e($tender->tender_no); ?>]
                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <!-- <button class="btn btn-primary" id="searchTender" on>Search</button> -->
            <?php else: ?>
            <span class="text-danger">No Tender Found. Please <a href="">Click Here</a> to Add Tender</span>
            <?php endif; ?>
        </div>
    </div>
    <hr><br>
    <span id="tenderDetails"></span>
</div><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/state-implementing-agency/tenderSearch.blade.php ENDPATH**/ ?>