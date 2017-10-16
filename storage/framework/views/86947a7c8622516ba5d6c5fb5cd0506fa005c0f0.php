<?php $__env->startSection('masterTitle'); ?>
   Usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
   Usuarios del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   Lista de los usuarios ingresados en el sistema acad&eacutemico
<?php $__env->stopSection(); ?>



<?php $__env->startSection('mainBox'); ?>
  <div class="col-lg-7">
      <a href="<?php echo e(route('admin.users.create')); ?>" class="btn bg-teal-400 btn-labeled legitRipple">
        <b><i class="icon-add"></i></b> Agregar
      </a>
  </div>
                        <div class="col-lg-5">
                           <?php echo Form::open(['route' => 'admin.users.index','method'=>'GET', 'class'=>'header-search-wrapper ']); ?>

                                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                                    <div class="has-feedback has-feedback-left">
                                        <?php echo Form::text('scope', $scope, [ "class"=>"form-control input-xlg" ,"placeholder"=>" C&eacute;dula Usuarios"]); ?>


                                        <div class="form-control-feedback">
                                            <i class="icon-search4 text-muted text-size-base"></i>
                                        </div>
                                    </div>
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
                                    </div>
                                </div>
                            <?php echo Form::close(); ?>

                        </div>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('mainContent'); ?>

<div class="table-responsive">
    <table class="table table-bordered bg-white table-hover">
                <thead>
                 <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                          <td><?php echo e($user->name); ?></td>

                          <td><?php echo e($user->email); ?></td>
                          <td>
                         <?php echo e(Config::get('dataselects.status')[$user->status]); ?>

                          </td>
                          <td>

                              <a data-placement="bottom"data-popup="tooltip" data-original-title="ROLES DE USUARIO" href="<?php echo e(route('admin.users.users_roles',$user->id)); ?>" class="label label-primary label-icon"><i class="icon-user-check"></i></a>

                              <a data-placement="bottom"data-popup="tooltip" data-original-title="EDITAR" href="<?php echo e(route('admin.users.edit',$user->id)); ?>" class="label bg-slate label-icon"><i class=" icon-pencil7"></i></a>
                                     &nbsp;                    
                              <a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="label label-warning warning-300 label-icon" onclick="return alertConfirmDelete('el permiso','<?php echo e(route('admin.users.destroy',$user->id)); ?>')"><i class="icon-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <td colspan="4" class="text-center">NO HAY REGISTROS</td>
                      <?php endif; ?>
                </tbody>
              </table>
</div>

<?php echo $users->render(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterCssCustom'); ?>
    <link href="<?php echo e(asset('css/datatables.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
                    
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>