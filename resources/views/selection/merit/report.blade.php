<!DOCTYPE html>
<html>
<head>
    <title>PLANTILLA</title>

    @if($style=='VIEW')
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
        .subtitleDescription{
            color:#19244C;
            font-size: 8px;
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

        .titleITEM{
            font-size: 10px;
            font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
            font-style: normal;
            font-variant: normal;
            font-weight: bold;
        }
        .subtitleITEM{
            font-size: 9px;
            font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
            font-style: normal;
            font-variant: normal;
        }

        .backgroundPadding{
            background-color:#E0F7FA;padding:3px;
        }

        .padding{
           padding:2px;
        }

        .black{
            color:black;
              font-weight: normal;
        }

        .width{
           width:100%;
        }

    </style>
    @else
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
                font-size: 8px;
                font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
                font-weight: bold;
            }
            .subtitleDescription{
                color:#19244C;
                font-size: 7px;
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

            .titleITEM{
                font-size: 7px;
                font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
                font-style: normal;
                font-variant: normal;
                font-weight: bold;
            }
            .subtitleITEM{
                font-size: 7px;
                font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
                font-style: normal;
                font-variant: normal;
            }

            .backgroundPadding{
                background-color:#E0F7FA;padding:3px;
            }

            .padding{
                padding:2px;
            }

            .black{
                color:black;
                font-weight: normal;
            }

            .width{
                width:100%;
            }

        </style>
    @endif
</head>

<body>



<table align="center" class="table_border_white width" >
<tr>
    <td width="80%"  class="center">
          <label class="h2">UNIVERSIDAD DE GUAYAQUIL</label><br/>
           <label class="h3">Proceso de Selecci&oacute;n de Personal</label>
     </td>
      <td width="20%" class="center">
            <img src="{{ $images }}"
                style="height: 100px">
     </td> 
</tr>
</table>

<table align="center" class="table_border width" border="1" >
<tr>
      <td colspan="2" class="center subtitle">
       <label>  FORMULARIO DE REGISTRO DE RECEPCI&Oacute;N DE DOCUMENTOS PARA SELECCI&Oacute;N DE PERSONAL</label>
     </td> 
</tr>
<tr style="font-size:10px">
    <td style="padding: 0px 2px;">
        <label class="titleITEM" > NOMBRE DEL POSTULANTE:</label> 
        <label class="subtitleITEM"> {{ $objUser->description }}</label>
   </td> 
   <td style="padding: 0px 2px;">
        <label class="titleITEM"> C.I.:</label> 
        <label class="subtitleITEM"> {{  $objUser->name }}</label>
   </td>
   
</tr>

<tr style="font-size:10px">
    <td style="padding: 0px 2px;">
        <label class="titleITEM"> FECHA APERTURA:</label>
        <label class="subtitleITEM"> {{$objResponseMaster!=null?Utils::getFormatDateDB($objResponseMaster->getAttributes()['date_open'],true,false):'------' }}</label>
   </td> 
   <td style="padding: 0px 2px;">
        <label class="titleITEM"> HORA APERTURA:</label>
        <label class="subtitleITEM"> {{ $objResponseMaster!=null?Utils::getFormatDateDB($objResponseMaster->getAttributes()['date_open'],false,true):'------' }}</label>
   </td>
</tr>
    <tr style="font-size:10px">
        <td style="padding: 0px 2px;">
            <label class="titleITEM"> FECHA CIERRE:</label>
            <label class="subtitleITEM"> {{$objResponseMaster!=null?Utils::getFormatDateDB($objResponseMaster->getAttributes()['date_close'],true,false):'------' }}</label>
        </td>
        <td style="padding: 0px 2px;">
            <label class="titleITEM"> HORA CIERRE:</label>
            <label class="subtitleITEM"> {{ $objResponseMaster!=null?Utils::getFormatDateDB($objResponseMaster->getAttributes()['date_close'],false,true):'------' }}</label>
        </td>
    </tr>

</table>

 <?php $total=0; ?>
<table align="center" class="table_border width" border="1" >
    <tr>
        <td colspan="2" class="center subtitle" style="padding: 4px;background-color: #4B6A77;color:#ffffff">
            DOCUMENTOS ADJUNTOS
        </td>
    </tr>
    @foreach($objConceptsInformation['categories'][$objConfig->id] as $keyCategory=>$value)
        <tr>
            <td colspan="2" class="center subtitle" style="padding: 4px;">
               {{$value}}
            </td>
        </tr>
        @foreach($objConceptsInformation['subcategories'][$objConfig->id][$keyCategory] as $keySubCategory=>$valueSubCategory)
            <tr>
                <td colspan="2" class="subtitle" style="padding: 4px;background-color: #DCE6F1">
                    {{$valueSubCategory}}
                </td>
            </tr>
            @foreach($objConceptsInformation['documents'][$objConfig->id][$keyCategory][$keySubCategory] as $keyDocument=> $objDocument)
                <tr>
                    <td style="padding: 1px 4px;" class="subtitle black">{{ $objDocument['name'] }}

                    </td>

                    <td style="text-align: center;padding: 1px 4px;" class="subtitle">
                        @if($style=='VIEW')
                            @forelse($objDocument['details'] as $itemDocument)
                                @if($itemDocument['namefile']!=null && $itemDocument['namefile']!='')
                                        <span onclick="viewModalURL('{{route('document.concourse',[$objConfig->id,$itemDocument['namefile']])}}')"
                                              class="label bg-maroon"  style="cursor:pointer">VER ARCHIVO</span><br/>
                                    <?php $total++;?>
                                @else
                                    0
                                @endif
                            @empty
                                -
                            @endforelse
                        @else
                            {{count($objDocument['details'])}}
                            <?php $total+=count($objDocument['details']);?>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach
    @endforeach

<tr>
      <td width="84%" >
         <label class="titleITEM"> TOTAL DE DOCUMENTOS SUBIDOS A LA PLATAFORMA:</label>
          </td>
      
      <td width="16%" class="center" style="font-size:11px">{{ $total }}
     </td> 
</tr>
</table>
<table align="center" class=" width" border="0" >
    <tr><td></td></tr>
</table>
<table width="100%" align="center" class="table_border" border="1">
<tr>
      <td colspan="2" class="center subtitle backgroundPadding">
         <label > OBSERVACIONES GENERALES</label> 
      </td> 
</tr>
<tr>
      <td colspan="2" style="font-size: 7px;font-family: Arial,Helvetica Neue,Helvetica,sans-serif;padding-left:3px;padding-right:3px">
         <label > NOTA: El personal de Talento Humano tiene como responsabilidad ÚNICAMENTE de la recepción de documentos de los participantes. La evaluación y calificación de los mismos es competencia DE LOS MIEMBROS DEL COMITÉ EVALUADOR DEL PROCESO DE SELECCI&Oacute;N DE PERSONAL</label>
      </td> 
</tr>
<tr>
    <td colspan="2" height="35px"> &nbsp;</td>
</tr>

<tr>
    <td class="center padding titleITEM" height="50px" valign="bottom"><hr width="60%" />FIRMA QUIEN ENTREGA</td>
    <td class="center padding titleITEM" height="50px" valign="bottom"><hr  width="60%" />FIRMA QUIEN RECIBE</td>
</tr>
</table>

<table align="center" class=" width" border="0" >
    <tr style="font-size: 7px;font-family: Arial,Helvetica Neue,Helvetica,sans-serif;padding-left:3px;padding-right:3px">
    <td width="80%"   align="center">{!! $barcode->getBarcodeHTML($objUser->name, "EAN13",1,20) !!}</td>
    <td width="20%" class="center"><label>{{ Utils::getDateSQL(true,true)  }}</label></td>
    </tr>
</table>

</body>
</html>

