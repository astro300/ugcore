<!DOCTYPE html>
<html>
<head>
    <title>PLANTILLA</title>

        <style type="text/css">
            @page { margin: 0.6cm 0.6cm }
            .table_border{
                border-bottom:1pt solid black;border-top:1pt solid black;border-right:1pt solid black;border-left:1pt solid black !important;
                border-collapse: collapse;
            }

            .table_border_white{
                border-bottom:1pt solid white;border-top:1pt solid white;border-right:1pt solid white;border-left:1pt solid white !important;
                border-collapse: collapse;
            }

            .subtitle{
                color:#19244C;
                font-size: 10px;
                font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
                font-weight: bold;
            }


            .h2{
                font-size: 13px;
                font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
                font-style: normal;

                font-weight: bold;

                color:#10243E;
            }
            .h3{
                font-size: 12px;
                font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
                font-style: normal;

                font-weight: bold;

                color:#984807;
            }

            .center{
                text-align:center;
            }



            .backgroundPadding{
                background-color:#E0F7FA;padding:3px;
            }



            .width{
                width:100%;
            }

        </style>

</head>

<body>



<table align="center" class="table_border_white width" >
    <tr>

        <td width="80%"  class="center">
            <label class="h2">UNIVERSIDAD DE GUAYAQUIL</label><br/>
            <label class="h3">Proceso de Selecci&oacute;n de Personal</label>
        </td>
        <td width="20%" class="center">
            <img src="{{  $images }}"
                 style="height: 35px">
        </td>
    </tr>
</table>

<table align="center" class="table_border width" border="1" >
    <tr>
        <td colspan="2" class="center subtitle">
            <label>  {{ strtoupper($objConfig->title) }}</label>
        </td>
    </tr>
</table>

<?php $total=0; ?>

<table align="center" class=" width" border="0" >
    <tr><td></td></tr>
</table>
<table width="100%" align="center" class="table_border" border="1">
    <tr>
        <td colspan="{{$validation==true?'6':'5'}}" class="center subtitle backgroundPadding">
            <label > {{$title}}</label>
        </td>

    </tr>
    <tr>
        <td class="center subtitle backgroundPadding" width="5%">
            NRO.
        </td>
        <td class="center subtitle backgroundPadding" width="10%">
          IDENTIFICACI&Oacute;N
        </td>
        <td class="center subtitle backgroundPadding" width="40%">
           NOMBRES
        </td>
        <td class="center subtitle backgroundPadding" width="25%">
           EMAIL
        </td>
      @if(!$validation)
        <td class="center subtitle backgroundPadding" width="20%">
            FECHA POSTULACI&Oacute;N
        </td>
          @else
            <td class="center subtitle backgroundPadding" width="20%">
                FECHA VALIDACI&Oacute;N
            </td>
            <td class="center subtitle backgroundPadding" width="20%">
                % VALIDACI&Oacute;N
            </td>
        @endif
    </tr>
    @foreach($postulants as $key => $postulant)
        <tr>
            <td class="center subtitle ">
                {{++$key}}
            </td>
            <td class="center subtitle ">
                {{$postulant->nuic}}
            </td>
            <td class=" subtitle " style="padding-left: 5px">
                {{$postulant->names}}
            </td>
            <td class=" subtitle " style="padding-left: 5px">
                {{$postulant->email}}
            </td>
            @if(!$validation)
            <td class=" subtitle " style="padding-left: 5px">
                {{Utils::getFormatDateDB($postulant->date_close,false,false)}}
            </td>
                @else
                <td class=" subtitle " style="padding-left: 5px">
                    {{Utils::getFormatDateDB($postulant->date_validation,false,false)}}
                </td>
                <td class=" subtitle " style="padding-left: 5px;text-align: center">
                    {{$postulant->percentage_validation!=null?$postulant->percentage_validation:'0'}}%
                </td>
            @endif
        </tr>
    @endforeach
</table>

<table align="center" class=" width" border="0" >
    <tr style="font-size: 7px;font-family: Arial,Helvetica Neue,Helvetica,sans-serif;padding-left:3px;padding-right:3px">
        <td width="80%"   align="center">{!! $barcode->getBarcodeHTML($objUser->name.$objConfig->id, "EAN13",1,20) !!}</td>
        <td width="20%" class="center"><label>{{ Utils::getDateSQL(true,true)  }}</label></td>
    </tr>
</table>

</body>
</html>

