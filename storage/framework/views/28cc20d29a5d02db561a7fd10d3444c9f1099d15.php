<?php $__env->startSection('masterTitle'); ?>
    Tutorias
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Tutorias
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">DATOS</div>
           
            <div class="panel-body">
                <?php echo Field::text('nombre',null,['placeholder'=>'INGRESE NOMBRE DE LA EVIDENCIA','label'=>'NOMBRE DE EVIDENCIA:']); ?>

                <?php echo Field::select('tesis',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'TESIS: ']); ?>


                <?php echo Field::file('documentoFoto',['id'=>'documentoFoto','accept'=>"image/*",'label'=>'FOTO']); ?>

            </div>
            <div class="panel-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>
            </div>
           
        </div>
    </div>
    <div class="col-lg-7">
        <div class="table-responsive">
                <table class="table table-bordered bg-white" id="datosUsuariosSeguimiento">
                        <thead>
                            <th>CARRERA</th>
                            <th>DOCENTE</th>
                            <th>ESTUDIANTE</th>
                            <th>FECHA REGISTRO</th>

                            <th>ACCIONES</th>
                        </thead>
                </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datepicker/bootstrap-datepicker.js'); ?>

    <?php echo Html::script('plugins/fileinput/fileinput.min.js'); ?>

    <?php echo Html::script('plugins/datatables/jquery.dataTables.min.js'); ?>


    <script src="<?php echo e(asset('/js/modules/titulacion/datos.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('/css/datatables.css'); ?>

    <?php echo Html::style('/plugins/fileinput/fileinput.min.css'); ?>

    <?php echo Html::style('/css/checkbox.css'); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>