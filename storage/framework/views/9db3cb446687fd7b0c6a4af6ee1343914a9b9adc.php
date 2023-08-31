<?php if(session('status')): ?>
<div id="successmsg" class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div id="failmsg" class="alert alert-danger" role="alert">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>
<script>
window.setTimeout(function() {
    $("#successmsg, #failmsg").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);
</script><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/layouts/partials/backend/_flash.blade.php ENDPATH**/ ?>