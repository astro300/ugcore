@extends('layouts.back')
@section('masterTitle')
MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   EVALUAR ESTUDIANTES DE LAS CATEDRAS INTEGRADORA
@endsection
@section('masterDescription')
  Panel de los estudiantes ah evaluar en la  catreda integradora
@endsection

@section('mainContent')
@if(!empty($objEvaluationStudent))
{!! Form::open(['route'=> ['preprofessional.cathedra.storeevaluation',$id,$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}
						
						<div class="panel-heading">
							<h5 class="text-semibold text-bold" style="text-align: center;">ASIGNACIÓN DE PUNTUACIÒN DEL ESTUDIANTES EN LA CATEDRA INTEGRADORA</h5>
						</div>
					<div class="panel-body">
						<center>
								<div class="table-responsive">
								<table WIDTH=50%>
									<thead>
										<tr class="bg-blue">
											<th class="text-center">CEDULA</th>
											<th class="text-center">NOMBRES Y APELLIDOS</th>
											<th class="text-center">PUNTUACIÓN</th>
										</tr>
									</thead>
									<tbody>
								@foreach ($objEvaluationStudent as $objEvaluationStudents) 
										<tr>
											<td class="text-center">{{$objEvaluationStudents->document}}</td>
											<td>{{UGCore\Library\Utils::strtoupper($objEvaluationStudents->name_estu,$objEvaluationStudents->ape_estu)}}</td>
											<td class="text-left" width="100">
											{!! Form::number($objEvaluationStudents->document, null,  ["class"=>"form-control", "placeholder"=>"Ingresar Puntuacion", "step" =>"0.01", "autofocus max" =>"10", "style"=>"text-align: center;" ]) !!}
											</td>
										</tr>
								@endforeach	
									</tbody>
								</table>
								</div>
						</center>
						</br>
						</br>

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
@else
									<div style="text-align: center;">
											<a href="{{ route('preprofessional.cathedra.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
									</div>	  
@endif
@endsection
@section('masterJsCustom')
	{!!Html::script('extcore/js/modules/preprofesionales/preprofessional.js')!!}
	{!!Html::script('extcore/js/plugins/forms/validation/validate.min.js')!!}
	{!!Html::script('extcore/js/plugins/forms/styling/uniform.min.js')!!}

	{!!Html::script('extcore/js/plugins/pickers/daterangepicker.js')!!}
	{!!Html::script('extcore/js/plugins/pickers/anytime.min.js')!!}
	{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.js')!!}
	{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.date.js"')!!}
	{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.time.js')!!}
	{!!Html::script('extcore/js/pages/picker_date.js')!!}


@endsection

