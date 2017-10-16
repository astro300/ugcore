<?php $__env->startSection('masterTitle'); ?>
    MODULO PRE-PROFESIONALES
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    USUARIOS ADMINISTRADORES PREPROFESIONALES
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel de creación de usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-8 col-lg-offset-2">
        <?php if(!$flag=="true"): ?>
            <div class="panel panel-primary panel-flat">
                <div class="panel-heading">
                    CREAR USUARIOS ADMINISTRADORES PRE-PROFESIONALES
                </div>
                <div class="panel-body">
                    <?php if($Nameusers==""): ?>
                        <?php echo Form::open(['route'=> ['Preprofessional.superadmin.shearch'],'method'=>'POST', 'class'=>'header-search-wrapper']); ?>

                        <div class="input-group content-group" style="margin-bottom: 10px !important;">
                            <div class="has-feedback has-feedback-left">
                                <input class="form-control input-xlg" placeholder="INGRESAR CÉDULA" name="document" id="document" type="text" required="required" onkeypress="return verifyKeyPressPattern(event, /[0-9]/,'#document')" >

                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-muted text-size-base"></i>
                                </div>
                            </div>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    <?php else: ?>
                        <?php echo Form::open(['route'=> ['Preprofessional.superadmin.store',$documentUSers,$Nameusers,$EmailUsers],'method'=>'POST', 'class'=>'form-horizontal']); ?>

                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                <?php echo Form::label('document','CÉDULA:',["class"=>"text-bold control-label"]); ?>

                            </div>
                            <div class="col-lg-9">
                                <?php echo Form::text('document', $documentUSers,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                <?php echo Form::label('users','NOMBRES:',["class"=>"text-bold control-label"]); ?>

                            </div>
                            <div class="col-lg-9">
                                <?php echo Form::text('users', $Nameusers,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                <?php echo Form::label('facultie','FACULTAD:',["class"=>"text-bold control-label"]); ?>

                            </div>
                            <div class="col-lg-9">
                                <?php echo Form::select('faculties',$faculties,null,["class"=>"select2" ,"id"=>"faculties","placeholder"=>"- seleccione facultad -","required"=>"required"]); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                <?php echo Form::label('careers','CARRERA:',["class"=>"text-bold control-label"]); ?>

                            </div>
                            <div class="col-lg-9">
                                <?php echo Form::select('careers',[],null,["class"=>"select2","id"=>"careers","placeholder"=>"- seleccione carrera -","required"=>"required"]); ?>

                            </div>
                        </div>
                        </br>
                        <div class="form-group" style="text-align: center;">
                            <div class="col-md-6">
                                <div class="text-right">
                                    <a href="<?php echo e(route('Preprofessional.superadmin.create')); ?>"
                                       class="btn btn-primary btn-labeled legitRipple"><b><i
                                                    class=" glyphicon glyphicon-plus"> </i></b>CREAR OTRO USUARIO</a>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="text-lefth">
                                    <?php echo Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                                </div>
                            </div>
                        </div>
                </div>
                <?php echo Form::close(); ?>

                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datepicker/bootstrap-datepicker.js'); ?>

    <?php echo Html::script('plugins/timepicker/bootstrap-timepicker.js'); ?>

    <?php echo Html::script('js/modules/preprofesionales/preprofessional.js'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('plugins/datepicker/datepicker3.css'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>