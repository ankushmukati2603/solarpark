<?php $general = app('App\Http\Controllers\Backend\Mnre\ReportController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1 class="text-center">Monthly Progress Report For REIAs/States </h1>
                        <hr style="color: #959595;">
                        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form action="<?php echo e(url(Auth::getDefaultDriver().'/progress-report')); ?>" method="post"><?php echo csrf_field(); ?>
                            <div class="row col-md-12">
                                <div class="col-md-3">

                                    <label>Submitted From</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control pull-right alldatepicker "
                                            id="created_date" placeholder="MM-DD-YYYY" name="filter[from_date]"
                                            value="<?php echo e($filters['from_date']??''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Submitted To</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control pull-right alldatepicker "
                                            id="created_date" placeholder="MM-DD-YYYY" name="filter[to_date]"
                                            value="<?php echo e($filters['to_date']??''); ?>">
                                    </div>
                                </div><!-- comment -->
                                <div class="col-md-3">
                                    <label>State</label>
                                    <div class="input-group">
                                        <select class="form-control" id="state_id" name="filter[state_id]"
                                            onchange="getDistrictByState(this.value, '')">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($state['code']==@$filters['state_id']): ?> selected <?php endif; ?>
                                                value="<?php echo e($state->code); ?>"><?php echo e($state->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div><!-- comment -->
                                <div class="col-md-3">
                                    <label>Distict</label>
                                    <div class="input-group">
                                        <select class="form-control" id="district_id" name="filter[district_id]">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Date of Tender</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control pull-right alldatepicker "
                                            id="tender_date" placeholder="MM-DD-YYYY" name="filter[tender_date]"
                                            value="<?php echo e($filters['tender_date']??''); ?>">
                                    </div>
                                </div><!-- comment -->

                                <div class="col-md-3">
                                    <label>Scheme Name</label>
                                    <div class="input-group date">
                                        <select class="form-control" id="scheme_name" name="filter[scheme_name]">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $schemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sc->id); ?>"><?php echo e($sc->scheme_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label> <br></label>
                                    <div>
                                        <button class="btn btn-sm btn-md btn-info pull-right"
                                            type="submit">Search</button>
                                        <a id="reseta" href="<?php echo e(Request::fullUrl()); ?>"
                                            class="btn btn-sm btn-flat btn-danger pull-right">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        <table class="table table-bordered display nowrap" id="example">
                            <thead>
                                <tr class="bg-success text-light">
                                    <th style="display: none;">S.No</th>
                                    <th>Report Month</th>
                                    <th>Report Year</th>
                                    <th>Name of Scheme</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Type of Project</th>
                                    <th>Tender Capacity (MW)</th>
                                    <th>Submitted Date </th>
                                    <th>Present Status</th>
                                    <th>MNRE Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reiaProgressReportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progressData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="display: none;"><?php echo e($progressData->id); ?></td>
                                    <td><?php echo e(date("F", mktime(0, 0, 0, $progressData->month, 1 ))); ?></td>
                                    <td><?php echo e($progressData->year); ?></td>
                                    <td><?php echo e($progressData->scheme_id); ?></td>
                                    <td><?php echo e($progressData->state_id); ?></td>
                                    <td><?php echo e($progressData->district_id); ?></td>
                                    <td><?php echo e($progressData->project_type); ?></td>
                                    <td><?php echo e($progressData->tender_capacity); ?></td>
                                    <td><?php echo e(date('d-m-Y', strtotime($progressData->created_date))); ?></td>
                                    <td><?php echo e($progressData->remark ?? 'NA'); ?></td>
                                    <td><?php echo e($progressData->mnre_remarks ?? 'NA'); ?></td>
                                    <td><a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/Preview-Reia-Report/'.$general->encodeid($progressData->id))); ?>"
                                            target="_blank">View</a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/datatable/jquery.dataTables.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('public/datatable/buttons.dataTables.min.css')); ?>" />
<script src="<?php echo e(asset('public/datatable/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/datatable/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/datatable/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/datatable/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('public/datatable/buttons.html5.min.js')); ?>"></script>
<script>
$(document).ready(function() {
    var oTable = $('#example').DataTable({
        // ordering: 'desc',
        // ordering: true,
        order: [
            [0, 'desc']
        ],
        dom: 'Blfrtip',
        buttons: [{
                extend: 'pdf',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'csv',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excel',
                footer: false
            }


        ]
    });

});
</script>
<?php $__env->stopPush(); ?>
<style>
.error {
    color: red
}
</style>
<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/ReiaReport/progressReport.blade.php ENDPATH**/ ?>