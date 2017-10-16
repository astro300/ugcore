<?php $__env->startSection('masterTitle'); ?>
   Opciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
   Opciones del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   Lista de las opciones ingresadas en el sistema acad&eacutemico
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainBox'); ?>
  <div class="col-lg-7">
      <a href="<?php echo e(route('admin.options.create')); ?>" class="btn bg-teal-400 btn-labeled legitRipple">
        <b><i class="icon-add"></i></b> Agregar
      </a>
  </div>
                        <div class="col-lg-5">
                           <?php echo Form::open(['route' => 'admin.options.index','method'=>'GET', 'class'=>'header-search-wrapper ']); ?>

                                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                                    <div class="has-feedback has-feedback-left">
                                        <?php echo Form::text('scope', $scope, [ "class"=>"form-control input-xlg" ,"placeholder"=>" Nombre Opciones"]); ?>


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
                    <th>Nombre</th>
                        <th>Prefijo</th>
                        <th>Url</th>
                        <th>Padre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                          <td><?php echo e($option->name); ?></td>
                          <td><?php echo e($option->prefix); ?></td>
                          <td><?php echo e($option->url); ?></td>
                          <td><?php echo e($option->father); ?></td>
                          <td>
                            <?php echo e(Config::get('dataselects.status')[$option->status]); ?>

                             
                          </td>
                          <td>

<a data-placement="bottom" data-popup="tooltip" data-original-title="EDITAR" href="<?php echo e(route('admin.options.edit',$option->id)); ?>" class="label bg-slate label-icon"><i class=" icon-pencil7"></i></a>
       &nbsp;                    
<a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="label label-warning warning-300 label-icon"
                                     onclick="return alertConfirmDelete('la opci&oacute;n','<?php echo e(route('admin.options.destroy',$option->id)); ?>')"><i class="icon-trash"></i></a></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
<?php echo $options->render(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterCssCustom'); ?>
    <link href="<?php echo e(asset('css/datatables.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

                    
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>