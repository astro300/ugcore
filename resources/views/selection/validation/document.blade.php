@extends('layouts.back')
@section('masterTitle')
    Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Panel de validaci&oacute;n de usuarios al proceso de selecci&oacute;n
@endsection

@section('mainBox')
    <div class="col-lg-12 text-right">
        <a   href="{{ route('process.validation.index') }}"  class="btn btn-warning warning-300" style="color:#000000">
            <i class="icon-backward2 position-left"></i>REGRESAR</a>

        <button class="btn btn-primary" onclick="window.open('/static/shangaiRanking.html','','toolbar=not,scrollbars=yes,resizable=not,width=800,height=600')">RANKING SHANGAI</button>

    </div>

@endsection

@section('mainContent')
    @php
        $porcentageUser=0;
        $lockButton=0;
    @endphp
    <input id="stepConcourse" value="{{$idStep}}" type="hidden"/>
    <input id="masterIDResponse" value="{{$objResponseMaster->id}}" type="hidden"/>
    <div class="col-lg-12 ">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">VALIDACI&Oacute;N POSTULANTES</h5>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-7">
                        @if($scope!='')
                            <a href="{{ route('process.validation.user',$idStep).'?scope='}}"
                               class="btn bg-teal-400">
                                Quitar Filtro
                            </a>
                        @endif
                    </div>
                    <div class="col-lg-5 ">
                        {!! Form::open(['route' => ['process.validation.user',$idStep],'method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
                        <div class="input-group content-group" style="margin-bottom: 10px !important;">
                            <div class="has-feedback has-feedback-left">
                                {!! Form::text('scope', $scope, [ "class"=>"form-control input-xlg" ,"placeholder"=>"C&eacute;dula, Apellidos &oacute; Nombres"]) !!}

                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-muted text-size-base"></i>
                                </div>
                            </div>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary ">Buscar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class=" text-center">
                            <div style="padding: 4px;"><b>Proceso: {{ strtoupper($objConfig->title) }}</b></div>
                            <div class="col-lg-2">
                                @if(($postulants->currentPage()-1)==0)
                                    <a class="btn btn-primary btn-xs" disabled=""> <b><i class="icon-backward2"></i></b>ANTERIOR</a>
                                @else
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('process.validation.user',$idStep)."?page=".($postulants->currentPage()-1)."&scope=".$scope}}"
                                       rel="prev"> <b><i class="icon-backward2"></i></b>ANTERIOR</a>
                                @endif
                            </div>
                            <div class="col-lg-8 ">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="tableData">
                                        <thead>
                                        <tr>
                                            <th style="width: 10%">C&eacute;dula</th>
                                            <th style="width: 60%">Nombres</th>
                                            <th style="width: 20%">Email</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $postulacion='';$typePostulation='MT'; $datePostulation=''; @endphp
                                        type_postulation
                                        @foreach($postulants as $objPsotulants)
                                            @php $typePostulation=$objPsotulants->type_postulation;
                                            $datePostulation=$objPsotulants->date_close;
                                            $postulacion=\UGCore\Core\Entities\Selections\MeritConcourseConfigMatriz::find($objPsotulants->merit_concourse_matriz_id)->detailField->description; @endphp
                                            <tr>
                                                <td>{{$objPsotulants->nuic}}</td>
                                                <td>{{$objPsotulants->names}}</td>
                                                <td>{{$objPsotulants->email}}</td>

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" style="text-align: left"><b>Postulaci&oacute;n: </b>{{$postulacion}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: left"><b>Tiempo Dedicaci&oacute;n: </b>{{config('dataselects.dedicacion')[$typePostulation]}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: left"><b>Fecha Postulaci&oacute;n </b>{{$datePostulation}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="col-lg-8 col-lg-offset-2">
                                        <label>{{ $postulants->currentPage().' de '.$postulants->lastPage() }}</label>
                                    </div>


                                </div>
                            </div>
                            @if(($postulants->currentPage()-$postulants->lastPage())==0)
                                <div class="col-lg-2"><a class="btn btn-primary btn-xs" disabled=""> SIGUIENTE <b><i
                                                    class=" icon-forward3"></i></b></a></div>
                            @else
                                <a class="btn btn-primary btn-xs"
                                   href="{{ route('process.validation.user',$idStep)."?page=".($postulants->currentPage()+1)."&scope=".$scope}}"
                                   rel="next"> SIGUIENTE <b><i class=" icon-forward3"></i></b></a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel-heading">
                        <h5 class="panel-title text-bold bg-danger-300" style="text-align: center;">DOCUMENTOS SUBIDOS POR EL USUARIO: {{$postulants[0]->names}}</h5>
                    </div>

                </div>





                <div class="row">

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tableData">
                                <thead>
                                <tr>
                                    <th rowspan="2" style="width: 20%;text-align: center" >M&Eacute;RITO BASE</th>
                                    <th rowspan="2" style="width: 20%;text-align: center" >SUB-CONCEPTOS</th>
                                    <th rowspan="2" style="width: 40%;text-align: center" >DOCUMENTOS</th>
                                    <th rowspan="2" style="width: 20%;text-align: center" >VALIDACI&Oacute;N DE ARCHIVOS</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objConceptsInformation['categories'][$objConfig->id] as $keyCategory=>$value)

                                    @foreach($objConceptsInformation['subcategories'][$objConfig->id][$keyCategory] as $keySubCategory=>$valueSubCategory)

                                        @foreach($objConceptsInformation['documents'][$objConfig->id][$keyCategory][$keySubCategory] as $keyDocument=> $objDocument)
                                            <tr>
                                                <td class="center subtitle" style="padding: 4px;">
                                                    {{$value}}
                                                </td>
                                                <td class="subtitle" style="padding: 4px;background-color: #DCE6F1">
                                                    {{$valueSubCategory}}
                                                </td>
                                                <td style="padding: 1px 4px;" class="subtitle black">{{ $objDocument['name'] }}
                                                   @if($objDocument['jurado']!=null)
                                                    <br/>
                                                    <code>
                                                        <b class="text-blue-800">Consideraciones: </b> {{ $objDocument['jurado'] }}
                                                    </code>
                                                    @endif
                                                    @if($objDocument['puntaje_one']!=null)
                                                        <br/>
                                                        <code>
                                                            <b class="text-blue-800">Puntaje por documento: </b> {{ $objDocument['puntaje_one'] }}
                                                        </code>
                                                    @endif
                                                    @if($objDocument['max_accept']!=null)
                                                        <br/>
                                                        <code>
                                                            <b class="text-blue-800">N&uacute;mero m&aacute;x reconocer: </b> {{ $objDocument['max_accept'] }}
                                                        </code>
                                                    @endif
                                                    @if($objDocument['puntaje_max']!=null)
                                                        <br/>
                                                        <code>
                                                            <b class="text-blue-800">Puntaje m&aacute;ximo: </b> {{ $objDocument['puntaje_max'] }}
                                                        </code>
                                                    @endif


                                                </td>

                                                <td style="text-align: center;padding: 1px 4px;" class="subtitle">

                                                    @foreach($objDocument['details'] as $itemDocument)

                                                            @if($itemDocument['namefile']!=null && $itemDocument['namefile']!='')
                                                                <span onclick="viewModalURL('{{route('document.concourse',[$objConfig->id,$itemDocument['namefile']])}}')"
                                                                      class="label bg-maroon"  style="cursor:pointer">VER ARCHIVO</span>&nbsp;

                                                                <input value="1"
                                                                       idDetail="{{$itemDocument['idDetail']}}"
                                                                       @if($itemDocument['percentage_validation']>'0') checked
                                                                       @php
                                                                           $porcentageUser+=$itemDocument['percentage_validation'];
                                                                           $lockButton=1;
                                                                       @endphp
                                                                       @endif
                                                                       @if($itemDocument['status_validation']=='F') disabled
                                                                       @endif
                                                                       type="radio"
                                                                       id="chks_{{$itemDocument['idDetail']}}"
                                                                       name="valida_data[{{$itemDocument['idDetail']}}]">
                                                                <label for="chks_{{$itemDocument['idDetail']}}">SI</label>
                                                                &nbsp;
                                                                <input value="0"
                                                                       idDetail="{{$itemDocument['idDetail']}}"
                                                                       type="radio"
                                                                       id="chkn_{{$itemDocument['idDetail']}}"
                                                                       @if($itemDocument['percentage_validation']=='0' || $itemDocument['percentage_validation']==null) checked
                                                                       @endif
                                                                       @if($itemDocument['status_validation']=='F') disabled
                                                                       @endif
                                                                       name="valida_data[{{$itemDocument['idDetail']}}]">
                                                                <label for="chkn_{{$itemDocument['idDetail']}}">NO</label>
                                                                <br/><br>

                                                            @endif

                                                    @endforeach

                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                    @if($lockButton==0)
                    <div class="row" id="divSaveValidation">
                        <div class="panel-heading text-right">
                            <button class="btn btn-success" id="btnCalificarData"><i class="fa fa-floppy-o"></i> GRABAR
                                CALIFICACI&Oacute;N
                            </button>
                        </div>

                    </div>
                        @else
                    <div class="row">
                        <div class="panel-heading text-center">
                            <h3 class="text-bold text-danger"> CALIFICACI&Oacute;N: {{$porcentageUser}}</h3>
                        </div>

                    </div>
                    @endif

            </div>
        </div>

    </div>

    @component('selection.modals.viewlinkpdf')
    @endcomponent


@endsection
@section('masterJsCustom')
    <script type="text/javascript">

        function viewModalURL(url){
            showLoading();
            $("#divPdfView").html('<object type="application/pdf" id="objPdfView"  width="100%" height="100%">Documento no Existe</object>');
            $("#objPdfView").attr("data",url);
            $("#modalPDF").modal();
            hideLoading();
        }

        $(function () {


            $("#btnCalificarData").on('click',function(){
                swal({
                        title: "Confirmación de acciones",
                        text: "Est\u00E1s seguro que deseas finalizar la califición para el postulante, una vez realizada la acción única y exclusivamente el comité de apelaciones podrá modificar éste valor?",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        cancelButtonText: "NO",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var validateData = {};
                            $.each($("input[name^='valida_data[']:checked"), function () {
                                validateData[$(this).attr('idDetail')] = this.value;
                            });
                            var objApiRest = new AJAXRest('/selection/selection-config-validation-document', {
                                'idDetailValidate': validateData,
                                'stepConcourse': $('#stepConcourse').val(),
                                'masterIDResponse': $("#masterIDResponse").val()
                            }, 'POST');
                            objApiRest.extractDataAjax(function (_resultContent, status) {
                                if (status == 200) {
                                    alertToastSuccess(_resultContent.data, 3500);
                                    $("#divSaveValidation").html('');
                                    $("input[name^='valida_data[']").attr('disabled','disabled');

                                    var alert = document.querySelector(".sweet-alert"),
                                        okButton = alert.getElementsByTagName("button")[0];
                                    $(okButton).trigger("click");
                                } else {

                                    swal({
                                        title: "ERROR",
                                        text: _resultContent.message,
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ACEPTAR",
                                        closeOnConfirm: true
                                    });


                                }
                            });
                        }
                    });


            });


        });



    </script>


@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!! Html::style('/css/checkbox.css') !!}
    <style>
        table>tbody>tr>td,
        table>tbody>tr>th{
            border: 1px solid #9ac5cc!important;
        }

        [type="radio"]:checked + label, [type="radio"]:not(:checked) + label {
            padding-left: 20px!important;
                     }
    </style>

@endsection

