@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    PRACTICAS INSTITUCIONALES
@endsection
@section('masterDescription')
    Panel Principal de Practicas Insitutcionales
@endsection
@section('mainBox')
    {!! Form::open(['route' => ['preprofessional.practices.index',$faculty,$career],'method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
    <div class="form-group">
        <div class="col-lg-6">
            <div class="col-lg-7" style='padding-left: 1em'>
                <a href="{{ route('preprofessional.practices.create',[$faculty,$career])}}"
                   class="btn bg-teal-400 btn-labeled legitRipple">
                    <b><i class="icon-add"></i></b> AGREGAR INSTITUCIÓN
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div style="text-align: right;">
                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                    <div class="has-feedback has-feedback-left">
                        {!! Form::text('scope', null, [ "class"=>"form-control input-xlg" ,"placeholder"=>"Buscar por nombre institucion"]) !!}
                        <div class="form-control-feedback">
                            <i class="icon-search4 text-muted text-size-base"></i>
                        </div>
                    </div>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('mainContent')
    <div class="table-responsive">
        <table class="table table-bordered bg-white table-hover">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">INSTITUCION</th>
                <th class="text-center">TIPO</th>
                <th class="text-center">FECHA REGISTRO</th>
                <th class="text-center">Nº ESTUDIANTES</th>
                <th class="text-center">DESCRIPCIÓN</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($objgetinstitutiones as $objgetinstitutionesn)
                <tr>
                    <td style="text-align: center;">{{$objgetinstitutionesn->id}}</td>
                    <td style="text-align: center;">{{strtoupper($objgetinstitutionesn->name."")}}</td>
                    <td style="text-align: center;">{{$objgetinstitutionesn->type}}</td>
                    <td style="text-align: center;">{{Utils::getDataFormatWEBDatetimeSqln($objgetinstitutionesn->getAttributes()['created_at']) }}</td>
                    <td style="text-align: center;">{{$objgetinstitutionesn->many_estudent}}</td>
                    <td>{{$objgetinstitutionesn->description}}</td>
                    <td class="text-center">
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="fa fa-cog"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route('preprofessional.practices.assignmentStuentpractices', array($objgetinstitutionesn->id,$faculty,$career))}}"><i class="icon-user-plus"></i>Asignar Estudiante</a></li>
                                    <li><a href="{{ route('preprofessional.practices.show',array($objgetinstitutionesn->id,$faculty,$career))}}"><i class="icon-vcard"></i>Mostrar Estudiante</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $objgetinstitutiones->render() !!}
    </br>
    <div style="text-align: center;">
        <a href="{{ route('preprofessional.prospects.indexadministratorreturn',[$faculty,$career])}}"
           class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
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