@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    Ingreso de Nuevo Prospecto
@endsection
@section('masterDescription')
    Panel Ingreso de Prospecto
@endsection
@section('mainContent')
    <div class="col-lg-9 col-lg-offset-2">
        <div class="col-lg-12">
            {!! Form::open(['route'=> ['preprofessional.prospects.newprospectus',$faculty,$carrer],'method'=>'POST']) !!}
            <div class="panel panel-primary panel-flat">
                <div class="panel-heading">
                    <div class="panel-title text-bold" style="text-align: center;">Ingreso Prospecto</div>
                </div>
                <div class="panel-body">

                   <div class="col-lg-6">
                       {!! Field::text('document',null,["required"=>"required", "size"=>"10","label"=>"C&Eacute;DULA:"]) !!}
                   </div>
                    <div class="col-lg-6">
                        {!! Field::text('last_name',null,["required"=>"required","label"=>"APELLIDOS:",
                        "onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#last_name','width: 100%;text-transform: uppercase')"]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::text('names',null,["required"=>"required","label"=>"NOMBRES:",
                        "onkeypress"=>" return verifyKeyPressPattern(event, /[A-Z a-z]/, '#names','width: 100%;text-transform: uppercase')"]) !!}
                    </div>

                    <div class="col-lg-6">
                        {!! Field::text('email_institu',null,["required"=>"required", "label"=>"EMAIL INSTITUCIONAL:" ]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::text('email_alternat', null,  ["required"=>"required","label"=>"EMAIL PERSONAL:"  ]) !!}
                    </div>

                    <div class="col-lg-6">
                        {!! Field::text('phone', null,  ["required"=>"required","label"=>"TELÉFONO:",
                        "onkeypress"=>"return soloNumeros(event)" ]) !!}
                    </div>

                    <div class="col-lg-12">
                        {!! Field::text('direccion', null,   ["required"=>"required","label"=>"DIRECCI&Oacute;N:"]) !!}
                    </div>



                    <div class="col-lg-6">
                        {!! Field::text('facultie',  $getfaculties[0]->NOMBRE,   ["required"=>"required","label"=>"FACULTAD:",'readonly'=>true]) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Field::text('careers', $getcareers[0]->NOMBRE_CARRERA,   ["required"=>"required","label"=>"CARRERA:",'readonly'=>true]) !!}
                    </div>
                </div>

                <div class="panel-footer">

                            <a href="{{ route('preprofessional.prospects.index',array($faculty,$carrer))}}"
                               class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                            class=" icon-undo2 position-left"> </i></b>REGRESAR</a>

                            {!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                </div>
        </div>
            {!! Form::close() !!}
    </div>

    </div>
@endsection
@section('masterCssCustom')
    <style>
        .paddingBottom {
            padding-bottom: 14px;
        }
    </style>
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
    <link rel="stylesheet" type="text/css" href="/plugins/fileinput/fileinput.min.css">
@endsection
@section('masterJsCustom')
    {!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
    <script type="text/javascript" src="{{ asset('plugins/fileinput/fileinput.min.js') }}"></script>
@endsection