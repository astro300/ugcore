<div class="row">
    <div class="col-lg-9">
        {!! Form::select("documents_".$category."_".$subcategory,$typeDocuments,null,["class"=>"select-search"]) !!}
    </div>
    <div class="col-lg-3 ">
        <button action-button="true" class="btn btn-xs btn-primary" category="{{$category}}" subcategory="{{$subcategory}}"><span> AGREGAR</span></button>
    </div>
</div>
<div class="row" style="padding: 10px">
    <h6 class="panel-title text-bold" style="text-align: center;color:#ffffff;background-color: #263238;font-size: 12px">DOCUMENTOS AGREGADOS</h6>
</div>
<div class="row" id="dv_{{$category}}_{{$subcategory}}">
    <div class="checkbox checkbox-danger"
         style="margin-top: 2px;margin-bottom: 2px;">
        <input  checked="checked"  class="styled" id="typedocument_h"
                name="typedocument[]" value="" type="checkbox"/>
        <label for="typedocument_h">  hh</label>
    </div>
</div>

