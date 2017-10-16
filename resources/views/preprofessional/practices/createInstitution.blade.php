@extends('layouts.back')
@section('masterTitle')
    MÓDULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    PRÁCTICAS EMPRESARIALES
@endsection
@section('masterDescription')
    Panel Principal - Agregar Institución
@endsection
@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        {!! Form::open(['route'=> ['preprofessional.practices.store',$faculty,$career],'method'=>'POST']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold " style="text-align: center;">AGREGAR INSTITUCIÓN</h5>
            </div>
            <div class="panel-body">

                <div class="col-lg-6">
                    {!! Field::text('document',null,['label'=>'RUC',"required"=>"required", "maxlength"=>"13", "size"=>"13" ,"onkeypress"=>"return soloNumeros(event)"]) !!}
                </div>

                <div class="col-lg-6">
                    {!! Field::text('institution',null,['label'=>'INSTITUCIÓN',"required"=>"required"  ,"onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#institution','width: 100%;text-transform: uppercase')"]) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::text('adress',null,['label'=>'DIRECCIÓN',"required"=>"required"]) !!}
                </div>

                <div class="col-lg-6">
                    {!! Field::text('email',null,['label'=>'CORREO ELECTRÓNICO',"required"=>"required"]) !!}
                </div>

                <div class="col-lg-6">
                    {!! Field::text('phone',null,['label'=>'TELÉFONO',"required"=>"required","maxlength"=>"10", "size"=>"10","class"=>"form-control" ,"onkeypress"=>"return soloNumeros(event)"]) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::select('typeinstitution',Config::get('dataselects.TipoInsitutcion'),'PUBLICA',['label'=>'TIPO INSTITUCIÓN',"required"=>"required",  'class'=>'select2']) !!}
                </div>

                <div class="col-lg-12">
                    {!! Field::textarea('description',null,['label'=>'DESCRIPCIÓN',"required"=>"required",'rows'=>"2", 'cols'=>"150",'style'=>'resize:none']) !!}
                </div>

                </br>
                <div class="form-group" style="text-align: center;">
                    <div class="col-md-6">
                        <div class="text-right">
                            <a href="{{ route('preprofessional.practices.index',array($faculty,$career))}}"
                               class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                            class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-lefth">
                            {!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
@section('masterCssCustom')
    <style>
        .paddingBottom {
            padding-bottom: 14px;
        }
    </style>
@endsection
@section('masterJsCustom')
    {!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
    {!!Html::script('js/plugins/forms/validation/validate.min.js')!!}
    {!!Html::script('js/plugins/forms/styling/uniform.min.js')!!}

@endsection

