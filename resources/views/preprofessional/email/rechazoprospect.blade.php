@component('mail::message')
## FACULTAD DE {{$data['faculty']}}
## CARRERA {{$data['carrer']}}
#### COMUNICADO SOBRE LA PRE-INSCRIPCION DE LAS PASANTIAS Y/O PRACTICAS PRE-PROFESIONALES

Estimado (a), estudiante {{$data['nameStudent']}}:

Usted solicitó la Pre-Inscripcion para realizar el proceso de las **_Practicas Pre-profesionales_**, en la fecha {{$data['fecha']}}, sin embargo fué rechazada el día de hoy bajo la siguiente observación: **_{{$data['obs']}}_** favor hacer click en el siguiente enlace para ingresar al sistema:

@component('mail::button')
    @slot('url', URL::to('/preprofessional/indexInscripcion'))
    INGRESO AL SISTEMA WEB
@endcomponent

Saludos cordiales,


    COORDINADOR(A) DE LAS Prácticas Pre-Profesioanles
    DEPARTAENTO DE VINCULACION CON LA SOCIEDAD
    DE LA CARRERA {{$data['carrer']}}, DE LA FACULTAD {{$data['faculty']}}
{{ config('app.name') }}
@endcomponent
