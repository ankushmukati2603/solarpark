<header id="header" class="header fixed-top d-flex align-items-center dashboard_header dashboard3">

    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center navbar-brand">
            <!-- <img src="{{ URL::asset('public/assets/images/solar-power-logo4.png')}}" alt=""> -->
            <span style="color: green;">
                @if(Auth::guard('developer')->check()) <img
                    src="{{ URL::asset('public/assets/images/solar-park-logo.png')}}" alt="">
                @else
                <img src="{{ URL::asset('public/assets/images/solar-power-logo4.png')}}" alt="">
                @endif
            </span>
            <!-- F:\xampp\htdocs\solar_park\public\assets\images\solar-power-logo4.png -->

            <span class="d-none d-lg-block"></span>
        </a>
        <span class="togl_sidebr"><i class="fa-solid fa-chevron-right toggle-sidebar-btn"></i></span>
    </div>

    <div class="gov-india other_logos">
        <img src="{{ URL::asset('public/images/govt_mnre_logo.png')}}" class="img-fluid">
        <a class=" other_logos azadi_logo"><img src="{{ URL::asset('public/images/azdi_ka_mohtsv.png')}}"
                class="img-fluid" style="padding: 8px;">
            <img src="{{ URL::asset('public/images/G20logo.png')}}" style="padding: 4px;" class="img-fluid"></a>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3 hide">
                <a class="nav-link nav-icon" href="#" style="background: #085b0a;
                   border-radius: 5px;" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">

                            <span>dummy</span>
                        </a>
                    </li>
            </li>
        </ul>
        </li>
        <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="{{ URL::asset('public/images/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2"> <small>
                        Welcome</small><br>{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-item d-flex align-items-center">
                    <span id="datetime"></span>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/edit-profile')}}">
                        <i class="bi bi-person"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}">
                        <i class="bi bi-person"></i>
                        <span>Change Password</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item ">
            <!-- <a href="javascript:;" onclick="$('#logout').trigger('click')" class="nav-link nav-icon"><i
                    class="fa-solid fa-power-off"></i></a> -->
            <a href="{{ route('log-out') }}" class="nav-link nav-icon"><i class="fa-solid fa-power-off"></i></a>
            <!-- <form method="POST" id="formAjax" action="{{ route('logout') }}">
                @csrf
                <input type="submit" id='logout' name="submit" style="display:none" id="">
            </form> -->
            </a>
        </li>
        </ul>
    </nav>
</header>














































<!-- 
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{URL::asset('public/assets/img/logo.png')}}" alt="">
            <span class="d-none d-lg-block"></span>
        </a>
        <span class="togl_sidebr"><i class="fa-solid fa-chevron-right toggle-sidebar-btn"></i></span>
    </div>

    <ul class="gov-india">
        <li><span class="responsive_go_hindi" lang="hi">भारत सरकार</span><br><span
                class="li_eng responsive_go_eng">Government of India</span></li>

    </ul>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item ">

                <a class="nav-link nav-icon" href="#">
                    <i class="fa-solid fa-bell"></i><i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a>
            </li>



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{asset('public/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"> <small> Welcome</small><br>
                        {{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-item d-flex align-items-center">
                        <span id="datetime"></span>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{URL::to('/'.Auth::getDefaultDriver().'/edit-profile')}}">
                            <i class="bi bi-person"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}">
                            <i class="bi bi-person"></i>
                            <span>Change Password</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('privacy-policy') }}">
                            <i class="bi bi-person"></i>
                            <span>Privacy Policy</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('terms-of-use') }}">
                            <i class="bi bi-person"></i>
                            <span>Terms of use</span>
                        </a>
                    </li>
            </li>

        </ul>
        </li>
        <li class="nav-item ">
            <a href="javascript:;" onclick="$('#logoutForm').submit()" class="nav-link nav-icon"><i
                    class="fa-solid fa-power-off"></i></a>
            <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                @csrf
            </form>
            </a>
        </li>
        </ul>
    </nav>
</header> -->