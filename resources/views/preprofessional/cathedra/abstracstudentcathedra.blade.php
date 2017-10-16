@extends('layouts.back')
@section('masterTitle')
MODULO PRE-PROFESIONALES
@endsection
@section('masterTitleModule')
   ASIGNAR NOTAS DE LAS CATEDRAS INTEGRADAS
@endsection
@section('masterDescription')
  Panel de asignacion de notas a estudiantes de las catredas integradas
@endsection

@section('mainContent')
                        
@if(!$flag=="true")
                        <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="text-semibold text-bold" style="text-align:center;">RESUMEN ASIGNACION CATEDRA INTEGRADORA</h5>
                                </div>
                        <div class="panel-body">  
                            <div class="table-responsive">
                            <table class="table table-bordered" >
                                    <tbody>
                                        <tr>
                                            <td width="20%" height="20%">CEDULA</td>
                                            <td width="50%" height="50%">{{$documentstudent}}</td>
                                        </tr>
                                        <tr>
                                            <td>CATEDRA</td>
                                            <td>{{UGCore\Library\Utils::showCathedra($nameCatedra)}}</td>
                                        </tr>
                                        <tr>
                                            <td>ESTUDIANTE</td>
                                            <td>{{$new_name_estu}}</td>
                                        
                                        </tr>
                                        <tr>
                                            <td>PERIODO</td>
                                            <td>{{$catperiod}}</td>
                                        
                                        </tr>
                                        <tr>
                                            <td>CICLO</td>
                                            <td>{{$catcycle}}</td>
                                        
                                        </tr>
                                        <tr>
                                            <td>TUTOR</td>
                                            <td>{{$Namestutor}}</td>
                                        
                                        </tr>
                                    </tbody>
                            </table> 
                            </div>
                            <br>
                            <div class="text-center">
                                           
                                 <a href="{{ route('preprofessional.cathedra.index',array($faculty,$career))}}" class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                            </div>                             

                        </div>

@endif
@endsection