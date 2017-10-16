<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 28/8/2017
 * Time: 10:59
 */

namespace UGCore\Core\Repositories\Uath;

use Utils;
use Messages;
use Alerts;
use DB;
use Auth;


class AprobacionPlanificacionRepository
{
    public function datosPlanificacion($user){
        return \Datatables::of(DB::connection('sqlsrv_bdrrhh')
            ->select( DB::raw("SELECT A.ID,A.IDAREA,A.IDMATRIZ,TOTAL,(B.NOMBRE+' ['+B.MESES+']') AS PERIODO,A.DESCRIPCION,A.ESTADO,'DESDE '+(CAST(A.FECHA_INICIO AS VARCHAR)+' HASTA '+CAST(A.FECHA_FIN AS VARCHAR)) AS FECHA,A.created_at FROM [HorasExtras].[Planificacion] A,[HorasExtras].[Periodo] B WHERE A.IDPERIODO=B.ID AND B.ESTADO='A' AND A.ESTADO<>'X' AND A.user_created= :user AND A.IDAREA= :unid"), array('user' => $user,'unid'=>$this->codigo_unidad_usuario($user))))
            ->add_column('OPCIONES', '<a class="label label-primary" href="{{ route(\'uath.horasextras.matriz\', $ID) }}"><span class="fa fa-newspaper-o"></span>&nbsp; Ver Matriz</a>')
            ->make(true);
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
}