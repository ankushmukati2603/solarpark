<?php
    $segments = request()->segments();
   
    $query_str1= (!empty($segments[1]))? $segments[1] : '';
    // dd($query_str1);
?>


<aside id="sidebar" class="sidebar dashboard3">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- <li class="nav-item">
            <a class="nav-link  @if($query_str1 == '')active @endif" href="{{URL::to('/'.Auth::getDefaultDriver())}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>
        </li> -->
        @if (Auth::guard('developer')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'solar-park-list')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/solar-park-list')}}">
                <i class="fa-solid fa-sun"></i>
                <span>Manage Solar Park</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'my-progress-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/my-progress-report')}}">
                <i class="fa-solid fa-file"></i>
                <span>Progress Report</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'consolidate-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/consolidate-report')}}">
                <i class="fa-solid fa-file-lines"></i>
                <span>Consolidate Report</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'feedback')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/feedback')}}">
                <i class="fa-solid fa-folder-open"></i>
                <span>Feedback</span>
            </a>
        </li>
        @endif
        @if (Auth::guard('mnre')->check())
        <li class="nav-item">
            <a class="nav-link  @if($query_str1 == '')active @endif" href="{{URL::to('/'.Auth::getDefaultDriver())}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-users" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-users"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class=" ">
                    <a class="nav-link collapsed @if($query_str1 == 'sna-list') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/sna-list')}}">
                        <i class="fa-solid fa-user fa-2x"></i><span>SNAs User</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link collapsed @if($query_str1 == 'sppd-list') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/sppd-list')}}">
                        <i class="fa-solid fa-user fa-2x"></i><span>SPPDs User</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link collapsed @if($query_str1 == 'stu-list') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/stu-list')}}">
                        <i class="fa-solid fa-user"></i><span>STUs User</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-reports" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-file"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="">
                    <a class="nav-link collapsed @if($query_str1 == 'solar-park-reports') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/solar-park-reports')}}">
                        <i class="fa-solid fa-circle"></i><span>SPPD Reports</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link collapsed @if($query_str1 == 'Reia-Reports') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/Reia-Reports')}}">
                        <i class="fa-solid fa-circle"></i><span>REIA Reports</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link collapsed @if($query_str1 == 'Stu-Reports') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/Stu-Reports')}}">
                        <i class="fa-solid fa-circle"></i><span>STUs/CTU Reports</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link collapsed @if($query_str1 == 'Sna-Reports') active @endif"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/Sna-Reports')}}">
                        <i class="fa-solid fa-circle"></i><span>SNA Tenders</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if($query_str1 == 'solar-park')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/solar-park')}}">
                <i class="fa-solid fa-sun"></i>
                <span>Solar Park</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if($query_str1 == 'solar-park')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/Feedback')}}">
                <i class="fa-solid fa-comment"></i>
                <span>Feedback</span>
            </a>
        </li>
        @endif
        @if (Auth::guard('state-implementing-agency')->check())
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
                <a class="nav-link  @if($query_str1 == '')active @endif"
                    href="{{URL::to('/'.Auth::getDefaultDriver())}}">
                    <i class="fa-solid fa-table-cells-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav22" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-users"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav22" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class=" @if($query_str1 == 'Agency') active @endif">
                        <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency')}}">
                            <i class="fa-solid fa-circle"></i><span>Agencies</span>
                        </a>
                    </li>
                    <li class="nav-item  @if($query_str1 == 'Sub-Agency') active @endif">
                        <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/Sub-Agency')}}">
                            <i class="fa-solid fa-circle"></i><span>SPDs</span>
                        </a>
                    </li>
                    <li class="nav-item   @if($query_str1 == 'Agency') Bidder @endif">
                        <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/Bidder')}}">
                            <i class="fa-solid fa-circle"></i><span>Bidders</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav21" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-file-lines"></i><span>Tendering</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav21" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item @if($query_str1 == 'Tenders') active @endif">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Tenders')}}" class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Submitted Tenders</span>
                        </a>
                    </li>

                    <li class="nav-item @if($query_str1 == 'Tenders') active @endif">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Tenders/Add')}}" class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Add Tender</span>
                        </a>
                    </li>

                    <li class="nav-item @if($query_str1 == 'ReverseAuction') active @endif">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/ReverseAuction')}}"
                            class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Reverse Auction</span>
                        </a>
                    </li>

                    <li class="nav-item @if($query_str1 == 'SelectedBidder') active @endif">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/SelectedBidder')}}"
                            class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Selected Bidders</span>
                        </a>
                    </li>

                    <li class="nav-item @if($query_str1 == 'ProjectLocation') active @endif">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/ProjectLocation')}}"
                            class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Project Location</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#tables-nav222" data-bs-toggle="collapse"
                            href="#">
                            <i class="fa-solid fa-circle"></i><span>Signing Of PPA/PSA</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="tables-nav222" class="nav-content collapse " data-bs-parent="#sidebar-nav1"
                            style="padding-left: 10px;">


                            <li class="nav-item  @if($query_str1 == 'SigningOfPSA') active @endif">
                                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/SigningOfPSA')}}"
                                    class="nav-link collapsed">
                                    <i class="fa-solid fa-circle"></i><span>Signing Of PSA</span>
                                </a>
                            </li>

                            <li class="nav-item   @if($query_str1 == 'SigningOfPPA') active @endif">
                                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/SigningOfPPA')}}"
                                    class="nav-link collapsed">
                                    <i class="fa-solid fa-circle"></i><span>Signing Of PPA</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item @if($query_str1 == 'LOA-LOI') active @endif ">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/LOA-LOI')}}" class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>LOI/LOA</span>
                        </a>
                    </li>
                    <li class="nav-item @if($query_str1 == 'CancelTender') active @endif ">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/CancelTender')}}" class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Cancel Tender</span>
                        </a>
                    </li>
                    <li class="nav-item @if($query_str1 == 'TenderCommissioning')active @endif">
                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/TenderCommissioning')}}"
                            class="nav-link collapsed">
                            <i class="fa-solid fa-circle"></i><span>Commissioning</span>
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
                    <li class=" @if($query_str1 == 'Agency') active @endif">
                        <a class="nav-link collapsed"
                            href="{{URL::to('/'.Auth::getDefaultDriver().'/Under-Implementation')}}">
                            <i class="fa-solid fa-circle"></i><span>Add Implementation Details</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-commissioned" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-truck-fast"></i><span>Commissioned Details</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-commissioned" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class=" @if($query_str1 == 'Agency') active @endif">
                        <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/Commissioned')}}">
                            <i class="fa-solid fa-circle"></i><span>Add Commissioned Details</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" @if($query_str1 == 'TenderReport') active @endif">
                <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/TenderReport')}}">
                    <i class="fa-solid fa-file"></i><span>Tender Report</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link @if($query_str1 == 'feedback')active @endif"
                    href="{{URL::to('/'.Auth::getDefaultDriver().'/feedback')}}">
                    <i class="fa-solid fa-folder-open"></i>
                    <span>Feedback</span>
                </a>
            </li>

        </ul>


        @endif

        @if (Auth::guard('reia')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'schemes')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/schemes')}}">
                <i class="fa-solid fa-users"></i>
                <span>Schemes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'bidder')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/bidder')}}">
                <i class="fa-solid fa-users"></i>
                <span>Bidder</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'progress-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/progress-report')}}">
                <i class="fa-solid fa-users"></i>
                <span>Monthly Progress Report</span>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'reports')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency')}}">
                <i class="fa-solid fa-building"></i>
                <span>Report</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'feedback')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/feedback')}}">
                <i class="fa-solid fa-folder-open"></i>
                <span>Feedback</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'notifications')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/notifications')}}">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'edit-profile')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/edit-profile')}}">
                <i class="fa-regular fa-address-card"></i>
                <span>My Profile</span>
            </a>
        </li> -->
        @endif

        @if (Auth::guard('stu-users')->check())

        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'progress-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/progress-report')}}">
                <i class="fa-solid fa-list-check"></i>
                <span>Monthly Progress Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'stu-project-list')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/stu-project-list')}}">
                <i class="fa-solid fa-diagram-project"></i>
                <span>Manage Project</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'feedback')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/feedback')}}">
                <i class="fa-solid fa-folder-open"></i>
                <span>Feedback</span>
            </a>
        </li>
        <!-- 
            <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'reports')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency')}}">
                <i class="fa-solid fa-building"></i>
                <span>Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'notifications')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/notifications')}}">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'edit-profile')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/edit-profile')}}">
                <i class="fa-regular fa-address-card"></i>
                <span>My Profile</span>
            </a>
        </li> -->



        @endif



        @if (Auth::guard('seci')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'recieved-progress-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/solar_park_applications')}}">
                <i class="fa-solid fa-user-check"></i>
                <span>Progress Report</span>
            </a>
        </li>
        @endif


        @if (Auth::guard('gecdeveloper')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'my-progress-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/progress-report')}}">
                <i class="fa-solid fa-users"></i>
                <span>Progress Report</span>
            </a>
        </li>
        @endif
        @if (Auth::guard('gecmnre')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1 == 'my-progress-report')active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/gec-progress-report')}}">
                <i class="fa-solid fa-users"></i>
                <span>GEC Developer Report</span>
            </a>
        </li>
        @endif



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
            <a class="nav-link @if($query_str1==NULL) active @endif" href="{{URL::to('/'.Auth::getDefaultDriver())}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('developer')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1==NULL) active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/my-progress-report')}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Progress Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($query_str1==NULL) active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/consolidate-report')}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Consolidate Report</span>
            </a>
        </li>
        @endif
        @if (Auth::guard('mnre')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1==NULL) active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/progress-report')}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Recieved Report</span>
            </a>
        </li>
        @endif
        @if (Auth::guard('state-implementing-agency')->check())
        <li class="nav-item">
            <a class="nav-link @if($query_str1==NULL) active @endif"
                href="{{URL::to('/'.Auth::getDefaultDriver().'/recieved-progress-report')}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Progress Report Received</span>
            </a>
        </li>
        @endif
    </ul>
</aside> -->