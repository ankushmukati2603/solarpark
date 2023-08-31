<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver())}}"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>
            {{-- Users --}}
            @if (Auth::guard('mnre')->check() || Auth::guard('state-implementing-agency')->check() ||
            Auth::guard('localbody')->check())
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Users</span></a>
                <ul class="treeview-menu">
                    @if (Auth::guard('mnre')->check())
                    <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/mnre-user-list')}}"><i
                                class="fa fa-user-plus"></i>MNRE Users</a></li>
                    <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/state-implementing-agency-list')}}"><i
                                class="fa fa-user-plus"></i>State Implementing Agencies</a></li>
                    @endif
                    @if (Auth::guard('mnre')->check() || Auth::guard('state-implementing-agency')->check())
                    <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/localbody-list')}}"><i
                                class="fa fa-user-plus"></i>Local Bodies</a></li>
                    @endif
                    @if (Auth::guard('mnre')->check() || Auth::guard('state-implementing-agency')->check() ||
                    Auth::guard('localbody')->check())
                    <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/installer-list')}}"><i
                                class="fa fa-user-plus"></i>Installers</a></li>
                    <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/inspector-list')}}"><i
                                class="fa fa-user-plus"></i>Inspectors</a></li>
                    @endif
                </ul>
            </li>
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/consumer-list')}}"><i class="fa fa-globe"></i>
                    <span>Consumer Interests</span></a>
            </li>
            <!-- small biogas intrest list -->
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/small-biogas-list')}}"><i class="fa fa-globe"></i>
                    <span>Small Biogas Intrests</span></a>
            </li>
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/medium-biogas-10KW-list')}}"><i
                        class="fa fa-globe"></i>
                    <span>Medium Biogas Intrests(Below10KW)</span></a>
            </li>
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/viewAbove-10KW')}}"><i class="fa fa-globe"></i>
                    <span>Medium Biogas Intrests(Above10KW)</span></a>
            </li>
            @endif
            @if (Auth::guard('installer')->check())
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/consumer-interest-form')}}"><i
                        class="fa fa-user-circle"></i> <span>Consumer Interest Form</span></a>
            </li>
            @endif
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/systems')}}"><i class="fa fa-gears"></i>
                    <span>Systems</span></a>
            </li>
            @if (Auth::guard('mnre')->check())
            <li>
                <a href="{{URL::to('/mnre/audit-trail')}}"><i class="fa fa-wrench"></i>
                    <span>Audit Trail</span></a>
            </li>
            @endif
            @if (Auth::guard('mnre')->check() || Auth::guard('state-implementing-agency')->check() ||
            Auth::guard('localbody')->check() || Auth::guard('installer')->check())
            <li>
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/system-maintenance')}}"><i class="fa fa-wrench"></i>
                    <span>Operation maintenance</span></a>
            </li>
            @endif
        </ul>
        <div id="side-sticker">
            <a href="https://faqs.solar/about-the-programme">
                <span><b>Developed under</b></span>
                <div class="clearfix"></div>
                <img class="w95 mb-5" src="{{URL::asset('public/images/footer.png')}}">
            </a>
        </div>
    </section>
</aside>