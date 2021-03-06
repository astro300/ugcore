@extends('layouts.back')
@section('masterTitle')
   Opciones
@endsection
@section('masterTitleModule')
     Opciones del Sistema
@endsection
@section('masterDescription')
   Panel de creaci&oacute;n de opciones ingrese los campos necesarios
@endsection

@section('mainContent')


<div class="col-lg-8 col-lg-offset-2">
{!! Form::open(['route'=> 'admin.options.store','method'=>'POST', 'class'=>'form-horizontal']) !!}
 <input type="hidden" id="moduleaction" value="optionsform"/>
                <div class="panel panel-primary panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE OPCIONES</h5>
                   </div>
                  <div class="panel-body">
                    <div class="form-group">
                     {!! Form::label('optionid','Opci&oacute;n Padre:',["class"=>"text-bold col-lg-3 control-label"]) !!}  
                      <div class="col-lg-9">

                       {!! Form::select('optionid', ['0'=>'-Seleccione un Padre-']+$options, null,['class' => 'select2']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                         {!! Form::label('name','Nombre Opcion:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                            {!! Form::text('name', null,["required"=>"required","class"=>"form-control" ]) !!}
                        </div>  
                    </div>
                    
                    <div class="form-group">
                         {!! Form::label('prefix','Prefijo:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                            {!! Form::number('prefix', null,["required"=>"required","class"=>"form-control" ]) !!}
                        </div>  
                    </div>
                      
                    <div class="form-group">
                         {!! Form::label('url','URL de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                            {!! Form::text('url', null,["class"=>"form-control" ]) !!}
                        </div>  
                    </div>

                    <div class="form-group">
                         {!! Form::label('parameters','Par&aacute;metros de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                            {!! Form::text('parameters', null,["class"=>"form-control" ]) !!}
                        </div>  
                    </div>


                    <div class="form-group">
                         {!! Form::label('icons','&Iacute;cono de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                            {!! Form::text('icons', null,["class"=>"form-control" ]) !!}
                        </div>  
                    </div>

                    <div class="form-group">
                         {!! Form::label('status','Estado de la opci&oacute;n:',array("class" => "text-bold col-lg-3 control-label")) !!}  
                         <div class="col-lg-9">
                          {!! Form::select('status',Config::get('dataselects.status'),null,["class"=>"select2" ,"id"=>"status"]) !!}
                         
                        </div>  
                    </div>


                    <div class="text-right">
                   
                     <a href="{{ route('admin.options.index')}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                     
                      {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                            
                           

                   
                  </div>
                </div></div>
             {!! Form::close() !!}  
</div>

@endsection



 
