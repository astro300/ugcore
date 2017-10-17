<?php $__env->startSection('masterTitle'); ?>
    Inscripci&oacute;n
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Datos del Trabajo de Titulaci&oacute;n
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Descripcion
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

    <div class="col-lg-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Datos Generales</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Tutores</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Revisores</a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="true">Estudiantes</a></li>
                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="true">Tribunal de Sustentaci&oacute;n</a>
                </li>


            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    <div class="row">

                        <div class="col-lg-5">

                            <div class="panel-body">

                                <?php echo Field::text('tema',['class'=>'form-control','id'=>'trabajo','placeholder'=>'Tema de Titulación', 'label'=>"TEMA DE TITULACIÓN(TÍTULO):"]); ?>



                                <?php echo Field::select('facultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: ']); ?>

                                <?php echo Field::select('carrera',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'CARRERA: ']); ?>

                                <?php echo Field::select('ciclo',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'CICLO: ']); ?>



                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="TrabajoInscripcion">
                                    <thead>

                                    <th>Depende1</th>
                                    <th>Depende2</th>
                                    <th>Depende3</th>
                                    <th>Depende3</th>

                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane" id="tab_2">

                    <div class="row">

                        <div class="col-lg-5">
                            <div class="panel-body">

                                <?php echo Field::text('cedula_tutor',['class'=>'form-control','id'=>'cedula_tutor','placeholder'=>'Cédula del Tutor', 'label'=>'CÉDULA DEL TUTOR:']); ?>


                                <?php echo Field::text('nombre_tutor',' ',['class'=>'form-control','id'=>'nombre_tutor','placeholder'=>'Nombre del Tutor', 'label'=>'NOMBRE DEL TUTOR:']); ?>


                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="TrabajoInscripcion">
                                    <thead>

                                    <th>Depende1</th>
                                    <th>Depende2</th>


                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">

                    <div class="row">

                        <div class="col-lg-5">

                            <div class="panel-body">

                                <?php echo Field::text('cedula_revisor',['class'=>'form-control','id'=>'cedula_revisor','placeholder'=>'Cédula del Revisor', 'label'=>'CÉDULA DEL REVISOR:']); ?>


                                <?php echo Field::text('nombre_revisor',' ',['class'=>'form-control','id'=>'nombre_revisor','placeholder'=>'Nombre del Revisor', 'label'=>'NOMBRE DEL REVISOR:']); ?>


                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="TrabajoInscripcion">
                                    <thead>

                                    <th>Depende1</th>
                                    <th>Depende2</th>


                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_4">


                    <div class="row">

                        <div class="col-lg-5">
                            <div class="panel-body">

                                <?php echo Field::text('cedula_estudiante',['class'=>'form-control','id'=>'cedula_estudiante','placeholder'=>'Cédula del Estudiante', 'label'=>'CÉDULA DEL ESTUDIANTE:']); ?>



                                 <?php echo Field::select('nombre_estudiante',[],null,['class'=>'select2','label'=>'NOMBRE DEL ESTUDIANTE:','empty'=>'-SELECCIONE-']); ?>

                              

                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="TrabajoInscripcion">
                                    <thead>

                                    <th>Depende1</th>
                                    <th>Depende2</th>


                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane" id="tab_5">


                    <div class="row">

                        <div class="col-lg-5">
                            <div class="panel-body">

                                <?php echo Field::text('cedula_docente',['class'=>'form-control','id'=>'cedula_docente','placeholder'=>'Cédula del Docente', 'label'=>'CÉDULA DEL DOCENTE:']); ?>


                                <?php echo Field::text('nombre_docente',' ',['class'=>'form-control','id'=>'nombre_docente','placeholder'=>'Nombre del Docente', 'label'=>'NOMBRE DEL DOCENTE:']); ?>


                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="TrabajoInscripcion">
                                    <thead>

                                    <th>Depende1</th>
                                    <th>Depende2</th>


                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
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