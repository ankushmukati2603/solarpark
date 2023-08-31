<header class="main-header">
    <!-- Logo -->
    <a href="{{URL::to('/'.Auth::getDefaultDriver())}}" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <img class="dash-logo" src="{{URL::asset('public/images/logo.png')}}">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class=""><b>Welcome {{ Auth::user()->name }}</b></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                        <p>
                          <span><b>{{ Auth::user()->name }}</b></span><br>
                          <span></span><span id="datetime" style="font-size: 12px;line-height: 30px;"></span>
                        </p>
                      </li>
                      <li class="user-footer">
                        <div class="plr-10">
                            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/edit-profile')}}"" class="">Edit Profile</a>
                        </div>
                        <div class="plr-10">
                          <a href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}" class="">Change Password</a>
                        </div>
                        <div class="plr-10">
                            <a href="#" onclick="$('#logoutForm').submit()" class="error">Sign out <i class="fa fa-sign-out"></i></a>
                            <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </div>
                        <div>
                          <span style="float: right !important;font-size: 10px;">
                            <a style="font-size: 10px!important;color: #404040!important;" href="{{ url('privacy-policy') }}">Privacy Policy</a>
                             | 
                            <a style="font-size: 10px!important;color: #404040!important;" href="{{ url('terms-of-use') }}">Terms of use</a>
                          </span>
                        </div>
                      </li>
                    </ul>
                  </li>
            </ul>
        </div>
    </nav>
</header>
