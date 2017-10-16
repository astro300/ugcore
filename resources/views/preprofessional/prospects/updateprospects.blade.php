@extends('layouts.back')
@section('masterTitle')
  MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   Ingreso de Actualizar Prospecto
@endsection
@section('masterDescription')
  panel principal del Actualizar de Prospecto
@endsection


@section('mainContent')
	{!! Form::open(['route'=> ['preprofessional.prospects.updateprospectsstudent',$document,$faculty,$career],'method'=>'PUT']) !!}

	<div class="col-lg-10 col-lg-offset-1">
	<div class="panel panel-primary panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title text-bold" style="text-align: center;">ACTUALIZAR PROSPECTO</h5>
		</div>






		<div class="panel-body">
			@foreach ($registupdate as $registupdates)

				<div class="col-lg-12 text-center" style="{{ifArrayNull(Config::get('dataselects.estadoSolicitudColors'),$registupdates->status_asignation)}}">
					<h5 class="text-bold">ESTADO DE LA SOLICITUD: {{ifArrayNull(Config::get('dataselects.estadoSolicitud'),$registupdates->status_asignation)}}</h5>

				</div>

				<hr/>
				<div class="col-lg-6">
					{!! Field::text('document',$registupdates->document,['readonly'=>'readonly',"required"=>"required", "size"=>"10","label"=>"C&Eacute;DULA:"]) !!}
				</div>
				<div class="col-lg-6">
					{!! Field::text('last_name',strtoupper($registupdates->last_name),['readonly'=>'readonly',"required"=>"required","label"=>"APELLIDOS:",
                    "onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#last_name','width: 100%;text-transform: uppercase')"]) !!}
				</div>
				<div class="col-lg-6">
					{!! Field::text('names',strtoupper($registupdates->first_name),['readonly'=>'readonly',"required"=>"required","label"=>"NOMBRES:",
                    "onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#names','width: 100%;text-transform: uppercase')"]) !!}
				</div>

				<div class="col-lg-6">
					{!! Field::text('email_institu',$registupdates->institution_email,["required"=>"required", "label"=>"EMAIL INSTITUCIONAL:" ]) !!}
				</div>
				<div class="col-lg-6">
					{!! Field::text('email_alternat', $registupdates->alternative_email,  ["required"=>"required","label"=>"EMAIL PERSONAL:"  ]) !!}
				</div>

				<div class="col-lg-6">
					{!! Field::text('phone', $registupdates->phone,  ["required"=>"required","label"=>"TELÉFONO:",
                    "onkeypress"=>"return soloNumeros(event)" ]) !!}
				</div>

				<div class="col-lg-12">
					{!! Field::text('direccion',  $registupdates->direccion,   ["required"=>"required","label"=>"DIRECCI&Oacute;N:"]) !!}
				</div>


				@if($registupdates->status_asignation=='P')
				<div>
					<hr/>
					<div class="col-lg-6">
						<div  class="form-group">
							<label for="rechazo" class="control-label">
								RECHAZAR SOLICITUD:
							</label>
							<div class="controls">
								{!! Form::select('rechazo',['S'=>'SI','N'=>'NO'],'N',['id'=>'rechazo','class'=>'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						{!! Field::textarea('obs_rechazo', null,  ['disabled'=>'disabled','rows'=>'4','style'=>'resize:none',"label"=>"OBSERVACI&Oacute;N:" ]) !!}
					</div>
				</div>
				@endif

				@if($registupdates->status_asignation=='R')
					<div>
						<hr/>
						<div class="col-lg-6">
							<div  class="form-group">
								<label for="rechazo" class="control-label">
									REACTIVAR SOLICITUD:
								</label>
								<div class="controls">
									{!! Form::select('reactivar',['S'=>'SI','N'=>'NO'],'N',['id'=>'reactivar','class'=>'form-control']) !!}
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							{!! Field::textarea('obs_reactivar', null,  ['disabled'=>'disabled','rows'=>'4','style'=>'resize:none',"label"=>"OBSERVACI&Oacute;N:" ]) !!}
						</div>
					</div>
				@endif


			@endforeach
		</div>
		<div class="modal-footer" style="text-align: center;">
					<a href="{{ route('preprofessional.prospects.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
					{!! Form::button('<b><i class=" glyphicon glyphicon-refresh"></i></b> ACTUALIZAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
		</div>


	</div>
</div>
	{!! Form::close() !!}

@endsection
@section('masterCssCustom')

<style >
	.paddingBottom{
		    padding-bottom: 14px;
	}
</style>
@endsection
@section('masterJsCustom')
	<script>
        $(function(){
            $("#rechazo").on('change',function(){
                if(this.value=='N'){
                    $('#obs_rechazo').attr('disabled','disabled');
				}else{
                    $('#obs_rechazo').removeAttr('disabled');
				}
			});
            $("#reactivar").on('change',function(){
                if(this.value=='N'){
                    $('#obs_reactivar').attr('disabled','disabled');
                }else{
                    $('#obs_reactivar').removeAttr('disabled');
                }
            });
        });
	</script>

@endsection

