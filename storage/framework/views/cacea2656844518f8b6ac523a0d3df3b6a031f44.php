<?php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
?>

<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('additional_information','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Additional Information</h5>
    <br>
    <div class="col-md-12 pb-4">
        <label>Any issue of SPPD/SPD/STU/CTU which you want to highlight in MNRE/SECI, please upload a brief
            (pdf,doc,docx format)<span class="text-danger">*</span></label>
        <input type="file" name="other_documents" class="form-control">
        <?php if($generalData['additional_information']!=''): ?>

        <a href=" <?php echo e(URL::to($docBaseUrl.$generalData['additional_information'])); ?>" target="_blank"
            style='float: right;'>View File</a>

        <?php endif; ?>
        <!-- <label for="" class="text-primary">Upload only in PDF format</label><br> -->
        <span class="text-danger"><?php echo e($errors->first('other_documents')); ?></span>

    </div>
</div><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/additional_information.blade.php ENDPATH**/ ?>