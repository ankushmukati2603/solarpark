
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Received Report'); ?>

<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">

                        <h1>GEC Report Preview
                        </h1>

                        <hr style="color: #959595;">
                        <table class="table table-bordered">
                            <tr>
                                <th width="25%">Report Date (Month/Year)</th>
                                <td><?php echo e($gecReportData->month); ?>/<?php echo e($gecReportData->year); ?></td>
                            </tr>
                            <tr>
                                <th>Package Name</th>
                                <td><?php echo e($gecReportData->package_name ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Project Type</th>
                                <td>
                                    <?php if($gecReportData->project_type==1): ?>
                                    Line
                                    <?php elseif($gecReportData->project_type==2): ?>
                                    SS
                                    <?php elseif($gecReportData->project_type==3): ?>
                                    Bays
                                    <?php elseif($gecReportData->project_type==4): ?>
                                    Reactors
                                    <?php elseif($gecReportData->project_type==5): ?>
                                    Procurement work
                                    <?php else: ?>
                                    Other
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Project Under Package</th>
                                <td><?php echo e($gecReportData->project_under_package ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Mnre Sanction Date</th>
                                <td><?php echo e($gecReportData->mnre_sanction_date ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Tender Notice Date</th>
                                <td><?php echo e($gecReportData->tender_notice_date ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Last Submission Date</th>
                                <td><?php echo e($gecReportData->last_submission_date ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Technical Bid Opening Date</th>
                                <td><?php echo e($gecReportData->technical_bid_opening_date ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Financial Bid Opening Date</th>
                                <td><?php echo e($gecReportData->financial_bid_opening_date ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Award Package Date</th>
                                <td><?php echo e($gecReportData->award_package_date ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>DPR Cost(In Cr.)</th>
                                <td><?php echo e($gecReportData->dpr_cost ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Awarded Cost(In Cr.)</th>
                                <td><?php echo e($gecReportData->awarded_cost ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Package Expenditure Cost</th>
                                <td><?php echo e($gecReportData->package_expenditure ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Financial Progress</th>
                                <td><?php echo e($gecReportData->financial_progress ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Land Details</th>
                                <td><?php echo e($gecReportData->land_detail ?? '--'); ?></td>
                            </tr>
                            <tr>
                                <th>Forest Clearance Details</th>
                                <td><?php echo e($gecReportData->forest_clearance_details ?? '--'); ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

    </main>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/gecdeveloper/progress_report/previewProgressReport.blade.php ENDPATH**/ ?>