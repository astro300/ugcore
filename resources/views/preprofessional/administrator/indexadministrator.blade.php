@extends('layouts.back')
@section('masterTitle')
    MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
    ADMINISTRADOR
@endsection
@section('masterDescription')
    Panel Principal del Administrador
@endsection
@section('mainContent')
    @if(!$flag=="true")


            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary panel-flat">
                    <div class="panel-heading">
                        <div class="panel-title text-bold">ADMINISTRADOR</div>
                    </div>
                    <div class="panel-body">
                        @if($facultid=="")
                        {!! Form::open(['route'=> 'preprofessional.prospects.indexadministratornew','method'=>'POST', 'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-lg-2">
                                {!! Form::label('careers','CARRERA:',["class"=>"text-bold control-label"]) !!}
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" name="carrers">
                                    @foreach ($getresultevaluation as $getresultevaluations)
                                        <option value="{{$getresultevaluations->COD_CARRERA}}">{{$getresultevaluations->NOMBRE_CARRERA}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div style="text-align: center;">
                                    {!! Form::button('<b><i class="glyphicon glyphicon-search"></i></b> BUSCAR', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        {!! Form::close() !!}
                        @else
                            <hr>

                            <div class="col-lg-12">
                                    <div class="col-md-6">
                                       <div class="box box-widget text-center">
                                            <div class="box-header " style="background-color: #ECF0F5">
                                                <h6><i class="fa fa-address-book-o fa-4x"></i></h6>
                                            </div>
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-sm-12 border-right">
                                                        <div class="description-block">
                                                            <a href="{{ route('preprofessional.prospects.index',[$facultid,$carrers])}}" class="btn btn-primary dropdown-toggle">SOLICITUDES</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box box-widget text-center">
                                            <div class="box-header" style="background-color: #ECF0F5">
                                                <h6><i class="fa fa-black-tie fa-4x"></i></h6>
                                            </div>
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-sm-12 border-right">
                                                        <div class="description-block">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-primary">PRÁCTICAS INST.</button>
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="{{ route('preprofessional.practices.index',[$facultid,$carrers])}}"><i class="glyphicon glyphicon-ok"></i>INSITUCIONES</a></li>
                                                                    <li><a href="{{ route('preprofessional.practices.documents',[$facultid,$carrers])}}"><i class="glyphicon glyphicon-upload"></i>SUBIR DOCUMENTOS</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>

    @endif
@endsection