@extends('layouts.back')
@section('masterTitle')
  MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   ASIGNAR PRACTICAS INSTITUCIONALES
@endsection
@section('masterDescription')
  Panel de Asignacion de Estudiantes
@endsection
@section('mainContent')
	<div class="col-lg-12">
		<div class="panel panel-primary panel-flat">
			<div class="panel-heading">
				<div class="text-semibold" style="text-align: center;">ASIGNACIÓN DE ESTUDIANTE EN LA PRÁCTICA INSTITUCIONAL</div>
			</div>
			<div class="panel-body">
				{!! Form::open(['route'=> ['preprofessional.practices.searchStuentpractices',$id,$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}
				@if($valida==0)
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('mesh','MALLA CURRICULAR',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-2">
							{!! Form::select('mesh',Config::get('dataselects.TipoMallaCurricular'),null,["class"=>"select2" ,"id"=>"mesh",]) !!}
						</div>
						<div class="col-lg-2">
							{!! Form::label('document','CÉDULA ESTUDIANTE',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-4">
							{!! Form::text('document', null,  ["required"=>"required","class"=>"form-control","onkeypress"=>" return verifyKeyPressPattern(event, /[0-9]/,'#document')" ]) !!}
						</div>
						<div class="col-lg-1">
							{!! Form::button('<i class="icon-search4"></i>', array('type' => 'submit', 'class' => "btn btn-info btn-rounded")) !!}
						</div>
					</div>
					<br>
				@else
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('mesh','MALLA CURRICULAR',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-2">
							{!! Form::text('mesh', $mesh,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]) !!}
						</div>
						<div class="col-lg-2">
							{!! Form::label('document','CÉDULA ESTUDIANTE',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-6">
							{!! Form::text('document', $documentstudent,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]) !!}
						</div>
					</div>
				@endif
				{!! Form::close() !!}
				@if($new_name_estu=="")
					<div class="text-center">
						<a href="{{ route('preprofessional.practices.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
					</div>
				@else
					<hr class="bg-primary">
					{!! Form::open(['enctype'=>"multipart/form-data",'route'=> ['preprofessional.practices.addassignmentStuentpractices',$id,$documentstudent,$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('student','ESTUDIANTE',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-10">
							{!! Form::text($new_name_estu,$new_name_estu,["class"=>"form-control",'readonly'=>'readonly']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('star_date','FECHA INICIO',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-3">
							{!! Form::text('star_date', null,  ["required"=>"required","class"=>"form-control pickadate" ,"placeholder"=>"- seleccione fecha inicio -"]) !!}
						</div>
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							{!! Form::label('end_date','FECHA FIN',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-3">

							{!! Form::text('end_date', null,  ["required"=>"required","class"=>"form-control pickadate" ,"placeholder"=>"- seleccione fecha fin -"]) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('tutor','TUTOR',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-10">
								{!! Form::select('tutor', ['*'=>'-Seleccione-']+$gettutor, null,["id"=>"tutor",'class' => 'select2','empty'=>'-Seleccione-','required' => 'required']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('name_supervisor','NOMBRE SUPERVISOR',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-3">
							{!! Form::text('name_supervisor', null,  ["required"=>"required","class"=>"form-control"  ,"onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#name_supervisor','width: 100%;text-transform: uppercase')"]) !!}
						</div>
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							{!! Form::label('position_supervisor','CARGO SUPERVISOR',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-3">
							{!! Form::text('position_supervisor', null,  ["required"=>"required","class"=>"form-control"  ,"onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#position_supervisor','width: 100%;text-transform: uppercase')"]) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('area','AREA/DEPARTAMENTO',["class"=>"text-bold control-label"]) !!}
						</div>
						<div class="col-lg-10">
							{!! Form::text('area', null,  ["required"=>"required","class"=>"form-control"  ,"onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#area','width: 100%;text-transform: uppercase')"]) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">
							{!! Form::label('parameters','SUBIR SOLICITUD',array("class" => "text-bold control-label")) !!}
						</div>
						<div class="col-lg-10">
							<input required="required" name="file" type="file" class="file-input" data-show-preview="false" data-show-upload="false">
						</div>
					</div>
					</br>
					<div class="form-group" style="text-align: center;">
						<div class="col-md-6">
							<div class="text-right">
								<a href="{{ route('preprofessional.practices.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="text-lefth">
								{!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> ASIGNAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				@endif
			</div>
		</div>
	</div>
@endsection
@section('masterJsCustom')
	{!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
	{!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
	<script type="text/javascript" src="{{ asset('plugins/fileinput/fileinput.min.js') }}"></script>
	{!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
	{!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
	<script>
        $('.file-input').fileinput({
            maxFileSize: 2000,
            showPreview: false,
            browseLabel: '',
            removeLabel: '',
            language: "es",
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>'
            },
            initialCaption: "",
            allowedFileExtensions: ["pdf"]
        }).on('fileerror', function (event, data) {
            alertToast("Solo se admiten extensiones pdf, con peso de 2mb", 2000);
        });
	</script>
@endsection
@section('masterCssCustom')
	<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
	{!!Html::style('plugins/datepicker/datepicker3.css')!!}
	<link rel="stylesheet" type="text/css" href="/plugins/fileinput/fileinput.min.css">
@endsection