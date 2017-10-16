<?php $__env->startSection('masterTitle'); ?>
    Registro de Examen complexivo
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    REGISTRO DE EXAMEN COMPLEXIVO
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Pantalla de registro de notas de examen  complexivo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-12">
        <?php echo Field::select('excfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: ']); ?>


    </div>
    <div class="col-lg-12">
        <?php echo Field::select('excCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']); ?>

    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="tbExamenComplexivo">
                <thead>

                <th>Facultad</th>
                <th>Carrera</th>
                <th>Nombre</th>

                <th>Nota Complexivo</th>
                <th>nota Gracia</th>

                <th>Nota Final</th>
                <th>Observación</th>
                <th>Actions</th>

                </thead>
                <tbody id="tbobyExamenComplexivo">

                </tbody>
            </table>
        </div>
    </div>

    
        
    

    <div class="modal fade" id="ModalNotasComplexivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edición de Notas</h4>
                </div>
                <div class="modal-body">

                    <?php echo e(Form::hidden('idmatriculado', null,['id'=>'idmatriculado'])); ?>


                    <div class="form-group">
                        
                        <label>Nombres del Estudiante: </label><br>
                        <?php echo e(Form::label('estudiante', null, ['id'=>'lbnombre'])); ?>

                    </div>


                    <div class="form-group">
                        <?php echo Field::text('NotaeComplexivo', null,  ["required"=>"required","class"=>"form-control nota","label"=> "Nota examen complexivo" ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Field::text('NotaGracia', null,  ["class"=>"form-control nota","label"=> "Nota examen de gracia" ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Field::textarea('observacion', null,  ["class"=>"form-control","label"=> "Obseravación","rows"=>"2"]); ?>

                    </div>


                </div>
                <div class="modal-footer">

                    <div style="text-align: center;">
                        <?php echo Form::button('<b><i class="glyphicon glyphicon-ok"></i></b> Guardar', array('type' => 'button', 'class' => 'btn btn-success','id' => "btnGuardar")); ?>

                        <?php echo Form::button('<b><i class="glyphicon glyphicon-remove"></i></b> Cerrar', array('type' => 'button', 'class' => 'btn btn-danger','id' => "btnCancelar", 'data-dismiss'=>"modal")); ?>

                    </div>


                    
                    
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datepicker/bootstrap-datepicker.js'); ?>

    <?php echo Html::script('plugins/fileinput/fileinput.min.js'); ?>

    <?php echo Html::script('plugins/datatables/jquery.dataTables.min.js'); ?>


    <script src="<?php echo e(asset('/js/modules/titulacion/examen_complexivo.js')); ?>"></script>
    <script src="<?php echo e(asset('/plugins/mask/jquery.mask.js')); ?>"></script>
    <script>
        $('.nota').mask("#.##0,00", {reverse: true});
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('/css/datatables.css'); ?>

    <?php echo Html::style('/plugins/fileinput/fileinput.min.css'); ?>

    <?php echo Html::style('/css/checkbox.css'); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>