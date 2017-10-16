@extends('layouts.back')
@section('masterTitle')
    Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Edici&oacute;n para Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Panel de Configuraciones del Proceso ingrese los campos necesarios
@endsection
@section('mainContent')
    <div class="col-lg-4">
        {!! Form::open(['route'=> ['selection.config.update',$objConfig->id],'method'=>'PUT', 'enctype'=>"multipart/form-data"]) !!}
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h5 class="panel-title text-bold" style="text-align: center;">Configuraciones del Proceso</h5>
            </div>
            <div class="panel-body">
                {!! Field::text('title',$objConfig->title,['label'=>'T&iacute;tulo: ','required'=>'required']) !!}
                {!! Field::text('description',$objConfig->description,['label'=>'Descripci&oacute;n: ','required'=>'required']) !!}
                {!! Field::text('txtDateRange',$objConfig->date_initial." / ".$objConfig->date_finish,['class'=>'daterange-basic','label'=>'Vigencian: ','required'=>'required']) !!}
                {!! Field::select('status', Config::get('dataselects.status'),$objConfig->status,['empty'=>'-Seleccione-','label'=>'Estado:','class'=>'select2','required'=>'required']) !!}
                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-warning warning-300  btn-labeled')) !!}
                <a href="{{route('selection.config.index')}}"  class="btn btn-success warning-300 btn-labeled "><b><i class=" icon-undo2 position-left"> </i></b>CANCELAR</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <br/>
    <input id="txtTypeTable" value="/selection/config/datatables" type="hidden" readonly="readonly"/>
    <div class="col-lg-8 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tableDataConcourseConfig">
            <thead>
            <tr>
                <th style="width: 38%">T&iacute;tulo</th>

                <th style="width: 17%">Fecha Vigencia</th>
                <th style="width: 18%">Acciones</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/daterangepicker/moment.min.js')!!}
    {!!Html::script('plugins/daterangepicker/daterangepicker.js')!!}
    {!!Html::script('js/modules/selection/catalogs.js')!!}
    <script>
        $('#txtDateRange').daterangepicker({
            locale:{
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
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet" />
    {!!Html::style('plugins/daterangepicker/daterangepicker.css')!!}
@endsection