@extends('layouts.back')
@section('masterTitle')
   Cambio Clave
@endsection
@section('masterTitleModule')
     Cambio de Clave del Sistema
@endsection
@section('masterDescription')
   Pantalla para cambiar credenciales de acceso al Sistema.
@endsection


@section('mainContent')
<div class="col-lg-8 col-lg-offset-2">

{!! Form::open(['route'=> 'admin.users.postChangePassword','method'=>'POST', 'class'=>'form-horizontal']) !!}
                <div class="panel  panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">Cambio de Clave</h5>
                   </div>
                  <div class="panel-body">

                    <div class="form-group  {{ $errors->has('clave') ? ' has-error' : '' }}">

                     {!! Form::label('clave','Clave Actual de Usuario:',["class"=>"text-bold col-lg-4 control-label"]) !!}  
                      <div class="col-lg-8">
                       {!! Form::password('clave', ["required"=>"required","class"=>"form-control" ]) !!}
                      </div>
                    </div>


                     <div class="form-group {{ $errors->has('nueva_clave') ? ' has-error' : '' }}">

                     {!! Form::label('nueva_clave','Nueva Clave de Usuario:',["class"=>"text-bold col-lg-4 control-label"]) !!}  
                      <div class="col-lg-8">
                       {!! Form::password('nueva_clave',["required"=>"required","class"=>"form-control" ]) !!}
                      </div>
                    </div>



                     <div class="form-group   {{ $errors->has('confirma_clave') ? ' has-error' : '' }}">

                     {!! Form::label('confirma_clave','Confirma Clave de Usuario:',["class"=>"text-bold col-lg-4 control-label"]) !!}  
                      <div class="col-lg-8">
                       {!! Form::password('confirma_clave',["required"=>"required","class"=>"form-control" ]) !!}
                      </div>
                    </div>

                    <div class="text-right">
                      {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
                  </div>
                </div></div>
             {!! Form::close() !!}  

</div>
@endsection