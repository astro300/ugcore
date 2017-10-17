@extends('layouts.back')
@section('masterTitle')
    Registro de Examen complexivo
@endsection
@section('masterTitleModule')
    REGISTRO DE EXAMEN COMPLEXIVO
@endsection
@section('masterDescription')
    Pantalla de registro de notas de examen  complexivo
@endsection

@section('mainContent')
    <div class="col-lg-12">
        {!! Field::select('excfacultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: '])!!}

    </div>
    <div class="col-lg-12">
        {!! Field::select('excCarrera',[],null,['class'=>'select2','label'=>'CARRERA: ']) !!}
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white" id="tbExamenComplexivo">
                <thead>

                <th>Facultad</th>
                <th>Carrera</th>
                <th>Nombre</th>

                <th>Nota Complexivo</th>
                <th>nota Gracia</th>

                <th>Nota Final</th>
                <th>Observación</th>
                <th>Actions</th>

                </thead>
                <tbody id="tbobyExamenComplexivo">

                </tbody>
            </table>
        </div>
    </div>

    {{--<div class="col-lg-12 form-group text-left">--}}
        {{--{!! Form::button('<b><i class="glyphicon glyphicon-plus"></i></b> Nuevo', array('type' => 'button', 'class' => 'btn btn-success','id' => "btnNuevo", 'data-toggle'=>"modal",'data-target'=>"#ModalNotasComplexivo",'data-whatever'=>"@mdo")) !!}--}}
    {{--</div>--}}

    <div class="modal fade" id="ModalNotasComplexivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edición de Notas</h4>
                </div>
                <div class="modal-body">

                    {{ Form::hidden('idmatriculado', null,['id'=>'idmatriculado']) }}

                    <div class="form-group">
                        {{--{!! Field::text('nombreEstudiente', null,  ["class"=>"form-control","label"=> "Nombre:" ]) !!}--}}
                        <label>Nombres del Estudiante: </label><br>
                        {{ Form::label('estudiante', null, ['id'=>'lbnombre']) }}
                    </div>


                    <div class="form-group">
                        {!! Field::text('NotaeComplexivo', null,  ["required"=>"required","class"=>"form-control nota","label"=> "Nota examen complexivo" ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::text('NotaGracia', null,  ["class"=>"form-control nota","label"=> "Nota examen de gracia" ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Field::textarea('observacion', null,  ["class"=>"form-control","label"=> "Obseravación","rows"=>"2"]) !!}
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

    <script src="{{asset('/js/modules/titulacion/examen_complexivo.js')}}"></script>
    <script src="{{asset('/plugins/mask/jquery.mask.js')}}"></script>
    <script>
        $('.nota').mask("#.##0,00", {reverse: true});
    </script>

@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
    {!! Html::style('/css/checkbox.css') !!}

@endsection

