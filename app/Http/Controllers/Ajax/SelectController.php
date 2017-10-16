<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 7/6/2017
 * Time: 18:40
 */

namespace UGCore\Http\Controllers\Ajax;

use UGCore\Http\Controllers\Controller;
use DB;

class SelectController extends Controller
{

    public function getStudentCarrera($nuic,$response='http'){
        $data=(DB::connection('sqlsrv_bdacademico')->select('exec SP_CONS_ESTUDIANTE_CARRERA ?',[$nuic]));
        $result=[];
        foreach ($data as $item){
            if($item->ESTADO =='A'){
                $result[trim($item->COD_CARRERA)]=trim($item->NOMBRE);
            }
        }
        return $this->transform($result,$response);
    }

        public function TitulacionParametro($parametro,$type='json')
    {
        $result = DB::connection('sqlsrv_BdTitulacion')
            ->table('TB_TIT_TIPO_PARAMETRO AS C')
            ->where('C.TIPO_APLICA', '=', $parametro)
            ->groupBy('C.COD_TIPO_PARAMETRO', 'C.DESCRIPCION')
            ->orderBy('C.DESCRIPCION', 'ASC')
            ->select(DB::raw('LTRIM(RTRIM(C.COD_TIPO_PARAMETRO)) AS CODIGO'),DB::raw('LTRIM(RTRIM(C.DESCRIPCION)) AS DESCRIPCION'))
            ;

        if($type=='json'){
            $result=$result->get('DESCRIPCION', 'CODIGO');
            $listaParametros['data']=$result;
            return response()->json($listaParametros, 200);
        }else{
            $result=$result->pluck('DESCRIPCION', 'CODIGO')->toArray();
           return $result;
        }

    

    }

  
    public function carreraFacultad($faculty,$type='json')
    {
        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_CARRERA AS C')
            ->where('C.NOACADE', '=', 0)
            ->where('C.COD_CCARRERA', '=', 1)
            ->where('C.COD_FACULTAD', '=', $faculty)
            ->groupBy('C.COD_CARRERA', 'C.NOMBRE')
            ->orderBy('C.NOMBRE', 'ASC')
            ->select(DB::raw('LTRIM(RTRIM(C.COD_CARRERA)) AS COD_CARRERA'), DB::raw('LTRIM(RTRIM(C.NOMBRE)) AS NOMBRE'))
            ;
        if($type=='json'){
            $result=$result->get('NOMBRE', 'COD_CARRERA');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('NOMBRE', 'COD_CARRERA')->toArray();
           return $result;
        }

    }

    public function  getfaculty($response='http'){
        $result=DB::connection('sqlsrv_bdacademico')
            ->table('TB_FACULTAD AS F')
            ->where('F.COD_FACULTAD', '<' ,'26')
            ->select('F.COD_FACULTAD AS COD_FACULTAD',DB::raw('RTRIM(F.NOMBRE) AS NOMBRE'))
            ->orderBy('NOMBRE','ASC')->pluck('NOMBRE','COD_FACULTAD')->toArray();

        return $this->transform($result,$response);
    }



    public function getNameMateriaCarreraFacultad($type, $arrayCode, $response = 'json')
    {
        switch ($type) {
            case 'MATERIA':
                $result = DB::connection('sqlsrv_bdacademico')
                    ->table('TB_MATERIA AS M')
                    ->join('TB_CARRERA AS C', 'C.COD_CARRERA', '=', 'M.COD_CARRERA')
                    ->whereIn('M.COD_MATERIA', $arrayCode)
                    ->select('M.COD_MATERIA', 'M.NOMBRE AS NOMB_MATERIA',
                        'C.COD_CARRERA', 'C.NOMBRE AS NOMB_CARRERA')
                    ->get();
                break;

            case 'FACULTAD':
                $result = DB::connection('sqlsrv_bdacademico')->table('TB_FACULTAD')
                    ->whereIn('COD_FACULTAD', $arrayCode)
                    ->select(DB::raw('RTRIM(LTRIM(COD_FACULTAD))AS COD_FACULTAD'), 'NOMBRE')
                    ->get();
                break;

            case 'CARRERA':
                $result = DB::connection('sqlsrv_bdacademico')
                    ->table('TB_CARRERA as C')
                    ->join('TB_FACULTAD as F', 'C.COD_FACULTAD', '=', 'F.COD_FACULTAD')
                    ->whereIn('C.COD_CARRERA', $arrayCode)
                    ->select(DB::raw('LTRIM(RTRIM(C.COD_CARRERA)) AS COD_CARRERA'), DB::raw('RTRIM(C.NOMBRE) AS NOMBRE_CARRERA'),DB::raw('LTRIM(RTRIM(F.COD_FACULTAD)) AS COD_FACULTAD'), DB::raw('RTRIM(F.NOMBRE) AS NOMBRE_FACULTAD'))
                    ->get();
                break;
        }

        return $this->transform($result,$response);
    }


    private function transform($result,$response){
        if (count($result) > 0) {
            if ($response == 'json') {
                return response()->json(['data' => $result], 200);
            } else {
                return $result;
            }
        } else {
            if ($response == 'json') {
                return response()->json(['No hay registros'], 404);
            } else {
                abort(401);
            }
        }
    }

    public function getPersons($scope,$response='http')
    {
	DB::connection('sqlsrv_bdacademico')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $result = DB::connection('sqlsrv_bdacademico')->select("Exec SP_BUSQUEDA_PERSONAS ?", [$scope]);
        return $this->transform($result,$response);
    }

    public function getCarrersAssigmentTeacher($nuic,$response='http'){
            $result=DB::connection('sqlsrv_bdacademico')->table('TB_DOCENTE_DACADEMICO AS D')
                ->join('TB_CARRERA AS C' ,'C.COD_CARRERA' ,'=' ,'D.COD_CARRERA')
            ->where('D.COD_DOCENTE','=',$nuic)->select('D.COD_CARRERA','C.NOMBRE')->get();
        return $this->transform($result,$response);
    }

    public function getAllTeacherByCareersAndActivty($career,$activity=null,$response='http'){
        $result =DB::connection('sqlsrv_bdacademico')->table("TB_HORARIO_ACTIVIDADES_DOCENTES as AD")
                    ->join('TB_DOCENTE_DPERSONAL AS DP','DP.COD_DOCENTE','=','AD.COD_DOCENTE')
                    ->whereIn('AD.COD_PLECTIVO',

                        DB::connection('sqlsrv_bdacademico')->table('TB_PLECTIVO as P')
                            ->whereIn('P.DESCRIPCION',
                                        DB::connection('sqlsrv_bdacademico')->table('TB_PLECTIVO as P')
                                        ->where('P.COD_CARRERA','=',$career)
                                        ->where('P.DESCRIPCION','NOT LIKE',"%PC%")
                                        ->where('P.DESCRIPCION','NOT LIKE',"%CN%")
                                        ->where('P.DESCRIPCION','NOT LIKE',"%AC%")
                                        ->where('P.ESTADO','=',"A")
                                        ->orderBy('P.COD_PLECTIVO','DESC')
                                        ->select('P.DESCRIPCION')
                                        ->take(1)->pluck('P.DESCRIPCION')->toArray()
                            )->where('P.COD_CARRERA','=',$career)->select('P.COD_PLECTIVO')->pluck('P.COD_PLECTIVO')->toArray())
                    ->select('AD.COD_DOCENTE' , DB::raw("DP.APELLIDO+' '+DP.NOMBRE AS NOMBRES"));

            if($activity!=null){
                $result=$result->where('AD.ID_ACTIVIDAD_DCTE',$activity);
            }
        $result=$result->distinct()
                    ->get();
        return $this->transform($result,$response);
    }
}
