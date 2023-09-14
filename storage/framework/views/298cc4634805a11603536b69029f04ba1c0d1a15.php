<?php $__env->startSection('content'); ?>



<section class="section dashboard form_sctn">
    <main id="main" class="main">

        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <!-- <div class="row "> -->
            <div class="pagetitle col-xl-12">
                <h1>Manage Scheme <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/add-scheme')); ?>"
                        class="btn btn-success" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add
                        Scheme</a></h1>
                <hr style="color: #959595;">
                <div class="clearfix"></div><br>
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr class=" bg-dark text-dark">
                            <th width="5%">S.No</th>
                            <th>Name of Scheme</th>
                            <th width="10%">Action</th>
                            <th width="10%">Active/Inactive</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!Empty($schemes)): ?>
                        <?php $__currentLoopData = $schemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($scheme->scheme_name); ?></td>
                            <td> <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/scheme/edit/'.$scheme->id)); ?>"
                                    class="btn btn-primary"><i class="fa fa-pencil"> </td>
                            <td><input data-id="<?php echo e($scheme->id); ?>" class="toggle-class" type="checkbox"
                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                    data-off="InActive" <?php echo e($scheme->status ? 'checked' : ''); ?>>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>

                </table>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                <script>
                $(document).ready(function() {
                    $('.toggle-class').change(function() {
                        var status = $(this).prop('checked') == true ? 1 : 0;
                        var id = $(this).data('id');

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/schemes_status',
                            data: {
                                'status': status,
                                'id': id
                            },
                            success: function(data) {
                                alert(data.success)
                            }
                        });
                    })
                })
                </script>
            </div>
        </div>

    </main>
</section>

<?php $__env->stopSection(); ?>
<style>
.error {
    color: red
}
</style>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/reia/scheme-list.blade.php ENDPATH**/ ?>