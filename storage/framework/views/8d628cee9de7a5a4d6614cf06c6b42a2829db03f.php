<?php $__env->startSection('masterTitle'); ?>
    MODULO PRE-PROFESIONALES
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    ADMINISTRADOR
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel Principal del Administrador
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php if(!$flag=="true"): ?>


            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary panel-flat">
                    <div class="panel-heading">
                        <div class="panel-title text-bold">ADMINISTRADOR</div>
                    </div>
                    <div class="panel-body">
                        <?php if($facultid==""): ?>
                        <?php echo Form::open(['route'=> 'preprofessional.prospects.indexadministratornew','method'=>'POST', 'class'=>'form-horizontal']); ?>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <?php echo Form::label('careers','CARRERA:',["class"=>"text-bold control-label"]); ?>

                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" name="carrers">
                                    <?php $__currentLoopData = $getresultevaluation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getresultevaluations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($getresultevaluations->COD_CARRERA); ?>"><?php echo e($getresultevaluations->NOMBRE_CARRERA); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div style="text-align: center;">
                                    <?php echo Form::button('<b><i class="glyphicon glyphicon-search"></i></b> BUSCAR', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>

                                </div>
                            </div>
                        </div>
                        <br>
                        <?php echo Form::close(); ?>

                        <?php else: ?>
                            <hr>

                            <div class="col-lg-12">
                                    <div class="col-md-6">
                                       <div class="box box-widget text-center">
                                            <div class="box-header " style="background-color: #ECF0F5">
                                                <h6><i class="fa fa-address-book-o fa-4x"></i></h6>
                                            </div>
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-sm-12 border-right">
                                                        <div class="description-block">
                                                            <a href="<?php echo e(route('preprofessional.prospects.index',[$facultid,$carrers])); ?>" class="btn btn-primary dropdown-toggle">SOLICITUDES</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box box-widget text-center">
                                            <div class="box-header" style="background-color: #ECF0F5">
                                                <h6><i class="fa fa-black-tie fa-4x"></i></h6>
                                            </div>
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-sm-12 border-right">
                                                        <div class="description-block">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-primary">PRÁCTICAS INST.</button>
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="<?php echo e(route('preprofessional.practices.index',[$facultid,$carrers])); ?>"><i class="glyphicon glyphicon-ok"></i>INSITUCIONES</a></li>
                                                                    <li><a href="<?php echo e(route('preprofessional.practices.documents',[$facultid,$carrers])); ?>"><i class="glyphicon glyphicon-upload"></i>SUBIR DOCUMENTOS</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>