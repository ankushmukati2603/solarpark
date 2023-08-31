<table class="table table-bordered" id="stakeHoldersTable1" border="1">
    <tr>
        <td colspan=48 align="center" style="backgroung-color:#000; border:2px"><b> Master Sheet for all Grid Connected
                Solar Capacity (Tendering to
                Commissioning) details of Solar Projects till 30-04-2023</b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b>Name of State/Agency</b></td>
        <td colspan=32 align="center"><b><?php echo e($userdata->agency_name); ?></b></td>
        <td colspan=13 rowspan=5 align="center"><b>
                <font size=4>For any assistance pls contact<br>Ministry of New &amp; Renewable Energy
                    <br>National Solar Mission (NSM) Division, Block-14, CGO Complex, New Delhi<br>Email:
                    nsm.mnre@gmail.com | Tele/Fax: 011 24360764 | Ext. 1901/1923, 9929205059
            </b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b> Contact Person</b></td>
        <td colspan=32 align="center"><b><?php echo e($userdata->contact_person); ?> <br></b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b> Office Address</b></td>
        <td colspan=32 align="center"><b><?php echo e($userdata->office_addess); ?></b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b>Email </b></td>
        <td colspan=32 align="center"><b><?php echo e($userdata->email); ?></b></td>
    </tr>
    <tr>
        <td colspan=35 align="center" bgcolor="#92D050"><b> <br> </b></td>
    </tr>
    <tr>
        <td rowspan=3 height="159" align="center"><b> S. No. </b></td>
        <td colspan=8 align="center" bgcolor="#D9D9D9"><b> Information </b></td>
        <td colspan=5 align="center" bgcolor="#C6D9F1"><b> Details of Tender/NIT/RFS <br>Issued/Published</b></td>
        <td colspan=2 align="center" bgcolor="#558ED5"><b> Reverse Auction <br>(if applicable) </b></td>
        <td colspan=3 align="center" bgcolor="#E6B9B8"><b> Tender Cancelled, if any </b></td>
        <td colspan=3 align="center" bgcolor="#D7E4BD"><b> Details of Selected Bidders </b></td>
        <td colspan=3 align="center" bgcolor="#77933C"><b> Details of Tariffs Discovered<br>(Rs/kWh) </b>
        </td>
        <td colspan=6 align="center" bgcolor="#B3A2C7"><b> Signing of PSA </b></td>
        <td colspan=4 align="center" bgcolor="#B3A2C7"><b> Signing of PPA </b></td>
        <td colspan=5 align="center"><b> Commissioning Detail</b></td>
        <td colspan=7 align="center"><b> Commissioned Detail</b></td>
        <td rowspan=3 align="center"><b> Remark, if any </b></td>
    </tr>
    <tr>
        <td rowspan=2 align="center"><b> Name of the State </b></td>
        <td rowspan=2 align="center"><b> Name of Scheme (Central/State Scheme) </b></td>
        <td rowspan=2 align="center"><b> Bidding Agency </b></td>
        <td colspan=5 align="center"><b> Project Location </b></td>
        <td rowspan=2 align="center"><b> Tendered Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Date of NIT </b></td>
        <td rowspan=2 align="center"><b> Date of RFS </b></td>
        <td rowspan=2 align="center"><b> Date of Pre Bid Meeting, (if any) </b></td>
        <td rowspan=2 align="center"><b> Last Date <br>of Bids Submission </b></td>
        <td rowspan=2 align="center"><b> Date of RA/e-RA </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Date </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Remarks </b></td>
        <td rowspan=2 align="center"><b> Name of Company </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Date of LoI/LoA </b></td>
        <td rowspan=2 align="center"><b> Highest Tariff </b></td>
        <td rowspan=2 align="center"><b> Lowest Tariff </b></td>
        <td rowspan=2 align="center"><b> Weighted Average </b></td>

        <td rowspan=2 align="center"><b> Date of PSA </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Name of State in PSA Signed </b></td>
        <td rowspan=2 align="center"><b> Name of Discoms who have signed PSA </b></td>
        <td rowspan=2 align="center"><b> per unit cost of electricity as per the said PSA </b></td>
        <td rowspan=2 align="center"><b> Duration of PSA</b></td>

        <td rowspan=2 align="center"><b> Name of State in PPA Signed </b></td>
        <td rowspan=2 align="center"><b> Name of Discoms who have signed PPA </b></td>
        <td rowspan=2 align="center"><b> Per unit cost of electricity as per the said PPA </b></td>
        <td rowspan=2 align="center"><b> Duration of PPA </b></td>



        <td rowspan=2 align="center"><b> Scheduled <br>Date of Commissioning as per PPA </b></td>
        <td rowspan=2 align="center"><b> Extended/Actual Date of Commissioning </b></td>
        <td rowspan=2 align="center"><b> Commissioned Capacity(MW) </b></td>
        <td rowspan=2 align="center"><b> Actual Commissioning Date </b></td>
        <td rowspan=2 align="center"><b> Actual commissioned Capacity(MW) </b></td>


        <td rowspan=2><b>Project Type</b></td>
        <td rowspan=2><b>Type of Module</b></td>
        <td rowspan=2><b>Module Make</b></td>
        <td rowspan=2><b>Substation Name</b></td>
        <td rowspan=2><b>Substation Voltage Level (KV)</b></td>
        <td rowspan=2><b>Feeder Name</b></td>
        <td rowspan=2><b>Feeder Voltage (KV)</b></td>
    </tr>
    <tr>
        <td align="center"><b> Village </b></td>
        <td align="center"><b> Tehsil/Taluka </b></td>
        <td align="center"><b> Dist. </b></td>
        <td align="center"><b> Longitude </b></td>
        <td align="center"><b> Latitude </b></td>
    </tr>


    <?php $__currentLoopData = $tenderArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


    <tr>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($loop->iteration); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['state'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['scheme_type'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['agency_name'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($tdata['village_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($tdata['sub_district_id'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['district_id'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['lat'] ?? '--'); ?> E </td>
        <td align="center" valign=middle><?php echo e($tdata['lng'] ?? '--'); ?> N</td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['capacity'] ?? '--'); ?> </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['nit_date'] ?? '--'); ?> </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['rfs_date'] ?? '--'); ?> </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['pre_bid_meeting_date'] ?? '--'); ?>

        </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['bid_submission_date'] ?? '--'); ?>

        </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['ra_date'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['ra_capacity'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['cancel_date'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle><?php echo e($tdata['c_capacity'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle>Cancel Remark</td>
        <td align="center" rowspan="<?php echo e($tdata['project_count']); ?>" valign=middle><?php echo e($tdata['bidder_name'] ?? '--'); ?></td>
        <td align="center" rowspan="<?php echo e($tdata['project_count']); ?>" valign=middle><?php echo e($tdata['bidder_capacity'] ?? '--'); ?>

        </td>
        <td align="center" rowspan="<?php echo e($tdata['project_count']); ?>" valign=middle><?php echo e($tdata['loa_date'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle> <?php echo e($tdata['costMaxPPA'] ?? '--'); ?> </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle> <?php echo e($tdata['costMinPPA'] ?? '--'); ?> </td>
        <td rowspan="<?php echo e($tdata['projectCount']); ?>" align="center" valign=middle> <?php echo e($tdata['avgCostPPA'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($tdata['ppa_psa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($tdata['ppa_psa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['state'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['discom_name'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['duration_ppa'] ?? '--'); ?> </td>

        <td align="center" valign=middle><?php echo e($tdata['ppa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($tdata['ppa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['ppa_electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['duration_ppa'] ?? '--'); ?> </td>







        <td align="center" valign=middle><?php echo e($tdata['schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['revised_schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($tdata['commissioned_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle>
            <?php $__currentLoopData = $tdata['actual_commissiong_date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($acDate->actual_commissiong_date); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td align="center" valign=middle>
            <?php $__currentLoopData = $tdata['actual_commissioned_capacity']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span
                style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($comDate->actual_commissioned_capacity); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </td>

        <td><?php echo e($tdata['commissioned_details']['project_type'] ?? '--'); ?></td>
        <td><?php echo e($tdata['commissioned_details']['module_type'] ?? '--'); ?></td>
        <td><?php echo e($tdata['commissioned_details']['module_make'] ?? '--'); ?></td>
        <td><?php echo e($tdata['commissioned_details']['substation_name'] ?? '--'); ?></td>
        <td><?php echo e($tdata['commissioned_details']['substation_voltage'] ?? '--'); ?></td>
        <td><?php echo e($tdata['commissioned_details']['feeder_name'] ?? '--'); ?></td>
        <td><?php echo e($tdata['commissioned_details']['feeder_voltage'] ?? '--'); ?></td>

        <td align="center" valign=middle> <br> </td>
    </tr>


    <?php if($tdata['project_count']>0): ?>
    <?php $x=0;?>
    <?php $__currentLoopData = $tdata['project_count_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($x>0): ?>
    <tr>
        <td align="center" valign=middle><?php echo e($pdata['village_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($pdata['sub_district_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($pdata['district_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($pdata['lat'] ?? '--'); ?> E</td>
        <td align="center" valign=middle><?php echo e($pdata['lng'] ?? '--'); ?> N</td>

        <td align="center" valign=middle><?php echo e($pdata['ppa_psa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($pdata['ppa_psa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['state'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['discom_name'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['duration_ppa'] ?? '--'); ?> </td>

        <td align="center" valign=middle><?php echo e($pdata['ppa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($pdata['ppa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['ppa_electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['duration_ppa'] ?? '--'); ?> </td>

        <td align="center" valign=middle><?php echo e($pdata['schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['revised_schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($pdata['commissioned_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle>
            <?php
                $comissioningData = \App\Models\Commissioning::select('actual_commissiong_date')->where('project_id',$pdata['id'])->get();
                
            ?>
            <?php $__currentLoopData = $comissioningData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($comData->actual_commissiong_date); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </td>
        <td align="center" valign=middle>
            <?php
                $comissioningCapacity = \App\Models\Commissioning::select('actual_commissioned_capacity')->where('project_id',$pdata['id'])->get();
                $comissionedDataRecord =\App\Models\SelectedBidderProject::select('commissioned_details')->where('id',$pdata['id'])->first();
                $comissionedDataRecord =json_decode($comissionedDataRecord->commissioned_details,true);
            ?>
            <?php $__currentLoopData = $comissioningCapacity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comCapacity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span
                style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($comCapacity->actual_commissioned_capacity); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td><?php echo e($comissionedDataRecord['project_type'] ?? '--'); ?> sdjkghsd</td>
        <td><?php echo e($comissionedDataRecord['module_type'] ?? '--'); ?></td>
        <td><?php echo e($comissionedDataRecord['module_make'] ?? '--'); ?></td>
        <td><?php echo e($comissionedDataRecord['substation_name'] ?? '--'); ?></td>
        <td><?php echo e($comissionedDataRecord['substation_voltage'] ?? '--'); ?></td>
        <td><?php echo e($comissionedDataRecord['feeder_name'] ?? '--'); ?></td>
        <td><?php echo e($comissionedDataRecord['feeder_voltage'] ?? '--'); ?></td>
        <td align="center" valign=middle> <br> </td>
    </tr>
    <?php endif; ?>
    <?php $x++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


    <?php if(count($tdata['bidders'])>0): ?>
    <?php $i=0; ?>
    <?php $__currentLoopData = $tdata['bidders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bidData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($i>0): ?>
    <tr>
        <td align="center" valign=middle><?php echo e($bidData['village_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($bidData['sub_district_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($bidData['district_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($bidData['lat'] ?? '--'); ?> E</td>
        <td align="center" valign=middle><?php echo e($bidData['lng'] ?? '--'); ?> N</td>
        <!-- Total no of bidder projects -->
        <td rowspan="<?php echo e($bidData['bidderCount']); ?>" align="center" valign=middle><?php echo e($bidData['bidder_name'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($bidData['bidderCount']); ?>" align="center" valign=middle><?php echo e($bidData['capacity'] ?? '--'); ?></td>
        <td rowspan="<?php echo e($bidData['bidderCount']); ?>" align="center" valign=middle><?php echo e($bidData['loa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($bidData['ppa_psa_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['ppa_psa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['state'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['discom_name'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['duration_ppa'] ?? '--'); ?> </td>

        <td align="center" valign=middle><?php echo e($bidData['ppa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($bidData['ppa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['ppa_electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['duration_ppa'] ?? '--'); ?> </td>





        <td align="center" valign=middle><?php echo e($bidData['schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['revised_schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($bidData['commissioned_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle>
            <?php $__currentLoopData = $bidData['actual_commissiong_date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acDate1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($acDate1->actual_commissiong_date); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </td>
        <td align="center" valign=middle>

            <?php $__currentLoopData = $bidData['actual_commissioned_capacity']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comDate1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span
                style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($comDate1->actual_commissioned_capacity); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </td>
        <td><?php echo e($bidData['commissioned_details']['project_type'] ?? '--'); ?></td>
        <td><?php echo e($bidData['commissioned_details']['module_type'] ?? '--'); ?></td>
        <td><?php echo e($bidData['commissioned_details']['module_make'] ?? '--'); ?></td>
        <td><?php echo e($bidData['commissioned_details']['substation_name'] ?? '--'); ?></td>
        <td><?php echo e($bidData['commissioned_details']['substation_voltage'] ?? '--'); ?></td>
        <td><?php echo e($bidData['commissioned_details']['feeder_name'] ?? '--'); ?></td>
        <td><?php echo e($bidData['commissioned_details']['feeder_voltage'] ?? '--'); ?></td>


        <td align="center" valign=middle> <br> </td>
    </tr>




    <?php if(count($tdata['bidders'][$i]['projects'])>0): ?>

    <?php $j=0;?>
    <?php $__currentLoopData = $tdata['bidders'][$i]['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($j>0): ?>
    <tr>
        <td align="center" valign=middle><?php echo e($projectData['village_id'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['sub_district_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($projectData['district_id'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($projectData['lat'] ?? '--'); ?> E </td>
        <td align="center" valign=middle><?php echo e($projectData['lng'] ?? '--'); ?> N</td>

        <td align="center" valign=middle><?php echo e($projectData['ppa_psa_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['ppa_psa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['state'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($projectData['discom_name'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['duration_ppa'] ?? '--'); ?> </td>

        <td align="center" valign=middle><?php echo e($projectData['ppa_date'] ?? '--'); ?></td>
        <td align="center" valign=middle><?php echo e($projectData['ppa_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['ppa_electricity_per_unit_cost'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['duration_ppa'] ?? '--'); ?> </td>


        <td align="center" valign=middle><?php echo e($projectData['schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['revised_schedule_commissiong_date'] ?? '--'); ?> </td>
        <td align="center" valign=middle><?php echo e($projectData['commissioned_capacity'] ?? '--'); ?> </td>
        <td align="center" valign=middle>
            <?php $comissioningData = \App\Models\Commissioning::select('actual_commissiong_date')->where('project_id',$projectData['id'])->get(); ?>
            <?php $__currentLoopData = $comissioningData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($comData->actual_commissiong_date); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- Blank Column 2 -->
        </td>
        <td align="center" valign=middle>
            <?php
                $comissioningCapacity = \App\Models\Commissioning::select('actual_commissioned_capacity')->where('project_id',$projectData['id'])->get();
                $comissionedData =\App\Models\SelectedBidderProject::select('commissioned_details')->where('id',$projectData['id'])->first();
                $comissionedData =json_decode($comissionedData->commissioned_details,true);
                
            ?>
            <?php $__currentLoopData = $comissioningCapacity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comCapacity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span
                style="display: block;border-bottom: 1px dashed #ccc;"><?php echo e($comCapacity->actual_commissioned_capacity); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </td>
        <td><?php echo e($comissionedData['project_type'] ?? '--'); ?></td>
        <td><?php echo e($comissionedData['module_type'] ?? '--'); ?></td>
        <td><?php echo e($comissionedData['module_make'] ?? '--'); ?></td>
        <td><?php echo e($comissionedData['substation_name'] ?? '--'); ?></td>
        <td><?php echo e($comissionedData['substation_voltage'] ?? '--'); ?></td>
        <td><?php echo e($comissionedData['feeder_name'] ?? '--'); ?></td>
        <td><?php echo e($comissionedData['feeder_voltage'] ?? '--'); ?></td>
        <td align="center" valign=middle> <br> </td>
    </tr>
    <?php endif; ?>
    <?php $j++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>







    <?php endif; ?>
    <?php $i++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>








    <?php endif; ?>




    <!-- End of Main loop -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>







</table><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/state-implementing-agency/_excelReport.blade.php ENDPATH**/ ?>