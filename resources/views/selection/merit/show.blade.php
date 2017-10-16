@extends('layouts.back')
@section('masterTitle')
Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
FORMULARIO DE REGISTRO DE RECEPCIÓN DE DOCUMENTOS PARA LA SELECCI&Oacute;N DE PERSONAL
@endsection
@section('mainBox')
    <div class="col-lg-12 text-right">

        @if($objResponseMaster!=null)
            @if($objResponseMaster->status=='F')
                <a   href="{{ route('process.user.report.template',$objConfig->id) }}"  class="btn bg-teal-400"><i class="icon-download position-left"></i>Descargar Formulario</a>
            @else
                <a onclick="return sendDocument('cerrar formulario?, recuerde que una vez cerrado ya no podrá editar su informaci\u00F3n',
                        '{{ route('process.user.finish',$objConfig->id) }}')"  class="btn bg-indigo-400"><i class="icon-lock2 position-left"></i>Enviar Postulaci&oacute;n</a>
            @endif
        @endif
    </div>

@endsection



@section('mainContent')
    <?php $style='VIEW';?>
    @include('selection.merit.report')
      <div class="text-right">
    <a href="{{route('process.user.index')}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
    </div>
    @include('selection.modals.viewlinkpdf')
@endsection
@section('masterJsCustom')
    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('js/modules/selection/merit.js')!!}
@endsection


@section('masterCssCustom')
    {!!Html::style('/css/datatables.css')!!}
    {!!Html::style('plugins/fileinput/fileinput.min.css')!!}
@endsection