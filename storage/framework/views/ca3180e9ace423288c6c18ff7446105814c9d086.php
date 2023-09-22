<?php $general = app('App\Http\Controllers\Backend\MNRE\ReportController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>SNA Tender Details</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-success text-light">
                                    <th>S.No</th>
                                    <th>Tender No</th>
                                    <th width="15%">NIT No</th>
                                    <th>Scheme Type</th>
                                    <th width="20%">Tender Title</th>
                                    <th>Capacity(MW)</th>
                                    <th>Pre Bid Meeting</th>
                                    <th>Last Date of Bid Submission</th>
                                    <th>Tender Published Date</th>
                                    <th width="15%">MNRE Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $snaReportDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($tender->tender_no); ?></td>
                                    <td><?php echo e($tender->nit_no); ?></td>
                                    <td><?php echo e($tender->scheme_type); ?></td>
                                    <td><?php echo e($tender->tender_title); ?></td>
                                    <td><?php echo e($tender->capacity); ?></td>
                                    <td><?php echo e(date("d M Y",strtotime($tender->pre_bid_meeting_date))); ?></td>
                                    <td><?php echo e(date("d M Y",strtotime($tender->bid_submission_date))); ?></td>
                                    <td><?php echo e(date("d M Y",strtotime($tender->nit_date))); ?></td>

                                    <td><?php echo e($tender->mnre_remarks ?? '--'); ?></td>
                                    <td><a
                                            href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/Preview-Sna-Report/'.$general->encodeid($tender->id))); ?>">View</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
    </main>
</section>
<!-- </section> -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/SnaReport/snaProgressReport.blade.php ENDPATH**/ ?>