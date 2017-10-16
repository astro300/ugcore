<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
@foreach ($getinformationsutdent as list($document,$first_name,$last_name,$getfaculties,$getcareers,$Namestutor,$name,$day,$mesh,$year,$secretary,$deca,$cordinator))
            
            <div class="panel-heading">
                <center>	<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/></center>
                <font face="arial">
                    <h5 style="text-align: left;">Guayaquil, {{$day}} DE {{$mesh}} DE {{$year}}<!--fecha actual en letras 30 de septiembre de 2016--></h5>
                    <br></br><br></br>
                    <h5><!--Ingresar profesion ej: Ingeniero--></br>
                    {{$deca}}<br>
                    <B>DECANO(A) DE LA FACULTAD DE {{$getfaculties}}<!--NOMBRE DE LA FACULTAD--></B></h5>
                    Ciudad.-
                    <br></br><br></br>
                    De mi consideración:
                </font>                    
            </div>
            <br></br><br></br>
            <div class="panel-body" style="text-align:justify">
                <font face="arial">
                Cumplo con Certificar que el estudiante <b> {{$last_name}} {{$first_name}}<!--NOMBRE DEL ESTUDIANTE--></b> con <b> C.I# {{$document}}<!--CEDULA ESTUDIANTE--></b>, Estudiante de la carrera de {{$getcareers}}<!--NOMBRE DE LA CARRERA--> de esta Unidad Académica ha realizado las Prácticas Pre-Profesionales en la institucion <b> {{$name}}<!--NOMBRE DE LA INSTITUCION--></b> con una duración de 240 horas, a partir del <!--fecha de incio de las practicas en letas--> al <!--fecha de fin de las practicas en letas--> con el tutor académico {{$Namestutor}}<!--NOMBRE DEL TUTOR-->, habiendo cumplido con todos los instrumentos de recolección de información en regla:
                <br></br><br></br>
                <br></br><br></br>
                <p style='padding-left: 5em'>
                    <ul>
                    <li> Ficha de Datos Generales.</li>
                    <li> Ficha de Actividades Diarias.</li>
                    <li> Ficha de Supervision de Tutor Académico.</li>
                    <li> Ficha de Evaluación estudiantil.</li>
                    <li> Ficha de Evaluacion y rendimiento del pasante.</li>
                    </ul>
                </p>
                <br></br><br></br>
                <br></br>
                Particular que hago a conocer a usted para los fines legales pertinentes.
                <br></br><br></br>
                Atentamente,
                <br></br><br></br>
                <br></br><br></br>
                <br></br>
                {{$cordinator}}<br>
                <b>Coordinador de Prácticas Pre Profesionales</b>
                </font>
            </div>

<div style='page-break-after:always;'></div>

            <div class="panel-heading">

                <center>	<img id="logo" src="{{public_path('/images/logo_foot.png')}}" width="100px"/></center>
                <font face="arial">
                	<h4 style="text-align: center;"><BIG><B>SECRETARIA DE LA FACULTAD DE {{$getfaculties}}<!--NOMBRE DE LA FACULTAD--> DE LA UNIVERSIDAD DE GUAYAQUIL</B></BIG></h5>
                	<br></br><br></br>
                	<h2 style="text-align: center;"><BIG><B>CERTIFICA:</B></BIG></h5>
                </font>
            </div>

            <br></br><br></br><br></br>

            <div class="panel-body" style="text-align:justify">    
                <font face="arial">
                Que revisados los archivos del Departamento de Prácticas Pre-Profesionales de la carrera de {{$getcareers}}<!--NOMBRE DE LA CARRERA-->, consta que el estudiante <b> {{$last_name}} {{$first_name}}<!--NOMBRE DEL ESTUDIANTE--></b> con <b> C.I# {{$document}}<!--CEDULA ESTUDIANTE--></b>, realizo las prácticas Pre-Profesionales en la institucion <b> {{$name}}<!--NOMBRE DE LA INSTITUCION--></b> con una duración de 240 horas y su tutor academico fue {{$Namestutor}}<!--NOMBRE DEL TUTOR-->. <br></br><br></br><br></br>
                
                Así consta en los archivos de la Secretaria a mi cargo, a los cuales me remito en caso necesario. <br></br><br></br><br></br> 
                
                Guayaquil, {{$day}} DE {{$mesh}} DE {{$year}}<!--FECHA ACTUAL--><br></br><br></br><br></br><br></br><br></br>
                
                {{$secretary}}<!--NOMBRE DEL SECRETARIO(AB) DE LA FACULTAD--><br></br>
                SECRETARIO (A)
                </font>
            </div>
@endforeach 
    </body>
</html>