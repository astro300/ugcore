@extends('layouts.back')
@section('masterTitle')
    M&Oacute;DULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    INSCRIPCI&Oacute;N DE PRACTICANTES
@endsection
@section('masterDescription')
    Panel Principal de inscripci&oacute;n de practicantes
@endsection
@section('mainContent')
    <div class="col-lg-2">
        <div class="text-center div_padding">
            <img src="/images/logo_.png" width="100px">

        </div>
        <br/>
        <button id="btnInscripcion" class="btn btn-primary btn-block margin-bottom">INSCRIPCI&Oacute;N</button>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">

                    <h5 class="panel-title text-bold" style="text-align: center;">LISTADO DE PROCESOS</h5>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered bg-white table-hover">
                    <thead>
                        <th>DOCUMENTO</th>
                        <th>NOMBRES</th>
                        <th>FECHA INSCRIPCI&Oacute;N</th>
                        <th>ESTADO</th>
                        <th>FICHA INSCRIPCI&Oacute;N</th>
                    </thead>
                        <tbody>
                            @forelse($process as $item)
                                <tr>
                                    <td>{{$item->document}}</td>
                                    <td>{{$item->fullName()}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td style="{{ifArrayNull(Config::get('dataselects.estadoSolicitudColors'),$item->status_asignation)}}">
                                        {{ifArrayNull(Config::get('dataselects.estadoSolicitud'),$item->status_asignation)}}</td>

                                    <td>
                                        @php $files=($item->documentsBY('FINS')); @endphp

                                            <a class="btn btn-warning btn-xs" href="/file-ftp/PREPROFESIONALES_PRACTICAS/{{@$files[0]->name_file}}"><i class="fa fa-download"></i>&nbsp;DESCARGAR</a></td>


                                                                        </tr>
                                @empty
                                    <tr><td colspan="5">NO HAY INSCRIPCIONES REALIZADAS</td></tr>
                                @endforelse
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" style="display:none" id="inscripcionForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-teal">
                    <button type="button" id="closeInscripcionForm" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">Proceso de Inscripci&oacute;n</h5>
                </div>
                <div class="modal-body">
                    <div class="form-vertical">
                        {!! Field::select('careers',$careers,null,['empty'=>'- seleccione -'
                        ,'label'=>'Carrera: ','class'=>'select2']) !!}
                        <div id="dvElements" style="display: none">
                            {!! Field::text('emailInstitucional',null,['label'=>'Email Institucional: ']) !!}
                            {!! Field::text('emailPersonal',null,['label'=>'Email Alternativo: ']) !!}
                            {!! Field::text('phone',null,['label'=>'Tel&eacute;fono : ']) !!}
                            {!! Field::text('direccion',null,['label'=>'Direcci&oacute;n Domiciliaria : ']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="divFooterInscripcion">
                </div>
            </div>
        </div>
    </div>
@endsection


@section('masterJsCustom')
   <script>
        $(document).on('click', '#btnInscripcion', function (e) {
            $("#divFooterInscripcion").html("<button class='btn btn-primary' type='button'" +
                " id='btnInitProceso'>VALIDAR</button>");
            $("#dvElements").attr('style','display:none');
            $("#careers").removeAttr('disabled');
            $("#inscripcionForm").modal('show');
        });

        $(document).on('click', '#btnInitProceso', function (e) {
            if($("#careers option:selected").val().trim()!=''){
                swal({
                        title: "Confirmación de acciones",
                        text: "Est\u00E1s seguro que deseas inciar el proceso de practicas pre-profesionales en la carrera: "+ $("#careers option:selected").text()+"?",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        cancelButtonText: "NO",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var objApiRest = new AJAXRest('/preprofessional/validateInscripcion/'+$("#careers option:selected").val().trim(), {}, 'POST');
                            objApiRest.extractDataAjax(function (_resultContent, status) {
                                if (status == 200) {
                                    var alert = document.querySelector(".sweet-alert");
                                        okButton = alert.getElementsByTagName("button")[0];
                                        $(okButton).trigger("click");
                                        $("#careers").attr('disabled','disabled');
                                        $("#dvElements").attr('style','display');
                                        $("#divFooterInscripcion").html("<button class='btn btn-danger' type='button'" +
                                          " id='btnInscribirProceso' onclick='inscribirse()'>INSCRIBIRSE</button>");
                                } else {
                                    swal({
                                        title: "ERROR",
                                        text: _resultContent.message,
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ACEPTAR",
                                        closeOnConfirm: true
                                    });


                                }
                            });
                        }
                    });

            }else{
                alertToast("Selecione una carrera antes de confirmar proceso",2000);
            }

        });

        function inscribirse() {
            if(validateEmail($('#emailInstitucional').val()) && validateEmail($("#emailPersonal").val())
                && validateNumber($('#phone').val())&& validateNumber($('#careers').val())){
                swal({
                        title: "Confirmación de acciones",
                        text: "Est\u00E1s seguro que deseas inscribirte con los datos proporcionados para la carrera de: "+ $("#careers option:selected").text()+"?",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        cancelButtonText: "NO",
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var objApiRest = new AJAXRest('/preprofessional/saveInscripcion/'+$("#careers option:selected").val().trim(), {
                                'emailInstitucional':$('#emailInstitucional').val(),
                                'emailPersonal':$("#emailPersonal").val(),
                                'telefono':$('#phone').val(),
                                'direccion':$('#direccion').val()
                            }, 'POST');
                            objApiRest.extractDataAjax(function (_resultContent, status) {
                                if (status == 200) {
                                    var alert = document.querySelector(".sweet-alert");
                                        okButton = alert.getElementsByTagName("button")[0];
                                    $(okButton).trigger("click");
                                    location.href='/preprofessional/indexInscripcion';
                                } else {
                                    swal({
                                        title: "ERROR",
                                        text: _resultContent.message,
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ACEPTAR",
                                        animation: "slide-from-top",
                                        closeOnConfirm: true
                                    });


                                }
                            });
                        }
                    });
            }else{
                alertToast("Todos los campos son obligatorios y debebn tener un formato adecuado",2000);
            }
        }

    </script>
@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection