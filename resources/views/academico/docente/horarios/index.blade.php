@extends('layouts.back')
@section('masterTitle')
    Planificación Académica
@endsection
@section('masterTitleModule')
    Planificación Académica
@endsection
@section('masterDescription')
    Creación de Horarios
@endsection
@section('mainContent')
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                {!! Form::open(['id'=>'formasigna',null,'method'=>'POST', 'class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Facultad</label>
                        <div class="col-lg-9">
                            {!! Form::select('hfacultad', $listaFacultad, null,['class' => 'form-control select-search','placeholder'=>'-Seleccione-','required' => 'required',"id"=>'hfacultad']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Carrera</label>
                        <div class="col-lg-9">
                            {!! Form::select('hcarrera',[], null,['class' => 'form-control select2','empty'=>'-Seleccione-','required' => 'required',"id"=>'hcarrera']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Período Lectivo</label>
                        <div class="col-lg-9">
                            {!! Form::select('hplectivo', [], null,['class' => 'form-control select2','placeholder'=>'-Seleccione-','required' => 'required',"id"=>'hplectivo']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Hora Inicio / Fin</label>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                <div id="drag" ondrop="drop(event)" ondragover="allowDrop(event)" >
                                    {!! Form::time('tiempo', '',  ["required"=>"required","class"=>"form-control",'id'=>'tiempo',"autocomplete"=>"off","redonly"=>"redonly","draggable"=>"true","ondragstart"=>"start(event)"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-responsive table-striped table-bordered">
                            <thead class="bg-primary-600">
                                <th style="text-align: center"><b>Hora</b></th>
                                <th style="text-align: center"><b>Lunes</b></th>
                                <th style="text-align: center"><b>Martes</b></th>
                                <th style="text-align: center"><b>Miércoles</b></th>
                                <th style="text-align: center"><b>Jueves</b></th>
                                <th style="text-align: center"><b>Viernes</b></th>
                                <th style="text-align: center"><b>Sábado</b></th>
                            </thead>
                            <tbody  id="thorario" >
                                <tr align="center">
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                    <td><span ondrop="return clonar(event)" ondragover="allowDrop(event)" class="context-menu-one btn" style="background-color: #EDECFC;border: dotted"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
@endsection
@section('masterJsCustom')
    {!!Html::script('/js/modules/academico/Horarios/eventosHorarios.js')!!}
    {!!Html::script('https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js')!!}
    {!!Html::style('https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css')!!}
@endsection
<style>
    #drag {
        text-align: center;
        width: 100px;
        height: 35px;
        margin: 10px;
        /*padding: 5px;*/
        /*border: 1px solid black;*/
    }

</style>