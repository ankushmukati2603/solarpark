<?php $general = app('App\Http\Controllers\Backend\REIA\MainController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1 class="text-center">Monthly Progress Report For REIAs </h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered table-striped text-left">
                            <tr>
                                <th colspan="4">
                                    <h1>Application Detail : <?php echo e($data->month ?? ''); ?>, <?php echo e($data->year ?? ''); ?></h1>
                                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/progress-report')); ?>"
                                        class="btn btn-success" style="float:right">Back</a>
                                </th>
                            </tr>
                            <tr>
                                <th>Name of Scheme</th>
                                <td><?php echo e($data['scheme_name']); ?></td>
                                <th>State</th>
                                <td><?php echo e($data->state_name ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>District</th>
                                <td><?php echo e($data->district_name ?? ''); ?></td>
                                <th>Type of Project</th>
                                <td><?php echo e($data->project_type ?? ''); ?></td>
                            </tr>
                            <tr>
                                <th>Tender Capacity (MW)</th>
                                <td><?php echo e($data->tender_capacity ?? ''); ?></td>
                                <th>Date of Tender</th>
                                <td><?php echo e(date('d-m-Y', strtotime($data->tender_date ?? ''))); ?></td>
                            </tr>
                            <tr>
                                <th>Date of LOA</th>
                                <td><?php echo e(date('d-m-Y', strtotime($data->loa_date ?? ''))); ?></td>
                                <th>SCoD</th>
                                <td><?php echo e(date('d-m-Y', strtotime($data->scod ?? ''))); ?></td>
                            </tr>
                            <tr>
                                <th>Present Status</th>
                                <td><?php echo e($data->remark ?? ''); ?></td>
                                <th></th>
                                <td></td>
                            </tr>
                            <tr class="bg-primary text-light">
                                <td colspan="4">
                                    <h3>Bidder Details</h3>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Bidder Name</th>
                                            <th>Bidder Capacity (MW)</th>
                                            <th>Date of PPA</th>
                                            <th>PPA Capacity (MW)</th>
                                        </tr>

                                        <?php for($i = 0; $i < count($data['bidder_id']); $i++): ?> <tr>
                                            <td><?php echo e($i+1); ?></td>
                                            <td><?php echo e($general->getBidderName($data['bidder_id'][$i])); ?></td>
                                            <td><?php echo e($data['select_bidders_capacity'][$i]); ?></td>
                                            <td><?php echo e($data['ppa_date'][$i]); ?></td>
                                            <td><?php echo e($data['ppa_capacity'][$i]); ?></td>
                            </tr>

                            <?php endfor; ?>
                        </table>
                        </td>
                        <?php if($data->mnre_remarks!=''): ?>
                        <tr class="bg-primary text-light">
                            <td colspan="4">
                                <h3>MNRE Remark</h3>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3">Present Status : <?php echo e($data->mnre_remarks ?? ''); ?></th>
                            <th colspan="2">Date/Time : <?php echo e($data->mnre_remark_date ?? ''); ?></th>
                        </tr>
                        <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>

<?php $__env->stopPush(); ?>
<style>
.error {
    color: red
}
</style>
<!-- <script src="<?php echo e(asset('public/js/custom.js')); ?>"></script> -->
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/reia/progress_report/PreviewProgressReport.blade.php ENDPATH**/ ?>