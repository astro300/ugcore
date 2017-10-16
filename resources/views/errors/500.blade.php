@extends('layouts.back')
@section('masterTitle')
   Notificaciones
@endsection
@section('masterTitleModule')
  La petici&oacute;n realizada por el usuario produjo un error
@endsection
@section('masterDescription')
   Por el momento no puede realizar operaciones en esta opci&oacute;n, lamentamos las moletias ocurridas. 
@endsection




@section('mainContent')


    <div class="error-page">
        <h2 class="headline text-red">500</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Error en el Proceso Interno.</h3>

            <p>
                Algo ha ido muy mal. Por favor intente mas tarde.
                estamos trabajando en aquello.
            </p>

            <a  href="{{ route('home') }}" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> Inicio</a>
        </div>
    </div>


@endsection