<section class="bg-light">
    <div class="container">

        <div class="row top_header pt-2 pb-2">
            <div class="col-md-9 leftSide">
                <table>
                    <tr>
                        <td class="gov-india"><span class="responsive_go_hindi" lang="hi"><a target="_blank"
                                    href="javascript:void(0)" role="link">भारत सरकार</a></span><br><span
                                class="li_eng responsive_go_eng"><a target="_blank" href="javascript:void(0)"
                                    role="link">Government of India</a></span></td>
                        <td class="ministry"><a href="javascript:void(0)" onclick="menu('https://mnre.gov.in/');"
                                target="_blank" alt="Ministry of New And Renewable Energy"
                                title="Ministry of New And Renewable Energy"><span class="responsive_minis_hi"
                                    lang="hi">नवीन और नवीकरणीय ऊर्जा मंत्रालय</span></a>
                            <br><a href="javascript:void(0)" onclick="menu('https://mnre.gov.in/');" target="_blank"
                                alt="Ministry of New And Renewable Energy"
                                title="Ministry of New And Renewable Energy"><span
                                    class="li_eng responsive_minis_eng">Ministry of New And Renewable Energy</span></a>
                        </td>

                        <td class="amrit_mohtsv"><img src="{{ URL::asset('public/assets/img/azdi_ka_mohtsv.png') }}"
                                style="height: 40px; padding-left: 20px;"></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3 rightSide nav justify-content-end">
                <a class="hvr-hang" href=""><img src="{{ URL::asset('public/assets/img/meta_fb.png') }}"></a>
                <a class="hvr-hang" href=""><img src="{{ URL::asset('public/assets/img/twitter.png') }}"></a>
                <a class="hvr-hang" href=""><img src="{{ URL::asset('public/assets/img/linkedin.png') }}"></a>
                <a class="hvr-hang" href=""><img src="{{ URL::asset('public/assets/img/youtube.png') }}"></a>
                <a class="hvr-hang" href=""><img src="{{ URL::asset('public/assets/img/instagram.png') }}"></a>
            </div>
        </div>


    </div>
</section>
<section>
    <nav id="stick_nav" class="navbar navbar-expand-lg  navbar-light bg-light bgWhite rounded ">

        <div class="container">

            <a class="navbar-brand" href=""><img src="{{ URL::asset('public/assets/img/ALMM_logo.png') }}"
                    style="height: 60px;"> </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse  justify-content-md-end" id="navbarCollapse">
                <ul class="navbar-nav    mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('/')}}"><button type="button"
                                class="btn btn-link">Home</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('about-the-programmes')}}"><button type="button"
                                class="btn btn-link"> ABOUT THE
                                PROGRAMMES</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('downloads')}}"><button type="button"
                                class="btn btn-link">FORMS/DOWNLOADS</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;"><button type="button" class="btn btn-link"
                                data-bs-toggle="modal" data-bs-target="#myModal">HELP DESK</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('faqs')}}"><button type="button"
                                class="btn btn-link">FAQs</button></a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{URL('user-registration')}}"> <button type="button"
                                class="btn btn-success">Register</button></a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 16px;
                                    padding-left: 20px;
                                    padding-right: 20px;
                                    font-weight: 600; margin-top:7px ">
                                Login
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{URL::to('/log-in')}}">Beneficiary LOGIN</a></li>
                                <li><a class="dropdown-item" href="{{url('login')}}">Admin LOGIN</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                            </ul>
                        </div>
                    </li>
                    <!-- <li>
                        <a class="nav-link" href="{{url('login')}}"> <button type="button"
                                class="btn btn-outline-success">@if(Auth::check()) DASHBOARD @else LOGIN
                                @endif</button></a>

                    </li> -->
                </ul>

            </div>
        </div>
    </nav>

</section>

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Help Desk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="col-md-12">
                    <p><b>Biogas Division</b></p>
                    <p>
                        Sh. S. R. Meena <br>
                        Scientist D, <br>
                        <b>Email:</b> <a class="fs14" href="mailto:meena.sr@nic.in">meena.sr@nic.in</a> <br>
                        <b>Ph:</b> <a class="fs13" href="tel:01124360707">011-24360707; 011-24361920</a> <br>
                        <b>Extn.</b> 1047
                    </p>
                </div>
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div> -->

        </div>
    </div>
</div>


<!-- <nav id="homenav" class="navbar navbar-mnre navbar-fixed-top navbar-expand-lg navbar-light bg-light header">
    <div class="container-fluid pl-0">
        <div class="navbar-header col-md-4 col-sm-6 col-xs-6">
            <a class="navbar-brand" target="_blank" href="https://mnre.gov.in">
                <img class="ind_tri_color" src="{{URL::asset('public/images/tri_color_side.jpg')}}">
                <div class="home-logo-holder">
                    <img src="{{URL::asset('public/images/logo.png')}}">
                </div>
            </a>
        </div>
        <ul class="nav navbar-nav collapse navbar-collapse">
            <li class="{{ request()->route()->getName() == 'home' ? 'active' : '' }}"><a href="{{url('/')}}">HOME</a>
            </li>
            <li class="{{ request()->route()->getName() == 'about-the-programmes' ? 'active' : '' }}"><a
                    href="{{url('about-the-programmes')}}">ABOUT THE PROGRAMMES</a></li>
            <li class="{{ request()->route()->getName() == 'downloads' ? 'active' : '' }}"><a
                    href="{{url('downloads')}}">FORMS/DOWNLOADS</a></li>
            <li class="{{ request()->route()->getName() == 'downloads' ? 'active' : '' }}"><a
                    href="{{url('solarProjectData')}}">Solar Project Entry</a></li>
            <li class="{{ request()->route()->getName() == 'downloads' ? 'active' : '' }}"><a
                    href="{{url('developerData')}}">Developer Entry</a></li>
            <li><a data-toggle="modal" data-target="#helpDeskModal" href="#">HELP DESK</a></li>
            <li class="{{ request()->route()->getName() == 'faqs' ? 'active' : '' }}"><a href="{{url('faqs')}}">FAQs</a>
            </li>
            <li class="text-left {{ request()->is('login') ? 'active' : '' }}"><a
                    href="{{url('login')}}">@if(Auth::check()) DASHBOARD @else LOGIN @endif</a></li>
        </ul>
        <ul class="nav navbar-nav">
            <li><a class="glyphicon glyphicon-align-right visible-xs-block" onclick='OpenMenu();'></a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid mobile-menu">
    <div class="row">
        <div class="col-sm-12 pt-30">
            <button onclick='CloseMenu();'>X</button>
            <ul class="mobile-list">
                <li><a href="{{url('/')}}">HOME</a></li>
                <li><a href="{{url('about-the-programmes')}}">ABOUT THE PROGRAMMES</a></li>
                <li><a href="{{url('downloads')}}">FORMS/DOWNLOADS</a></li>
                <li><a href="#">HELP DESK</a></li>
                <li class="{{ request()->route()->getName() == 'faqs' ? 'active' : '' }}"><a
                        href="{{url('faqs')}}">FAQs</a></li>
                <li><a href="{{url('login')}}">@if(Auth::check()) DASHBOARD @else LOGIN @endif</a></li>
            </ul>
        </div>
    </div>
</div> -->