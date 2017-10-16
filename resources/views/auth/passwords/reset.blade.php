@extends('layouts.front')
@section('paddingDefaultFront','padding:200px 0 100px 0;')
@section('mainContent')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary primary-opacity">
            <div class="panel-heading"><label class="text-bold">Recuperar Contrase&ntilde;a</label></div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}" autocomplete="off">
                    {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-7">
                            <div class="input-group margin-bottom-sm">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"
                                       required autofocus placeholder="Ingrese su email">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-send" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Clave:</label>

                        <div class="col-md-7">

                            <div class="input-group margin-bottom-sm">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Ingrese Clave">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirmation" class="col-md-4 control-label">Confirmaci&oacute;n:</label>

                        <div class="col-md-7">

                            <div class="input-group margin-bottom-sm">
                                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Ingrese Confirmaci&oacute;n de Clave">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                            </div>

                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-8">
                            {!! app('captcha')->display() !!}
                        </div>

                        <!-- /.col -->
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">PROCESAR</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection


