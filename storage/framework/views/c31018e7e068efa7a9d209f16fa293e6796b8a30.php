
<?php $__env->startSection('content'); ?>
<section class="section dashboard">

    <main id="main" class="main">



        <!-- <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
        </script> -->
        <section class="section dashboard">
            <!-- <main id="main" class="main"> -->

            <div class="pagetitle">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Application Progress Report</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row app_progrs_rprt">
                        <!-- Nav tabs -->
                        <?php

                        $internal_infrastructure_tab='';
                        $internal_transmission_system_tab='';
                        $solar_projects_tab='';
                        $financial_closure_tab='';
                        $award_of_work_tab='';
                        $status_of_release_of_cfa_tab='';
                        $external_power_evacuation_system_tab='';
                        $solar_project_completion_tab='';
                        $attachments_tab='';
                        $additional_information_tab='';
                        $final_submission_tab='';
                        $solar_park_completion_tab='';

                        if($generalData['general']!=''){ $internal_infrastructure_tab='tab'; }
                        if($generalData['internal_infrastructure']!=''){ $internal_transmission_system_tab='tab'; }
                        if($generalData['internal_transmission_system']!=''){ $solar_projects_tab='tab'; }
                        if($generalData['solar_projects']!=''){ $financial_closure_tab='tab'; }
                        if($generalData['financial_closure']!=''){ $award_of_work_tab='tab'; }

                        if($generalData['award_of_work']!=''){ $solar_park_completion_tab='tab'; }
                        if($generalData['solar_park_completion']!=''){ $status_of_release_of_cfa_tab='tab'; }


                        if($generalData['status_of_release_of_cfa']!=''){ $external_power_evacuation_system_tab='tab'; }
                        if($generalData['external_power_evacuation_system']!=''){ $solar_project_completion_tab='tab'; }
                        if($generalData['solar_project_completion']!=''){ $attachments_tab='tab'; }
                        if($generalData['attachments']!=''){ $additional_information_tab='tab'; }
                        if($generalData['additional_information']!=''){ $final_submission_tab='tab'; }




                        ?>
                        <ul class="nav nav-tabs" role="tablist" id="tabUL">
                            <li class="active <?php if($generalData['general']!=''): ?>completed <?php endif; ?> nav-item">
                                <a class="nav-link" href="#general" role="tab" data-toggle="tab">General</a>
                            </li>
                            <li class="<?php if($generalData['internal_infrastructure']!=''): ?>completed <?php endif; ?> nav-item"><a
                                    href="#internal_infrastructure" class="nav-link" role="tab"
                                    data-toggle="<?php echo e($internal_infrastructure_tab); ?>">Internal
                                    Infrastructure</a>
                            </li>

                            <li class="<?php if($generalData['internal_transmission_system']!=''): ?>completed <?php endif; ?>"><a
                                    href="#internal_transmission_system" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($internal_transmission_system_tab); ?>">
                                    Transmission
                                    System</a>
                            </li>
                            <!-- <li class="<?php if($generalData['external_transmission_system']!=''): ?>completed <?php endif; ?>"><a
                                    href="#external_transmission_system" role="tab" class="nav-link"
                                    data-toggle="tab">External
                                    Transmission
                                    System</a>
                            </li> -->
                            <li class="<?php if($generalData['solar_projects']!=''): ?>completed <?php endif; ?>"><a
                                    href="#solar_projects" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($solar_projects_tab); ?>">Solar
                                    Projects</a></li>

                            <li class="<?php if($generalData['financial_closure']!=''): ?>completed <?php endif; ?>"><a
                                    href="#financial_closure" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($financial_closure_tab); ?>">Financial
                                    Closure</a></li>

                            <li class="<?php if($generalData['award_of_work']!=''): ?>completed <?php endif; ?>"><a href="#award_of_work"
                                    role="tab" data-toggle="<?php echo e($award_of_work_tab); ?>" class="nav-link">Award of Work</a>
                            </li>


                            <li class="<?php if($generalData['solar_park_completion']!=''): ?>completed <?php endif; ?>"><a
                                    href="#solar_park_completion" class="nav-link" role="tab"
                                    data-toggle="<?php echo e($solar_park_completion_tab); ?>">Solar
                                    Park Completion</a>
                            </li>
                            <li class="<?php if($generalData['status_of_release_of_cfa']!=''): ?>completed <?php endif; ?>"><a
                                    href="#status_of_release_of_cfa" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($status_of_release_of_cfa_tab); ?>">Status Of Release of CFA</a>
                            </li>
                            <li class="<?php if($generalData['external_power_evacuation_system']!=''): ?>completed <?php endif; ?>"><a
                                    href="#external_power_evacuation_system" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($external_power_evacuation_system_tab); ?>">External Power
                                    Evacuation System</a>
                            </li>

                            <li class="<?php if($generalData['solar_project_completion']!=''): ?>completed <?php endif; ?>"><a
                                    href="#solar_project_completion" class="nav-link" role="tab"
                                    data-toggle="<?php echo e($solar_project_completion_tab); ?>">Solar
                                    Project
                                    Completion</a>
                            </li>
                            <li class="<?php if($generalData['attachments']!=''): ?>completed <?php endif; ?>"><a href="#attachments"
                                    role="tab" data-toggle="<?php echo e($attachments_tab); ?>" class="nav-link">Attachments</a></li>


                            <li class="<?php if($generalData['additional_information']!=''): ?>completed <?php endif; ?>"><a
                                    href="#additional_information" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($additional_information_tab); ?>">Additional
                                    Information</a></li>

                            <li class=""><a href="#final_submission" role="tab" class="nav-link"
                                    data-toggle="<?php echo e($final_submission_tab); ?>">Final
                                    Submission</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->

                        <div class="tab-content">


                            <div class="tab-pane active" id="general">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax" name="general">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5">
                                        <!-- <button type="submit" class="btn btn-flat btn-success" value="1"
                                    name="general">Save</button> -->
                                        <input type="submit" name="submit" id="submit_general" value="Save"
                                            class="btn btn-flat btn-success" />
                                        <input type="hidden" name="type" value="general" id="">
                                        <input type="hidden" name="next" value="internal_infrastructure" id="">
                                        <button type="button" data-next="internal_infrastructure"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="general"> Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
                            <div class="tab-pane" id="internal_infrastructure">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="internal_infrastructure">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/internal_infrastructure', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="general"> Back</button>

                                        <input type="hidden" name="type" value="internal_infrastructure" id="">
                                        <input type="hidden" name="next" value="internal_transmission_system" id="">

                                        <input type="submit" name="submit_internal_infrastructure"
                                            id="submit_internal_infrastructure" value="Save"
                                            class="btn btn-flat btn-success" />


                                        <button type="button" data-next="internal_transmission_system"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="internal_infrastructure"> Next</button>
                                    </div>

                                    <div>

                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="internal_transmission_system">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="internal_transmission_system">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/internal_transmission_system', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="internal_transmission_system" id="">
                                        <input type="hidden" name="next" value="solar_projects" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="internal_infrastructure"> Back</button>

                                        <input type="submit" name="submit_internal_transmission_system"
                                            id="submit_internal_transmission_system" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" data-next="solar_projects"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="internal_transmission_system"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="tab-pane" id="external_transmission_system">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="external_transmission_system">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/external_transmission_system', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="external_transmission_system" id="">
                                        <input type="hidden" name="next" value="solar_projects" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="internal_transmission_system"> Back</button>

                                        <input type="submit" name="submit_external_transmission_system"
                                            id="submit_external_transmission_system" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" data-next="solar_projects"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="external_transmission_system"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div> -->
                            <div class="tab-pane" id="solar_projects">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax" name="solar_projects">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/solar_projects', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="solar_projects" id="">
                                        <input type="hidden" name="next" value="financial_closure" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="internal_transmission_system"> Back</button>

                                        <input type="submit" name="submit_solar_projects" id="submit_solar_projects"
                                            value="Save" class="btn btn-flat btn-success" />

                                        <button type="button" data-next="financial_closure"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="solar_projects"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="financial_closure">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="financial_closure">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/financial_closure', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="financial_closure" id="">
                                        <input type="hidden" name="next" value="award_of_work" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="solar_projects"> Back</button>

                                        <input type="submit" name="submit_financial_closure"
                                            id="submit_financial_closure" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" data-next="award_of_work" class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="financial_closure"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="award_of_work">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax" name="award_of_work">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/award_of_work', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="award_of_work" id="">
                                        <input type="hidden" name="next" value="solar_park_completion" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="financial_closure"> Back</button>

                                        <input type="submit" name="submit_award_of_work" id="submit_award_of_work"
                                            value="Save" class="btn btn-flat btn-success" />

                                        <button type="button" data-next="solar_park_completion"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="award_of_work"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="solar_park_completion">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="solar_park_completion">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/solar_park_completion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="solar_park_completion" id="">
                                        <input type="hidden" name="next" value="status_of_release_of_cfa" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="award_of_work"> Back</button>

                                        <input type="submit" name="submit_solar_park_completion"
                                            id="submit_solar_park_completion" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" data-next="status_of_release_of_cfa"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="solar_park_completion"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="status_of_release_of_cfa">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="status_of_release_of_cfa">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/status_of_release_of_cfa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="status_of_release_of_cfa" id="">
                                        <input type="hidden" name="next" value="external_power_evacuation_system" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="award_of_work"> Back</button>

                                        <input type="submit" name="status_of_release_of_cfa"
                                            id="submit_status_of_release_of_cfa" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" data-next="external_power_evacuation_system"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="status_of_release_of_cfa"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="external_power_evacuation_system">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="external_power_evacuation_system">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/external_power_evacuation_system', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="external_power_evacuation_system" id="">
                                        <input type="hidden" name="next" value="solar_project_completion" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="solar_park_completion"> Back</button>

                                        <input type="submit" name="submit_external_power_evacuation_system"
                                            id="submit_external_power_evacuation_system" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" data-next="solar_project_completion"
                                            class="btn btn-flat btn-primary"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="external_power_evacuation_system"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="solar_project_completion">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="solar_project_completion">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/solar_project_completion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="solar_project_completion" id="">
                                        <input type="hidden" name="next" value="attachments" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="external_power_evacuation_system"> Back</button>

                                        <input type="submit" name="submit_solar_project_completion"
                                            id="submit_solar_project_completion" value="Save"
                                            class="btn btn-flat btn-success" />


                                        <button type="button" class="btn btn-flat btn-primary" data-next="attachments"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="solar_project_completion"> Next</button>
                                        <div>
                                            <br><br><br>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="attachments">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax" name="attachments">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/attachments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="attachments" id="">
                                        <input type="hidden" name="next" value="additional_information" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="solar_project_completion"> Back</button>

                                        <input type="submit" name="submit_attachments" id="submit_attachments"
                                            value="Save" class="btn btn-flat btn-success" />

                                        <button type="button" class="btn btn-flat btn-primary"
                                            data-next="additional_information"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="attachments"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="additional_information">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="additional_information">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/additional_information', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="additional_information" id="">
                                        <input type="hidden" name="next" value="final_submission" id="">
                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="attachments"> Back</button>

                                        <input type="submit" name="submit_additional_information"
                                            id="submit_additional_information" value="Save"
                                            class="btn btn-flat btn-success" />

                                        <button type="button" class="btn btn-flat btn-primary"
                                            data-next="final_submission"
                                            onClick="$('.nav-tabs > .active').next('li').find('a').trigger('click');"
                                            value="1" name="additional_information"> Next</button>
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="final_submission">
                                <form action="<?php echo e(URL::to(Auth::getDefaultDriver().'/application/progress_report')); ?>"
                                    method="POST" enctype="multipart/form-data" id="formFileAjax"
                                    name="additional_information">
                                    <input type="hidden" name="editId" value="<?php echo e($id ?? ''); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('backend/beneficiary/progress_report/final_submission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mb-5"><br>
                                        <input type="hidden" name="type" value="final_submission" id="">

                                        <button type="button" class="btn btn-flat btn-danger"
                                            onClick="$('.nav-tabs > .active').prev('li').find('a').trigger('click');"
                                            value="1" name="additional_information"> Back</button>

                                        <input type="submit" name="submit_final_submission" id="submit_final_submission"
                                            value="Final Submission" class="btn btn-flat btn-success" />
                                    </div>
                                    <div>
                                        <br><br><br>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </section>
        <style>
        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            color: #fff;
            cursor: default;
            background-color: #009700;
            border: 1px solid #fff;
            /* border-radius: 50%; */
            border-bottom-color: transparent;
        }

        .nav-tabs>li.completed>a,
        .nav-tabs>li.completed>a:focus,
        .nav-tabs>li.completed>a:hover {
            color: #fff;
            cursor: default;
            background-color: green;
            border: 1px solid #fff;
            color: #ccc !important;
            border-bottom-color: transparent;
        }

        .nav-tabs>li {
            float: left;
            margin-bottom: 10px;
        }
        </style>
    </main>
</section>

<!-- footer -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark  footer_nav">
    <div class="container-fluid d-flex justify-content-center">
        <div class="copyright-content d-flex align-items-center justify-content-center">
            <img class="footer_nic_logo" src="<?php echo e(URL::asset('public/images/footerNIC.png')); ?>">
            <div> Portal Content Managed by <strong> <a title="GoI, External Link that opens in a new window"
                        href="https://mnre.gov.in"><strong>Ministry of New and Renewable
                            Energy</strong></a></strong>
                <br><span>Designed, Developed and Hosted by <a title="NIC, External Link that opens in a new window"
                        href="https://www.nic.in"><strong class="highlight_text_blue">National Informatics
                            Centre (NIC)</strong></a></span>
            </div>
        </div>
    </div>
</nav>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/form_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/progressReport.blade.php ENDPATH**/ ?>