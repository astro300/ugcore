<?php

/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 4/9/2017
 * Time: 10:20
 */

namespace UGCore\Core\Respositories\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Entities\Titulacion\MTDocente;
use Storage;
use Yajra\Datatables\Datatables;
use DB;
use Utils;

class MTDocenteInscripcionRepository
{
    public function getData()
    {
        return MTDocente::all();
    }

    public function forSave(Request $request, $flagAll = false)
    {
        try
        {
            $request->cod_tesis = isset($request->cod_tesis) ? $request->cod_tesis : null;
            $request->fecha_presento=$fecha_presento=Utils::getDateSQL();
            $request->estado=$estado='I';
            $request->fecha_apronega=$fecha_apronega=null;
            $request->fecha_sustenta=$fecha_sustenta=null;
            $request->tipt=$tipt=null;
            $request->responsa1=$responsa1=currentUser()->id;
            $request->responsa2=$responsa2=null;
            $request->fecsys1=$fecsys1=Utils::getDateSQL();
            $request->fecsys2=$fecsys2=null;

            $PARAMETROS =
                [
                    $request->cod_tesis,
                    $request->carrera,
                    $request->tema,
                    $request->estado,
                    $request->fecha_presento,
                    $request->fecha_apronega,
                    $request->fecha_sustenta,
                    $request->tipt,
                    $request->responsa1,
                    $request->responsa2,
                    $request->fecsys1,
                    $request->fecsys2,
                    $request->ciclo,
                    $request->area_investigacion
                ];
            $respuesta = DB::connection('sqlsrv_bdacademico')->SELECT("exec SP_INGRESO_TESIS ?,?,?,?,?,?,?,?,?,?,?,?,?,?", $PARAMETROS);
        }
        catch (\Exception $ex)
        {
            throw new \Exception($ex);
        }
    }

    public function datatablesDatos()
    {
        return Datatables
            ::of(MTDocente::orderBy('TE.FECHA_PRESENTO', 'DESC')

                ->join('BdAcademico.dbo.TB_CARRERA               as CA', 'CA.COD_CARRERA',  '=', 'TB_TESIS_TUTORES.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_TESIS                 as TE', 'TE.COD_TESIS',    '=', 'TB_TESIS_TUTORES.COD_TESIS')
                ->join('BdAcademico.dbo.TB_TESIS_TUTOR_CATEGORIA as TC', 'TC.N_ID',         '=', 'TB_TESIS_TUTORES.TIPO_DOCENTE')
                ->join('BdAcademico.dbo.TB_PLECTIVO              as PL', 'PL.COD_PLECTIVO', '=', 'TB_TESIS_TUTORES.COD_PLECTIVO')
                ->join('BdAcademico.dbo.TB_DOCENTE_DPERSONAL     as DP', 'DP.COD_DOCENTE',  '=', 'TB_TESIS_TUTORES.COD_DOCENTE')

                ->where('TB_TESIS_TUTORES.ESTADO','=','A')

                ->select('CA.NOMBRE      as carrera')
                ->select('TE.TEMA        as trabajo')
                ->select('TE.COD_TESIS   as cod_tesis')
                ->select('TC.DESCRIPCION as tipo_docente')
                ->select('PL.DESCRIPCION as plectivo')
                ->select(DB::raw("DP.APELLIDO +' '+ DP.NOMBRE AS docente"))

                ->get())
            ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $cod_tesis) }}" 
                                       ><i class="fa fa-pencil"></i></a> &nbsp
                                    <a href="{{ route(\'titulacion.configuracion.delete\', $cod_tesis) }}" 
                                       onclick="return confirm(\'¿Está Seguro que desea eliminar este registro?\')"
                                       ><span class="fa fa-trash text-danger"
                                       aria-hidden="true"></a>')
            ->make(true);
    }
}