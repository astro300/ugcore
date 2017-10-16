<?php $__env->startSection('masterTitle'); ?>
   Roles
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
     Roles del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   Panel de creaci&oacute;n de Roles ingrese los campos necesarios
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<div class="col-lg-8 col-lg-offset-2">

  <?php echo Form::open(['route'=> 'admin.roles.store','method'=>'POST', 'class'=>'form-horizontal']); ?>

                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE ROLES</h5>
                   </div>
                  <div class="panel-body">
                    <div class="form-group">
                     <?php echo Form::label('nombre','Nombre Rol:',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                      <div class="col-lg-9">
                     <?php echo Form::text('nombre', null,  ["required"=>"required","class"=>"form-control" ]); ?>

                    </div>
                    </div>

                     <div class="form-group">
                     <?php echo Form::label('nombre_largo','Nombre Largo: ',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                     <div class="col-lg-9">
                                    <?php echo Form::text('nombre_largo', null,["required"=>"required","class"=>"form-control" ]); ?>

                    </div>  </div>
                    <div class="form-group">
                     <?php echo Form::label('descripcion','Descripcion: ',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                     <div class="col-lg-9">
                                    <?php echo Form::text('descripcion', null,["required"=>"required","class"=>"form-control" ]); ?>

                    </div>
                      </div>
                   

                    <div class="text-right">
                   
                     <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                     
                      <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                            
                           

                   
                  </div>
                </div></div>
             <?php echo Form::close(); ?>  
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>