@extends('layouts.back')
@section('masterTitle')
    Registro y Modificación de notas de Trabajo de titulación
@endsection
@section('masterTitleModule')
    NOTAS DE TRABAJO DE TITULACIÓN
@endsection
@section('masterDescription')
    Pantalla de ingreso de notas del trabajo de titulación
@endsection

@section('mainContent')

    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="dtNotasTitulacion">
                <thead>

                <th>Trabajo</th>
                <th>Estudiante</th>
                <th>Cargo</th>
                <th>Nota</th>
                <th>Actions</th>

                </thead>
                <tbody id="tbobyNotasTitulacion">

                </tbody>
            </table>
        </div>
    </div>



    <div class="modal fade" id="ModalNotas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edición de Nota de Titulación</h4>
                </div>
                <div class="modal-body">

                    {{ Form::hidden('cod_estudiante', null,['id'=>'cod_estudiante']) }}
                    {{ Form::hidden('cod_tesis', null,['id'=>'cod_tesis']) }}

                    <div class="form-group">
                        {{--{!! Field::text('nombreEstudiente', null,  ["class"=>"form-control","label"=> "Nombre:" ]) !!}--}}
                        <label>Tema de Tesis: </label><br>
                        {{ Form::label('tesis', null, ['id'=>'lbtesis']) }}
                    </div>

                    <div class="form-group">
                        {{--{!! Field::text('nombreEstudiente', null,  ["class"=>"form-control","label"=> "Nombre:" ]) !!}--}}
                        <label>Nombres del Estudiante: </label><br>
                        {{ Form::label('estudiante', null, ['id'=>'lbnombre']) }}
                    </div>


                    <div class="form-group">
                        {!! Field::text('Nota', null,  ["required"=>"required","class"=>"form-control nota","label"=> "Nota de titulación", "maxlength"=>"5" ]) !!}
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
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

    <script src="{{asset('/js/modules/titulacion/notas_titulacion.js')}}"></script>
    {{--<script src="{{asset('/plugins/mask/jquery.mask.js')}}"></script>--}}
    {{--<script>--}}
        {{--$('.nota').mask("#.##0,00", {reverse: true});--}}
    {{--</script>--}}

@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}

@endsection

