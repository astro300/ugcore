@component('mail::message')
# Inscripci&oacute;n del Concurso

Estimado/a: {{ $user }},

La inscripci&oacute;n en el proceso: {{ $concourse }} se ha realizado de manera exitosa. Por favor, ingrese al siguiente enlace para descargar el formulario de inscripci&oacute;n

@component('mail::button')
@slot('url', URL::to('/selection/process-report-template-' . $code))
Descargar Formulario
@endcomponent

Saludos Cordiales,<br>
{{ config('app.name') }}
@endcomponent
