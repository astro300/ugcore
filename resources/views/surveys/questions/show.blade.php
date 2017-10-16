@extends('layouts.back')
@section('masterTitle')
    Visualizaci&oacute;n de Preguntas
@endsection
@section('masterTitleModule')
    Banco de Preguntas
@endsection
@section('masterDescription')
    Panel de visualizaci&oacute;n del banco de preguntas
@endsection

@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        <div class="">


       <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">VISUALIZACI&Oacute;N DEL BANCO DE PREGUNTAS</h5>
            </div>
            <div class="panel-body">




                {!! Field::textarea('description',$object->name,['style'=>'text-transform: uppercase;resize:none',
                       'rows'=>3,'label'=>'Descripci&oacute;n:','disabled'=>'disabled']) !!}


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
                        ['empty'=>'- seleccione -','label'=>'Categor&iacute;a','required'=>false,"disabled"=>"disabled"]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('type_response',$typeQuestions,$object->type_question_id,
                        ['empty'=>'- seleccione -','label'=>'Tipo Respuesta','required'=>false ,"disabled"=>"disabled"]) !!}
                    </div>
                </div>


                <div class="row">

                    <div class="col-lg-6"  id="dvMaxResponses" style="display: none">

                        {!! Field::select('max_response',Utils::getFormatArray(1,10,1),$object->max_response,
                   ['empty'=>'- seleccione -','label'=>'Cantidad de Respuestas M&aacute;ximas:','required'=>false ,"disabled"=>"disabled"]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('status',Config::get('dataselects.status'),$object->status,
                      ['empty'=>'- seleccione -','label'=>'Estado','required'=>false ,"disabled"=>"disabled"]) !!}
                    </div>
                </div>



                <hr/>

                <div class="form-group">
                    {!! Form::label('status','Opciones Respuestas: ',["class"=>"text-bold col-lg-3 control-label text-danger"]) !!}
                    <div class="col-lg-9" id="dvResponses" >
                        @if($object->type_question_id==12 || $object->type_question_id==11)
                            <label class="control-label">En este tipo de respuesta s&oacute;lo se presentar&aacute; una
                                caja de texto </label>
                        @else
                            <div id='dvResponseContent'>
                            @foreach($object->questionoptionsactive as $qestionOption)
                                <div class='col-lg-10 input-group'>
                                    <input readonly='readonly' name='responseExists[{{$qestionOption->id}}]' class='form-control'
                                            type='text' value="{{$qestionOption->name}}">

                                </div>
                            @endforeach
                            </div>

                        @endif
                    </div>
                </div>


                <div class="text-left">
                    <a href="{{route("surveys.questions.index")}}"  class="btn  btn-labeled bg-teal-800"><b><i class=" icon-file-check position-left"></i></b>CREAR PREGUNTAS</a>


                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>



    <div class="col-lg-12" style="padding: 20px">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">BANCO DE
                    PREGUNTAS</h5>
            </div>
            <div class="panel-body">
                <input id="txtTypeTable" value="/surveys/questions/datatables" type="hidden" readonly="readonly"/>
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
