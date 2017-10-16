@extends('layouts.back')
@section('masterTitle')
	PROSPECTOS PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
	RESUMEN DEL PROSPECTO
@endsection
@section('masterDescription')
	panel principal del resumen del prospecto
@endsection
@section('mainContent')
	@if(!$flag=="true")
		<div class="col-lg-12">
			<div class="panel-heading">
				<h5 class="panel-title text-bold" style="text-align: center;">RESUMEN PROSPECTO</h5>
				<br>
				<div class="table-responsive">
					<table class="table table-bordered" width="50%">
						<tbody>
						@foreach ($getresult as list($document,$first_name,$last_name,$institution_email,$alternative_email,$departament,$phone,$getcareers,$getfaculties,$obtener_fecha))
							<tr>
								<td>NOMBRE COMPLETO</td>
								<td>{{ strtoupper($first_name.' '.$last_name)}}</td>
							</tr>
							<tr>
								<td>C.I</td>
								<td>{{$document}}</td>
							</tr>
							<tr>
								<td>CORREO INSTITUCIONAL</td>
								<td>{{$institution_email}}</td>
							</tr>
							<tr>
								<td>CORREO ALTERNATIVO</td>
								<td>{{$alternative_email}}</td>
							</tr>
							<tr>
								<td>TELEFONO</td>
								<td>{{$phone}}</td>
							</tr>
							<tr>
								<td>FACULTAD</td>
								<td>{{$getfaculties[0]->NOMBRE}}</td>
							</tr>
							<tr>
								<td>CARRERA</td>
								<td>{{$getcareers[0]->NOMBRE_CARRERA}}</td>
							</tr>
							<tr>
								<td>FECHA INSCRIPCION</td>
								<td>{{$obtener_fecha}}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<br>
				<div class="text-center">
					<a href="{{ route('preprofessional.prospects.index',array($faculty,$career))}}"
					   class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
									class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
				</div>
			</div>
		</div>
	@endif
@endsection