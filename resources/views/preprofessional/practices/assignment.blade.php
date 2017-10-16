@extends('layouts.back')
@section('masterTitle')
    MÓDULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    PRÁCTICAS EMPRESARIALES
@endsection
@section('masterDescription')
    Panel Principal - Asisgnaci&oacute;n de Estudiantes
@endsection
@section('mainContent')

    <div class="col-lg-12">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <div class="text-semibold" style="text-align: center;">ASIGNACIÓN DE ESTUDIANTE EN LA PRÁCTICA INSTITUCIONAL</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div id="field_name_institucion" class="form-group">
                            <label for="name_institucion" class="control-label">
                                Nombre Institución
                            </label>
                          <div class="controls">
                                <input disabled="" class="form-control" id="name_institucion" name="name_institucion" type="text" value="{{$objInstitucion->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div id="field_email_institucion" class="form-group">
                            <label for="email_institucion" class="control-label">
                                Email Institución
                            </label>
                            <div class="controls">
                                <input disabled="" class="form-control" id="email_institucion" name="email_institucion" type="text"
                                       value="{{$objInstitucion->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div id="field_contacto_institucion" class="form-group">
                            <label for="contacto_institucion" class="control-label">
                                Estudiantes Asignados
                            </label>
                            <div class="controls">
                                <input disabled="" class="form-control" id="contacto_institucion" name="contacto_institucion" type="text"
                                       value="{{$objInstitucion->many_estudent}}">
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="bg-primary">
                {!! Form::open(['route'=> ['preprofessional.practices.addassignmentStuentpractices',$id,$faculty,$career]
                ,'method'=>'POST']) !!}

                        {!! Field::select('students[]',[],null,['multiple'=>true,'empty'=>'-Seleccione-','label'=>'SELECCIONE LOS ESTUDIANTES','class'=>'select2','required'=>true]) !!}
                        <div class="col-lg-6 paddingFormLeft">
                           {!! Field::text('star_date', null,  ['label'=>'FECHA INICIO',"required"=>"required","class"=>"form-control pickadate" ,"placeholder"=>"- seleccione fecha inicio -"]) !!}
                        </div>
                        <div class="col-lg-6 paddingFormRight">
                        {!! Field::text('end_date', null,  ['label'=>'FECHA FIN',"required"=>"required","class"=>"form-control pickadate" ,"placeholder"=>"- seleccione fecha fin -"]) !!}
                        </div>
                        <div class="col-lg-6 paddingFormLeft">
                        {!! Field::select('tutor',$gettutor,null,['empty'=>'-Seleccione-','label'=>'TUTOR','class'=>'select2','required'=>'required']) !!}
                        </div>
                        <div class="col-lg-6 paddingFormRight">
                        {!! Field::text('name_supervisor', null,  ['label'=>'NOMBRE SUPERVISOR',"required"=>"required","class"=>"form-control " ,"placeholder"=>"ingrese nombre del supervisor","onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#name_supervisor','width: 100%;text-transform: uppercase')"]) !!}
                        </div>
                        <div class="col-lg-6 paddingFormLeft">
                        {!! Field::text('position_supervisor', null,  ['label'=>'CARGO SUPERVISOR',"required"=>"required","class"=>"form-control " ,"placeholder"=>"ingrese cargo del supervisor","onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z0-9]/, '#position_supervisor','width: 100%;text-transform: uppercase')"]) !!}
                        </div>
                        <div class="col-lg-6 paddingFormRight">
                            {!! Field::text('area', null,  ['label'=>'AREA/DEPARTAMENTO',"required"=>"required",
                        "class"=>"form-control " ,"placeholder"=>"ingrese el área","onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z0-9]/, '#area','width: 100%;text-transform: uppercase')"]) !!}
                        </div>

                <div class="form-group" style="text-align: center;">
                    <div class="col-md-6">
                        <div class="text-right">
                            <a href="{{ route('preprofessional.practices.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-lefth">
                            {!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> ASIGNAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <div class="text-semibold" style="text-align: center;">ESTUDIANTES PRÁCTICAS INSTITUCIONAL - {{strtoupper($objInstitucion->name)}}</div>
                 </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr >
                            <th>CEDULA</th>
                            <th>NOMBRES Y APELLIDOS</th>
                            <th>TUTOR</th>
                            <th>NOMBRE SUPERVISOR</th>
                            <th>AREA/DEPARTAMENTO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($showInstitutionStudents as $student)

                            <tr>
                                <td>{{$student->document}}</td>
                                <td>{{strtoupper($student->name_estu.' '.$student->ape_estu)}}</td>
                                <td>{{ifArrayNull($gettutor,$student->id_tutor,$student->id_tutor)}}</td>
                                <td>{{strtoupper($student->name_supervisor."")}}</td>
                                <td>{{strtoupper($student->departament."")}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">NO HAY REGISTRO</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {!! $showInstitutionStudents->render() !!}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('masterJsCustom')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
    <script>
            $(function(){
                $('.pickadate').datepicker({
                    formatSubmit: 'yyyy-mm-dd',
                    format: 'yyyy-mm-dd',
                    selectYears: true,
                    editable: true,
                    autoclose: true,
                    orientation:'top'
                });

                $('select[name^=students]').select2({
                    placeholder: 'Digite el número de identificación',
                    ajax: {
                        url: '/preprofesional/prospects/{{$faculty}}/{{$career}}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    }
                });
            });
    </script>
@endsection
@section('masterCssCustom')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection
