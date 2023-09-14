
<?php $__env->startSection('content'); ?>
<!-- <?php if(session()->has('message')): ?>
<div class="alert alert-success">
    <?php echo e(session()->get('message')); ?>

</div>
<?php endif; ?> -->
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">New Progress Report</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <form action="<?php echo e(url(Auth::getDefaultDriver().'/new-progress-report')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <th width="10%"><label>Month<span class="text-danger">*</span></label></th>
                            <td><select name="month" id="" class="form-control"><?php for($i=1;$i<=12;$i++) {?>
                                    <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th><label>Year<span class="text-danger">*</span></label></th>
                            <td><select name="year" id="" class="form-control"><?php for($j=2023;$j>2004;$j--) {?>
                                    <option value="<?=$j?>"><?=$j?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th><label>Solar Park Name<span class="text-danger">*</span></label></th>
                            <td><select class="form-control  " id="" name="solar_park_name">
                                    <option disabled selected>~~~~~~Select~~~~~~ </option>
                                    <?php $__currentLoopData = $solarPark_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solar_parkname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($solar_parkname->id); ?>">
                                        <?php echo e(ucwords($solar_parkname->solar_park_name)); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th colspan="2"><button type="submit" value="Submit" name="submit"
                                    class="btn btn-flat btn-success">Add
                                    Report</button>
                                <input type="hidden" name="editId" value="<?php echo e($progressData->id ?? ''); ?>">
                            </th>
                        </tr>
                    </table>
                    <!-- <div class="col-lg-12">
                        <div class="col-md-3 col-sm-6 " style="display:inline-block">


                        </div>
                        <div class="col-md-3 col-sm-6" style="display:inline-block">


                        </div>
                        <div class="col-md-3 col-sm-6" style="display:inline-block">


                        </div>

                    </div> -->
                </div>
            </form>
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
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/newProgressReport.blade.php ENDPATH**/ ?>