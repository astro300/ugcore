@extends('layouts.back')
@section('masterTitle')
   Usuarios
@endsection
@section('masterTitleModule')
   Usuarios del Sistema
@endsection
@section('masterDescription')
   Lista de los usuarios ingresados en el sistema acad&eacutemico
@endsection



@section('mainBox')
  <div class="col-lg-7">
      <a href="{{ route('admin.users.create')}}" class="btn bg-teal-400 btn-labeled legitRipple">
        <b><i class="icon-add"></i></b> Agregar
      </a>
  </div>
                        <div class="col-lg-5">
                           {!! Form::open(['route' => 'admin.users.index','method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
                                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                                    <div class="has-feedback has-feedback-left">
                                        {!! Form::text('scope', $scope, [ "class"=>"form-control input-xlg" ,"placeholder"=>" C&eacute;dula Usuarios"]) !!}

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
                        <th>Usuario</th>
                        <th>Email</th>
                        
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                          <td>{{ $user->name }}</td>

                          <td>{{ $user->email }}</td>
                          <td>
                         {{ Config::get('dataselects.status')[$user->status] }}
                          </td>
                          <td>

                              <a data-placement="bottom"data-popup="tooltip" data-original-title="ROLES DE USUARIO" href="{{ route('admin.users.users_roles',$user->id)}}" class="label label-primary label-icon"><i class="icon-user-check"></i></a>

                              <a data-placement="bottom"data-popup="tooltip" data-original-title="EDITAR" href="{{ route('admin.users.edit',$user->id) }}" class="label bg-slate label-icon"><i class=" icon-pencil7"></i></a>
                                     &nbsp;                    
                              <a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="label label-warning warning-300 label-icon" onclick="return alertConfirmDelete('el permiso','{{ route('admin.users.destroy',$user->id)}}')"><i class="icon-trash"></i></a>
                          </td>
                        </tr>
                        @empty
                        <td colspan="4" class="text-center">NO HAY REGISTROS</td>
                      @endforelse
                </tbody>
              </table>
</div>

{!! $users->render() !!}

@endsection

@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection
                    