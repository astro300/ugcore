@extends('layouts.back')
@section('masterTitle')
  PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   EVALUACION ESTUDIANTE
@endsection
@section('masterDescription')
  panel evaluacion estudiante
@endsection

@section('mainContent')
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5 class="text-semibold" style="text-align: center;">OPCIONES DISPONIBLES</h5>

			</div>


			<div class="panel-body">
				<div class="form-group">
					<div class="col-md-6">
						<div class="text-center">
							<a href="{{ route('preprofessional.student.pdfevaluationStudent',array($documentstudent,1))}}" class="btn bg-teal-400 btn-labeled legitRipple" target="_blank">
								<b><i class="glyphicon glyphicon-eye-open"></i></b> VER EVALUACION
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-center">
							<a href="{{ route('preprofessional.student.pdfevaluationStudent',array($documentstudent,2))}}" class="btn bg-teal-400 btn-labeled legitRipple">
								<b><i class="glyphicon glyphicon-download-alt"></i></b> DESCARGAR EVALUACION
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection