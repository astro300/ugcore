<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::style('plugins/font-awesome/css/font-awesome.css') !!}
    {!! Html::style('plugins/sweetalert/sweetalert.css') !!}
    {!! Html::style('plugins/loading/Overlay.min.css') !!}
    {!! Html::style('extcore/css/extras/animate.min.css') !!}


    {!! Html::style('extcore/css/icons/icomoon/styles.css') !!}
    {!! Html::style('extcore/css/bootstrap.css') !!}
    {!! Html::style('extcore/css/core.css') !!}
    {!! Html::style('extcore/css/components.css') !!}
    {!! Html::style('extcore/css/colors.css') !!}

    {!!Html::script('plugins/loading/Overlay.min.js')!!}
    {!!Html::script('extcore/js/core/app.js')!!}
    {!!Html::script('extcore/js/core/libraries/bootstrap.min.js')!!}
    {!!Html::script('extcore/js/core/libraries/jquery.min.js')!!}

    {!!Html::script('extcore/js/plugins/notifications/pnotify.min.js')!!}

    {!!Html::script('extcore/js/circular-countdown.js')!!}
    {!!Html::script('plugins/sweetalert/sweetalert.min.js')!!}
    <title>{{$object->name}}</title>
</head>
<body>
<input name="_token" type="hidden" value="{{ csrf_token()  }}"/>
<!-- Main content -->
<div class="">

    <!-- Page header -->
    <div class="page-header no-padding" style="color: #fff;background-color: #2196F3;border-color: #2196F3;">
        <div class="page-header-content">
            <div class="page-title" style="padding: 10px;">
                <h4><span class="text-bold">ENCUESTAS</span> - UG</h4>
            </div>


        </div>


    </div>
    <!-- /page header -->


    <!-- Cover area -->
    <div class="profile-cover">
        <div class="profile-cover-img"
             style="background-image: url('{{ asset('extcore/images/backgrounds/plaza3.png') }}')"></div>
        <div class="media">
            <div class="media-left">
                <a href="#" class="profile-thumb">
                    <img src='{{ asset('ic_launcher.png') }}' alt="" style="background-color: #fff;">
                </a>
            </div>

            <div class="media-body">
                <h1>Universidad de Guayaquil
                    <small class="display-block">M&oacute;dulo de Encuestas</small>
                </h1>
            </div>

            <div class="media-right media-middle">
                <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                    <li><a href="http://ugsystem.app" class="btn btn-default"><i
                                    class="icon-library2 position-left"></i> UGSystem</a></li>
                    <li><a href="https://servicioenlinea.ug.edu.ec" class="btn btn-default"><i
                                    class=" icon-library2 position-left"></i> SIUG</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /cover area -->

    @if( $objectSessionSurvey!=null)
        <div class="navbar navbar-default navbar-xs content-group" style="text-align: center">
            <div class="row" style="height: 30px">
                <div class="col-lg-6 col-md-6 col-xs-12" style="text-align: center"><h4 class="text-bold"
                                                                                        id="timerLblInitial">
                        --:--:--</h4>
                </div>

                <div class="col-lg-6 col-md-6  col-xs-12" style="text-align: center"><h4 class="text-bold"
                                                                                         id="timerLblFinish">
                        --:--:--</h4>
                </div>
            </div>
        </div>
    @else
        <br/>
@endif

<!-- Content area -->
    <div class="content">
        @include('flash::message')
        @if(count($errors)>0)
            <div class="alert alert-danger" id="divError">
                @foreach($errors->all() as $error)
                    <p>{{ $error}}</p>
                @endforeach
            </div>

    @endif

    <!-- User profile -->
        <div class="row">
            <div class="col-lg-9">
                <div class="alert alert-info alert-styled-left alert-arrow-left alert-component animated rubberBand">
                    <h6 class="alert-heading text-bold">{{$object->name  }}</h6>
                    {{$object->description  }}
                   @if($objHeadResponseSurvey!=null)
                       @if($objHeadResponseSurvey->status_response=='F')
                    <br/> <b style="color: #8b0000">Nota: </b>  <label  style="color: #8b0000">esta encuesta fue finalizada
                    {{  Utils::getDateCarbon($objHeadResponseSurvey->getAttributes()['date_response_last']) }}</label>
                       @endif
                    @endif
                </div>

                @if( $objectSessionSurvey!=null)
                    <p class="text-bold animated rubberBand">PREGUNTAS DE LA ENCUESTA</p>

                    <div class="alert alert-primary alert-bordered animated rubberBand" id="dvButtonsRef">
                        {{--*/ $index=0 /*--}}
                        {{--*/ $firtsQuestion=0 /*--}}

                        {{--*/ $arrayQuestionResponse= Utils::getCodeQuestionsResponse($objectSessionSurvey['INFORMATION'][0]['COD_ESTUDIANTE'],$object->id) /*--}}

                        @foreach($object->surveyquestions as $surveyQuestion)
                            @if($index==0)
                                {{--*/ $firtsQuestion=$surveyQuestion->id.',1'/*--}}
                            @endif
                            {{--*/ $index++ /*--}}
                            @if(!in_array( $surveyQuestion->id,$arrayQuestionResponse))
                                <button survey-question="{{ $surveyQuestion->id }}" index-question="{{ $index }}"
                                        name="btnRef_{{$index}}"
                                        response-chek="1"
                                        class="label label-flat border-primary text-primary-600 label-icon"
                                        style="padding: 6px;border-width: 1px"><i
                                            class="">{{ str_pad(( $index),2,'0',STR_PAD_LEFT) }}</i></button>
                            @else
                                <button survey-question="{{ $surveyQuestion->id }}" index-question="{{ $index }}"
                                        name="btnRef_{{$index}}"
                                        response-chek="0"
                                        class="label label-flat border-primary text-primary-600 label-icon"
                                        style="padding: 6px;border-width: 1px"><i
                                            class="">{{ str_pad(( $index),2,'0',STR_PAD_LEFT) }}</i></button>
                            @endif


                        @endforeach
                        <input type="hidden" id="hddfirtsQuestion" value="{{ $firtsQuestion }}"/>
                    </div>
                @endif

                <div class="tabbable">

                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="activity">

                            <!-- Timeline -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container">


                                    @if( $objectSessionSurvey==null)
                                        <div class="timeline-row">
                                            <div class="timeline-icon">
                                                <div class="bg-warning-400">
                                                    <i class="  icon-info22"></i>
                                                </div>
                                            </div>


                                            <div class="panel panel-flat timeline-content animated bounceInLeft">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title text-bold">Informaci&oacute;n
                                                        Importante</h6>

                                                </div>

                                                <div class="panel-body">
                                                    <a href="#" class="display-block content-group">
                                                        <img src="/extcore/images/atencion.png"
                                                             class="img-responsive content-group" alt="">
                                                    </a>

                                                    <h6 class="content-group text-semibold bg-warning-800"
                                                        style="padding: 10px">
                                                        <i class="icon-comment-discussion position-left"></i>
                                                        Mensaje de UGSystem:
                                                    </h6>

                                                    <blockquote style="font-size: 14px;">
                                                        <p>Estimado usuario, para poder realizar la encuesta es
                                                            necesario que ingrese sus credenciales del SIUG en el
                                                            lado
                                                            derecho de la pantalla!</p>

                                                    </blockquote>
                                                </div>
                                                <div class="panel-footer panel-footer-transparent">
                                                    <div class="heading-elements">
                                                        <ul class="list-inline list-inline-condensed heading-text">
                                                            <li><label class="text-default"><i
                                                                            class=" icon-price-tags position-left"></i>Categor&iacute;a {{ $object->categorysurvey->name }}
                                                                </label></li>
                                                            <li><label class="text-default"><i
                                                                            class="icon-hour-glass position-left"></i>{{ $object->time=='0'?'Sin l&iacute;mite de tiempo':'Tienes, '.$object->time.' minutos para realizarla' }}
                                                                </label></li>
                                                            <li><label class="text-default"><i
                                                                            class=" icon-list2 position-left"></i>{{ Utils::getQuestionsSurveys($object->id)  }}
                                                                    preguntas</label></li>
                                                        </ul>


                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    @else
                                        <div id="dvQuestionResponse"></div>
                                    @endif
                                </div>
                            </div>
                            <!-- /timeline -->

                        </div>


                    </div>

                </div>

            </div>

            <div class="col-lg-3 ">

            @if( $objectSessionSurvey!=null)
                <!-- Navigation -->


                    <div class="panel panel-flat animated rubberBand">
                        <div class="panel-heading" style="text-align:center">
                            <h6 class="panel-title text-bold bg-teal-800">DATOS DEL USUARIO</h6>

                        </div>
                        <div style="text-align:center">
                            <div class="profile-thumb">
                                <img onerror="this.src='{{ asset('ic_launcher.png')}}'"
                                     src="{{ env('URI_APICOMUNICATION_IMAGES').$objectSessionSurvey['FOTO']}}"
                                     width="100px"
                                     height="100px" class="img-circle" alt="" style="background-color: #fff;">
                            </div>
                        </div>

                        <div class="list-group no-border no-padding-top">
                            <label class="list-group-item"><i
                                        class="icon-user"></i> {{$objectSessionSurvey['INFORMATION'][0]['NOMBRE']}}
                            </label>
                            <label class="list-group-item"><i
                                        class="icon-user"></i> {{$objectSessionSurvey['INFORMATION'][0]['APELLIDO']}}
                            </label>
                            <label class="list-group-item"><i
                                        class="icon-envelop5"></i> {{$objectSessionSurvey['EMAIL_SIUG']}}</label>
                            <label class="list-group-item"><i
                                        class="icon-certificate"></i> {{$objectSessionSurvey['INFORMATION'][0]['DIRECCION']}}
                            </label>


                            <div class="list-group-divider"></div>
                            <div></div>
                        </div>
                        <div class="row" style="padding-bottom: 10px;padding-right: 10px">
                            <div class="col-lg-8 col-lg-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 text-right">
                                @if($objHeadResponseSurvey!=null)
                                    @if($objHeadResponseSurvey->status_response!='F')
                                        {!! Form::open(['route'=> ['surveys.response_survey.exit',$object->id],'method'=>'POST',
                                    'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                        <button type="submit"
                                                class="btn btn-danger btn-block btn-labeled btn-labeled-right">FINALIZAR
                                            Y SALIR <b><i
                                                        class="icon-enter3"></i></b></button>
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['route'=> ['surveys.response_survey.logout',$object->id],'method'=>'POST',
                                  'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                        <button type="submit"
                                                class="btn btn-danger btn-block btn-labeled btn-labeled-right">SALIR <b><i
                                                        class="icon-enter3"></i></b></button>
                                        {!! Form::close() !!}
                                    @endif
                                @endif


                            </div>
                        </div>
                    </div>

                    @if($objHeadResponseSurvey!=null)
                    @if( $object->time!=0 && $objHeadResponseSurvey->status_response!='F' )
                        <div id="divTimerFather"
                             class="panel panel-flat animated rubberBand fab-menu fab-menu-fixed fab-menu-bottom-right"
                             style="background-color: #333333">
                            <div class="panel-heading"
                                 style="text-align:center;padding-bottom: 1px;background-color: #333333">
                                <h6 class="panel-title text-bold bg-teal-800"
                                    style="padding-left: 5px;padding-right: 5px">
                                    TIEMPO RESTANTE</h6>

                            </div>

                            <div class="panel-body">

                                <div class="row">
                                    <div class="text-center col-sm-6" style="height: 90px">
                                        <div class="timer" id="dvTimer"></div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    @endif
                    @endif
                @else

                    <div class="panel panel-flat animated rubberBand">
                        <div class="panel-heading" style="text-align:center">
                            <h6 class="panel-title text-bold bg-teal-800">INICIO SESI&Oacute;N</h6>

                        </div>

                        <div class="panel-body">

                            {!! Form::open(['route'=> ['surveys.response_survey.login',$object->id],'method'=>'POST', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}


                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" placeholder="C&eacute;dula/Pasaporte" name="login"
                                       required="required" aria-required="true" type="text">

                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" placeholder="Password" name="password"
                                       required="required" aria-required="true" type="password">

                                <div class="form-control-feedback">
                                    <i class="icon-key text-muted"></i>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-labeled btn-labeled-right">
                                        Login
                                        <b><i
                                                    class="icon-circle-right2"></i></b></button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /share your thoughts -->
                @endif


            </div>
        </div>
        <!-- /user profile -->


        <!-- Footer -->
        <div class="footer text-muted">
            &copy; 2016. Derechos Reservados <a href="http://www.ug.edu.ec">Centro de C&oacute;mputo UGCore</a>
        </div>
        <!-- /footer -->

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->

{{--*/ $valueTimeInitial=Utils::getDateSQL()/*--}}
@if($objHeadResponseSurvey!=null)
    @if($objHeadResponseSurvey->date_response_initial!=null)
        {{--*/ $valueTimeInitial=$objHeadResponseSurvey->date_response_initial/*--}}
    @endif
@endif

<input id="hddTimer" value="{{ $object->time*60 }}" type="hidden"/>
<input id="hddTimeInitial" value="{{ $valueTimeInitial}}" type="hidden"/>
<input id="hddTimeNow" value="{{ Utils::getDateSQL() }}" type="hidden"/>
<input id="hddSurvey" value="{{$object->id}}" type="hidden"/>

</body>

<script type="text/javascript">

    var timeInitial = null;
    var timeLimit = null;
    var timeNow = null;
    var lblHourInitial = "";

    function isDefined(varData) {
        return varData.length > 0 ? true : false;
    }

    $(document).ready(function (event) {

        timeInitial = new Date($("#hddTimeInitial").val());
        timeLimit = new Date($("#hddTimeInitial").val());
        timeNow = new Date($("#hddTimeNow").val());
        lblHourInitial = "Hora Inicio: &nbsp;" + putNumber(timeInitial.getHours()) + ":" + putNumber(timeInitial.getMinutes()) + ":" + putNumber(timeInitial.getSeconds());

        $("#timerLblInitial").html(lblHourInitial);
        $('#divError').delay(4500).fadeOut(350);

        timeLimit.setSeconds(timeInitial.getSeconds() + parseInt($("#hddTimer").val()));
        if (timeInitial.getTime() === timeLimit.getTime()) {
            $("#timerLblFinish").html("Hora Fin: &nbsp; --:--:--");
        } else {
            $("#timerLblFinish").html("Hora Fin: &nbsp;" + putNumber(timeLimit.getHours()) + ":" + putNumber(timeLimit.getMinutes()) + ":" + putNumber(timeLimit.getSeconds()));
            if (timeNow.getTime() > timeLimit.getTime()) {
                finishAbortSurvey(false);

                if (isDefined($('#dvTimer'))) {
                    $("#divTimerFather").remove();
                }
            } else {
                var milliseconds = timeLimit.getTime() - timeNow.getTime();
                if (isDefined($('#dvTimer'))) {
                    $('#dvTimer').circularCountDown({
                        delayToFadeIn: 500,
                        borderSize: 2,
                        fontSize: 14,
                        size: 100,
                        fontColor: 'white',
                        colorCircle: 'white',
                        background: '#03A9F4',
                        reverseLoading: true,
                        duration: {
                            seconds: milliseconds / 1000
                        },
                        beforeStart: function () {
                            new PNotify({
                                icon: 'icon-notification2',
                                title: 'Atenci\u00F3n',
                                text: "Procura responder todas las preguntas en el tiempo indicado!",
                                addclass: 'alert alert-success alert-styled-right',
                                type: 'success',
                                delay: 3500
                            });
                        },
                        end: function (countdown) {

                           finishAbortSurvey(true);

                            countdown.destroy();
                            $("#divTimerFather").remove();
                        }
                    });
                }
            }
        }
        loadQuestion($("#hddfirtsQuestion").val().split(',')[0], $("#hddfirtsQuestion").val().split(',')[1]);
    });

    function finishAbortSurvey( alertBool){
        $.ajax({
            url: '/surveys/response_survey/abort-survey',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
            data: 'id=' + $("#hddSurvey").val() ,
            dataType: "json",
            success: function (result) {

                if(result.message=="OK"){
                 if(alertBool){
                     swal({
                         title: "Configuraci\u00F3n Incorrecta",
                         text: "Se procede a finalizar la resoluci\u00F3n de la encuesta por factor tiempo!!",
                         type: "warning",
                         confirmButtonColor: "#DD6B55",
                         confirmButtonText: "Aceptar"
                     });
                 }else{
                     new PNotify({
                         icon: 'icon-notification2',
                         title: 'Atenci\u00F3n',
                         text: "La encuesta ha sido finalizada!!!",
                         addclass: 'alert alert-warning alert-styled-right',
                         type: 'error',
                         delay: 4500
                     });
                 }
                }else{
                    new PNotify({
                        icon: 'icon-notification2',
                        title: 'Atenci\u00F3n',
                        text: "La solicitud ha fallado!, " + result.responseText,
                        addclass: 'alert alert-warning alert-styled-right',
                        type: 'error',
                        delay: 3500
                    });
                }
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
            }
        });
    }

    $(document).on('click', '#dvButtonsRef button', function (e) {
        e.preventDefault();
        loadQuestion($(this).attr('survey-question'), $(this).attr('index-question'));
    });

    $(document).on('click', '#btn_previus', function (e) {
        e.preventDefault();
        if (parseInt($(this).attr('index-previus')) > 0) {
            if ($("button[name=btnRef_" + $(this).attr('index-previus') + "]").length > 0) {
                loadQuestion($("button[name=btnRef_" + $(this).attr('index-previus') + "]").attr('survey-question'), $("button[name=btnRef_" + $(this).attr('index-previus') + "]").attr('index-question'));
            }
        }
    });

    $(document).on('click', '#btn_next', function (e) {
        e.preventDefault();
        if (parseInt($(this).attr('index-next')) > 0) {
            if ($("button[name=btnRef_" + $(this).attr('index-next') + "]").length > 0) {
                loadQuestion($("button[name=btnRef_" + $(this).attr('index-next') + "]").attr('survey-question'), $("button[name=btnRef_" + $(this).attr('index-next') + "]").attr('index-question'));
            }
        }
    });


    $(document).on('click', '#btn_nextsave', function (e) {
        e.preventDefault();
        if (parseInt($(this).attr('index-next')) > 0) {
            if ($("button[name=btnRef_" + $(this).attr('index-next') + "]").length > 0) {
                saveQuestionResponse($(this).attr('survey-question'),
                        $("button[name=btnRef_" + $(this).attr('index-next') + "]").attr('index-question'), $("button[name=btnRef_" + $(this).attr('index-next') + "]").attr('survey-question'));
            }
        }
    });

    $(document).on('click', '#btn_update', function (e) {
        e.preventDefault();
        saveQuestionResponse($(this).attr('survey-question'), $(this).attr('index'), $(this).attr('survey-question'));
    });


    function putNumber(parameter) {
        var result = parameter;
        var str = new String(parameter);
        if (str.length == 1) {
            result = '0' + parameter;
        }
        return result;
    }

    function loadQuestion(key, index) {
        $.ajax({
            url: '/surveys/response_survey/question',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
            data: 'id=' + key + '&index=' + index + '&indexmax=' + $("button[name^='btnRef']").length,
            dataType: "json",
            success: function (result) {
                $("#dvQuestionResponse").html(result);

                $("button[name^='btnRef']").attr('style', 'padding: 6px;border-width: 1px;background: #E3F2FD;');
                $("button[response-chek='1']").attr('style', 'padding: 6px;border-width: 1px;background: white;');
                $("button[name^='btnRef'] > i").attr('style', 'color: #1E88E5 !important;');

                $("button[name='btnRef_" + index + "']").attr('style', 'padding: 6px;border-width: 1px;background: #00BCD4;');
                $("button[name='btnRef_" + index + "'] > i").attr('style', 'color:white');
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


</script>
</html>
