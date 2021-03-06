@extends('layouts.back')
@section('masterTitle')
    Tipos de Documentos Para Formulario
@endsection
@section('masterTitleModule')
    Tipos de Documentos Para Formulario del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Lista de Tipos de Documentos Para Formulario del Proceso de Selecci&oacute;n de Personal
@endsection


@section('mainContent')
    <div class="col-lg-5">
        {!! Form::open(['route'=> ['selection.typedocument.update',$objTypeDocument],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">TIPOS DE DOCUMENTOS</h5>
            </div>
            <div class="panel-body">

                {!! Field::text('name',$objTypeDocument->name,['label'=>'Nombre:','required'=>'required']) !!}
                {!! Field::text('description',$objTypeDocument->description,['label'=>'Descripci&oacute;n: ','required'=>'required']) !!}
                {!! Field::text('prefix',$objTypeDocument->prefix,['label'=>'Prefijo: ','required'=>'required']) !!}
                {!! Field::text('nametable',$objTypeDocument->nametable,['label'=>'Tabla: ']) !!}
                {!! Field::select('status',Config::get('dataselects.status'),$objTypeDocument->status,['label'=>'Estado: ','class'=>'select2','required'=>true]) !!}




                <div class="text-left">
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-warning warning-300  btn-labeled legitRipple btn-xs')) !!}
                    <a href="{{route('selection.typedocument.index')}}" class="btn btn-success warning-300 btn-labeled legitRipple btn-xs"><b><i
                                    class=" icon-undo2 position-left"> </i></b>CANCELAR</a>
                </div>
            </div></div>
        {!! Form::close() !!}
    </div>
    <div class="col-lg-7">
    <input id="txtTypeTable" value="{{route('selection.typedocument.datatables')}}" type="hidden" readonly="readonly"/>
    <div class="table-responsive">
        <table class="table table-bordered bg-white table-hover" id="tableDataTypeDocument">
            <thead>
            <tr>
                <th style="width: 70%">Nombre</th>
                <th style="width: 10%">Prefijo</th>
                <th style="width: 10%">Status</th>
                <th style="width: 10%">Acciones</th>
            </tr>
            </thead>

        </table>
    </div>
    </div>

@endsection


@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('js/modules/selection/catalogs.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
@endsection

