    <div class="tab-pane active" id="divInit_{{$code}}">
        <div class="col-lg-10">
            @foreach($objMeritConceptDocFields as $keyDetail =>$fieldItemDoc)
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label($fieldItemDoc->documentField->fields,strtoupper($fieldItemDoc->documentField->name).':',["class"=>"text-bold control-label"]) !!}
                        {!! Form::text($fieldItemDoc->documentField->fields,'',["class"=>"form-control form-control-custom"
                        ,"id"=>$fieldItemDoc->documentField->fields,"required"=>"required",'data-conceptDocField'=>$concourseConcept->id]) !!}
                    </div>
                </div>
            @endforeach

            <div class="col-lg-6">
                <div class="form-group">
                    {!! Form::label('documento','DOCUMENTO:',["class"=>"text-bold control-label"]) !!}
                    {!! Form::file('documento',["class"=>"ugcore-file form-control-custom"
                    ,"id"=>'documento',"required"=>"required",'data-conceptDocField'=>$concourseConcept->id]) !!}
                    <div id="divFileExist"  class="form-group">

                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-2">
            <div class="row" style="padding: 4px">
                <input class="btn bg-teal btn-xs" data-typedocument="{{$concourseConcept->merittypedocument_id}}"
                       data-div="divInit_{{$code}}"
                       data-conceptconcourse="{{$concourseConcept->id}}"
                       data-iddetail="0"
                       onclick="saveFieldsInDoc(this)" value="GUARDAR" type="button">
            </div>
            <div class="row" style="padding: 4px">
                <input class="btn btn-danger btn-xs"  onclick="deleteFieldsInDoc(this)" data-TypeDocument="{{$concourseConcept->merittypedocument_id}}"
                       data-div="divInit_{{$code}}"
                       data-conceptConcourse="{{$concourseConcept->id}}"
                       data-iddetail="0"
                       value="ELIMINAR" type="button">
            </div>
        </div>
    </div>