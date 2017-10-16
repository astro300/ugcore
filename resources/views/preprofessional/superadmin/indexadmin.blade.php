@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    USUARIOS ADMINISTRADORES PREPROFESIONALES
@endsection
@section('masterDescription')
    Panel de creación de usuarios
@endsection
@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        @if(!$flag=="true")
            <div class="panel panel-primary panel-flat">
                <div class="panel-heading">
                    CREAR USUARIOS ADMINISTRADORES PRE-PROFESIONALES
                </div>
                <div class="panel-body">
                    @if($Nameusers=="")
                        {!! Form::open(['route'=> ['Preprofessional.superadmin.shearch'],'method'=>'POST', 'class'=>'header-search-wrapper']) !!}
                        <div class="input-group content-group" style="margin-bottom: 10px !important;">
                            <div class="has-feedback has-feedback-left">
                                <input class="form-control input-xlg" placeholder="INGRESAR CÉDULA" name="document" id="document" type="text" required="required" onkeypress="return verifyKeyPressPattern(event, /[0-9]/,'#document')" >

                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-muted text-size-base"></i>
                                </div>
                            </div>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route'=> ['Preprofessional.superadmin.store',$documentUSers,$Nameusers,$EmailUsers],'method'=>'POST', 'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                {!! Form::label('document','CÉDULA:',["class"=>"text-bold control-label"]) !!}
                            </div>
                            <div class="col-lg-9">
                                {!! Form::text('document', $documentUSers,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                {!! Form::label('users','NOMBRES:',["class"=>"text-bold control-label"]) !!}
                            </div>
                            <div class="col-lg-9">
                                {!! Form::text('users', $Nameusers,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                {!! Form::label('facultie','FACULTAD:',["class"=>"text-bold control-label"]) !!}
                            </div>
                            <div class="col-lg-9">
                                {!! Form::select('faculties',$faculties,null,["class"=>"select2" ,"id"=>"faculties","placeholder"=>"- seleccione facultad -","required"=>"required"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 text-center">
                                {!! Form::label('careers','CARRERA:',["class"=>"text-bold control-label"]) !!}
                            </div>
                            <div class="col-lg-9">
                                {!! Form::select('careers',[],null,["class"=>"select2","id"=>"careers","placeholder"=>"- seleccione carrera -","required"=>"required"]) !!}
                            </div>
                        </div>
                        </br>
                        <div class="form-group" style="text-align: center;">
                            <div class="col-md-6">
                                <div class="text-right">
                                    <a href="{{ route('Preprofessional.superadmin.create')}}"
                                       class="btn btn-primary btn-labeled legitRipple"><b><i
                                                    class=" glyphicon glyphicon-plus"> </i></b>CREAR OTRO USUARIO</a>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="text-lefth">
                                    {!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                                </div>
                            </div>
                        </div>
                </div>
                {!! Form::close() !!}
                @endif
            </div>
        @endif
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
    {!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
@endsection