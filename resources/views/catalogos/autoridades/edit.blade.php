@extends('layouts.back')
@section('masterTitle')
    Configuraci&oacute;n de Cat&aacute;logos del Sistema
@endsection
@section('masterTitleModule')
    Cat&aacute;logos del Sistema - Autoridades
@endsection
@section('masterDescription')
    Panel de administraci&oacute;n para cat&aacute;logos del sistema
@endsection

@section('mainContent')
    <div class="col-lg-5">
        {!! Form::open(['route'=> ['admin.catalogos.autoridades.update',$autoridad->id],
        'method'=>'PUT']) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">EDICI&Oacute;N DE AUTORIDADES</h5>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    {!! Field::text('nombres',$autoridad->nombres,['label'=>'Nombres:','required'=>true]) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::text('nuic',$autoridad->nuic,['label'=>'Identificaci&oacute;n:','required'=>true]) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::text('email',$autoridad->email,['label'=>'Email:','required'=>true]) !!}

                </div>

                <div class="col-lg-12">
                    {!! Field::select('tipoAutoridad',Config::get('dataselects.tipoAutoridad'),$autoridad->tipoAutoridad,
                    ['label'=>'Tipo Autoridad:','required'=>true,"class"=>"select2",'empty'=>'SELECCIONE' ]) !!}
                </div>
                <div class="col-lg-12">
                    {!! Field::select('facultad',$facultades,$autoridad->facultad,
                               ['label'=>'Facultad:','required'=>true,"class"=>"select2",'empty'=>'SELECCIONE' ]) !!}
                    {!! Field::select('carrera',$carreras,$autoridad->carrera,
                                    ['label'=>'Carrera:','required'=>true,'empty'=>'SELECCIONE' ]) !!}

                </div>


                <div class="text-left">
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary  btn-block')) !!}

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-lg-7">
        <input id="txtTypeTable" value="{{route('admin.catalogos.autoridades.datatable')}}" type="hidden" readonly="readonly"/>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover bg-white" id="tableData">
                <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Identificaci&oacute;n</th>
                    <th>Facultad</th>
                    <th>Carrera</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>


@endsection


@section('masterJsCustom')
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

    <script>
        $(function () {
            $("#facultad").on('change', function () {
                var valueFather = $(this).val();
                var objApiRest = new AJAXRest('/select-carreraFacultad/' + valueFather, {}, 'POST');
                objApiRest.extractDataAjax(function (_resultContent, status) {
                    $("#carrera").html('');
                    if (status != 200) {
                        alertToast("La solicitud no obtuvo resultados", 3500);
                    } else {
                        $("#carrera").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                        $.each(_resultContent.data, function (key, value) {
                            $("#carrera").append("<option  value=" + value.COD_CARRERA + ">" + value.NOMBRE + "</option>");
                        });
                    }
                });
            });

            $.fn.dataTable.ext.errMode = 'throw';
            $('#tableData').DataTable({
                responsive: true, "oLanguage": {
                    "sUrl": "/js/config/datatablespanish.json"
                },
                "aoColumnDefs": [],
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "destroy": true,
                "ajax": $("#txtTypeTable").val(),
                "columns": [
                    {data: 'nombres'},
                    {data: 'nuic'},
                    {data: 'facultad'},
                    {data: 'carrera'},
                    {data: 'cargo', "bSortable": false, "searchable": false},
                    {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                        "render":function(data, type, row ){
                            return   $('<div />').html(row.actions).text();
                        }}
                ],
                "order": []
            }).ajax.reload();


        });


    </script>

@endsection
@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
@endsection
