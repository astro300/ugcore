@extends('layouts.back')
@section('masterTitle')
    Configuraciones
@endsection
@section('masterTitleModule')
   DATOS DEL ESTUDIANTE
@endsection
@section('masterDescription')
    descripc
@endsection

@section('mainContent')
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">PERIODOS DE TITULACIÓN </div>
          {!! Form::open(['route'=>'titulacion.configuraciones.store', 'enctype'=>'multipart/form-data']) !!} 
            <div class="panel-body">
			{!! Field::select('modulo',$modulo,null,['empty'=>'seleccione','class'=>'select2','label'=>'MODULO: '])!!}
			{!! Field::select('etapa',[],null,['class'=>'select2','label'=>'ETAPA:','empty'=>'-SELECCIONE-']) !!}
			{!! Field::select('facultad',$faculties,null,['empty'=>'seleccione','class'=>'select2','label'=>'FACULTAD: '])!!}
			{!! Field::select('carrera',[],null,['class'=>'select2','label'=>'CARRERA: ']) !!}
			{!! Field::select('ciclo',$ciclo,['class'=>'select2','label'=>'CICLO:','empty'=>'-SELECCIONE-']) !!}	


				               
 				<label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Inicio</label>
 				<div class="input-group">

                {!! Form::text('fecha_inicio',' ',['class'=>'form-control pickadate','id'=>'fechai','placeholder'=>'Seleccione fecha ', ""]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-calendar text-muted"></i></span>
                </div>
                <br/>
                <label class="col-lg-3 control-label text-bold"><i
                                                                    class="text-danger">*</i> Fin</label>
 				<div class="input-group">

                {!! Form::text('fecha_final',' ',['class'=>'form-control pickadate','id'=>'fechaf','placeholder'=>'Seleccione fecha ', ""]) !!}
                                                                <span class="input-group-addon"><i
                                                                            class="icon-calendar text-muted"></i></span>
                </div>


            </div>
            <div class="panel-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
    <div class="col-lg-7">
        <div class="table-responsive">
                <table class="table table-bordered bg-white" id="datosUsuarios">
                        <thead>
                            
                            <th>CARRERA</th>
                             <th>CICLO</th>
                            <th>ETAPA</th>

                             <th>FECHA DE INICIO</th>
                              <th>FECHA FINAL</th>

                            <th>ACCIONES</th>
                        </thead>
                </table>
        </div>
    </div>
@endsection
@section('masterJsCustom')
 {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/fileinput/fileinput.min.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}

    <script src="{{asset('/js/modules/titulacion/datos.js')}}"></script>
    <script>
    	 $('.pickadate').datepicker({
        formatSubmit: 'yyyy-mm-dd',
        format: 'yyyy-mm-dd',
        selectYears: true,
        editable: true,
        autoclose: true,
        orientation:'top'
    });

    </script>
@endsection
@section('masterCssCustom')
	{!!Html::style('/css/datatables.css')!!}
    {!!Html::style('/plugins/fileinput/fileinput.min.css')!!}
    {!!Html::style('/plugins/datepicker/datepicker3.css')!!}
    {!! Html::style('/css/checkbox.css') !!}

@endsection

