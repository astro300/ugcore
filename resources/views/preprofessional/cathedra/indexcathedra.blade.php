@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    CATEDRA INTEGRADORA
@endsection
@section('masterDescription')
    Panel Principal de Catedra Integradora
@endsection
@section('mainSearch')
   <h5 class="text-semibold text-bold" style="text-align: center;">CATEDRAS INTEGRADORAS</h5>
    <div class="form-group">
        <div class="col-lg-6">
            {!! Form::open(['route' => ['preprofessional.cathedra.index',$faculty,$career],'method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
            <div class="col-lg-7" style="text-align: left;">
                <a href="{{ route('preprofessional.cathedra.createcathedra',[$faculty,$career])}}"
                   class="btn bg-teal-400 btn-labeled legitRipple">
                    <b><i class="icon-add"></i></b> AGREGAR CATEDRA
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div style="text-align: right;">
                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                    <div class="has-feedback has-feedback-left">
                        {!! Form::text('scope', null, [ "class"=>"form-control input-xlg" ,"placeholder"=>"Buscar por periodo"]) !!}
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
    <table class="table table-bordered bg-white table-hover">
        <thead>
        <tr class="bg-blue">
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PERÏODO</th>
            <th>CICLO</th>
            <th>N° ESTUDIANTES</th>
            <th class="text-center">ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($getCathedra as $getCathedras)
            <tr>
                <td>{{$getCathedras->id}}</td>
                <td>{{Config::get('dataselects.catedra')[$getCathedras->name]}}</td>
                <td>{{$getCathedras->period}}</td>
                <td>{{$getCathedras->cycle}}</td>
                <td>{{$getCathedras->many_estudent}}</td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{ route('preprofessional.cathedra.asignemntstudent',array($getCathedras->id,$faculty,$career))}}"><i class="icon-user-plus"></i>Asignar Estudiante</a></li>
                                <li>
                                    <a href="{{ route('preprofessional.cathedra.EvaluationEstudent',array($getCathedras->id,$faculty,$career))}}"><i class="glyphicon glyphicon-check"></i>Evaluar Estudiantes</a></li>
                                <li>
                                    <a href="{{ route('preprofessional.cathedra.show',array($getCathedras->id,$faculty,$career))}}"><i class="glyphicon glyphicon-list-alt"></i>Mostrar Estudiante</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </br>
    <div style="text-align: center;">
        <a href="{{ route('preprofessional.prospects.indexadministratorreturn',[$faculty,$career])}}"
           class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
    </div>
    {!! $getCathedra->render() !!}
@endsection