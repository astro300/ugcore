@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   VALIDACI&Oacute;N DE ACTIVIDADES
@endsection
@section('masterDescription')
    panel de validaci&oacute;n de actividades para los alumnos
@endsection
@include('preprofessional.modals.activityvalidate')
@include('preprofessional.modals.activityanexos')
@section('mainContent')
    <div class="col-lg-12 text-right">
        <form id="returnform" action="{{route('preprofessional.tutor.indexnew',$documenttutor)}}" method="POST"
              style="display: none;">
            <input type="hidden" name="careers" value="{{$career}}"/>

            {{ csrf_field() }}
        </form>
        <button   class="btn btn-warning"
                  onclick="$('#returnform').submit();">REGRESAR</button>
        <br/>
    </div>

    <div>

    <div class="panel panel-primary">

        <div class="panel-body">


            <div class="col-lg-6">
                {!! Field::text('business_address', $getsummarystudents->address,  ['label'=>'LUGAR',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('name_student', strtoupper($getsummarystudents->name_estu.' '.$getsummarystudents->ape_estu),  ['label'=>'ESTUDIANTE',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('business_name',strtoupper($getsummarystudents->name),  ['label'=>'INSTITUCI&Oacute;N RECEPTORA',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('internships_area', strtoupper($getsummarystudents->departament),  ['label'=>'AREA DE DESEMPEÑO',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('supervisor_name',strtoupper($getsummarystudents->name_supervisor),  ['label'=>'SUPERVISOR DE LA INSTITUCI&Oacute;N RECEPTORA',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('supervisor_position',strtoupper($getsummarystudents->position_supervisor),  ['label'=>'CARGO DE SUPERVISOR DE INSTITUCI&Oacute;N',"readonly"=>"readonly" ]) !!}
            </div>



            <div class="panel-body">
                <br/>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="panel panel-danger">
                            <div class="box-header with-border bg-teal-300">
                                <h3 class="box-title">REVISI&Oacute;N DE LAS ACTIVIDADES DEL ESTUDIANTE</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered bg-white table-hover" id="tableActivity">
                                            <thead>
                                            <tr>
                                                <th class="text-center">DIA Y FECHA</th>
                                                <th class="text-center">N° DE HORAS</th>
                                                <th  class="text-center">DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</th>
                                                <th class="text-center">ANEXOS</th>
                                                <th class="text-center">APROBACI&Oacute;N</th>
                                                <th class="text-center">ACCIONES</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @php
                                                $total=0;
                                            $getquantitycount=0;
                                            @endphp
                                            @forelse ($objgetactivity as $objActivity)
                                                @php
                                                    if($objActivity->approved=='1'){
                                                      $getquantitycount = $getquantitycount + $objActivity->number_hours;
                                                      $getcathedracount = $objActivity->cathedra_count;
                                                    }
                                                    $total+= $objActivity->number_hours
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{$objActivity->date_t}}</td>
                                                    <td class="text-center">{{$objActivity->number_hours}}</td>
                                                    <td>{{$objActivity->description}}</td>

                                                    <td class="text-center">
                                                        @if($objActivity->anexos>0)
                                                            <span class="btn bg-light-blue btn-xs" style="cursor: pointer" data-placement="bottom" data-popup="tooltip" data-original-title="VER ANEXOS"
                                                                  onclick="viewAnexosActivity({{$objActivity->id}})" > anexos: {{$objActivity->anexos}}</span>
                                                        @endif
                                                    </td>



                                                    <td class="text-center" id="tdVeredict_{{$objActivity->id}}">
                                                        @if($objActivity->approved==null)
                                                            <small>SIN REVISI&Oacute;N</small>
                                                        @endif
                                                        @if($objActivity->approved=='1')

                                                            <span class="bg-olive btn-xs">APROBADA</span>
                                                        @endif
                                                        @if($objActivity->approved=='0')
                                                            <span class="bg-danger btn-xs">RECHAZADA</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                            <button data-placement="bottom" data-popup="tooltip" data-original-title="EDITAR" onClick='getActivityValidate({{ $objActivity->id }});' class='btn btn-default btn-xs'><i class="fa fa-pencil"></i></button>

                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan="4" class="text-center">NO HAY REGISTROS</td>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>


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
        try{
            $.fn.dataTable.ext.errMode = 'throw';
        }catch (e){}
        $('#tableActivity').dataTable({ responsive: true,"oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        }});
        $("#btnValidateActivity").on('click',function () {
            var objApiRest =new AJAXRest('/preprofessional/validateActividadEstudiante',{veredicto:$("#veredicto").val(),
                obs_veredict:$("#obs_veredict").val(),id_actividad:$("#id_actividad").val(),observation:$("#observation").val(),description:$("#description").val()},'POST');
            objApiRest.extractDataAjax(function (_resultContent, status) {
                if (status == 200) {

                    var actividad=_resultContent.actividad;
                    if($("#veredicto").val()=='1'){
                        $("#tdVeredict_"+actividad).html('<span class="bg-olive btn-xs">APROBADA</span>');
                    }else{
                        $("#tdVeredict_"+actividad).html('<span class="bg-danger btn-xs">REPROBADA</span>');
                    }
                    $('#dvModalValidateActivity').modal('toggle');
                    alertToastSuccess('Proceso realizado correctamente',3500);

                } else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        });

    </script>
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/plugins/fileinput/fileinput.min.css">
@endsection