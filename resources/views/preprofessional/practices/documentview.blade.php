@extends('layouts.back')
@section('masterTitle')
   MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   DOCUMENTOS DEL PROCESO
@endsection
@section('masterDescription')
  Panel Principal de documentos del proceso por el estudiante
@endsection

@include('preprofessional.modals.documentsupdate')
@include('preprofessional.modals.insertsecretarycarrer')
@section('mainContent')
<div class="table-responsive">
	<table class="table table-bordered bg-white table-hover" id="tableActivity">
			<thead>
				<tr>
					<th><center>NOMBRE DOCUMENTO</center></th>
					<th><center>FECHA CREACION</center></th>
					<th><center>ACCION</center></th>
					</tr>
			</thead>
			<tbody>

			@foreach ($getdocumentstudent as $getdocumentstudents) 
				<tr>
					<td style="text-align: left;">{{$getdocumentstudents->name_file}}</td>
					<td style="text-align: center;">{{Utils::getDataFormatWEBDatetimeSqln($getdocumentstudents->created_at)}}</td>
					<td class="text-center">
						 <button OnClick="iddocument('{{ $getdocumentstudents->id_document }}','{{$getdocumentstudents->id_student}}','{{$faculty}}','{{$career}}');" class='btn btn-default btn-sm' data-toggle='modal' data-target='#dvModalupdatedocument'
						 data-placement="bottom" data-popup="tooltip" data-original-title="MODIFICAR DOCUMENTO"
						 ><i class="glyphicon glyphicon-pencil"></i></button>
						 <a href="{{ route('preprofessional.practices.downlandDocument',$getdocumentstudents->id_document)}}" class="btn btn-default btn-sm" data-placement="bottom" data-popup="tooltip" data-original-title="DESCARGAR DOCUMENTO">
						        <b><i class="glyphicon glyphicon-save"></i></b>
					     </a>
					</td>		
				</tr>
<?php
$id_student=$getdocumentstudents->id_student;
?>
				@endforeach	
			</tbody>
	</table>
</div>
	</br>

<div class="table-responsive">
			<table width="100%">
				<tr>
					<td style="text-align: left;">
						<a href="{{ route('preprofessional.prospects.indexadministratorreturn',array($faculty,$career))}}" class="btn btn-warning warning-300 "><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
					</td>
					@if(count($getdocumentstudent)>0)
						<td style="text-align: right;">
						<button OnClick='idstudent(<?php echo $id_student ?>);' class='btn btn-primary dropdown-toggle' data-toggle='modal' data-target='#dvModalinsertsecretary'
						 data-placement="bottom" data-popup="tooltip" data-original-title="DESCARGAR CERTIFICADO FINAL"
						 >DESCARGAR CERTIFICADO FINAL</button>
					</td>
					<td style="text-align: right;">
						<a data-placement="bottom" data-popup="tooltip" data-original-title="ENVIAR CERTIFICADO FINAL" id='certifique' class="btn btn-primary dropdown-toggle"
                                     onclick="return alertemailcertifique('{{ route('preprofessional.practices.emailcertificatestudent',$id_student)}}')">ENVIAR CERTIFICADO FINAL</a></td>
					</td>
					@endif
				</tr>
			</table>
</div>




@endsection
@section('masterJsCustom')
	{!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
	{!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
	<script type="text/javascript" src="{{ asset('plugins/fileinput/fileinput.min.js') }}"></script>
	{!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
	{!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
	<script>
		try{
            $.fn.dataTable.ext.errMode = 'throw';
		}catch (e){}
        $('#tableActivity').dataTable({ responsive: true,"oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        }});
        $('.file-inputall').fileinput({
            maxFileSize:2000,
            browseLabel: '',
            removeLabel:'',
            showPreview:false,
            language: "es",
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>'
            },
            initialCaption: "",
            allowedFileExtensions: ["pdf","rar","zip"]
        }).on('fileerror',function(event, data){
            alertToast("Solo se admiten extensiones pdf/rar/zip, con peso de 2mb",2000);
        });
	</script>
@endsection

@section('masterCssCustom')

	<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
	{!!Html::style('plugins/datepicker/datepicker3.css')!!}

	<link rel="stylesheet" type="text/css" href="/plugins/fileinput/fileinput.min.css">
@endsection