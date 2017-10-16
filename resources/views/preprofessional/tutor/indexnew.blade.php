@extends('layouts.back')
@section('masterTitle')
   MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
	ESTUDIANTES ASIGNADOS PARA LA TUTORÍA
@endsection
@section('masterDescription')
  listado de estudiantes asignados
@endsection

@section('mainContent')
<div class="col-lg-12">

	<div class="table-responsive">
	<table class="table table-bordered bg-white table-hover">
			<thead>
				<tr>
					<th>ESTUDIANTE</th>
					<th>CORREO INSTITUCIONAL</th>
					<th>INSTITUCIÓN</th>
					<th>DIRECCIÓN</th>
					<th class="text-center">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($getstudenttutoria as $getstudenttutorias)
					<tr>
						<td>{{strtoupper($getstudenttutorias->name_estu.' '.$getstudenttutorias->ape_estu)}}</td>
						<td>{{$getstudenttutorias->institution_email}}</td>
						<td>{{$getstudenttutorias->name}}</td>
						<td>{{$getstudenttutorias->address}}</td>
						<td class="text-center">
							<div class="btn-group-vertical">
								<div class="btn-group">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="fa fa-cog"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a  data-title="DETALLE PROSPECTO" data-toggle="modal"  name="linkResumen" data-mode="modal-md" data-href="{{ route('preprofessional.tutor.showTutor', array($getstudenttutorias->id_student, $getstudenttutorias->document,$documenttutor,$faculty,$career))}}"><i class="icon-file-pdf"></i>Resumen</a></li>
										<li><a href="{{ route('preprofessional.tutor.createEvaluacion', array($getstudenttutorias->id_student, $getstudenttutorias->document,$documenttutor,$faculty,$career))}}"><i class="icon-pencil7"></i>Evaluar Estudiantes</a></li>
										<li><a data-title="EVALUACIONES DE LAS TUTORIAS" data-toggle="modal"  name="linkResumen" data-mode="modal-lg" data-href="{{ route('preprofessional.tutor.showEvaluationStudent', array($getstudenttutorias->id_student,$documenttutor,$faculty,$career))}}"><i class="icon-pencil7"></i>Ver Evaluaciones</a></li>
										<li><a data-title="VALIDAR ACTIVIDADES" href="{{ route('preprofessional.tutor.validateActivity', array($getstudenttutorias->id_student, $getstudenttutorias->document,$documenttutor,$faculty,$career))}}"><i class="icon-pencil7"></i>Validar Actividades</a></li>
									</ul>
								</div>
							</div>

						</td>
					</tr>
				@endforeach
			</tbody>
	</table>
	</div>
</div>

<div id="resumen" class="modal fade in" style="display: none; padding-right: 15px;">
	<div class="" id="modeViewData">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title text-bold" id="titleModal"></h5>
			</div>
			<div class="modal-body panel-body" id="panelResumenBody">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

{!! $getstudenttutoria->render() !!}

@endsection
@section('masterCssCustom')
	<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection

@section('masterJsCustom')
	<script>
        $("a[name=linkResumen]").on('click',function (e) {
           e.preventDefault();
			var href=$(this);
            var objApiRest = new AJAXRest($(this).attr('data-href'), {}, 'GET');
            objApiRest.extractDataAjax(function (_resultContent, status) {
                if (status == 200) {
                    $('#titleModal').html(href.attr('data-title'));
                    $("#modeViewData").attr('class','modal-dialog '+href.attr('data-mode'));
                    $('#panelResumenBody').html(_resultContent);
                    $('#resumen').modal({
                        show: false,
                        backdrop: 'static'
                    });
                    $("#resumen").modal('show');
                } else {
                    alertToast(_resultContent.message, 3500);
                }
            });



         //  $('#panelResumenBody').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br/>.. CARGANDO ..</div>');
         //  $('#panelResumenBody').load($(this).attr('data-href'));




        });
	</script>
@endsection	
