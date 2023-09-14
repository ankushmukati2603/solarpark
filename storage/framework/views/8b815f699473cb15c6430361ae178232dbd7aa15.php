
<?php $__env->startSection('content'); ?>
<!-- <?php if(session()->has('message')): ?>
<div class="alert alert-success">
    <?php echo e(session()->get('message')); ?>

</div>
<?php endif; ?> -->
<section class="section dashboard">
    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>New Report</h1>
                        <hr style="color: #959595;">
                    </div>

                    <section class="section dashboard">
                        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <form action="<?php echo e(url(Auth::getDefaultDriver().'/add-progress-report')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="row">

                                <div class="col-md-4 col-sm-12 pb-3">
                                    <label for="email">Month <span class="text-danger">*</span></label>
                                    <select name="month" id="" class="form-control"><?php for($i=1;$i<=12;$i++) {?>
                                        <option value="<?=$i?>">
                                            <?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 pb-3">
                                    <label for="email">Year <span class="text-danger">*</span></label>
                                    <select name="year" id="" class="form-control"><?php for($j=2023;$j>2004;$j--) {?>
                                        <option value="<?=$j?>"><?=$j?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 pb-3">
                                    <label for="email">Project <span class="text-danger">*</span></label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $projectList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($project->id); ?>"><?php echo e($project->project_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-xl-12">

                                    <div class=" pt-4">

                                        <button type="submit" value="Submit" name="submit"
                                            class="btn btn-flat btn-success">Add
                                            Report</button>
                                        <input type="reset" class="btn btn-danger" value="Cancel" />
                                    </div>
                                </div>
                            </div>


                        </form>
                    </section>
                </div>
            </div>
        </div>
    </main>
</section>
<!-- </section> -->
<?php echo $__env->make('modals.consumerInstallerAssociation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/stu/progress_report/StuProjectReportMonthYear.blade.php ENDPATH**/ ?>