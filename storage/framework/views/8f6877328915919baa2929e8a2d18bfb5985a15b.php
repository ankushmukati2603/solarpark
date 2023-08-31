<?php $general = app('App\Http\Controllers\Backend\SNA\TenderController'); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Progress Report'); ?>
<?php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/';
?>
<section class="section dashboard" id="divToPrint">

    <main id="main" class="main">

        <style>
        .heading {
            text-align: left;
            font-size: 25px;
            background-color: lightblue;
        }
        </style>
        <style type="text/css">
        @media  print {

            table,
            th,
            td {
                border: 1px solid #ccc !important;
                text-align: left !important;
                border-collapse: collapse !important;
                padding: 4px !important;
                width: 100% !important;
                font-size: 12px !important;
                table-layout: fixed !important;
            }

            th {
                font-weight: bold;
            }

            .cls-success {
                background-color: #198754 !important;
            }

            .bg-primary {
                background-color: #015296 !important;
            }

            .text-light {
                color: #f8f9fa !important;
            }

            .bg-info {
                background-color: #0dcaf0 !important;
            }

            .bg-warning {
                background-color: #ffc107 !important;
            }

            #print {
                display: none;
            }

            .wid {
                width: 20% !important;
            }
        }
        </style>
        <?php $__currentLoopData = $reportData['timeline']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


        <?php if($data=='tender'): ?>
        <?php if(!empty($reportData['tender'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1 class="text-center">Tender ID : <?php echo e($reportData['tender']['tender_no'] ?? '--'); ?></h1>
                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/Tenders')); ?>" class="btn btn-success"
                        style="float:right">Back</a>

                </th>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success cls-success text-light">
                    Tender Published
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['tender_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <th width="20%" class="wid">Tender NIT</th>
                <td width="30%"><?php echo e($reportData['tender']['nit_no'] ?? '-'); ?></td>
                <th width="20%">Scheme Type</th>
                <td width="30%"><?php echo e($reportData['tender']['scheme_type'] ?? '-'); ?></td>

            </tr>
            <tr>
                <th>Title</th>
                <td><?php echo e($reportData['tender']['tender_title'] ?? '-'); ?></td>
                <th>Capacity(MW)</th>
                <td><?php echo e($reportData['tender']['capacity'] ?? '-'); ?> MW</td>
            </tr>
            <tr>
                <th>NIT Date</th>
                <td><?php echo e(date('d M Y', strtotime($reportData['tender']['nit_date'])) ?? ''); ?></td>
                <th>RFS Date</th>
                <td><?php echo e(date('d M Y', strtotime($reportData['tender']['rfs_date'])) ?? ''); ?></td>
            </tr>
            <tr>
                <th>Pre Bid Meeting Date</th>
                <td><?php echo e(date('d M Y', strtotime($reportData['tender']['pre_bid_meeting_date'])) ?? ''); ?></td>
                <th>Bid Submission Date</th>
                <td><?php echo e(date('d M Y', strtotime($reportData['tender']['bid_submission_date'])) ?? ''); ?></td>
            </tr>
            <tr>
                <th>Additional Information</th>
                <td><?php echo e($reportData['tender']['additional_information'] ?? '-'); ?></td>
                <th>Tender Status</th>
                <td>
                    <?php if($reportData['tender']['tender_status']==1): ?>
                    Tender
                    <?php elseif($reportData['tender']['tender_status']==2): ?>
                    Under Implimentation
                    <?php elseif($reportData['tender']['tender_status']==3): ?>
                    Commissioned
                    <?php else: ?>
                    Cancelled
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Bidding Agency</th>
                <td><?php echo e($reportData['tender']['agency_name'] ?? '--'); ?></td>
                <th>SPD Name</th>
                <td><?php echo e($reportData['tender']['sub_agency_name'] ?? 'NA'); ?></td>
            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php if($data=='bidder'): ?>
        <?php if(!empty($reportData['bidder'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-primary text-light">
                    Bidders Participated
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['bidder_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Sub District</th>
                            <th>Village</th>
                            <th>Latitude/Longitude</th>
                            <th>Capacity (MW)</th>
                            <th>DISCOM Name</th>
                        </tr>
                        <?php $__currentLoopData = $reportData['bidder']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder['bidder_name'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['project_title'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['state'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['district_id'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['sub_district_id'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['village_id'] ?? '--'); ?></td>
                            <td>Lat : <?php echo e($bidder['lat'] ?? '--'); ?> <br> Lng : <?php echo e($bidder['lng'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['ppa_psa_capacity'] ?? '--'); ?> </td>
                            <td><?php echo e($bidder['discom_name'] ?? '--'); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>


        <?php if($data=='ppa'): ?>
        <?php if(!empty($reportData['ppa'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-info text-dark">
                    PPA Details
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['ppa_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>Effective Date of PPA</th>
                            <th>Capacity (MW)</th>
                            <th>Per Unit cost of electricity as per said PPA</th>
                            <th>Duration of PPA(In Years) </th>
                        </tr>
                        <?php $__currentLoopData = $reportData['ppa']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder['bidder_name'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['project_title'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['state'] ?? '--'); ?></td>
                            <td><?php if($bidder['ppa_date']!=''): ?><?php echo e(date('d M Y', strtotime($bidder['ppa_date'])) ?? ''); ?>

                                <?php else: ?>
                                -- <?php endif; ?></td>
                            <td><?php echo e($bidder['ppa_capacity'] ?? '--'); ?> MW</td>
                            <td><?php echo e($bidder['ppa_electricity_per_unit_cost'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['duration_ppa'] ?? '--'); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php if($data=='psa'): ?>
        <?php if(!empty($reportData['psa'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-info text-dark">
                    PSA Details
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['psa_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>PSA Date</th>
                            <th>PSA Signed State</th>
                            <th>PSA Duration</th>
                            <th>Electricity Per Unit Cost</th>
                        </tr>
                        <?php $__currentLoopData = $reportData['psa']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder['bidder_name'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['project_title'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['state'] ?? '--'); ?></td>
                            <td><?php if($bidder['ppa_psa_date']!=''): ?><?php echo e(date('d M Y', strtotime($bidder['ppa_psa_date'])) ?? ''); ?>

                                <?php else: ?>
                                -- <?php endif; ?></td>
                            <td><?php echo e($bidder['signed_state'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['duration_psa'] ?? '--'); ?> Year's</td>
                            <td><?php echo e($bidder['electricity_per_unit_cost'] ?? '--'); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php if($data=='loa'): ?>
        <?php if(!empty($reportData['loa'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading text-dark" style="background-color:#0ecfa2 !important">
                    LOI/LOA Details
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['loa_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-gray text-dark">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>State</th>
                            <th>LOI/LOA Date</th>
                        </tr>
                        <?php $__currentLoopData = $reportData['loa']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder['bidder_name'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['project_title'] ?? '--'); ?></td>
                            <td><?php echo e($bidder['state'] ?? '--'); ?></td>
                            <td><?php if($bidder['loi_loa_date']!=''): ?><?php echo e(date('d M Y', strtotime($bidder['loi_loa_date'])) ?? ''); ?>

                                <?php else: ?>
                                -- <?php endif; ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php if($data=='ra'): ?>
        <?php if(!empty($reportData['ra'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-warning text-light">
                    Reverse Auction Details
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['ra_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <th>RA Type</th>
                <td><?php echo e($reportData['ra']['ra_type'] ?? '-'); ?></td>
                <th>RA Capacity(MW)</th>
                <td><?php echo e($reportData['ra']['ra_capacity'] ?? '0'); ?> MW</td>
            </tr>
            <tr>
                <th>RA Date</th>
                <td><?php echo e(date('d M Y', strtotime($reportData['ra']['ra_date'])) ?? ''); ?></td>
                <th>Awarded Capacty(MW)</th>
                <td><?php echo e($reportData['ra']['capacity_awarded'] ?? '0'); ?> MW</td>

            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php if($data=='cancel'): ?>
        <?php if(!empty($reportData['cancel'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading bg-danger text-light">
                    Tender Cancellation Details
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['cancel_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <th>Tender Cancel Type</th>
                <td><?php echo e($reportData['cancel']['cancel_type'] ?? '-'); ?></td>
                <th>Cancelled Capacity(MW)</th>
                <td><?php echo e($reportData['cancel']['cancel_capacity'] ?? '0'); ?></td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td><?php echo e($reportData['cancel']['c_capacity'] ?? '0'); ?></td>
                <th>Date of Cancel</th>
                <td><?php echo e(date('d M Y', strtotime($reportData['cancel']['cancel_date'])) ?? '--'); ?></td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td colspan="3"><?php echo e($reportData['cancel']['cancel_remark'] ?? '--'); ?></td>
            </tr>


        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php if($data=='commissioned'): ?>
        <?php if(!empty($reportData['commissioned'])): ?>
        <table class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4" class="heading text-dark" style="background-color:#539b1c !important">
                    Commissioned Details Details
                    <span style="float:right">Submitted On
                        :<?php echo e(date('d M Y', strtotime($reportData['commissioned_submitted_on'])) ?? ''); ?>

                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered" id="ppaTbale">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th colspan="9">
                                    <h4>Tender Commissioning Details</h4>
                                </th>
                            </tr>
                        </thead>
                        <tr class="text-center">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Name</th>
                            <th>State</th>
                            <th>Scheduled commissioning Date (as per PPA)</th>
                            <th>Scheduled commissioning Date (Revised/ extended)</th>
                            <th>Commissioned Capacity (MW)</th>
                            <th>Actual Commissioning Date</th>
                            <th>Actual commissioned Capacity (MW)</th>
                        </tr>

                        <tbody class="text-center">
                            <?php $j=0; $class=""; ?>
                            <?php $__currentLoopData = $reportData['commissioned']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i=0;$j++;
                            if($j%2==1){$class="bg-success1 text-light1";}
                            ?>
                            <?php $__currentLoopData = $rdata['commissionedData']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <?php if($i==1): ?>
                            <tr class="<?php echo e($class); ?>">
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>"><?php echo e($j); ?></td>
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>"><?php echo e($rdata['bidder_name']); ?></td>
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>"><?php echo e($rdata['project_title']); ?></td>
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>"><?php echo e($rdata['state']); ?></td>
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>">
                                    <?php echo e($general->dateFormat($rdata['schedule_commissiong_date'])); ?>

                                </td>
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>">
                                    <?php echo e($general->dateFormat($rdata['revised_schedule_commissiong_date'])); ?></td>
                                <td rowspan="<?php echo e(count($rdata['commissionedData'])); ?>"><?php echo e($rdata['commissioned_capacity']); ?>

                                </td>
                                <td><?php echo e($general->dateFormat($data['actual_commissiong_date'])); ?></td>
                                <td><?php echo e($data['actual_commissioned_capacity']); ?></td>
                            </tr>
                            <?php else: ?>
                            <tr class="<?php echo e($class); ?>">
                                <td><?php echo e($general->dateFormat($data['actual_commissiong_date'])); ?></td>
                                <td><?php echo e($data['actual_commissioned_capacity']); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>

                </td>
            </tr>
        </table>
        <?php endif; ?>
        <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <input type="button" value="Print" class="btn btn-primary text-center" id="print" onclick="PrintDiv();" />
    </main>

</section>

<script type="text/javascript">
function PrintDiv() {
    var divToPrint = document.getElementById('main');
    var popupWin = window.open('Report', '', 'width=1200,height=900');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/reportView.blade.php ENDPATH**/ ?>