@extends('layouts.back')
@section('masterTitle')
    Tutorias
@endsection
@section('masterTitleModule')
    Tutorias
@endsection
@section('masterDescription')
    Panel 
@endsection

@section('mainContent')
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">DATOS</div>
           
            <div class="panel-body">
                {!! Field::text('nombre',null,['placeholder'=>'INGRESE NOMBRE DE LA EVIDENCIA','label'=>'NOMBRE DE EVIDENCIA:']) !!}
                {!! Field::select('tesis',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'TESIS: '])!!}

                {!! Field::file('documentoFoto',['id'=>'documentoFoto','accept'=>"image/*",'label'=>'FOTO']) !!}
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>
            </div>
           
        </div>
    </div>
    <div class="col-lg-7">
        <div class="table-responsive">
                <table class="table table-bordered bg-white" id="datosUsuariosSeguimiento">
                        <thead>
                            <th>CARRERA</th>
                            <th>DOCENTE</th>
                            <th>ESTUDIANTE</th>
                            <th>FECHA REGISTRO</th>

                            <th>ACCIONES</th>
                        </thead>
                </table>
        </div>
    </div>

@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

    <script src="{{asset('/js/modules/titulacion/datos.js')}}"></script>

@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
    {!! Html::style('/css/checkbox.css') !!}

@endsection

