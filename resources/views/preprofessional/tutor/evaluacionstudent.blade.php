@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    EVALUACI&Oacute;N TUTOR&Iacute;A
@endsection
@section('masterDescription')
    panel evaluaci&oacute;n estudiante tutor&iacute;a
@endsection

@section('mainContent')
   <div class="col-lg-12 text-right">
    <form id="returnform" action="{{route('preprofessional.tutor.indexnew',$documenttutor)}}" method="POST"
          style="display: none;">
        <input type="hidden" name="careers" value="{{$career}}"/>

        {{ csrf_field() }}
    </form>
    <button   class="btn btn-warning"
              onclick="$('#returnform').submit();">REGRESAR</button>
       <br/>
   </div>

    {!! Form::open(['route'=> ['preprofessional.tutor.StoreTutorEvaluation',$docmentid,$documenttutor,$faculty,$career],'method'=>'POST']) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 style="text-align: center;">FICHA DE SUPERVISI&Oacute;N DE TUTOR ACAD&Eacute;MICO</h4>
        </div>
        <div class="panel-body">


            <div class="col-lg-6">
                {!! Field::text('business_address', $getsummarystudents->address,  ['label'=>'LUGAR',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('name_student', strtoupper($getsummarystudents->name_estu.' '.$getsummarystudents->ape_estu),  ['label'=>'ESTUDIANTE',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('business_name',strtoupper($getsummarystudents->name),  ['label'=>'INSTITUCI&Oacute;N RECEPTORA',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('internships_area', strtoupper($getsummarystudents->departament),  ['label'=>'AREA DE DESEMPEÑO',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('supervisor_name',strtoupper($getsummarystudents->name_supervisor),  ['label'=>'SUPERVISOR DE LA INSTITUCI&Oacute;N RECEPTORA',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('supervisor_position',strtoupper($getsummarystudents->position_supervisor),  ['label'=>'CARGO DE SUPERVISOR DE INSTITUCI&Oacute;N',"readonly"=>"readonly" ]) !!}
            </div>

            <div class="col-lg-6">
                {!! Field::text('n_visit',$getvisitinstitutionew,  ['label'=>'N° VISITA',"readonly"=>"readonly" ]) !!}
            </div>
            <div class="col-lg-6">
                {!! Field::text('date',null,   ['label'=>'FECHA Y HORA DE LA VISITA','required'=>'required',"placeholder"=>"- seleccione fecha -" ]) !!}
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

                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ASPECTO T&Eacute;CNICO</a>
                            </li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ASPECTO OPERATIVO</a>
                            </li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">ASPECTO SOCIAL</a>
                            </li>
                            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">ASPECTO ESTRAT&Eacute;GICO</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de ASPECTO T&Eacute;CNICO para las siguientes
                                            valoraciones:</b></code>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Los conocimientos del practicante aseguran una exitosa realización de los
                                            trabajos</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p1',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Demuestra interés y entusiasmo en aprender</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p2',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Posee iniciativa, constantemente pregunta por nuevos trabajos</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p3',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p> Demuestra capacidad en la realización de sus trabajos </p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p4',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p> Es hábil para poner en práctica ideas propias o ajenas</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p5',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion1',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA ASPECTO T&Eacute;CNICO','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de ASPECTO OPERATIVO para las siguientes
                                            valoraciones:</b></code></div>
                                <hr/>

                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Demuestra compromiso en la realización de sus trabajos</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p6',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Es constante y siempre muy predispuesto a desempeñar la labor</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p7',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Cumple con exactitud, esmero y orden los trabajos</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p8',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Actúa voluntariamente en los trabajos de rutina</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p9',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion2',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA ASPECTO OPERATIVO','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de ASPECTO SOCIAL para las siguientes
                                            valoraciones:</b></code></div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Su actitud es proactiva y facilita la tarea en equipo</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p10',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Coopera de manera permanente y espontánea</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p11',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Es respetuoso con los jefes y compañeros de trabajo</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p12',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Demuestra habilidades de liderazgo en los trabajos en equipo</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p13',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Demuestra ser cuidadoso en su presentación personal</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p14',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion3',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA ASPECTO SOCIAL','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="row text-center">
                                    <code><b>Seleccione los Puntaje de ASPECTO ESTRAT&Eacute;GICO para las siguientes
                                            valoraciones:</b></code></div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Demuestra ser eficaz en el análisis y resolución de problemas</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p15',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Tiene la habilidad para evaluar datos y de tomar decisiones lógicas de manera
                                            imparcial y desde el punto de vista racional</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p16',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Planifica y organiza de manera adecuada los trabajos diarios</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p17',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Es creativo y propone soluciones y/o alternativas para mejorar situaciones de
                                            trabajo</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p18',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Es perseverante, cuando debe enfrentar situaciones difíciles de trabajo,
                                            hasta que éste quede resuelto</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p19',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Es puntual en el trabajo</p>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('p20',Utils::getFormatArray(1,5,1),5) !!}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Field::textarea('Observacion4',null,['style'=>'resize: none;','label'=>'OBSERVACI&Oacute;N PARA ASPECTO ESTRAT&Eacute;GICO','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="panel panel-danger">
                            <div class="box-header with-border bg-teal-300">
                                <h3 class="box-title">OBSERVACIONES Y RECOMENDACIONES GENERALES</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        {!! Field::textarea('observationgeneral',null,['style'=>'resize: none;','label'=>'OBSERVACIONES GENERALES','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Field::textarea('recommendations',null,['style'=>'resize: none;','label'=>'RECOMENDACIONES GENERALES','placeholder'=>'Escriba aqui...','rows'=>3,'class'=>'']) !!}
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="panel-footer">
            <div style="text-align: center;">

                {!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
            </div>
        </div>

    </div>
    {!! Form::close() !!}
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datetimepicker/js/moment.min.js')!!}
    {!!Html::script('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')!!}

    <script>

        $('#date').datetimepicker({
            format: 'YYYY-MM-DD H:mm:ss',
        });
    </script>
@endsection
@section('masterCssCustom')
    {!!Html::style('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')!!}
@endsection