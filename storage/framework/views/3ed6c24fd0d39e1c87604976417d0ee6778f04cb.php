<div class="modal fade" id="consumerInstallerModal" role="dialog" aria-labelledby="consumerInstallerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="consumerInstallerForm">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="consumerInstallerModalLabel">Consumer Installer Association</h4>
                </div>
                <div class="modal-body">
                    <?php if(isset($installers)): ?>
                        <div class="form-group">
                            <label for="">Select Installer</label>
                            <select class="form-control required" name="installer_id">
                                <option value="" selected disabled>Select Installer</option>
                                <?php $__currentLoopData = $installers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($installer->id); ?>"><?php echo e($installer->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">System Priority</label>
                            <select class="form-control required" name="priority">
                                <option value="" selected disabled>Select Priority</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Associate</button>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH D:\xampp_new\htdocs\solar_park\resources\views/modals/consumerInstallerAssociation.blade.php ENDPATH**/ ?>