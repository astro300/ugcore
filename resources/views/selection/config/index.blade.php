@extends('layouts.back')
@section('masterTitle')
    Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Lista de Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('mainContent')
    <div class="col-lg-4">
        {!! Form::open(['route'=> 'selection.config.store','method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">Configuraciones Proceso Selecci&oacute;n</h5>
            </div>
            <div class="panel-body">
                {!! Field::text('title',['label'=>'T&iacute;tulo: ','required'=>'required']) !!}
                {!! Field::text('description',['label'=>'Descripci&oacute;n: ','required'=>'required']) !!}
                {!! Field::text('txtDateRange',['label'=>'Vigencia: ','required'=>'required']) !!}
            </div>
            <div class="panel-footer">
                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary warning-300  btn-labeled legitRipple')) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <br/>
    <input id="txtTypeTable" value="/selection/config/datatables" type="hidden" readonly="readonly"/>
    <div class="col-lg-8">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover" id="tableDataConcourseConfig">
                <thead>
                <tr>
                    <th style="width: 38%">T&iacute;tulo</th>
                    <th style="width: 17%">Fecha Vigencia</th>
                    <th style="width: 18%">Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/daterangepicker/moment.min.js')!!}
    {!!Html::script('plugins/daterangepicker/daterangepicker.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('js/modules/selection/catalogs.js')!!}
    <script>
        $('#txtDateRange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' / ',
                applyLabel: 'Aceptar',
                cancelLabel: 'Cancelar',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData().firstDayOfWeek(),
                autoApply: true,
            }
        });


    </script>
@endsection
@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
    {!!Html::style('plugins/daterangepicker/daterangepicker.css')!!}
@endsection