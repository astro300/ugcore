<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
            <div class="panel-heading">

                <center><img src="{{ asset('/images/logo_foot.png') }}"></center>
                <font face="arial">
                <h3 style="text-align: center;">UNIVERSIDAD DE GUAYAQUIL</h5>
                <h3 style="text-align: center;">FACULTAD {{$getfaculties}}</h5>
                <h3 style="text-align: center;">PRACTICAS PRE-PROFESIONALES</h5>
                <h3 style="text-align: center;">CERTIFICADO FIN DE PRACTICAS</h5>
                </font>
            </div>

            </br></br></br>

            <div class="panel-body">    
                <font face="arial">
                Estimado (a)</br>
                <B>{{$student}}</B></br>
                Estudiante de la Carrera {{$getcareers}}</br></br></br>
                
                Comunico a usted, que ya se encuentra listo el <b>Certificado del Fin de Practicas Pre-Profesionales</b>, realizadas en la Institucion <b> {{$typeinstitution}} {{$nameinstitution}}</b>, puede ser retirado en el departamento de Pre-Profesionales de la carrera. </br></br>
                

                
                Es todo lo que puedo expresar por el momento.<br></br><br></br>
                <CENTER>Atentamente,</br>
                COORDINADOR(A) DE LAS PRÁCTICAS PRE-PROFESIONALES</br>
                DEPARTAENTO DE VINCULACION CON LA SOCIEDAD</BR>
                DE LA CARRERA {{$getcareers}}, DE LA FACULTAD {{$getfaculties}}</CENTER>

                </font>


    </body>
</html>