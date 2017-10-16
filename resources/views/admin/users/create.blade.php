@extends('layouts.back')
@section('masterTitle')
   Usuarios
@endsection
@section('masterTitleModule')
     Usuarios del Sistema
@endsection
@section('masterDescription')
   Panel de creaci&oacute;n de usuarios ingrese los campos necesarios
@endsection


@section('mainContent')
<div class="col-lg-8 col-lg-offset-2">

{!! Form::open(['route'=> 'admin.users.store','method'=>'POST', 'class'=>'form-horizontal']) !!}
                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">Creaci&oacute;n de Usuarios</h5>
                   </div>
                  <div class="panel-body">

                    <div class="form-group">
                     {!! Form::label('cedula','C&eacute;dula Usuario:',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                      <div class="col-lg-9">
                         {!! Form::text('cedula', null,  ["required"=>"required","class"=>"form-control" ]) !!}
                      </div>
                    </div>

                     <div class="form-group">
                     {!! Form::label('nombres','Nombres :',["class"=>"text-bold col-lg-3 control-label"]) !!}
                      <div class="col-lg-9">
                         {!! Form::text('nombres', null,  ["required"=>"required","class"=>"form-control" ]) !!}
                      </div>
                    </div>
                      <div class="form-group">
                          {!! Form::label('apellidos','Apellidos:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                          <div class="col-lg-9">
                              {!! Form::text('apellidos', null,  ["required"=>"required","class"=>"form-control" ]) !!}
                          </div>
                      </div>

                     <div class="form-group">
                  {!! Form::label('password','Clave Usuario: ',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                     <div class="col-lg-9">
                     {!! Form::password('password', ["required"=>"required","class"=>"form-control" ]) !!}
                    </div> 
                     </div>
                  


                    <div class="form-group">
                     {!! Form::label('email','Email: ',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                         <div class="col-lg-9">
                          {!! Form::email('email', null,["required"=>"required","class"=>"form-control" ]) !!}
                        </div>
                    </div>

                      <div class="form-group">
                          {!! Form::label('status','Sexo:',array("class" => "text-bold col-lg-3 control-label")) !!}
                          <div class="col-lg-9">
                              {!! Form::select('sexo',['1'=>'Masculino','0'=>'Femenino'],null,
                              ["class"=>"form-control select2" ,"id"=>"sexo"]) !!}

                          </div>
                      </div>

                   <div class="form-group">
                         {!! Form::label('status','Estado:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                          {!! Form::select('status',Config::get('dataselects.status'),null,["class"=>"form-control select2" ,"id"=>"status"]) !!}
                         
                        </div>  
                    </div>
                   

                    <div class="text-right">
                   
                     <a href="{{ route('admin.users.index')}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                     
                      {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                            
                           

                   
                  </div>
                </div></div>
             {!! Form::close() !!}  

</div>
@endsection
