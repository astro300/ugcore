@extends('layouts.back')
@section('masterTitle')
    PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    FORMATOS Y FICHAS DEL PROCESO - ESTUDIANTES
@endsection
@section('masterDescription')
    Descargas formatos del proceso de las PPP
@endsection
@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <div class="panel-heading">FORMATOS PARA EL PROCESO DE LAS PRACTICAS PRE-PROFESIONALES</div>
            </div>
            <div class="panel-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#myFiles" data-toggle="tab" aria-expanded="true">Mis Archivos</a></li>
                        <li class=""><a href="#informacion" data-toggle="tab" aria-expanded="false">Informaci&oacute;n</a></li>
                        <li class=""><a href="#download" data-toggle="tab" aria-expanded="false">Formatos</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="informacion">
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <!-- The timeline -->
                                    <ul class="timeline timeline-inverse">
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-info bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><span class="text-bold text-primary-800">PROCESO PARA LAS CATEDRAS INTEGRADORAS</span> </h3>
                                                <div class="timeline-body">
                                                    <b>PROCESO INICIAL</b><br><br>

                                                    1. Descargar Solicitud de Catedra Integradora<br>
                                                    2. Llenar los datos corespondientes en la solicitud<br>
                                                    3. Entregar solicitud al personal administrativo<br>

                                                    <div class="text-justify"><br><b>Nota:</b> Cada vez que se realiza la Catedra Integradora se debe realizar los pasos ya mencionados; una vez que se realizan todas las catedras se debe seguir con el proceso de las practicas institucionales para completar las 240 horas. <b>(Este proceso lo debe realizar los estudiantes que ingresan con la NUEVA MALLA CURRICULAR)</b><br></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-info bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><span class="text-bold text-primary-800">PROCESO PARA LAS PRACTICAS INSTITUCIONALES</span> </h3>
                                                <div class="timeline-body">
                                                    <b>PROCESO INICIAL</b><br><br>

                                                    1. Descargar Solicitud, Acta de Compromiso y Carta de Compromiso de las Practicas Institucionales<br>
                                                    2. Llenar los datos corespondientes en cada documento<br>
                                                    3. Entregar los documentos al personal administrativo<br>
                                                    4. Esperar el E-mail de la asignacion de Tutor Academico<br>

                                                    <br><b>PROCESO FINAL</b><br><br>

                                                    1. Descargar la Ficha de Datos Generales, Ficha de Evaluacion y Rendimiento Institucion, Certificado del Tutor Academico y Certificado de la Institucion<br>
                                                    2. Llenar los datos corespondientes en cada documento<br>
                                                    3. Entregar los documentos al personal administrativo<br>
                                                    4. Esperar el E-mail del Certificado de Culminacion de las Practicas<br>

                                                    <div class="text-justify"><br><b>Nota:</b> Este proceso lo deben realizar los estudiantes de la MALLA CURRICULAR ANTERIOR y la NUEVA; todos los documentos se deben entregar firmados y sellados con pluma de color azul.<br></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <li>
                                            <i class="fa fa-point bg-gray"></i>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        </div>
                        <div class="tab-pane" id="download">
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <!-- The timeline -->
                                    <ul class="timeline timeline-inverse">
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-download bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><span class="text-bold text-primary-800">Proceso Inicial</span> </h3>
                                                <div class="timeline-body">
                                                    <table class="table table-responsive table-bordered table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <td><span class="label label-success">CATEDRAS INTEGRADORAS</span></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>1. Solicitud para el proceso de las Catedras Integradoras</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','1')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="label label-success">PRACTICAS INSTITUCIONALES</span></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>1. Solicitud para el proceso de las Practicas Institucionales</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','2')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2. Acta de Compromiso de las Practicas Institucionales</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','3')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3. Carta de Compromiso de las Practicas Institucionales</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','4')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-download bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><span class="text-bold text-primary-800">Proceso Final </span> </h3>
                                                <div class="timeline-body">
                                                    <table class="table table-responsive table-bordered table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <td>1. Ficha de Datos Generales</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','5')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2. Ficha de Evaluacion y Rendimiento Institucion</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','6')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3. Certificado del Tutor Academico</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','7')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4. Certificado de la Institucion</td>
                                                            <td><a href="{{ route('preprofessional.student.downloaddocuments','8')}}" class="btn btn-info btn-rounded btn-xs"><b><i class="icon-file-download"></i></b>DESCARGAR</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <li>
                                            <i class="fa fa-point bg-gray"></i>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        </div>
                        <div class="tab-pane active" id="myFiles">

                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <!-- The timeline -->
                                    @if($career!=null)
                                    <ul class="timeline timeline-inverse">
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-download bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><span class="text-bold text-primary-800">MIS ARCHIVOS GENERADOS PRACTICAS PREPROFESIONALES</span> </h3>
                                                <div class="timeline-body">
                                                    <table class="table table-responsive table-bordered table-hover">
                                                        <tbody>
                                                        @if($process!=null)
                                                        <tr>
                                                            <td colspan="2"><b>1. Solicitud de Inscripci&oacute;n</b></td>
                                                        </tr>

                                                            <tr>
                                                                <td>Creada el: {{$process->created_at}} se encuentra en estado:<b> @if($process->status_asignation=='P')PENDIENTE DE ASIGNACI&Oacute;N @endif
                                                                    @if($process->status_asignation=='A')ASIGNADO @endif
                                                                    @if($process->status_asignation=='C')CULMINADO @endif</b></td>
                                                                <td>
                                                                    @php $files=($process->documentsBY('FINS')); @endphp
                                                                    @if(@$files[0]->name_file!=null)
                                                                    <a class="btn btn-warning btn-xs" href="/file-ftp/PREPROFESIONALES_PRACTICAS/{{$files[0]->name_file}}">
                                                                        <i class="fa fa-download"></i>&nbsp;DESCARGAR</a></td>
                                                                    @else
                                                                        NO HAY ARCHIVOS
                                                                    @endif
                                                            </tr>
                                                        <tr>
                                                            <td colspan="2"><b>2. Carta de Aceptaci&oacute;n</b></td>
                                                        </tr>

                                                            <tr>
                                                                <td>Creada el: {{$process->created_at}}</td>
                                                                <td>
                                                                    @php $files=($process->documentsBY('CAIP')); @endphp
                                                                    @if(@$files[0]->name_file!=null)
                                                                        <a class="btn btn-warning btn-xs" href="/file-ftp/PREPROFESIONALES_PRACTICAS/{{$files[0]->name_file}}">
                                                                            <i class="fa fa-download"></i>&nbsp;DESCARGAR</a></td>
                                                                @else
                                                                    NO HAY ARCHIVOS
                                                                @endif
                                                            </tr>

                                                        <tr>
                                                            <td colspan="2"><b>3. Carta de Inserci&oacute;n sin Firmar</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>Creada el: {{$process->created_at}}</td>
                                                            <td>
                                                                @php $files=($process->documentsBY('CIPP')); @endphp
                                                                @if(@$files[0]->name_file!=null)
                                                                    <a class="btn btn-warning btn-xs" href="/file-ftp/PREPROFESIONALES_PRACTICAS/{{$files[0]->name_file}}">
                                                                        <i class="fa fa-download"></i>&nbsp;DESCARGAR</a></td>
                                                            @else
                                                                NO HAY ARCHIVOS
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="text-align: left"><b>4. Carta de Inserci&oacute;n Firmada</b></td>
                                                        </tr>

                                                        <tr>
                                                            <td>Creada el: {{$process->created_at}}</td>
                                                            <td>
                                                                @php $files=($process->documentsBY('CIPPF')); @endphp
                                                                @if(@$files[0]->name_file!=null)
                                                                    <a class="btn btn-warning btn-xs" href="/file-ftp/PREPROFESIONALES_PRACTICAS/{{$files[0]->name_file}}">
                                                                        <i class="fa fa-download"></i>&nbsp;DESCARGAR</a></td>
                                                            @else
                                                                NO HAY ARCHIVOS
                                                            @endif
                                                        </tr>


                                                        @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <i class="fa fa-point bg-gray"></i>
                                        </li>
                                    </ul>

                                       @else
                                        {!! Form::open(['route'=> ['preprofessional.student.indexDocument'],'method'=>'GET']) !!}

                                        {!! Field::select('careers',$careers,null,['empty'=>'- seleccione -'
                      ,'label'=>'Carrera: ','class'=>'select2']) !!}
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                                        {!! Form::close() !!}

                                    @endif
                                </div>
                                <!-- /.tab-pane -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection