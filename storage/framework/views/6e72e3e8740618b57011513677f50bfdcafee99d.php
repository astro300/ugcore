<?php $__env->startSection('masterTitle'); ?>
    Registro general de trabajo de titulación
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    REGISTRO GENERAL DE TRABAJOS DE TITULACIÓN
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Pantalla de registro general de trabajos de titulación
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-12">
        <?php echo Field::select('ttfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: ']); ?>


    </div>
    <div class="col-lg-12">
        <?php echo Field::select('ttCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']); ?>

    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="datosTrabTitulacion">
                <thead>

                    <th>Nombre del tema</th>
                    <th>Porcentaje similitud</th>
                    <th>Nota de tutoría</th>

                    <th>Nota de revisión</th>
                    <th>Nota de sustentación</th>

                    <th>Promedio Final</th>

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