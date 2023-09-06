<?php $general = app('App\Http\Controllers\Backend\REIA\MainController'); ?>

<?php $__env->startSection('content'); ?>

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Monthly Progress Report Preview For REIAs/States</h1>
        </div>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1>REIA Name : <?php echo e($data['reia_name'] ?? '--'); ?><a
                            href="<?php echo e(URL::to(Auth::getDefaultDriver().'/Reia-Reports')); ?>" class="btn btn-success"
                            style="float:right">Back</a></h1>

                </th>
            </tr>
            <tr>
                <th>Name of Scheme</th>
                <td><?php echo e($data['scheme_id'] ?? '--'); ?></td>
                <th>State</th>
                <td><?php echo e($data->state_id ?? ''); ?></td>

            </tr>
            <tr>
                <th>District</th>
                <td><?php echo e($data->district_id ?? ''); ?></td>
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Remarks
        </button>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/submitRemarkReia')); ?>" id="formFileAjax" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row1 app_progrs_rprt1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="dropdown">
                                    <label for="">Select Status <span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example" name="mnre_status">
                                        <option value=''>Select</option>
                                        <option value="1">Approve</option>
                                        <option value="2">Partial Approve</option>
                                        <option value="3">Reject</option>
                                    </select>
                                </div> <br>
                                <label for=""> Remark <span class="text-danger">*</span></label>
                                <textarea name="mnre_remarks" class="form-control" id="" cols="5" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" name="editId" value="<?php echo e($general->encodeid($data->id)); ?>">
                                <button type="submit" id="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </main>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<style>
.error {
    color: red
}
</style>
<!-- <script src="<?php echo e(asset('public/js/custom.js')); ?>"></script> -->
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/ReiaReport/PreviewReiaReport.blade.php ENDPATH**/ ?>