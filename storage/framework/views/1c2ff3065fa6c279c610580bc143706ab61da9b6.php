<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('internal_infrastructure','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">LAND</h5>
    <!-- <div class="col-sm-12">
        <h6> DPR Status <span class="text-danger">*</span></h6>
        <br>
        <div class="form-check-inline col-md-2">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="dpr_status" value="A"
                    <?php if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='A' ): ?> checked <?php endif; ?> checked>
                DPR
                Under Preparation
            </label>
        </div>
        <div class="form-check-inline col-md-2">
            <label class="form-check-label">

                <input type="radio" class="form-check-input" name="dpr_status" value="B"
                    <?php if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='B' ): ?> checked <?php endif; ?>> DPR
                Submitted
            </label>
        </div>
        <div class="form-check-inline col-md-2">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="dpr_status" value="C"
                    <?php if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='C' ): ?> checked <?php endif; ?>> DPR Under
                Revision
            </label>
        </div>
        <div class="form-check-inline col-md-2">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="dpr_status" value="D"
                    <?php if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='D' ): ?> checked <?php endif; ?>> DPR
                Approved
            </label>
        </div>
    </div> -->

    <div class="clearfix"><br></div>
    <h6> Land Status<span class="text-danger">*</span></h6>
    <div class="col-md-12 form-inline row">
        <div class="col-md-4 col-sm-12">
            <!-- <h6> Land Identify (In Acres) <span class="text-danger">*</span></h6> <br> -->
            <label for="">Land Identified (In Acres)</label><br>
            <input type="text" name="land_status_identified" id="txtContact" placeholder="Land Identified (In Acres)"
                class="form-control"
                value="<?php echo e($generalData['internal_infrastructure']['land_status_identified'] ?? ''); ?>">
            <span class="text-danger"><?php echo e($errors->first('land_status_identified')); ?></span>
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="">Land Acquired (In Acres)</label><br>

            <input type="text" name="land_status_aquired" id="txtContact" placeholder="Land Acquired (In Acres)"
                class="form-control" value="<?php echo e($generalData['internal_infrastructure']['land_status_aquired'] ?? ''); ?>">
            <span class="text-danger"><?php echo e($errors->first('land_status_aquired')); ?></span>
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-sm-12">
        <h6>Land Type <span class="text-danger">*</span></h6>
    </div>
    <br>
    <div class="col-md-4 form-check-inline">
        <div class="col-md-12 pb-4"><label for="">Government Land Identified</label>
            <input type="text" class="form-control" placeholder="Government Land Identified" name="govt_land_identified"
                value="<?php echo e($generalData['internal_infrastructure']['govt_land_identified'] ?? ''); ?>">
        </div>
        <div class="col-md-12 pb-4"><label for="">Government Land Acquired</label>
            <input type="text" class="form-control" placeholder="Government Land Acquired" name="govt_land_acquired"
                value="<?php echo e($generalData['internal_infrastructure']['govt_land_acquired'] ?? ''); ?>">
        </div>
    </div>
    <div class="col-md-4 form-check-inline">
        <div class="col-md-12 pb-4"><label for="">Private Land Acquired</label>
            <input type="text" class="form-control" name="private_land_acquired" placeholder="Private Land Acquired"
                value="<?php echo e($generalData['internal_infrastructure']['private_land_acquired'] ?? ''); ?>">
        </div>
        <div class="col-md-12 pb-4"><label for="">Private Land Identified</label>
            <input type="text" class="form-control" name="private_land_identified" placeholder="Private Land Identified"
                value="<?php echo e($generalData['internal_infrastructure']['private_land_identified'] ?? ''); ?>">
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Any Others<span class="text-danger">*</span></label>

        <input type="text" name="others" id="txtContact" class="form-control  number"
            value="<?php echo e($generalData['internal_infrastructure']['others'] ?? ''); ?>">
        <span class="text-danger"><?php echo e($errors->first('others')); ?></span>
    </div>
    <div class="clearfix"></div><br>

</div>
<h5 class="pb-3">Road Infrastructure Details</h5>
<br>
<div class="col-sm-12">
    <label for="name" class="pb-2"> Approach road to the park Status of Road
        <span class="text-danger">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="road_status" value="A"
                <?php if(($generalData['internal_infrastructure']['road_status'] ?? '' )=='A' ): ?> checked <?php endif; ?> checked>
            Already available
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="road_status" value="B"
                <?php if(($generalData['internal_infrastructure']['road_status'] ?? '' )=='B' ): ?> checked <?php endif; ?>>New road to be
            developed
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="road_status" value="C"
                <?php if(($generalData['internal_infrastructure']['road_status'] ?? '' )=='C' ): ?> checked <?php endif; ?>>Only
            rework/modification of
            road
        </label>
    </div>
    <span class="text-danger"><br><?php echo e($errors->first('road_status')); ?></span>
</div>
<div class="clearfix"></div><br>
<div class="row col-md-12">
    <div class="col-md-6 pb-4">
        <label>Length of approach road up to the park boundary (in km) <span class="text-danger">*</span></label>
        <input type="number" min="0" step="any" name="park_boundary" id="txtContact" class="form-control  number"
            value="<?php echo e(($generalData['internal_infrastructure']['park_boundary'] ?? '' )); ?>">
        <span class="text-danger"><?php echo e($errors->first('park_boundary')); ?></span>
    </div>

    <div class="col-md-6 pb-4">
        <label>Length of access road to each plot inside the park (in km)<span class="text-danger">*</span></label>
        <input type="number" min="0" step="any" name="road_distance" id="txtContact" class="form-control  number"
            value="<?php echo e(($generalData['internal_infrastructure']['road_distance'] ?? '' )); ?>">
        <span class="text-danger"><?php echo e($errors->first('road_distance')); ?></span>
    </div>
</div>
<div class="row col-md-12">
    <div class="col-md-6">
        <label>Status of tender and schedule for completion of road work<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea type="text" name="work_status" id="" class="form-control" cols="10" rows="3"
            value="<?php echo e(($generalData['internal_infrastructure']['work_status'] ?? '' )); ?>"><?php echo e(($generalData['internal_infrastructure']['work_status'] ?? '' )); ?></textarea>
        <span class="text-danger"><?php echo e($errors->first('work_status')); ?></span>
    </div>

</div><br>
<h5 class="pb-3">Water Facilities</h5>
<br>
<div class="col-md-12 form-inline row">
    <div class="col-md-6 col-sm-12">
        <label>Source of water for park<span class="text-danger">*</span></label>
        <input type="text" name="source_water" id="txtName" class="form-control"
            value="<?php echo e(($generalData['internal_infrastructure']['source_water'] ?? '')); ?>">
    </div>
    <!-- <div class="clearfix"><br></div> -->
    <div class="col-md-6 col-sm-12">
        <label>Details of water requirements<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="required_water" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['internal_infrastructure']['required_water'] ?? '')); ?></textarea>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-6 col-sm-12">
        <label>Proposed system and progress made so far<span class="text-danger">*</span> <span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="proposed_system" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['internal_infrastructure']['proposed_system'] ?? '')); ?></textarea>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>
            Status of tender and schedule for completion of Water Facilities<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="status" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['internal_infrastructure']['status'] ?? '')); ?></textarea>
    </div>

</div><br>
<h5 class="pb-3">Drainage System</h5>
<br>
<div class="col-md-12 form-inline row">
    <div class="col-md-6 col-sm-12">
        <label>Details of proposed drainage system (including length in km)<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label><br><br>
        <textarea name="drainage_system_details" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['internal_infrastructure']['drainage_system_details'] ?? '')); ?></textarea>

    </div>
    <div class="col-md-6 col-sm-12">
        <label>Status of tender & schedule for completion of the drainage system & progress made so far
            (including length in km)<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="tender_status" id="" cols="10" class="form-control"
            rows="3"><?php echo e(($generalData['internal_infrastructure']['tender_status'] ?? '')); ?></textarea>

    </div>
    <div><br>

        <h5 class="pb-3">Fencing/Boundary</h5>
        <br>
        <div class="col-md-12 form-inline row">
            <div class="col-md-6 col-sm-12">
                <label>Details of of fencing/boundary (including length)<span class="text-danger">*</span><span
                        class="text-primary"><small>(upto
                            1000 Characters)</small></span></label>
                <textarea name="fencing_details" id="" cols="10" rows="3" class="form-control"
                    value="<?php echo e($generalData['internal_infrastructure']['fencing_details'] ?? ''); ?>"><?php echo e($generalData['internal_infrastructure']['fencing_details'] ?? ''); ?></textarea>

            </div>
            <div class="col-md-6 col-sm-12">
                <label>Status of tender and schedule for completion for fencing/boundary<span
                        class="text-danger">*</span><span class="text-primary"><small>(upto
                            255 Characters)</small></span></label>
                <textarea name="fencing_status" id="" cols="10" rows="3" class="form-control"
                    value="<?php echo e($generalData['internal_infrastructure']['fencing_status'] ?? ''); ?>"><?php echo e($generalData['internal_infrastructure']['fencing_status'] ?? ''); ?></textarea>
                <label for="" class="text-primary">Note: Please mention length, proposed system and progress made so
                    far</label><br>
            </div>
        </div><br>

        <h5 class="pb-3">Telecommunication Facilities</h5>
        <br>
        <div class="col-md-12 form-inline row">
            <div class="col-md-6 col-sm-12">
                <!-- <div class="col-md-6 pb-4"> -->
                <label>Details of telecommunication facilities<span class="text-danger">*</span><span
                        class="text-primary"><small>(upto
                            1000 Characters)</small></span></label><br>
                <textarea name="tele_facility_details" id="" cols="10" class="form-control"
                    rows="3"><?php echo e($generalData['internal_infrastructure']['tele_facility_details'] ?? ''); ?></textarea>
                <span class="text-danger"><?php echo e($errors->first('tele_facility_details')); ?></span>
            </div>
            <div class="col-md-6 col-sm-12">
                <label>Status of tender and schedule for completion and progress made so far<span
                        class="text-danger">*</span><span class="text-primary"><small>(upto
                            255 Characters)</small></span></label>
                <textarea name="tender_progress_status" id="" cols="10" class="form-control"
                    rows="3"><?php echo e($generalData['internal_infrastructure']['tender_progress_status'] ?? ''); ?></textarea>
                <span class="text-danger"><?php echo e($errors->first('tender_progress_status')); ?></span>
            </div>
        </div>
        <div class="col-sm-12">
            <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                        500 Characters)</small></span></label>
            <textarea name="telecomunication_remark" id="" cols="10" class="form-control"
                rows="3"><?php echo e($generalData['internal_infrastructure']['telecomunication_remark'] ?? ''); ?></textarea>
            <span class="text-danger"><?php echo e($errors->first('telecomunication_remark')); ?></span>
        </div>
    </div>
</div><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/internal_infrastructure.blade.php ENDPATH**/ ?>