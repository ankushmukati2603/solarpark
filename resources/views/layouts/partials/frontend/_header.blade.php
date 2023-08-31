<section class="intra_menu">
    <nav id="stick_nav" class="navbar navbar-expand-lg  navbar-light  ">

        <div class="container-fluid " style="padding-left: 0;">

            <a class="navbar-brand" href="javascript:void(0)"><img
                    src="{{ URL::asset('public/assets/images/solar-power-logo4.png')}}" alt="">
            </a>
            <a class="navbar-brand other_logos"><img src="{{ URL::asset('public/images/govt_mnre_logo.png')}}"
                    class="img-fluid"></a>
            <a class="navbar-brand other_logos azadi_logo"><img
                    src="{{ URL::asset('public/images/azdi_ka_mohtsv.png')}}" class="img-fluid" style="padding: 8px;">
                <img src="{{ URL::asset('public/images/G20logo.png')}}" style="padding: 4px;" class="img-fluid"></a>


            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse  justify-content-md-end" id="navbarCollapse">
                <ul class="navbar-nav    justify-content-end" style="width:100%;">
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == '')bg-active @endif" aria-current="page"
                            href="{{url('/')}}"><button type="button"
                                class="btn btn-link @if(Request::segment(1) == '')active @endif"> <i
                                    class="fa-solid fa-house-chimney"></i>
                                <div>HOME</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'contact-us')bg-active @endif" aria-current="page"
                            href="{{url('contact-us')}}"><button type="button"
                                class="btn btn-link @if(Request::segment(1) == 'contact-us')active @endif"> <i
                                    class=" fa-solid fa-address-card"></i>
                                <div>CONTACT US</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  @if(Request::segment(1) == 'feedback')bg-active @endif" href="
                            {{url('feedback')}}"><button type="button"
                                class="btn btn-link @if(Request::segment(1) == 'feedback')active @endif"> <i
                                    class=" fa-solid fa-file-lines"></i>
                                <div>FEEDBACK</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'sandes')bg-active @endif"
                            href="{{url('sandes')}}"><button type="button"
                                class="btn btn-link @if(Request::segment(1) == 'sandes')active @endif"> <img
                                    src="{{ URL::asset('public/images/sandeshApp.png')}}" style="width: 20px;" class="">
                                <div>SANDES APP</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'whatsNew')bg-active @endif"
                            href="{{url('whatsNew')}}"><button type="button"
                                class="btn btn-link @if(Request::segment(1) == 'whatsNew')active @endif"> <i
                                    class=" fa-solid fa-bell"></i>
                                <div>WHATS'S NEW</div>
                            </button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'log-in')bg-active @endif
                        @if(Request::segment(1) == 'login')bg-active @endif
                        @if(Request::segment(1) == 'admin-log-in')bg-active @endif" href="#" role="button"
                            data-bs-toggle="dropdown"><button type="button" class="btn btn-link @if(Request::segment(1) == 'log-in')active @endif
                                @if(Request::segment(1) == 'login')active @endif
                                @if(Request::segment(1) == 'admin-log-in')active @endif"> <i
                                    class=" fa-solid fa-arrow-right-to-bracket"></i>
                                <div>LOGIN</div>
                            </button>

                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{URL::to('/log-in')}}">SPPD-Solar Park Project</a></li>
                            <li><a class="dropdown-item" href="{{url('login')}}">State/Central Agencies</a></li>
                            <li><a class="dropdown-item" href="{{url('gec-login')}}">GEC Developer</a></li>
                            <li><a class="dropdown-item" href="{{URL::to('/admin-log-in')}}">MNRE</a></li>
<!--                            <li><a class="dropdown-item" href="{{URL::to('/gec-admin-log-in')}}">GEC MNRE</a></li>-->
                            <!-- <li><a class="dropdown-item" href="{{URL::to('/secilog-in')}}">SECI</a></li> -->
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('/login-type')}}"><button type="button"
                                class="btn btn-link"> <i class=" fa-solid fa-arrow-right-to-bracket"></i>
                                <div>LOGIN</div>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{URL::to('/log-in')}}">DEVELOPER LOGIN</a></li>
                                <li><a class="dropdown-item" href="{{url('login')}}">ADMIN LOGIN</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'user-registration')bg-active @endif"
                            href="{{URL('user-registration')}}"><button type="button"
                                class="btn btn-link @if(Request::segment(1) == 'user-registration')active @endif"> <i
                                    class=" fa-solid fa-file-signature"></i>
                                <div>REGISTER</div>
                            </button></a>
                    </li>
                    <!-- <li>
                <a class="nav-link" href=""> <button type="button" class="btn btn-success">Register</button></a>
              </li>
              <li>
                <a class="nav-link" href=""> <button type="button" class="btn btn-outline-success">Login</button></a>
              </li> -->
                </ul>

            </div>
        </div>
    </nav>

</section>
<style>
.active {
    color: #ffd200 !important;
}

.bg-active {
    background: #0d6a0d;
}


/* .nav-link.active {
    background: #0c442b;
} */
</style>
<script>
// $(function() {
//     $("#navbarCollapse").navbarCollapse();
// });




// {{ Request::segment(1) }}




// $('.nav-link').on('click', function() {
//     //    Remove .active class from all .tab class elements
//     $('.nav-link').removeClass('active');
//     //    Add .active class to currently clicked element
//     $(this).addClass('active');
// });
</script>