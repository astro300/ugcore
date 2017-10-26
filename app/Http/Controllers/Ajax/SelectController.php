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

     



  
    public function carreraFacultad($faculty,$type='json')
    {
        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_CARRERA AS C')
            ->where('C.NOACADE', '=', 0)
            ->where('C.COD_CCARRERA', '=', 1)
            ->where('C.ESTADO_CARRERA','=','A')
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
    //modulo de titulacion

    public function SearchPerson($cedula,$type='json')
    {
      
        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_ESTUDIANTE_DPERSONAL AS C')
            ->where('C.COD_ESTUDIANTE','=',$parametros)
            ->select('C.COD_ESTUDIANTE AS COD_ESTUDIANTE')
            ->select(DB::raw("C.APELLIDO +' '+ C.NOMBRE AS NOMBRE_ESTUDIANTE"));
            
        if($type=='json'){
            $result=$result->get('COD_ESTUDIANTE','NOMBRE_ESTUDIANTE');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('COD_ESTUDIANTE','NOMBRE_ESTUDIANTE')->toArray();
           return $result;
        }
    }

        public function SearchPerson_Titulacion($cedula,$type='json')
    {
      
        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_ESTUDIANTE_DPERSONAL AS C')
            ->where('C.COD_ESTUDIANTE','=',$cedula)
          ->join('BdAcademico.dbo.TB_TIT_MATRICULA AS TB_TIT_MATRICULA','TB_TIT_MATRICULA.NUM_IDENTIFICACION','=','C.COD_ESTUDIANTE')
        
            ->select('C.COD_ESTUDIANTE AS COD_ESTUDIANTE')
            ->select(DB::raw("C.APELLIDO +' '+ C.NOMBRE AS NOMBRE_ESTUDIANTE"));
            
        if($type=='json'){
            $result=$result->get('COD_ESTUDIANTE','NOMBRE_ESTUDIANTE');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('COD_ESTUDIANTE','NOMBRE_ESTUDIANTE')->toArray();
           return $result;
        }
    }


        public function SearchPersonCarrera_Titulacion($cedula,$type='json')
    {

        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_ESTUDIANTE_DPERSONAL AS C')
            ->where('C.COD_ESTUDIANTE','=',$cedula)
          ->join('BdAcademico.dbo.TB_TIT_MATRICULA AS TB_TIT_MATRICULA','TB_TIT_MATRICULA.NUM_IDENTIFICACION','=','C.COD_ESTUDIANTE')
          ->join('BdAcademico.dbo.TB_CARRERA AS TB_CARRERA','TB_CARRERA.COD_CARRERA','=','TB_TIT_MATRICULA.COD_CARRERA')

            ->select('TB_CARRERA.COD_CARRERA AS COD_CARRERA','TB_CARRERA.NOMBRE AS NOMBRE_CARRERA');
            
        if($type=='json'){
            $result=$result->get('COD_CARRERA','NOMBRE_CARRERA');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('COD_CARRERA','NOMBRE_CARRERA')->toArray();
           return $result;
        }
    }


     public function SearchPersonTesis_Titulacion($carrera,$type='json')
    {

    $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_CARRERA AS C')
            ->where('C.COD_CARRERA','=',$carrera)
            ->where('TB_TESIS.ESTADO','=','I')
          ->join('BdAcademico.dbo.TB_TESIS AS TB_TESIS','TB_TESIS.COD_CARRERA','=','C.COD_CARRERA')

            ->select('TB_TESIS.COD_TESIS AS COD_TESIS','TB_TESIS.TEMA AS TEMA');
            
        if($type=='json'){
            $result=$result->get('TEMA','COD_TESIS');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('TEMA','COD_TESIS')->toArray();
           return $result;
        }

    

    }
    
     public function TitulacionParametro($parametro,$type='json')
    {
        $result = DB::connection('sqlsrv_bdacademico')
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
    
  public function moduloEtapa($etapa,$id,$type='json')
    {
        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_TIT_PARAMETRO AS C')
            ->join('TB_TIT_TIPO_PARAMETRO AS T','T.COD_TIPO_PARAMETRO' ,'=','C.COD_TIPO_PARAMETRO')
            ->join('TB_TIT_CATEGORIA_PARAMETRO AS CA','CA.CODIGO_CAT', '=','T.TIPO_APLICA')
            ->where('C.COD_TIPO_PARAMETRO','=',$etapa)
            ->where('C.N_ID','=',$id)
            ->select('CA.CODIGO_CAT AS CODIGO','CA.NOM_CAT AS DESCRIPCION')
            ;
        if($type=='json'){
            $result=$result->get('CODIGO');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('CODIGO')->toArray();
           return $result;
        }

    }
    public function  datoTIT_PARAMETRO($id='0',$response='http',$type='json')
    {
         $result = DB::connection('sqlsrv_bdacademico')->table('TB_TIT_PARAMETRO')
                    ->where('N_ID', '=', $id)
                    ->select('N_ID as id','COD_TIPO_PARAMETRO as etapa','COD_CARRERA as carrera','COD_PLECTIVO as ciclo','FECHA_INICIO as fecha_inicio','FECHA_FIN as fecha_fin','COD_FACULTAD as faculties','TIPO as tipo')
                    ->get(['id','etapa','carrera','ciclo','fecha_inicio','fecha_fin','faculties','tipo']);
       
        $result=['result'=>$result];

        return $this->transform($result,$response);
   }
public function  getEtapa_Modulo($id='0',$response='http'){

       $etapa_consulta= DB::connection('sqlsrv_bdacademico')->table('TB_TIT_TIPO_PARAMETRO')
        ->where('ESTADO','=','1')
        ->where('COD_TIPO_PARAMETRO','=',$id)
        ->pluck('TIPO_APLICA')->toArray();

        $etapa= DB::connection('sqlsrv_bdacademico')->table('TB_TIT_TIPO_PARAMETRO')
        ->where('ESTADO','=','1')
        ->Where('TIPO_APLICA','=',$etapa_consulta)
        ->pluck('DESCRIPCION','COD_TIPO_PARAMETRO')->toArray();

         $result=['etapa'=>$etapa];
                   return $this->transform($result,$response);


}
       public function  getTIT_PARAMETRO($id='0',$response='http'){
         $dato = DB::connection('sqlsrv_bdacademico')->table('TB_TIT_PARAMETRO')
                    ->where('N_ID', '=', $id)
                    ->select('N_ID as id','COD_TIPO_PARAMETRO as etapa','COD_CARRERA as carrera','COD_PLECTIVO as ciclo','FECHA_INICIO as fecha_inicio','FECHA_FIN as fecha_fin','COD_FACULTAD as faculties','TIPO as tipo')
                     ->get(['id','etapa','carrera','ciclo','fecha_inicio','fecha_fin','faculties','tipo'])->first();
         
     
         $modulo= DB::connection('sqlsrv_bdacademico')->table('TB_TIT_CATEGORIA_PARAMETRO')
        ->where('ESTADO','=','A')
        ->pluck('NOM_CAT','CODIGO_CAT')->toArray();
          
        $tipo= DB::connection('sqlsrv_bdacademico')->table('TB_TIT_TIPO_MATRICULA')
        ->where('ESTADO','=','A')
        ->pluck('NOM_TIPO_MAT','ID')->toArray();

        $result=['modulo'=>$modulo,'tipo'=>$tipo,'dato'=>$dato];

        return $this->transform($result,$response);
    }

    public function PlectivosCarrera($carrera,$type='json')
    {

        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_PLECTIVO AS C')
            ->where('C.COD_CARRERA', '=', $carrera)
            ->where('C.ESTADO','=','A')
          
            ->groupBy('C.COD_PLECTIVO', 'C.DESCRIPCION')
            ->orderBy('C.DESCRIPCION', 'ASC')
            ->select(DB::raw('LTRIM(RTRIM(C.COD_PLECTIVO)) AS COD_PLECTIVO'), DB::raw('LTRIM(RTRIM(C.DESCRIPCION)) AS DESCRIPCION'))
            ;
        if($type=='json'){
            $result=$result->get('DESCRIPCION', 'COD_PLECTIVO');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }else{
            $result=$result->pluck('DESCRIPCION', 'COD_PLECTIVO')->toArray();
           return $result;
        }
    }


public function getAreaCarrera($carrera,$type='json')
{
        $result = DB::connection('sqlsrv_bdacademico')
            ->table('TB_AREA_INVESTIGACION AS C')
            ->where('C.COD_CARRERA', '=', $carrera)
            ->where('C.ESTADO','=','A')
          
            ->groupBy('C.N_ID', 'C.DESCRIPCION')
            ->orderBy('C.DESCRIPCION', 'ASC')
            ->select('C.N_ID AS N_ID','C.DESCRIPCION AS DESCRIPCION')
            ;
        if($type=='json')
        {
            $result=$result->get('DESCRIPCION', 'N_ID');
            $listaCarreras['data']=$result;
            return response()->json($listaCarreras, 200);
        }
        else
        {
            $result=$result->pluck('DESCRIPCION', 'N_ID')->toArray();
            return $result;
        }
}
    public function getTutorCategoria($type='json')
    {
        $result = DB::connection('sqlsrv_bdacademico')
                  ->table('TB_TESIS_TUTOR_CATEGORIA AS C')
                  ->where('C.ESTADO','=','A')
                  ->groupBy('C.N_ID', 'C.DESCRIPCION')
                  ->orderBy('C.DESCRIPCION', 'ASC')
                  ->select('C.N_ID AS N_ID','C.DESCRIPCION AS DESCRIPCION');

        if($type=='json')
        {
            $result                = $result->get('DESCRIPCION', 'N_ID');
            $listaCarreras['data'] = $result;
            return response()->json($listaCarreras, 200);
        }
        else
        {
            $result = $result->pluck('DESCRIPCION', 'N_ID')->toArray();
            return $result;
        }
    }

    public function searchDocenteTitulacion($cedula, $type = 'json')
    {
        $objResult = DB::connection('sqlsrv_bdacademico')
            ->table('TB_HORARIO_ACTIVIDADES_DOCENTES        AS HA')
            ->join('BdAcademico.dbo.TB_ACTIVIDADES_DOCENTES AS AD','AD.ID_ACTIVIDAD_DCTE', '=', 'HA.ID_ACTIVIDAD_DCTE')
            ->join('BdAcademico.dbo.TB_CARRERA              AS CA','CA.COD_CARRERA',       '=', 'HA.COD_CARRERA')
            ->join('BdAcademico.dbo.TB_DOCENTE_DPERSONAL    AS DP','DP.COD_DOCENTE',       '=', 'HA.COD_DOCENTE')

            ->where('AD.ACTIVIDADES', '=', 'HORAS TUTORIAS DE TITULACION')
            ->where('HA.HABILITADO',  '=', 1)
            ->where('DP.COD_DOCENTE', '=', $cedula)

            ->groupBy('DP.COD_DOCENTE', 'DP.APELLIDO', 'DP.NOMBRE')

            ->select('DP.COD_DOCENTE AS COD_DOCENTE')
            ->select(DB::raw("DP.APELLIDO +' '+ DP.NOMBRE AS DOCENTE"));

        if($type === 'json')
        {
            return response()->json(['data' => $objResult->get('COD_DOCENTE','DOCENTE')], 200);
        }
        else
        {
            return $objResult->pluck('COD_DOCENTE','DOCENTE')->toArray();
        }
    }

    public function searchDocenteCarreraTitulacion($cedula, $type = 'json')
    {
        $objResult = DB::connection('sqlsrv_bdacademico')
            ->table('TB_HORARIO_ACTIVIDADES_DOCENTES        AS HA')
            ->join('BdAcademico.dbo.TB_ACTIVIDADES_DOCENTES AS AD','AD.ID_ACTIVIDAD_DCTE', '=', 'HA.ID_ACTIVIDAD_DCTE')
            ->join('BdAcademico.dbo.TB_CARRERA              AS CA','CA.COD_CARRERA',       '=', 'HA.COD_CARRERA')
            ->join('BdAcademico.dbo.TB_DOCENTE_DPERSONAL    AS DP','DP.COD_DOCENTE',       '=', 'HA.COD_DOCENTE')

            ->where('AD.ACTIVIDADES', '=', 'HORAS TUTORIAS DE TITULACION')
            ->where('HA.HABILITADO',  '=', 1)
            ->where('DP.COD_DOCENTE', '=', $cedula)

            ->select('CA.COD_CARRERA AS COD_CARRERA')
            ->select('CA.NOMBRE      AS CARRERA');

        if($type === 'json')
        {
            return response()->json(['data' => $objResult->get('COD_DOCENTE','DOCENTE')], 200);
        }
        else
        {
            return $objResult->pluck('COD_DOCENTE','DOCENTE')->toArray();
        }
    }

}
