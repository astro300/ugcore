<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CARTA DE ACEPTACI&Oacute;N DE INSCRIPCI&Oacute;N</title>
    <style type="text/css">
        .col-md-12 {
            width: 100%;
        }

        @page {
            margin: 35px 30px 50px 40px;
        }

        .box-header.with-border hr {
            border-bottom: 5px solid darkblue;
        }

        .box-header .box-title {
            display: inline-block;
            font-size: 18px;
            line-height: 1;
        }

        .box-body {
            padding: 7px;
            font-size: 9px;
            font-family: Arial, sans-serif;
        }

        .table-bordered {
            border: 1px solid black;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 18px;
            border-collapse: collapse;
        }

        .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .table > thead > tr > th {
            border: 1px solid black;
            border-collapse: collapse;
            background-color: #3399FF;
            color: white;
            height: 35px;
        }

        .blanco {
            font-size: 15px;
            line-height: 1;
            padding: 5px;
            font-family: Arial, sans-serif;
        }

        hr{
            border: 1px solid #3399FF;
        }
    </style>
</head>
<body>
<div class="col-md-12">
    <div class="box-body">
        <table class="table">
            <tr>
                <td class="blanco"  style="border: 1px solid white;">
                    <div align="center">
                        <img src="{{public_path('/images/logo_.png')}}" width="90px">
                        <hr>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="blanco" style="border: 1px solid white; background: lightgrey;">
                    <div align="center" style="height: 20px"><b>VICERRECTORADO DE FORMACI&Oacute;N ACED&Eacute;MICA Y PROFESIONAL</b></div>
                    <div align="center" style="height: 20px"><b>DIRECCI&Oacute;N DE FORMACI&Oacute;N ACED&Eacute;MICA</b></div>
                </td>
            </tr>
            <tr>
                <td><hr></td>
            </tr>
            <tr>
                <td style="text-align: right">
                    <br/><br/>
                    Guayaquil, {{$mes}} / {{$dia}} de {{$anio}}
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    <br/><br/>
                </td>
            </tr>
            <tr>
                <td><b><p>
                            Estudiante<br/>
                            {{$nombre_estudiante}}<br/>
                            Director (a)<br/>
                            CARRERA DE {{$nombre_carrera}}<br/>
                            FACULTAD DE {{$nombre_facultad}}<br/>
                            UNIVERSIDAD DE GUAYAQUIL <br/><br/>
                            Ciudad.-
                        </p>
                    </b>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <div align="justify"><br>
                        Una vez analizado su pedido para realizar las prácticas pre profesionales, debo manifestar que lo solicitado es favorable pues cumple con los requisitos para la ejecución de las mismas, motivo por el cual asigno:
                        <br/><br/>
                        <div style="padding-left:15px;">
                            <b>Institución receptora:</b> {{$nombre_empresa}}<br/>
                            <b>Fecha de inicio de las Prácticas:</b> {{$fecha_inicio}}<br/>
                            <b>Fecha de fin de las Prácticas:</b> {{$fecha_fin}}<br/>
                            <b>Total de horas:</b> 240 (en el horario laboral definido por la empresa)<br/>
                            <b>Tutor Académico:</b> {{$nombre_tutor}}<br/>
                        </div>
                        <br/><br/>
                        El Tutor será el encargado de garantizar el cumplimiento de los instructivos, el uso de formatos, instrumentos de desarrollo y evaluación establecidos, por lo que deberá concretar una reunión, previo al inicio de las prácticas pre profesionales.
                        <br/><br/>
                        Sin otro particular me despido, sin antes desearle el mayor de los éxitos en su proceso académico, el mismo que contribuirá al desarrollo de destrezas y habilidades específicas, de su profesión.
                        <br/><br/><br/>
                        Atentamente,
                        <br/><br/><br/>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <div id="qrcode">
                        <img src="data:image/png;base64,
                        {{DNS2D::getBarcodePNG("Carta de Aceptación de Inscripción Practicas Preprofesionales $nombre_estudiante CI: $nuic generada el ".Utils::getDateSQL(),
                         'QRCODE')}}" alt="barcode" width="120px"/>
                    </div>
                    <b>
                        <br/><br/>
                        {{$director_carrera}}<br/>
                        DIRECTOR (A)<br/>
                        {{$nombre_carrera}}<br/>
                    </b>

                </td>
            </tr>
            <tr>
                <td><br/><br/><br/></td>
            </tr>
            <tr>
                <td>
                    <b>COPIA.-</b> {{ strtoupper($nombre_coordinador) }}, Coordinador de Prácticas Pre-profesionales; {{strtoupper($nombre_tutor)}}, Tutor.<br/>
                    <b>FECHA IMPRESIÓN: </b>{{Utils::getDateSQL()}}<br/>
                   <b>FIRMA VALIDACI&Oacute;N: </b>{{$token}}

                </td>
            </tr>


        </table>
    </div>
</div>
</body>
</html>