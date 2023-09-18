<?php $general = app('App\Http\Controllers\Backend\SNA\MainController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Cancelled Tender</h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-success text-light">
                                    <th>S.No</th>
                                    <th>Agency</th>
                                    <th>Tender No</th>
                                    <th width="15%">NIT No</th>
                                    <th>Scheme Type</th>
                                    <th width="20%">Tender Title</th>
                                    <th>Capacity(MW)</th>
                                    <th>Cancel Type</th>
                                    <th>Cancelled Capacity</th>
                                    <th>Cancelled Date</th>
                                    <th width="10%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cancelledtenderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($tender->sna_name); ?></td>
                                    <td><?php echo e($tender->tender_no); ?></td>
                                    <td><?php echo e($tender->nit_no); ?></td>
                                    <td><?php echo e($tender->scheme_type); ?></td>
                                    <td><?php echo e($tender->tender_title); ?></td>
                                    <td><?php echo e($tender->capacity); ?></td>
                                    <td><?php echo e($tender->cancel_type ?? '--'); ?></td>
                                    <td><?php echo e($tender->cancel_capacity ?? '--'); ?></td>
                                    <td><?php echo e(date("d M Y",strtotime($tender->cancel_date))); ?></td>
                                    <td><?php echo e($tender->cancel_remark ?? '--'); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/cancelledtender.blade.php ENDPATH**/ ?>