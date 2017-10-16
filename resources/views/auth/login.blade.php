@extends('layouts.front')
@section('paddingDefaultFront','padding:200px 0 100px 0;')
@section('mainContent')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary primary-opacity">
            <div class="panel-heading"><label class="text-bold">Accesos al Sistema</label></div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {!!  session('status') !!}
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}" autocomplete="off">
                    {{ csrf_field() }}


                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Usuario:</label>

                        <div class="col-md-6">

                            <div class="input-group margin-bottom-sm">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required autofocus placeholder="Ingrese C&eacute;dula/Pasaporte">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                            </div>


                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Clave:</label>

                        <div class="col-md-6">

                            <div class="input-group margin-bottom-sm">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Ingrese Clave">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><b>
                                        Recordar Clave</b>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ACCESO</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                </div>
            <div class="panel-footer">
                <div class="row">
                <div class="col-md-8 col-md-offset-4 text-right">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Recuperar Contrase&ntilde;a?
                    </a>
                </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('masterJsCustom')
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="js/modules/security/auth.js"></script>
@endsection
@section('masterCssCustom')
    <link rel="stylesheet" href="plugins/iCheck/square/red.css">
@endsection