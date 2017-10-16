@extends('layouts.back')
@section('masterTitle')
    Notas de Sustentación
@endsection
@section('masterTitleModule')
    Registros de notas de Sustentación
@endsection
@section('masterDescription')
    Pantalla general de trabajos de titulación registrados
@endsection

@section('mainContent')
    <div class="col-lg-12">
        {!! Field::select('rfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: '])!!}

    </div>
    <div class="col-lg-12">
        {!! Field::select('rCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']) !!}
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="datosUsuarios">
                <thead>

                <th>NºIdentificación</th>
                <th>Nombres integrantes</th>
                <th>Nombre de tema</th>

                <th>Tutor</th>
                <th>Nota de Sustentación</th>

                <th>
                    <a href="#"> procesar</a>
                </th>

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
    <script>
        $('.pickadate').datepicker({
            formatSubmit: 'yyyy-mm-dd',
            format: 'yyyy-mm-dd',
            selectYears: true,
            editable: true,
            autoclose: true,
            orientation:'top'
        });

    </script>
@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
    {!!Html::style('/plugins/datepicker/datepicker3.css')!!}
    {!! Html::style('/css/checkbox.css') !!}

@endsection

