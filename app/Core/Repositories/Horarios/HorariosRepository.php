<?php

namespace UGCore\Core\Repositories\Horarios;
use DB;

class HorariosRepository
{
    public function forFacultades($usuario){
        $listaFacultades=DB::connection('sqlsrv_bdacademico')
            ->table('TB_USUARIO_CARRERA as U')
            ->leftJoin('TB_CARRERA as C','C.COD_CARRERA','=','U.COD_CARRERA')
            ->leftJoin('TB_FACULTAD as F','C.COD_FACULTAD','=','F.COD_FACULTAD')
            ->leftJoin('TB_USUARIO as US','US.USUARIO','=','U.USUARIO')
            ->where('US.COD_EMPLEADO','=',$usuario)
            ->groupBy('F.COD_FACULTAD','F.NOMBRE')
            ->orderBy('F.NOMBRE','ASC')
            ->select('F.COD_FACULTAD', DB::raw('LTRIM(RTRIM(F.NOMBRE)) AS NOMBRE')) ->pluck('NOMBRE','COD_FACULTAD')->toArray();
        return $listaFacultades;
    }
    public function forCarreras($cod_facultad,$usuario){
        $listaCarreras=DB::connection('sqlsrv_bdacademico')
            ->table('TB_CARRERA AS C')
            ->leftJoin('TB_USUARIO_CARRERA as A','A.COD_CARRERA','=','C.COD_CARRERA')
            ->leftJoin('TB_USUARIO as B','B.USUARIO','=','A.USUARIO')
            ->where('C.NOACADE','=',0)
            ->where('C.COD_CCARRERA','=',1)
            ->where('C.COD_FACULTAD','=',$cod_facultad)
            ->where('B.COD_EMPLEADO','=',$usuario)
            ->groupBy('C.COD_CARRERA','C.NOMBRE')
            ->orderBy('C.NOMBRE','ASC')
            ->select('C.COD_CARRERA', DB::raw('LTRIM(RTRIM(C.NOMBRE)) AS NOMBRE')) ->pluck('NOMBRE','COD_CARRERA')->toArray();
        return $listaCarreras;
    }

    public function forPeriodos($cod_carrera){
        $listaPeriodos=DB::connection('sqlsrv_bdacademico')
            ->table('TB_PLECTIVO AS P')
            ->where(DB::raw('SUBSTRING(P.DESCRIPCION,1,4)'),'<=','2020')
            ->where('P.DESCRIPCION','NOT LIKE','%PC')
            ->where('P.DESCRIPCION','NOT LIKE','%PCS')
            ->where('P.DESCRIPCION','<>','\'2016 - 2018\'')
            //->whereIn('P.T_CALIFICA_S',array('T','S'))
            ->where('P.COD_CARRERA','=',$cod_carrera)
            ->groupBy('P.COD_PLECTIVO','P.DESCRIPCION')
            ->orderBy('P.COD_PLECTIVO','DESC')
            ->select(DB::raw('DISTINCT(P.COD_PLECTIVO) AS COD_PLECTIVO'), DB::raw('LTRIM(RTRIM(P.DESCRIPCION)) AS DESCRIPCION'))
            //->take(5)
            ->pluck('DESCRIPCION','COD_PLECTIVO')->toArray();
        return $listaPeriodos;
    }
}