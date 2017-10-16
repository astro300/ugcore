<?php $__env->startSection('masterTitle'); ?>
   Opciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
     Opciones del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   Panel de creaci&oacute;n de opciones ingrese los campos necesarios
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>


<div class="col-lg-8 col-lg-offset-2">
<?php echo Form::open(['route'=> 'admin.options.store','method'=>'POST', 'class'=>'form-horizontal']); ?>

 <input type="hidden" id="moduleaction" value="optionsform"/>
                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE OPCIONES</h5>
                   </div>
                  <div class="panel-body">
                    <div class="form-group">
                     <?php echo Form::label('optionid','Opci&oacute;n Padre:',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                      <div class="col-lg-9">

                       <?php echo Form::select('optionid', ['0'=>'-Seleccione un Padre-']+$options, null,['class' => 'select2']); ?>

                      </div>
                    </div>
                    <div class="form-group">
                         <?php echo Form::label('name','Nombre Opcion:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('name', null,["required"=>"required","class"=>"form-control" ]); ?>

                        </div>  
                    </div>
                    
                    <div class="form-group">
                         <?php echo Form::label('prefix','Prefijo:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::number('prefix', null,["required"=>"required","class"=>"form-control" ]); ?>

                        </div>  
                    </div>
                      
                    <div class="form-group">
                         <?php echo Form::label('url','URL de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('url', null,["class"=>"form-control" ]); ?>

                        </div>  
                    </div>

                    <div class="form-group">
                         <?php echo Form::label('parameters','Par&aacute;metros de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('parameters', null,["class"=>"form-control" ]); ?>

                        </div>  
                    </div>


                    <div class="form-group">
                         <?php echo Form::label('icons','&Iacute;cono de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('icons', null,["class"=>"form-control" ]); ?>

                        </div>  
                    </div>

                    <div class="form-group">
                         <?php echo Form::label('status','Estado de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                          <?php echo Form::select('status',Config::get('dataselects.status'),null,["class"=>"select2" ,"id"=>"status"]); ?>

                         
                        </div>  
                    </div>


                    <div class="text-right">
                   
                     <a href="<?php echo e(route('admin.options.index')); ?>" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                     
                      <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                            
                           

                   
                  </div>
                </div></div>
             <?php echo Form::close(); ?>  
</div>

<?php $__env->stopSection(); ?>



 

<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>