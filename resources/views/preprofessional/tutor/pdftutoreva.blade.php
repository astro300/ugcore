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
                    <img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/></td>
                </td>
                <td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;"><FONT
                            FACE="arial">
                        <b><big>UNIVERSIDAD DE GUAYAQUIL</big><br/>
                            FORMACIÓN UNIVERSITARIA<br/>
                            PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b><br/></FONT>

                </td>
            </tr>

        </table>
    </div>

    <table border="1" cellpadding="0" cellspacing="0" width="100%">

        <tr bgcolor="EDE5FA" style="height: 30px;">
            <td style="text-align: center;" style="height: 30px;"><FONT FACE="arial"><b>FICHA DE SUPERVISIÓN DE TUTOR
                        ACADÉMICO (SP-FSPP-3)</b></FONT></td>
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
            <td align="left" style="width: 30%"><FONT SIZE=0 FACE="arial">PRACTICAS PRE-PROFESIONALES</font></td>
            <td align="left" style="width: 2%"><FONT SIZE=0 FACE="arial">PPP</FONT></td>
            <td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
                {{$show}}
            </td>
            <td align="left" style="width: 80%"></td>
        </tr>

    </table>
    @foreach ($getresultevaluation as list(		$lugar,
                                                        $day,
                                                        $mes,
                                                        $anio,
                                                          $first_name,
                                                        $last_name,
                                                        $getfaculties,
                                                        $getcareers,
                                                        $name,
                                                        $departament,
                                                        $name_supervisor,
                                                        $Namestutor,
                                                        $position_supervisor,
                                                        $number_visit,
                                                        $hours_visit,
                                                        $knowledge_practitioner,
                                                        $demonstrate_interest,
                                                        $initiative,
                                                        $demostrate_capacity,
                                                        $is_skilled,
                                                        $obs_technically,
                                                        $commitment,
                                                        $is_constant,
                                                        $doing_his_job,
                                                        $acts_voluntarily,
                                                        $obs_operative,
                                                        $proactive_attitude,
                                                        $cooperate,
                                                        $respecful,
                                                        $leadership_skills,
                                                        $personal_presentation,
                                                        $obs_social,
                                                        $solves_problems,
                                                        $ability_to_evalute,
                                                        $plans_organizes,
                                                        $is_creative,
                                                        $is_persevering,
                                                        $on_time,
                                                        $obs_strategic,
                                                        $obs_general,
                                                        $recomendation))

        <table width="100%">

            <tr>
                <td align="left" style="width: 18%"><FONT size=1 FACE="arial"><b>LUGAR Y FECHA: </b></font></td>
                <td align="left" style="width: 30%"><FONT size=1 FACE="arial">{{$lugar}}</font></td>
                <td align="left" style="width: 20%">
                    <table>
                        <tr style="border-width: 1px;border: solid; border-coorl: #000000;">
                            <td><FONT SIZE=1 FACE="arial">DIA</FONT></td>
                            <td align="center"><FONT SIZE=1 FACE="arial">MES</FONT></td>
                            <td align="center"><FONT SIZE=1 FACE="arial">AÑO</FONT></td>
                        </tr>
                        <tr style="border-width: 1px;border: solid; border-coorl: #000000;">
                            <td align="center"><FONT SIZE=1 FACE="arial">{{$day}}</FONT></td>
                            <td align="center"><FONT SIZE=1 FACE="arial">{{$mes}}</FONT></td>
                            <td align="center"><FONT SIZE=1 FACE="arial">{{$anio}}</FONT></td>
                        </tr>
                    </table>
                </td>
                <td align="left" style="width: 15%"></td>
                <TD>
                    <table>
                        <tr>
                            <td align="right" style="width: 50%"><FONT size=0 FACE="arial"> N° VISITA:</FONT></td>
                            <td style="border-width: 1px;border: solid; border-color: #000000; text-align: center;">
                                <FONT size=0 FACE="arial"> {{$number_visit}}
                                </FONT></td>
                        </tr>
                        <tr>
                            <td align="right" style="width: 50%"><FONT size=0 FACE="arial"> HORA DE VISITA:</FONT></td>
                            <td style="border-width: 1px;border: solid; border-color: #000000; text-align: center;">
                                <FONT size=0 FACE="arial"> {{$hours_visit}}    </FONT>
                            </td>
                        </tr>
                    </table>
                </TD>
            </tr>

        </table>

        <table width="100%">

            <tr>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial"><b>TUTOR ACADEMICO (IES): </b></FONT></td>
                <td align="left" style="width: 70%"><FONT size=1 FACE="arial">{{$Namestutor}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial"><b>NOMBRE Y APELLIDOS DEL ESTUDIANTE: </b></FONT>
                </td>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial">{{$first_name}} {{$last_name}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 30%"><FONT size=1 FACE="arial"><b>FACULTAD: </b></FONT></td>
                <td align="left" style="width: 70%"><FONT size=1 FACE="arial">{{$getfaculties}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 30%"><FONT size=1 FACE="arial"><b>CARRERA: </b></FONT></td>
                <td align="left" style="width: 70%"><FONT size=1 FACE="arial">{{$getcareers}}</FONT></td>
            </tr>
            <tr>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial"><b>NOMBRE DE LA INSTITUCION
                            RECEPTORA: </b></FONT></td>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial">{{$name}}</font></td>
            </tr>
            <tr>
                <td align="left" style="width: 30%"><FONT size=1 FACE="arial"><b>AREA DE DESEMPEÑO: </b></FONT></td>
                <td align="left" style="width: 70%"><FONT size=1 FACE="arial">{{$departament}}</font></td>
            </tr>
            <tr>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial"><b>SUPERVISOR DE LA INSTITUCION
                            RECEPTORA: </b></FONT></td>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial">{{$name_supervisor}}</font></td>
            </tr>
            <tr>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial"><b>CARGO DE SUPERVISOR DE
                            INSTITUCION: </b></FONT></td>
                <td align="left" style="width: 50%"><FONT size=1 FACE="arial">{{$position_supervisor}}</font></td>
            </tr>

        </table>

        <br>
        <div class="row paddingBottom">
            <div class="col-md-6">

                <FONT SIZE=1 FACE="arial">Indique con una X la calificaci&oacute;n que usted considere adecuada, segun la
                    siguiente escala:

                    <p style='padding-left: 5em'>
                        5. EXCELENTE
                        <br>4. MUY SATISFACTORIO</br>
                        <br>3. SATISFACTORIO</br>
                        <br>2. POCO SATISFACTORIO</br>
                        <br>1. NADA SATISFACTORIO</p></FONT>
            </div>
        </div>

        <div class="table-responsive">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                <tr>

                    <th style="width: 60%">
                        <center><FONT SIZE=2 FACE="arial"><b>VALORACI&Oacute;N</b></FONT></center>
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
                    <th style="width: 29%">
                        <center><FONT SIZE=2 FACE="arial"><b>OBSERVACIONES</b></FONT></center>
                    </th>
                </tr>
                </thead>
                <tbody>

                <TR>
                    <td colspan="7">
                        <FONT SIZE=2 FACE="arial">
                            <center><B>ASPECTO T&Eacute;NICO</B></center>
                        </FONT>
                    </td>
                </TR>
                <tr>

                    <TD><FONT SIZE=1 FACE="arial">Los conocimientos del practicante aseguran una exitosa realización de
                            los trabajos</FONT></TD>
                    @if($knowledge_practitioner==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($knowledge_practitioner==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($knowledge_practitioner==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($knowledge_practitioner==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($knowledge_practitioner==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif

                    <td rowspan="5">
                        <FONT SIZE=1 FACE="arial">{{$obs_technically}}</FONT>

                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">Demuestra interés y entusiasmo en aprender</FONT></TD>
                    @if($demonstrate_interest==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demonstrate_interest==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demonstrate_interest==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demonstrate_interest==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demonstrate_interest==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Posee iniciativa, constantemente pregunta por nuevos trabajos</FONT>
                    </TD>
                    @if($initiative==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($initiative==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($initiative==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($initiative==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($initiative==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Demuestra capacidad en la realización de sus trabajos</FONT></TD>
                    @if($demostrate_capacity==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demostrate_capacity==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demostrate_capacity==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demostrate_capacity==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($demostrate_capacity==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Es hábil para poner en práctica ideas propias o ajenas</FONT></TD>
                    @if($is_skilled==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_skilled==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_skilled==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_skilled==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_skilled==1)
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

                    <td colspan="7">
                        <FONT SIZE=2 FACE="arial">
                            <CENTER><B>ASPECTO OPERATIVO</B></CENTER>
                        </FONT>
                    </td>
                </TR>
                <tr>
                    <TD><FONT SIZE=1 FACE="arial">Demuestra compromiso en la realización de sus trabajos</FONT></TD>
                    @if($commitment==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($commitment==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($commitment==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($commitment==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($commitment==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    <td rowspan="4">
                        <FONT SIZE=1 FACE="arial">{{$obs_operative}}</FONT>
                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">Es constante y siempre muy predispuesto a desempeñar la labor</FONT>
                    </TD>
                    @if($is_constant==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_constant==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_constant==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_constant==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_constant==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Cumple con exactitud, esmero y orden los trabajos</FONT></TD>
                    @if($doing_his_job==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($doing_his_job==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($doing_his_job==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($doing_his_job==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($doing_his_job==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Actúa voluntariamente en los trabajos de rutina</FONT></TD>
                    @if($acts_voluntarily==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($acts_voluntarily==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($acts_voluntarily==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($acts_voluntarily==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($acts_voluntarily==1)
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

                    <td colspan="7">
                        <FONT SIZE=2 FACE="arial">
                            <center><B>ASPECTO SOCIAL</B></center>
                        </FONT>
                    </td>
                </TR>
                <tr>

                    <TD><FONT SIZE=1 FACE="arial">Su actitud es proactiva y facilita la tarea en equipo</FONT></TD>
                    @if($proactive_attitude==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($proactive_attitude==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($proactive_attitude==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($proactive_attitude==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($proactive_attitude==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    <td rowspan="5">
                        <FONT SIZE=1 FACE="arial">{{$obs_social}}</FONT>
                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">Coopera de manera permanente y espontánea</FONT></TD>
                    @if($cooperate==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($cooperate==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($cooperate==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($cooperate==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($cooperate==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Es respetuoso con los jefes y compañeros de trabajo</FONT></TD>
                    @if($respecful==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($respecful==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($respecful==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($respecful==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($respecful==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Demuestra habilidades de liderazgo en los trabajos en equipo</FONT>
                    </TD>
                    @if($leadership_skills==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($leadership_skills==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($leadership_skills==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($leadership_skills==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($leadership_skills==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Demuestra ser cuidadoso en su presentación personal</FONT></TD>
                    @if($personal_presentation==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($personal_presentation==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($personal_presentation==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($personal_presentation==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($personal_presentation==1)
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

                    <td colspan="7">
                        <FONT SIZE=2 FACE="arial">
                            <center><B>ASPECTO ESTRAT&Eacute;GICO</B></center>
                        </FONT>
                    </td>
                </TR>

                <TR>

                    <TD><FONT SIZE=1 FACE="arial">Demuestra ser eficaz en el análisis y resolución de problemas</FONT>
                    </TD>
                    @if($solves_problems==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($solves_problems==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($solves_problems==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($solves_problems==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($solves_problems==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif

                    <td rowspan="5">
                        <FONT SIZE=1 FACE="arial">{{$obs_strategic}}</FONT>
                    </td>
                </TR>

                <TR>
                    <TD><FONT SIZE=1 FACE="arial">Tiene la habilidad para evaluar datos y de tomar decisiones lógicas de
                            manera imparcial y desde el punto de vista racional</FONT></TD>
                    @if($ability_to_evalute==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($ability_to_evalute==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($ability_to_evalute==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($ability_to_evalute==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($ability_to_evalute==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Planifica y organiza de manera adecuada los trabajos diarios</FONT>
                    </TD>
                    @if($plans_organizes==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($plans_organizes==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($plans_organizes==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($plans_organizes==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($plans_organizes==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Es creativo y propone soluciones y/o alternativas para mejorar
                            situaciones de trabajo</FONT></TD>
                    @if($is_creative==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_creative==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_creative==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_creative==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_creative==1)
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
                    <TD><FONT SIZE=1 FACE="arial">Es perseverante, cuando debe enfrentar situaciones difíciles de
                            trabajo, hasta que éste quede resuelto</FONT></TD>
                    @if($is_persevering==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_persevering==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_persevering==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_persevering==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($is_persevering==1)
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
                    <TD nowrap><FONT SIZE=1 FACE="arial">Es puntual en el trabajo</FONT></TD>
                    @if($on_time==5)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($on_time==4)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($on_time==3)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($on_time==2)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    @if($on_time==1)
                        <TD>
                            <center>{{$show}}</center>
                        </TD>
                    @else
                        <TD>
                            <center></center>
                        </TD>
                    @endif
                    <TD>

                    </TD>
                </TR>

                </tbody>
            </table>
            <br></br>


            <div class="row paddingBottom">
                <div class="col-md-6">

                    <div class="form-group">
                        <FONT size=1 FACE="arial"><b>OBSERVACIONES GENERALES</b></FONT><br></br>
                        @if(!empty($obs_general))
                            <p style='padding-left: 5em'><FONT size=1 FACE="arial">{{$obs_general}}</FONT>
                            </p></br></br></br></br>
                        @else
                            <hr style="color: #000000;"/>
                            <hr style="color: #000000;"/>
                        @endif
                    </div>
                </div>

            </div>
            <br></br><br></br>
            <div class="row paddingBottom">
                <div class="col-md-6">

                    <div class="form-group">
                        <FONT size=1 FACE="arial"><b>RECOMENDACIONES</b></FONT><br></br>
                        @if(!empty($recomendation))
                            <p style='padding-left: 5em'><FONT size=1 FACE="arial">{{$recomendation}}</FONT>
                            </p></br></br></br></br>
                        @else
                            <hr style="color: #000000;"/>
                            <hr style="color: #000000;"/>
                        @endif
                    </div>
                </div>

            </div>

            <br></br><br></br><br></br>
            <br></br><br></br><br></br>

            @endforeach


            <table width="100%">
                <TR>
                    <TD>
                        <HR width=85% align="left" style="color: #000000;"/>

                    </TD>
                    <td>
                        <HR width=70% align="left" style="color: #000000;"/>
                    </td>

                </TR>

                <tr>
                    <td align="left" style="width: 30%"><FONT size=1 FACE="arial"><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN
                                RECEPTORA</b></BR>
                            <BR><B>{{$name_supervisor}}</B><BR/></FONT></td>

                    <td align="RIGHT" style="width: 30%"><FONT size=1 FACE="arial"><BR><b>FIRMA TUTOR ACADEMICO DE LA
                                IES</b><BR/>
                            <B>{{$Namestutor}}</B><BR/></FONT></br>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 30%"><FONT size=1 FACE="arial"><b>
                                SELLO DE INSTITUCIÓN</b></FONT>
                    </TD>
                </tr>
            </table>


        </div>

</div>
</body>
</html>