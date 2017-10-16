@extends('layouts.back')
@section('masterTitle')
    Notificaciones
@endsection
@section('masterTitleModule')
    @if(empty($exception->getMessage()))
        Permiso denegado
    @else
        {{ $exception->getMessage()}}
    @endif
@endsection
@section('masterDescription')
    No puede realizar operaciones en esta opci&oacute;n su rol no lo permite
@endsection

@section('mainContent')
    <div class="error-page">
        <h2 class="headline text-red">403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Permiso denegado.</h3>

            <p>
                Algo ha ido mal. No tienes los permisos necesarios para continuar con este proceso.
            </p>

            <a  href="{{ URL::previous() }}" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> REGRESAR</a>
        </div>
    </div>
@endsection
