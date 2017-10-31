<?php

/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 4/9/2017
 * Time: 10:20
 */

namespace UGCore\Core\Respositories\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Entities\Titulacion\UserSeguimiento;
use Storage;
//use File;
use Yajra\Datatables\Datatables;
use DB;
use Utils;

class MTrabajoSeguimientoRepository
{
    public function getData()
    {
        return UserSeguimiento::all();
    }


    public function forSave(Request $request, $flagAll = false)
    {


    }

    public function forUpdate(Request $request, MTDatos $datos)
    {
        

    }

    public function forDelete($id)
    {

      

    }

    public function datatablesDatos()
    {


        return Datatables::of(
            UserSeguimiento::orderBy('TB_CARRERA.NOMBRE', 'DESC')
               
               ->join('BdAcademico.dbo.TB_TESIS as TB_TESIS','TB_TESIS.COD_TESIS', '=', 'TB_TESIS_CONTROL.COD_TESIS')
                ->join('BdAcademico.dbo.TB_CARRERA as TB_CARRERA', 'TB_CARRERA.COD_CARRERA', '=', 'TB_TESIS.COD_CARRERA')
               ->join('BdAcademico.dbo.TB_TESIS_TUTORES as TB_TESIS_TUTORES', 'TB_TESIS_TUTORES.N_ID', '=', 'TB_TESIS_CONTROL.TESIS_TUTORES_ID')
               ->join('BdAcademico.dbo.TB_DOCENTE_DPERSONAL as TB_DOCENTE_DPERSONAL', 'TB_DOCENTE_DPERSONAL.COD_DOCENTE', '=', 'TB_TESIS_TUTORES.COD_DOCENTE')
               ->join('BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL as TB_ESTUDIANTE_DPERSONAL', 'TB_ESTUDIANTE_DPERSONAL.COD_ESTUDIANTE', '=', 'TB_TESIS_CONTROL.COD_ESTUDIANTE')
               ->where('TB_TESIS_CONTROL.ESTADO', '=', 'A')
                
                ->select('TB_TESIS_CONTROL.N_ID','TB_CARRERA.NOMBRE as carrera',
                    DB::raw("TB_DOCENTE_DPERSONAL.APELLIDO +' '+ TB_DOCENTE_DPERSONAL.NOMBRE AS tesis_tutor"), 'TB_TESIS_CONTROL.FECHA_REG as fecha_reg',
                    DB::raw("TB_ESTUDIANTE_DPERSONAL.APELLIDO +' '+ TB_ESTUDIANTE_DPERSONAL.NOMBRE AS cod_estudiante"))->get()
 

        )
           ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $N_ID) }}" ><i class="fa fa-pencil"></i></a> &nbsp<a href="{{ route(\'titulacion.configuracion.delete\', $N_ID) }}" onclick="return confirm(\'¿Esta Seguro que desea eliminar este registro?\')"
    ><span class="fa fa-trash text-danger"
                                       aria-hidden="true"></a>')
            ->make(true);

        
    }
}