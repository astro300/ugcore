@extends('layouts.back')
@section('masterTitle')
    Configuraci&oacute;n
@endsection
@section('masterTitleModule')
    Cat&aacute;logos
@endsection
@section('masterDescription')
    Panel 
@endsection

@section('mainContent')
   
   {!! Form::open(['route'=> 'titulacion.proceso.store','method'=>'POST']) !!}

	<div class="panel panel-primary">
		<div class="panel-heading">asdfasdfs</div>
		<div class="panel-body">

			<div class="col-lg-6">
				{!! Field::text('nombre',$objUser->name,['label'=>'Nombres data','placeholder'=>'asdfasdf']) !!}	
			</div>
			<div class="col-lg-6">
				{!! Field::textarea('tres',$objUser->email,['label'=>'Nombres data','placeholder'=>'asdfasdf','style'=>'resize:none']) !!}	
			</div>
			<div class="col-lg-6">
				{!! Field::select('dos',$users,$objUser->id,['class'=>'select2','label'=>'Nombres data','empty'=>'-SELECCIONE-']) !!}	
			</div>

			<div class="col-lg-6">
				<button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>GUARDAR</button>
				<button class="btn btn-success">GUARDAR</button>
				<button class="btn btn-danger">GUARDAR</button>
			</div>
		</div>
	</div>
	{!! Form::close()!!}
@endsection