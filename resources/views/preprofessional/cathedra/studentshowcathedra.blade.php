@extends('layouts.back')
@section('masterTitle')
MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   MOSTRAR ESTUDIANTES DE LAS CATEDRAS INTEGRADAS
@endsection
@section('masterDescription')
  Panel de los estudiantes asignados a las catredas integradas
@endsection

@section('mainContent')
@if(!$flag=="true")
@if(!$getresult=="")
						<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="text-semibold text-bold" style="text-align: center;">MOSTRAR ESTUDIANTES DE LA CATEDRA INTEGRADORA</h5>
						</div>
					<div class="table-responsive">
						<table class="table datatable-button-html5-image">
							<thead>
								<tr class="bg-blue">
									<th>CEDULA</th>
									<th>NOMBRES Y APELLIDOS</th>
									<th>TUTOR</th>
									<th>NOTA</th>
									<th>ESTADO</th>
								</tr>
							</thead>
							<tbody>
						@foreach ($getresult as list($document , $name_estu,$ape_estu, $note, $status_catedra, $Namestutor))
								<tr>
									<td>{{$document}}</td>
									<td>{{UGCore\Library\Utils::strtoupper($name_estu,$ape_estu)}}</td>
									<td>{{$Namestutor}}</td>
									<td>{{round($note,2)}}</td>
									<td>
										@if($status_catedra=="A")
												{{"APROBADO"}}
										@elseif ($status_catedra=="P")
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
@endif

									<div style="text-align: center;">
											<a href="{{ route('preprofessional.cathedra.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
									</div>	

@endif
@endsection
@section('masterCssCustom')
<style >
	.paddingBottom{
		    padding-bottom: 14px;
	}
</style>
@endsection