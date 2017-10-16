@extends('layouts.back')
@section('masterTitle')
    Registro general de trabajo de titulación
@endsection
@section('masterTitleModule')
    REGISTRO GENERAL DE TRABAJOS DE TITULACIÓN
@endsection
@section('masterDescription')
    Pantalla de registro general de trabajos de titulación
@endsection

@section('mainContent')
    <div class="col-lg-12">
        {!! Field::select('ttfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: '])!!}

    </div>
    <div class="col-lg-12">
        {!! Field::select('ttCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']) !!}
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="datosTrabTitulacion">
                <thead>

                    <th>Nombre del tema</th>
                    <th>Porcentaje similitud</th>
                    <th>Nota de tutoría</th>

                    <th>Nota de revisión</th>
                    <th>Nota de sustentación</th>

                    <th>Promedio Final</th>

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

