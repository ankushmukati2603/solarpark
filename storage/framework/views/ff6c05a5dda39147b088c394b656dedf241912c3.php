
<?php $__env->startSection('content'); ?>

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/')); ?>">Home</a></li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <form action="<?php echo e(url(Auth::getDefaultDriver().'/new-gec-progress-report')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%"><label>Month<span class="text-danger">*</span></label></th>
                            <td><select name="month" id="" class="form-control">
                                    <option value="">Select Month</option>
                                    <?php for($i=1;$i<=12;$i++) {?>
                                    <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th><label>Year<span class="text-danger">*</span></label></th>
                            <td><select name="year" id="" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php for($j=2023;$j>2004;$j--) {?>
                                    <option value="<?=$j?>"><?=$j?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th><label>Package Name<span class="text-danger">*</span></label></th>
                            <td><select name="package_name" class="form-control" id="">
                                    <option value="">Select Package Name</option>
                                    <option value="ABC">ABC</option>
                                    <option value="DEF">DEF</option>
                                    <option value="GHI">GHI</option>
                                    <option value="JKL">JKL</option>
                                    <option value="MNO">MNO</option>
                                </select></td>
                        </tr>
                        <tr>
                            <th><label>Package No.<span class="text-danger">*</span></label></th>
                            <td><select name="package_no" class="form-control" id="">
                                    <option value="">Select Package Number</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">4</option>
                                    <option value="4">5</option>
                                    <option value="5">6</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" value="Submit" id="submit" name="submit"
                                    class="btn btn-flat btn-success">Add
                                    Report</button>
                                <input type="hidden" name="editId" value="<?php echo e($progressData->id ?? ''); ?>">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/gecdeveloper/progress_report/newProgressReport.blade.php ENDPATH**/ ?>