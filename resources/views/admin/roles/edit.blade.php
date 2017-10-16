@extends('layouts.back')
@section('masterTitle')
   Roles
@endsection
@section('masterTitleModule')
     Roles del Sistema
@endsection
@section('masterDescription')
   Panel de edici&oacute;n de Roles ingrese los campos necesarios
@endsection
@section('mainContent')

<div class="col-lg-8 col-lg-offset-2">

  {!! Form::open(['route'=> ['admin.roles.update',$objRoles],'method'=>'PUT', 'class'=>'form-horizontal'])!!}
                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE ROLES</h5>
                   </div>
                  <div class="panel-body">
                    <div class="form-group">
                     {!! Form::label('nombre','Nombre Rol:',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                      <div class="col-lg-9">
                     {!! Form::text('nombre',  $objRoles->name,  ["required"=>"required","class"=>"form-control" ]) !!}
                    </div>
                    </div>

                     <div class="form-group">
                     {!! Form::label('nombre_largo','Nombre Largo: ',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                     <div class="col-lg-9">
                                    {!! Form::text('nombre_largo', $objRoles->display_name,["required"=>"required","class"=>"form-control" ]) !!}
                    </div>  </div>
                    <div class="form-group">
                     {!! Form::label('descripcion','Descripcion: ',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                     <div class="col-lg-9">
                                    {!! Form::text('descripcion', $objRoles->description,["required"=>"required","class"=>"form-control" ]) !!}
                    </div>
                      </div>
                   

                    <div class="text-right">
                   
                     <a href="{{ route('admin.roles.index')}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                     
                      {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> ACTUALIZAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                            
                           

                    </div>
                  </div>
                </div>
             {!! Form::close() !!}  
</div>
@endsection