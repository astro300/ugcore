@extends('layouts.back')
@section('masterTitle')
  MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   ASIGNAR CATEDRA INTEGRADA
@endsection
@section('masterDescription')
  Panel de Asignacion de Estudiantes a la Catedra
@endsection

@section('mainContent')
@if(!$flag=="true")


						
						<div class="panel-heading">

							<h5 class="text-semibold" style="text-align: center;">ASIGNACION DE ESTUDIANTE EN LA {{UGCore\Library\Utils::showCathedra($getNameCathedra)}}</h5>

						</div>
 
						<div class="panel-body">								
@if($new_name_estu=="")						
{!! Form::open(['route'=> ['preprofessional.cathedra.showDatosStudent',$id,$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}  									
								    <div class="form-group">
                                            <div class="col-lg-6">
                                                {!! Form::label('document','INGRESE CEDULA',["class"=>"text-bold col-lg-2 control-label"]) !!}
                                                <div class="col-lg-4">
                                                    {!! Form::text('document', null,  ["required"=>"required","maxlength"=>"10", "size"=>"10","class"=>"form-control" ,"onkeypress"=>"return soloNumeros(event)"]) !!}
                                                </div>
                                            <div class="col-lg-2" style="padding-left: 0px;">

			                     				{!! Form::button('<i class="icon-search4 position-center"></i>', array('type' => 'submit', 'class' => "btn btn-info btn-rounded btn-xs legitRipple col-lg-7")) !!} 

			                     		
			                    			</div>
			                    		</div>
                                	</div>

                                	<BR>
                                	<div class="form-group">
	                                	<div class="col-md-12">
											<div class="text-center">
												<a href="{{ route('preprofessional.cathedra.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
											</div>
										</div>
									</div>
@endif
{!! Form::close() !!}
@if(!$new_name_estu=="")	
{!! Form::open(['enctype'=>"multipart/form-data",'route'=> ['preprofessional.cathedra.addasignemntstudent',$documentstudent,$id,$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']) !!}
									<div class="form-group">
                                            <div class="col-lg-6">
                                                {!! Form::label('document','CEDULA ESTUDIANTE:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                                                <div class="col-lg-6">
                                                    {!! Form::text('document', $documentstudent,  ["required"=>"required","class"=>"form-control","readonly"=>"readonly" ]) !!}
                                                </div>
                                            </div>
                                    </div>

									<div class="form-group">
                                            <div class="col-lg-6">
                                                {!! Form::label('student','ESTUDIANTE:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                                                <div class="col-lg-6">
                                                    {!! Form::label($new_name_estu,$new_name_estu,["class"=>" col-lg-20 control-label"]) !!}
                                                </div>
                                            </div>
                                    </div>



								<div class="form-group">
                                         <div class="col-lg-6">
											{!! Form::label('tutor','ASIGNAR TUTOR',["class"=>"text-bold col-lg-3 control-label"]) !!}
											<div class="col-lg-6">
											  <select class="form-control" name="tutor" placeholder="- seleccione Tutor Academico -">
											  	@foreach ($gettutor as $var)
											      <option value="{{$var['COD_DOCENTE']}}">{{$var['NOMBRES']}}</option>
											    @endforeach
											  </select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-6">
					                         {!! Form::label('parameters','SUBIR DOCUMENTO',array("class" => "text-bold col-lg-3 control-label")) !!}  
					                        <div class="col-lg-10">
					                           <input required="required" name="file" type="file" class="file-input" data-show-preview="true" data-show-upload="false">
					                        </div>  
					                </div>
					            </div>		
					            </br>
								<div class="form-group" style="text-align: center;">
									<div class="col-md-6">
										<div class="text-right">
											<a href="{{ route('preprofessional.cathedra.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
										</div>
									</div>	
	
									<div class="col-md-2">
										<div class="text-lefth">
											{!! Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> ASIGNAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!} 
										</div>
									</div>				
								</div>

						</div>
					

{!! Form::close() !!}
@endif
@endif
@endsection
@section('masterCssCustom')
<style >
	.paddingBottom{
		    padding-bottom: 14px;
	}
</style>
@endsection

@section('masterJsCustom')

		{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.js')!!}	
		{!!Html::script('extcore/js/plugins/pickers/pickadate/picker.date.js')!!}	
		{!!Html::script('extcore/js/modules/preprofesionales/preprofessional.js')!!}
		{!!Html::script('extcore/js/plugins/forms/validation/validate.min.js')!!}
		{!!Html::script('extcore/js/plugins/forms/styling/uniform.min.js')!!}

<script src="{{ URL::asset('extcore/js/plugins/uploaders/fileinput.min.js')}}"></script>



@endsection