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
    <div class="col-lg-8 col-lg-offset-2">
        {!! Form::open(['route'=> ['surveys.admin_surveys.update',$object],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">EDICI&Oacute;N DE ENCUESTAS</h5>
            </div>
            <div class="panel-body">

                {!!Field::text('name',$object->name,['label'=>'T&iacute;tulo: ',"required"=>"required",'style'=>'text-transform: uppercase',
                         'onkeydown'=>'a.value = a.value.toUpperCase()'])!!}

                {!!Field::text('description',$object->description,['label'=>'Descripci&oacute;n: ',"required"=>"required",'style'=>'text-transform: uppercase',
                        'onkeydown'=>'a.value = a.value.toUpperCase()'])!!}


                <div class="row">
                    <div class="col-lg-6">
                        {!! Field::select('category_survey',$categorySurveys,$object->category_survey_id,
                                         ['empty'=>'- seleccione -','label'=>'Categor&iacute;a: ','required'=>true ]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('duration',['0'=>'INFINITA']+Utils::getFormatArray(10,120,5),$object->time,
                                           ['empty'=>'- seleccione -','label'=>'Min. Duraci&oacute;n:','required'=>true ]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        {!!Field::text('date_range', $object->date_start." / ".$object->date_end ,['label'=>'Rango Fechas: ',"required"=>"required",'style'=>'text-transform: uppercase'])!!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::select('status',Config::get('dataselects.status'),$object->status,
                                           ['empty'=>'- seleccione -','label'=>'Estado','required'=>true ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">{!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn bg-teal-800 btn-block')) !!}</div>
                    <div class="col-lg-6"><a class="btn btn-danger btn-block" href="{{route('surveys.admin_surveys.index')}}"><i class="icon-previous"></i>REGRESAR</a></div>


                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12" style="padding: 20px">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">BANCO DE ENCUESTAS</h5>
            </div>
            <div class="panel-body">


                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover bg-white" id="tableData">
                        <thead>
                        <tr>
                            <th>Encuesta</th>
                            <th>Tipo</th>
                            <th>Preguntas</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <br/>

    </div>



@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/daterangepicker/moment.min.js')!!}
    {!!Html::script('plugins/daterangepicker/daterangepicker.js')!!}
    {!!Html::script('/js/modules/surveys/surveys.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('plugins/daterangepicker/daterangepicker.css')!!}
@endsection
