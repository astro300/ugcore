@extends('layouts.back')
@section('masterTitle')
    Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    FORMULARIO PARA:{{ strtoupper($objConfig->title)}}
@endsection


@section('mainBox')
    <div class="col-lg-12 text-right">
        <a href="{{route('process.user.show',$objConfig->id)}}" class="btn bg-teal-400"><i
                    class="icon-printer position-left"></i>Vista Previa</a>
        <a onclick="return sendDocument('cerrar formulario?, recuerde que una vez cerrado ya no podrá editar su informaci\u00F3n',
                '{{ route('process.user.finish',$objConfig->id) }}')" class="btn bg-indigo-400"><i
                    class="icon-lock2 position-left"></i>Enviar Postulaci&oacute;n</a>
    </div>
@endsection

@section('mainContent')


    {!! Form::hidden('merit_concourse_config_id', $objConfig->id,[]) !!}
    {!! Form::hidden('_token',csrf_token(),[]) !!}

    <div class="content" style="padding: 1px;">
        <div class="nav-tabs-custom border-full-info">
            <ul class="nav nav-tabs">
                <li class="active"><a class="bg-tab-important" style="font-size: 12px" href="#tab00"
                                      data-toggle="tab"><i
                                class=" icon-profile position-left"></i>Datos Personales </a></li>
                @foreach($objConceptsInformation['categories'][$objConfig->id] as $key=>$value)
                    <li><a style="font-size: 12px" href="#tab{{ $key }}" data-toggle="tab" class="bg-tab-important"><i
                                    class=" icon-certificate position-left"></i>{{ $value }}</a></li>
                @endforeach
                <li><a class="bg-tab-important" style="font-size: 12px" href="#tabAB" data-toggle="tab"><i
                                class=" icon-profile position-left"></i>&Aacute;reas Disponibles </a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab00">
                    <div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::open(['route' => ['process.user.updateDataPerson',$objConfig->id, Auth::user()],
        'enctype'=>'multipart/form-data']) !!}

                                    <div class="col-lg-9">
                                        <div class="panel panel-primary registration-form">
                                            <div class="panel-heading " style="padding: 3px">
                                                <h6 class="panel-title text-center"><b>DATOS GENERALES</b></h6>
                                                <div class="text-center">
                                                    <small class="display-block">Modifica tus datos de ser necesario
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-horizontal">

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Nombres</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('first_name', $objInformation->nombres,['id'=>'first_name',"required"=>"required","placeholder"=>"Ingrese sus Nombres","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-user-check text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Apellidos</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('last_name', $objInformation->apellidos,['id'=>'last_name',"required"=>"required","placeholder"=>"Ingrese sus Apellidos","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-user-check text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Cédula</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('cedula', $objInformation->cedula,['id'=>'cedula',"required"=>"required","placeholder"=>"Ingrese su C&eacute;dula / Pasaporte","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-vcard text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Sexo</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::select('idSexo',$idSexo,$objInformation->idSexo,['class'=>'form-control select' , 'id'=>'idSexo']) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-vcard text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Fecha de
                                                            Nacimiento</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('fechaNacimiento',$objInformation->fecha_nacimiento,['class'=>'form-control pickadate','id'=>'fechaNacimiento','placeholder'=>'Seleccione fecha Nacimiento', "readonly"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-calendar text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Nacionalidad</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('nacionalidad', $objInformation->nacionalidad,['id'=>'nacionalidad',"required"=>"required","placeholder"=>"Ingrese su Nacionalidad","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-city text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Estado Civil</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::select('estadoCivil',$estadoCivil,$objInformation->idEstadoCivil,['class'=>'form-control select' , 'id'=>'estadoCivil']) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-city text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Email</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::email('email', $objInformation->email,['id'=>'email',"required"=>"required","placeholder"=>"Ingrese su Email","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-mention text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Celular</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('celular', $objInformation->celular,['id'=>'celular',"required"=>"required","placeholder"=>"Ingrese su número celular","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-iphone text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel  panel-primary registration-form">
                                            <div class="panel-heading" style="padding: 8px">
                                                <h6 class="panel-title text-center"><b>DIRECCIÓN DOMICILIARIA</b></h6>
                                                <div class="text-center">
                                                    <small class="display-block">Modifica tus datos de ser necesario
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Provincia</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::select('idProvDir',$paisesDir,$objInformation->idProvDir,['class'=>'form-control select' , 'id'=>'idProvDir']) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-city text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Ciudad</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::select('idCiudadDir',$idCiudadDir,$objInformation->idCiudadDir,['class'=>'form-control select' , 'id'=>'idCiudadDir']) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-city text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Dirección</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('direccionDir', $objInformation->direccionDir,['id'=>'direccionDir',"required"=>"required","placeholder"=>"Ingrese su Dirección domiciliaria","class"=>"form-control"]) !!}

                                                                <span class="input-group-addon"><i
                                                                            class="icon-vcard text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Teléfono</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('telefonoDir', $objInformation->telefonoDir,['id'=>'telefonoDir',"required"=>"required","placeholder"=>"Ingrese su número telefónico del domicilio","class"=>"form-control"]) !!}

                                                                <span class="input-group-addon"><i
                                                                            class="icon-phone text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary registration-form">
                                            <div class="panel-heading" style="padding: 8px">
                                                <h6 class="panel-title text-center"><b>DIRECCIÓN LABORAL</b></h6>
                                                <div class="text-center">
                                                    <small class="display-block">Modifica tus datos de ser necesario
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Provincia</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::select('idProvLab',$paisesLab,$objInformation->idProvLab,['class'=>'form-control select' , 'id'=>'idProvLab']) !!}

                                                                <span class="input-group-addon"><i
                                                                            class="icon-city text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Ciudad</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::select('idCiudadLab',$idCiudadLab,$objInformation->idCiudadLab,['class'=>'form-control select' , 'id'=>'idCiudadLab']) !!}

                                                                <span class="input-group-addon"> <i
                                                                            class="icon-city text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Dirección</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('direccionLab', $objInformation->direccionLab,['id'=>'direccionLab',"required"=>"required","placeholder"=>"Ingrese su Dirección de trabajo","class"=>"form-control"]) !!}

                                                                <span class="input-group-addon"><i
                                                                            class="icon-vcard text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Teléfono</label>
                                                        <div class="col-lg-9" style="margin-top: 0px">
                                                            <div class="input-group">
                                                                {!! Form::text('telefonoLab', $objInformation->telefonoLab,['id'=>'telefonoLab',"required"=>"required","placeholder"=>"Ingrese su número telefónico del trabajo","class"=>"form-control"]) !!}
                                                                <span class="input-group-addon"> <i
                                                                            class="icon-phone text-muted"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <!-- User thumbnail -->
                                        <div class="thumbnail">
                                            <div class="thumb thumb-rounded thumb-slide">

                                            </div>
                                            <div class="caption text-center">
                                                <h6 class="text-semibold no-margin">{{$objInformation->nombres.' '.$objInformation->apellidos}}
                                                    <br/>
                                                    <small class="display-block">Foto de Perfil</small>
                                                </h6>
                                                <br/>
                                                @if($objInformation->archivo_foto=='')
                                                    <img src="/images/none.png" alt="" class="img-thumbnail">
                                                @else
                                                    <img src="{{route('photo.concourse',[$objInformation->archivo_foto])}}"
                                                         alt="" class="img-thumbnail">
                                                @endif
                                                <label for="documentoFoto" class="ugcore-file-picker"><i
                                                            class="fa fa-photo"></i> Foto</label>
                                                {!! Form::file('documentoFoto',["class"=>'ugcore-file-picker', 'id'=>'documentoFoto','accept'=>"image/*"]) !!}
                                            </div>
                                        </div>


                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-4">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-block"><i
                                                        class="icon-floppy-disk"></i> GUARDAR
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($objConceptsInformation['categories'][$objConfig->id] as $keyCategory=>$value)
                    <div class="tab-pane" id="tab{{$keyCategory}}">
                        <div class="callout bg-danger-300">
                            <h4>ATENCI&Oacute;N Solo se admiten archivos pdf con un peso m&aacute;ximo 8 MB!</h4>
                            <p>Documento obligatorio para poder postularse (<i class="fa fa-asterisk"></i>)</p>
                        </div>
                        <div>
                            <div class="panel-body">
                                @foreach($objConceptsInformation['subcategories'][$objConfig->id][$keyCategory] as $keySubCategory=>$valueSubCategory)
                                    <div class="panel panel-primary  panel-bordered">
                                        <div class="panel-heading">
                                            <h7 class="panel-title">
                                                <a data-toggle="collapse"
                                                   href="#collapseSubcategory{{$keyCategory.'_'.$keySubCategory}}"
                                                   aria-expanded="false"
                                                   class="collapsed text-bold">{{ $valueSubCategory}}</a>
                                            </h7>
                                        </div>
                                        <div id="collapseSubcategory{{$keyCategory.'_'.$keySubCategory}}"
                                             class="panel-collapse collapse" aria-expanded="false">
                                            <div class="panel-body">
                                                @foreach($objConceptsInformation['documents'][$objConfig->id][$keyCategory][$keySubCategory] as $keyDocument=> $objDocument)
                                                    @if(count($objConceptsInformation['fields'][$objDocument['concourseConceptID']])>0)
                                                        <table class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th style="padding: 3px 5px !important;width: 10px">Req.
                                                                </th>
                                                                <th style="padding: 3px 5px !important;">Nombre</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>


                                                            <tr>
                                                                <td>
                                                                    @if($objDocument['required']=='1')
                                                                        <i style="color: #8b0000"
                                                                           class="fa fa-asterisk"></i>
                                                                    @else
                                                                        &nbsp;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <label style="font-weight: bolder">{{ $objDocument['name'] }}</label>
                                                                    <footer style="background-color: #f9f2f4;">
                                                                        <code style="padding: 0px;color: #081538">
                                                                            <cite title="Ayuda Al Participante"
                                                                                  style="font-weight: initial;">{{ $objDocument['observation'] }}</cite>
                                                                        </code></footer>
                                                                </td>
                                                            </tr>


                                                            <tr>

                                                                <td colspan="2"
                                                                    style="padding-left: 0px!important;padding-right: 0px!important;padding-top: 0px!important;">
                                                                    <div class="tabbable">
                                                                        <ul class="nav nav-tabs nav-tabs-top nav-tabs-solid nav-tabs-component"
                                                                            id="ul_0{{$objDocument['concourseConceptID']}}">
                                                                            <li>
                                                                                <a onclick="addGroupElements('{{$objDocument['concourseConceptID']}}')">
                                                                            <span class="label label-primary position-left"
                                                                                  style="padding: 4px;cursor: pointer">
                                                                                <i class="icon-plus-circle2"></i>&nbsp; AGREGAR OTRO</span></a>
                                                                            </li>
                                                                            @foreach($objDocument['details'] as $keyDetail =>$itemDocument)

                                                                                <li class="@if($keyDetail==0)active @endif">
                                                                                    <a href="#divInit_{{$keyDetail.$objDocument['concourseConceptID']}}"
                                                                                       data-toggle="tab"><b><i
                                                                                                    class="icon-certificate"></i></b></a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>

                                                                        <div class="tab-content"
                                                                             id="tab_0{{$objDocument['concourseConceptID']}}">

                                                                            @foreach($objDocument['details'] as $keyDetail =>$itemDocument)
                                                                                <div class="tab-pane @if($keyDetail==0)active @endif"
                                                                                     id="divInit_{{$keyDetail.$objDocument['concourseConceptID']}}">
                                                                                    <div class="col-lg-10">
                                                                                        @foreach($objConceptsInformation['fields'][$objDocument['concourseConceptID']] as $fieldItemDoc)

                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    {!! Form::label($fieldItemDoc->documentField->fields,strtoupper($fieldItemDoc->documentField->name).':',["class"=>"text-bold control-label"]) !!}
                                                                                                    {!! Form::text($fieldItemDoc->documentField->fields,isset($objConceptsInformation['resultDB'][$itemDocument['idDetail']][trim($fieldItemDoc->documentField->fields)])==true?$objConceptsInformation['resultDB'][$itemDocument['idDetail']][trim($fieldItemDoc->documentField->fields)]:'',["class"=>"form-control form-control-custom"
                                                                                                    ,"id"=>$fieldItemDoc->documentField->fields,"required"=>"required",'data-conceptDocField'=>$objDocument['concourseConceptID']]) !!}
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach

                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                {!! Form::label('documento','DOCUMENTO:',["class"=>"text-bold control-label"]) !!}



                                                                                                {!! Form::file('documento', ["class"=>"ugcore-file form-control-custom"
                                                                                                ,"id"=>'documento',"required"=>"required",'data-conceptDocField'=>$objDocument['concourseConceptID']]) !!}
                                                                                                <div id="divFileExist"
                                                                                                     class="form-group">
                                                                                                    <br/><b>ARCHIVO
                                                                                                        EXISTENTE:</b>&nbsp;
                                                                                                    @if($itemDocument['filecreation']!=null)
                                                                                                        <div id="divfile_{{$keyDetail}}">
                                                                                                    <span onclick="viewModalURL('{{route('document.concourse',[$objConfig->id,$itemDocument['namefile']])}}')"
                                                                                                          class="label bg-maroon"
                                                                                                          style="cursor:pointer">VER ARCHIVO</span>
                                                                                                        </div>

                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <div class="row"
                                                                                             style="padding: 4px">
                                                                                            <input class="btn bg-teal btn-xs"
                                                                                                   data-typedocument="{{$keyDocument}}"
                                                                                                   data-div="divInit_{{$keyDetail.$objDocument['concourseConceptID']}}"
                                                                                                   data-conceptconcourse="{{$objDocument['concourseConceptID']}}"
                                                                                                   data-iddetail="{{$itemDocument['idDetail']}}"
                                                                                                   onclick="saveFieldsInDoc(this)"
                                                                                                   value="GUARDAR"
                                                                                                   type="button">
                                                                                        </div>
                                                                                        <div class="row"
                                                                                             style="padding: 4px">
                                                                                            <input class="btn btn-danger btn-xs"
                                                                                                   onclick="deleteFieldsInDoc(this)"
                                                                                                   data-TypeDocument="{{$keyDocument}}"
                                                                                                   data-div="divInit_{{$keyDetail.$objDocument['concourseConceptID']}}"
                                                                                                   data-conceptConcourse="{{$objDocument['concourseConceptID']}}"
                                                                                                   data-iddetail="{{$itemDocument['idDetail']}}"
                                                                                                   value="ELIMINAR"
                                                                                                   type="button">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                        <hr/>
                                                    @else
                                                        <table class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th style="padding: 3px 5px !important;">Req.</th>
                                                                <th style="padding: 3px 5px !important;width: 35%;text-align: center">
                                                                    Nombre
                                                                </th>
                                                                <th style="padding: 3px 5px !important;;text-align: center">
                                                                    Permite <br/> Varios
                                                                </th>
                                                                <th style="padding: 5px 5px !important;width: 50%;text-align: center">
                                                                    Selecci&oacute;n de Archivos
                                                                </th>
                                                                <th style="padding: 5px 5px !important;width: 15%;text-align: center">
                                                                    Acciones
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr>
                                                                <td>
                                                                    @if($objDocument['required']=='1')
                                                                        <i style="color: #8b0000"
                                                                           class="fa fa-asterisk"></i>
                                                                    @else
                                                                        &nbsp;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <label style="font-weight: bolder">{{ $objDocument['name'] }}</label>
                                                                    <footer style="background-color: #f9f2f4;">
                                                                        <code style="padding: 0px;color: #081538">
                                                                            <cite title="Ayuda Al Participante"
                                                                                  style="font-weight: initial;">{{ $objDocument['observation'] }}</cite>
                                                                        </code></footer>
                                                                </td>

                                                                @if($objDocument['many']=='1')
                                                                    <td style="vertical-align: middle;text-align: center"
                                                                        class="bg-yellow  text-bold">SI
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        {!! Form::file('file['.$objDocument['concourseConceptID'].'][]',["class"=>"file-input" ,"data-show-preview"=>"false",
                                                           "data-show-upload"=>"true",'multiple'=>'multiple']) !!} </td>
                                                                @else
                                                                    <td style="vertical-align: middle;text-align: center"
                                                                        class="text-bold">NO
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        {!! Form::file('file['.$objDocument['concourseConceptID'].']',["class"=>"file-input" ,"data-show-preview"=>"false",
                                                           "data-show-upload"=>"true"]) !!} </td>
                                                                @endif
                                                                <td id="td_{{$objDocument['concourseConceptID']}}"
                                                                    style="text-align: center">
                                                                    @foreach($objDocument['details'] as $itemDocument)
                                                                        @if($itemDocument['filecreation']!=null)
                                                                            <span onclick="viewModalURL('{{route('document.concourse',[$objConfig->id,$itemDocument['namefile']])}}')"
                                                                                  class="btn bg-maroon btn-xs"
                                                                                  data-detail="{{$itemDocument['idDetail']}}"
                                                                                  style="cursor:pointer">VER ARCHIVO</span>
                                                                            <button onclick="deleteDocument('{{route('process.document.deleteDetail',$itemDocument['idDetail'])}}','{{$itemDocument['idDetail']}}')"
                                                                                    class="btn bg-primary btn-xs"
                                                                                    data-detail="{{$itemDocument['idDetail']}}">
                                                                                <i class="fa fa-trash"></i></button>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <br/>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="tab-pane" id="tabAB">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered bg-white table-hover" id="tableDataConcourseConfig">
                                <thead>
                                <tr>
                                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Amplio</th>
                                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Espec&iacute;fico</th>
                                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Detallado
                                    </th>
                                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Disciplinas
                                    </th>
                                    <th style="text-align:center;vertical-align: middle" rowspan="2">Plazas Requeridas
                                    </th>
                                    <th style="text-align:center;vertical-align: middle" colspan="2">Tiempo Dedicaci&oacute;n</th>
                                    <th style="text-align:center;vertical-align: middle" rowspan="2">Seleccione &Aacute;rea</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;vertical-align: middle">TC</th>
                                    <th style="text-align:center;vertical-align: middle">MT</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_matriz">
                                @forelse($concourseMatriz as $matriz)
                                    <tr id="tr_matriz_{{$matriz->id}}"
                                        @if($objResponseMaster->merit_concourse_matriz_id==$matriz->id) style="background:#fbebeb" @endif>
                                        <td style="text-align: center">{{@$faculties[$matriz->facultad_id]}}</td>

                                        <td style="text-align: center">{{$matriz->extendsField->description}}</td>
                                        <td style="text-align: center">{{$matriz->specificField->description}}</td>
                                        <td style="text-align: center">{{$matriz->detailField->description}}</td>
                                        <td style="text-align: center">
                                            @foreach($matriz->concourseMatrizDetail as $discipline)
                                                {{$discipline->disciplineField->description  }}<br/>
                                            @endforeach

                                        </td>

                                        <td style="text-align: center">{{$matriz->max_tc}}</td>
                                        <td style="text-align: center">{{$matriz->max_tm}}</td>
                                        <td style="text-align: left">

                                            <input value="MT" data-matriz="{{$matriz->id}}"
                                                   @if($objResponseMaster->merit_concourse_matriz_id==$matriz->id && $objResponseMaster->type_postulation=='MT') checked="checked"
                                                   @endif  type="radio" id="chk_mt_{{$matriz->id}}" name="campoAplica">
                                            <label for="chk_mt_{{$matriz->id}}">MEDIO TIEMPO</label>

                                            <input value="TC" data-matriz="{{$matriz->id}}"
                                                   @if($objResponseMaster->merit_concourse_matriz_id==$matriz->id && $objResponseMaster->type_postulation=='TC') checked="checked"
                                                   @endif  type="radio" id="chk_tc_{{$matriz->id}}" name="campoAplica">
                                            <label for="chk_tc_{{$matriz->id}}">TIEMPO COMPLETO</label>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center"> NO HAY REGISTROS DISPONIBLES</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="text-right" style="padding: 10px;">
            <a href="{{route('process.user.index')}}" class="btn btn-warning warning-300"><b><i
                            class=" icon-undo2 position-left"> </i></b>MEN&Uacute; PRINCIPAL</a>
        </div>
    </div>


    @component('selection.modals.viewlinkpdf')
    @endcomponent
@endsection

@section('masterJsCustom')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('js/modules/selection/merit.js')!!}
    <script src="/plugins/iCheck/icheck.min.js"></script>
    {!!Html::script('js/modules/selection/postulation.js')!!}
@endsection

@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
    {!!Html::style('/plugins/datepicker/datepicker3.css')!!}
    {!! Html::style('/css/checkbox.css') !!}
    <style>
        td {
            vertical-align: middle !important;
        }

    </style>
@endsection