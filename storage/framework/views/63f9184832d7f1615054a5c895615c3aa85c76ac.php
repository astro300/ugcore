<?php $__env->startSection('masterTitle'); ?>
    Inicio
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Inicio
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Opciones disponibles en el Sistema.
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-md-8 col-md-offset-2">
        <div class="list-group" >
            <div class="list-group-item active"><i class="fa fa-cog fa-spin"></i> Opciones Encontradas</div>
            <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if($result['padre']!=null): ?>
                <div class="list-group-item"><a href="/master/<?php echo e($result['url']); ?>">
                        <i class="fa fa-check  text-danger"></i>
                        <i class="<?php echo e($result['icons']); ?>"></i><?php echo e($result['name']); ?>



                        &nbsp;&nbsp;&nbsp;<span class="badge bg-indigo-800">M&oacute;dulo <?php echo e($result['padre']); ?></span>

                    </a>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center">
                    <i class="fa fa-times fa-4x text-danger"></i><br/>NO HAY COINCIDENCIAS
                </div>
            <?php endif; ?>

        </div>
        <a class="btn btn-google btn-block" href="<?php echo e(route('home')); ?>"><i class="icon-undo2"></i>REGRESAR</a>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>