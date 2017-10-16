@extends('layouts.back')
@section('masterTitle')
    Conceptos para Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    AGREGAR CAMPOS A LOS CONCEPTOS PARA: {{ strtoupper($objConfig->title)}}
@endsection

@section('mainBox')
    <div class="col-lg-12 text-right">
        <a    href="{{route('selection.config.index')}}"  class="btn btn-warning"><i class="icon-undo2 position-left"></i>REGRESAR</a>
    </div>
@endsection

@section('mainContent')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5 class="panel-title text-bold text-center">
                        COMPONENTES EXISTENTES EN: {{strtoupper($objConfig->title)}}</h5>
                </div>
                <div class="panel-body">
                    <h7 class="text-semibold text-danger"><b>* Campo obligatorio para el postulante</b></h7>
                    <div class="table-responsive">
                        <table class="table bg-white table-bordered" id="tableDataConcourseConfig">
                            <thead>
                                <th>Categor&iacute;a</th>
                                <th>SubCategor&iacute;a</th>
                                <th>Documento</th>
                                <th>Campos Disponibles</th>
                            </thead>
                            <tbody id="tBodyConcept">
                            @foreach($conceptConcourses as $objConceptConcourse)
                                <?php $dataTempConceptDocFile=($objConceptConcourse->conceptDocFiles);
                                $checked='';
                                ?>
                                <tr id="_tr_{{$objConceptConcourse->id}}">
                                    <td> {{ $categories[$objConceptConcourse->meritcategory_id] }}</td>
                                    <td> {{ $subcategories[$objConceptConcourse->meritsubcategory_id] }}</td>
                                    <td>
                                        @if($objConceptConcourse->required=='1')
                                            <b style="color: red;font-size: 16px">*</b>
                                        @endif
                                        {{  $objConceptConcourse->document->name }}</td>
                                   <td>
                                       @foreach($objConceptConcourse->document->meritTypeDocumentFields as $typeDocumentField)

                                           <div class="checkbox icheck">
                                               <?php $checked=''?>
                                               @foreach( $dataTempConceptDocFile as $dataEvaluate)
                                                    @if($dataEvaluate->merit_type_document_field_id == $typeDocumentField->id)
                                                        <?php $checked='checked="checked"';?>
                                                    @endif
                                               @endforeach
                                               <label for="typedoc_{{$objConceptConcourse->id}}_{{$typeDocumentField->id}}" class="text-teal-800 text-bold"
                                                      onclick="processDataConcourse('typedoc_{{$objConceptConcourse->id}}_{{$typeDocumentField->id}}')"
                                               >
                                                   <input onclick="processDataConcourse('typedoc_{{$objConceptConcourse->id}}_{{$typeDocumentField->id}}')" {{$checked}} type="checkbox"  typeDocumentField="{{$typeDocumentField->id}}"
                                                          conceptConcourse="{{$objConceptConcourse->id}}"
                                                          id="typedoc_{{$objConceptConcourse->id}}_{{$typeDocumentField->id}}"
                                                   />
                                                   {{$typeDocumentField->name}}
                                               </label>
                                           </div>
                                       @endforeach
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

@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
@endsection

@section('masterJsCustom')
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });

        function processDataConcourse(_element) {
            var typeDocumentField=$("#"+_element).attr('typeDocumentField');
            var conceptConcourse=$("#"+_element).attr('conceptConcourse');
            var objApiRest = new AJAXRest('/selection/config/conceptdocfiles-save', {
                'typeDocumentField':typeDocumentField,
                'conceptConcourse':conceptConcourse
            }, 'POST');
            objApiRest.extractDataAjax(function (_resultContent) {
                if(!$.isEmptyObject(_resultContent)){
                    try{
                        alertToastSuccess(_resultContent.data,3500);
                    }catch (ex){
                        console.log(ex);
                    }
                }
            });
        }
    </script>


@endsection