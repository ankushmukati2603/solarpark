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

                <!-- <a class="nav-link nav-icon" href="#">
                    <i class="fa-solid fa-bell"></i><i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a> -->
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

                    <!-- <li>
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
                    </li> -->
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
</header>