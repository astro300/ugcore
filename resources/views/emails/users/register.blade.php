@component('mail::message')
# Verificaci&oacute;n de Cuentas

Gracias por registrarse en la plataforma SIUG. Por favor, ingrese al siguiente enlace para verificar su direci&oacute;n de correo electr&oacute;nico.

@component('mail::button')
    @slot('url', URL::to('register/verify/' .  $objUser->confirmation_code))
    Activar Cuenta
@endcomponent

Saludos Cordiales,<br>
{{ config('app.name') }}
@endcomponent
