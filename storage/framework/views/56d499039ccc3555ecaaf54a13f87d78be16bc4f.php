<?php $__env->startSection('masterTitle'); ?>
    Notas de Sustentación
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Registros de notas de Sustentación
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Pantalla general de trabajos de titulación registrados
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-12">
        <?php echo Field::select('rfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: ']); ?>


    </div>
    <div class="col-lg-12">
        <?php echo Field::select('rCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']); ?>

    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="datosUsuarios">
                <thead>

                <th>NºIdentificación</th>
                <th>Nombres integrantes</th>
                <th>Nombre de tema</th>

                <th>Tutor</th>
                <th>Nota de Sustentación</th>

                <th>
                    <a href="#"> procesar</a>
                </th>

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
    <script>
        $('.pickadate').datepicker({
            formatSubmit: 'yyyy-mm-dd',
            format: 'yyyy-mm-dd',
            selectYears: true,
            editable: true,
            autoclose: true,
            orientation:'top'
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('/css/datatables.css'); ?>

    <?php echo Html::style('/plugins/fileinput/fileinput.min.css'); ?>

    <?php echo Html::style('/plugins/datepicker/datepicker3.css'); ?>

    <?php echo Html::style('/css/checkbox.css'); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>