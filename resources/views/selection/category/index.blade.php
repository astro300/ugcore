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
        {!! Form::open(['route'=> 'selection.category.store','method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE TIPOS DE CATEGOR&Iacute;AS</h5>
            </div>
            <div class="panel-body">
                {!! Field::text('name',null,['label'=>'Nombre: ','required'=>'required']) !!}
                {!! Field::select('type', ['1'=>'CATEGORIA','2'=>'SUBCATEGORIA'],null,['empty'=>'-Seleccione-','label'=>'Tipo:',"class"=>"select2",'required'=>'required']) !!}
                <div class="text-right">
                    <br>
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-warning warning-300')) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <br/>
    <input id="txtTypeTable" value="/selection/category/datatables" type="hidden" readonly="readonly"/>
    <div class=" col-lg-7 table-responsive">
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