
<?php $__env->startSection('content'); ?>

<section class="section dashboard form_sctn">
    <main id="main" class="main">

        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <!-- <div class="row "> -->
            <div class="pagetitle col-xl-12">
                <h1>Add Scheme</h1>
                <hr style="color: #959595;">
                <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form action="<?php echo e(url(Auth::getDefaultDriver().'/add-scheme')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%"><label>Scheme Name<span class="text-danger">*</span></label></th>
                                <td>
                                    <input type="text" name="scheme_name" id="" class="form-control"
                                        value="<?php echo e($SchemeData->scheme_name??''); ?>" placeholder="Scheme Name">
                                    <input type="hidden" name="editId" value="<?php echo e($SchemeData->id ?? ''); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" value="Submit" id="submit" name="submit"
                                        class="btn btn-flat btn-success">Submit</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>

    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/reia/addScheme.blade.php ENDPATH**/ ?>