<?php $__env->startSection('masterTitle'); ?>
    Tipos de Documentos Para Formulario
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Tipos de Documentos Para Formulario del Proceso de Selecci&oacute;n de Personal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Lista de Tipos de Documentos Para Formulario del Proceso de Selecci&oacute;n de Personal
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-5">
        <?php echo Form::open(['route'=> ['selection.typedocument.update',$objTypeDocument],'method'=>'PUT','enctype'=>"multipart/form-data"]); ?>

        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">TIPOS DE DOCUMENTOS</h5>
            </div>
            <div class="panel-body">

                <?php echo Field::text('name',$objTypeDocument->name,['label'=>'Nombre:','required'=>'required']); ?>

                <?php echo Field::text('description',$objTypeDocument->description,['label'=>'Descripci&oacute;n: ','required'=>'required']); ?>

                <?php echo Field::text('prefix',$objTypeDocument->prefix,['label'=>'Prefijo: ','required'=>'required']); ?>

                <?php echo Field::text('nametable',$objTypeDocument->nametable,['label'=>'Tabla: ']); ?>

                <?php echo Field::select('status',Config::get('dataselects.status'),$objTypeDocument->status,['label'=>'Estado: ','class'=>'select2','required'=>true]); ?>





                <div class="text-left">
                    <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-warning warning-300  btn-labeled legitRipple btn-xs')); ?>

                    <a href="<?php echo e(route('selection.typedocument.index')); ?>" class="btn btn-success warning-300 btn-labeled legitRipple btn-xs"><b><i
                                    class=" icon-undo2 position-left"> </i></b>CANCELAR</a>
                </div>
            </div></div>
        <?php echo Form::close(); ?>

    </div>
    <div class="col-lg-7">
    <input id="txtTypeTable" value="<?php echo e(route('selection.typedocument.datatables')); ?>" type="hidden" readonly="readonly"/>
    <div class="table-responsive">
        <table class="table table-bordered bg-white table-hover" id="tableDataTypeDocument">
            <thead>
            <tr>
                <th style="width: 70%">Nombre</th>
                <th style="width: 10%">Prefijo</th>
                <th style="width: 10%">Status</th>
                <th style="width: 10%">Acciones</th>
            </tr>
            </thead>

        </table>
    </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datatables/jquery.dataTables.min.js'); ?>

    <?php echo Html::script('js/modules/selection/catalogs.js'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('css/datatables.css'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>