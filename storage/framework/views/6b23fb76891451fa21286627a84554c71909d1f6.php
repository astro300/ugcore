<?php $__env->startSection('masterTitle'); ?>
    Configuraciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Parametrizaci&oacuten de Fechas
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Inicio y Fin de Periodos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainBox'); ?>
 <div class="col-lg-12 text-right">
        <a href="/titulacion/Configuraciones" class="btn bg-teal-400"><i
                    class="icon-plus-circle2 position-left"></i>Nuevo</a>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <div class="col-lg-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Datos Generales</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Consultas Generales</a></li>


            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab_2">

                    <div class="table-responsive">
                        <table class="table table-bordered bg-white" id="datosUsuarios">
                            <thead>

                            <th>CARRERA</th>
                            <th>CICLO</th>
                            <th>ETAPA</th>
                            <th>TIPO</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FINAL</th>

                            <th>ACCIONES</th>
                            </thead>
                        </table>
                    </div>


                </div>


                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Formulario de Registro
                                </div>
                                <div class="panel-body">

                                    <?php echo Form::open(['route'=>'titulacion.configuraciones.store', 'enctype'=>'multipart/form-data']); ?>

                                    <div class="panel-body">
                                        <?php echo Field::select('modulo',$dato['modulo'],NULL,['empty'=>'seleccione','class'=>'select2','label'=>'MODULO: ']); ?>

                                        <?php echo Field::select('etapa',[],NULL,['class'=>'select2','label'=>'ETAPA:','empty'=>'-SELECCIONE-']); ?>

                                        <?php echo Field::select('tipo',$dato['tipo'],1,['class'=>'select2','label'=>'TIPO:','empty'=>'-SELECCIONE-']); ?>

                                        <?php echo Field::select('facultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: ']); ?>

                                        <?php echo Field::checkbox('todas_facultades',1,['class'=>'icheckbox','label'=>'Todas las Facultades']); ?>

                                        <?php echo Field::select('carrera',[],null,['class'=>'select2','label'=>'CARRERA:','empty'=>'-SELECCIONE']); ?>

                                        <?php echo Field::select('ciclo',[],['class'=>'select2','label'=>'CICLO:','empty'=>'-SELECCIONE-']); ?>



                                        <label class="col-lg-3 control-label text-bold"><i
                                                    class="text-danger">*</i> Inicio</label>
                                        <div class="input-group">

                                            <?php echo Form::text('fecha_inicio',' ',['class'=>'form-control pickadate','id'=>'fechai','placeholder'=>'Seleccione fecha ', ""]); ?>

                                            <span class="input-group-addon"><i
                                                        class="icon-calendar text-muted"></i></span>
                                        </div>
                                        <br/>
                                        <label class="col-lg-3 control-label text-bold"><i
                                                    class="text-danger">*</i> Fin</label>
                                        <div class="input-group">

                                            <?php echo Form::text('fecha_final',' ',['class'=>'form-control pickadate','id'=>'fechaf','placeholder'=>'Seleccione fecha ', ""]); ?>

                                            <span class="input-group-addon"><i
                                                        class="icon-calendar text-muted"></i></span>
                                        </div>


                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>
                                    </div>
                                    <?php echo Form::close(); ?>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->

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
            orientation: 'top'
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