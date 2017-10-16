@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    ACTIVIDADES DIARIAS
@endsection
@section('masterDescription')
    Panel Principal de actividades diarias del estudiante
@endsection
@include('preprofessional.modals.activitystudent')
@include('preprofessional.modals.activityanexos')
@section('mainContent')
    <div class="col-lg-12">
        @if(!$id_student=="")

            <div class="row text-center">
                <div class="col-lg-2 col-lg-offset-5">
                    <button class="btn btn-block btn-social bg-teal-400"  type="button" onclick="addActivity(this)" data-ref="{{ route('preprofessional.student.CreateActivity',array($id_student))}}" >
                        <i class="icon-add"></i>AGREGAR ACT..
                    </button>
                </div>

            </div>
            </br>
            <div class="table-responsive">
                <table class="table table-bordered bg-white table-hover" id="tableActivity">
                    <thead>
                    <tr>
                        <th class="text-center">DIA Y FECHA</th>
                        <th class="text-center">N° DE HORAS</th>
                        <th  class="text-center">DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</th>
                        <th class="text-center">ANEXOS</th>
                        <th class="text-center">APROBACI&Oacute;N</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $total=0;
                    @endphp
                    @forelse ($objgetactivity as $objActivity)
                        @php
                            if($objActivity->approved=='1'){
                              $getquantitycount = $getquantitycount + $objActivity->number_hours;
                              $getcathedracount = $objActivity->cathedra_count;
                            }
                            $total+= $objActivity->number_hours
                        @endphp
                        <tr>
                            <td class="text-center">{{$objActivity->date_t}}</td>
                            <td class="text-center">{{$objActivity->number_hours}}</td>
                            <td>{{$objActivity->description}}</td>

                            <td class="text-center">
                                @if($objActivity->anexos>0)
                                   <span class="btn bg-light-blue btn-xs" style="cursor: pointer" data-placement="bottom" data-popup="tooltip" data-original-title="VER ANEXOS"
                                      onclick="viewAnexosActivity({{$objActivity->id}})" > anexos: {{$objActivity->anexos}}</span>
                                @endif
                            </td>



                            <td class="text-center">
                                @if($objActivity->approved==null)
                                    <small>SIN REVISI&Oacute;N</small>
                                @endif
                                    @if($objActivity->approved=='1')

                                        <span class="bg-olive btn-xs">APROBADA</span>
                                    @endif
                                    @if($objActivity->approved=='0')
                                        <span class="bg-danger btn-xs">RECHAZADA</span>
                                    @endif
                            </td>
                            <td class="text-center">
                                @if($objActivity->id_student == $id_student)
                                    @if($objActivity->approved!='1')
                                    <button data-placement="bottom" data-popup="tooltip" data-original-title="EDITAR" onClick='getActivity({{ $objActivity->id }});' class='btn btn-default btn-xs'><i class="fa fa-pencil"></i></button>
                                    <a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="btn btn-danger btn-xs"
                                       onclick="return alertConfirmDelete('la actividad','{{ route('preprofessional.student.deleteActivity',$objActivity->id)}}')"><i class="fa fa-trash"></i></a>
                                        @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <td colspan="4" class="text-center">NO HAY REGISTROS</td>
                    @endforelse
                    </tbody>
                </table>
            </div>

            </br>
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="row">
                        {!! Form::label('total_h','TOTAL DE HORAS APROBADAS',["class"=>"text-bold col-lg-6 control-label"]) !!}
                        {!! Form::text('total_h',$getquantitycount,  ["required"=>"required","class"=>"text-bold col-lg-2 control-label","style"=>"text-align: center","readonly"=>"readonly"]) !!}
                    </div>
                    <div class="row">
                        {!! Form::label('total','TOTAL DE HORAS INGRESADAS',["class"=>"text-bold col-lg-6 control-label"]) !!}
                        {!! Form::text('total',$total,  ["required"=>"required","class"=>"text-bold col-lg-2 control-label","style"=>"text-align: center","readonly"=>"readonly"]) !!}
                    </div>
                </div>
                @if($getquantitycount>=240 || ($getquantitycount>=20 && $getcathedracount==6))
                    <div class="col-lg-6">
                        <div style="text-align: center;">
                            <a href="{{ route('preprofessional.student.pdfactivity',$id_student)}}"
                               class="btn btn-primary dropdown-toggle" data-placement="bottom" data-popup="tooltip"
                               data-original-title="DESCARGAR ACTIVIDADES REALIZADAS EN FORMATO PDF">GENERAR ACTIVIDADES</a>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    @endif
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/timepicker/bootstrap-timepicker.js')!!}
    <script type="text/javascript" src="{{ asset('plugins/fileinput/fileinput.min.js') }}"></script>
    {!!Html::script('js/modules/preprofesionales/preprofessional.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    <script>
        try{
            $.fn.dataTable.ext.errMode = 'throw';
        }catch (e){}
        $('#tableActivity').dataTable({ responsive: true,"oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        }});
        $('.file-input-new').fileinput({
            showUpload: false,
            showPreview: false,
            browseLabel: "Buscar",
            removeLabel: "Quitar",
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            maxFileCount: 4,
            maxFileSize: 4000
        }).on('fileerror', function (event, data) {
            alertToast("Solo se admiten máximo 4 archivos y las extensiones deben ser jpg,jpeg,png, con un peso pro cada uno de 4mb", 2000);
        });
    </script>
@endsection
@section('masterCssCustom')

    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
@endsection