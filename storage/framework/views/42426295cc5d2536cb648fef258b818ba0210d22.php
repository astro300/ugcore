<?php $__env->startSection('paddingDefaultFront','padding:200px 0 100px 0;'); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary primary-opacity">
            <div class="panel-heading"><label class="text-bold">Accesos al Sistema</label></div>

            <div class="panel-body">
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo session('status'); ?>

                    </div>
                <?php endif; ?>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>" autocomplete="off">
                    <?php echo e(csrf_field()); ?>



                    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <label for="name" class="col-md-4 control-label">Usuario:</label>

                        <div class="col-md-6">

                            <div class="input-group margin-bottom-sm">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"
                                       required autofocus placeholder="Ingrese C&eacute;dula/Pasaporte">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                            </div>


                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <label for="password" class="col-md-4 control-label">Clave:</label>

                        <div class="col-md-6">

                            <div class="input-group margin-bottom-sm">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Ingrese Clave">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>><b>
                                        Recordar Clave</b>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ACCESO</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                </div>
            <div class="panel-footer">
                <div class="row">
                <div class="col-md-8 col-md-offset-4 text-right">
                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                        Recuperar Contrase&ntilde;a?
                    </a>
                </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterJsCustom'); ?>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="js/modules/security/auth.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <link rel="stylesheet" href="plugins/iCheck/square/red.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>