@extends('layouts.back')
@section('masterTitle')
    Categor&iacute;as Para Formulario
@endsection
@section('masterTitleModule')
    Categor&iacute;as Para Formulario del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Lista de las Categor&iacute;as Para Formulario del Proceso de Selecci&oacute;n de Personal
@endsection
@section('mainContent')
    <div class="col-lg-5">
        {!! Form::open(['route'=> ['selection.category.update',$objCategory->id],'method'=>'PUT', 'enctype'=>"multipart/form-data"]) !!}
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h5 class="panel-title text-bold" style="text-align: center;">EDICI&Oacute;N DE TIPOS DE CATEGOR&Iacute;AS</h5>
            </div>
            <div class="panel-body">
                {!! Field::text('name',$objCategory->name,['label'=>'Nombre: ','required'=>'required']) !!}
                {!! Field::select('type', ['1'=>'CATEGORIA','2'=>'SUBCATEGORIA'],$objCategory->type,['empty'=>'-Seleccione-','label'=>'Tipo:',"class"=>"select2",'required'=>'required']) !!}
                {!! Field::select('status',Config::get('dataselects.status'),$objCategory->status,['empty'=>'-Seleccione-',"class"=>"select2",'label'=>'Estado:','required'=>'required']) !!}
                <div class="text-left">
                    <br>
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-warning warning-300  btn-labeled')) !!}
                    <a href="{{route('selection.category.index')}}" class="btn btn-success warning-300 btn-labeled"><b><i class=" icon-undo2 position-left"> </i></b>CANCELAR</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <br/>
    <input id="txtTypeTable" value="/selection/category/datatables" type="hidden" readonly="readonly"/>
    <div class="col-lg-7 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tableData">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Categor&iacute;a</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('js/modules/selection/catalogs.js')!!}
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet" />
@endsection