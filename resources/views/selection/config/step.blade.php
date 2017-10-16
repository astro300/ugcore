@extends('layouts.back')
@section('masterTitle')
    Configuraciones de Etapas del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Configuraciones de Etapas del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Panel de Configuraciones de etapas del proceso de selecci&oacute;n de personal ingrese los campos necesarios
@endsection
@section('mainContent')
    {!! Form::open(['route'=> ['selection.config.stepsave',$objConfig->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
    <div class="col-lg-12">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">Configuraci&oacute;n de Etapas para {{$objConfig->title}}</h5>
            </div>
            <div class="panel-body">
                <div class="callout bg-teal-300">
                    <div class="row">
                        <div class="col-lg-1 text-center" style=""><i class="fa fa-info fa-2x"></i></div>
                        <div class="col-lg-11">
                            <span class="info-box-text">La vigencia global del proceso es:</span>
                            <span class="info-box-number">Desde: {{$objConfig->date_initial}}  /  {{$objConfig->date_finish}}</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tableDataConcourseConfig">
                        <thead>
                        <th>Etapa</th>
                        <th>Rango Fechas</th>
                        <th>Orden</th>
                        <th>Etapa Anterior</th>
                        <th>Disponible</th>
                        </thead>
                        <tbody>
                        <?php $idx = 0;?>
                        @foreach( $steps as $key=>$step)
                            @php
                            $arrayExclude=['0'=>'SIN DEPENDENCIA']+$steps->toArray();
                            $arrayExclude=array_diff($arrayExclude, array($step));
                            if (@$arraySteps[$key]['date_start']==""){
                            $date="2017-01-01 / 2017-01-01";
                            }else{
                            $date=@$arraySteps[$key]['date_start'].' / '.@$arraySteps[$key]['date_end'];
                            }
                            @endphp
                            <tr style="@php if (@$arraySteps[$key]['status']=='A'){echo 'background-color:#E3F2FD';} @endphp">
                                <td>{{ $step }}</td>
                                <td>
                                    {!! Form::text("array[$key][range]", $date,["class"=>"form-control daterange-basic","id"=>"txtDateRange$idx"]) !!}
                                </td>
                                <td>{!! Form::select("array[$key][order]",\Utils::getFormatArray(1,10,1),@$arraySteps[$key]['ubication']==""?'1':@$arraySteps[$key]['ubication'],["class"=>"select2"]) !!} </td>
                                <td>
                                    {!! Form::select("array[$key][old]",$arrayExclude,@$arraySteps[$key]['step_old'],['class'=>'select2']) !!}

                                </td>
                                <td>{!! Form::select("array[$key][available]",Config::get('dataselects.statusconfirm'),@$arraySteps[$key]['status']==""?'I':@$arraySteps[$key]['status'],["class"=>"select2"]) !!}</td>
                            </tr>
                            <?php $idx++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="text-left">
                        {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR',
                        array('type' => 'submit', 'class' => 'btn btn-warning warning-300  btn-labeled legitRipple')) !!}
                        <a class="btn btn-success btn-labeled legitRipple" href="{{route('selection.config.index')}}"><b><i class=" icon-circle-left2"></i></b> REGRESAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/daterangepicker/moment.min.js')!!}
    {!!Html::script('plugins/daterangepicker/daterangepicker.js')!!}
    <script type="text/javascript">
        $(function () {
            $.each($('.daterange-basic'), function (index, value) {

                var arrayDate = new Array;
                if ($.trim($('#txtDateRange' + index).val()) != '') {
                    arrayDate = $('#txtDateRange' + index).val().split('/');
                } else {
                    arrayDate.push('2017-01-10');
                    arrayDate.push('2017-01-10');
                }

                $('#txtDateRange' + index).daterangepicker({
                    timePicker: false,
                    orientation: 'auto',
                    applyClass: 'btn-primary',
                    cancelClass: 'btn-default',
                    startDate: $.trim(arrayDate[0]),
                    endDate: $.trim(arrayDate[1]),
                    locale: {
                        format: 'YYYY-MM-DD',
                        separator: ' / ',
                        applyLabel: 'ACEPTAR',
                        cancelLabel: 'CANCELAR',
                        startLabel: 'Fecha Inicio:',
                        endLabel: 'Fecha Fin:'
                    }
                });
            });
        });
    </script>
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet" />
    {!!Html::style('plugins/daterangepicker/daterangepicker.css')!!}
@endsection