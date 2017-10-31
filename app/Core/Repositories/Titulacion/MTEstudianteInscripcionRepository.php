<?php

/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 4/9/2017
 * Time: 10:20
 */

namespace UGCore\Core\Respositories\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Entities\Titulacion\MTInscripcion;


use Storage;
//use File;
use Yajra\Datatables\Datatables;
use DB;
use Utils;

class MTEstudianteInscripcionRepository
{
    public function getData()
    {
        return MTInscripcion::all();
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

    public function forUpdate(Request $request, MTDatos $datos)
    {
    }

    public function forDelete($id)
    {
    }

    public function datatablesDatos()
    {
        return Datatables::of(MTInscripcion::orderBy('TB_TESIS.FECHA_PRESENTO', 'DESC')
                ->join('BdAcademico.dbo.TB_CARRERA as TB_CARRERA', 'TB_CARRERA.COD_CARRERA', '=', 'TB_TESIS.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_FACULTAD as TB_FACULTAD', 'TB_FACULTAD.COD_FACULTAD', '=', 'TB_CARRERA.COD_FACULTAD')
                ->where('TB_TESIS.ESTADO','=','I')
                ->select('TB_TESIS.COD_TESIS', 'TB_TESIS.TEMA as tema','TB_FACULTAD.NOMBRE as facultad','TB_CARRERA.NOMBRE as carrera','TB_TESIS.FECHA_PRESENTO as fecha')->get()
        )
            ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $COD_TESIS) }}" ><i class="fa fa-pencil"></i></a> &nbsp<a href="{{ route(\'titulacion.configuracion.delete\', $COD_TESIS) }}" onclick="
return confirm(\'¿Esta Seguro que desea eliminar este registro?\')"
    ><span class="fa fa-trash text-danger"
                                       aria-hidden="true"></a>')
            ->make(true);
    }
}