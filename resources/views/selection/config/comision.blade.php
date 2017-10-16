@extends('layouts.back')
@section('masterTitle')
Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
Matrices para Configuraciones de comisiones Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
Panel de Configuraci&oacute;n de comisiones del proceso
@endsection
@section('mainContent')
    {!! Form::open(['route'=> ['selection.config.saveOrUpdateComisiones',$concourseConfig->id],'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}

    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">COMISIONES
                    PARA {{ $concourseConfig->title  }}</h5>
            </div>
            <div class="panel-body">

                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white table-hover" id="tableDataConcourseConfig">
                            <thead>
                            <tr>
                                <th style="text-align:center;vertical-align: middle">Facultad</th>
                                <th style="text-align:center;vertical-align: middle">Campo Amplio</th>
                                <th style="text-align:center;vertical-align: middle">Campo Espec&iacute;fico</th>
                                <th style="text-align:center;vertical-align: middle">Campo Detallado</th>
                                <th style="text-align:center;vertical-align: middle">Campo Disciplinas</th>
                                <th style="text-align:center;vertical-align: middle">Comisi&oacute;n Asignadas</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($concourseMatriz as $matriz)
                                <tr>
                                    <td style="text-align: center">{{@$faculties[$matriz->facultad_id]}}</td>
                                    <td style="text-align: center">{{$matriz->extendsField->description}}</td>
                                    <td style="text-align: center">{{$matriz->specificField->description}}</td>
                                    <td style="text-align: center">{{$matriz->detailField->description}}</td>
                                    <td style="text-align: center">
                                        @foreach($matriz->concourseMatrizDetail as $discipline)
                                            {{$discipline->disciplineField->description  }}<br/>
                                        @endforeach

                                    </td>
                                    <td style="text-align: center">
                                        <div class="form-group">
                                            <label for="usuarios_id" class="control-label">
                                                EVALUACIONES
                                            </label>
                                            <div class="controls">

                                                {!! Form::select("usuariosEvaluaciones[".$matriz->id."][]", $users,@$userComisionsData[$matriz->id][1],
                                    ['class'=>'select2','multiple'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="usuarios_id" class="control-label">
                                               APELACIONES
                                            </label>
                                            <div class="controls">
                                                {!! Form::select("usuariosApelaciones[".$matriz->id."][]", $users,@$userComisionsData[$matriz->id][2],
                                    ['class'=>'select2','multiple'=>true]) !!}
                                            </div>
                                        </div>




                                    </td>

                                </tr>
                            @empty
                                <tr><td colspan="8" style="text-align: center"> NO HAY REGISTROS DISPONIBLES </td></tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR',
                array('type' => 'submit', 'class' => 'btn btn-primary warning-300  ')) !!}
                <a href="{{route('selection.config.index')}}" class="btn btn-danger warning-300  "><b><i
                                class=" icon-undo2 position-left"> </i></b>CANCELAR</a>

            </div>
        </div>

    </div>
    {!! Form::close() !!}
@endsection
@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
    {!! Html::style('/css/checkbox.css') !!}
    <style>
        td {
            vertical-align: middle !important;
        }

    </style>
@endsection