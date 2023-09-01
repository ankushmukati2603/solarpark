<?php $general = app('App\Http\Controllers\Backend\SNA\TenderController'); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Progress Report'); ?>
<?php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/';
?>
<section class="section dashboard">

    <main id="main" class="main">

        <style>
        .heading {
            text-align: left;
            font-size: 25px;
            background-color: lightblue;
        }
        </style>
        <table border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-striped text-left">
            <tr>
                <th colspan="4">
                    <h1 class="text-center">Tender ID : <?php echo e($tender->tender_no ?? '--'); ?></h1>
                    <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/Tenders')); ?>" class="btn btn-success"
                        style="float:right">Back</a>
                </th>
            </tr>

            <tr>
                <th colspan="4" class="heading1 bg-primary text-light">
                    Tender Details
                </th>
            </tr>
            <tr>
                <th width="20%">Tender NIT</th>
                <td width="30%"><?php echo e($tender->nit_no ?? '-'); ?></td>
                <th width="20%">Scheme Type</th>
                <td width="30%"><?php echo e($tender->scheme_type ?? '-'); ?></td>

            </tr>
            <tr>
                <th>Title</th>
                <td><?php echo e($tender->tender_title ?? '-'); ?></td>
                <th>Capacity(MW)</th>
                <td><?php echo e($tender->tenderCapcity ?? '-'); ?></td>
            </tr>
            <tr>
                <th>NIT Date</th>
                <td><?php echo e(date('d M Y', strtotime($tender->nit_date)) ?? ''); ?></td>
                <th>RFS Date</th>
                <td><?php echo e(date('d M Y', strtotime($tender->rfs_date)) ?? ''); ?></td>
            </tr>
            <tr>
                <th>Pre Bid Meeting Date</th>
                <td><?php echo e(date('d M Y', strtotime($tender->pre_bid_meeting_date)) ?? ''); ?></td>
                <th>Bid Submission Date</th>
                <td><?php echo e(date('d M Y', strtotime($tender->bid_submission_date)) ?? ''); ?></td>
            </tr>
            <tr>
                <th>Additional Information</th>
                <td><?php echo e($tender->additional_information ?? '-'); ?></td>
                <th>Tender Status</th>
                <td>
                    <?php if($tender->tender_status ==1): ?>
                    Tender
                    <?php elseif($tender->tender_status ==2): ?>
                    Under Implementation
                    <?php elseif($tender->tender_status==3): ?>
                    Implemented
                    <?php elseif($tender->tender_status==4): ?>
                    Commissioned
                    <?php elseif($tender->tender_status==5): ?>
                    Cancelled
                    <?php else: ?>

                    <?php endif; ?>
                </td>
            </tr>
            <?php if(!empty($tender->c_capacity)): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Cancellation Details
                </th>
            </tr>
            <tr>
                <th>Tender Cancel Type</th>
                <td><?php echo e($tender->cancel_type ?? '-'); ?></td>
                <th>Cancelled Capacity(MW)</th>
                <td><?php echo e($tender->cancel_capacity ?? '0'); ?></td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td><?php echo e($tender->c_capacity ?? '0'); ?></td>
                <th>Date of Cancel</th>
                <td><?php echo e(date('d M Y', strtotime($tender->cancel_date)) ?? ''); ?></td>
            </tr>
            <tr>
                <th>Remaining Capacty(MW)</th>
                <td colspan="3"><?php echo e($tender->cancel_remark ?? 'NA'); ?></td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($tender->ra_capacity)): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Reverse Auction Details
                </th>
            </tr>
            <tr>
                <th>RA Type</th>
                <td><?php echo e($tender->ra_type ?? '-'); ?></td>
                <th>RA Capacity(MW)</th>
                <td><?php echo e($tender->ra_capacity ?? '0'); ?></td>
            </tr>
            <tr>
                <th>RA Date</th>
                <td><?php echo e(date('d M Y', strtotime($tender->ra_date)) ?? ''); ?></td>
                <th>Awarded Capacty(MW)</th>
                <td><?php echo e($tender->capacity_awarded ?? '0'); ?></td>

            </tr>
            <?php endif; ?>
            <?php if(!empty($selectedBidderData)): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Bidder Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered">
                        <tr class="bg-success text-light">
                            <th width="5%">S.No</th>
                            <th>Bidder Name</th>
                            <th>Agency Name</th>
                            <th>Capacity</th>

                        </tr>
                        <?php $__currentLoopData = $selectedBidderData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder->bidder_name ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->agency_name ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->capacity ?? 'NA'); ?> MW</td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>

            <?php endif; ?>
            <?php if(!empty($bidderProjectLocationData)): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Bidder Projects Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered  text-center">
                        <tr class="bg-success text-light text-center">
                            <th rowspan="2">S.No</th>
                            <th rowspan="2">Bidder Name</th>
                            <th rowspan="2">Project Title</th>
                            <th rowspan="2">State</th>


                            <th colspan="6">Signing of PSA</th>
                            <th colspan="4">Signing of PPA</th>


                            <th rowspan="2">LOI/LOA Date</th>
                        </tr>
                        <tr class="bg-success text-light text-center">
                            <th>Date of PSA</th>
                            <th>PSA Capacity (MW)</th>
                            <th>Name of State in PSA Signed</th>
                            <th>Name of DISCOM who have signed PSA</th>
                            <th>Per Unit cost of electricity as per said PSA</th>
                            <th>Duration of PSA(In Years)</th>

                            <th>Effective Date of PPA</th>
                            <th>Capacity (MW) </th>
                            <th>Per Unit cost of electricity as per said PPA</th>
                            <th>Duration of PPA(In Years)</th>
                        </tr>
                        <?php $__currentLoopData = $bidderProjectLocationData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder->bidder_name ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->project_title ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->state ?? 'NA'); ?></td>


                            <td><?php echo e($bidder->ppa_psa_date ? date('d M Y', strtotime($bidder->ppa_psa_date)) : 'NA'); ?></td>
                            <td><?php echo e($bidder->ppa_psa_capacity ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->signed_state ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->discom_name ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->electricity_per_unit_cost ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->duration_ppa ?? 'NA'); ?></td>

                            <td><?php echo e($bidder->ppa_date ? date('d M Y', strtotime($bidder->ppa_date)) : 'NA'); ?></td>
                            <td><?php echo e($bidder->ppa_capacity ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->ppa_electricity_per_unit_cost ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->duration_ppa ?? 'NA'); ?></td>

                            <td><?php echo e($bidder->loi_loa_date ? date('d M Y', strtotime($bidder->loi_loa_date)) : 'NA'); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
            <?php endif; ?>


            <!-- Projects Commissioning Details -->
            <?php if(!empty($commissioningData) && $tender->tender_status > 2): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Projects Commissioning Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered" id="ppaTbale">

                        <tr class="text-center bg-success text-light">
                            <th>Bidder Name</th>
                            <th>Project Name</th>
                            <th>State</th>
                            <th>Scheduled Commissioning Date (as per PPA)</th>
                            <th>Scheduled Commissioning Date (Revised/ extended)</th>
                            <th>Commissioned Capacity (MW)</th>
                            <th>Actual Commissioning Date</th>
                            <th>Actual Commissioned Capacity (MW)</th>
                        </tr>

                        <tbody class="text-center">
                            <?php $j=0; $class=""; ?>
                            <?php $__currentLoopData = $commissioningData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i=0;$j++;
                            if($j%2==1){$class="bg-success1 text-light1";}
                            ?>
                            <?php $__currentLoopData = $rdata['commissionedData']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <?php if($i==1): ?>
                            <tr class="<?php echo e($class); ?>">
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
            <?php endif; ?>


            <!-- Projects Implementation Details -->
            <?php if(!empty($bidderProjectLocationData) && $tender->tender_status > 3): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Projects Implementation Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered  text-center">
                        <tr class="bg-success text-light text-center">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>Capacity (MW)</th>
                            <th>Status of Stage 2 Connectivity</th>
                            <th>Status of LTA & Target Region</th>
                            <th>LTOA Operationalization Date</th>
                            <th>Status of Transmisison line from <br>
                                project site to Sub stattion (By Developer)</th>
                            <th>Interconnection Point/S/S <br> voltage level</th>
                        </tr>

                        <?php $__currentLoopData = $bidderProjectLocationData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder->bidder_name ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->project_title ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->commissioned_capacity ?? 'NA'); ?></td>

                            <td><?php echo e($bidder->status_stage_two ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->status_lta ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->ltoa_date ? date('d M Y', strtotime($bidder->ltoa_date)) : 'NA'); ?></td>
                            <td><?php echo e($bidder->status_transmisison_line ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->interconnection_vol_level ?? '--'); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
            <?php endif; ?>

            <!-- Projects Commissioned Details -->
            <?php if(!empty($bidderProjectLocationData) && $tender->tender_status ==4): ?>
            <tr>
                <th colspan="4" class="heading1  bg-primary text-light">
                    Projects Commissioned Details
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered  text-center">
                        <tr class="bg-success text-light text-center">
                            <th>S.No</th>
                            <th>Bidder Name</th>
                            <th>Project Title</th>
                            <th>Capacity (MW)</th>
                            <th>Project Type</th>
                            <th>Type of Module</th>
                            <th>Module Make</th>
                            <th>Substation Name</th>
                            <th>Substation Voltage Level (KV)</th>
                            <th>Feeder Name</th>
                            <th>Feeder Voltage (KV)</th>
                            <th>Projects in Solar Park</th>
                            <th>Commissioned AC Capacity</th>
                            <th>Commissioned DC Capacity</th>
                        </tr>

                        <?php $__currentLoopData = $bidderProjectLocationData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $commissionedData = json_decode($bidder->commissioned_details, true);
                        $solarprojectname="NA";
                        if(($commissionedData['have_solar_project'] ?? '')=='Yes'){
                        $solarprojectname=$commissionedData['solar_park_name'];
                        }
                        ?>

                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bidder->bidder_name ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->project_title ?? 'NA'); ?></td>
                            <td><?php echo e($bidder->commissioned_capacity ?? 'NA'); ?></td>

                            <td><?php echo e($commissionedData['project_type'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['module_type'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['module_make'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['substation_name'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['substation_voltage'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['feeder_name'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['feeder_voltage'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['have_solar_project'] ?? 'NA'); ?><br> Project Name :
                                <?php echo e($solarprojectname); ?>

                            </td>
                            <td><?php echo e($commissionedData['ac_voltage'] ?? 'NA'); ?></td>
                            <td><?php echo e($commissionedData['dc_voltage'] ?? 'NA'); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
            <?php endif; ?>



        </table>
    </main>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/previewTender.blade.php ENDPATH**/ ?>