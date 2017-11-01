@extends('layouts.back')
@section('masterTitle')
    Registro de Examen complexivo
@endsection
@section('masterTitleModule')
    NOTAS GENERAL DE TRABAJO DE TITULACIÓN
@endsection
@section('masterDescription')
    Pantalla de registro de todas las notas titulación
@endsection

@section('mainContent')
    <div class="col-lg-12">
        {!! Field::select('cmbFacultad', $faculties, null, ['empty' => 'Seleccione', 'class' => 'select2', 'label' => 'FACULTAD:'])!!}

    </div>
    <div class="col-lg-12">
        {!! Field::select('cmbCarrera', [], null, ['empty' => 'seleccione', 'class' => 'select2', 'label' => 'CARRERA:']) !!}
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="dtNotasGenTitu">
                <thead>

                <th>Trabajo</th>
                <th>Estudiante</th>
                <th>Nota Tutor</th>
                <th>Nota Revisor</th>
                <th>Nota Sustentación</th>
                <th>Nota Final</th>
                <th>Actions</th>

                </thead>
                <tbody id="tbobyNotasGenTitu">

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="ModalNotasGtitulacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edición de Notas</h4>
                </div>
                <div class="modal-body">
                    {{ Form::hidden('cod_estudiante', null,['id'=>'cod_estudiante']) }}
                    {{ Form::hidden('cod_tesis', null,['id'=>'cod_tesis']) }}

                    <div class="form-group">
                        <label>Tema de Tesis: </label><br>
                        {{ Form::label('tesis', null, ['id'=>'lbtesis']) }}
                    </div>

                    <div class="form-group">
                        <label>Nombres del Estudiante: </label><br>
                        {{ Form::label('estudiante', null, ['id'=>'lbnombre']) }}
                    </div>

                    <div class="form-group">
                        {!! Field::text('NotaT', null,  ["required"=>"required","class"=>"form-control nota","label"=> "Nota de Tutor", "maxlength"=>"5" ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::text('NotaR', null,  ["required"=>"required","class"=>"form-control nota","label"=> "Nota de Revisor", "maxlength"=>"5" ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::text('NotaS', null,  ["required"=>"required","class"=>"form-control nota","label"=> "Nota de Sustentacion", "maxlength"=>"5" ]) !!}
                    </div>

                </div>
                <div class="modal-footer">

                    <div style="text-align: center;">
                        {!! Form::button('<b><i class="glyphicon glyphicon-ok"></i></b> Guardar', array('type' => 'button', 'class' => 'btn btn-success','id' => "btnGuardar")) !!}
                        {!! Form::button('<b><i class="glyphicon glyphicon-remove"></i></b> Cerrar', array('type' => 'button', 'class' => 'btn btn-danger','id' => "btnCancelar", 'data-dismiss'=>"modal")) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

    <script src="{{asset('/js/modules/titulacion/CargaCarreraxFacultad.js')}}"></script>
    <script src="{{asset('/js/modules/titulacion/notas_general_titulacion.js')}}"></script>



@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
    {!! Html::style('/css/checkbox.css') !!}

@endsection

