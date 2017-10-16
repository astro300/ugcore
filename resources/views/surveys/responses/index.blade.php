@extends('layouts.back')
@section('masterTitle')
    Encuestas-UG
@endsection
@section('masterTitleModule')
    Encuestas-UG
@endsection
@section('masterDescription')
    Pantalla de bienvenida a las Encuestas.
@endsection

@section('mainContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categor&iacute;a</th>
                    <th>Fecha de Vigencia</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($surveys as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->categorysurvey->name }}</td>
                        <td>{{ $item->getDateCarbon()}}</td>

                        <td>
                            <button onclick="alertConfirmAction('participaci&oacute;n en la encuesta','{{route('surveys.response_survey.accept',$item->slug)}}')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square"></i>&nbsp;PARTICIPAR</button>
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="text-center">NO HAY REGISTROS</td>
                @endforelse
                </tbody>
            </table>
        </div>
        {!! $surveys->render() !!}
    </div>
   <div class="col-lg-10 col-lg-offset-1">
       <hr/>
       <div class="callout" style="background: #F5F8FA;">
           <h4>Encuestas En las que participas!</h4>
           <p class="text-danger">A continuaci&oacute;n se presentar&aacute; el listado de las encuestas en las que has tenido participaci&oacute;n</p>
       </div>
   </div>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categor&iacute;a</th>
                    <th>Fecha de &Uacute;ltima Respuesta</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($dataHeadResponseSurveys as $item)
                    <tr>
                        <td>{{ $item->survey->name }}</td>
                        <td>{{ $item->survey->categorysurvey->name }}</td>
                        <td>{{ $item->getDateResponseLastCarbon()}}</td>
                        <td>{{ $item->getFullStatus()}}</td>
                        <td>
                            @switch($item->status_response)
                            @case('C')
                            <button onclick="alertConfirmAction('continuar con la encuesta','{{route('surveys.response_survey.accept',$item->survey->slug)}}')" class="btn btn-warning btn-xs"><i class="fa fa-spinner fa-spin"></i>&nbsp;CONTINUAR</button>
                            @breakswitch
                            @case('F')
                            <a  class="btn btn-success btn-xs"><i class="fa fa-eye "></i>&nbsp;VISUALIZAR</a>
                            @breakswitch
                            @endswitch
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="text-center">NO HAY REGISTROS</td>
                @endforelse
                </tbody>
            </table>
        </div>
        {!! $dataHeadResponseSurveys->render() !!}
    </div>

@endsection
@section('masterCssCustom')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endsection

