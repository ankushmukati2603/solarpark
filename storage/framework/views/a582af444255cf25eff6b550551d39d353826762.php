
<?php $__env->startSection('content'); ?>
<section class="section dashboard">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <style>
    div#reportTable_filter label {
        float: right !important;
        width: 33% !important;
    }
    </style> -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tender Report</h1>
        </div>
        <section class="section dashboard">
            <table class="table table-striped">
                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/TenderReport')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <tr>
                        <th width="20%">
                            <label for="">From Date</label>
                            <input type="date" class="form-control" name="fromdate" />
                        </th>
                        <th width="20%">
                            <label for="">To Date </label>
                            <input type="date" class="form-control" name="todate" />
                        </th>
                        <th width="20%">
                            <label for="">Tender ID </label>
                            <select name="tender_id" class="form-control">
                                <option value="">Select Tender ID</option>
                                <?php $__currentLoopData = $searchFilters['tenders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tender['id']); ?>"><?php echo e($tender['tender_no']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th width="20%">
                            <label for="">State </label>
                            <select name="state_id" id="state_id" class="form-control">
                                <option value="">Choose State</option>
                                <?php $__currentLoopData = $searchFilters['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state['code']); ?>"><?php echo e($state['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th>
                            <label for="">Bidding Agency </label>
                            <select name="agency_id" id="agency_id" class="form-control">
                                <option value="">Choose Agency</option>
                                <?php $__currentLoopData = $searchFilters['agencies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($agency['id']); ?>"><?php echo e($agency['agency_name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                    </tr>
                    <tr>


                        <th colspan="5">
                            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/TenderReport')); ?>" class="btn btn-danger"
                                style="float:right;margin-left:5px">Reset</a>
                            <input type="submit" name="submit" id="submit1" value="Search" class="btn btn-success"
                                style="float:right">

                        </th>
                    </tr>
                </form>
            </table>
            <table class="table table-bordered table-striped" id="reportTable" style="width:100%">
                <thead>
                    <tr class="bg-primary text-light">
                        <th width="5%" class="hide">S.No</th>
                        <th width="10%">Tender ID</th>
                        <th width="10%">State</th>
                        <th width="35%">Bidders Agency</th>
                        <th width="15%">Description</th>
                        <th width="10%">Submitted On</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($reportData)>0): ?>
                    <?php $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="hide"><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($data['tender_no'] ?? ''); ?></td>
                        <td><?php echo e($data['state'] ?? ''); ?></td>
                        <td><?php echo e($data['agency_name'] ?? ''); ?> <br>
                            SPA : <b><?php echo e($data['sub_agency_name'] ?? 'NA'); ?></b>
                        </td>
                        <td>
                            <?php if($data['action_type']=='tender'): ?>
                            <span class="text-success">Tender Published</span>
                            <?php elseif($data['action_type']=='ra'): ?>
                            <span class="text-warning">Reverse Auction</span>
                            <?php elseif($data['action_type']=='cancel'): ?>
                            <span class="text-danger">Tender Cancelled</span>
                            <?php elseif($data['action_type']=='bidder'): ?>
                            <span class="text-primary">Bidders Participated</span>
                            <?php elseif($data['action_type']=='psa'): ?>
                            <span class="text-info">PSA Details Submitted</span>
                            <?php elseif($data['action_type']=='ppa'): ?>
                            <span class="text-info">PPA Details Submitted</span>
                            <?php elseif($data['action_type']=='loa'): ?>
                            <span style="color:#0ecfa2 !important">LOA/LOI Details Submitted</span>
                            <?php elseif($data['action_type']=='commissioned'): ?>
                            <span style="color:#539b1c !important">Commissioned Details Submitted</span>
                            <?php else: ?>
                            Other
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(date("d-F-Y",strtotime($data['action_date'])) ?? ''); ?></td>
                        <td>
                            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/ReportView/'.base64_encode($data['id']).'/'.base64_encode($data['tender_id']))); ?>"
                                target="_blank">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a
                                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/DownloadReport/'.base64_encode($data['id']).'/'.base64_encode($data['tender_id']))); ?>">
                                <i class="fa fa-file-pdf-o text-danger"> | PDF</i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th width="5%">S.No</th>
                        <th width="15%">Tender ID</th>
                        <th width="10%">State</th>
                        <th width="30%">Bidders Agency</th>
                        <th width="15%">Description</th>
                        <th width="10%">Submitted On</th>
                        <th width="5%">Action</th>
                    </tr>
                </tfoot> -->
            </table>


        </section>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>

<script>
$(document).ready(function() {
    $('#reportTable').DataTable({
        search: {
            return: true,
        },
        order: [
            [0, 'desc']
        ],
    });
});
// let currentTime = new Date().getTime();
// let birthDateTime = new Date('2005-01-01').getTime();
// let difference = (currentTime - birthDateTime);
// var ageInYears = difference / (1000 * 60 * 60 * 24 * 365);
</script>
<!-- <script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script> -->

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/reportTenders.blade.php ENDPATH**/ ?>