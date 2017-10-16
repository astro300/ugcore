<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reporte Nómina por Grupos</title>
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
        </style>
    </head>
    <body>
        <div class="col-md-12">
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="blanco" colspan="5" style="border: 1px solid white;">
                            <div align="center">
                                <img src='{{env('URL_PATH_LOCAL_IMAGE')."/logo_ug.png"}}' height="120px"/>
                                <hr>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="blanco" colspan="5" style="border: 1px solid white; background: lightgrey;">
                            <div align="center" style="height: 20px"><b>Reportes de Formación Profesional - UATH</b></div>
                            <div align="center" style="height: 20px"><b><u>REPORTE NÓMINA POR GRUPOS</u></b></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="blanco" colspan="5" style="border: 1px solid white;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-left: 1px solid white;"></td>
                    </tr>
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th style="width: 24%;">CÉDULA</th>
                        <th style="width: 24%;">APELLIDOS</th>
                        <th style="width: 25%;">NOMBRES</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/ $keyCode=1 /*--}}
                    @foreach ($nomina_grupos as $data)
                        <tr>
                            <td style="width: 3%;">{{ $keyCode++}}</td>
                            <td style="width: 24%;">{{ $data->CEDULA}}</td>
                            <td style="width: 24%;">{{ $data->APELLIDOS}}</td>
                            <td style="width: 24%;">{{ $data->NOMBRES}}</td>
                            <th style="width: 25%;"></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>