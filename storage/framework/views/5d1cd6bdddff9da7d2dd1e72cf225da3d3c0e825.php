<?php $__env->startSection('masterTitle'); ?>
   Opciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
     Opciones del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
   Panel de edici&oacute;n de opciones ingrese los campos necesarios
<?php $__env->stopSection(); ?>



<?php $__env->startSection('mainContent'); ?>

<div class="col-lg-8 col-lg-offset-2">
<?php echo Form::open(['route'=> ['admin.options.update',$objOption],'method'=>'PUT', 'class'=>'form-horizontal']); ?>

 <input type="hidden" id="moduleaction" value="optionsform"/>
                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">EDICI&Oacute;N DE OPCIONES</h5>
                   </div>
                  <div class="panel-body">
                    <div class="form-group">
                     <?php echo Form::label('optionid','Opci&oacute;n Padre:',["class"=>"text-bold col-lg-3 control-label"]); ?>  
                      <div class="col-lg-9">
                       <?php echo Form::select('optionid',['0'=>'-Seleccione un Padre-']+$options, $objOption->optionid,['class' => 'select2']); ?>

                      </div>
                    </div>
                    <div class="form-group">
                         <?php echo Form::label('name','Nombre Opcion:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('name', $objOption->name,["required"=>"required","class"=>"form-control" ]); ?>

                        </div>  
                    </div>
                    
                    <div class="form-group">
                         <?php echo Form::label('prefix','Prefijo:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::number('prefix', $objOption->prefix,["required"=>"required","class"=>"form-control" ]); ?>

                        </div>  
                    </div>
                      
                    <div class="form-group">
                         <?php echo Form::label('url','URL de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('url', $objOption->url,["class"=>"form-control" ]); ?>

                        </div>  
                    </div>

                    <div class="form-group">
                         <?php echo Form::label('parameters','Par&aacute;metros de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('parameters', $objOption->parameters,["class"=>"form-control" ]); ?>

                        </div>  
                    </div>


                    <div class="form-group">
                         <?php echo Form::label('icons','&Iacute;cono de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                            <?php echo Form::text('icons', $objOption->icons,["class"=>"form-control" ]); ?>

                        </div>  
                    </div>

                    <div class="form-group">
                         <?php echo Form::label('status','Estado de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")); ?>  
                         <div class="col-lg-9">
                          <?php echo Form::select('status',Config::get('dataselects.status'),$objOption->status,["class"=>"select2" ]); ?>

                        </div>  
                    </div>
                    <div class="text-right">
                     <a href="<?php echo e(route('admin.options.index')); ?>" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                      <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> ACTUALIZAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                  </div>
                </div></div>
             <?php echo Form::close(); ?>  
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>