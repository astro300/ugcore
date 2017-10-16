@extends('layouts.back')
@section('masterTitle')
    PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    EVALUACIÓN ESTUDIANTE
@endsection
@section('masterDescription')
    Panel de evaluaci&oacute;n del estudiante por parte del supervisor de la instituci&oacute;n
@endsection

@section('mainContent')
    @if($getvalidaevaluation==0)
        {!! Form::open(['route'=> ['preprofessional.student.StoreEvaluation',$documentstudent],'method'=>'POST','id'=>'formStoreEvaluation']) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="text-semibold" style="text-align: center;">EVALUACIÓN ESTUDIANTE POR PARTE DEL SUPERVISOR</h5>
            </div>

            <div class="panel-body">
                <div class="row paddingBottom">
                    <div class="col-md-12">
                        <div class="callout bg-warning-300">
                            <h4>Indique la calificaci&oacute;n que usted considere adecuada, segun la siguiente
                                escala</h4>

                            <ul class="list-unstyled">
                                <li>5. EXCELENTE</li>
                                <li>4. MUY SATISFACTORIO</li>
                                <li>3. SATISFACTORIO</li>
                                <li>2. POCO SATISFACTORIO</li>
                                <li>1. NADA SATISFACTORIO</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">CONOCIMIENTOS Y
                                    HABILIDADES</a>
                            </li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ASISTENCIA</a>
                            </li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">SOPORTE</a>
                            </li>
                            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">DISPONIBILIDAD DE
                                    ESPACIO Y RECURSOS</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de CONOCIMIENTOS Y HABILIDADES para las siguientes
                                            valoraciones:</b></code>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Aplicacion de los conocimientos teoricos y practicos de la carrera</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p1',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Capacidad para resolver problemas</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p2',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Utilización adecuada de procedimientos metodológicos</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p3',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Integración y trabajo en equipo </p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p4',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion1',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA CONOCIMIENTOS Y HABILIDADES','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de ASISTENCIA para las siguientes
                                            valoraciones:</b></code>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Puntualidad del estudiante</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p5',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Responsabilidad, disposición y cumplimiento en la ejecución de las tareas	</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p6',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion2',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA ASISTENCIA','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de SOPORTE para las siguientes valoraciones:</b></code>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Integraci&oacute;n al equipo de trabajo</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p7',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Guía de la institución para el desarrollo de actividades</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p8',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Asesoría del tutor académico</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p9',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion3',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA SOPORTE','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de DISPONIBILIDAD DE ESPACIO Y RECURSOS para las siguientes valoraciones:</b></code>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Facilidad de espacio físico</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p10',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Facilidad en la utilización y movilidad de recursos</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p11',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion4',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA DISPONIBILIDAD DE ESPACIO Y RECURSOS','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="panel panel-danger">
                            <div class="box-header with-border bg-teal-300">
                                <h3 class="box-title">OBSERVACIONES Y RECOMENDACIONES GENERALES</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        Indique sus sugerencias a la Universidad para que ésta pueda mejorar sus procesos académicos
                                        para un mejor desenvolvimiento en el mundo laboral de sus estudiantes
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Field::textarea('Suggestions_std',null,['style'=>'resize: none;','label'=>'SUGERENCIA GENERALES:','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <div class="text-right">
                    {!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR',array( 'type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                </div>

            </div>
        </div>
        {!! Form::close() !!}
    @endif
@endsection

@section('masterJsCustom')
    <script>

        document.querySelector('#formStoreEvaluation').addEventListener('submit', function(e) {
            var form = this;
            e.preventDefault();
            swal({
                    title: "Confirmaci\u00F3n de Aceptaci\u00F3n",
                    text: "Realmente desea grabar la evaluación una vez realizado este proceso no se podrán realizar cambios?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        form.submit();
                    } else {
                        $("#pageLoader").fadeOut();
                    }
                });
        });
    </script>
@endsection