<?php $general = app('App\Http\Controllers\Backend\STU\MainController'); ?>

<?php $__env->startSection('content'); ?>

<section class="section dashboard form_sctn">
    <main id="main" class="main">

        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <!-- <div class="row "> -->
            <div class="pagetitle col-xl-12">
                <h1 class="text-center">Monthly Progress Report
                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/add-progress-report')); ?>" class="btn btn-success"
                        style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Progress Report</a>
                </h1>
                <hr style="color: #959595;">
                <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <form action="<?php echo e(url(Auth::getDefaultDriver().'/progress-report')); ?>" method="post"><?php echo csrf_field(); ?>
                    <div class="row col-md-12">
                        <div class="col-md-3">

                            <label>Submitted From</label>
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right alldatepicker " id="created_date"
                                    placeholder="MM-DD-YYYY" name="filter[from_date]"
                                    value="<?php echo e($filters['from_date']??''); ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Submitted To</label>
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right alldatepicker " id="created_date"
                                    placeholder="MM-DD-YYYY" name="filter[to_date]" value="<?php echo e($filters['to_date']??''); ?>">
                            </div>
                        </div>

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
                        </div>

                        <div class="col-md-3">
                            <label>Distict</label>
                            <div class="input-group">
                                <select class="form-control" id="district_id" name="filter[district_id]"
                                    onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Name of Developer</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="developer_name"
                                    placeholder="Name of Developer" name="filter[developer_name]"
                                    value="<?php echo e($filters['developer_name']??''); ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label> <br></label>
                            <div><button class="btn btn-sm btn-md btn-info pull-right" type="submit">Search</button>
                                <a id="reseta" href="<?php echo e(Request::fullUrl()); ?>"
                                    class="btn btn-sm btn-flat btn-danger pull-right">Reset</a>
                            </div>

                        </div>
                    </div>
                </form>

                <!-- <div class="clearfix"></div><br> -->
                <br>
                <hr>



                <table class="table table-bordered " id="example">
                    <thead>
                        <tr class="bg-dark text-dark">
                            <th>Report Month</th>
                            <th>Report Year</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Name of Developer</th>
                            <th>Capacity connectivity (MW)</th>
                            <th>Connectivity Basis</th>
                            <th>Capacity commissioned (MW)</th>
                            <th>Cumulative Capacity (MW)</th>
                            <th>Submitted Date </th>
                            <th>Remarks</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $progressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progressData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(date("F", mktime(0, 0, 0, $progressData->month, 1 ))); ?></td>
                            <td><?php echo e($progressData->year); ?></td>
                            <td><?php echo e($progressData->state_name); ?></td>
                            <td><?php echo e($progressData->district_name); ?></td>
                            <td><?php echo e($progressData->developer_name); ?></td>
                            <td><?php echo e($progressData->capacity_connectivity); ?></td>
                            <td><?php echo e($progressData->connectivity_basis); ?></td>
                            <td><?php echo e($progressData->capacity_commissioned); ?></td>
                            <td><?php echo e($progressData->cumulative_capacity); ?></td>
                            <td>
                                <?php if($progressData['final_submission'] == 1): ?>
                                <?php echo e(date('d-m-Y', strtotime($progressData->entry_date))); ?>

                                <?php else: ?>
                                <span class="text-danger">Saved As Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($progressData->remark); ?></td>
                            <td>
                                <?php if($progressData['final_submission'] ==1): ?>
                                <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/previewprogressreport/'.$general->encodeid($progressData->id))); ?>"
                                    target="_blank" class="btn btn-primary"> <i class="fa-solid fa-eye"></i> </a>
                                <?php endif; ?>
                                <?php if($progressData['final_submission'] == 0): ?>
                                <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/new-stu-progress_report/' .$general->encodeid($progressData->id))); ?>"
                                    class="btn btn-danger"><i class="fa-solid fa-pencil"></i> </a>

                                <?php endif; ?>

                            </td>
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
<script>
// $(document).ready(function() {
//     var oTable = $('#example').DataTable({
//         // ordering: 'desc',
//         // ordering: true,
//         order: [
//             [0, 'desc']
//         ],
//         dom: 'Blfrtip',
//         buttons: [{
//                 extend: 'pdf',
//                 //    footer: true,
//                 orientation: 'landscape',
//                 exportOptions: {
//                     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
//                 }

//             },
//             {
//                 extend: 'csv',
//                 //    footer: true,
//                 orientation: 'landscape',
//                 exportOptions: {
//                     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
//                 }
//             },
//             {
//                 extend: 'excel',
//                 footer: false
//             }
//         ]
//     });
// });
</script>
<?php $__env->stopPush(); ?>

<script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/stu/progress_report/myProgressReport.blade.php ENDPATH**/ ?>