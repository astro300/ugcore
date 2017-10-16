@extends('layouts.back')
@section('masterTitle')
   Usuarios
@endsection
@section('masterTitleModule')
     Usuarios del Sistema
@endsection
@section('masterDescription')
   Panel de edici&oacute;n de usuarios ingrese los campos necesarios
@endsection




@section('mainContent')
<div class="col-lg-8 col-lg-offset-2">

{!! Form::open(['route'=> ['admin.users.update',$objUser],'method'=>'PUT', 'class'=>'form-horizontal']) !!}
                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">Edici&oacute;n de Usuarios</h5>
                   </div>
                  <div class="panel-body">

                    <div class="form-group">
                     {!! Form::label('name','C&eacute;dula Usuario:',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                      <div class="col-lg-9">
                         {!! Form::text('name', $objUser->name,  ["required"=>"required","class"=>"form-control" ]) !!}
                      </div>
                    </div>

                      <div class="form-group">
                          {!! Form::label('nombres','Nombres :',["class"=>"text-bold col-lg-3 control-label"]) !!}
                          <div class="col-lg-9">
                              {!! Form::text('nombres', $objUser->first_name,  ["required"=>"required","class"=>"form-control" ]) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          {!! Form::label('apellidos','Apellidos:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                          <div class="col-lg-9">
                              {!! Form::text('apellidos', $objUser->last_name,  ["required"=>"required","class"=>"form-control" ]) !!}
                          </div>
                      </div>



                     <div class="form-group">
                  {!! Form::label('password','Clave Usuario: ',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                     <div class="col-lg-9">
                     {!! Form::password('password', ["class"=>"form-control" ]) !!}
                    </div> 
                     </div>
                  


                    <div class="form-group">
                     {!! Form::label('email','Email: ',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                         <div class="col-lg-9">
                          {!! Form::email('email',  $objUser->email,["required"=>"required","class"=>"form-control" ]) !!}
                        </div>
                    </div>
                      <div class="form-group">
                          {!! Form::label('status','Sexo:',array("class" => "text-bold col-lg-3 control-label")) !!}
                          <div class="col-lg-9">
                              {!! Form::select('sexo',['1'=>'Masculino','0'=>'Femenino'],$objUser->sex,
                              ["class"=>"form-control select2" ,"id"=>"sexo"]) !!}

                          </div>
                      </div>


                      <div class="form-group">
                         {!! Form::label('status','Estado:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                          {!! Form::select('status',Config::get('dataselects.status'),$objUser->status,["class"=>"form-control select2" ,"id"=>"status"]) !!}
                         
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

