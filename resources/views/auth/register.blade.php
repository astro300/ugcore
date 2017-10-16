@extends('layouts.front')
@section('paddingDefaultFront','padding:180px 0 100px 0;')
@section('mainContent')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary primary-opacity">
            <div class="panel-heading"><label class="text-bold">Registro de Usuarios</label></div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                            <label for="cedula" class="col-md-4 control-label">C&eacute;dula/Pasaporte:</label>
                            <div class="col-md-7">
                                <div class="input-group margin-bottom-sm">
                                    <input id="cedula" type="text" class="form-control" name="cedula" value="{{ old('cedula') }}"
                                           required autofocus placeholder="Ingrese su cedula/pasaporte">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Nombres:</label>
                            <div class="col-md-7">
                                <div class="input-group margin-bottom-sm">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                                           required autofocus placeholder="Ingrese su nombre">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Apellidos</label>
                            <div class="col-md-7">
                                <div class="input-group margin-bottom-sm">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                                           required autofocus placeholder="Ingrese su apellido">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
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
                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Sexo:</label>
                            <div class="col-md-7">
                                <div class="input-group margin-bottom-sm">
                                    <select class="form-control" id="sex" name="sex" required autofocus placeholder="Ingrese su sexo">
                                        <option value="1" @if(old('sex')=='1') selected @endif>Masculino</option>
                                        <option value="0" @if(old('sex')=='0') selected @endif>Femenino</option>
                                    </select>

                                    <span class="input-group-addon"><i class="glyphicon glyphicon-certificate" aria-hidden="true"></i></span>
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
                            <button type="submit" class="btn btn-primary btn-block btn-flat">REGISTRARSE</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection

