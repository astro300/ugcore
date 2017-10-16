@extends('layouts.back')
@section('masterTitle')
   Notificaciones
@endsection
@section('masterTitleModule')
      @if(empty($exception->getMessage()))
           Acceso No Autorizado
           @else
          {{ $exception->getMessage()}}
      @endif
@endsection
@section('masterDescription')
   No puede realizar operaciones en esta opci&oacute;n su rol no lo permite
@endsection

@section('mainContent')
    <div class="error-page">
        <h2 class="headline text-red">401</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! No tienes permisos.</h3>

            <p>
                Algo ha ido mal. No tienes los permisos necesarios para continuar con esta opci&oacute;n.
            </p>

            <a  href="{{ route('home') }}" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> Inicio</a>
        </div>
    </div>
@endsection
