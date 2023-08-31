<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ministry of New And Renewable Energy| Home</title>
    <!--Has all the sylesheets attached already!-->
    <?php echo $__env->make('layouts.partials.frontend._head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('public/css/style.css')); ?>">
    <!--Custom CSS or CSS Files for particular page-->
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body id="home-body" onload="">
    <div>
        <!--Application Header-->
        <?php echo $__env->make('layouts.partials.frontend._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Page Content Main-->
        <section id="content">
            <div id="loader" class="overlay" style="display:none">
                <div class="overlay__inner">
                    <div class="overlay__content">
                        <span class="spinner"></span>
                        <div class="clearfix mb-15"></div>
                        <span class="colorWhite">Processing, Please wait</span>
                    </div>
                </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </section>
        <?php if(Session::has('msg')): ?>
        <div class="clearfix"></div>
        <?php echo $__env->make('layouts.partials.modals.msgModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->make('layouts.partials.modals.helpDeskModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="clearfix"></div>
        <!--Footer of Application-->
        <?php echo $__env->make('layouts.partials.frontend._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!--Has all the scripts already attached-->
    <?php echo $__env->make('layouts.partials.frontend._base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--Custom scripts for particular pages-->
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/layouts/masters/home.blade.php ENDPATH**/ ?>