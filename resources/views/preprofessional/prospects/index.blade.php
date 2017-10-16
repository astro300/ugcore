@extends('layouts.back')
@section('masterTitle')
    PROSPECTOS
@endsection
@section('masterTitleModule')
    TODOS LOS PROSPECTOS
@endsection
@section('masterDescription')
    Panel principal de Prospectos
@endsection
@section('mainBox')
    <div class="col-lg-12">
        <div style="text-align: left;">
            <a href="{{ route('preprofessional.prospects.create', [$faculty,$carrer])}}"
               class="btn bg-teal-400 btn-labeled legitRipple">
                <b><i class="icon-add"></i></b> AGREGAR PROSPECTO
            </a>
        </div>
    </div>
    <div class="col-lg-7 col-lg-offset-5">
        {!! Form::open(['route' => ['preprofessional.prospects.index',$faculty,$carrer],'method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
        <div class="input-group content-group" style="margin-bottom: 10px !important;">
            <div class="has-feedback has-feedback-left">
                {!! Form::text('scope', null, [ "class"=>"form-control input-xlg" ,"placeholder"=>"Buscar por cédula estudiante"]) !!}
                <div class="form-control-feedback">
                    <i class="icon-search4 text-muted text-size-base"></i>
                </div>
            </div>
            <div class="input-group-btn">
                <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('mainContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover">
                <thead>
                <tr class="bg-blue">
                    <th class="text-center">CEDULA</th>
                    <th class="text-center">NOMBRE COMPLETO</th>
                    <th class="text-center">FECHA SOLICITUD</th>
                    <th class="text-center">NIVEL</th>
                    <th class="text-center">ESTADO SOLICITUD</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($getstudent as $key=> $getstudents)
                    <tr>
                        <td>{{$getstudents->document}}</td>
                        <td>{{strtoupper($getstudents->fullName())}}</td>
                        <td>{{$getstudents->created_at}}</td>
                        <td>{{$getstudents->semester}}</td>
                            <td style="{{ifArrayNull(Config::get('dataselects.estadoSolicitudColors'),$getstudents->status_asignation)}}">
                                {{ifArrayNull(Config::get('dataselects.estadoSolicitud'),$getstudents->status_asignation)}}</td>
                        <td>
                            <div class="btn-group-vertical">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="fa fa-cog"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="" data-toggle="modal" data-target="#modal_theme_resumen_{{$key}}"><i class="icon-vcard"></i>Resumen</a></li>
                                        <li><a href="{{ route('preprofessional.prospects.updateprospects',array($getstudents->document,$faculty,$carrer))}}"><i class="icon-pencil7"></i>Editar</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--Ventana de detalles de prospectos-->
                            <div id="modal_theme_resumen_{{$key}}" class="modal fade in" style="display: none; padding-right: 15px;">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h5 class="modal-title text-bold">Detalle Prospecto</h5>
                                        </div>
                                        <div class="modal-body panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr><td><b>CÉDULA</b></td><td>{{$getstudents->document}}</td></tr>
                                                    <tr><td><b>NOMBRE COMPLETO</b></td><td>{{strtoupper($getstudents->first_name.' '.$getstudents->last_name)}}</td></tr>
                                                    <tr><td><b>CORREO INSTITUCIONAL</b></td><td>{{$getstudents->institution_email}}</td></tr>
                                                    <tr><td><b>CORREO ALTERNATIVO</b></td><td>{{$getstudents->alternative_email}}</td></tr>
                                                    <tr><td><b>TELÉFONO</b></td><td>{{$getstudents->phone}}</td></tr>
                                                    <tr><td><b>FACULTAD</b></td><td>{{$getfaculties[0]->NOMBRE}}</td></tr>
                                                    <tr><td><b>CARRERA</b></td><td>{{$getcareers[0]->NOMBRE_CARRERA}}</td></tr>
                                                    <tr><td><b>FECHA DE INSCRIPCIÓN</b></td><td>{{Utils::getDataFormatWEBDatetimeSqln($getstudents->getAttributes()['created_at'])}}</td></tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Regresar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center"> ** NO HAY REGISTROS **</td>
                        </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div style="text-align: center;">
            <a href="{{ route('preprofessional.prospects.indexadministratorreturn',[$faculty,$carrer])}}"
               class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
        </div>
        {!! $getstudent->render() !!}
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
    {!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection