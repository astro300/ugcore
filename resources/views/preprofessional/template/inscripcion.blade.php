<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SOLICITUD DE INSCRIPCI&Oacute;N</title>
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
                        Señor (a) Master<br/>
                            {{$director_carrera}}<br/>
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
                    <br><br><br>
                   <div align="justify"><br>
                            Yo, {{$nombre_estudiante}}, con cédula de ciudadanía Nº {{$nuic}}, estudiante matriculado en el {{$nivel}} de la CARRERA DE {{$nombre_carrera}}, solicito a usted, muy comedidamente, se me asigne una Institución, fecha de inicio y fin, así como un tutor académico, para realizar las practicas pre profesionales.
                       <br/><br/>
                       El pedido es solicitado a razón, de que me encuentro habilitado para realizar dicho proceso académico, el cual me comprometo a cumplir con seriedad, discreción y honestidad, las actividades que me asignen.
                        <br/><br/>
                            Seguro de contar con una pronta respuesta, de antemano quedo agradecido.
                       <br/>
                       <br/>
                       <br/>
                       Atentamente,
                       <br/><br/><br/>
                        </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <div id="qrcode">
                        <img src="data:image/png;base64,
                        {{DNS2D::getBarcodePNG("Solicitud de Inscripción de Practicas Preprofesionales $nombre_estudiante CI: $nuic generada el ".Utils::getDateSQL(),
                         'QRCODE')}}" alt="barcode" width="120px"/>
                    </div>
                    <b>
                        <br/><br/>
                        {{$nombre_estudiante}}<br/>
                        C.I.: {{$nuic}}<br/>
                        {{$email}}<br/>
                        {{$telefono}}<br/>
                        {{$direccion}}
                    </b>

                </td>
            </tr>

            <tr>
                <td><br/><br/><br/></td>
            </tr>

            <tr>
                <td>
                    <b>FECHA IMPRESIÓN: </b>{{Utils::getDateSQL()}}<br/>
                    <b>FIRMA VALIDACI&Oacute;N: </b>{{$token}}

                </td>
            </tr>


        </table>
    </div>
</div>
</body>
</html>