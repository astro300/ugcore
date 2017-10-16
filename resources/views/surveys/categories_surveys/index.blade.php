@extends('layouts.back')
@section('masterTitle')
    Configuraci&oacute;n de Categor&iacute;as de Encuestas del Sistema
@endsection
@section('masterTitleModule')
    Categor&iacute;as de Encuestas
@endsection
@section('masterDescription')
    Panel de administraci&oacute;n para categor&iacute;as de encuestas
@endsection

@section('mainContent')
    <div class="col-lg-5">
        {!! Form::open(['route'=> 'surveys.categories_surveys.store','method'=>'POST','enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE CATEGOR&Iacute;AS</h5>
            </div>
            <div class="panel-body">

                {!! Field::text('name',null,['label'=>'Nombre:','required'=>true]) !!}
                {!! Field::select('status',Config::get('dataselects.status'),'A',['label'=>'Estado:','required'=>true,"class"=>"select2" ]) !!}


                <div class="text-left">
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-success  btn-block')) !!}

                </div>
            </div></div>
        {!! Form::close() !!}
    </div>

    <div class="col-lg-7">
        <input id="txtTypeTable" value="{{route('surveys.category.datatable')}}" type="hidden" readonly="readonly"/>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover bg-white" id="tableData">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>


@endsection


@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('js/modules/surveys/catalogs_surveys.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
@endsection
