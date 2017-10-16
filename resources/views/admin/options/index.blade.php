@extends('layouts.back')
@section('masterTitle')
   Opciones
@endsection
@section('masterTitleModule')
   Opciones del Sistema
@endsection
@section('masterDescription')
   Lista de las opciones ingresadas en el sistema acad&eacutemico
@endsection

@section('mainBox')
  <div class="col-lg-7">
      <a href="{{ route('admin.options.create')}}" class="btn bg-teal-400 btn-labeled legitRipple">
        <b><i class="icon-add"></i></b> Agregar
      </a>
  </div>
                        <div class="col-lg-5">
                           {!! Form::open(['route' => 'admin.options.index','method'=>'GET', 'class'=>'header-search-wrapper ']) !!}
                                <div class="input-group content-group" style="margin-bottom: 10px !important;">
                                    <div class="has-feedback has-feedback-left">
                                        {!! Form::text('scope', $scope, [ "class"=>"form-control input-xlg" ,"placeholder"=>" Nombre Opciones"]) !!}

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
                        <th>Prefijo</th>
                        <th>Url</th>
                        <th>Padre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($options as $option)

                        <tr>
                          <td>{{ $option->name }}</td>
                          <td>{{ $option->prefix }}</td>
                          <td>{{ $option->url }}</td>
                          <td>{{ $option->father }}</td>
                          <td>
                            {{ Config::get('dataselects.status')[$option->status] }}
                             
                          </td>
                          <td>

<a data-placement="bottom" data-popup="tooltip" data-original-title="EDITAR" href="{{ route('admin.options.edit',$option->id) }}" class="label bg-slate label-icon"><i class=" icon-pencil7"></i></a>
       &nbsp;                    
<a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="label label-warning warning-300 label-icon"
                                     onclick="return alertConfirmDelete('la opci&oacute;n','{{ route('admin.options.destroy',$option->id)}}')"><i class="icon-trash"></i></a></td>
                        </tr>
                      @endforeach
                </tbody>
              </table>
            </div>
{!! $options->render() !!}

@endsection

@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection

                    