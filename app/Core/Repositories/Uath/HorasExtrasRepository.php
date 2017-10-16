<?php

namespace UGCore\Core\Repositories\Uath;

use UGCore\Core\Entities\Uath\HorasExtrasPlanificacion;
use UGCore\Core\Entities\Uath\HorasExtrasPlanificacionEmpleado;
use UGCore\Core\Entities\Uath\HorasExtrasPlanificacionValAdicionales;
use Utils;
use Messages;
use Alerts;
use DB;
use Auth;

class HorasExtrasRepository
{
    public function forDatosFuncionario($cedula){
        DB::connection('sqlsrv_bdrrhh')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $info=$this->forDatosHorarioExistente($cedula);
       $date='';
        if(count($info)>0){
            $date=$info[0]->INICIO.'-'.$info[0]->FIN;
        }

        return \Datatables::of(DB::connection('sqlsrv_bdrrhh')
            ->table('VS_DATOS_GENERALES_HEXTRAS_UATH as A')
            ->where('A.CEDULA','=',$cedula)
            ->where('A.ESTADOREG','=','0')
            //->where('A.UNIDAD_UNIV','=',$this->codigo_unidad_usuario($cedula)) /*validación permisivo | autoritario*/
            ->orderBy('A.ESTADOREG')
            ->orderBy('A.FECHA_SYS')
            ->select('A.ID_DATOS_PERSONAL','A.CEDULA',DB::raw('A.APELLIDOS +\' \'+A.NOMBRES AS NOMBRES_COMPLETOS'),'A.CARGO','A.RMU','A.COD_UNIDAD','A.UNID_ADMIN_ACADEM','A.CAT_DCTE','A.FECHA_SYS','A.DIAS_TRAB_REG','A.MODALIDAD')
            ->take(1))
            ->add_column('HORA_JORD',$date)
            ->add_column('JORD_SEM','')
            ->make(true);
    }
    /*No es necesario*/
    public function forDatosFuncionarioHorario($cedula){
        DB::connection('sqlsrv_bdrrhh')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        return \Datatables::of(DB::connection('sqlsrv_bdrrhh')
            ->table('DETALLE_HORARIO as A')
            ->leftJoin('DATOS_PERSONAL as B','A.DATOS_PERSONAL','=','B.ID_DATOS_PERSONAL')
            ->leftJoin('ADMISION as C',
             function($join) {
                 $join->on('B.ID_DATOS_PERSONAL','=','C.DATOS_PERSONAL');
                 $join->on('B.CEDULA','=','C.CEDULA');
                 $join->on('C.IDADMISION','=','A.ADMISION');
             })
            ->where('B.CEDULA','=',$cedula)
            ->where('A.ESTADO','=','1')
            ->where('C.ESTADOREG','=','0')
            ->select('A.LUNES','A.MARTES','A.MIERCOLES','A.JUEVES','A.VIERNES','A.SABADO','A.DOMINGO'))
            ->make(true);
    }

    public function forDatosHorarioExistente($cedula){
        $info=DB::connection('sqlsrv_bdrrhh')->select( DB::raw("select SUBSTRING(D.HORARIO,1,CHARINDEX('-',D.HORARIO)-2) AS INICIO, SUBSTRING(D.HORARIO,CHARINDEX('-',D.HORARIO)+2,LEN(D.HORARIO)) AS FIN
            from [10.87.117.112].[DB_RRHH].[dbo].[DETALLE_HORARIO] as [A] 
            left join [10.87.117.112].[DB_RRHH].[dbo].[DATOS_PERSONAL] as [B] on [A].[DATOS_PERSONAL] = [B].[ID_DATOS_PERSONAL] 
            left join [10.87.117.112].[DB_RRHH].[dbo].[ADMISION] as [C] on [B].[ID_DATOS_PERSONAL] = [C].[DATOS_PERSONAL] and [B].[CEDULA] = [C].[CEDULA] and [C].[IDADMISION] = [A].[ADMISION] 
            left join [10.87.117.112].[DB_RRHH].[dbo].[CONTROL_ASISTENCIA] as [D] on [C].[IDADMISION] = [D].[ADMISION] 
            where [B].[CEDULA] = :cedula and [A].[ESTADO] = 1 and [C].[ESTADOREG] = 0 and [D].[HORARIO] <> '00:00 - 00:00' and [D].[HORARIO] <>  ''
            group by [D].[HORARIO]"), array('cedula' => $cedula));
        return $info;
    }

    public function forDependenciasUnidad($cedula){
        $datos = DB::connection('sqlsrv_bdrrhh')->select( DB::raw(" SELECT UNIDAD_UNIV,UNID_ADMIN_ACADEM FROM [10.87.117.112].[DB_RRHH].[dbo].[ADMISION] WHERE UNIDAD_UNIV IN (:codigo_unidad)"), array('codigo_unidad' => $this->codigo_unidad_usuario($cedula)));
        $dependecias=[$datos[0]->UNIDAD_UNIV=>$datos[0]->UNID_ADMIN_ACADEM];
        return $dependecias;
    }

    public function codigo_unidad_usuario($cedula){
        $codUnid=DB::connection('sqlsrv_bdrrhh')->select( DB::raw(" SELECT TOP 1 B.UNIDAD FROM [10.87.117.112].[DB_RRHH].[dbo].[DATOS_PERSONAL] A,[10.87.117.112].[DB_RRHH].[dbo].[TB_USUARIO] B 
          WHERE A.ID_DATOS_PERSONAL=B.DATOS_PERSONAL AND A.CEDULA= :user"), array('user' => $cedula));
        if($codUnid==[]){
            return '0';
        }
        else{
            return $codUnid[0]->UNIDAD;
        }
    }

    public function forCreatePlanificacion($uni,$fec,$des){
        $fechas=explode(" | ",$fec);
        $mes1=explode("-",$fechas[0]);
        $valor1=intval($mes1[1]);
        $mes1=explode("-",$fechas[1]);
        $valor2=intval($mes1[1]);
        $per=0;
        if($valor1>=1 && $valor2<=4){
            $per=1;
        }
        if($valor1>=5 && $valor2<=8){
            $per=2;
        }
        if($valor1>=9 && $valor2<=12){
            $per=3;
        }

        $existe=$this->verificaPlanificacionArea($uni,$per);
        if (is_null($existe)){
            $cod_matriz='PLA_HE_'.$uni.'_'.$fechas[0].'_'.$fechas[1].'_'.$per.'_'.rand(1,9999);
            $array_response=[];
            $array_response['status']=200;
            $array_response['message']='Planificación generada correctamente: ' .$cod_matriz;
            $planificacion= new HorasExtrasPlanificacion();
            if($uni!='' & $per!='' & $fec!='' & $des!=''){
                $planificacion->IDAREA=$uni;
                $planificacion->IDMATRIZ=$cod_matriz;
                $planificacion->IDPERIODO=$per;
                $planificacion->DESCRIPCION=strtoupper($des);
                $planificacion->ESTADO='C';
                $planificacion->FECHA_INICIO=$fechas[0];
                $planificacion->FECHA_FIN=$fechas[1];
                $planificacion->TOTAL='0.00';
                $planificacion->user_created=Auth::user()->name;
                $planificacion->user_modificated='';
                $planificacion->save();
            }
            else{
                $array_response['status']=404;
                $array_response['message']='Hubo un error al procesar los datos';
            }
        }
        else{
            $array_response['status']=404;
            $array_response['message']='Ya existe una planificacion ingresada en el período seleccionado';
        }
        return $array_response;
    }

    public function datosPlanificacion($user){
        return \Datatables::of(DB::connection('sqlsrv_bdrrhh')
            ->select( DB::raw("SELECT A.ID,A.IDAREA,A.IDMATRIZ,TOTAL,(B.NOMBRE+' ['+B.MESES+']') AS PERIODO,A.DESCRIPCION,A.ESTADO,'DESDE '+(CAST(A.FECHA_INICIO AS VARCHAR)+' HASTA '+CAST(A.FECHA_FIN AS VARCHAR)) AS FECHA,A.created_at FROM [HorasExtras].[Planificacion] A,[HorasExtras].[Periodo] B WHERE A.IDPERIODO=B.ID AND B.ESTADO='A' AND A.ESTADO<>'X' AND A.user_created= :user AND A.IDAREA= :unid"), array('user' => $user,'unid'=>$this->codigo_unidad_usuario($user))))
            ->add_column('OPCIONES', '<a class="label label-primary" href="{{ route(\'uath.horasextras.matriz\', $ID) }}"><span class="fa fa-newspaper-o"></span>&nbsp; Ver Matriz</a>
                                 <br/><a class="label label-primary" href="{{ route(\'uath.horasextras.empleados\', $ID) }}"><span class="fa fa-gear"></span>&nbsp; Agregar empleados</a>
                                   <br/><a class="label label-danger" onclick="eliminaPlanificacion({{$ID}})"><span class="fa fa-times"></span>&nbsp; Eliminar Planificación</a>')
            ->make(true);
    }

    public function delPlanificacion($id){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Planificación eliminada correctamente';
        $UpEstado=HorasExtrasPlanificacion::where('ID','=',$id)
            ->where('ESTADO','=','C')
            ->update(['ESTADO' => 'X','user_modificated' => Auth::user()->name,'updated_at' => Utils::getDateSQL()]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo realizar la transacción';
        }
        return $array_response;
    }

    public function delEmpleado($id){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Empleado eliminado correctamente';
        $UpEstado=HorasExtrasPlanificacionEmpleado::where('ID','=',$id)
            ->where('ESTADO','=','A')
            ->update(['ESTADO' => 'X','user_modificated' => Auth::user()->name,'updated_at' => Utils::getDateSQL()]);
        if($UpEstado==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo realizar la transacción';
        }
        return $array_response;
    }

    public function verificaPlanificacionArea($area,$periodo){
        $existe=HorasExtrasPlanificacion::where('IDAREA','=',$area)
            ->where('ESTADO','<>','X')
            ->where('IDPERIODO','=',$periodo)
            ->first();
        return $existe;
    }

    public function agregaEmpleadoPlanificacion($datosper,$datoshoras,$datosvalores,$datosvarios){
        $datospersonales_=explode(';',$datosper);
        $datoshoras_=explode(';',$datoshoras);
        $datosvalores_=explode(';',$datosvalores);
        $datosvarios_=explode(';',$datosvarios);
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Empleado: '.$datospersonales_[2].' ingresado correctamente';

        $existe=HorasExtrasPlanificacionEmpleado::where('ESTADO','=','A')
            ->where('CEDULA','=',$datospersonales_[1])
            ->where('IDPLANIFICACION','=',$datospersonales_[0])
            ->first();
        if(is_null($existe)){
            $registro=new HorasExtrasPlanificacionEmpleado();
            $registro->IDPLANIFICACION=$datospersonales_[0];
            $registro->ID_DATOS_PERSONAL=$datosvarios_[2];
            $registro->TIPO=$datospersonales_[5];
            $registro->CEDULA=$datospersonales_[1];
            $registro->NOMBRES_COMPLETOS=$datospersonales_[2];
            $registro->CARGO=$datospersonales_[3];
            $registro->RMU=$datospersonales_[4];
            $registro->HORARIO=$datospersonales_[6];
            $registro->DTRABREG=$datospersonales_[7];
            $registro->MODALIDAD=substr($datospersonales_[8],0,1);
            $registro->HORAS_JORNADA=$datospersonales_[9];
            $registro->HE=$datoshoras_[0];
            $registro->HS=$datoshoras_[1];
            $registro->HN=$datoshoras_[2];
            $registro->VHE=$datosvalores_[1];
            $registro->VHS=$datosvalores_[3];
            $registro->VHN=$datosvalores_[5];
            $registro->MONTO=$datosvalores_[6];
            $registro->ACTIVIDAD=strtoupper($datosvarios_[0]);
            $registro->UBICACION=strtoupper($datosvarios_[1]);
            $registro->ESTADO='A';
            $registro->user_created=Auth::user()->name;
            $registro->user_modificated='';
            $registro->save();
        }
        else{
            $array_response['status']=404;
            $array_response['message']='Empleado: '.$datospersonales_[2].', ya esta registrado en la planificación';
        }
        return $array_response;
    }

    public function forDatosEmpleadosMatriz($idplanificacion){
        $estado=$this->verEstadoMatriz($idplanificacion);
        if($estado!='E'){
            return \Datatables::of(DB::connection('sqlsrv_bdrrhh')
                ->table('HorasExtras.Planificacion_Empleados as A')
                ->where('A.IDPLANIFICACION','=',$idplanificacion)
                ->where('A.ESTADO','=','A')
                ->get())
                ->add_column('ACCIONES','<label class="btn btn-primary btn-sm"  id="edemp" data-popup="tooltip" data-placement="bottom" data-original-title="Editar" onclick="actualizaEmpleado({{$ID}})"><i class="fa fa-edit"></i></label>
                    <label class="btn btn-danger btn-sm" id="delemp" data-popup="tooltip" data-placement="bottom" data-original-title="Eliminar" onclick="eliminaEmpleado({{$ID}})"><i class="fa fa-eraser"></i></label>')
                ->make(true);
        }
        else{
            return \Datatables::of(DB::connection('sqlsrv_bdrrhh')
                ->table('HorasExtras.Planificacion_Empleados as A')
                ->where('A.IDPLANIFICACION','=',$idplanificacion)
                ->where('A.ESTADO','=','A')
                ->get())
                ->add_column('ACCIONES','<label></label>
                    <label></label>')
                ->make(true);
        }
    }

    public function datosPlanificacionPdf($idpla,$tipo){
        $info=DB::connection('sqlsrv_bdrrhh')
            ->table('HorasExtras.Planificacion_Empleados as A')
            ->where('A.IDPLANIFICACION','=',$idpla)
            ->where('A.TIPO','=',$tipo)
            ->where('A.ESTADO','=','A')
            ->get()->toArray();
        return $info;
    }

    public function planificacionAreaId($idpla){
        $existe=DB::connection('sqlsrv_bdrrhh')
            ->table('HorasExtras.Planificacion as A')
            ->where('A.ID','=',$idpla)
            ->whereIn('A.ESTADO',array('C','E'))
            ->get()->toArray();
        return $existe;
    }

    public function forDependenciasNombreUnidad($cedula){
        $datos = DB::connection('sqlsrv_bdrrhh')->select( DB::raw(" SELECT UNIDAD_UNIV,UNID_ADMIN_ACADEM FROM [10.87.117.112].[DB_RRHH].[dbo].[ADMISION] WHERE UNIDAD_UNIV IN (:codigo_unidad)"), array('codigo_unidad' => $this->codigo_unidad_usuario($cedula)));
        $dependecias=$datos[0]->UNID_ADMIN_ACADEM;
        return $dependecias;
    }

    public function sumaTotalesCodLos($idpla,$tipo){
        $total=HorasExtrasPlanificacionEmpleado::where('IDPLANIFICACION','=',$idpla)
            ->where('TIPO','=',$tipo)
            ->select(DB::raw('ISNULL(SUM(MONTO),\'0.00\') AS MONTO'))
            ->pluck('MONTO')->toArray();
        return $total[0];
    }

    public function extraeValAdicionalesCod($idpla){
        $totalCodTrabajo=HorasExtrasPlanificacionValAdicionales::where('IDPLANIFICACION','=',$idpla)
            ->where('ESTADO','=','A')
            ->select('VALHEXTRAS','VALDECTER','VALAPORPAT','VALFONRES','TOTALAD')
            ->get()->toArray();
        if($totalCodTrabajo==[]){
            $totalCodTrabajo['0']=['VALHEXTRAS'=>'0.00'];
        }
        return $totalCodTrabajo[0];
    }

    public function enviaMatrizAp($idpla){
        $array_response=[];
        $array_response['status']=200;
        $array_response['message']='Matriz enviada correctamente';
        /*VALORES ADICIONALES PARA CÓDIGO DE TRABAJO*/
        $totalCodTrab=$this->sumaTotalesCodLos($idpla,'CÓD. TRABAJO');
        $totalLosep=$this->sumaTotalesCodLos($idpla,'LOSEP');
        $totalAdCodTrab=$totalCodTrab+(($totalCodTrab/12)+(($totalCodTrab*12.15)/100)+($totalCodTrab/12));
        $datos_adicionales=new HorasExtrasPlanificacionValAdicionales();
        $datos_adicionales->IDPLANIFICACION=$idpla;
        $datos_adicionales->VALHEXTRAS=$totalCodTrab;
        $datos_adicionales->VALDECTER=$totalCodTrab/12;
        $datos_adicionales->VALAPORPAT=($totalCodTrab*12.15)/100;
        $datos_adicionales->VALFONRES=$totalCodTrab/12;
        $datos_adicionales->TOTALAD=$totalAdCodTrab;
        $datos_adicionales->ESTADO='A';
        $datos_adicionales->user_created=Auth::user()->name;
        $datos_adicionales->save();
        /*FIN VALORES ADICIONALES*/

        $UpEstado=HorasExtrasPlanificacion::where('ID','=',$idpla)
            ->where('ESTADO','=','C')
            ->update(['TOTAL'=>$totalLosep+$totalAdCodTrab,'ESTADO' => 'E','user_modificated' => Auth::user()->name,'updated_at' => Utils::getDateSQL()]);
        if($UpEstado==0 && $totalCodTrab==0){
            $array_response['status']=404;
            $array_response['message']='No se pudo realizar la transacción';
        }
        return $array_response;
    }

    public function verEstadoMatriz($idpla){
        $info=DB::connection('sqlsrv_bdrrhh')
            ->table('HorasExtras.Planificacion as A')
            ->where('A.ID','=',$idpla)
            ->select('A.ESTADO')
            ->get()->toArray();
        return $info[0]->ESTADO;
    }
}