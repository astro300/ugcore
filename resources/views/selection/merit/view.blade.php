@extends('layouts.back')
@section('masterTitle')
Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
FORMULARIO DE REGISTRO DE RECEPCIÓN DE DOCUMENTOS PARA LA EVALUACIÓN DE MÉRITOS
@endsection


@section('mainContent')

<div class="form-horizontal">
<div class="row">
    <div class="content">
        <div class="panel panel-white">
              <div class="bg-danger-300 panel-heading " style="background:#E57373;padding:8px">
                <h5 class="panel-title text-bold " style="text-align: center;font-size: 14px;">DATOS</h5>

            </div>
            <div class="panel-body">

                <div class="form-group col-lg-6">
                    <div class="col-lg-12">
                        {!! Form::label('name','PROCESO:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                        <div class="col-lg-9">
                          {!! Form::text('name',  $objResponseMaster->meritconcourseconfig->title,["class"=>"form-control"
                            ,"id"=>"name","required"=>"required","disabled"=>"disabled"]) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <div class="col-lg-12">
                        {!! Form::label('name','PARTICIPANTE:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                        <div class="col-lg-9">
                            {!! Form::text('name', $objUser->description,["class"=>"form-control"
                            ,"id"=>"name","required"=>"required","disabled"=>"disabled"]) !!}

                        </div>
                    </div>
                </div>


                <div class="form-group col-lg-6">
                    <div class="col-lg-12">
                        {!! Form::label('name','FECHA:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                        <div class="col-lg-9">
                            {!! Form::text('name', Utils::getFormatDateDB($objResponseMaster->getAttributes()['created_at'],true,false),["class"=>"form-control"
                            ,"id"=>"name","required"=>"required","disabled"=>"disabled"]) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <div class="col-lg-12">
                        {!! Form::label('name','HORA:',["class"=>"text-bold col-lg-3 control-label"]) !!}
                        <div class="col-lg-9">
                            {!! Form::text('name',Utils::getFormatDateDB($objResponseMaster->getAttributes()['created_at'],false,true),["class"=>"form-control"
                            ,"id"=>"name","required"=>"required","disabled"=>"disabled"]) !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<div class="row">
    <!-- Clickable title -->


    @foreach($categories as $category)
    <div class="content">
        <div class="panel panel-white">
            <div class="bg-danger-300 panel-heading " style="background:#E57373;padding:8px">
                <h5 class="panel-title text-bold " style="text-align: center;font-size: 14px;">{{ $category->name
                    }}</h5>

                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>

                    </ul>
                </div>
            </div>

            @if($category->categories()->count()==0)
            <br/>

            <div class="row">
                <div class="col-lg-12">
                     @foreach($category->typedocuments as $typeDocument)
                     @if($typeDocument->many==0)
                         <div class="col-lg-4">
                        <div class="panel panel-flat border-left-info border-right-info border-top-info border-bottom-info">
                                 <div class="panel-heading alert-info" style="padding: 5px; background-color: rgb(224, 247, 250);">
                                    <h6 class="panel-title" style="font-size:12px"><span class="text-semibold">{{ $typeDocument->name }}</span>  {{ $typeDocument->description }}</h6>
                                </div>
                                
                                <div class="panel-body">
                                <br/>
                                   @foreach($objResponseMaster->getDetailsByTypeDocument($typeDocument->id) as $content)
                                <div class="form-group">
                                   
                                   @if(trim( $content->description)!='')
                                   <div class="col-lg-12">
                                       <input type="text" name="txt[{{ $typeDocument->id}}][]" class="form-control" 
                                             readonly="" 
                                              value="{{ $content->description }}"
                                               />
                                        
                                   </div>
                                  @endif
                                  

                                   <div class="col-lg-12" style="text-align:center;padding:5px">
                                        {!! Utils::getRefByFileFTP($content->namefile,$content->path,env('URL_LOCAL_FILE').'concurso_meritos/','files/modules/concurso_meritos/') !!}
                                   </div>
                                 
                                </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                     @endif
                    @endforeach
                </div>
            </div>


            <br/>
            @else

            <div class="stepy-clickable">

                @foreach($category->categories as $key=> $subCategoryChildren)
                <fieldset title="{{ ++$key }}">
                    <legend class="text-semibold">{{ $subCategoryChildren->name }}</legend>

                    @foreach($subCategoryChildren->categories as $key=> $subCategory)
                    <div class="row">
                        <div class="col-lg-12">
                             <div class="panel panel-flat border-left-info border-right-info border-top-info border-bottom-info">
                                <div class="panel-heading alert-info" style="padding: 5px; background-color: rgb(224, 247, 250);">
                                    <h6 class="panel-title" style="font-size:12px"><span class="text-semibold">{{ $subCategory->name }}</span></h6>
                                </div>
                                
                                <div class="panel-body">
                                @foreach($subCategory->typedocuments as $Dkey=> $typeDocument)   
                                    <br/>
                                   <div class="form-group">
                                     <div class="panel">
                                            <div class="panel-heading alert-info" style="padding: 8px;">
                                               
                                                <h6 class="panel-title" style="font-size:12px"> 
                                                 
                                               
                                                 <span class="text-semibold">{{$typeDocument->name}}
                                                 </span>
                                                 </h6>
                                            </div>
                                            
                                            <div class="panel-body"  style="padding: 8px;" >
                                            
                                            <div class="form-group" style="padding:5px" id="div_{{$typeDocument->id }}">
                                          <?php $isData=false; ?>
                                         @foreach($objResponseMaster->getDetailsByTypeDocument($typeDocument->id) as $content)
                                          <?php $isData=true; ?>
                                                            <div class="form-group">
                                                              <div class="col-lg-1">
                                        {!! Utils::getRefByFileFTP($content->namefile,$content->path,env('URL_LOCAL_FILE').'concurso_meritos/','files/modules/concurso_meritos/') !!}
                                   </div>
                                               <div class="col-lg-11">
                                                 <label> {{ $content->description }}</label>
                                               </div>

                                                               
                                                            </div>
                                          @endforeach
                                          @if(!$isData)
                                            El participante: {{ $objUser->description }} no subi&oacute; informaci&oacute;n en esta secci&oacute;n
                                          @endif
                                            </div>
                                          
                                            </div>
                                     </div>
                                     </div>
                                @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    <br/>
                    @endforeach

                </fieldset>
                @endforeach


                <button type="button" style=" display: none;" class="btn btn-primary stepy-finish">Submit <i
                        class="icon-check position-right"></i></button>
            </div>

            @endif


        </div>
    </div>
    @endforeach


</div>
<div class="text-right">

    <a href="{{ route('catalog.meritconcourseconfig.show',$objResponseMaster->meritconcourseconfig->id)}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                class=" icon-undo2 position-left"> </i></b>REGRESAR</a>

    
</div>

</div>
@endsection

@section('masterJsCustom')

<script src="{{ URL::asset('extcore/js/plugins/forms/wizards/stepy.min.js')}}"></script>

{!!Html::script('extcore/js/plugins/forms/validation/validate.min.js')!!}
{!!Html::script('extcore/js/plugins/forms/styling/uniform.min.js')!!}


<script type="text/javascript">
   $(function() {
   // Override defaults
    $.fn.stepy.defaults.legend = false;
    $.fn.stepy.defaults.transition = 'fade';
    $.fn.stepy.defaults.duration = 150;
    $.fn.stepy.defaults.backLabel = '<i class="icon-arrow-left13 position-left"></i> Atr&aacute;s';
    $.fn.stepy.defaults.nextLabel = 'Siguiente <i class="icon-arrow-right14 position-right"></i>';


    // Clickable titles
    $(".stepy-clickable").stepy({
        titleClick: true,
        validate:true
    });




    // Initialize plugins
    // ------------------------------

    // Apply "Back" and "Next" button styling
    $('.stepy-step').find('.button-next').addClass('btn btn-primary btn-xs');
    $('.stepy-step').find('.button-back').addClass('btn btn-default btn-xs');
  });
</script>

@endsection


