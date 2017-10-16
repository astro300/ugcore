<?php $__env->startSection('masterTitle'); ?>
    Usuarios Roles
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Asignaci&oacute;n de Roles a los usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel de asignaci&oacute;n de Roles a los usuarios del sistema
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainContent'); ?>

    <div class="col-lg-10 col-lg-offset-1">

        <?php echo Form::open(['route'=> ['admin.users.store_roles',$objUser]]); ?>

        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold text-center">Panel de Administraci&oacute;n de Roles para <?php echo e($objUser->name); ?></h5>
            </div>
            <div class="panel-body">
                <input id="arrayRoleExists" type="hidden" value="<?php echo e($roleExists); ?>"/>
                <?php echo Field::select('roles', $roles, null,[
                       "class"=>"select2",'empty'=>'-Seleccione un Rol-','onchange'=>"getMenuByRole()",
                       'label'=>"Roles Disponibles:"]); ?>


                <div class="row">
                    <div class="col-lg-4">
                        <button type="button" onclick="getAddRoleUser()"
                                class="btn bg-pink-400 btn-raised btn-block">AGREGAR</button>
                    </div>
                    <div class="col-lg-8">
                        <h6 style="text-align: center;">
                            <b>MEN&Uacute; DISPONIBLE PARA EL ROL</b></h6>
                        <div id="dvMenu" style="text-align:left">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <hr/>
                        <div class="callout callout-info">
                            <i class="icon-users"></i> &nbsp; ROLES-ASIGNADOS

                            <p>Listado de Roles asignados al usuario <?php echo e($objUser->email); ?>.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <ul class="nav nav-stacked" id="ulNavRol">
                            <?php $__currentLoopData = $userRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li> <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox"  checked='checked' id='role_<?php echo e($key); ?>' name='role[]' value='<?php echo e($key); ?>'><b>
                                                <?php echo e($rol); ?></b>
                                        </label>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>


                </div>

            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                       class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                    class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                    <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>


    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('masterCssCustom'); ?>
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterJsCustom'); ?>
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo e(asset('js/modules/security/roles.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>