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
    </div>

@endsection

@section('mainContent')
    @php
        $porcentageUser=0;
        $lockButton=0;
    @endphp
    <input id="stepConcourse" value="{{$idStep}}" type="hidden"/>

    <div class="col-lg-12 ">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">VALIDACI&Oacute;N POSTULANTES ETAPA DE EVALUACIONES</h5>
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
                                            <th style="width: 70%">Nombres</th>
                                            <th style="width: 20%">Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($postulants as $objPsotulants)

                                            <tr>
                                                <td>{{$objPsotulants->nuic}}</td>
                                                <td>{{$objPsotulants->names}}</td>
                                                <td>{{$objPsotulants->email}}</td>
                                            </tr>
                                        @endforeach

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
                    <div class="col-lg-4 col-lg-offset-4">
                       {!! Field::text('nota',null,['label'=>'Nota de la Etapa:']) !!}
                        <button class="btn btn-primary ">GRABAR</button>
                    </div>


                </div>
<hr/>
                <div class="row">
                    <div class="panel-heading">
                        <h5 class="panel-title text-bold bg-danger-300" style="text-align: center;">RESULTADOS DE LA ETAPA ANTERIOR</h5>
                    </div>

                </div>





                <div class="row">

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tableData">
                                <thead>
                                <tr>
                                    <th rowspan="2" style="width: 20%;text-align: center" >ETAPA</th>
                                    <th rowspan="2" style="width: 40%;text-align: center" >USUARIO VALIDADOR</th>
                                    <th rowspan="2" style="width: 20%;text-align: center" >FECHA DE VALIDACI&Oacute;N</th>
                                    <th rowspan="2" style="width: 20%;text-align: center" >PORCENTAJE DE VALIDACI&Oacute;N</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($postulants as $objPsotulants)
                                    <tr>
                                        <td style="font-size: 16px;font-weight: bold;text-align: center;">{{$objPsotulants->stepDetail}}</td>
                                        <td style="font-size: 16px;font-weight: bold;text-align: center;">{{$objPsotulants->names_validation}}</td>
                                        <td style="font-size: 16px;font-weight: bold;text-align: center;">{{$objPsotulants->date_validation}}</td>
                                        <td style="font-size: 16px;font-weight: bold;text-align: center;">{{$objPsotulants->percentage_validation}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>

        </div>

    </div>


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

