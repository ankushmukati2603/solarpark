
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Tenders/Add')); ?>" class="btn btn-success"
                            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add Tender</a>

                        <a href="javascript:;" id="reportExcel" class="btn btn-danger" style="float: right;"><i
                                class="fa fa-download" aria-hidden="true"></i>
                            Export</a>
                        <h1>Tender Management</h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr class=" bg-primary text-light">
                                <th>S.No</th>
                                <th>Tender No</th>
                                <th width="15%">NIT No</th>
                                <th>Scheme Type</th>
                                <th width="20%">Tender Title</th>
                                <th>Capacity(MW)</th>
                                <th>Pre Bid Meeting</th>
                                <th>Last Date of Bid Submission</th>
                                <th>Published Date</th>
                                <th width="10%">Status</th>
                                <th>Action</th>
                            </tr>
                            <?php $__currentLoopData = $tenderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <td><?php if($tender->tender_status ==1): ?><span
                                        class="text-primary">Tender</span><?php elseif($tender->tender_status ==2): ?><span
                                        class="text-info">Partially Implementation</span><?php elseif($tender->tender_status
                                    ==3): ?>
                                    <span class="text-success">Commissioned</span><?php elseif($tender->tender_status
                                    ==4): ?><span class="text-danger">Cancelled</span><?php else: ?>--<?php endif; ?>

                                </td>
                                <td><?php if($tender->tender_status !=4): ?><a
                                        href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/Tenders/Edit/'.$tender->id)); ?>">Edit</a>
                                    |<?php endif; ?><a
                                        href=" <?php echo e(URL::to(Auth::getDefaultDriver().'/TenderPreview/'.base64_encode($tender->id))); ?>">View</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- <tr>
                    <td colspan="11">No Record Found</td>
                </tr> -->
                        </table>
                    </div>

                    <?php echo e($tenderList->links()); ?>

                </div>
            </div>



            <span id="exceldata" style="display:none;"></span>

    </main>
</section>
<!-- </section> -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
$('#reportExcel').on('click', function() {
    $('#loading-bg-ajax').removeClass('hide');

    $.ajax({
        type: 'GET',
        url: baseUrl + '/<?php echo e(Auth::getDefaultDriver()); ?>/tenderexcelreport',
        success: function(data) {
            $('#loading-bg-ajax').addClass('hide');
            if (data.status == 'error') {
                $('#exceldata').html('Error');
            } else {
                $('#exceldata').html(data.result);
                ExportToExcel('xlsx');
            }
        }
    });
});

function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('stakeHoldersTable1');
    var wb = XLSX.utils.table_to_book(elt, {
        sheet: "sheet1"
    });
    var wscols = [{
        wpx: 100
    }];
    wb['cols'] = wscols;
    return dl ?
        XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        }) :
        XLSX.writeFile(wb, fn || ('tenderdetail.' + (type || 'xlsx')));
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/state-implementing-agency/tenders.blade.php ENDPATH**/ ?>