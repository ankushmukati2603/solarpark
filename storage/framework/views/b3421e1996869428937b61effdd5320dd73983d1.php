<?php
    $segments = request()->segments();
   
    $query_str1= (!empty($segments[1]))? $segments[1] : '';
    // dd($query_str1);
?>


<aside id="sidebar" class="sidebar dashboard3">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link  <?php if($query_str1 == ''): ?>active <?php endif; ?>" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver())); ?>">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if(Auth::guard('developer')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'solar-park-list'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/solar-park-list')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Manage Solar Park</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'my-progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/my-progress-report')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Progress Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'consolidate-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/consolidate-report')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Consolidate Report</span>
            </a>
        </li>

        <?php endif; ?>
        <?php if(Auth::guard('mnre')->check()): ?>


        <!-- <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/progress-report')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>Recieved Report</span>
            </a>
        </li>
       <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'mnredeveloper-list'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/mnredeveloper-list')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>Developer</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'agency-list'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/agency-list')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>Agency</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'mnre-list'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/mnre-list')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>MNRE</span>
            </a>
        </li> -->


        <!-- <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'archive-mnre'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/')); ?>" role="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-user-check"></i>
                <span>Archive Report</span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li class="nav-item">
                    <a class="nav-link <?php if($query_str1 == 'mnre-list'): ?>active <?php endif; ?>"
                        href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/')); ?>" role="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user-check"></i>
                        <span>Developer</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if($query_str1 == 'agency-archive-report'): ?>active <?php endif; ?>"
                        href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/agency-archive-report')); ?>" role="button"
                        data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user-check"></i>
                        <span>Agencies Archive Report</span>
                    </a>
                </li>
            </ul>
        </li> 
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'agency-archive-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/view-agency-archive-report')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>Agencies Archive Report</span>
            </a>
        </li>-->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-users" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-table-list"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class=" <?php if($query_str1 == 'sna-list'): ?> active <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/sna-list')); ?>">
                        <i class="fa-regular fa-circle"></i><span>SNA's User</span>
                    </a>
                </li>
                <li class=" <?php if($query_str1 == 'sppd'): ?> active <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/sppd-list')); ?>">
                        <i class="fa-regular fa-circle"></i><span>SPPD's User</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-reports" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-table-list"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class=" <?php if($query_str1 == 'sna-list'): ?> active <?php endif; ?>">
                    <a class="nav-link collapsed"
                        href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/solar-park-reports')); ?>">
                        <i class="fa-regular fa-circle"></i><span>Solar Parks Reports (SPPD's)</span>
                    </a>
                </li>
                <li class=" <?php if($query_str1 == 'Reia-Reports'): ?> active <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Reia-Reports')); ?>">
                        <i class="fa-regular fa-circle"></i><span>REIA'S Reports</span>
                    </a>
                </li>
                <li class=" <?php if($query_str1 == 'Stu-Reports'): ?> active <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Stu-Reports')); ?>">
                        <i class="fa-regular fa-circle"></i><span>STU's/CTU's Reports</span>
                    </a>
                </li>
                <li class=" <?php if($query_str1 == 'Sna-Reports'): ?> active <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Sna-Reports')); ?>">
                        <i class="fa-regular fa-circle"></i><span>SNA Reports</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'developer-archive-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/developer-archive-report')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>Developer</span>
            </a>
        </li> -->
        <?php endif; ?>
        <?php if(Auth::guard('state-implementing-agency')->check()): ?>
        <!-- <li>
            <a href="#" data-toggle="collapse" data-target="#submenu-2" class="collapsed" aria-expanded="false"><i
                    class="fa fa-fw fa-star"></i> MENU 2 <i class="fa fa-fw fa-angle-down pull-right"></i></a>
            <ul id="submenu-2" class="collapse" aria-expanded="false" style="height: 1px;">
                <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.1</a></li>
                <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.2</a></li>
                <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.3</a></li>
            </ul>
        </li> -->
        <ul class="sidebar-nav" id="sidebar-nav">



            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav22" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-table-list"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav22" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class=" <?php if($query_str1 == 'Agency'): ?> active <?php endif; ?>">
                        <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Agency')); ?>">
                            <i class="fa-regular fa-circle"></i><span>Agencies</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php if($query_str1 == 'Sub-Agency'): ?> active <?php endif; ?>">
                        <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Sub-Agency')); ?>">
                            <i class="fa-regular fa-circle"></i><span>SPD's</span>
                        </a>
                    </li>
                    <li class="nav-item   <?php if($query_str1 == 'Agency'): ?> Bidder <?php endif; ?>">
                        <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Bidder')); ?>">
                            <i class="fa-regular fa-circle"></i><span>Bidders</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php if($query_str1 == 'TenderReport'): ?> active <?php endif; ?>">
                        <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/TenderReport')); ?>">
                            <i class="fa-regular fa-circle"></i><span>Tender Report</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav21" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-table-list"></i><span>Tendering</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav21" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item <?php if($query_str1 == 'Tenders'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Tenders')); ?>" class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Submitted Tender's</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if($query_str1 == 'Tenders'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Tenders/Add')); ?>" class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Add Tender</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if($query_str1 == 'ReverseAuction'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/ReverseAuction')); ?>"
                            class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Reverse Auction</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if($query_str1 == 'SelectedBidder'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/SelectedBidder')); ?>"
                            class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Selected Bidders</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if($query_str1 == 'ProjectLocation'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/ProjectLocation')); ?>"
                            class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Project Location</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#tables-nav222" data-bs-toggle="collapse"
                            href="#">
                            <i class="fa-regular fa-circle"></i><span>Signing Of PPA/PSA</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="tables-nav222" class="nav-content collapse " data-bs-parent="#sidebar-nav1"
                            style="padding-left: 10px;">


                            <li class="nav-item  <?php if($query_str1 == 'SigningOfPSA'): ?> active <?php endif; ?>">
                                <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/SigningOfPSA')); ?>"
                                    class="nav-link collapsed">
                                    <i class="fa-regular fa-circle"></i><span>Signing Of PSA</span>
                                </a>
                            </li>

                            <li class="nav-item   <?php if($query_str1 == 'SigningOfPPA'): ?> active <?php endif; ?>">
                                <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/SigningOfPPA')); ?>"
                                    class="nav-link collapsed">
                                    <i class="fa-regular fa-circle"></i><span>Signing Of PPA</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item <?php if($query_str1 == 'LOA-LOI'): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/LOA-LOI')); ?>" class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>LOI/LOA</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($query_str1 == 'CancelTender'): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/CancelTender')); ?>" class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Cancel Tender</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($query_str1 == 'TenderCommissioning'): ?>active <?php endif; ?>">
                        <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/TenderCommissioning')); ?>"
                            class="nav-link collapsed">
                            <i class="fa-regular fa-circle"></i><span>Commissioning</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-Implementation" data-bs-toggle="collapse"
                    href="#">
                    <i class="fa-solid fa-table-list"></i><span>Under Implementation</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-Implementation" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class=" <?php if($query_str1 == 'Agency'): ?> active <?php endif; ?>">
                        <a class="nav-link collapsed"
                            href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Under-Implementation')); ?>">
                            <i class="fa-regular fa-circle"></i><span>Add Implementation Details</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-commissioned" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-table-list"></i><span>Commissioned Details</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-commissioned" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class=" <?php if($query_str1 == 'Agency'): ?> active <?php endif; ?>">
                        <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Commissioned')); ?>">
                            <i class="fa-regular fa-circle"></i><span>Add Commissioned Details</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>


        <?php endif; ?>

        <?php if(Auth::guard('reia')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'schemes'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/schemes')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Schemes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'bidder'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/bidder')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Bidder</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/progress-report')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Monthly Progress Report</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'reports'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Agency')); ?>">
                <i class="fa-solid fa-building"></i>
                <span>Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'feedback'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/feedback')); ?>">
                <i class="fa-solid fa-folder-open"></i>
                <span>Feedback</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'notifications'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/notifications')); ?>">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'edit-profile'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/edit-profile')); ?>">
                <i class="fa-regular fa-address-card"></i>
                <span>My Profile</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if(Auth::guard('stu-users')->check()): ?>

        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/progress-report')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Month Progress Report</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'reports'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/Agency')); ?>">
                <i class="fa-solid fa-building"></i>
                <span>Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'feedback'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/feedback')); ?>">
                <i class="fa-solid fa-folder-open"></i>
                <span>Feedback</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'notifications'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/notifications')); ?>">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'edit-profile'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/edit-profile')); ?>">
                <i class="fa-regular fa-address-card"></i>
                <span>My Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'stu-project-list'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/stu-project-list')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Manage STUs/CTUs Project</span>
            </a>
        </li>

        <?php endif; ?>



        <?php if(Auth::guard('seci')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'recieved-progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/solar_park_applications')); ?>">
                <i class="fa-solid fa-user-check"></i>
                <span>Progress Report</span>
            </a>
        </li>
        <?php endif; ?>


        <?php if(Auth::guard('gecdeveloper')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'my-progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/progress-report')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>Progress Report</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Auth::guard('gecmnre')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1 == 'my-progress-report'): ?>active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/gec-progress-report')); ?>">
                <i class="fa-solid fa-users"></i>
                <span>GEC Developer Report</span>
            </a>
        </li>
        <?php endif; ?>



        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="fa-solid fa-gears"></i>
                <span>Systems</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="fa-solid fa-arrows-spin"></i>
                <span>Operation Maintenance</span>
            </a>
        </li> -->
    </ul>
</aside>
<style>
/* .active {
    color: #008000 !important;
} */

.bg-active {
    background: #ffffff;
}
</style>






























<!-- <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1==NULL): ?> active <?php endif; ?>" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver())); ?>">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if(Auth::guard('developer')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1==NULL): ?> active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/my-progress-report')); ?>">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Progress Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1==NULL): ?> active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/consolidate-report')); ?>">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Consolidate Report</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Auth::guard('mnre')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1==NULL): ?> active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/progress-report')); ?>">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Recieved Report</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Auth::guard('state-implementing-agency')->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($query_str1==NULL): ?> active <?php endif; ?>"
                href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/recieved-progress-report')); ?>">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Progress Report Received</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</aside> --><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/layouts/partials/backend/_sidebar.blade.php ENDPATH**/ ?>