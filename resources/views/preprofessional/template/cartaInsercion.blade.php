<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CARTA DE INSERCI&Oacute;N</title>
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
                <td><p>
                        <b>Se&ntilde;or(a)</b><br/>
                            {{$nombre_representante}}<br/>
                            {{$cargo_representante}}<br/>
                            {{$nombre_empresa}}<br/><br/>
                        <b>Ciudad.-</b>
                        </p>

                </td>
            </tr>
            <tr>
                <td>
                    <br/>De mi consideraci&oacute;n.-<br/><br/>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <div align="justify"><br>
                        Es grato dirigirme a usted, con la finalidad de presentar al estudiante {{$nombre_estudiante}} con cédula de ciudadanía Nº {{$nuic}}, de la carrera de {{$nombre_carrera}}, que realizará las prácticas pre profesionales en su distinguida institución:
                        <br/><br/>
                        <div style="padding-left:15px;">
                            <b>Fecha de inicio de las Prácticas:</b> {{$fecha_inicio}}<br/>
                            <b>Fecha de fin de las Prácticas:</b> {{$fecha_fin}}<br/>
                            <b>Total de horas:</b> 240 (en el horario laboral definido por la empresa)<br/>
                            <b>Tutor Académico:</b> {{$nombre_tutor}}<br/>
                        </div>
                        <br/><br/>
                        El estudiante realizará dicho proceso académico, valiéndose de la adecuada estructura con que cuenta su institución, la misma que deberá garantizar el cumplimiento del programa, proyecto de actividades y aplicación de los conocimientos adquiridos. El Tutor Institucional, asignado por usted, deberá evaluar al practicante de acuerdo al cumplimiento, desempeño y calidad de las actividades encomendadas.
                        <br/><br/>
                        Seguro de seguir contando con su valiosa colaboración en pro al desarrollo profesional de nuestros estudiantes, me suscribo.
                        <br/><br/><br/>
                        Atentamente,
                       <div style="height: 100px"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">

                    <b>
                        <br/>………………………………………………………………<br/>
                        {{$director_carrera}}<br/>
                        {{$director_email}}<br/>
                    </b>

                </td>
            </tr>

        </table>
    </div>
</div>
</body>
</html>