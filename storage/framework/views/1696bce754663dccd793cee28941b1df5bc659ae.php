
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Feedback</h1>
        </div>
        <section class="section dashboard">
            <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/feedback')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <table class="table table-bordered">
                  
                     <tr>
                        <th width="20%">Name</th>
                        <td width="30%"><input type="text"class="form-control" readonly="" value="<?php echo e(Auth::user()->name); ?>"> </td>
                      <th width="20%">Email ID</th>
                        <td width="30%"><input type="text"class="form-control" readonly="" value="<?php echo e(Auth::user()->email); ?>"> </td>
                    </tr>
                    <tr>
                        <th width="20%">Contact Number <span class="text-danger">*</span></th>
                        <td width="30%"><input type="text"  class="form-control" readonly="" placeholder="Enter Contact Person"  value="<?php echo e(Auth::user()->phone); ?>"> </td>
                  <th width="20%">Message</th>
                  <td width="30%"><textarea class="form-control" name="message" id="message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" name="submit" class="btn btn-success" value="Save" />
                            <input type="reset" class="btn btn-danger" value="Cancel" />
                        </td>
                    </tr>
                </table>
            </form>


        </section>
    </main>
</section>
<!-- </section> -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/reia/feedback.blade.php ENDPATH**/ ?>