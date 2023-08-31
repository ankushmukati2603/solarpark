<?php $__env->startSection('content'); ?>
<section class="homepage_slider">
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class=""></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2" class=""></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active" style="position: relative;">
                <img src="<?php echo e(URL::asset('public/images/hrd_mainimg.jpg')); ?>" alt="" class="d-block" style="width:100%">
                <div class="carousel-caption">
                    <h3>Investing in Clean <br>
                        <span>Energy</span> Generation
                    </h3>
                    <!-- <p>Lorem Ipsum is simply dummy text</p> -->
                    <!-- <a href="<?php echo e(URL::to('/user-registration')); ?>" class="btn btn-success btn-lg"
                        style="margin-right: 8px;">Register</a> -->
                    <!-- <a href="<?php echo e(URL::to('/login-type')); ?>" class="btn btn-outline-success btn-lg"
                        style="margin-right: 8px;">Login</a> -->

                    <!-- <button type="button" class="btn btn-success btn-lg" style="margin-right: 8px;">Register</button> -->
                    <!-- <button style="margin-right: 8px;" type="button"
                        class="btn btn-outline-success btn-lg">Login</button> -->
                </div>
            </div>
            <div class="carousel-item" style="position: relative;">
                <img src="<?php echo e(URL::asset('public/images/hrd_mainimg.jpg')); ?>" alt="" class="d-block" style="width:100%">
                <div class="carousel-caption">
                    <h3>Investing in Clean <br>
                        <span>Energy</span> Generation
                    </h3>
                    <!-- <p>Lorem Ipsum is simply dummy text</p> -->
                    <!-- <button type="button" class="btn btn-success btn-lg" style="margin-right: 8px;">Register</button>
                    <button style="margin-right: 8px;" type="button"
                        class="btn btn-outline-success btn-lg">Login</button> -->
                </div>
            </div>
            <div class="carousel-item" style="position: relative;">
                <img src="<?php echo e(URL::asset('public/images/hrd_mainimg.jpg')); ?>" alt="" class="d-block" style="width:100%">
                <div class="carousel-caption">
                    <h3>Investing in Clean <br>
                        <span>Energy</span> Generation
                    </h3>
                    <!-- <p>Lorem Ipsum is simply dummy text</p> -->
                    <!-- <button type="button" class="btn btn-success btn-lg" style="margin-right: 8px;">Register</button>
                    <button style="margin-right: 8px;" type="button"
                        class="btn btn-outline-success btn-lg">Login</button> -->
                </div>
            </div>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <i class="fa-solid fa-angle-left"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <i class="fa-solid fa-angle-right"></i>
        </button>
    </div>
</section>
<section class="counter_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-lg-3 counter0" style="padding: 0;">
                        <img src="<?php echo e(URL::asset('public/images/wind.jpg')); ?>" class="img-fluid">

                    </div>
                    <div class="col-lg-3 col-md-4 counter1">
                        <div class="cmn_stng">
                            <img src="<?php echo e(URL::asset('public/images/counter2.png')); ?>" class="counter_img_cmn">
                            <!-- <img src="<?php echo e(URL::asset('public/images/counter1.png')); ?>" class="counter_img_cmn"> -->
                            <p class="value" akhi="">0</p>
                            <h5>Installed Capacity</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 counter1">
                        <div class="cmn_stng">
                            <img src="<?php echo e(URL::asset('public/images/counter1.png')); ?>" class="counter_img_cmn">
                            <!-- <img src="<?php echo e(URL::asset('public/images/counter2.png')); ?>" class="counter_img_cmn"> -->
                            <p class="value" akhi="">0</p>
                            <h5>Capacity Under Implementation</h5>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-4 counter1">
                        <div class="cmn_stng">
                            <img src="<?php echo e(URL::asset('public/images/counter3.png')); ?>" class="counter_img_cmn">
                            <p class="value" akhi="">0</p>
                            <h5>Capacity Under Tendering</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- <section class="solar_pwr_section2 pt-5">
    <div class="container-fluid px-5 pt-3 pb-5">

        <div class="row">
            <div class="col-xl-6 col-lg-12 animatedParent">
                <img src="<?php echo e(URL::asset('public/images/all_programs.png')); ?>" class="img-fluid animated fadeInLeft go">
            </div>
            <div class="col-xl-6 col-lg-12 pt-4">
                <div class="row animatedParent">
                    <div class="col-md-12  animated bounceIn go">
                        <div class="comn_heading ">
                            Who We Are

                        </div>
                        <p class=" pb-1 sub_hdng">Loram ipsam dummy headlines</p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12  animatedParent">
                        <div class=" animated fadeInDownShort go">
                            <h2>We are the Best-In-Class Products & Solutions</h2>
                        </div>
                    </div>
                    <div class="col-lg-12 animatedParent">
                        <div class=" animated fadeInDownShort go">

                            <p class="cstm_pdng_right">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer
                                took a galley of type and scrambled it to make a type specimen book. It has survived not
                                only five
                                centuries, but also the leap into electronic typesetting, remaining essentially
                                unchanged. It was
                                popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages, and more
                                recently with desktop publishing software like Aldus PageMaker including versions of
                                Lorem Ipsum.</p>
                            <p class="cstm_pdng_right">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer
                                took a galley of type and scrambled it to make a type specimen book. It has survived not
                                only five
                                centuries, but also the leap into electronic typesetting, remaining essentially
                                unchanged. It was
                                popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages, and more
                                recently with desktop publishing software like Aldus PageMaker including versions of
                                Lorem Ipsum.</p>
                            <h5> Lorem Ipsum Heading</h5>
                            <ul style="list-style-type: none; padding-left: 0;">
                                <li style="padding-bottom: 5px; font-size: 16px;"> <i
                                        class="fa-solid fa-circle-check list_check"></i>
                                    Lorem Ipsum is simply dummy text of text ever</li>
                                <li style="padding-bottom: 5px; font-size: 16px;"> <i
                                        class="fa-solid fa-circle-check list_check"></i>
                                    Lorem Ipsum is simply dummy text of the printing</li>
                                <li style="padding-bottom: 5px; font-size: 16px;"> <i
                                        class="fa-solid fa-circle-check list_check"></i>
                                    Lorem Ipsum is simply dummy text of the text ever</li>
                                <li style="padding-bottom: 5px; font-size: 16px;"> <i
                                        class="fa-solid fa-circle-check list_check"></i>
                                    Lorem Ipsum is simply dummy text of the printing</li>
                                <li style="padding-bottom: 5px; font-size: 16px;"> <i
                                        class="fa-solid fa-circle-check list_check"></i>
                                    Lorem Ipsum is simply dummy text </li>
                                <li style="padding-bottom: 5px; font-size: 16px;"> <i
                                        class="fa-solid fa-circle-check list_check"></i>
                                    Lorem Ipsum is simply dummy the printing</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- <section class="hrd_section3 pt-5">
    <div class="container-fluid px-5 pt-3 pb-5">

        <div class="row">
            <div class="col-xl-6 col-lg-12 left_blk animatedParent">
                <div class="animated fadeInLeft go">
                    <h3 class="comn_heading disclmr ">Benefits to Save Energy</h3>
                    <p class="disclmr">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum
                        has been the industry's
                        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                        scrambled it
                        to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining
                        essentially unchanged. It was popularised
                        in the 1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                        including
                        versions of Lorem Ipsum.</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 right_blk pt-5 pb-5">
                <div class="row pt-5 pb-5">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 animatedParent">
                                <div class="cmn_blk box1 animated fadeInDownShort go">
                                    <i class="fa-solid fa-leaf"></i>
                                    <h4>Renewable Energy</h4>
                                    <p>A cookie is a piece of software code that an internet web site sends to your
                                        browser when you
                                        access information at that site.
                                        This site does not use cookies.</p>
                                </div>
                            </div>

                            <div class="col-md-12 animatedParent">
                                <div class="cmn_blk box2 animated fadeInUpShort go">
                                    <i class="fa-solid fa-plug-circle-check"></i>
                                    <p>Your email address will only be recorded if you choose to send a message. It will
                                        only be used
                                        for the purpose for which you have provided
                                        it and will not be added to a mailing list.
                                        Your email address will not be used for any other purpose, and will not be
                                        disclosed, without your
                                        consent.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pt-5 pb-5">
                        <div class="row">
                            <div class="col-md-12 animatedParent">
                                <div class="cmn_blk box3 animated fadeInDownShort">
                                    <i class="fa-solid fa-bolt"></i>
                                    <h4>Life Sustainable</h4>
                                    <p>If you are asked for any other Personal Information you will be informed how it
                                        will be used if
                                        you choose to give it.
                                        If at any time you believe the principles referred to in this privacy statement
                                        have not been
                                        followed, or have any other
                                        comments on these principles, please send it to vasanta[dot]thakur[at]nic[dot]in
                                        (Dr. Vasanta
                                        Thakur- Scientist D ) or through the
                                        feedback page. Note: The use of the term "Personal Information" in this privacy
                                        statement refers
                                        to any information from which your
                                        identity is apparent or can be reasonably ascertained.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- <section class="animatedParent">
    <img src="<?php echo e(URL::asset('public/images/banner_hrd.png')); ?>" class="img-fluid animated fadeInDownShort"
        style="width: 100%;">
</section>
<section class="intra_mnre_section4 pt-5 pb-5">
    <div class="container-fluid px-5 pt-3 pb-5">
        <div class="row animatedParent">
            <div class="col-md-12 text-center animated bounceIn go">
                <div class="comn_heading ">

                    What People Says


                </div>
                <p class=" pb-5 sub_hdng ">Loram ipsam dummy headlines</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <section class="mnre_employes_says slider">
                    <div class="slide">
                        <div class="row pb-4">
                            <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                    src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i class="fa-solid fa-quote-left"></i>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been
                                    the industry's
                                    standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                    type and
                                    scrambled</div>
                                <i class="fa-solid fa-quote-right"></i>
                                <small>Faridabad <br><span class="name">-Gaurav Sharma</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="row pb-4">
                            <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                    src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i class="fa-solid fa-quote-left"></i>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been
                                    the industry's
                                    standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                    type and
                                    scrambled</div>
                                <i class="fa-solid fa-quote-right"></i>
                                <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="row pb-4">
                            <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                    src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i class="fa-solid fa-quote-left"></i>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been
                                    the industry's
                                    standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                    type and
                                    scrambled</div>
                                <i class="fa-solid fa-quote-right"></i>
                                <small>Delhi <br><span class="name">-Ekaaksh Sharma</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="row pb-4">
                            <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                    src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i class="fa-solid fa-quote-left"></i>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been
                                    the industry's
                                    standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                    type and
                                    scrambled</div>
                                <i class="fa-solid fa-quote-right"></i>
                                <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                            </div>
                        </div>
                    </div>



                </section>
                <section class="mnre_employes_says slider slick-initialized slick-slider"><button type="button"
                        data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style=""><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <div aria-live="polite" class="slick-list draggable">
                        <div class="slick-track"
                            style="opacity: 1; width: 5050px; transform: translate3d(-3030px, 0px, 0px);"
                            role="listbox">
                            <div class="slide slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true"
                                tabindex="-1" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true"
                                tabindex="-1" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Ekaaksh Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true"
                                tabindex="-1" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1"
                                role="option" aria-describedby="slick-slide00" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Faridabad <br><span class="name">-Gaurav Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1"
                                role="option" aria-describedby="slick-slide01" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1"
                                role="option" aria-describedby="slick-slide02" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Ekaaksh Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide slick-current slick-active" data-slick-index="3"
                                aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide03"
                                style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide slick-cloned slick-active" data-slick-index="4"
                                aria-hidden="false" tabindex="-1" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Faridabad <br><span class="name">-Gaurav Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide slick-cloned slick-active" data-slick-index="5"
                                aria-hidden="false" tabindex="-1" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Pankaj Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slick-slide slick-cloned" data-slick-index="6" aria-hidden="true"
                                tabindex="-1" style="width: 465px;">
                                <div class="row pb-4">
                                    <div class="col-lg-4 col-md-12 tstmnl_image_blk"><img
                                            src="<?php echo e(URL::asset('public/images/tstmnl_image.png')); ?>" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-12 tstmnl_text_blk"><i
                                            class="fa-solid fa-quote-left"></i>
                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been
                                            the industry's
                                            standard dummy text ever since the 1500s, when an unknown printer took a
                                            galley of type and
                                            scrambled</div>
                                        <i class="fa-solid fa-quote-right"></i>
                                        <small>Delhi <br><span class="name">-Ekaaksh Sharma</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"
                        role="button" style=""><i class="fa-solid fa-chevron-right"></i></button>
                </section>
            </div>
        </div>
    </div>
</section> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/frontend/home.blade.php ENDPATH**/ ?>