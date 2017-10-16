@extends('layouts.back')
@section('masterTitle')
    Conceptos para Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Concepto para Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    AGREGAR CONCEPTOS PARA: {{ strtoupper($objConfig->title)}}
@endsection


@section('mainContent')
    <div class="row">
        <div class="form-horizontal col-lg-10 col-lg-offset-1">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            <input name="_urlAjaxPut"
                   value="{{ route('selection.config.conceptput',$objConfig->id) }}"
                   type="hidden"
                   readonly="readonly"/>


            <input name="_conceptID" type="hidden"/>


            <div class="panel panel-info  panel-flat border-full-info">
                <div class="panel-heading">
                    <h5 class="panel-title text-bold " style="text-align: center;font-size: 14px">AGREGAR/ACTUALIZAR
                        COMPONENTES PARA: {{ strtoupper($objConfig->title)}}</h5>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="col-lg-3">
                            <div style="padding: 1px 4px">
                                {!! Field::select('category',$categories->toArray(),null,['empty'=>'- seleccione -',"class"=>"select2", 'label'=>'Categor&iacute;a']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="padding: 1px 4px">
                                {!! Field::select('subCategory',$subcategories->toArray(),null,['empty'=>'- seleccione -',"class"=>"select2", 'label'=>'SubCategor&iacute;a']) !!}
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div style="padding: 1px 4px">
                                {!! Field::select('typeDocument',$typeDocuments->toArray(),null,['empty'=>'- seleccione -',"class"=>"select2", 'label'=>'Documentos']) !!}
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div style="padding: 1px 4px">
                                {!! Field::number('score',null,['label'=>'Puntaje por documento','min'=>"0.0"]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="padding: 1px 4px">
                                {!! Field::select('number_max_valid',Utils::getFormatArray(1,100,1),1,['empty'=>'-','label'=>'Núm. máximo de documentos a reconocer']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div style="padding: 1px 4px">
                                {!! Field::number('max_score',null,['label'=>'Puntaje Máximo','min'=>"0.0"]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div style="padding: 1px 4px">
                                {!! Field::select('many',['1'=>'SI','0'=>'NO'],null,['empty'=>'-','label'=>'Varios','class'=>"select2"]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="padding: 1px 4px">
                                {!! Field::select('order',Utils::getFormatArray(1,100,1),1,['empty'=>'-','label'=>'Orden']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div style="padding: 1px 4px">
                                {!! Field::select('status',Config::get('dataselects.status'),'A',['empty'=>'-','label'=>'Estado']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div style="padding: 1px 4px">
                                {!! Field::select('requiredf',['2'=>'NO','1'=>'SI'],'2',['empty'=>'-','label'=>'Requerido']) !!}
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div style="padding: 1px 4px">
                                {!! Field::text('observation',null,[ 'label'=>'Observaciones Jurado']) !!}
                            </div>
                        </div>




                        <div class="col-lg-12 ">
                            <div class="form-group text-right" style="padding: 1px 4px" id="dvButtonActions">

                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>


    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-flat panel-info  border-full-info">
                <div class="panel-heading">
                    <h5 class="panel-title text-bold" style="text-align: center;font-size: 14px">
                        COMPONENTES EXISTENTES EN: {{strtoupper($objConfig->title)}}</h5>

                </div>
                <div class="panel-body">
                    <h7 class="text-semibold"><b style="color: red;">* Campo obligatorio para el postulante</b></h7>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tableDataConcourseConfig">
                            <thead>
                            <tr>
                                <th>Categor&iacute;a</th>
                                <th>SubCategor&iacute;a</th>
                                <th>Documento</th>
                                <th>Observaciones</th>
                                <th>Orden</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="tBodyConcept">
                            @foreach($conceptConcourses as $objConceptConcourse)
                                <tr id="_tr_{{$objConceptConcourse->id}}">
                                    <td id="_td_{{$objConceptConcourse->id}}_0"> {{ $categories[$objConceptConcourse->meritcategory_id] }}</td>
                                    <td id="_td_{{$objConceptConcourse->id}}_1"> {{ $subcategories[$objConceptConcourse->meritsubcategory_id] }}</td>
                                    <td id="_td_{{$objConceptConcourse->id}}_2">
                                        @if($objConceptConcourse->required=='1')
                                            <b style="color: red;font-size: 16px">*</b>
                                        @endif
                                        {{ $typeDocuments[$objConceptConcourse->merittypedocument_id] }}</td>
                                    <td id="_td_{{$objConceptConcourse->id}}_3">{{ $objConceptConcourse->observation }}</td>
                                    <td id="_td_{{$objConceptConcourse->id}}_4">{{ $objConceptConcourse->ubication }}</td>
                                    <td id="_td_{{$objConceptConcourse->id}}_5">
                                        <button class="btn btn-primary btn-xs" style="padding: 4px;"
                                                onclick="editConcept(this)"
                                                data-href="{{route('selection.config.editConcourseConcepts',$objConceptConcourse->id)}}">
                                            <i class="fa fa-pencil"></i>&nbsp;<span
                                                    style="padding: 1px 4px;">EDITAR</span></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('masterJsCustom')
    {!!Html::script('js/modules/selection/tree.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
@endsection