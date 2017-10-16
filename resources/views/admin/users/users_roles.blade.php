@extends('layouts.back')
@section('masterTitle')
    Usuarios Roles
@endsection
@section('masterTitleModule')
    Asignaci&oacute;n de Roles a los usuarios
@endsection
@section('masterDescription')
    Panel de asignaci&oacute;n de Roles a los usuarios del sistema
@endsection


@section('mainContent')

    <div class="col-lg-10 col-lg-offset-1">

        {!! Form::open(['route'=> ['admin.users.store_roles',$objUser]]) !!}
        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold text-center">Panel de Administraci&oacute;n de Roles para {{$objUser->name}}</h5>
            </div>
            <div class="panel-body">
                <input id="arrayRoleExists" type="hidden" value="{{ $roleExists }}"/>
                {!! Field::select('roles', $roles, null,[
                       "class"=>"select2",'empty'=>'-Seleccione un Rol-','onchange'=>"getMenuByRole()",
                       'label'=>"Roles Disponibles:"]) !!}

                <div class="row">
                    <div class="col-lg-4">
                        <button type="button" onclick="getAddRoleUser()"
                                class="btn bg-pink-400 btn-raised btn-block">AGREGAR</button>
                    </div>
                    <div class="col-lg-8">
                        <h6 style="text-align: center;">
                            <b>MEN&Uacute; DISPONIBLE PARA EL ROL</b></h6>
                        <div id="dvMenu" style="text-align:left">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <hr/>
                        <div class="callout callout-info">
                            <i class="icon-users"></i> &nbsp; ROLES-ASIGNADOS

                            <p>Listado de Roles asignados al usuario {{ $objUser->email }}.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <ul class="nav nav-stacked" id="ulNavRol">
                            @foreach($userRoles  as $key => $rol)
                                <li> <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox"  checked='checked' id='role_{{$key}}' name='role[]' value='{{$key}}'><b>
                                                {{$rol}}</b>
                                        </label>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>


                </div>

            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <a href="{{ route('admin.users.index')}}"
                       class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                    class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                    {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection


@section('masterCssCustom')
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
@endsection

@section('masterJsCustom')
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script src="{{ asset('js/modules/security/roles.js') }}"></script>

@endsection