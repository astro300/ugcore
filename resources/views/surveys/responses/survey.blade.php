@extends('layouts.back')
@section('masterTitle')
    Encuestas-UG
@endsection
@section('masterTitleModule')
    Resoluci&oacute;n de encuestas:
@endsection
@section('masterDescription')
    Pantalla de resoluci&oacute;n de encuestas.
@endsection
@section('mainBox')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="callout bg-white">
            <h4>{{$objHeadResponseSurvey->survey->name}}</h4>
            <p class="text-danger">{{$objHeadResponseSurvey->survey->description}}</p>
            @if($objHeadResponseSurvey!=null)
                @if($objHeadResponseSurvey->status_response=='F')
                    <br/> <b class="text-danger">Nota: </b>  <label>Esta encuesta fue finalizada
                        {{  Utils::getDateCarbon($objHeadResponseSurvey->getAttributes()['date_response_last']) }}</label>
                @endif
            @endif
        </div>
    </div>
@endsection
@section('mainContent')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            {{ $surveyquestions->render() }}
            <ul class="timeline" id="timeline">
                @php
                    $idx=1;
                    for($code=1;$code<$surveyquestions->currentPage();$code++){
                        $idx+=$surveyquestions->perPage();
                    }
                @endphp

                @foreach($surveyquestions as $surveyQestions)
                    @php
                        if(array_key_exists($surveyQestions->id,$response)){
                          $responseQuestion=$response[$surveyQestions->id];
                        }else{
                            $responseQuestion=[];
                        }

                    @endphp

                    <li>
                        <i class=" fa bg-blue text-bold">{{$idx}}</i>
                        @php $idx++; @endphp
                        <div class="timeline-item" id="timeline_{{$surveyQestions->id}}" @if(count($responseQuestion)>0) style="background: rgba(53, 162, 162, 0.46);" @endif>
                            <div class="timeline-body">
                                <div class="col-lg-12" style="background: rgba(53, 162, 162, 0.46);">
                                    <h4><b>Pregunta:</b> {{$surveyQestions->question->name}}</h4>
                                </div>

                                @if($surveyQestions->question->path_image!=null)
                                    <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 text-center">
                                            <br/>
                                            <img  src="/file-ftp/BANCO_PREGUNTAS/{{$surveyQestions->question->path_image}}" alt="IMAGEN BANCO PREGUNTAS">
                                        </div>
                                    </div>

                                @endif

                                <div class="col-lg-12">
                                    @if($surveyQestions->question->type_question_id==env('RESPONSE_MULTIPLE'))
                                        <h5 class="text-red text-bold text-center">ESCOJA LAS ALTERNATIVAS QUE CONSIDERE
                                            NECESARIAS</h5>
                                    @else
                                        @if($surveyQestions->question->type_question_id==env('RESPONSE_SHORT')||$surveyQestions->question->type_question_id==env('RESPONSE_LARGE'))
                                            <h5 class="text-red text-bold text-center">ESCRIBA SU RESPUESTA</h5>
                                        @else
                                            <h5 class="text-red text-bold text-center">ELIJA SU RESPUESTA</h5>
                                        @endif
                                    @endif
                                </div>
                                <div class="row" >
                                    <div class="col-lg-10 col-lg-offset-1">
                                        @if($surveyQestions->question->type_question_id==env('RESPONSE_SHORT'))

                                            @for($i = 0; $i < $surveyQestions->question->max_response; $i++)
                                                <div class="col-lg-6">
                                                    {!! Field::text("response_{$surveyQestions->id}_[]", array_key_exists($i,$responseQuestion)==true? $responseQuestion[$i]:'',
                                                           [ 'placeholder'=>"Digite su respuesta",'label'=>"Respuesta ".($i+1).': ',
                                                              'disabled'=>$objHeadResponseSurvey->status_response=='F'?true:false,'required'=>true]) !!}
                                                </div>
                                            @endfor

                                        @else
                                            @if($surveyQestions->question->type_question_id==env('RESPONSE_LARGE'))
                                                <div class="form-group" style="padding: 20px">
                                                    @for($i = 0; $i < $surveyQestions->question->max_response; $i++)
                                                        <div class="col-lg-6">
                                                            {!! Field::textarea("response_{$surveyQestions->id}_[]",array_key_exists($i,$responseQuestion)==true? $responseQuestion[$i]:'',
                                                                   [ 'placeholder'=>"Digite su respuesta",'label'=>"Respuesta ".($i+1).': ',
                                                                      'disabled'=>$objHeadResponseSurvey->status_response=='F'?true:false,'required'=>true,'style'=>'resize:none','rows'=>3]) !!}
                                                        </div>
                                                    @endfor
                                                </div>
                                            @else
                                                @php $keyResponse=0; @endphp
                                                @foreach($surveyQestions->question->questionoptionsactive as  $qestionOption)
                                                    @php $typeQuestion=$surveyQestions->question->type_question_id==env('RESPONSE_SIMPLE')?'radio':'checkbox'; @endphp
                                                    <div class='col-lg-6'>
                                                        <div class="checkbox checkbox-primary">
                                                            <input id="response{{$qestionOption->id}}" class="styled"
                                                                   name="response_{{$surveyQestions->id}}_[]" value="{{$qestionOption->id}}" type="{{$typeQuestion}}"

                                                                   @if(in_array($qestionOption->id,$responseQuestion))
                                                                   checked="checked"
                                                                   @endif
                                                                   @if($objHeadResponseSurvey->status_response=='F')
                                                                   disabled="disabled"
                                                                    @endif
                                                            @if($qestionOption->name=='OTRO')

                                                                    @endif
                                                            />
                                                            <label for="response{{$qestionOption->id}}" >
                                                                {{$qestionOption->name}}
                                                            </label>
                                                        </div>
                                                        @if($qestionOption->name=='OTRO')
                                                            <input name="response_other{{$surveyQestions->id}}" class="form-control" placeholder="Digite Respuesta Otro"/>
                                                        @endif
                                                    </div>
                                                    @php $keyResponse++; @endphp
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li>
                                                <i class=" icon-price-tags position-left text-teal-800"></i><b class="text-teal-800">Categor&iacute;a Pregunta:</b>
                                                '{{ $surveyQestions->question->categoryquestion->name}}'
                                            </li>
                                            <li>
                                                <i class=" icon-list2 position-left text-teal-800"></i><b class="text-teal-800">Tipo Pregunta:</b>
                                                '{{ $surveyQestions->question->typequestion->name}}'
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6 text-right">
                                        <button class="btn btn-primary " id="btn_save_response" value="{{$surveyQestions->id}}"><i class="icon-floppy-disk"></i>Guardar
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>


                @endforeach

            </ul>
            {{ $surveyquestions->render() }}

        </div>
        <!-- /.col -->
    </div>

@endsection
@section('masterJsCustom')
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function(){
            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $('input[type=radio]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });


        });
        $(document).on('click', '#btn_save_response', function (e) {
            e.preventDefault();
            saveQuestionResponse(this.value);

        });
        function saveQuestionResponse(surveyQuestion) {
            var postForm = {};
            var process = false;
            var allVals = [];
            if ($('input[name^=response_'+surveyQuestion+'_]').length) {
                switch ($('input[name^=response_'+surveyQuestion+'_]').attr('type')) {
                    case 'radio':
                    case 'checkbox':
                        $('input[name^=response_'+surveyQuestion+'_]:checked').each(function () {
                            allVals.push($(this).val());
                        });
                        break;
                    case 'text':
                        $('input[name^=response_'+surveyQuestion+'_]').each(function () {
                            allVals.push($(this).val());
                        });
                        break;
                }

                postForm = { //Fetch form data
                    'response': JSON.stringify(allVals),
                    'id': surveyQuestion
                };
                process = true;

            } else {
                if ($('textarea[name^=response_'+surveyQuestion+'_]').length) {
                    $('textarea[name^=response_'+surveyQuestion+'_]').each(function () {
                        allVals.push($(this).val());
                    });
                    postForm = { //Fetch form data
                        'response': JSON.stringify(allVals),
                        'id': surveyQuestion
                    };
                    process = true;
                } else {
                    swal({
                        title: "Configuraci\u00F3n Incorrecta",
                        text: "El presente formato de respuestas no se encuentra configurado.",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Aceptar"
                    });
                }
            }

            if (process) {
                var objApiRest = new AJAXRest('/surveys/response_survey/question/' + surveyQuestion, postForm, 'POST');
                objApiRest.extractDataAjax(function (_resultContent, status) {
                    if (status == 200) {
                        new PNotify({
                            icon: 'icon-notification2',
                            title: 'Mensaje',
                            text: _resultContent,
                            addclass: 'alert alert-success alert-styled-right',
                            type: 'success',
                            delay: 3500
                        });
                        $("#timeline_"+surveyQuestion).attr('style','background: rgba(53, 162, 162, 0.46);');

                    } else {
                        alertToast(_resultContent.message, 3500);
                    }
                });

            }
        }

    </script>
@endsection
@section('masterCssCustom')
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
@endsection
