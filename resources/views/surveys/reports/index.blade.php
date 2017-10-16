@extends('admin.template.main')
@section('masterTitle')
    Reportes de Encuestas
@endsection
@section('masterTitleModule')
    Encuestas
@endsection
@section('masterDescription')
    Panel de reportes para evaluaci&oacute;n de encuestas
@endsection


@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        {!! Form::open(['route'=> 'surveys.report_global.process','method'=>'POST', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
        <div class=" panel panel-info panel-bordered">
            <div class="panel-heading" style="padding: 4px">
                <h5 class="panel-title text-bold" style="text-align: center;">OPCIONES DE REPORTES DE ENCUESTAS </h5>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('surveys','Seleccione una Encuesta:',["class"=>"text-bold col-lg-4 control-label"]) !!}
                    <div class="col-lg-8">
                        {!! Form::select('surveys',$surveys,null,
                        ["class"=>"select-search","required"=>"required"]) !!}
                    </div>
                </div>
                <div class="form-group">
                   {!! Form::label('title','ESCOJA UN FORMA DE REPORTER&Iacute;A',["class"=>"text-bold col-lg-12 control-label", "style"=>"color:darkred"]) !!}

                </div>



                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="col-lg-6 col-sm-6 col-md-6 text-center"  style="margin-top:1px!important; ">
                            <i class="fa fa-file-excel-o fa-2x"></i>
                            <button name="btnAction" value="XLS" type="submit" class="btn btn-default btn-xs btn-block" >Excel</button>
                        </div>

                        <div class="col-lg-6 col-sm-6  col-md-6 text-center" style="margin-top:1px!important; ">
                            <i class="fa fa-pie-chart  fa-2x"></i>
                            <button name="btnAction" value="VIEW"   type="submit" class="btn btn-default btn-xs btn-block">Visual</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection