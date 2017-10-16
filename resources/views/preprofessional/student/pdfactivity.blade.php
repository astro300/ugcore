
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<STYLE>
		H1.SaltoDePagina
		{
			PAGE-BREAK-AFTER: always
		}
		tr>td{
			font-size:13px
		}
		tr>th{
			font-size:14px
		}

		div.form-group{
			font-size:13px
		}
		div.form-group>b{
			font-size:14px
		}
	</STYLE>
</head>
<body>

@if($i>1)
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
						<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%;"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 1</td>
			</tr>
		</table>
		<br>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(0<$i)
						<td>
							<CENTER><SMALL>{{$getresultactivity[0][0]}}</SMALL></CENTER>
						</td>

						<TD>
							<CENTER><small>{{$getresultactivity[0][1]}}</small></CENTER>
						</TD>

						<TD>
							<small>{{$getresultactivity[0][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[0][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(1<$i)
						<td>
							<center><SMALL>{{$getresultactivity[1][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[1][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[1][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[1][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(2<$i)
						<td>
							<center><SMALL>{{$getresultactivity[2][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[2][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[2][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[2][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(3<$i)
						<td>
							<center><SMALL>{{$getresultactivity[3][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[3][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[3][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[3][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(4<$i)
						<td>
							<center><SMALL>{{$getresultactivity[4][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[4][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[4][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[4][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(0<$i)
						{{$getresultactivity[0][7]}}<br>
					@endif
					@if(1<$i)
						{{$getresultactivity[1][7]}}<br>
					@endif
					@if(2<$i)
						{{$getresultactivity[2][7]}}<br>
					@endif
					@if(3<$i)
						{{$getresultactivity[3][7]}}<br>
					@endif
					@if(4<$i)
						{{$getresultactivity[4][7]}}<br>
					@endif
					<br>
				</div>


			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><br><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 2-->
@if($i>5)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
						<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 2</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(5<$i)
						<td>
							<center><SMALL>{{$getresultactivity[5][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[5][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[5][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[5][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(6<$i)
						<td>
							<center><SMALL>{{$getresultactivity[6][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[6][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[6][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[6][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(7<$i)
						<td>
							<center><SMALL>{{$getresultactivity[7][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[7][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[7][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[7][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(8<$i)
						<td>
							<center><SMALL>{{$getresultactivity[8][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[8][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[8][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[8][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(9<$i)
						<td>
							<center><SMALL>{{$getresultactivity[9][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[9][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[9][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[9][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(5<$i)
						{{$getresultactivity[5][7]}}<br>
					@endif
					@if(6<$i)
						{{$getresultactivity[6][7]}}<br>
					@endif
					@if(7<$i)
						{{$getresultactivity[7][7]}}<br>
					@endif
					@if(8<$i)
						{{$getresultactivity[8][7]}}<br>
					@endif
					@if(9<$i)
						{{$getresultactivity[9][7]}}<br>
					@endif
					<br>
				</div>



			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 3-->
@if($i>10)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 3</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(10<$i)
						<td>
							<center><SMALL>{{$getresultactivity[10][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[10][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[10][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[10][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(11<$i)
						<td>
							<center><SMALL>{{$getresultactivity[11][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[11][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[11][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[11][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(12<$i)
						<td>
							<center><SMALL>{{$getresultactivity[12][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[12][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[12][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[12][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(13<$i)
						<td>
							<center><SMALL>{{$getresultactivity[13][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[13][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[13][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[13][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(14<$i)
						<td>
							<center><SMALL>{{$getresultactivity[14][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[14][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[14][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[14][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(10<$i)
						{{$getresultactivity[10][7]}}<br>
					@endif
					@if(11<$i)
						{{$getresultactivity[11][7]}}<br>
					@endif
					@if(12<$i)
						{{$getresultactivity[12][7]}}<br>
					@endif
					@if(13<$i)
						{{$getresultactivity[13][7]}}<br>
					@endif
					@if(14<$i)
						{{$getresultactivity[14][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 4-->
@if($i>15)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 4</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(15<$i)
						<td>
							<center><SMALL>{{$getresultactivity[15][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[15][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[15][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[15][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(16<$i)
						<td>
							<center><SMALL>{{$getresultactivity[16][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[16][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[16][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[16][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(17<$i)
						<td>
							<center><SMALL>{{$getresultactivity[17][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[17][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[17][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[17][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(18<$i)
						<td>
							<center><SMALL>{{$getresultactivity[18][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[18][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[18][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[18][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(19<$i)
						<td>
							<center><SMALL>{{$getresultactivity[19][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[19][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[19][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[19][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(15<$i)
						{{$getresultactivity[15][7]}}<br>
					@endif
					@if(16<$i)
						{{$getresultactivity[16][7]}}<br>
					@endif
					@if(17<$i)
						{{$getresultactivity[17][7]}}<br>
					@endif
					@if(18<$i)
						{{$getresultactivity[18][7]}}<br>
					@endif
					@if(19<$i)
						{{$getresultactivity[19][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 5-->
@if($i>20)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
						<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 5</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(19<$i)
						<td>
							<center><SMALL>{{$getresultactivity[20][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[20][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[20][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[20][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(21<$i)
						<td>
							<center><SMALL>{{$getresultactivity[21][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[21][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[21][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[21][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(22<$i)
						<td>
							<center><SMALL>{{$getresultactivity[22][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[22][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[22][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[22][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(23<$i)
						<td>
							<center><SMALL>{{$getresultactivity[23][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[23][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[23][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[23][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(24<$i)
						<td>
							<center><SMALL>{{$getresultactivity[24][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[24][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[24][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[24][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(20<$i)
						{{$getresultactivity[20][7]}}<br>
					@endif
					@if(21<$i)
						{{$getresultactivity[21][7]}}<br>
					@endif
					@if(22<$i)
						{{$getresultactivity[22][7]}}<br>
					@endif
					@if(23<$i)
						{{$getresultactivity[23][7]}}<br>
					@endif
					@if(24<$i)
						{{$getresultactivity[24][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 6-->
@if($i>25)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 6</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(25<$i)
						<td>
							<center></center><SMALL>{{$getresultactivity[25][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[25][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[25][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[25][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(26<$i)
						<td>
							<center><SMALL>{{$getresultactivity[26][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[26][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[26][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[26][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(27<$i)
						<td>
							<center><SMALL>{{$getresultactivity[27][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[27][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[27][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[27][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(28<$i)
						<td>
							<center><SMALL>{{$getresultactivity[28][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[28][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[28][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[28][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(29<$i)
						<td>
							<center><SMALL>{{$getresultactivity[29][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[29][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[29][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[29][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(25<$i)
						{{$getresultactivity[25][7]}}<br>
					@endif
					@if(26<$i)
						{{$getresultactivity[26][7]}}<br>
					@endif
					@if(27<$i)
						{{$getresultactivity[27][7]}}<br>
					@endif
					@if(28<$i)
						{{$getresultactivity[28][7]}}<br>
					@endif
					@if(29<$i)
						{{$getresultactivity[29][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 7-->
@if($i>30)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 7</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(30<$i)
						<td>
							<center><SMALL>{{$getresultactivity[30][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[30][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[30][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[30][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(31<$i)
						<td>
							<center><SMALL>{{$getresultactivity[31][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[31][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[31][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[31][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(32<$i)
						<td>
							<center><SMALL>{{$getresultactivity[32][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[32][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[32][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[32][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(33<$i)
						<td>
							<center><SMALL>{{$getresultactivity[33][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[33][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[33][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[33][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(34<$i)
						<td>
							<center><SMALL>{{$getresultactivity[34][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[34][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[34][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[34][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(30<$i)
						{{$getresultactivity[30][7]}}<br>
					@endif
					@if(31<$i)
						{{$getresultactivity[31][7]}}<br>
					@endif
					@if(32<$i)
						{{$getresultactivity[32][7]}}<br>
					@endif
					@if(33<$i)
						{{$getresultactivity[33][7]}}<br>
					@endif
					@if(34<$i)
						{{$getresultactivity[34][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 8-->
@if($i>35)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 8</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(35<$i)
						<td>
							<center><SMALL>{{$getresultactivity[35][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[35][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[35][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[35][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(36<$i)
						<td>
							<center><SMALL>{{$getresultactivity[36][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[36][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[36][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[36][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(37<$i)
						<td>
							<center><SMALL>{{$getresultactivity[37][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[37][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[37][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[37][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(38<$i)
						<td>
							<center><SMALL>{{$getresultactivity[38][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[38][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[38][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[38][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(39<$i)
						<td>
							<center><SMALL>{{$getresultactivity[39][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[39][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[39][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[39][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(35<$i)
						{{$getresultactivity[35][7]}}<br>
					@endif
					@if(36<$i)
						{{$getresultactivity[36][7]}}<br>
					@endif
					@if(37<$i)
						{{$getresultactivity[37][7]}}<br>
					@endif
					@if(38<$i)
						{{$getresultactivity[38][7]}}<br>
					@endif
					@if(39<$i)
						{{$getresultactivity[39][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 9-->
@if($i>40)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 9</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(40<$i)
						<td>
							<center><SMALL>{{$getresultactivity[40][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[40][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[40][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[40][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(41<$i)
						<td>
							<center><SMALL>{{$getresultactivity[41][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[41][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[41][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[41][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(42<$i)
						<td>
							<center><SMALL>{{$getresultactivity[42][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[42][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[42][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[42][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(43<$i)
						<td>
							<center><SMALL>{{$getresultactivity[43][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[43][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[43][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[43][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(44<$i)
						<td>
							<center><SMALL>{{$getresultactivity[44][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[44][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[44][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[44][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(40<$i)
						{{$getresultactivity[40][7]}}<br>
					@endif
					@if(41<$i)
						{{$getresultactivity[41][7]}}<br>
					@endif
					@if(42<$i)
						{{$getresultactivity[42][7]}}<br>
					@endif
					@if(43<$i)
						{{$getresultactivity[43][7]}}<br>
					@endif
					@if(44<$i)
						{{$getresultactivity[44][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 10-->
@if($i>45)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 10</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(45<$i)
						<td>
							<center><SMALL>{{$getresultactivity[45][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[45][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[45][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[45][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(46<$i)
						<td>
							<center><SMALL>{{$getresultactivity[46][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[46][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[46][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[46][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(47<$i)
						<td>
							<center><SMALL>{{$getresultactivity[47][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[47][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[47][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[47][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(48<$i)
						<td>
							<center><SMALL>{{$getresultactivity[48][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[48][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[48][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[48][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(49<$i)
						<td>
							<center><SMALL>{{$getresultactivity[49][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[49][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[49][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[49][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(45<$i)
						{{$getresultactivity[45][7]}}<br>
					@endif
					@if(46<$i)
						{{$getresultactivity[46][7]}}<br>
					@endif
					@if(47<$i)
						{{$getresultactivity[47][7]}}<br>
					@endif
					@if(48<$i)
						{{$getresultactivity[48][7]}}<br>
					@endif
					@if(49<$i)
						{{$getresultactivity[49][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 11-->
@if($i>50)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 11</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(50<$i)
						<td>
							<center><SMALL>{{$getresultactivity[50][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[50][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[50][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[50][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(51<$i)
						<td>
							<center><SMALL>{{$getresultactivity[51][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[51][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[51][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[51][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(52<$i)
						<td>
							<center><SMALL>{{$getresultactivity[52][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[52][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[52][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[52][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(53<$i)
						<td>
							<center><SMALL>{{$getresultactivity[53][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[53][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[53][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[53][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(54<$i)
						<td>
							<center><SMALL>{{$getresultactivity[54][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[54][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[54][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[54][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br>
					<br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(50<$i)
						{{$getresultactivity[50][7]}}<br>
					@endif
					@if(51<$i)
						{{$getresultactivity[51][7]}}<br>
					@endif
					@if(52<$i)
						{{$getresultactivity[52][7]}}<br>
					@endif
					@if(53<$i)
						{{$getresultactivity[53][7]}}<br>
					@endif
					@if(54<$i)
						{{$getresultactivity[54][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 12-->
@if($i>55)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 12</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(55<$i)
						<td>
							<center><SMALL>{{$getresultactivity[55][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[55][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[55][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[55][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(56<$i)
						<td>
							<center><SMALL>{{$getresultactivity[56][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[56][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[56][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[56][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(57<$i)
						<td>
							<center><SMALL>{{$getresultactivity[57][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[57][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[57][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[57][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(58<$i)
						<td>
							<center><SMALL>{{$getresultactivity[58][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[58][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[58][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[58][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(59<$i)
						<td>
							<center><SMALL>{{$getresultactivity[59][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[59][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[59][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[59][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(55<$i)
						{{$getresultactivity[55][7]}}<br>
					@endif
					@if(56<$i)
						{{$getresultactivity[56][7]}}<br>
					@endif
					@if(57<$i)
						{{$getresultactivity[57][7]}}<br>
					@endif
					@if(58<$i)
						{{$getresultactivity[58][7]}}<br>
					@endif
					@if(59<$i)
						{{$getresultactivity[59][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 13-->
@if($i>60)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 13</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(60<$i)
						<td>
							<center><SMALL>{{$getresultactivity[60][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[60][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[60][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[60][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(61<$i)
						<td>
							<center><SMALL>{{$getresultactivity[61][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[61][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[61][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[61][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(62<$i)
						<td>
							<center><SMALL>{{$getresultactivity[62][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[62][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[62][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[62][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(63<$i)
						<td>
							<center><SMALL>{{$getresultactivity[63][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[63][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[63][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[63][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(64<$i)
						<td>
							<center><SMALL>{{$getresultactivity[64][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[64][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[64][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[64][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(60<$i)
						{{$getresultactivity[60][7]}}<br>
					@endif
					@if(61<$i)
						{{$getresultactivity[61][7]}}<br>
					@endif
					@if(62<$i)
						{{$getresultactivity[62][7]}}<br>
					@endif
					@if(63<$i)
						{{$getresultactivity[63][7]}}<br>
					@endif
					@if(64<$i)
						{{$getresultactivity[64][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
<!--hoja de actividad 14-->
@if($i>65)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 14</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(65<$i)
						<td>
							<center><SMALL>{{$getresultactivity[65][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[65][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[65][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[65][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(66<$i)
						<td>
							<center><SMALL>{{$getresultactivity[66][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[66][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[66][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[66][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(67<$i)
						<td>
							<center><SMALL>{{$getresultactivity[67][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[67][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[67][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[67][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(68<$i)
						<td>
							<center><SMALL>{{$getresultactivity[68][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[68][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[68][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[68][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(69<$i)
						<td>
							<center><SMALL>{{$getresultactivity[69][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[69][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[69][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[69][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(65<$i)
						{{$getresultactivity[65][7]}}<br>
					@endif
					@if(66<$i)
						{{$getresultactivity[66][7]}}<br>
					@endif
					@if(67<$i)
						{{$getresultactivity[67][7]}}<br>
					@endif
					@if(68<$i)
						{{$getresultactivity[68][7]}}<br>
					@endif
					@if(69<$i)
						{{$getresultactivity[69][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 15-->
@if($i>70)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 15</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(70<$i)
						<td>
							<center><SMALL>{{$getresultactivity[70][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[70][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[70][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[70][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(71<$i)
						<td>
							<center><SMALL>{{$getresultactivity[71][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[71][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[71][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[71][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(72<$i)
						<td>
							<center><SMALL>{{$getresultactivity[72][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[72][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[72][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[72][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(7374<$i)
						<td>
							<center><SMALL>{{$getresultactivity[7374][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[7374][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[7374][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[7374][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(74<$i)
						<td>
							<center><SMALL>{{$getresultactivity[74][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[74][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[74][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[74][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(70<$i)
						{{$getresultactivity[70][7]}}<br>
					@endif
					@if(71<$i)
						{{$getresultactivity[71][7]}}<br>
					@endif
					@if(72<$i)
						{{$getresultactivity[72][7]}}<br>
					@endif
					@if(73<$i)
						{{$getresultactivity[73][7]}}<br>
					@endif
					@if(74<$i)
						{{$getresultactivity[74][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 16-->
@if($i>75)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 16</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(75<$i)
						<td>
							<center><SMALL>{{$getresultactivity[75][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[75][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[75][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[75][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(76<$i)
						<td>
							<center><SMALL>{{$getresultactivity[76][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[76][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[76][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[76][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(77<$i)
						<td>
							<center><SMALL>{{$getresultactivity[77][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[77][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[77][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[77][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(78<$i)
						<td>
							<center><SMALL>{{$getresultactivity[78][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[78][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[78][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[78][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(79<$i)
						<td>
							<center><SMALL>{{$getresultactivity[79][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[79][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[79][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[79][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(75<$i)
						{{$getresultactivity[75][7]}}<br>
					@endif
					@if(76<$i)
						{{$getresultactivity[76][7]}}<br>
					@endif
					@if(77<$i)
						{{$getresultactivity[77][7]}}<br>
					@endif
					@if(78<$i)
						{{$getresultactivity[78][7]}}<br>
					@endif
					@if(79<$i)
						{{$getresultactivity[79][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 17-->
@if($i>80)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 17</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(80<$i)
						<td>
							<center><SMALL>{{$getresultactivity[80][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[80][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[80][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[80][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(81<$i)
						<td>
							<center><SMALL>{{$getresultactivity[81][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[81][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[81][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[81][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(82<$i)
						<td>
							<center><SMALL>{{$getresultactivity[82][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[82][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[82][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[82][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(83<$i)
						<td>
							<center><SMALL>{{$getresultactivity[83][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[83][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[83][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[83][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(84<$i)
						<td>
							<center><SMALL>{{$getresultactivity[84][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[84][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[84][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[84][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(80<$i)
						{{$getresultactivity[80][7]}}<br>
					@endif
					@if(81<$i)
						{{$getresultactivity[81][7]}}<br>
					@endif
					@if(82<$i)
						{{$getresultactivity[82][7]}}<br>
					@endif
					@if(83<$i)
						{{$getresultactivity[83][7]}}<br>
					@endif
					@if(84<$i)
						{{$getresultactivity[84][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 18-->
@if($i>85)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 18</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(85<$i)
						<td>
							<center><SMALL>{{$getresultactivity[85][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[85][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[85][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[85][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(86<$i)
						<td>
							<center><SMALL>{{$getresultactivity[86][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[86][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[86][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[86][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(87<$i)
						<td>
							<center><SMALL>{{$getresultactivity[87][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[87][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[87][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[87][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(88<$i)
						<td>
							<center><SMALL>{{$getresultactivity[88][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[88][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[88][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[88][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(89<$i)
						<td>
							<center><SMALL>{{$getresultactivity[89][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[89][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[89][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[89][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(85<$i)
						{{$getresultactivity[85][7]}}<br>
					@endif
					@if(86<$i)
						{{$getresultactivity[86][7]}}<br>
					@endif
					@if(87<$i)
						{{$getresultactivity[87][7]}}<br>
					@endif
					@if(88<$i)
						{{$getresultactivity[88][7]}}<br>
					@endif
					@if(89<$i)
						{{$getresultactivity[89][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 19-->
@if($i>90)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 19</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(90<$i)
						<td>
							<center><SMALL>{{$getresultactivity[90][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[90][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[90][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[90][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(91<$i)
						<td>
							<center><SMALL>{{$getresultactivity[91][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[91][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[91][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[91][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(92<$i)
						<td>
							<center><SMALL>{{$getresultactivity[92][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[92][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[92][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[92][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(93<$i)
						<td>
							<center><SMALL>{{$getresultactivity[93][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[93][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[93][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[93][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(94<$i)
						<td>
							<center><SMALL>{{$getresultactivity[94][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[94][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[94][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[94][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(90<$i)
						{{$getresultactivity[90][7]}}<br>
					@endif
					@if(91<$i)
						{{$getresultactivity[91][7]}}<br>
					@endif
					@if(92<$i)
						{{$getresultactivity[92][7]}}<br>
					@endif
					@if(93<$i)
						{{$getresultactivity[93][7]}}<br>
					@endif
					@if(94<$i)
						{{$getresultactivity[94][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 20-->
@if($i>95)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 20</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(95<$i)
						<td>
							<center><SMALL>{{$getresultactivity[95][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[95][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[95][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[95][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(96<$i)
						<td>
							<center><SMALL>{{$getresultactivity[96][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[96][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[96][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[96][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(97<$i)
						<td>
							<center><SMALL>{{$getresultactivity[97][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[97][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[97][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[97][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(98<$i)
						<td>
							<center><SMALL>{{$getresultactivity[98][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[98][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[98][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[98][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(99<$i)
						<td>
							<center><SMALL>{{$getresultactivity[99][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[99][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[99][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[99][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(95<$i)
						{{$getresultactivity[95][7]}}<br>
					@endif
					@if(96<$i)
						{{$getresultactivity[96][7]}}<br>
					@endif
					@if(97<$i)
						{{$getresultactivity[97][7]}}<br>
					@endif
					@if(98<$i)
						{{$getresultactivity[98][7]}}<br>
					@endif
					@if(99<$i)
						{{$getresultactivity[99][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 21-->
@if($i>100)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 21</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(100<$i)
						<td>
							<center><SMALL>{{$getresultactivity[100][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[100][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[100][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[100][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(101<$i)
						<td>
							<center><SMALL>{{$getresultactivity[101][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[101][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[101][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[101][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(102<$i)
						<td>
							<center><SMALL>{{$getresultactivity[102][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[102][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[102][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[102][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(103<$i)
						<td>
							<center><SMALL>{{$getresultactivity[103][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[103][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[103][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[103][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(104<$i)
						<td>
							<center><SMALL>{{$getresultactivity[104][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[104][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[104][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[104][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(100<$i)
						{{$getresultactivity[100][7]}}<br>
					@endif
					@if(101<$i)
						{{$getresultactivity[101][7]}}<br>
					@endif
					@if(102<$i)
						{{$getresultactivity[102][7]}}<br>
					@endif
					@if(103<$i)
						{{$getresultactivity[103][7]}}<br>
					@endif
					@if(104<$i)
						{{$getresultactivity[104][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 22-->
@if($i>105)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 22</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(105<$i)
						<td>
							<center><SMALL>{{$getresultactivity[105][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[105][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[105][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[105][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(106<$i)
						<td>
							<center><SMALL>{{$getresultactivity[106][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[106][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[106][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[106][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(107<$i)
						<td>
							<center><SMALL>{{$getresultactivity[107][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[107][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[107][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[107][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(108<$i)
						<td>
							<center><SMALL>{{$getresultactivity[108][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[108][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[108][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[108][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(109<$i)
						<td>
							<center><SMALL>{{$getresultactivity[109][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[109][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[109][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[109][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(105<$i)
						{{$getresultactivity[105][7]}}<br>
					@endif
					@if(106<$i)
						{{$getresultactivity[106][7]}}<br>
					@endif
					@if(107<$i)
						{{$getresultactivity[107][7]}}<br>
					@endif
					@if(108<$i)
						{{$getresultactivity[108][7]}}<br>
					@endif
					@if(109<$i)
						{{$getresultactivity[109][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 23-->
@if($i>110)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 23</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(110<$i)
						<td>
							<center><SMALL>{{$getresultactivity[110][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[110][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[110][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[110][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(111<$i)
						<td>
							<center><SMALL>{{$getresultactivity[111][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[111][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[111][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[111][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(112<$i)
						<td>
							<center><SMALL>{{$getresultactivity[112][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[112][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[112][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[112][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(113<$i)
						<td>
							<center><SMALL>{{$getresultactivity[113][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[113][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[113][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[113][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(114<$i)
						<td>
							<center><SMALL>{{$getresultactivity[114][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[114][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[114][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[114][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(110<$i)
						{{$getresultactivity[110][7]}}<br>
					@endif
					@if(111<$i)
						{{$getresultactivity[111][7]}}<br>
					@endif
					@if(112<$i)
						{{$getresultactivity[112][7]}}<br>
					@endif
					@if(113<$i)
						{{$getresultactivity[113][7]}}<br>
					@endif
					@if(114<$i)
						{{$getresultactivity[114][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 24-->
@if($i>115)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 24</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(115<$i)
						<td>
							<center><SMALL>{{$getresultactivity[115][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[115][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[115][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[115][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(116<$i)
						<td>
							<center><SMALL>{{$getresultactivity[116][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[116][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[116][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[116][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(117<$i)
						<td>
							<center><SMALL>{{$getresultactivity[117][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[117][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[117][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[117][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(118<$i)
						<td>
							<center><SMALL>{{$getresultactivity[118][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[118][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[118][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[118][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(119<$i)
						<td>
							<center><SMALL>{{$getresultactivity[119][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[119][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[119][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[119][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(115<$i)
						{{$getresultactivity[115][7]}}<br>
					@endif
					@if(116<$i)
						{{$getresultactivity[116][7]}}<br>
					@endif
					@if(117<$i)
						{{$getresultactivity[117][7]}}<br>
					@endif
					@if(118<$i)
						{{$getresultactivity[118][7]}}<br>
					@endif
					@if(119<$i)
						{{$getresultactivity[119][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 25-->
@if($i>120)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 25</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(120<$i)
						<td>
							<center><SMALL>{{$getresultactivity[120][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[120][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[120][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[120][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(121<$i)
						<td>
							<center><SMALL>{{$getresultactivity[121][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[121][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[121][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[121][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(122<$i)
						<td>
							<center><SMALL>{{$getresultactivity[122][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[122][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[122][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[122][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(123<$i)
						<td>
							<center><SMALL>{{$getresultactivity[123][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[123][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[123][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[123][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(124<$i)
						<td>
							<center><SMALL>{{$getresultactivity[124][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[124][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[124][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[124][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(120<$i)
						{{$getresultactivity[120][7]}}<br>
					@endif
					@if(121<$i)
						{{$getresultactivity[121][7]}}<br>
					@endif
					@if(122<$i)
						{{$getresultactivity[122][7]}}<br>
					@endif
					@if(123<$i)
						{{$getresultactivity[123][7]}}<br>
					@endif
					@if(124<$i)
						{{$getresultactivity[124][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 26-->
@if($i>125)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 26</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(125<$i)
						<td>
							<center><SMALL>{{$getresultactivity[125][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[125][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[125][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[125][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(126<$i)
						<td>
							<center><SMALL>{{$getresultactivity[126][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[126][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[126][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[126][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(127<$i)
						<td>
							<center><SMALL>{{$getresultactivity[127][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[127][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[127][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[127][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(128<$i)
						<td>
							<center><SMALL>{{$getresultactivity[128][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[128][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[128][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[128][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(129<$i)
						<td>
							<center><SMALL>{{$getresultactivity[129][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[129][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[129][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[129][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(125<$i)
						{{$getresultactivity[125][7]}}<br>
					@endif
					@if(126<$i)
						{{$getresultactivity[126][7]}}<br>
					@endif
					@if(127<$i)
						{{$getresultactivity[127][7]}}<br>
					@endif
					@if(128<$i)
						{{$getresultactivity[128][7]}}<br>
					@endif
					@if(129<$i)
						{{$getresultactivity[129][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 27-->
@if($i>130)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 27</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(130<$i)
						<td>
							<center><SMALL>{{$getresultactivity[130][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[130][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[130][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[130][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(131<$i)
						<td>
							<center><SMALL>{{$getresultactivity[131][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[131][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[131][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[131][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(132<$i)
						<td>
							<center><SMALL>{{$getresultactivity[132][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[132][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[132][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[132][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(133<$i)
						<td>
							<center><SMALL>{{$getresultactivity[133][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[133][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[133][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[133][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(134<$i)
						<td>
							<center><SMALL>{{$getresultactivity[134][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[134][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[134][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[134][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(130<$i)
						{{$getresultactivity[130][7]}}<br>
					@endif
					@if(131<$i)
						{{$getresultactivity[131][7]}}<br>
					@endif
					@if(132<$i)
						{{$getresultactivity[132][7]}}<br>
					@endif
					@if(133<$i)
						{{$getresultactivity[133][7]}}<br>
					@endif
					@if(134<$i)
						{{$getresultactivity[134][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 28-->
@if($i>135)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 28</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(135<$i)
						<td>
							<center><SMALL>{{$getresultactivity[135][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[135][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[135][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[135][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(136<$i)
						<td>
							<center><SMALL>{{$getresultactivity[136][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[136][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[136][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[136][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(137<$i)
						<td>
							<center><SMALL>{{$getresultactivity[137][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[137][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[137][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[137][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(138<$i)
						<td>
							<center><SMALL>{{$getresultactivity[138][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[138][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[138][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[138][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(139<$i)
						<td>
							<center><SMALL>{{$getresultactivity[139][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[139][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[139][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[139][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(135<$i)
						{{$getresultactivity[135][7]}}<br>
					@endif
					@if(136<$i)
						{{$getresultactivity[136][7]}}<br>
					@endif
					@if(137<$i)
						{{$getresultactivity[137][7]}}<br>
					@endif
					@if(138<$i)
						{{$getresultactivity[138][7]}}<br>
					@endif
					@if(139<$i)
						{{$getresultactivity[139][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 29-->
@if($i>140)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 29</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(140<$i)
						<td>
							<center><SMALL>{{$getresultactivity[140][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[140][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[140][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[140][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(141<$i)
						<td>
							<center><SMALL>{{$getresultactivity[141][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[141][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[141][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[141][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(142<$i)
						<td>
							<center><SMALL>{{$getresultactivity[142][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[142][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[142][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[142][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(143<$i)
						<td>
							<center><SMALL>{{$getresultactivity[143][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[143][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[143][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[143][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(144<$i)
						<td>
							<center><SMALL>{{$getresultactivity[144][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[144][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[144][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[144][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(140<$i)
						{{$getresultactivity[140][7]}}<br>
					@endif
					@if(141<$i)
						{{$getresultactivity[141][7]}}<br>
					@endif
					@if(142<$i)
						{{$getresultactivity[142][7]}}<br>
					@endif
					@if(143<$i)
						{{$getresultactivity[143][7]}}<br>
					@endif
					@if(144<$i)
						{{$getresultactivity[144][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif

<!--hoja de actividad 30-->
@if($i>145)
	<div style='page-break-after:always;'></div>
	<div class="panel panel-flat">

		<div class="panel-heading">
			<table width="100%">

				<tr>
					<td align="right" style="width: 20%">
							<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/>
					</td>
					<td align="right" style="text-align: center;" style="width: 80%" style="height: 30px;">	
							<b><big>UNIVERSIDAD DE GUAYAQUIL</big><br>
								FORMACIÓN UNIVERSITARIA<br>
								PASANTÍAS Y/O PRÁCTICAS PRE-PROFESIONALES</b> 

					</td>
				</tr>

			</table>
		</div>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">

			<tr bgcolor="EDE5FA" style="height: 30px;">
				<td style="text-align: center;" style="height: 30px;"><b>FICHA DE ACTIVIDADES DIARIAS  (FADPP-2)</b></td>
			</tr>

		</table>

        <?php
        $getshow="x";
        $hourstotal=0;
        ?>
		<table width="100%" height="100%">
			<tr>
				<td align="left" style="width: 30%">PASANTIAS</td>
				<td align="left" style="width: 2%">PAS</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>
			<tr>
				<td align="left" style="width: 30%">PRACTICAS PRE-PROFESIONALES</td>
				<td align="left" style="width: 2%">PPP</td>
				<td align="left" style="border-width: 1px;border: solid; border-color: #000000;">
					{{$getshow}}
				</td>
				<td align="left" style="width: 80%"></td>
			</tr>

		</table>

		<table width="100%">

			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE Y APELLIDOS DEL  ESTUDIANTE: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][3])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>FACULTAD: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][4])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>CARRERA: </b></td>
				<td align="left" style="width: 70%">{{strtoupper($getresultactivity[1][5])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 50%"><b>NOMBRE DEL SUPERVISOR DE LA INSTITUCION RECEPTORA: </b></td>
				<td align="left" style="width: 50%">{{strtoupper($getresultactivity[1][6])}} </td>
			</tr>
			<tr>
				<td align="left" style="width: 30%"><b>SEMANA N°: </b></td>
				<td align="left" style="width: 70%"> 30</td>
			</tr>
		</table>
		<br>


		<div class="table-responsive">
			<table border="1" cellpadding="0" cellspacing="0" style="width:100%" style="height: 30px;">
				<thead>
				<tr>
					<th style="width: 30%"><CENTER><b>DIA Y FECHA</b></CENTER></th>
					<th style="width: 20%"><center><b>N° DE HORAS<br>DIARIAS<br></b></center></th>
					<th style="width: 60%"><center><b>DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</b></center></th>
				</tr>
				</thead>
				<tbody>
				<TR style="height: 50px;">
					@if(145<$i)
						<td>
							<center><SMALL>{{$getresultactivity[145][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[145][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[145][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[145][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(146<$i)
						<td>
							<center><SMALL>{{$getresultactivity[146][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[146][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[146][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[146][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(147<$i)
						<td>
							<center><SMALL>{{$getresultactivity[147][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[147][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[147][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[147][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(148<$i)
						<td>
							<center><SMALL>{{$getresultactivity[148][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[148][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[148][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[148][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>
				<TR style="height: 50px;">
					@if(149<$i)
						<td>
							<center><SMALL>{{$getresultactivity[149][0]}}</SMALL></center>
						</td>

						<TD>
							<center><small>{{$getresultactivity[149][1]}}</small></center>
						</TD>

						<TD>
							<small>{{$getresultactivity[149][2]}}</small>
						</TD>
                        <?php
                        $hourstotal=$hourstotal+$getresultactivity[149][1];
                        ?>
					@else
						<td>
							<SMALL>&nbsp;</SMALL>
						</td>

						<TD>
							<small>&nbsp;</small>
						</TD>

						<TD>
							<small>&nbsp;</small>
						</TD>
					@endif
				</TR>

				</tbody>
			</table>
		</div>

		<br>

		<div class="form-group">
			<div class="col-md-6">

				<div class="form-group">
					TOTAL DE HORAS: {{$hourstotal}}
					<br><br>
				</div>

				<div class="form-group">
					<B>OBSERVACIONES: </B><br>
					@if(145<$i)
						{{$getresultactivity[145][7]}}<br>
					@endif
					@if(146<$i)
						{{$getresultactivity[146][7]}}<br>
					@endif
					@if(147<$i)
						{{$getresultactivity[147][7]}}<br>
					@endif
					@if(148<$i)
						{{$getresultactivity[148][7]}}<br>
					@endif
					@if(149<$i)
						{{$getresultactivity[149][7]}}<br>
					@endif
					<br>
				</div>
			</div>

		</div>

		<HR width=50% align="left" size="2" noshade="noshade" style="color: #000000;" >

		<table width="100%">

			<tr>
				<td align="left" style="width: 30%"><SMALL><BR><b>FIRMA REPRESENTANTE INSTITUCIÓN RECEPTORA</b><br>
							<BR>{{strtoupper($getresultactivity[1][6])}}<br>
						</SMALL></td>

				<td align="right" style="width: 30%"><SMALL><b>SELLO DE LA INSTITUCION </b></SMALL></td><br>
			</tr>

		</table>
		<br>
		<small><small><i>Nota:  El estudiante podrá realizar máximo 6 horas diarias de pasantías y/o prácticas profesionales, es decir máximo 30 horas a la semana.</i></small></small>

	</div>
@endif
</body>
</html>



