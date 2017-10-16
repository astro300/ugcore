@extends('layouts.back')
@section('masterTitle')
    Configuraci&oacute;n de Preguntas
@endsection
@section('masterTitleModule')
    Banco de Preguntas
@endsection
@section('masterDescription')
    Panel de administraci&oacute;n para el banco de preguntas
@endsection

@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        {!! Form::open(['route'=> ['surveys.questions.update',$object],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">EDICI&Oacute;N DEL BANCO DE PREGUNTAS</h5>
            </div>
            <div class="panel-body">

                {!! Field::textarea('description',$object->name,[ 'onkeydown'=>'a.value = a.value.toUpperCase()','style'=>'text-transform: uppercase;resize:none',
                                     'rows'=>3,'label'=>'Descripci&oacute;n:','required'=>true]) !!}


                @if( $object->path_image!=null)

                    <div id="field_imagenex" class="form-group">
                        <label for="imagenex" class="control-label">
                            Imagen Existente:
                        </label>
                        <div class="controls">
                            <img  src="/file-ftp/BANCO_PREGUNTAS/{{$object->path_image}}" alt="IMAGEN BANCO PREGUNTAS">
                        </div>
                    </div>

                @endif
                <div class="row">
                    <div class="col-lg-6">
                        {!! Field::select('category_question',$categoryQuestions,$object->category_question_id,
                        ['empty'=>'- seleccione -','label'=>'Categor&iacute;a','required'=>true]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('type_response',$typeQuestions,$object->type_question_id,
                        ['empty'=>'- seleccione -','label'=>'Tipo Respuesta','required'=>true ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        {!! Field::file('file',["class"=>"file-input" ,"data-show-preview"=>"false",
                                               "data-show-upload"=>"false",'label'=>'Imagen:']) !!}
                    </div>
                    <div class="col-lg-6"  id="dvMaxResponses" style="display: none">

                        {!! Field::select('max_response',Utils::getFormatArray(1,10,1),$object->max_response,
                   ['empty'=>'- seleccione -','label'=>'Cantidad de Respuestas M&aacute;ximas:','required'=>true ]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('status',Config::get('dataselects.status'),$object->status,
                      ['empty'=>'- seleccione -','label'=>'Estado','required'=>true ]) !!}
                    </div>
                </div>

                <hr/>
                <div class="form-group">
                    {!! Form::label('status','Opciones Respuestas: ',["class"=>"text-bold col-lg-3 control-label text-danger"]) !!}
                    <div class="col-lg-9" id="dvResponses">
                        @if($object->type_question_id==12 || $object->type_question_id==11)
                            <label class="control-label">En este tipo de respuesta s&oacute;lo se presentar&aacute; una
                                caja de texto </label>
                        @else
                            <div id='dvResponseContent'>
                            @foreach($object->questionoptionsactive as $qestionOption)
                                <div class='col-lg-10 input-group' @if(trim($qestionOption->name)=='OTRO')  id='divInputOther' @endif>
                                    <input style='text-transform: uppercase' onkeydown='a.value = a.value.toUpperCase()'
                                           required='required' name='responseExists[{{$qestionOption->id}}]' class='form-control'
                                           placeholder='Digitar Respuesta' type='text' value="{{$qestionOption->name}}">
                                <span class='input-group-btn'>
                                    <button onclick='removeLI(this)' class='btn btn-default btn-xs' type='button'>
                                        <i class='icon-cross3'></i>
                                    </button>
                                </span>
                                </div>
                            @endforeach
                            </div>
                            <div class='row label-block'><span style='margin:5px;padding:5px;cursor:pointer'
                                                               class='label label-primary' onclick='addLI()'>AGREGAR MAS OPCIONES</span>
                                <span style='padding:5px;cursor:pointer' class='label label-success' onclick='addOther()'>AGREGAR RESPUESTA OTRO</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">                      {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn bg-teal-600 btn-block')) !!}</div>
                    <div class="col-lg-6">  <a href="{{route("surveys.questions.index")}}"  class="btn  btn-labeled btn-danger btn-block"><b><i class=" fa fa-trash position-left"></i></b>CANCELAR</a>
                    </div>

                </div>

            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12" style="padding: 20px">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">BANCO DE
                    PREGUNTAS</h5>
            </div>


        <input id="txtTypeTable" value="/surveys/questions/datatables" type="hidden" readonly="readonly"/>
        <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="tableData">
                <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
        </div>
        </div>
    </div>



@endsection

@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('/js/modules/surveys/questions_surveys.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('plugins/fileinput/fileinput.min.css')!!}
@endsection

