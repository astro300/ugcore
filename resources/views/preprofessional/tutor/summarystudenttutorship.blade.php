<div class="table-responsive">
	<table class="table table-bordered" >
		<tbody>
		@foreach ($getsummarystudenttutoria as $getsummarystudenttutorias)
			<tr>
				<td class="text-bold">CEDULA ESTUDIANTE</td>
				<td>{{$getsummarystudenttutorias->document}}</td>
			</tr>
			<tr>
				<td class="text-bold">ESTUDIANTE</td>
				<td>{{strtoupper($getsummarystudenttutorias->name_estu.' '.$getsummarystudenttutorias->ape_estu)}}</td>

			</tr>
			<tr>
				<td class="text-bold">CORREO INSTITUCIONAL</td>
				<td>{{$getsummarystudenttutorias->institution_email}}</td>

			</tr>
			<tr>
				<td class="text-bold">CORREO ALTERNATIVO</td>
				<td>{{$getsummarystudenttutorias->alternative_email}}</td>

			</tr>
			<tr>
				<td class="text-bold">INSTITUCION</td>
				<td>{{$getsummarystudenttutorias->name}}</td>

			</tr>
			<tr>
				<td class="text-bold">DIRECCION INSTITUCION</td>
				<td>{{$getsummarystudenttutorias->address}}</td>

			</tr>
			<tr>
				<td class="text-bold">AREA DE DESEMPEÑO</td>
				<td>{{$getsummarystudenttutorias->departament}}</td>

			</tr>
			<tr>
				<td class="text-bold">SUPERVISOR ENCARGADO</td>
				<td>{{$getsummarystudenttutorias->name_supervisor}}</td>

			</tr>
			<tr>
				<td class="text-bold">CARGO SUPERVISOR</td>
				<td>{{$getsummarystudenttutorias->position_supervisor}}</td>

			</tr>
			<tr>
				<td class="text-bold">CORREO INSTITUCION</td>
				<td>{{$getsummarystudenttutorias->email}}</td>

			</tr>
		@endforeach
		<tr>
			<td class="text-bold">NUMERO VISITAS REALIZADAS</td>
			<td>@if($getvisitinstitution=="")
					{{0}}
				@else
					{{$getvisitinstitution}}
				@endif
			</td>

		</tr>
		</tbody>
	</table>
</div>
