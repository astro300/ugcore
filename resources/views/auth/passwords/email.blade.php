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

                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}" autocomplete="off">
                    {{ csrf_field() }}


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-3 control-label">Email:</label>

                        <div class="col-md-7">

                            <div class="input-group margin-bottom-sm">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"
                                       required autofocus placeholder="Ingrese su email">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-send" aria-hidden="true"></i></span>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            {!! app('captcha')->display() !!}
                        </div>

                        <!-- /.col -->
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ENVIAR</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection


