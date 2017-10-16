<?php $__env->startSection('masterTitle'); ?>
   Notificaciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
      <?php if(empty($exception->getMessage())): ?>
           Acceso No Autorizado
           <?php else: ?>
          <?php echo e($exception->getMessage()); ?>

      <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   No puede realizar operaciones en esta opci&oacute;n su rol no lo permite
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="error-page">
        <h2 class="headline text-red">401</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! No tienes permisos.</h3>

            <p>
                Algo ha ido mal. No tienes los permisos necesarios para continuar con esta opci&oacute;n.
            </p>

            <a  href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> Inicio</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>