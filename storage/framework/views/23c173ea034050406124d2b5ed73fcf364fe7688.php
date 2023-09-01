<?php $general = app('App\Http\Controllers\Backend\Mnre\MainController'); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Solar Park Received Reports'); ?>
<?php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
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
                    <h1>Application Detail</h1>
                    <!-- <a href="<?php echo e(URL::to(Auth::getDefaultDriver().'/my-progress-report')); ?>" class="btn btn-success"style="float:right">Back</a> -->
                </th>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    General
                </th>
            </tr>
            <tr>
                <th width="20%">Park Name</th>
                <td><?php echo e($previewData->park_name); ?></td>
                <th width="20%">State</th>
                <td><?php echo e($previewData->state ?? ''); ?></td>

            </tr>
            <tr>
                <th>District</th>
                <td><?php echo e($previewData->district ?? ''); ?></td>
                <th>Sub District</th>
                <td><?php echo e($previewData->sub_district ?? ''); ?></td>
            </tr>
            <tr>
                <th>Village</th>
                <td><?php echo e($previewData->village ?? ''); ?></td>
                <th>Latitude</th>
                <td><?php echo e($previewData['general']['latitude'] ?? ''); ?></td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td><?php echo e($previewData['general']['longitude'] ?? ''); ?></td>
                <th>Approved Capacity (in MW)</th>
                <td><?php echo e($previewData->capacity); ?></td>
            </tr>
            <tr>
                <th>Date of In-Principle Approval</th>
                <td><?php echo e($previewData['general']['date'] ?? ''); ?></td>
                <th>Solar Power Park Developer Name (SPPD)</th>
                <td><?php echo e($previewData['general']['park_developer_name'] ?? ''); ?></td>
            </tr>
            <tr>
                <th>Office Address</th>
                <td><?php echo e($previewData['general']['address'] ?? ''); ?></td>
                <th>Office Contact Number</th>
                <td><?php echo e($previewData['general']['office_contact_number'] ?? ''); ?></td>
            </tr>
            <tr>
                <th>Concerned Person Name</th>
                <td><?php echo e($previewData['general']['concerned_person_name'] ?? ''); ?></td>
                <th>Email ID</th>
                <td><?php echo e($previewData['general']['email'] ?? ''); ?></td>
            </tr>
            <tr>
                <th>Office/ Landline Number</th>
                <td><?php echo e($previewData['general']['telephone_number'] ?? ''); ?></td>
                <th>Mobile Number</th>
                <td><?php echo e($previewData['general']['mobile_number'] ?? ''); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Internal Infrastructure
                </th>
            </tr>
            <tr>
                <th>DPR Status</th>
                <td> <?php if($previewData['general']['dpr_status'] == 'A'): ?>
                    <span>DPR Under Preparation</span>
                    <?php elseif($previewData['general']['dpr_status'] == 'B'): ?>
                    <span>DPR Submitted</span>
                    <?php elseif($previewData['general']['dpr_status'] == 'C'): ?>
                    <span> DPR Under Revision</span>
                    <?php else: ?>
                    <span>DPR Approved</span>
                    <?php endif; ?>
                </td>
                <th>Land Status</th>
                <td>

                    <?php if($previewData['internal_infrastructure']['land_status_aquired'] != null &&
                    $previewData['internal_infrastructure']['land_status_identified']!= null ): ?>
                    <span>Land Identified And Land Acquired </span>
                    <?php elseif(($previewData['internal_infrastructure']['land_status_aquired'] ?? '' )==2): ?>
                    <span>Land Acquired </span>
                    <?php elseif(($previewData['internal_infrastructure']['land_status_identified'] ?? '' )==1): ?>
                    <span>Land Identified </span>
                    <?php else: ?>
                    <span>NA</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Land Acquired (In Acres)</th>
                <td><?php echo e($previewData['internal_infrastructure']['land_acquired_acres'] ?? '--'); ?></td>
                <th>Government Land</th>
                <td>

                    <span>Land Identified (In Acres) :
                        <?php echo e($previewData['internal_infrastructure']['govt_land_identified'] ?? '--'); ?></span> <br>

                    <span>Land Acquired (In Acres) : <?php echo e($previewData['internal_infrastructure']['govt_land_acquired']
                        ?? '--'); ?></span>

                </td>
            </tr>

            <tr>
                <th>Private Land</th>
                <td>
                    <span>Land Identified (In Acres) :
                        <?php echo e($previewData['internal_infrastructure']['private_land_identified'] ?? '--'); ?></span> <br>

                    <span>Land Acquired (In Acres) :
                        <?php echo e($previewData['internal_infrastructure']['private_land_acquired'] ?? '--'); ?></span>
                </td>
                <th>Any Others</th>
                <td><?php echo e($previewData['internal_infrastructure']['others'] ?? '--'); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Road
                </th>
            </tr>

            <tr>
                <th>Approach road to the park Status of Road</th>
                <td> <?php if($previewData['internal_infrastructure']['road_status'] == 'A'): ?>
                    <span>Already available</span>
                    <?php elseif($previewData['internal_infrastructure']['road_status'] == 'B'): ?>
                    <span>New road to be developed</span>
                    <?php else: ?>
                    <span>Only rework/modification of road</span>
                    <?php endif; ?>
                </td>
                <th>Length of approach road up to the park boundary (in km)</th>
                <td><?php echo e($previewData['internal_infrastructure']['park_boundary'] ?? ''); ?>

                </td>
            </tr>
            <tr>
                <th>Length of access road to each plot inside the park (in km)</th>
                <td><?php echo e($previewData['internal_infrastructure']['road_distance'] ?? ''); ?></td>
                <th>Status </th>
                <td><?php echo e($previewData['internal_infrastructure']['work_status'] ?? ''); ?></td>
            </tr>



            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Water Facilities
                </th>
            </tr>
            <!-- <?php echo e($previewData['water_facilities']['source_water'] ?? ''); ?> -->
            <tr>
                <th>Source of water for park</th>
                <td><?php echo e($previewData['internal_infrastructure']['source_water'] ?? ''); ?></td>
                <th>Details of water requirements</th>
                <td><?php echo e($previewData['internal_infrastructure']['required_water'] ?? ''); ?>

                </td>
            </tr>
            <tr>
                <th>Proposed system and progress made so far</th>
                <td><?php echo e($previewData['internal_infrastructure']['proposed_system'] ?? ''); ?></td>
                <th>Status </th>
                <td><?php echo e($previewData['internal_infrastructure']['status'] ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Drainage Facility
                </th>
            </tr>


            <tr>
                <th>Details of proposed drainage system (including length in km)</th>
                <td><?php echo e($previewData['internal_infrastructure']['drainage_system_details'] ?? ''); ?></td>
                <th>Status </th>
                <td><?php echo e($previewData['internal_infrastructure']['tender_status'] ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Fencing
                </th>
            </tr>


            <tr>
                <th>Details of of fencing/boundary (including length)</th>
                <td> <?php echo e($previewData['internal_infrastructure']['fencing_details'] ?? ''); ?></td>
                <th>Status </th>
                <td><?php echo e($previewData['internal_infrastructure']['fencing_status']  ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Telecommunication Facilities
                </th>
            </tr>

            <tr>
                <th>Details of telecommunication facilities</th>
                <td> <?php echo e($previewData['internal_infrastructure']['tele_facility_details'] ?? ''); ?></td>
                <th>Status </th>
                <td><?php echo e($previewData['internal_infrastructure']['tender_progress_status']  ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Internal Transmission System
                </th>
            </tr>

            <tr>
                <th>Details of internal transmission system</th>
                <td> <?php echo e($previewData['internal_transmission_system']['int_transmission_detail'] ?? ''); ?></td>
                <th> Proposed connection point</th>
                <td> <?php if($previewData['internal_transmission_system']['connection_point'] == 'A'): ?>
                    <span>CTU</span>
                    <?php else: ?>
                    <span>STU</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Whether applied for connectivity/LTA to STU/CTU</th>
                <td> <?php if($previewData['internal_transmission_system']['whether_applied'] == 'A'): ?>
                    <span>YES</span>
                    <?php else: ?>
                    <span>NO</span>
                    <?php endif; ?>
                </td>
                <th>Capacity for which connectivity granted (in MW) </th>
                <td><?php echo e($previewData['internal_transmission_system']['connectivity_capacity']  ?? ''); ?></td>
            </tr>

            <tr>
                <th>Capacity for which LTA granted (in MW))</th>
                <td> <?php echo e($previewData['internal_transmission_system']['lta_capacity'] ?? ''); ?>


                </td>
                <th>Status </th>
                <td><?php echo e($previewData['internal_transmission_system']['internal_transmission_status']  ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    External Transmission System
                </th>
            </tr>

            <tr>
                <th> Responsibility for external transmission system</th>
                <td> <?php if($previewData['internal_transmission_system']['ext_responsibility'] == 'A'): ?>
                    <span>CTU</span>
                    <?php else: ?>
                    <span>STU</span>
                    <?php endif; ?>
                </td>
                <th>Details of external transmission system</th>
                <td> <?php echo e($previewData['internal_transmission_system']['external_details'] ?? ''); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td colspan="3"><?php echo e($previewData['internal_transmission_system']['external_status']  ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Solar Projects
                </th>
            </tr>

            <tr>
                <th> Plan for setting up of solar projects inside solar in</th>
                <td> <?php if($previewData['solar_projects']['detail'] == 'A'): ?>
                    <span> EPC Mode</span>
                    <?php elseif($previewData['solar_projects']['detail'] == 'B'): ?>
                    <span>Developer Mode</span>
                    <?php elseif($previewData['solar_projects']['detail'] == 'C'): ?>
                    <span>Third Party</span>
                    <?php else: ?>
                    <span> Any Other</span>
                    <?php endif; ?>
                </td>
                <th>Tendering Agency for Solar Projects</th>
                <td> <?php echo e($previewData['solar_projects']['agency'] ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="pagetitle">
                    Details of Tender, Tariff Discovered and details of bidders
                </th>
            </tr>

            <tr>
                <th>Date of NIT</th>
                <td><?php echo e($previewData['solar_projects']['nit_date']  ?? ''); ?></td>
                <th>Name of successful bidders</th>
                <td><?php echo e($previewData['solar_projects']['bidders_name']  ?? ''); ?></td>
            </tr>
            <tr>
                <th>Capacity (MW)</th>
                <td><?php echo e($previewData['solar_projects']['TD_capacity']  ?? ''); ?></td>
                <th>Tariff (in Rs/kWh)</th>
                <td><?php echo e($previewData['solar_projects']['tariff']  ?? ''); ?></td>
            </tr>
            <tr>
                <th>Name of successful bidders/Solar Project Developers</th>
                <td><?php echo e($previewData['solar_projects']['spds_name_loa']  ?? ''); ?></td>
                <th>Capacity (MW)</th>
                <td><?php echo e($previewData['solar_projects']['capacity_loa']  ?? ''); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Financial Closure
                </th>
            </tr>
            <tr>
                <th>Details of Financial Closure of Solar Park (arrangement of 90% of fund of total park cost)</th>
                <td colspan="4"> <?php echo e($previewData['financial_closure']['financial_closure_details'] ?? ''); ?></td>
                <!-- <th>Status </th>
        <td><?php echo e($previewData['financial_closure']['financial_closure_remarks']  ?? ''); ?></td> -->
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Award of Work
                </th>
            </tr>

            <tr>
                <th>Details of tender, award of work for pooling stations, transmission lines and associated systems
                </th>
                <td> <?php echo e($previewData['award_of_work']['award_work_details'] ?? ''); ?></td>
                <th> Whether work for poling stations, transmission lines, awarded</th>
                <td> <?php if($previewData['award_of_work']['whether_awarded'] == 'A'): ?>
                    <span>Yes</span>
                    <?php else: ?>
                    <span>No</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Details of material received at site for pooling stations and other work of Solar Park</th>
                <td> <?php echo e($previewData['award_of_work']['pooling_stations'] ?? ''); ?></td>
                <th>Status</th>
                <td colspan="3"><?php echo e($previewData['award_of_work']['aow_status']  ?? ''); ?></td>
            </tr>

            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Solar park Completion
                </th>
            </tr>

            <tr>
                <th> Whether the internal infrastructure of park development activities are completed</th>
                <td> <?php if($previewData['solar_park_completion']['developement_activities'] == 'A'): ?>
                    <span>Yes</span>
                    <?php else: ?>
                    <span>No</span>
                    <?php endif; ?>
                </td>
                <th>Date of In-Principle Approval</th>
                <td><?php echo e($previewData['solar_park_completion']['date_inprincuple_approval'] ?? ''); ?></td>
            </tr>
            <tr>
                <th>Details of material received at site for pooling stations and other work of Solar Park</th>
                <td> <?php echo e($previewData['solar_park_completion']['solarPark_work_details'] ?? ''); ?></td>
                <th>Delay (if any) along with reason</th>
                <td> <?php echo e($previewData['solar_park_completion']['SPC_delay'] ?? ''); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    External Power Evacuation System
                </th>
            </tr>
            <tr>
                <th>Details of completion of external transmission activities</th>
                <td> <?php echo e($previewData['external_power_evacuation_system']['external_transmission'] ?? ''); ?></td>
                <th> Delay (if any) along with reason</th>
                <td> <?php echo e($previewData['external_power_evacuation_system']['delay_external_transmission'] ?? ''); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Solar Project Completion
                </th>
            </tr>
            <tr>
                <th>Details of completion of external transmission activities</th>
                <td> <?php echo e($previewData['solar_project_completion']['solar_project_completion_details'] ?? ''); ?></td>
                <th> Delay (if any) along with reason</th>
                <td> <?php echo e($previewData['solar_project_completion']['delay_solar_project'] ?? ''); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Attachments
                </th>
            </tr>
            <tr>
                <th>Photo of site/land development and related activities, before and after completion of activities
                </th>
                <td>
                    <?php if(!empty($previewData['attachments']['site_photo'])): ?>
                    <?php $i=0;?>
                    <?php $__currentLoopData = $previewData['attachments']['site_photo'][$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $i++; ?>
                    <a href="<?php echo e(URL::to($docBaseUrl.$value)); ?>" target="_blank" class="badge bg-primary">View File</a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>

                <th>Photo of roads, water system, drainage system, before and after completion of activities</th>
                <td> <?php if(!empty($previewData['attachments']['road_photo'])): ?>
                    <?php $j=0; ?>
                    <?php $__currentLoopData = $previewData['attachments']['road_photo'][$j]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $j++; ?>
                    <a href="<?php echo e(URL::to($docBaseUrl.$value)); ?>" target="_blank" class="badge bg-primary">View File</a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Photo of internal power evacuation systems, pooling substations, lines or associated activates,
                    before and
                    after completion of activities</th>
                <td><?php if(!empty($previewData['attachments']['ipes_photo'])): ?>
                    <?php $l=0; ?>
                    <?php $__currentLoopData = $previewData['attachments']['ipes_photo'][$l]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $l++; ?>
                    <a href="<?php echo e(URL::to($docBaseUrl.$value)); ?>" target="_blank" class="badge bg-primary">View File</a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>

                <th>Photo of external transmission system, grid substations, lines or associated activates, before and
                    after
                    completion of activities</th>
                <td> <?php if(!empty($previewData['attachments']['exts_photo'])): ?>
                    <?php $m=0; ?>
                    <?php $__currentLoopData = $previewData['attachments']['exts_photo'][$m]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $m++; ?> <a href="<?php echo e(URL::to($docBaseUrl.$value)); ?>" target="_blank"
                        class="badge bg-primary">View
                        File</a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Photo of solar projects or associated activates, before and after completion of activities</th>
                <td colspan="4">
                    <?php if(!empty($previewData['attachments']['solar_project_photo'])): ?>
                    <?php $n=0; ?>
                    <?php $__currentLoopData = $previewData['attachments']['solar_project_photo'][$n]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $n++; ?>
                    <a href="<?php echo e(URL::to($docBaseUrl.$value)); ?>" target="_blank" class="badge bg-primary">View File</a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th colspan="4" class="heading bg-success text-light">
                    Additional Information
                </th>
            </tr>
            <tr>
                <th>Any issue of SPPD/SPD/STU/CTU which you want to highlight in MNRE/SECI, please upload a brief</th>
                <td colspan="4">
                    <?php if($previewData['additional_information']!=''): ?>

                    <a href=" <?php echo e(URL::to($docBaseUrl.$previewData['additional_information'])); ?>" target="_blank"
                        class="badge bg-primary">View File</a>
                    <?php endif; ?>
                </td>
            <tr>
                <td colspan="4"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        MNRE Remarks
                    </button>
                    <!-- <button type="button" class="btn btn-lg btn-primary"> Remarks</button> -->
                </td>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/mnreRemarkSolarPark')); ?>" id="formFileAjax"
                        method="POST">
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
                                            <select class="form-control" aria-label="Default select example"
                                                name="status">
                                                <option value=''>Select</option>
                                                <option value="1">Approve</option>
                                                <option value="2">Partial Approve</option>
                                                <option value="3">Reject</option>
                                            </select>
                                        </div> <br>
                                        <label for=""> Remark <span class="text-danger">*</span></label>
                                        <textarea name="mnreremarks" class="form-control" id="" cols="5"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="hidden" name="editId"
                                            value="<?php echo e($general->encodeid($previewData->id)); ?>">
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </tr>
        </table>
    </main>
</section>
<?php $__env->stopSection(); ?>
<script>
$(document).ready(function() {
    $(".btn").click(function() {
        $("#sel1").modal('show');
    });
});
</script>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/mnre/solarParkProgressReportPreview.blade.php ENDPATH**/ ?>