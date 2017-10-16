@extends('admin.template.main')
@section('masterTitle')
    Formación Profesional - UATH
@endsection
@section('masterTitleModule')
    Formación Profesional - UATH
@endsection
@section('masterDescription')
    <div class="panel-heading">
        <h5 class="panel-title text-bold">Ingreso de Asistencia</h5>
    </div>
@endsection
@section('mainContent')
    <form class="form-horizontal" role="form">
        <div class="tab-content col-lg-10 col-lg-offset-2">
            <div class="form-group border-left-xlg border-left-info">
                <label class="col-lg-1 control-label"><b>Grupos</b></label>
                <div class="col-lg-4">
                    {!! Form::select('selgruposasis', $listaComboGruposAsis, null,['placeholder'=>'-Seleccione-','required' => 'required','class' => 'form-control select',"id"=>'selgruposasis']) !!}
                </div>
            </div>
            <div class="form-group col-lg-9">
                <table class="table table-hover" id="AdmAsignacionAsis" style="font-size: 12px;">
                    <thead style="font-size: 13px;" class="bg-primary-400">
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">CÉDULA</th>
                        <th style="text-align: center">APELLIDOS</th>
                        <th style="text-align: center">NOMBRES</th>
                        <th style="text-align: center">ASISTENCIA</th>
                        <th style="text-align: center">ESTADO</th>
                        <th style="text-align: center">OPCIONES</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </form>
@endsection
@section('masterJsCustom')
    {!!Html::script('extcore/js/plugins/tables/datatables/datatables.min.js')!!}
    {!!Html::script('extcore/js/modules/uath/confRegistro.js')!!}
@endsection
@section('masterCssCustom')
    {!!Html::style('/extcore/css/datatables.css')!!}
@endsection