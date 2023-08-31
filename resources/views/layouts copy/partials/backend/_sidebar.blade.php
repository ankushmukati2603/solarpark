<?php
    $segments = request()->segments();
   
    $query_str1= (!empty($segments[1]))? $segments[1] : '';
?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link @if($query_str1==NULL) active @endif" href="{{URL::to('/'.Auth::getDefaultDriver())}}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('beneficiary')->check())
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
</aside>