@extends('layouts.back')
@section('masterTitle')
    Planificación Académica
@endsection
@section('masterTitleModule')
    Planificación Académica
@endsection
@section('masterDescription')
    Asignación de Docentes
@endsection
@section('mainContent')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            {!! Form::open(['id'=>'formasigna','route'=> 'academico.docente.ingresadoc','method'=>'POST', 'class'=>'form-horizontal']) !!}
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-custom">
                    <h5 class="box-title" style="text-align: center">Referencias Académicas</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus text-white"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Facultad</label>
                            <div class="col-lg-9">
                                {!! Form::select('facultad', ['*'=>'-Seleccione-']+$listaFacultad, null,["id"=>"facultad",'class' => 'select2','empty'=>'-Seleccione-','required' => 'required','label'=>'Facultad']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Carrera</label>
                            <div class="col-lg-7">
                                {!! Form::select('carrera',[], null,['class' => 'select2','empty'=>'-Seleccione-','required' => 'required',"id"=>'carrera']) !!}
                            </div>
                            <div class="col-lg-2 control-label text-left-important">
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#modal_theme_info" onclick="limpiaModal()">Agregar Carreras
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Período Lectivo</label>
                            <div class="col-lg-9">
                                {!! Form::select('plectivo', [], null,['class' => 'select2','empty'=>'-Seleccione-','required' => 'required',"id"=>'plectivo']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Docente</label>
                            <div class="col-lg-3">
                                {!! Form::text('sdocente', '',  ["class"=>"form-control",'placeholder'=>'-C&eacute;dula/Apellidos-','onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'sdocente','data-popup'=>'tooltip','title'=>'','data-placement'=>'bottom', 'data-original-title'=>'Buscar docente']) !!}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::select('docente', [], null,['required' => 'required','class' => 'select2','empty'=>'-Seleccione-',"id"=>'docente']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Materia</label>
                            <div class="col-lg-3">
                                {!! Form::text('smateria', null,  ['placeholder'=>'-Materia-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'smateria','data-popup'=>'tooltip','title'=>'','data-placement'=>'bottom', 'data-original-title'=>'Buscar materia']) !!}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::select('materia', [], null,['required' => 'required','class' => ' select2','empty'=>'-Seleccione-',"id"=>'materia']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Observaci&oacute;n</label>
                            <div class="col-lg-9">
                                {!! Form::textarea('observacion', null, ["style"=>"resize: none",'rows'=>"3",'placeholder'=>'-Observaci&oacute;n-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'observacion']) !!}
                            </div>
                        </div>
                        <!--Ventana de Admnistrador de Carreras-->
                        <div id="modal_theme_info" class="modal fade in" style="display: none; padding-right: 15px;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h5 class="modal-title text-bold">Administrador de Carreras</h5>
                                    </div>
                                    <div class="modal-body panel-body">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Docente</label>
                                            <div class="col-lg-4">
                                                {!! Form::text('sdocmodal', '',  ['placeholder'=>'-C&eacute;dula/Apellidos-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'sdocmodal','data-popup'=>'tooltip','title'=>'','data-placement'=>'bottom', 'data-original-title'=>'Buscar docente']) !!}
                                            </div>
                                            <div class="col-lg-6">
                                                {!! Form::select('docentemodal', [], null,['class' => ' select2','placeholder'=>'-Seleccione-',"id"=>'docentemodal']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Facultad</label>
                                            <div class="col-lg-4">
                                                {!! Form::select('facultadmod', ['*'=>'-Seleccione-']+$listaFacultad, null,['class' => 'select2','empty'=>'-Seleccione-',"id"=>'facultadmodal']) !!}
                                            </div>
                                            <div class="col-lg-5">
                                                {!! Form::select('carreramodal',[], null,['class' => 'select2','placeholder'=>'-Seleccione-',"id"=>'carreramodal']) !!}
                                            </div>
                                            <div class="col-lg-1">
                                                <label class="btn btn-icon btn-rounded btn-primary" id="agregacar"  data-popup="tooltip" title="" data-placement="bottom"  data-original-title="Añadir carrera"  onclick="agregaCareraModal()">
                                                    <i class="fa fa-check"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table id="AdmCarreras" class="table table-bordered bg-white table-hover">
                                                <thead style="font-size: 13px;">
                                                <tr>
                                                    <th class="col-lg-3">CODIGO</th>
                                                    <th class="col-lg-6">CARRERA</th>
                                                    <th class="col-lg-3" style="text-align: center">ACTIVAR</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbodyAdmCarreras"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Regresar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-right">
                            {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                        </div>
                        <div>
                            {!!Form::hidden('mattexto',null,['id'=>'mattexto'])!!}
                        </div>
                        <!--Ventana de Cambio de Materias-->
                        <div id="modal_theme_info_materia" class="modal fade in"
                             style="display: none; padding-right: 15px;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h6 class="modal-title text-semibold">Administrador de Materias</h6>
                                    </div>
                                    <div class="modal-body panel-body">
                                        <div class="table-responsive">
                                            <table id="VisorMateriaNID" class="table table-bordered bg-white table-hover">
                                                <thead style="font-size: 13px;">
                                                <tr>
                                                    <th>CARRERA</th>
                                                    <th>FECHA INGRESO</th>
                                                    <th>MATERIA</th>
                                                    <th>NIVEL</th>
                                                    <th>ESTADO</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-group col-lg-12 border-left-xlg border-left-info label-striped">
                                            <label class="col-lg-1 control-label">Materias</label>
                                            <div class="col-lg-3">
                                                {!! Form::text('smateriaModal', '',  ['placeholder'=>'-Materia-',"class"=>"form-control",'onkeyup'=>"this.value = this.value.toUpperCase()" ,'id'=>'smateriaModal','data-popup'=>'tooltip','title'=>'','data-placement'=>'bottom', 'data-original-title'=>'configuracion']) !!}
                                            </div>
                                            <div class="col-lg-6">
                                                {!! Form::select('materiaModal', [], null,['class' => ' select2','empty'=>'-Seleccione-',"id"=>'materiaModal']) !!}
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="btn btn-icon btn-rounded btn-primary" id="actumateria"
                                                       data-popup="tooltip" title="" data-placement="bottom"
                                                       data-original-title="Actualizar materia"
                                                       onclick="actualizaMateria()">
                                                    <i class="icon-database-edit2"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Regresar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        <!--Vista de las asignaciones ingresadas-->
            <br>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="AsignacionDocente" class="table table-bordered bg-white table-hover">
                    <thead class="bg-primary-600" style="font-size: 13px;">
                    <tr>
                        <th>CARRERA</th>
                        <th>FECHA INGRESO</th>
                        <th>MATERIA</th>
                        <th>NIVEL</th>
                        <th>ESTADO</th>
                        <th>OBSERVACI&Oacute;N</th>
                        <th></th>
                    </tr>
                    <tbody id="tbodyAsignacionDocentes"></tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <br>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    <script src="/plugins/iCheck/icheck.min.js"></script>
    {!!Html::script('js/modules/academico/AsignaDocente/parametros.js')!!}
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
@endsection
<style>
    .dataTables_processing {
        display: block;
        height: 120px !important;
        background: #799095 !important;
        opacity: 0.9 !important;
        top: 30%;
        z-index: 99 !important;
        padding: 30px !important;
        color: white !important;
        position: absolute;
        left: 50%;
        width: 100%;
        margin-left: -50%;
        margin-top: -25px;
        text-align: center;
        font-size: 1.2em;
    }
</style>