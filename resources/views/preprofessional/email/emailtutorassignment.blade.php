@component('mail::message')
## FACULTAD DE {{$data['faculty']}}
## CARRERA {{$data['career']}}
#### BIENVENIDO AL SISTEMA DE LAS PASANTIAS Y/O PRACTICAS PRE-PROFESIONALES

Señor (a)
**{{$data['nameTutor']}}**
Docente de la Carrera {{$data['career']}}
Distinguido (a).-

Comunico a usted la **Asignacion de Tutor Academico** del estudiante **{{$data['student']}}**, con cédula de ciudadania N°**{{$data['nuic']}}** quien esta aprobado para realizar las Prácticas Pre-Profesionales en la institucion **{{$data['type_institution']}} {{$data['name_institution']}}**.

El estudiante ejecutará y se lo evaluará en la institucion donde realizara las practicas.


**Informacion del Tutor Academico**

Nombres y Apellidos: {{$data['nameTutor']}}

Correo Institucional: {{$data['email_teacher']}}


**Informacion del Estudiante**

Nombres y Apellidos: {{$data['student']}}

Correo Institucional: {{$data['email_student']}}

@component('mail::button')
    @slot('url', $data['link'])
    VER ARCHIVO
@endcomponent

Saludos cordiales,


COORDINADOR(A) DE LAS Prácticas Pre-Profesioanles
DEPARTAENTO DE VINCULACION CON LA SOCIEDAD
DE LA CARRERA {{$data['career']}}, DE LA FACULTAD {{$data['faculty']}}
{{ config('app.name') }}
@endcomponent
