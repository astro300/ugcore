@extends('admin.template.main')
@section('masterTitle')
    Formación Profesional - UATH
@endsection
@section('masterTitleModule')
    Formación Profesional - UATH
@endsection
@section('masterDescription')
    <div class="panel-heading">
        <h5 class="panel-title text-bold">Configuración Formación UATH</h5>
    </div>
@endsection
@section('mainContent')
    <div class="tabbable">
        <ul class="nav nav-tabs bg-slate nav-tabs-component nav-justified nav-tabs-icon">
            <li class="active">
                <a style="font-size: 12px" href="#tab00" data-toggle="tab" class="legitRipple" data-index="D">
                    <i class=" icon-profile position-left"></i>Creación de Materias</a>
            </li>
            <li><a style="font-size: 12px" href="#tab01" data-toggle="tab" class="legitRipple" data-index="P">
                    <i class=" icon-certificate position-left"></i>Creaci&oacute;n de Grupos</a>
            </li>
            <li><a style="font-size: 12px" href="#tab02" data-toggle="tab" class="legitRipple" data-index="F">
                    <i class=" icon-certificate position-left"></i>Asignación de Participantes</a>
            </li>
        </ul>
        <div class="tab-content" style="padding: 10px">
            <div class="tab-pane active" id="tab00" style="text-align: center">
                <legend class="text-bold center" style="color: #00838F;font-size: 14px">Registro de Materias</legend>
                <div>
                    <form class="form-horizontal" role="form">
                        <div class="tab-content col-lg-10 col-lg-offset-2">
                            <div class="form-group control-label">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_theme_info_materia" onclick="enceraModal()">Agregar</button>
                            </div>
                            <div class="form-group col-lg-9">
                                <table class="table table-hover" id="AdmMateriasCursos" style="font-size: 12px;">
                                    <thead style="font-size: 13px;" class="bg-primary-400">
                                    <tr>
                                        <th style="text-align: center">MATERIA</th>
                                        <th style="text-align: center">DESCRIPCIÖN</th>
                                        <th style="text-align: center">ESTADO</th>
                                        <th style="text-align: center">ACCIÓN</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="modal_theme_info_materia" class="modal fade in" style="display: none; padding-right: 15px;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h6 class="modal-title text-semibold">Registro de Materias</h6>
                                        </div>
                                        <div class="modal-body panel-body">
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Nombre</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('materia', "",  ["required"=>"required",'placeholder'=>'-Materia-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'materia']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Descripción</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::textarea('observacion', "", ['cols'=>"30",'rows'=>"2",'placeholder'=>'-Descripci&oacute;n-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'observacion']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Estado</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::select('estado', ['A'=>'ACTIVO','I'=>'INACTIVO'], null,['placeholder'=>'-Seleccione-','required' => 'required','class' => 'form-control select',"id"=>'estado']) !!}
                                                </div>
                                            </div>
                                            <div>
                                                <input id="txtid" type="hidden">
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('onclick' => 'guardaMateria()', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="tab01" style="text-align: center">
                <legend class="text-bold center" style="color: #00838F;font-size: 14px">Creaci&oacute;n de Grupos</legend>
                <div>
                    <form class="form-horizontal" role="form">
                        <div class="tab-content col-lg-10 col-lg-offset-2">
                            <div class="form-group control-label">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_theme_info_grupo" onclick="enceraModalGrupo()">Agregar</button>
                            </div>
                            <div class="form-group col-lg-9">
                                <table class="table table-hover" id="AdmGruposCursos" style="font-size: 12px;">
                                    <thead style="font-size: 13px;" class="bg-primary-400">
                                    <tr>
                                        <th style="text-align: center">GRUPO</th>
                                        <th style="text-align: center">MATERIA</th>
                                        <th style="text-align: center">INSTRUCTOR</th>
                                        <th style="text-align: center">FECHA INICIO</th>
                                        <th style="text-align: center">FECHA FIN</th>
                                        <th style="text-align: center">ESTADO</th>
                                        <th style="text-align: center">ACCIÓN</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="modal_theme_info_grupo" class="modal fade in" style="display: none; padding-right: 15px;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h6 class="modal-title text-semibold">Registro de Grupos</h6>
                                        </div>
                                        <div class="modal-body panel-body">
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Grupo</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('grupo', "",  ["required"=>"required",'placeholder'=>'-Grupo-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'grupo']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Nombre</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::select('selmateria', [], null,['placeholder'=>'-Seleccione-','required' => 'required','class' => 'form-control select',"id"=>'selmateria']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Instructor</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('instructorc', "",  ["required"=>"required",'placeholder'=>'-Cédula-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'instructorc']) !!}
                                                    {!! Form::text('instructorn', "",  ["required"=>"required",'placeholder'=>'-Nombres/Apellidos-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'instructorn']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Fecha Inicio</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('fecini', "",  ["required"=>"required","class"=>"form-control pickadate-limits",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'fecini']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Fecha Fin</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('fecfin', "",  ["required"=>"required","class"=>"form-control pickadate-limits",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'fecfin']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Estado</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::select('estadog', ['A'=>'ACTIVO','I'=>'INACTIVO'], null,['placeholder'=>'-Seleccione-','required' => 'required','class' => 'form-control select',"id"=>'estadog']) !!}
                                                </div>
                                            </div>
                                            <div>
                                                <input id="txtidc" type="hidden">
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('onclick' => 'guardaCurso()', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="tab02" style="text-align: center">
                <legend class="text-bold center" style="color: #00838F;font-size: 14px">Asignación de Participantes</legend>
                <div>
                    <form class="form-horizontal" role="form">
                        <div class="tab-content col-lg-10 col-lg-offset-2">
                            <div class="form-group border-left-xlg border-left-info">
                                <label class="col-lg-1 control-label"><b>Grupos</b></label>
                                <div class="col-lg-4">
                                    {!! Form::select('selgrupos', $listaComboGrupos, null,['placeholder'=>'-Seleccione-','required' => 'required','class' => 'form-control select',"id"=>'selgrupos']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="btn btn-icon btn-rounded btn-primary" id="agregar" data-popup="tooltip" title="" data-placement="bottom" data-original-title="Añadir participante" data-toggle="modal" data-target="#modal_theme_info_asigna" onclick="enceraModalAsigna()">
                                    <i class="icon-add"></i>
                                </label>
                            </div>
                            <p></p>
                            <div class="form-group col-lg-9">
                                <table class="table table-hover" id="AdmAsignacion" style="font-size: 12px;">
                                    <thead style="font-size: 13px;" class="bg-primary-400">
                                    <tr>
                                        <th style="text-align: center">CÉDULA</th>
                                        <th style="text-align: center">APELLIDOS</th>
                                        <th style="text-align: center">NOMBRES</th>
                                        <th style="text-align: center">ASISTENCIA</th>
                                        <th style="text-align: center">ESTADO</th>
                                        <th style="text-align: center">NOTIFICADO</th>
                                        <th style="text-align: center">ACCIÓN</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="modal_theme_info_asigna" class="modal fade in" style="display: none; padding-right: 15px;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h6 class="modal-title text-semibold">Asignación de participantes</h6>
                                        </div>
                                        <div class="modal-body panel-body">
                                            <div class="form-group">
                                                <b><label id="nomgrupo" class="control-label"></label></b>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Cédula a buscar</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('bcedula', "",  ["required"=>"required",'placeholder'=>'-Cédula-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'bcedula']) !!}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Cédula</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('cedula', '',['disabled'=>'disabled','readonly'=>'readonly','placeholder'=>'-cédula-','required' => 'required','class' => 'form-control',"id"=>'cedula']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Apellidos</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('apellidos', '',['disabled'=>'disabled','readonly'=>'readonly','placeholder'=>'-apellidos-','required' => 'required','class' => 'form-control',"id"=>'apellidos']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Nombres</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('nombres', '',['disabled'=>'disabled','readonly'=>'readonly','placeholder'=>'-nombres-','required' => 'required','class' => 'form-control',"id"=>'nombres']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group border-left-xlg border-left-info">
                                                <label class="col-lg-3 control-label"><b>Email</b></label>
                                                <div class="col-lg-9">
                                                    {!! Form::text('email', '',['disabled'=>'disabled','readonly'=>'readonly','placeholder'=>'-email-','required' => 'required','class' => 'form-control',"id"=>'email']) !!}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="modal-footer">
                                                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> AGREGAR', array('onclick' => 'guardaAsignacion()', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('extcore/js/modules/uath/configuracion.js')!!}
    {!!Html::script('extcore/js/plugins/tables/datatables/datatables.min.js')!!}
    {!!Html::script('extcore/js/plugins/ui/moment/moment.min.js')!!}
    {!!Html::script('extcore/js/plugins/pickers/datepicker_custom.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('/extcore/css/datatables.css')!!}
@endsection
