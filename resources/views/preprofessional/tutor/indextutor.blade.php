@extends('layouts.back')
@section('masterTitle')
   MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   ESTUDIANTES TUTORIA
@endsection
@section('masterDescription')
  panel principal de las tutorias 
@endsection

@section('mainContent')

	<div class="col-lg-8 col-lg-offset-2">
		{!! Form::open(['route'=> ['preprofessional.tutor.indexnew',$documenttutor],'method'=>'POST', 'class'=>'form-horizontal']) !!}
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5 class="panel-title text-bold" style="text-align: center;">ESTUDIANTES ASIGNADOS PARA LA TUTORIA</h5>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-lg-2">
						{!! Form::label('careers','CARRERA:',["class"=>"text-bold control-label"]) !!}
					</div>
					<div class="col-lg-7">
						<select class="form-control" name="careers">
							@foreach ($careers as $key => $row)
								<option value="{{$row->COD_CARRERA}}">{{$row->NOMBRE}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-lg-3">
						<div style="text-align: center;">
							{!! Form::button('<b><i class="glyphicon glyphicon-search"></i></b> BUSCAR', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>

@endsection
