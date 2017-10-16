<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 20/3/2017
 * Time: 12:28
 */

namespace UGCore\Core\Repositories\Uath;
use Utils;
use Messages;
use Alerts;
use DB;

class ReportesRepository
{



    public function forComboGrupos(){
        $listaComboGruposRp=DB::connection('sqlsrv_modulos')
            ->table('Cursos.Grupos as A')
            ->where('A.ESTADO','=','A')
            ->select('A.ID', 'A.NOMBRE_GRUPO')
            ->lists('NOMBRE_GRUPO','ID');
        return $listaComboGruposRp ;
    }

    public function forNombreMateria($id){
        $listaNombreMateria=DB::connection('sqlsrv_modulos')
            ->table('Cursos.Grupos as A')
            ->leftJoin('Cursos.Materias as B','A.ID_MATERIA','=','B.ID')
            ->where('A.ID','=',$id)
            ->select('B.NOMBRE_MATERIA')
            ->lists('NOMBRE_MATERIA');
        return $listaNombreMateria ;
    }

    /*PARA REPORTES PDF*/
    public function nomina_grupos_uath($idg){
        DB::connection('sqlsrv_modulos')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $lista_nomina_grupos = DB::connection('sqlsrv_modulos')
            ->table('Cursos.GruposPersonas as A')
            ->leftJoin('Cursos.Grupos as B','A.ID_GRUPO','=','B.ID')
            ->leftJoin('VS_DATOS_UATH as C','C.CEDULA','=',DB::raw('A.CEDULA COLLATE Modern_Spanish_BIN'))
            ->where('A.ESTADO','=','A')
            ->where('B.ESTADO','=','A')
            ->where('A.ID_GRUPO','=',$idg)
            ->orderBy('C.APELLIDOS')
            ->select('A.ID','B.NOMBRE_GRUPO','A.CEDULA','C.APELLIDOS','C.NOMBRES')
            ->get();
        return $lista_nomina_grupos;
    }

    /*PARA REPORTES PDF*/
    public function nomina_estado_uath($idg,$estado){
        DB::connection('sqlsrv_modulos')->statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        if($estado!='T'){
            $lista_nomina_estado = DB::connection('sqlsrv_modulos')
                ->table('Cursos.GruposPersonas as A')
                ->leftJoin('Cursos.Grupos as B','A.ID_GRUPO','=','B.ID')
                ->leftJoin('VS_DATOS_UATH as C','C.CEDULA','=',DB::raw('A.CEDULA COLLATE Modern_Spanish_BIN'))
                ->where('A.ESTADO','=','A')
                ->where('B.ESTADO','=','A')
                ->where('A.ID_GRUPO','=',$idg)
                ->where('A.ESTADOMATERIA','=',$estado)
                ->orderBy('C.APELLIDOS')
                ->select('A.ID','B.NOMBRE_GRUPO','A.CEDULA','C.APELLIDOS','C.NOMBRES','A.ESTADOMATERIA')
                ->get();
            return $lista_nomina_estado;
        }
        else{
            $lista_nomina_estado = DB::connection('sqlsrv_modulos')
                ->table('Cursos.GruposPersonas as A')
                ->leftJoin('Cursos.Grupos as B','A.ID_GRUPO','=','B.ID')
                ->leftJoin('VS_DATOS_UATH as C','C.CEDULA','=',DB::raw('A.CEDULA COLLATE Modern_Spanish_BIN'))
                ->where('A.ESTADO','=','A')
                ->where('B.ESTADO','=','A')
                ->where('A.ID_GRUPO','=',$idg)
                ->orderBy('C.APELLIDOS')
                ->select('A.ID','B.NOMBRE_GRUPO','A.CEDULA','C.APELLIDOS','C.NOMBRES','A.ESTADOMATERIA')
                ->get();
            return $lista_nomina_estado;
        }
    }
}