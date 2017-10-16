@extends('layouts.back')
@section('masterTitle')
    Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    panel principal del Proceso de Selecci&oacute;n de Personal
@endsection




@section('mainContent')

    <div class="panel panel-primary panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-bold" style="text-align: center;">Proceso de Validaci&oacute;n</h5>
        </div>
        <div class="panel-body">
            <div class="col-lg-7">
                <div class="col-lg-12" style="margin-bottom: 10px !important;">
                    {!! Utils::buildSelectCustomAttrs($concourses,'title','id','select2','concourses',['date_initial','date_finish','status']) !!}
                </div>

            </div>
            <div class="col-lg-5">
                <div class="col-lg-12"><label class="text-bold">Vigencia:</label>
                    <label class="" id="lblRangeProcess">--</label>
                </div>
                <div class="col-lg-12"><label class="text-bold">Estado:</label>
                    <label class="" id="lblStatusProcess">--</label>
                </div>

            </div>

            <div class="row">
                <div class="text-center text-brown-800" ><h4><b>ETAPAS DEL PROCESO</b></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white table-striped table-hover">
                            <thead>
                            <th>Nombre Etapa</th>
                            <th>Fechas</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody id="trDescriptions">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr/>
            <br/>
            <div class="row">
                <div class="col-lg-9">
                    <div class="panel text-center panel-info panel-bordered">
                        <div class="panel-heading" style="padding: 4px;"><b>POSTULACIONES DURANTE EL PROCESO</b>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" id="hddConcourse"/>
                            <div class="chart" id="basic_lines"></div>


                        </div>

                    </div>
                </div>
                <div class="col-lg-3">

                        <div class="panel text-center panel-info panel-bordered">
                            <div class="panel-heading" style="padding: 4px;"><b>NRO. POSTULANTES</b></div>
                            <div class="panel-body">
                                <div class="content-group-sm position-relative">
                                    <i class="fa fa-user fa-2x" style="color:#263238"></i>
                                    <h2 class="mt-15 mb-5 bolder" style="color:#FF7043" id="postulantes">0</h2>
                                    <div class="text-size-mini"><b>TOTAL POSTULANTES</b></div>

                                </div>
                            </div>
                            <div class="panel-footer">
                                <a class="btn btn-primary btn-xs" href="#" id="reportPostulants">REPORTE</a>
                            </div>
                        </div>

                </div>
            </div>

        </div>

    </div>





@endsection

@section('masterJsCustom')
    {!!Html::script('plugins/charts/highcharts.js')!!}
    {!!Html::script('plugins/charts/exporting.js')!!}
    {!!Html::script('js/modules/selection/validations.js')!!}

@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
@endsection