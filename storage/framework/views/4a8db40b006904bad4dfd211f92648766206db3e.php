<section class="intra_menu">
    <nav id="stick_nav" class="navbar navbar-expand-lg  navbar-light  ">

        <div class="container-fluid " style="padding-left: 0;">

            <a class="navbar-brand" href="javascript:void(0)"><img
                    src="<?php echo e(URL::asset('public/assets/images/solar-power-logo4.png')); ?>" alt="">
            </a>
            <a class="navbar-brand other_logos"><img src="<?php echo e(URL::asset('public/images/govt_mnre_logo.png')); ?>"
                    class="img-fluid"></a>
            <a class="navbar-brand other_logos azadi_logo"><img
                    src="<?php echo e(URL::asset('public/images/azdi_ka_mohtsv.png')); ?>" class="img-fluid" style="padding: 8px;">
                <img src="<?php echo e(URL::asset('public/images/G20logo.png')); ?>" style="padding: 4px;" class="img-fluid"></a>


            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse  justify-content-md-end" id="navbarCollapse">
                <ul class="navbar-nav    justify-content-end" style="width:100%;">
                    <li class="nav-item">
                        <a class="nav-link <?php if(Request::segment(1) == ''): ?>bg-active <?php endif; ?>" aria-current="page"
                            href="<?php echo e(url('/')); ?>"><button type="button"
                                class="btn btn-link <?php if(Request::segment(1) == ''): ?>active <?php endif; ?>"> <i
                                    class="fa-solid fa-house-chimney"></i>
                                <div>HOME</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Request::segment(1) == 'contact-us'): ?>bg-active <?php endif; ?>" aria-current="page"
                            href="<?php echo e(url('contact-us')); ?>"><button type="button"
                                class="btn btn-link <?php if(Request::segment(1) == 'contact-us'): ?>active <?php endif; ?>"> <i
                                    class=" fa-solid fa-address-card"></i>
                                <div>CONTACT US</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php if(Request::segment(1) == 'feedback'): ?>bg-active <?php endif; ?>" href="
                            <?php echo e(url('feedback')); ?>"><button type="button"
                                class="btn btn-link <?php if(Request::segment(1) == 'feedback'): ?>active <?php endif; ?>"> <i
                                    class=" fa-solid fa-file-lines"></i>
                                <div>FEEDBACK</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Request::segment(1) == 'sandes'): ?>bg-active <?php endif; ?>"
                            href="<?php echo e(url('sandes')); ?>"><button type="button"
                                class="btn btn-link <?php if(Request::segment(1) == 'sandes'): ?>active <?php endif; ?>"> <img
                                    src="<?php echo e(URL::asset('public/images/sandeshApp.png')); ?>" style="width: 20px;" class="">
                                <div>SANDES APP</div>
                            </button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Request::segment(1) == 'whatsNew'): ?>bg-active <?php endif; ?>"
                            href="<?php echo e(url('whatsNew')); ?>"><button type="button"
                                class="btn btn-link <?php if(Request::segment(1) == 'whatsNew'): ?>active <?php endif; ?>"> <i
                                    class=" fa-solid fa-bell"></i>
                                <div>WHATS'S NEW</div>
                            </button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(Request::segment(1) == 'log-in'): ?>bg-active <?php endif; ?>
                        <?php if(Request::segment(1) == 'login'): ?>bg-active <?php endif; ?>
                        <?php if(Request::segment(1) == 'admin-log-in'): ?>bg-active <?php endif; ?>" href="#" role="button"
                            data-bs-toggle="dropdown"><button type="button" class="btn btn-link <?php if(Request::segment(1) == 'log-in'): ?>active <?php endif; ?>
                                <?php if(Request::segment(1) == 'login'): ?>active <?php endif; ?>
                                <?php if(Request::segment(1) == 'admin-log-in'): ?>active <?php endif; ?>"> <i
                                    class=" fa-solid fa-arrow-right-to-bracket"></i>
                                <div>LOGIN</div>
                            </button>

                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?php echo e(URL::to('/log-in')); ?>">SPPD's</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('login')); ?>">SNA/SIA, REIA, CTU/STU</a></li>

                            <li><a class="dropdown-item" href="<?php echo e(URL::to('/admin-log-in')); ?>">MNRE</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(Request::segment(1) == 'user-registration'): ?>bg-active <?php endif; ?>"
                            href="<?php echo e(URL('user-registration')); ?>"><button type="button"
                                class="btn btn-link <?php if(Request::segment(1) == 'user-registration'): ?>active <?php endif; ?>"> <i
                                    class=" fa-solid fa-file-signature"></i>
                                <div>REGISTER</div>
                            </button></a>
                    </li>

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




// <?php echo e(Request::segment(1)); ?>





// $('.nav-link').on('click', function() {
//     //    Remove .active class from all .tab class elements
//     $('.nav-link').removeClass('active');
//     //    Add .active class to currently clicked element
//     $(this).addClass('active');
// });
</script><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/layouts/partials/frontend/_header.blade.php ENDPATH**/ ?>