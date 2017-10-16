@extends('layouts.back')
@section('masterTitle')
    Titulación
@endsection
@section('masterTitleModule')
    TRABAJOS DE TITULACIÓN REGISTRADOS
@endsection
@section('masterDescription')
    Pantalla general de trabajos de titulación registrados
@endsection

@section('mainContent')
    <div class="col-lg-12">
        {!! Field::select('tfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: '])!!}

    </div>
    <div class="col-lg-12">
        {!! Field::select('tCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']) !!}
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="datosUsuarios">
                <thead>

                <th>TITULO</th>
                <th>TUTOR</th>
                <th>REVISOR</th>

                <th>TRIBUNAL DE SUSTENTACIÓN</th>
                <th>% SIMILITUD</th>

                <th>INTEGRANTES</th>
                <th>EDICIÓN</th>
                </thead>
            </table>
        </div>
    </div>

    <div class="col-lg-12 form-group text-left">
        {!! Form::button('<b><i class="glyphicon glyphicon-plus"></i></b> Nuevo', array('type' => 'button', 'class' => 'btn btn-success','id' => "btnNuevo", 'data-toggle'=>"modal",'data-target'=>"#ModalEditTrabTitu",'data-whatever'=>"@mdo")) !!}
    </div>

    <div class="modal fade" id="ModalEditTrabTitu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Incripción de Trabajo de Titulación</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        {!! Field::text('nombreTrabajo', null,  ["required"=>"required","class"=>"form-control","label"=> "Nombre de trabajo de titulación" ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Field::select('SelectProfesor' ,null,null, ['class' => 'form-control select2','required' => 'required', 'empty'=> '-Seleccione-','label'=> 'Tutor asignado']) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::select('SelectRevisor' ,null,null, ['class' => 'form-control select2','required' => 'required', 'empty'=> '-Seleccione-','label'=> 'Revisor asignado']) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::text('tribunal', null,  ["required"=>"required","class"=>"form-control","label"=> "Tribunal de sustentación asignado" ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::select('SelectCiclo' ,null,null, ['class' => 'form-control select2','required' => 'required', 'empty'=> '-Seleccione-','label'=> 'Ciclo académico']) !!}
                    </div>

                    <label>DATOS DE LOS ESTUDIANTES</label>

                    <div class="form-group">
                        {!! Field::select('Idestudiante' ,null,null, ['class' => 'form-control select2','required' => 'required', 'empty'=> '-Seleccione-','label'=> 'Número de identificación']) !!}
                    </div>
                    <div class="form-group">
                        {!! Field::text('nombreEstudiante', null,  ["required"=>"required","class"=>"form-control","label"=> "Nombres" ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Field::select('eFacultad' ,null,null, ['class' => 'form-control select2','required' => 'required', 'empty'=> '-Seleccione-','label'=> 'Facultad']) !!}
                    </div>
                    <div class="form-group">
                        {!! Field::select('eCarrera' ,null,null, ['class' => 'form-control select2','required' => 'required', 'empty'=> '-Seleccione-','label'=> 'Carrera']) !!}
                    </div>


                    <div class="form-group">

                    </div>
                </div>
                <div class="modal-footer">

                    <div style="text-align: center;">
                        {!! Form::button('<b><i class="glyphicon glyphicon-ok"></i></b> Guardar', array('type' => 'button', 'class' => 'btn btn-success','id' => "btnGuardar")) !!}
                        {!! Form::button('<b><i class="glyphicon glyphicon-remove"></i></b> Cerrar', array('type' => 'button', 'class' => 'btn btn-danger','id' => "btnCancelar", 'data-dismiss'=>"modal")) !!}
                    </div>


                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary">Send message</button>--}}
                </div>
            </div>
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

