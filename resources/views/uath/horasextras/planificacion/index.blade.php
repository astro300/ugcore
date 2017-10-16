@extends('layouts.back')
@section('masterTitle')
    Horas Extras - UATH
@endsection
@section('masterTitleModule')
    Horas Extras  - UATH
@endsection
@section('masterDescription')
    Planificación Cuatrimestral Horas Extras- UATH
@endsection
@section('mainContent')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading with-border bg-primary-custom">
                <h3 class="panel-title" style="text-align: center"><b>Ingreso de Planificación Cuatrimestral</b></h3>
            </div>
            <div class="panel-body">
                <div  class="col-lg-12">
                    <br>
                    <label class="btn btn-icon btn-rounded btn-primary" id="actumateria" data-popup="tooltip" title="" data-placement="right"
                           data-original-title="Crear Planificación" data-target="#modal_theme_crea_plani"  data-toggle="modal" >
                        <i class="icon-plus2"></i>
                    </label>
                    <br><br>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="AdmPlanificacion" class="table table-bordered bg-white">
                            <thead style="font-size: 12px;">
                            <tr>
                                <th>ÁREA</th>
                                <th>MATRIZ</th>
                                <th>PERIODO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ESTADO</th>
                                <th>FECHA MATRIZ</th>
                                <th>FECHA REGISTRO</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyAdmPlanificacion"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal para crear registro de planificación-->
            <div>
                <div id="modal_theme_crea_plani" class="modal fade in"
                     style="display: none; padding-right: 15px;">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <button type="button" class="close" data-dismiss="modal" >×</button>
                                <h4 class="modal-title text-semibold">Creación de Planificación</h4>
                            </div>
                            <div class="modal-body panel-body">

                                {!! Field::select('dependencias', $lista_dependencias, null, ['empty'=>'-Seleccione-','label'=>'Área / Unidad','required'=>'required','class'=>'select2','id'=>'dependencias']) !!}
                                {!! Field::select('periodo', $lista_periodo, null, ['label'=>'Período','empty'=>'-Seleccione-','required'=>'required','class'=>'select2','id'=>'periodo']) !!}
                                {!! Field::text('fecha', '', ['label'=>'Fecha Inicio / Final','required'=>'required','class'=>'form-control','id'=>'fecha']) !!}
                                {!! Field::textarea('descripcion', '', ['label'=>'Descripcion','style'=>'resize: none','rows'=>'3','required'=>'required','class'=>'form-control','id'=>'descripcion']) !!}
                                <div class="panel-footer">
                                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> Crear', array('type'=>'','onclick' => 'creaPlanificacion()', 'class' => 'btn btn-success success-300  btn-labeled legitRipple')) !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/daterangepicker/moment.min.js')!!}
    {!!Html::script('js/modules/uath/horas_extras.js')!!}
    {!!Html::script('plugins/daterangepicker/daterangepicker.js')!!}
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $('#fecha').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' | ',
                applyLabel: 'Aceptar',
                cancelLabel: 'Cancelar',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData().firstDayOfWeek(),
                autoApply: true,
            }
        });
    </script>
    <script>
        //console.log("%c¡Detente!", "font-family: ';Arial';, serif; font-weight: bold; color: red; font-size: 45px");
        //console.log("%cEsta función del navegador está pensada para desarrolladores. Si alguien te indicó que copiaras y pegaras algo aquí para habilitar una función de UGCORE o para PIRATEAR la cuenta de alguien, se trata de un fraude.", "font-family: ';Arial';, serif; color: black; font-size: 20px");
        //console.log("%cSi lo haces, esta persona podrá acceder a tu cuenta y datos personales.", "font-family: ';Arial';, serif; color: black; font-size: 20px");
        //console.log("%cPara obtener más información, consulta a www.nochesdecode.com.ar", "font-family: ';Arial';, serif; color: black; font-size: 20px");
    </script>
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
    {!!Html::style('plugins/daterangepicker/daterangepicker.css')!!}
@endsection