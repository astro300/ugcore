<?php $__env->startSection('masterTitle'); ?>
   Usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
     Usuarios del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   Panel de creaci&oacute;n de usuarios ingrese los campos necesarios
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainContent'); ?>
<div class="col-lg-8 col-lg-offset-2">

<?php echo Form::open(['route'=> 'admin.users.store','method'=>'POST', 'class'=>'form-horizontal']); ?>

                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">Creaci&oacute;n de Usuarios</h5>
                   </div>
                  <div class="panel-body">

                    <div class="form-group">
                     <?php echo Form::label('cedula','C&eacute;dula Usuario:',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                      <div class="col-lg-9">
                         <?php echo Form::text('cedula', null,  ["required"=>"required","class"=>"form-control" ]); ?>

                      </div>
                    </div>

                     <div class="form-group">
                     <?php echo Form::label('nombres','Nombres :',["class"=>"text-bold col-lg-3 control-label"]); ?>

                      <div class="col-lg-9">
                         <?php echo Form::text('nombres', null,  ["required"=>"required","class"=>"form-control" ]); ?>

                      </div>
                    </div>
                      <div class="form-group">
                          <?php echo Form::label('apellidos','Apellidos:',["class"=>"text-bold col-lg-3 control-label"]); ?>

                          <div class="col-lg-9">
                              <?php echo Form::text('apellidos', null,  ["required"=>"required","class"=>"form-control" ]); ?>

                          </div>
                      </div>

                     <div class="form-group">
                  <?php echo Form::label('password','Clave Usuario: ',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                     <div class="col-lg-9">
                     <?php echo Form::password('password', ["required"=>"required","class"=>"form-control" ]); ?>

                    </div> 
                     </div>
                  


                    <div class="form-group">
                     <?php echo Form::label('email','Email: ',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                         <div class="col-lg-9">
                          <?php echo Form::email('email', null,["required"=>"required","class"=>"form-control" ]); ?>

                        </div>
                    </div>

                      <div class="form-group">
                          <?php echo Form::label('status','Sexo:',array("class" => "text-bold col-lg-3 control-label")); ?>

                          <div class="col-lg-9">
                              <?php echo Form::select('sexo',['1'=>'Masculino','0'=>'Femenino'],null,
                              ["class"=>"form-control select2" ,"id"=>"sexo"]); ?>


                          </div>
                      </div>

                   <div class="form-group">
                         <?php echo Form::label('status','Estado:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                          <?php echo Form::select('status',Config::get('dataselects.status'),null,["class"=>"form-control select2" ,"id"=>"status"]); ?>

                         
                        </div>  
                    </div>
                   

                    <div class="text-right">
                   
                     <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                     
                      <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                            
                           

                   
                  </div>
                </div></div>
             <?php echo Form::close(); ?>  

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>