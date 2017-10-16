<?php if(!empty($errors)): ?>
    <?php if(count($errors->all())>0): ?>
        <div class="modal fade" id="modalerrors" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog  type-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header headerError">
                        <h4 class="modal-title" id="largeModalLabel">
                            <i class="fa fa-cog fa-spin fa-fw"></i>Errores de Validaci&oacute;n</h4>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="text-danger boldText"><?php echo e($message); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>


