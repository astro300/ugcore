@extends('layouts.back')
@section('masterTitle')
    Horas Extras - UATH
@endsection
@section('masterTitleModule')
    Horas Extras  - UATH
@endsection
@section('masterDescription')
    Planificación Cuatrimestral Horas Extras- UATH
@endsection
@section('mainContent')
    <div class="row">
        <div class="col-lg-12 col-lg-offset-0">
            {!! Form::open(['id'=>'formdatbas','method'=>'POST', 'class'=>'form-horizontal']) !!}
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading with-border bg-primary-custom" style="padding: 8px; background-color: rgb(224, 247, 250);">
                        <h5 class="panel-title text-primary text-bold" style="text-align: center">DATOS BÁSICOS</h5>
                    </div>
                    <div class="panel-body" style="display: block">
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><b>Cédula</b></label>
                            <div class="col-lg-8">
                                {!! Form::text('bcedula', '',  ["required"=>"required",'placeholder'=>'-Cédula-',"class"=>"form-control",'id'=>'bcedula']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><b>Unidad</b></label>
                            <div class="col-lg-8">
                                {!! Form::text('unidad', '', ['disabled'=>'disabled','class' => 'form-control','placeholder'=>'-Unidad / Área-','required' => 'required',"id"=>'unidad']) !!}
                            </div>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive col-lg-12">
                <table class="table bg-white table-bordered table-hover" id="AdmPersona" style="font-size: 12px;">
                    <thead style="font-size: 13px;" class="bg-info-800">
                    <tr>
                        <th style="text-align: center"><label><b>Cédula</b></label></th>
                        <th style="text-align: center"><label><b>Apellidos y Nombres</b></label></th>
                        <th style="text-align: center"><label><b>Cargo</b></label></th>
                        <th style="text-align: center"><label><b>RMU</b></label></th>
                        <th style="text-align: center"><label><b>Tipo</b></label></th>
                        <th style="text-align: center"><label><b>Horario Jornada Ordinaria (Lun - Vier))</b></label></th>
                        <th style="text-align: center"><label><b>Días de Trabajo Regular</b></label></th>
                        <th style="text-align: center"><label><b>Modalidad Laboral</b></label></th>
                        <th style="text-align: center"><label><b>H. Jornadas Sem. de Trab.</b></label></th>
                    </tr>
                    </thead>
                    <tbody  id="tbodyAdmPersona"></tbody>
                </table>
            </div>
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading with-border bg-primary-custom" style="padding: 8px; background-color: rgb(224, 247, 250);">
                        <h5 class="panel-title text-primary text-bold" style="text-align: center">CÁLCULOS CUATRIMETRALES</h5>
                    </div>
                    <div class="panel-body" style="display: block">
                        <div class="form-group">
                            <br>
                            <label class="col-lg-9 control-label border-left-xlg border-left-info"><b>Horas
                                    Extraordinarias (Sáb, Dom y Feriados) 100%</b></label>
                            <div class="col-lg-3">
                                {!! Form::text('hextra', '0', ["required"=>"required",'placeholder'=>'-Horas Extraordinaria-',"class"=>"form-control",'id'=>'hextra']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-9 control-label border-left-xlg border-left-info"><b>Horas
                                    Suplementarias (Lun - Vier) 50% (Cód.Trab) / 25% (Losep)</b></label>
                            <div class="col-lg-3">
                                {!! Form::text('hsuple', '0',  ["required"=>"required",'placeholder'=>'-Horas Suplementarias-',"class"=>"form-control",'id'=>'hsuple']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-9 control-label border-left-xlg border-left-info"><b>Horas para recargo
                                    nocturno</b></label>
                            <div class="col-lg-3">
                                {!! Form::text('hnoct', '0', ['class' => 'form-control','placeholder'=>'-Recargo Nocturno-','required' => 'required',"id"=>'hnoct']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12" align="center">
                                <button id="btcalcula" type="button" class="btn btn-primary" onclick="CalculaHoras()">
                                    Calcular
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-12 col-lg-offset-2">
                <table class="table table-bordered table-responsive">
                    <thead class="bg-info-800">
                    <tr>
                        <th style="text-align: center"><label><b>Horas Extraordinarias 100%</b></label></th>
                        <th style="text-align: center"><label><b>Valor 100%</b></label></th>
                        <th style="text-align: center"><label><b>horas Suplementarias 50%</b></label></th>
                        <th style="text-align: center"><label><b>Valor 50%</b></label></th>
                        <th style="text-align: center"><label><b>Horas para Recargo Nocturno</b></label></th>
                        <th style="text-align: center"><label><b>Valor Noct</b></label></th>
                        <th style="text-align: center"><label><b>Monto Rquerido</b></label></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{!! Form::textarea('horext', '',  ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Horas Extraordinarias-',"class"=>"form-control",'id'=>'horext']) !!}</td>
                        <td>{!! Form::textarea('valor1', '',  ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Valor 100%-',"class"=>"form-control",'id'=>'valor1']) !!}</td>
                        <td>{!! Form::textarea('horsup', '',  ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Horas Suplementarias-',"class"=>"form-control",'id'=>'horsup']) !!}</td>
                        <td>{!! Form::textarea('valor5', '',  ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Valor 50%-',"class"=>"form-control",'id'=>'valor5']) !!}</td>
                        <td>{!! Form::textarea('hornoct', '', ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Horas Nocturno-',"class"=>"form-control",'id'=>'hornoct']) !!}</td>
                        <td>{!! Form::textarea('valorn', '',  ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Valor Noct.-',"class"=>"form-control",'id'=>'valorn']) !!}</td>
                        <td>{!! Form::textarea('montor', '',  ['rows'=>'2','disabled'=>'disabled',"required"=>"required",'placeholder'=>'-Monto Requerido-',"class"=>"form-control",'id'=>'montor']) !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group col-lg-12 col-lg-offset-2">
                <br>
                <div class="form-group">
                    <label class="col-lg-3 control-label border-left-xlg border-left-info"><b>Actividades a realizar</b></label>
                    <div class="col-lg-3">
                        {!! Form::textarea('actividades', '',  ['style'=>"text-align: left",'rows'=>'5',"required"=>"required",'placeholder'=>'-Actividades a realizar-',"class"=>"form-control",'id'=>'actividades']) !!}
                    </div>
                    <label class="col-lg-3 control-label border-left-xlg border-left-info"><b>Ubicación
                            física</b></label>
                    <div class="col-lg-3">
                        {!! Form::textarea('ubicacion', '',  ['style'=>"text-align: left",'rows'=>'5',"required"=>"required",'placeholder'=>'-Lugar donde realiza la actividad-',"class"=>"form-control",'id'=>'ubicacion']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <br>
    <div class="form-group" align="center">
        <button type="button" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-success">Generar Matriz</button>
        <button type="button" class="btn btn-warning">Imprimir Reporte</button>
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('js/modules/uath/horas_extras.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

@endsection
@section('masterCssCustom')
    <style>
        .textarea {
            resize: none;
            text-align: center;
            color: black;
        }
    </style>
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection
