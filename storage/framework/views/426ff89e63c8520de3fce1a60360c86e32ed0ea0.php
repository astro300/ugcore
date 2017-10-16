<?php $__env->startSection('masterTitle'); ?>
    Configuraciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
   DATOS DEL ESTUDIANTE
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    descripc
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">PERIODOS DE TITULACIÓN </div>
          <?php echo Form::open(['route'=>'titulacion.configuraciones.store', 'enctype'=>'multipart/form-data']); ?> 
            <div class="panel-body">
			<?php echo Field::select('modulo',$modulo,null,['empty'=>'seleccione','class'=>'select2','label'=>'MODULO: ']); ?>

			<?php echo Field::select('etapa',[],null,['class'=>'select2','label'=>'ETAPA:','empty'=>'-SELECCIONE-']); ?>

			<?php echo Field::select('facultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: ']); ?>

			<?php echo Field::select('carrera',[],null,['class'=>'select2','label'=>'CARRERA: ']); ?>

			<?php echo Field::select('ciclo',$ciclo,['class'=>'select2','label'=>'CICLO:','empty'=>'-SELECCIONE-']); ?>	


				               
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
    <div class="col-lg-7">
        <div class="table-responsive">
                <table class="table table-bordered bg-white" id="datosUsuarios">
                        <thead>
                            
                            <th>CARRERA</th>
                             <th>CICLO</th>
                            <th>ETAPA</th>

                             <th>FECHA DE INICIO</th>
                              <th>FECHA FINAL</th>

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