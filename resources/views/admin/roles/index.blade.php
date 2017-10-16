@extends('layouts.back')
@section('masterTitle')
   Roles
@endsection
@section('masterTitleModule')
   Roles del Sistema
@endsection
@section('masterDescription')
   Lista de los Roles ingresados en el sistema acad&eacutemico
@endsection


@section('mainBox')
  <div class="col-lg-7">
      <a href="{{ route('admin.roles.create')}}" class="btn bg-teal-400">
        <b><i class="icon-add"></i></b> Agregar
      </a>
  </div>
                        <div class="col-lg-5">
                           {!! Form::open(['route' => 'admin.roles.index','method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
                                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                                    <div class="has-feedback has-feedback-left">
                                        {!! Form::text('scope', $scope, [ "class"=>"form-control input-xlg" ,"placeholder"=>" Nombre Roles"]) !!}

                                        <div class="form-control-feedback">
                                            <i class="icon-search4 text-muted text-size-base"></i>
                                        </div>
                                    </div>
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-xlg legitRipple">Buscar</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
@endsection


@section('mainContent')


    <div class="table-responsive">
        <table class="table table-bordered bg-white table-hover">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripci&oacute;n</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $rol)
                <tr>
                    <td>{{ $rol->name }}</td>
                    <td>{{ $rol->description }}</td>
                    <td>&nbsp;
                        <a data-placement="bottom" data-popup="tooltip" data-original-title="OPCIONES A ROLES" href="{{ route('admin.roles.rolesoptions',$rol->id)}}" class="label label-success success-300 label-icon"><i class="icon-share3"></i></a>
                        &nbsp;
                        <a data-placement="bottom"data-popup="tooltip" data-original-title="EDITAR" href="{{ route('admin.roles.edit',$rol->id)}}" class="label bg-slate label-icon"><i class=" icon-pencil7"></i></a>
                        &nbsp;
                        <a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="label label-warning warning-300 label-icon"
                           onclick="return alertConfirmDelete('el rol','{{ route('admin.roles.destroy',$rol->id)}}')"><i class="icon-trash"></i></a></td>
                </tr>
                @empty
                    <td colspan="4" class="text-center">NO HAY REGISTROS</td>
                @endforelse
            </tbody>
        </table>
    </div>
    {!! $roles->render() !!}



@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection


                    