@extends('layouts.back')
@section('masterTitle')
    Inicio
@endsection
@section('masterTitleModule')
    Inicio
@endsection
@section('masterDescription')
    Opciones disponibles en el Sistema.
@endsection
@section('mainContent')
    <div class="col-md-8 col-md-offset-2">
        <div class="list-group" >
            <div class="list-group-item active"><i class="fa fa-cog fa-spin"></i> Opciones Encontradas</div>
            @forelse($results as $result)
                @if($result['padre']!=null)
                <div class="list-group-item"><a href="/master/{{$result['url']}}">
                        <i class="fa fa-check  text-danger"></i>
                        <i class="{{$result['icons']}}"></i>{{$result['name']}}


                        &nbsp;&nbsp;&nbsp;<span class="badge bg-indigo-800">M&oacute;dulo {{$result['padre']}}</span>

                    </a>
                </div>
                @endif
            @empty
                <div class="list-group-item text-center">
                    <i class="fa fa-times fa-4x text-danger"></i><br/>NO HAY COINCIDENCIAS
                </div>
            @endforelse

        </div>
        <a class="btn btn-google btn-block" href="{{route('home')}}"><i class="icon-undo2"></i>REGRESAR</a>

    </div>
@endsection