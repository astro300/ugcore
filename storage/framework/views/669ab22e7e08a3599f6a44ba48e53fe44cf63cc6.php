<?php $__env->startSection('paddingDefaultFront','padding:200px 0 100px 0;'); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary primary-opacity">
            <div class="panel-heading"><label class="text-bold">Recuperar Contrase&ntilde;a</label></div>

            <div class="panel-body">
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('password.email')); ?>" autocomplete="off">
                    <?php echo e(csrf_field()); ?>



                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <label for="email" class="col-md-3 control-label">Email:</label>

                        <div class="col-md-7">

                            <div class="input-group margin-bottom-sm">
                                <input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                                       required autofocus placeholder="Ingrese su email">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-send" aria-hidden="true"></i></span>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <?php echo app('captcha')->display(); ?>

                        </div>

                        <!-- /.col -->
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ENVIAR</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>