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
        {!! Form::open(['route'=> 'surveys.questions.store','method'=>'POST','enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DEL BANCO DE PREGUNTAS</h5>
            </div>
            <div class="panel-body">

                {!! Field::text('description',null,['style'=>'text-transform: uppercase',
                         'onkeydown'=>'a.value = a.value.toUpperCase()','label'=>'Descripci&oacute;n:','required'=>true]) !!}

                <div class="row">
                    <div class="col-lg-6">
                        {!! Field::select('category_question',$categoryQuestions,null,
                        ['empty'=>'- seleccione -','label'=>'Categor&iacute;a','required'=>true]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('type_response',$typeQuestions,11,
                        ['empty'=>'- seleccione -','label'=>'Tipo Respuesta','required'=>true ]) !!}
                    </div>
                </div>



                <div class="row">
                    <div id="dvMaxResponses" style="display: none" class="col-lg-6">
                        {!! Field::select('max_response',Utils::getFormatArray(1,10,1),11,
                       ['empty'=>'- seleccione -','label'=>'Cantidad de Respuestas M&aacute;ximas:','required'=>true ]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::file('file',["class"=>"file-input" ,"data-show-preview"=>"false",
                                                  "data-show-upload"=>"false",'label'=>'Imagen:']) !!}
                    </div>
                </div>

                <hr/>
                <div class="form-group">
                    {!! Form::label('opt_resp','Opciones Respuestas: ',["class"=>"text-bold col-lg-3 control-label text-danger"]) !!}
                    <div class="col-lg-9" id="dvResponses" >
                        <label class="control-label">En este tipo de respuesta s&oacute;lo se presentar&aacute; una caja
                            de texto </label>
                    </div>
                    <br/>
                </div>

                <div class="text-left">
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn bg-teal-600 btn-block')) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">BANCO DE
                PREGUNTAS</h5>
            </div>

            <input id="txtTypeTable" value="/surveys/questions/datatables" type="hidden" readonly="readonly"/>

           <div class="panel-body">
               <div class="table-responsive">
                   <table class="table table-bordered table-striped table-hover bg-white" id="tableData">
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
    {!!Html::script('/js/modules/surveys/questions_surveys.js')!!}s
@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('plugins/fileinput/fileinput.min.css')!!}
@endsection
