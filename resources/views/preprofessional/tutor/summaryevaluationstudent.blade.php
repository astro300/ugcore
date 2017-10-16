	<?php
	$value=1;
	$value_plus=0;
	?>

		<div class="table-responsive">
			<table class="table  table-bordered bg-white table-hover">
				<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">FECHA CREACION</th>
					<th class="text-center">NUMERO VISITA</th>
					<th class="text-center">ACCIONES</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($objgetStudentEvaluationes as $objgetStudentEvaluationesp)
					<tr>
						<td class="text-center">{{$objgetStudentEvaluationesp->id}}</td>
						<td class="text-center">{{$objgetStudentEvaluationesp->eval_date }}</td>
						<td class="text-center">{{$objgetStudentEvaluationesp->number_visit}}</td>
						<td class="text-center">

							<div class="btn-group-vertical">
								<div class="btn-group">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="fa fa-cog"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ route('preprofessional.tutor.pdfTutorEvaluationStudent', array($objgetStudentEvaluationesp->id,$documentid,$objgetStudentEvaluationesp->document,$documenttutor,$value))}}" target="_blank"><i class="glyphicon glyphicon-eye-open"></i>Ver Evaluacion</a></li>
										<li><a href="{{ route('preprofessional.tutor.pdfTutorEvaluationStudent', array($objgetStudentEvaluationesp->id,$documentid,$objgetStudentEvaluationesp->document,$documenttutor,$value_plus))}}"><i class="glyphicon glyphicon-download-alt"></i>Descargar Evaluacion</a></li>									</ul>
								</div>
							</div>

						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>

<style href="{{asset('css/datatables.css')}}"></style>