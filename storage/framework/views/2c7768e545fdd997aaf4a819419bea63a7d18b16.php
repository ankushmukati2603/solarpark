<?php $general = app('App\Http\Controllers\Backend\Mnre\MainController'); ?>

<?php $__env->startSection('content'); ?>

<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>Green Energy Coridor (GEC Phase II)</h1>
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/new-gec-progress-report')); ?>"
                            class="btn btn-success" style="float: right;"><i class="fa fa-plus"
                                aria-hidden="true"></i>Progress
                            Report</a>

                        <hr style="color: #959595;">
                        <form action="<?php echo e(url(Auth::getDefaultDriver().'/progress-report')); ?>" method="post"><?php echo csrf_field(); ?>
                            <div class="row col-md-12 ">
                                <div class="col-md-6">
                                    <label>Submitted On<span class="error">*</span></label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control alldatepicker "
                                            id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="date" value="">
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('date')); ?></span>
                                </div>
                                <div class="col-md-4"><br>
                                    <button class="btn btn-md btn-info" type="submit">Search</button>
                                </div>
                            </div>

                        </form>

                        <div class="clearfix"></div><br>


                        <table class="table table-bordered">
                            <tr class=" bg-success text-light">
                                <th>S.No</th>
                                <th>Report <br>
                                    Month / Year
                                </th>
                                <th>Project Type</th>
                                <th>MNRE Sanction Date</th>
                                <th>Tender Notice Date</th>
                                <th>DPR Cost (In Cr)</th>
                                <th>Awarded Cost (In Cr)</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Remarks by MNRE</th>
                                <th>Action</th>
                            </tr>
                            <?php if(!Empty($progressDetails)): ?>
                            <?php $generalData='' ?>
                            <?php $__currentLoopData = $progressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progressData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($progressData['month'] .'/'. $progressData['year']); ?></td>
                                <td>
                                    <?php if($progressData['project_type']==1): ?>
                                    Line
                                    <?php elseif($progressData['project_type']==2): ?>
                                    SS
                                    <?php elseif($progressData['project_type']==3): ?>
                                    Bays
                                    <?php elseif($progressData['project_type']==4): ?>
                                    Reactors
                                    <?php elseif($progressData['project_type']==5): ?>
                                    Procurement work
                                    <?php else: ?>
                                    Other
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e($progressData['mnre_sanction_date'] ?? '--'); ?></td>
                                <td><?php echo e($progressData['tender_notice_date'] ?? '--'); ?></td>
                                <td><?php echo e($progressData['dpr_cost'] ?? '--'); ?></td>
                                <td><?php echo e($progressData['awarded_cost'] ?? '--'); ?></td>
                                <td><?php echo e($progressData['entry_date'] ?? '--'); ?></td>
                                <td><?php if($progressData['status']==1): ?>
                                    Reviewd
                                    <?php else: ?>
                                    Pending
                                    <?php endif; ?></td>
                                <td><?php echo e($progressData['gecmnre_remark'] ?? 'NA'); ?></td>
                                <td><?php if($progressData->final_submission ==0): ?>
                                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report/'.$general->encodeid($progressData['id']))); ?>"
                                        class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                    <?php else: ?>
                                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/preview-progress-report/'.$general->encodeid($progressData['id']))); ?>"
                                        class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="11">No Record Found</td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>

                </div>
            </div>

    </main>
    <style>
    .col-md-3 {
        flex: 0 0 auto;
        width: 25%;
        display: inline-block !important;
    }
    </style>
</section>
<?php $__env->stopSection(); ?>
<style>
.error {
    color: red
}
</style>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/gecdeveloper/progress_report/myProgressReport.blade.php ENDPATH**/ ?>