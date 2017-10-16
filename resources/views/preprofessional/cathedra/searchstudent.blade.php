@extends('layouts.back')
@section('masterTitle')
MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   MOSTRAR CATEDRAS DEL ESTUDIANTE
@endsection
@section('masterDescription')
  Panel de los estudiantes mostrar catedras del estudiante
@endsection

@section('mainContent')
						
<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="text-semibold text-bold" style="text-align: center;">MOSTRAR CATEDRAS DEL ESTUDIANTE</h5>
						</div>
						<div class="panel-body">		
						{!! Form::open(['route'=> ['preprofessional.cathedra.showStudentcathedras',$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}   
							<div class="form-group">
		                		<div class="col-lg-9">
		                		{!! Form::label('document','INGRESAR CEDULA',["class"=>"text-bold col-lg-2 control-label"]) !!} 
			                    	<div class="col-lg-2">
			                     		{!! Form::text('document', null,  ["required"=>"required","class"=>"form-control","onkeypress"=>" return verifyKeyPressPattern(event, /[0-9]/,'#document')" ]) !!}
			                    	</div>
			                    	<div class="col-lg-1" style="padding-left: 0px;">

			                     		{!! Form::button('<i class="icon-search4 position-center"></i>', array('type' => 'submit', 'class' => "btn btn-info btn-rounded btn-xs legitRipple")) !!} 

			                     		
			                    	</div>
			                    	
		                		</div>
	                   		</div>	

						<div class="form-group">
                            <div class="col-lg-6">
                                {!! Form::label('student','ESTUDIANTE',["class"=>"text-bold col-lg-3 control-label"]) !!}
                                    <div class="col-lg-6">
                                {!! Form::label($name_estudent,$name_estudent,["class"=>" col-lg-20 control-label"]) !!}
                                   </div>
                            </div>
                        </div>
{!! Form::close() !!}                        
                       
    <div class="table-responsive">
		<table class="table table-bordered">
			<tbody>
				<tr class="bg-blue" style="text-align: center;">
					<td class="text-semibold text-bold" width="20%" height="20%">CATEDRA INTEGRADORA</td>
					<td class="text-semibold text-bold" width="20%" height="20%">PERIODO</td>
					<td class="text-semibold text-bold" width="20%" height="20%">CICLO</td>
					<td class="text-semibold text-bold" width="20%" height="20%">NOTA</td>
					<td class="text-semibold text-bold" width="20%" height="20%">ESTADO</td>
				</tr>
				@foreach ($objShowstudentCatedra as $objShowstudentCatedras) 
				<tr>
					<td width="20%" height="20%" style="text-align: center;">{{UGCore\Library\Utils::showCathedra($objShowstudentCatedras->name)}}</td>
					<td width="20%" height="20%" style="text-align: center;">{{$objShowstudentCatedras->period}}</td>
					<td width="20%" height="20%" style="text-align: center;">{{$objShowstudentCatedras->cycle}}</td>
					<td width="20%" height="20%" style="text-align: center;">{{round($objShowstudentCatedras->note,2)}}</td>
					<td width="20%" height="20%" style="text-align: center;">@if($objShowstudentCatedras->status_cathedra=="A")
													{{"APROBADO"}}
												 @elseif ($objShowstudentCatedras->status_cathedra=="P")
													{{"EN PROCESO"}}
												 @else
												    {{"REPROBADO"}}
												 @endif
					</td>				
				</tr>
				@endforeach	
			</tbody>
		</table>	

	</div>
	</div>

									<div style="text-align: center;">
											<a href="{{ route('preprofessional.prospects.indexadministratorreturn',[$faculty,$career])}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
									</div>
									<br>
									
</div>


@endsection

@section('masterJsCustom')
		{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.js')!!}	
		{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.date.js')!!}	
		{!!Html::script('extcore/js/modules/preprofesionales/preprofessional.js')!!}
		{!!Html::script('extcore/js/plugins/forms/validation/validate.min.js')!!}
		{!!Html::script('extcore/js/plugins/forms/styling/uniform.min.js')!!}
		{!!Html::script('plugins/ckeditor/ckeditor.js')!!}
		{!!Html::script('extcore/js/config/ckeditor.js')!!}


@endsection