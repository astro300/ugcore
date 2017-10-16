@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    ESTUDIANTES DE PRÁCTICAS INSTITUCIONALES
@endsection
@section('masterDescription')
    Panel de los estudiantes asignados a las Prácticas Institucionales
@endsection
@section('mainContent')
    @if(!$flag=="true")
        <div class="panel panel-default panel-flat">
            <div class="panel-heading">

                <h5 class="text-semibold text-bold" style="text-align: center;">ESTUDIANTES PRÁCTICAS INSTITUCIONAL - {{strtoupper($NameInstitution['name'])}}</h5>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr >
                            <th>CEDULA</th>
                            <th>NOMBRES Y APELLIDOS</th>
                            <th>TUTOR</th>
                            <th>NOMBRE SUPERVISOR</th>
                            <th>AREA/DEPARTAMENTO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($getresult as list($document , $name_estu,$ape_estu, $name_supervisor, $departament, $Namestutor))
                            <tr>
                                <td>{{$document}}</td>
                                <td>{{strtoupper($name_estu.' '.$ape_estu)}}</td>
                                <td>{{$Namestutor}}</td>
                                <td>{{strtoupper($name_supervisor."")}}</td>
                                <td>{{strtoupper($departament."")}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">NO HAY REGISTRO</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="text-align: center;" class="panel-footer">
                <a href="{{ route('preprofessional.practices.index',array($faculty,$career))}}"
                   class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
            </div>
        </div>

    @endif
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
@endsection