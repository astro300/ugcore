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
               //->join('BdAcademico.dbo.TB_CARRERA as TB_CARRERA', 'TB_CARRERA.COD_CARRERA', '=', 'TB_TESIS.COD_CARRERA')

               ->where('TB_TESIS_CONTROL.ESTADO', '=', 'A')
                ->select('TB_TESIS_CONTROL.N_ID','TB_CARRERA.NOMBRE as carrera',
                    'TB_TESIS_CONTROL.TESIS_TUTORES_ID as tesis_tutor', 'TB_TESIS_CONTROL.FECHA_REG as fecha_reg',
                    'TB_TESIS_CONTROL.COD_ESTUDIANTE as cod_estudiante')->get()
 

        )
           ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $N_ID) }}" class="btn btn-primary btn-xs">&nbsp;Editar</a>|<a href="{{ route(\'titulacion.configuracion.delete\', $N_ID) }}" onclick="
return confirm(\'¿Esta Seguro que desea eliminar este registro?\')"
    class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-circle"
        aria-hidden="true">&nbsp;Eliminar</a>')
            ->make(true);

        
    }
}