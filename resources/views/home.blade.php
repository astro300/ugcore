@extends('layouts.back')
@section('masterTitle')
    Inicio
@endsection
@section('masterTitleModule')
    Inicio
@endsection
@section('masterDescription')
    Pantalla de bienvenida al Sistema.
@endsection
@section('mainContent')

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Mensaje</div>
                <div class="panel-body">
                   Hola, {{Auth::user()->fullName()}} bienvenido al {{ env('APP_NAME') }}
                    <h2 class="page-header text-center"><a>Aplicaciones de Utilidad</a></h2>
                    <div class="row text-center">
                        <a class="btn btn-app" href="http://www.ug.edu.ec" target="_blank">
                            <i class="fa fa-globe"></i> WEB-UG
                        </a>
                        <a class="btn btn-app" href="https://outlook.office.com" target="_blank">
                             <i class="fa fa-windows"></i> Office365
                        </a>
                        <a class="btn btn-app" href="https://onedrive.live.com/" target="_blank">
                             <i class="fa fa-cloud"></i> OnDrive
                        </a>
                        <a class="btn btn-app" target="_blank" href="http://www.ug.edu.ec/mapeta/index.html">
                            <i class="fa fa-map"></i> Mapa-UG
                        </a>
                        <a class="btn btn-app" href="http://www.ug.edu.ec/unidades-academicas/" target="_blank">
                            <i class="fa fa-graduation-cap "></i> Grado
                        </a>
                        <a class="btn btn-app" href="{{route('admin.users.changePassword')}}" >
                            <i class="fa fa-lock "></i> Configuraci&oacute;n
                        </a>
                        <a class="btn btn-app" href="{{route('forum.index')}}" >
                            <i class="fa fa-users"></i> Foro
                        </a>
                    </div>
                </div>
            </div>
        </div>

@endsection


@section('mainBox')
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="https://www.facebook.com/UdeGuayaquil" target="_blank" class="text-black">
            <div class="info-box">
                <span class="info-box-icon btn-facebook"><i class=" fa fa-facebook-square"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number"><small>FACEBOOK</small></span>
                    <span class="info-box-text"><small>Perfil U.G.</small></span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="https://www.youtube.com/channel/UCNjcceqnaK8eqhQ8nE2U95w" target="_blank" class="text-black">
            <div class="info-box">
                <span class="info-box-icon btn-google"><i class="fa fa-youtube-play"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number"><small>YOUTUBE</small></span>
                    <span class="info-box-text"><small>Canal U.G.</small></span>
                </div>
            </div>
        </a>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="https://twitter.com/udeguayaquil?lang=es" target="_blank" class="text-black">
            <div class="info-box">
                <span class="info-box-icon btn-twitter"><i class="fa fa-twitter-square"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number"><small>TWITTER</small></span>
                    <span class="info-box-text"><small>Perfil U.G.</small></span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="https://www.instagram.com/universidad_de_guayaquil/" target="_blank" class="text-black">
            <div class="info-box">
                <span class="info-box-icon btn-foursquare"><i class="fa fa-instagram"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number"><small>INSTAGRAM</small></span>
                    <span class="info-box-text"><small>Perfil U.G.</small></span>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
@endsection
