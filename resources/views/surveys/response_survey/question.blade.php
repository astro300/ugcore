<input type="hidden" value="{{$object->id}}" id="hdd_surveyquestion" name="hdd_surveyquestion"/>
<div class="timeline-row">
    <div class="timeline-icon">
        <div class="bg-warning-400">
            <i class="  icon"
               style="display: block;line-height: 40px;top: 0;text-align: center;font-size: 16px;font-weight: bold;">{{ $index }}</i>
        </div>
    </div>


    <div class="panel panel-flat timeline-content animated bounceInLeft">
        <div class="panel-heading">
            <h6 class="panel-title  text-bold bg-warning-400"
                style="padding: 10px;border-radius: 10px">{{ $object->question->name  }}</h6>

        </div>

        <div class="panel-body">
            @if($object->question->path_image!=null)
                <div class="display-block content-group">
                    <img style="height: 350px;"
                         src="/{{  Utils::getLinkByFileFTP($object->question->path_image,'BANCO_PREGUNTAS',env('URL_LOCAL_FILE').'surveys/','files/modules/surveys/') }}"
                         class="img-responsive content-group" alt="">

                </div>
            @endif
            @if($object->question->type_question_id==env('RESPONSE_MULTIPLE'))
                <h6 class="panel-title text-bold bg-teal-800 text-center">ESCOJA LAS ALTERNATIVAS QUE CONSIDERE
                    NECESARIAS</h6>
            @else
                <h6 class="panel-title text-bold bg-teal-800 text-center">ELIJA SU RESPUESTA</h6>
            @endif


            <div class="row">

                @if($object->question->type_question_id==env('RESPONSE_SHORT'))
                    <div class="form-group" style="padding: 20px">
                        @for($i = 0; $i < $object->question->max_response; $i++)

                        <input required="required" name="response[]"
                               value="@if(count($response)==($i+1)) {{$response[$i]}} @endif" class="form-control"
                               placeholder="Digite su respuesta" type="text"
                               @if($objHeadSurvey->status_response=='F')
                               disabled="disabled"
                                @endif
                        />
                        @endfor
                    </div>
                @else

                    @if($object->question->type_question_id==env('RESPONSE_LARGE'))
                        <div class="form-group" style="padding: 20px">
                            @for($i = 0; $i < $object->question->max_response; $i++)
                       <textarea required="required" name="response[]" class="form-control"
                                 placeholder="Digite su respuesta"
                                 @if($objHeadSurvey->status_response=='F')
                                 disabled="disabled"
                               @endif
                       >@if(count($response)==($i+1)) {{$response[$i]}} @endif</textarea>
                            @endfor
                        </div>
                    @else
                        @foreach($object->question->questionoptionsactive as $qestionOption)
                            {{--*/ $typeQuestion=$object->question->type_question_id==15?'radio':'checkbox' /*--}}
                            <div class='col-lg-12'>
                                <div class="checkbox checkbox-primary">
                                    <input id="response{{$qestionOption->id}}" class="styled"
                                           name="response[]" value="{{$qestionOption->id}}" type="{{$typeQuestion}}"
                                           @if(in_array($qestionOption->id, $response))
                                           checked="checked"
                                           @endif

                                           @if($objHeadSurvey->status_response=='F')
                                           disabled="disabled"
                                            @endif
                                    />
                                    <label for="response{{$qestionOption->id}}" style="font-weight: bolder">
                                        {{$qestionOption->name}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif

            </div>
            @if($objHeadSurvey->status_response!='F')
                @if(count($response)>0)
                    <button id="btn_update" survey-question="{{ $object->id }}" survey-code="{{$object->survey->id}}"
                            index="{{$index}}"
                            class="btn bg-teal-400 btn-labeled btn-rounded legitRipple  text-bold btn-xs"><b><i
                                    class="icon-database-refresh"></i></b> ACTUALIZAR RESPUESTA
                    </button>
                @endif



            @endif
        </div>
        <div class="panel-footer panel-footer-transparent">
            <div class="heading-elements">
                <ul class="list-inline list-inline-condensed heading-text">
                    <li><label class="text-default">
                            <i class=" icon-price-tags position-left"></i><b>Categor&iacute;a Pregunta:</b>
                            '{{ $object->question->categoryquestion->name}}'
                        </label></li>

                    <li><label class="text-default"><i
                                    class=" icon-list2 position-left"></i><b>Tipo Pregunta:</b>
                            '{{ $object->question->typequestion->name}}'</label></li>
                </ul>
                <ul class="pager pager-rounded pull-right">
                    <li>
                        <button survey-question="{{ $object->id }}" id="btn_previus" index-previus="{{ $index-1 }}"
                                class="{{ ($index-1)==0?'disabled':'' }} btn btn-primary btn-labeled btn-rounded legitRipple text-bold btn-xs">
                            <b><i class=" icon-arrow-left7"></i></b> ANTERIOR
                        </button>
                    </li>
                    <li>

                        @if($objHeadSurvey->status_response!='F')
                            @if(count($response)>0)
                                @if(($index+1)<= $indexmax)
                                    <button survey-question="{{ $object->id }}" id="btn_next"
                                            index-next="{{ 1+$index }}"
                                            class="btn btn-primary btn-labeled btn-rounded legitRipple  text-bold btn-xs">
                                        CONTINUAR <b><i style="right: 0" class=" icon-arrow-right7"></i></b></button>
                                @endif
                            @else
                                @if(($index+1)> $indexmax)
                                    <button survey-question="{{ $object->id }}" id="btn_nextsave"
                                            index-next="{{ $index }}"
                                            class="btn bg-teal-400 btn-labeled btn-rounded legitRipple  text-bold btn-xs">
                                        GUARDAR Y CONTINUAR <b><i style="right: 0" class=" icon-arrow-right7"></i></b>
                                    </button>
                                @else
                                    <button survey-question="{{ $object->id }}" id="btn_nextsave"
                                            index-next="{{ 1+$index }}"
                                            class="btn bg-teal-400 btn-labeled btn-rounded legitRipple  text-bold btn-xs">
                                        GUARDAR Y CONTINUAR <b><i style="right: 0" class=" icon-arrow-right7"></i></b>
                                    </button>
                                @endif
                            @endif
                        @else
                            @if(($index+1)<= $indexmax)
                                <button survey-question="{{ $object->id }}" id="btn_next"
                                        index-next="{{ 1+$index }}"
                                        class="btn btn-primary btn-labeled btn-rounded legitRipple  text-bold btn-xs">
                                    CONTINUAR <b><i style="right: 0" class=" icon-arrow-right7"></i></b></button>
                            @endif
                        @endif


                    </li>
                </ul>

            </div>

        </div>

    </div>
</div>
{!! Html::style('extcore/css/checkbox.css') !!}


<script type="text/javascript">
    function saveQuestionResponse(surveyQuestion, index, surveyQuestionIndex) {
        var postForm = {};
        var process = false;
        var allVals = [];
        if ($('input[name^=response]').length) {
            switch ($('input[name^=response]').attr('type')) {
                case 'radio':
                case 'checkbox':
                    $('input[name^=response]:checked').each(function () {
                        allVals.push($(this).val());
                    });
                    break;
                case 'text':
                    $('input[name^=response]').each(function () {
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
            if ($('textarea[name^=response]').length) {
                $('textarea[name^=response]').each(function () {
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
            $.ajax({
                url: '/surveys/response_survey/response_question',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
                data: postForm,
                success: function (result) {
                    new PNotify({
                        icon: 'icon-notification2',
                        title: 'Mensaje',
                        text: result,
                        addclass: 'alert alert-success alert-styled-right',
                        type: 'success',
                        delay: 3500
                    });
                    loadQuestion(surveyQuestionIndex, index);
                },
                error: function (result) {
                    new PNotify({
                        icon: 'icon-notification2',
                        title: 'Atenci\u00F3n',
                        text: "La solicitud ha fallado!, " + result.responseText,
                        addclass: 'alert alert-warning alert-styled-right',
                        type: 'error',
                        delay: 3500
                    });
                },
                fail: function (result) {
                    new PNotify({
                        icon: 'icon-notification2',
                        title: 'Atenci\u00F3n',
                        text: "La solicitud ha fallado!",
                        addclass: 'alert alert-warning alert-styled-right',
                        type: 'error',
                        delay: 3500
                    });
                }
            });
        }
    }
</script>