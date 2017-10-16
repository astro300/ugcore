<?php $__env->startSection('masterTitle'); ?>
    Roles Opciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Asignaci&oacute;n de Opciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Manipulaci&oacute;n del Men&uacute; del sistema
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

    <div class="col-lg-8 col-lg-offset-2">

        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">Asignaci&oacute;n de Opciones al
                    Rol <?php echo $objRoles->name; ?></h5>
            </div>
            <h6 class="text-warning text-center text-uppercase text-bold">**Las modificaciones que realice en esta opci&oacute;n
                pueden afectar a los usuarios**</h6>


            <?php echo Form::open(['route'=> ['admin.roles.saverolesoptions',$objRoles],'method'=>'POST']); ?>

            <div class="panel-body">
                <div id="divOptionsProfiles" style="text-align:left">
                    <?php echo $options_roles ?>
                </div>
            </div>
            <div class="panel-footer text-right">
                <a href="<?php echo e(route('admin.roles.index')); ?>"
                   class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>


            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterJsCustom'); ?>
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>