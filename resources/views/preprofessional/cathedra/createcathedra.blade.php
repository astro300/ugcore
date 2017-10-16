@extends('layouts.back')
@section('masterTitle')
  MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   AGREGAR CATEDRA INTEGRADA
@endsection
@section('masterDescription')
  Panel Principal del Ingreso de Catedra
@endsection

@section('mainContent')
<div class="col-lg-12">
 {!! Form::open(['route'=> ['preprofessional.cathedra.store',$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}
						<div class="panel-heading">

							<h5 class="text-semibold" style="text-align: center;">CREAR CATEDRA INTEGRADORA</h5>

						</div>
						
						<div class="panel-body">								
								<div class="form-group">
									<div class="col-lg-6">
											{!! Form::label('name_cathedra','NOMBRE',["class"=>"text-bold col-lg-3 control-label"]) !!}
											<div class="col-lg-9">
											{!! Form::select('name_cathedra',Config::get('dataselects.valuesCathedra'),null,["class"=>"select" ,"id"=>"cycle"]) !!}
										</div>
									</div>
								</div>	
									
								<div class="form-group">
									<div class="col-lg-6">
											{!! Form::label('period','PERIODO',["class"=>"text-bold col-lg-3 control-label"]) !!}
											<div class="col-lg-9">
											{!! Form::text('period', $getperiod,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]) !!}
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-6">
											{!! Form::label('cycle','CICLO',["class"=>"text-bold col-lg-3 control-label"]) !!}
											<div class="col-lg-9">
											{!! Form::select('cycle',Config::get('dataselects.valuesCycle'),null,["class"=>"select" ,"id"=>"cycle"]) !!}
										</div>
									</div>
								</div>	

								<div class="form-group">
									<div class="col-lg-6">
										{!! Form::label('description','DESCRIPCION',["class"=>"text-bold col-lg-3 control-label"]) !!}
										<div class="col-lg-10">
										<textarea required="required" type="text" name="description" class="form-control" placeholder="Escribir aqui la descripción..."  rows="2" cols="150"></textarea>
										</div>
									</div>
								</div>							

								<br>		
								<div class="form-group" style="text-align: center;">
									<div class="col-md-6">
										<div class="text-right">
											<a href="{{ route('preprofessional.cathedra.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
										</div>
									</div>			
									<div class="col-md-2">
										<div class="text-lefth">
											{!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!} 
										</div>
									</div>				
								</div>				
								

						</div>
{!! Form::close() !!}  
</div>


@endsection
@section('masterCssCustom')
<style >
	.paddingBottom{
		    padding-bottom: 14px;
	}
</style>
@endsection
@section('masterJsCustom')
	{!!Html::script('extcore/js/modules/preprofesionales/preprofessional.js')!!}
	{!!Html::script('extcore/js/plugins/forms/validation/validate.min.js')!!}
	{!!Html::script('extcore/js/plugins/forms/styling/uniform.min.js')!!}

@endsection

