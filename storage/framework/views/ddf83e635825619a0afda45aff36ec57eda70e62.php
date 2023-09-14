
<?php $__env->startSection('content'); ?>

<section class="section dashboard">

    <main id="main" class="main">

        <strong>
            <h4 class="text-center">Monthly Progress Report Preview For STUs/CTUs</h4>
        </strong>

        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                </th>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-green text-light">
                    General
                </th>
            </tr>
            <tr>
                <th>Tender/ Bidding Agency for RE Projects</th>
                <td><?php echo e($data['tender_bidding_agency']); ?></td>
                <th>Project Details(Name of Developer)</th>
                <td><?php echo e($data->developer_name ?? ''); ?></td>
            </tr>
            <tr>
                <th>Capacity for connectivity applied (MW)</th>
                <td><?php echo e($data->capacity_connectivity ?? ''); ?></td>
                <th>State</th>
                <td><?php echo e($data->state_name ?? ''); ?></td>
            </tr>
            <tr>
                <th>District</th>
                <td><?php echo e($data->district_name ?? ''); ?></td>
                <th>Sub Station Location District</th>
                <td><?php echo e($data->sub_station ?? ''); ?></td>
            </tr>
            <tr>
                <th>Connectivity Basis</th>
                <td><?php echo e($data->connectivity_basis ?? ''); ?></td>
                <th>LTA operationalization date </th>
                <td><?php echo e(date('d-m-Y', strtotime($data->lta_operationalization_date ?? ''))); ?></td>
            </tr>
            <tr>
                <th>Capacity commissioned in the current month (MW)</th>
                <td><?php echo e($data->capacity_commissioned ?? ''); ?></td>
                <th>Cumulative Capacity Commissioned (MW)</th>
                <td><?php echo e($data->cumulative_capacity ?? ''); ?></td>
            </tr>
            <tr>
                <th>Cumulative Capacity Commissioned Date</th>
                <td><?php echo e(date('d-m-Y', strtotime($data->cumulative_capacity_date ?? ''))); ?></td>
                <th>Remarks </th>
                <td><?php echo e($data->remark ?? ''); ?></td>
            </tr>
        </table>
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
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/stu/progress_report/PreviewProgressReport.blade.php ENDPATH**/ ?>