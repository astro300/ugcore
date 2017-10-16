@extends('layouts.back')
@section('masterTitle')
    Configuraci&oacute;n de Encuestas
@endsection
@section('masterTitleModule')
    Administraci&oacute;n de Encuestas
@endsection
@section('masterDescription')
    Panel de Administraci&oacute;n para la elaboraci&oacute;n de Encuestas
@endsection

@section('mainContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">{{$object->name}}</h5>

            </div>
            <div class="panel-body">


                <input type="hidden"  name="_token" value="{{ csrf_token()  }}"/>
                <input type="hidden" id="txtSurvey" value="{{$object->id}}"/>
                {!!Field::text('name',$object->name,['label'=>'T&iacute;tulo: ',"required"=>"required",'style'=>'text-transform: uppercase',
                        'onkeydown'=>'a.value = a.value.toUpperCase()','disabled'=>'disabled'])!!}

                {!!Field::text('description',$object->description,['label'=>'Descripci&oacute;n: ',"required"=>"required",'style'=>'text-transform: uppercase',
                        'onkeydown'=>'a.value = a.value.toUpperCase()','disabled'=>'disabled'])!!}


                <div class="row">
                    <div class="col-lg-6">
                        {!! Field::select('category_survey',$categorySurveys,$object->category_survey_id,
                                         ['empty'=>'- seleccione -','label'=>'Categor&iacute;a: ','required'=>true,'disabled'=>'disabled' ]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('duration',['0'=>'INFINITA']+Utils::getFormatArray(10,120,5),$object->time,
                                           ['empty'=>'- seleccione -','label'=>'Min. Duraci&oacute;n:','required'=>true,'disabled'=>'disabled' ]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        {!!Field::text('date_range', $object->date_start." / ".$object->date_end ,['label'=>'Rango Fechas: ',"required"=>"required",'style'=>'text-transform: uppercase','disabled'=>'disabled'])!!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('status',Config::get('dataselects.status'),$object->status,
                                           ['empty'=>'- seleccione -','label'=>'Estado','required'=>true ,'disabled'=>'disabled']) !!}
                    </div>
                </div>

                <div class="text-left">
                    <a href="{{route("surveys.admin_surveys.index")}}"  class="btn  btn-labeled bg-teal-800 legitRipple btn-block"><b><i class=" icon-file-check position-left"></i></b>MEN&Uacute; ENCUESTAS</a>


                    </a>
                </div>
            </div>
        </div>
       </div>
    </div>

    <div class="col-lg-12" style="padding: 20px">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">ADMINISTRACI&Oacute;N DE PREGUNTAS</h5>
            </div>
            <div class="panel-body">


            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tableQuestions">
                    <thead>
                    <tr>
                        <th>Pregunta</th>
                        <th>Tipo</th>
                        <th>M&aacute;x Respuestas</th>
                        <th>Asignar</th>
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
    {!!Html::script('plugins/daterangepicker/moment.min.js')!!}
    {!!Html::script('plugins/daterangepicker/daterangepicker.js')!!}
    {!!Html::script('/js/modules/surveys/surveys.js')!!}
    <script src="/plugins/iCheck/icheck.min.js"></script>

@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('plugins/daterangepicker/daterangepicker.css')!!}
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">

@endsection

