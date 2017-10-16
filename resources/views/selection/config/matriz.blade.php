@extends('layouts.back')
@section('masterTitle')
    Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterTitleModule')
    Matrices para Configuraciones del Proceso de Selecci&oacute;n de Personal
@endsection
@section('masterDescription')
    Panel de Configuraci&oacute;n de matrices del Proceso ingrese los campos necesarios
@endsection

@section('mainContent')
    <div class="col-lg-8 col-lg-offset-2">
        {!! Form::open(['route'=> ['selection.config.saveOrUpdateMatriz',$concourseConfig->id,$matrizConcourseConfig->id],'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">Matriz
                    para {{ $concourseConfig->title  }}</h5>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    {!! Field::select('facultad_id', $faculties,$matrizConcourseConfig->facultad_id,['empty'=>'-Seleccione-','label'=>'Facultad:','class'=>'select2','required'=>'required']) !!}

                </div>

                <div class="col-lg-6">
                    {!! Field::select('fieldExtends', $fieldsExtends,$matrizConcourseConfig->extends_id,['empty'=>'-Seleccione-','label'=>'Campo Amplio:','class'=>'select2','required'=>'required']) !!}

                </div>
                <div class="col-lg-6">
                    {!! Field::select('fieldSpecific', $fieldSpecific,$matrizConcourseConfig->specific_id,['empty'=>'-Seleccione-','label'=>'Campo Espec&iacute;fico:','class'=>'select2','required'=>'required']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::select('fieldDetailed',$fieldDetailed,$matrizConcourseConfig->detail_id,['empty'=>'-Seleccione-','label'=>'Campo Detallado:','class'=>'select2','required'=>'required']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Field::select('fieldDisciplines[]', $fieldDisciplines,$selectFieldDiscipline,['id'=>'fieldDisciplines','multiple'=>true,'empty'=>'-Seleccione-','label'=>'Disciplinas:','class'=>'select2','required'=>'required']) !!}
                </div>
                <div class="col-lg-6">

                    {!! Field::number('fieldVacanciesTC', $matrizConcourseConfig->max_tc,['min'=>0,'placeholder'=>'# de vacantes a tiempo completo','label'=>'Vacantes Tiempo Completo:','required'=>'required']) !!}
                </div>
                <div class="col-lg-6">

                    {!! Field::number('fieldVacanciesMT', $matrizConcourseConfig->max_tm,['min'=>0,'placeholder'=>'# de vacantes a medio tiempo','label'=>'Vacantes Medio Tiempo:','required'=>'required']) !!}

                </div>


                <div class="col-lg-6 col-lg-offset-3 text-center">
                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR',
                array('type' => 'submit', 'class' => 'btn btn-primary warning-300  ')) !!}
                <a href="{{route('selection.config.index')}}" class="btn btn-danger warning-300  "><b><i
                                class=" icon-undo2 position-left"> </i></b>CANCELAR</a>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <hr/>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover" id="tableDataConcourseConfig">
                <thead>
                <tr>
                    <th style="text-align:center;vertical-align: middle" rowspan="2">Facultad</th>
                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Amplio</th>
                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Espec&iacute;fico</th>
                    <th style="text-align:center;vertical-align: middle" rowspan="2" >Campo Detallado</th>
                    <th style="text-align:center;vertical-align: middle" rowspan="2">Campo Disciplinas</th>
                    <th style="text-align:center;vertical-align: middle" colspan="2">Tiempo Dedicaci&oacute;n</th>
                    <th style="text-align:center;vertical-align: middle" rowspan="2">Acciones</th>
                </tr>
                <tr>
                    <th style="text-align:center;vertical-align: middle" >TC</th>
                    <th style="text-align:center;vertical-align: middle" >MT</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($concourseMatriz as $matriz)
                        <tr>
                            <td style="text-align: center">{{@$faculties[$matriz->facultad_id]}}</td>
                            <td style="text-align: center">{{$matriz->extendsField->description}}</td>
                            <td style="text-align: center">{{$matriz->specificField->description}}</td>
                            <td style="text-align: center">{{$matriz->detailField->description}}</td>
                            <td style="text-align: center">
                                @foreach($matriz->concourseMatrizDetail as $discipline)
                                    {{$discipline->disciplineField->description  }}<br/>
                                @endforeach

                            </td>
                            <td style="text-align: center">{{$matriz->max_tc}}</td>
                            <td style="text-align: center">{{$matriz->max_tm}}</td>
                            <td style="text-align: center">
                                <a data-popup="popover-custom" title="Acciones:"
                                   data-trigger="hover"
                                   data-content="Al seleccionar esta opci&oacute;n se podrá editar el registro"
                                   data-placement="bottom"
                                   href="{{route('selection.config.matriz',[$concourseConfig->id,$matriz->id])}}"><i class="fa fa-pencil"></i></a>

                                <a data-popup="popover-custom" title="Acciones:"
                                   data-trigger="hover"
                                   data-content="Al seleccionar esta opci&oacute;n se podr&aacute; eliminar el registro"
                                   data-placement="bottom"
                                   class="text-danger"
                                   onclick="return alertConfirmDelete('el registro','{{ route('selection.delete.matriz',[$concourseConfig->id,$matriz->id])}}')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="8" style="text-align: center"> NO HAY REGISTROS DISPONIBLES </td></tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('masterJsCustom')
    <script>
        $(function(){


            $("#fieldExtends").on('change', function () {
                selectDependent('#fieldExtends','#fieldSpecific','0',false);
            });
            $("#fieldSpecific").on('change', function () {
                selectDependent('#fieldSpecific','#fieldDetailed','0',false);
            });

            $("#fieldDetailed").on('change', function () {
                selectDependent('#fieldDetailed','#fieldDisciplines','0',true);
            });

            $('[data-popup=popover-custom]').popover({
                template: '<div class="popover border-teal-400"><div class="arrow"></div><h3 class="popover-title bg-teal-400"></h3><div class="popover-content"></div></div>'
            });

        });


    </script>

@endsection

@section('masterCssCustom')
    {!!Html::style('css/datatables.css')!!}
@endsection