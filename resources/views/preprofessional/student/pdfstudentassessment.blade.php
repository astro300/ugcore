<!DOCTYPE html>
<html lang="en-US">
<head>

</head>
<body>
<div class="panel panel-flat">
    <div class="panel-heading">
        <table width="100%" border="0">

            <tr>
                <td align="right" style="width: 20%">
                    <img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
                </td>
                <td align="right" style="text-align: center;width: 80%;height: 30px;">
                    <b>UNIVERSIDAD DE GUAYAQUIL<br/>
                        FORMACION UNIVERSITARIA<br/>
                        PASANTIAS Y/O PRACTICAS PRE-PROFESIONALES</b><br/>

                </td>
            </tr>

        </table>
    </div>

    <table border="1" cellpadding="0" cellspacing="0" width="100%">

        <tr bgcolor="EDE5FA" style="height: 30px;">
            <td style="text-align: center;" style="height: 30px;"><b>FICHA DE EVALUACION ESTUDIANTIL (FEEPP-4)</b></td>
        </tr>

    </table>
    <?php
    $show = "x";
    ?>
    <table width="100%" height="100%">
        <tr>
            <td align="left" style="width: 30%"><FONT SIZE=0 FACE="arial">PASANTIAS</font></td>
            <td align="left" style="width: 2%"><FONT SIZE=0 FACE="arial">PAS</font></td>
            <td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
            </td>
            <td align="left" style="width: 80%"></td>
        </tr>
        <tr>
            <td align="left" style="width: 30%"><FONT SIZE=0 FACE="arial">PRACTICAS PRE-PROFESIONALES</FONT></td>
            <td align="left" style="width: 2%"><FONT SIZE=0 FACE="arial">PPP</FONT></td>
            <td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
                {{$show}}
            </td>
            <td align="left" style="width: 80%"></td>
        </tr>

    </table>

    <table width="100%">
        @foreach ($getresultevaluation as list($lugarfecha,$first_name,$last_name,$getfaculties,$getcareers,$name,$departament,$name_supervisor,$Namestutor,$position_supervisor))
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>LUGAR Y FECHA: </b></FONT></td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$lugarfecha}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>NOMBRE Y APELLIDOS DEL ESTUDIANTE: </b></FONT>
                </td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$first_name}} {{$last_name}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>FACULTAD: </b></FONT></td>
                <td align="left" style="width: 70%"><FONT SIZE=1 FACE="arial">{{$getfaculties}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>CARRERA: </b></FONT></td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$getcareers}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>NOMBRE DE LA INSTITUCION
                            RECEPTORA: </b></FONT></td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$name}}</font></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>AREA DE DESEMPEÑO: </b></FONT></td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$departament}}</font></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>SUPERVISOR DE LA INSTITUCION
                            RECEPTORA: </b></FONT></td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$name_supervisor}}</font></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%"><FONT SIZE=1 FACE="arial"><b>TUTOR ACADEMICO DE LA IES: </b></FONT>
                </td>
                <td align="left" style="width: 60%"><FONT SIZE=1 FACE="arial">{{$Namestutor}}</font></td>
            </tr>
        @endforeach
    </table>
    <br>
    <div class="row paddingBottom">
        <div class="col-md-6">

            <FONT SIZE=2 FACE="arial">
                <small>Indique con una X la calificacion que usted considere adecuada, segun la siguiente escala:
                    <p style='padding-left: 5em'>
                        5. EXCELENTE</br>
                        <br>4. MUY SATISFACTORIO</br>
                        <br>3. SATISFACTORIO</br>
                        <br>2. POCO SATISFACTORIO</br>
                        <br>1. NADA SATISFACTORIO</p></small>
            </FONT>
        </div>
    </div>
    @foreach ($objgetPDFStudentEvaluationew as $objgetPDFStudentEvaluationews)

        <div class="table-responsive">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th style="width: 30%">
                        <CENTER><FONT SIZE=2 FACE="arial"><b>INDICADOR</b></FONT></CENTER>
                    </th>
                    <th style="width: 40%">
                        <center><FONT SIZE=2 FACE="arial"><b>VALORACION</b></FONT></center>
                    </th>
                    <th style="width: 2%">
                        <center><FONT SIZE=2 FACE="arial"><b>5</b></FONT></center>
                    </th>
                    <th style="width: 2%">
                        <center><FONT SIZE=2 FACE="arial"><b>4</b></FONT></center>
                    </th>
                    <th style="width: 2%">
                        <center><FONT SIZE=2 FACE="arial"><b>3</b></FONT></center>
                    </th>
                    <th style="width: 2%">
                        <center><FONT SIZE=2 FACE="arial"><b>2</b></FONT></center>
                    </th>
                    <th style="width: 2%">
                        <center><FONT SIZE=2 FACE="arial"><b>1</b></FONT></center>
                    </th>
                    <th style="width: 19%">
                        <center><FONT SIZE=2 FACE="arial"><b>OBSERVACIONES</b></FONT></center>
                    </th>
                </tr>
                </thead>
                <tbody>
                <TR>

                    <td rowspan="4">
                        <FONT SIZE=1 FACE="arial">CONOCIMIENTOS Y HABILIDADES </FONT>
                    </td>

                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Aplicacion de los conocimientos teoricos y practicos de la carrera</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->knowledge_appli==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->knowledge_appli==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->knowledge_appli==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->knowledge_appli==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->knowledge_appli==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif

                    <td rowspan="4">
                        <FONT SIZE=1 FACE="arial">{{$objgetPDFStudentEvaluationews->obs_knowledge_skills}}</FONT>
                    </td>

                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Capacidad para resolver problemas</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->resolution_problems==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->resolution_problems==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->resolution_problems==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->resolution_problems==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->resolution_problems==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Utilizacion adecuada de procedimientos metodologicos</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->use_procedures==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->use_procedures==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->use_procedures==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->use_procedures==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->use_procedures==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                </TR>
                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Integracion y trabajo en equipo</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->integration_work_team==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_work_team==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_work_team==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_work_team==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_work_team==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                </TR>


                <TR>

                    <td rowspan="2">
                        <FONT SIZE=1 FACE="arial">ASISTENCIA</FONT>
                    </td>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Puntualidad del estudiante</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->punctuality==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->punctuality==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->punctuality==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->punctuality==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->punctuality==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    <td rowspan="2">
                        <FONT SIZE=1 FACE="arial">{{$objgetPDFStudentEvaluationews->obs_assistance}}</FONT>
                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Responsabilidad, disposicion y cumplimiento en la ejecucion de las tareas</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->responsibility==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->responsibility==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->responsibility==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->responsibility==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->responsibility==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                </TR>


                <TR>

                    <td rowspan="3">
                        <FONT SIZE=1 FACE="arial">APOYO A ACTIVIDADES</FONT>
                    </td>

                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Integracion al equipo de trabajo</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->integration_team_work==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_team_work==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_team_work==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_team_work==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->integration_team_work==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif

                    <td rowspan="3">
                        <FONT SIZE=1 FACE="arial">{{$objgetPDFStudentEvaluationews->obs_support_activities}}</FONT>
                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Guia de la institucion para el desarrollo de actividades</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->guide_development==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->guide_development==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->guide_development==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->guide_development==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->guide_development==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Asesoria del tutor academico</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->tutor_advice==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->tutor_advice==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->tutor_advice==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->tutor_advice==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->tutor_advice==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                </TR>


                <TR>

                    <td rowspan="2">
                        <FONT SIZE=1 FACE="arial">DISPONIBILIDAD DE ESPACIO Y RECURSOS</FONT>
                    </td>

                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Facilidad de espacio fisico</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->ease_physical_space==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_physical_space==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_physical_space==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_physical_space==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_physical_space==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif

                    <td rowspan="2">
                        <FONT SIZE=1 FACE="arial">{{$objgetPDFStudentEvaluationews->obs_availability}}</FONT>
                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">
                            <small>Facilidad en la utilizacion y movilidad de recursos</small>
                        </FONT></TD>
                    @if($objgetPDFStudentEvaluationews->ease_means==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_means==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_means==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_means==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($objgetPDFStudentEvaluationews->ease_means==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif

                </TR>

                </tbody>
            </table>

        </div>

        <div class="row paddingBottom">
            <div class="col-md-6">

                <div class="form-group">
                    <FONT size="2" FACE="arial">
                        <small>Indique sus sugerencias a la Universidad para que ésta pueda mejorar sus procesos
                            académicos para un mejor desenvolvimiento en el mundo laboral de sus estudiantes:
                        </small>
                    </FONT>
                    <br><br>
                    <FONT SIZE=2 FACE="arial">{{$objgetPDFStudentEvaluationews->suggestions}}</FONT>

                </div>
                <br><br>
                <br>
            </div>

        </div>
    @endforeach


    <table border="0" width="100%">

        <tr>
            <td align="center" style="width: 50%"><b>FIRMA DEL ESTUDIANTE</b><br/>
                {{$first_name}} {{$last_name}}<br/>
                C.C.: {{$documentstudent}}<br/></b>
            </td>
            <td align="center" style="width: 50%"><b>FIRMA DEL SUPERVISOR</b><br/>
                {{$name_supervisor}}<br/>
                 {{$position_supervisor}}<br/></b>
            </td>
        </tr>
        <tr>
            <td style="text-align: left">
                <br/>
                <small>
                    <small><i>Nota: todos los campos deben estar llenos</i></small>
                </small>
            </td>
        </tr>
    </table>
</div>
</div>
</body>
</html>
