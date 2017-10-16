<?php $__env->startSection('masterTitle'); ?>
    Configuraci&oacute;n
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Cat&aacute;logos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
   
   <?php echo Form::open(['route'=> 'titulacion.proceso.store','method'=>'POST']); ?>


	<div class="panel panel-primary">
		<div class="panel-heading">asdfasdfs</div>
		<div class="panel-body">

			<div class="col-lg-6">
				<?php echo Field::text('nombre',$objUser->name,['label'=>'Nombres data','placeholder'=>'asdfasdf']); ?>	
			</div>
			<div class="col-lg-6">
				<?php echo Field::textarea('tres',$objUser->email,['label'=>'Nombres data','placeholder'=>'asdfasdf','style'=>'resize:none']); ?>	
			</div>
			<div class="col-lg-6">
				<?php echo Field::select('dos',$users,$objUser->id,['class'=>'select2','label'=>'Nombres data','empty'=>'-SELECCIONE-']); ?>	
			</div>

			<div class="col-lg-6">
				<button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>GUARDAR</button>
				<button class="btn btn-success">GUARDAR</button>
				<button class="btn btn-danger">GUARDAR</button>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>