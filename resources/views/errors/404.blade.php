@extends('layouts.back')
@section('masterTitle')
    Notificaciones
@endsection
@section('masterTitleModule')
    @if(empty($exception->getMessage()))
        Objeto No Encontrado
    @else
        {{ $exception->getMessage()}}
    @endif
@endsection
@section('masterDescription')
   recurso no encontrado
@endsection

@section('mainContent')
    <div class="error-page">
        <h2 class="headline text-red">404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Data no encontrada.</h3>

            <p>
                Algo ha ido mal. El recurso que estas solicitando no existe.
            </p>

            <a  href="{{ route('home') }}" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> Inicio</a>
        </div>
    </div>
@endsection
