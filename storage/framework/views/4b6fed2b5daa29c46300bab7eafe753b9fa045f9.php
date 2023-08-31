<?php $general = app('App\Http\Controllers\Backend\Mnre\MainController'); ?>

<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Agency/Add')); ?>" class="btn btn-success"
                            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add New SPPD</a>
                        <h1>SPPD's Management</h1>

                        <hr style="color: #959595;">

                        <table class="table table-bordered">
                            <tr class=" bg-dark text-dark">
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>PAN Number</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Status</th>
                                <th width="10%">Registered On</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php $__currentLoopData = $sppdList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sppd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($sppd->name); ?></td>
                                <td><?php echo e($sppd->email); ?></td>
                                <td><?php echo e($sppd->contact_no); ?></td>
                                <td><?php echo e('******' . substr( $sppd->pan_no, - 4)); ?></td>
                                <td><?php echo e($sppd->state_name); ?></td>
                                <td><?php echo e($sppd->district_name); ?></td>
                                <td>
                                    <?php if($sppd->isApproved==0): ?>
                                    <b class="text-warning">Pending</b>
                                    <?php elseif($sppd->isApproved==1): ?>
                                    <b class="text-success">Approved</b>
                                    <?php else: ?>
                                    <b class="text-danger">Rejected</b><br>
                                    <a href="javascript:;" data-bs-target="#sppdRemarkModal<?php echo e($sppd->id); ?>"
                                        data-bs-toggle="modal" class="badge bg-success">Remarks</a>
                                    <div class="modal fade" id="sppdRemarkModal<?php echo e($sppd->id); ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e($sppd->name); ?>

                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="">Remark: </label><br>
                                                            <?php echo e($sppd->remarks); ?>

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($sppd->created_at); ?></td>
                                <!--<td><a href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/developer-mnre/Edit/'.$sppd->id)); ?>"
                                        class="btn btn-primary">Edit</a> </td>-->
                                <td><a data-bs-toggle="modal" href="javascript:;"
                                        data-bs-target="#sppdModal<?php echo e($sppd->id); ?>" class="badge bg-success">Action</a>
                                    <!-- Model -->
                                    <div class="modal fade" id="sppdModal<?php echo e($sppd->id); ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form
                                                    action="<?php echo e(URL::to(Auth::getDefaultDriver().'/SppdApproveReject')); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e($sppd->name); ?>

                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Status: <span
                                                                        class="text-danger">*</span></label>
                                                                <select name="isApproved" id="isApproved"
                                                                    class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Approved</option>
                                                                    <option value="2">Rejected</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 mt-3">
                                                                <label for="">Remark: <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea name="remarks" id="remarks" cols="30" rows="5"
                                                                    class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" id="id"
                                                            value="<?php echo e($general->encodeid($sppd->id)); ?>">
                                                        <button type="submit" id="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>

                    <?php echo e($sppdList->links()); ?>

                </div>
            </div>

    </main>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/sppdList.blade.php ENDPATH**/ ?>