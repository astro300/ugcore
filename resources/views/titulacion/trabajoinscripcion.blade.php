@extends('layouts.back')
@section('masterTitle')
    Inscripci&oacute;n
@endsection
@section('masterTitleModule')
    Datos del Trabajo de Titulaci&oacute;n
@endsection
@section('masterDescription')
    Descripcion
@endsection

@section('mainContent')

    <div class="col-lg-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">DATOS GENERALES</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">DOCENTES</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">ESTUDIANTES</a></li>
                    </li>


            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    <div class="row">

                        <div class="col-lg-5">
                                {!! Form::open(['route'=>'titulacion.trabajo.tema.store', 'enctype'=>'multipart/form-data']) !!}

                            <div class="panel-body">

                                {!! Field::text('tema',['class'=>'form-control','id'=>'trabajo','placeholder'=>'Tema de Titulación', 'label'=>"TEMA DE TITULACIÓN(TÍTULO):"]) !!}


                                {!! Field::select('facultad',$faculties,null,['empty'=>'* seleccione','class'=>'select2','label'=>'FACULTAD: '])!!}
                                {!! Field::select('carrera',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'CARRERA: ']) !!}
                                {!! Field::select('ciclo',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'CICLO: ']) !!}
                                {!! Field::select('area_investigacion',[],null,['empty'=>'seleccione','class'=>'select2','label'=>'AREA DE INVESTIGACIÓN: ']) !!}
                                
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                            {!!Form::close()!!}
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="TrabajoInscripcion">
                                    <thead>

                                    <th>TEMA</th>
                                    <th>FACULTAD</th>
                                    <th>CARRERA</th>
                                    <th>FECHA DE REGISTRO</th>

                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane" id="tab_2">

                    <div class="row">

                        <div class="col-lg-5">
                            <div class="panel-body">

                                {!! Field::text('cedula_tutor',['class'=>'form-control','id'=>'cedula_tutor','placeholder'=>'Cédula del Tutor', 'label'=>'CÉDULA DEL TUTOR:'])!!}

                                 {!! Field::select('nombre_tutor',[],null,['class'=>'select2','label'=>'NOMBRE DEL TUTOR:','empty'=>'-SELECCIONE-']) !!}

                                 {!! Field::select('carrera_tutor',[],null,['class'=>'select2','label'=>'CARRERA:','empty'=>'-SELECCIONE-']) !!}

                                 {!! Field::select('trabajo_titulacion',[],null,['class'=>'select2','label'=>'NOMBRE DEL TRABAJO DE TITULACION:','empty'=>'-SELECCIONE-']) !!}

                                  {!! Field::select('TipoDocente',[],null,['class'=>'select2','label'=>'TIPO DE DOCENTE:','empty'=>'-SELECCIONE-']) !!}


                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="Tutores">
                                    <thead>

                                    <th>DOCENTE</th>
                                    <th>TRABAJO</th>
                                    <th>CARRERA</th>
                                     <th>PERIODO LECTIVO</th>
                                    <th>TIPO DOCENTE</th>
                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">


                    <div class="row">

                        <div class="col-lg-5">
                            <div class="panel-body">

                                {!! Field::text('cedula_estudiante',['class'=>'form-control','id'=>'cedula_estudiante','placeholder'=>'Cédula del Estudiante', 'label'=>'CÉDULA DEL ESTUDIANTE:'])!!}


                                 {!! Field::select('nombre_estudiante',[],null,['class'=>'select2','label'=>'NOMBRE DEL ESTUDIANTE:','empty'=>'-SELECCIONE-']) !!}


                                 {!! Field::select('carrera_estudiante',[],null,['class'=>'select2','label'=>'CARRERA:','empty'=>'-SELECCIONE-']) !!}

                                 {!! Field::select('tesis',[],null,['class'=>'select2','label'=>'NOMBRE DEL TRABAJO DE TITULACION:','empty'=>'-SELECCIONE-']) !!}
                              

                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" id="Estudiante">
                                    <thead>

                                    <th>ESTUDIANTE</th>
                                    <th>TRABAJO</th>
                                    <th>CARRERA</th>
                                     <th>PERIODO LECTIVO</th>

                                    <th>ACCIONES</th>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

              


                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->

    </div>





@endsection
@section('masterJsCustom')

    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

    <script src="{{asset('/js/modules/titulacion/datos.js')}}"></script>

@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}

    {!! Html::style('/css/checkbox.css') !!}

@endsection

