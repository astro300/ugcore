<?php //dd($id);
//dd($modulo_etapa[0]);?>
@extends('layouts.back')
@section('masterTitle')
Configuraciones
@endsection
@section('masterTitleModule')
Edición Parametros
@endsection
@section('masterDescription')
Definir Cambios en los Parametros

@endsection
@section('mainBox')
<div class="col-lg-12 text-right">
    <a href="/titulacion/Configuraciones" class="btn bg-teal-400"><i
                class="icon-plus-circle2 position-left"></i>Nuevo</a>

</div>
@endsection
@section('mainContent')

<div class="col-lg-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Datos Generales</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Consultas Generales</a></li>


        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="tab_2">

                <div class="table-responsive">
                    <table class="table table-bordered bg-white" id="datosUsuarios">
                        <thead>

                        <th>CARRERA</th>
                        <th>CICLO</th>
                        <th>ETAPA</th>
                        <th>TIPO</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FINAL</th>

                        <th>ACCIONES</th>
                        </thead>
                    </table>
                </div>


            </div>


            <div class="tab-pane active" id="tab_1">

                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Formulario de Registro
                            </div>
                            <div class="panel-body">

                                {!! Form::open(['route'=>['titulacion.configuraciones.update',$cemt['dato']->id],
                                'enctype'=>'multipart/form-data','method'=>'PUT']) !!}
                                <div class="panel-body">

                                    {!!Field::select('modulo',$cemt['modulo'],$modulo_etapa[0],['class'=>'select2','label'=>'MODULO:','empty'=>'-SELECCIONE-'])!!}
                                    {!!Field::select('etapa',$cemte['etapa'],$cemt['dato']->etapa,['class'=>'select2','label'=>'ETAPA:','empty'=>'-SELECCIONE-'])!!}
                                    {!!Field::select('facultad',$faculties,$cemt['dato']->faculties,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD:'])!!}
                                    {!!Field::select('carrera',$carrera,$cemt['dato']->carrera,['class'=>'select2','label'=>'CARRERA:'])
                                    !!}
                                    {!!Field::select('tipo',$cemt['tipo'],$cemt['dato']->tipo,['class'=>'select2','label'=>'TIPO:','empty'=>'-SELECCIONE-'])!!}
                                    {!!Field::select('ciclo',$ciclo,$cemt['dato']->ciclo,['class'=>'select2','label'=>'CICLO:','empty'=>'-SELECCIONE-'])!!}


                                    <label class="col-lg-3 control-label text-bold"><i
                                                class="text-danger">*</i> Inicio</label>
                                    <div class="input-group">

                                        {!!
                                        Form::text('fecha_inicio',$cemt['dato']->fecha_inicio,['class'=>'form-control
                                        pickadate','id'=>'fechai','placeholder'=>'Seleccione fecha ', ""]) !!}
                                        <span class="input-group-addon"><i
                                                    class="icon-calendar text-muted"></i></span>
                                    </div>

                                    <br/>
                                    <label class="col-lg-3 control-label text-bold"><i
                                                class="text-danger">*</i> Fin</label>
                                    <div class="input-group">

                                        {!! Form::text('fecha_final',$cemt['dato']->fecha_fin,['class'=>'form-control
                                        pickadate','id'=>'fechaf','placeholder'=>'Seleccione fecha ', ""]) !!}
                                        <span class="input-group-addon"><i
                                                    class="icon-calendar text-muted"></i></span>
                                    </div>


                                </div>

                                <div class="panel-footer">
                                    <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->

</div>


@endsection
@section('masterJsCustom')
{!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
{!!Html::script('plugins/fileinput/fileinput.min.js')!!}
{!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

<script src="{{asset('/js/modules/titulacion/datos.js')}}"></script>
<script>
    $('.pickadate').datepicker({
        formatSubmit: 'yyyy-mm-dd',
        format: 'yyyy-mm-dd',
        selectYears: true,
        editable: true,
        autoclose: true,
        orientation: 'top'
    });

</script>
@endsection
@section('masterCssCustom')
{!!Html::style('/css/datatables.css')!!}
{!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
{!!Html::style('/plugins/datepicker/datepicker3.css')!!}
{!! Html::style('/css/checkbox.css') !!}

@endsection

