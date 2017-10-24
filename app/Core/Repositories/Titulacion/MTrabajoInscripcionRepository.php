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

class MTrabajoInscripcionRepository
{
    public function getData()
    {
        return MTInscripcion::all();
    }


    public function forSave(Request $request, $flagAll = false)
    {
        $request->fecha_presento=$fecha_presento=Utils::getDateSQL();
        $request->estado=$estado='I';
        $request->fecha_apronega=$fecha_apronega=null;
        $request->fecha_sustenta=$fecha_sustenta=null;
        $request->tipt=$tipt=null;
        $request->responsa1=$responsa1=currentUser()->id;
        $request->responsa2=$responsa2=null;
        $request->fecsys1=$fecsys1=Utils::getDateSQL();
        $request->fecsys2=$fecsys2=null;

         try {
            $respuesta = DB::connection('sqlsrv_bdacademico')->SELECT("exec SP_INGRESO_TESIS ?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                [NULL,
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
                 $request->area_investigacion]);

        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }


    }

    public function forUpdate(Request $request, MTDatos $datos)
    {
        //     dd($request);

/*
        //lenar todos $datos->fill($request->all());

        $datos->COD_TIPO_PARAMETRO = $request->etapa;
        $datos->COD_PLECTIVO = $request->ciclo;
        $datos->COD_CARRERA = $request->carrera;
        $datos->FECHA_INICIO = $request->fecha_inicio;
        $datos->FECHA_FIN = $request->fecha_final;
        $datos->ESTADO = '1';

        $datos->USUARIO_ACTUALIZA = currentUser()->id;
        $datos->TIPO = $request->tipo;

        //dd($datos);
        $datos->save();
/**/

    }

    public function forDelete($id)
    {

     /*   $objParametro = MTDatos::findOrFail($id);

        $objParametro->ESTADO = '0';
        $objParametro->save();

        //lenar todos $datos->fill($request->all());
        /*
        $datos->COD_TIPO_PARAMETRO=$request->etapa;
        $datos->COD_PLECTIVO=$request->ciclo;
        $datos->COD_CARRERA=$request->carrera;
        $datos->FECHA_INICIO=$request->fecha_inicio;
        $datos->FECHA_FIN=$request->fecha_final;


        $datos->USUARIO_ACTUALIZA=currentUser()->id;
        $datos->TIPO=$request->tipo;

        //dd($datos);
        $datos->save();

      */

    }

    public function datatablesDatos()
    {

        /*->select('db1.*')
         ->leftJoin('db2.users as db2', 'db1.id', '=', 'db2.id')
         ->where('db2.id', 5)
         ->get();
       */

        return Datatables::of(
MTInscripcion::orderBy('TB_TESIS.FECHA_PRESENTO', 'DESC')
                ->join('BdAcademico.dbo.TB_CARRERA as TB_CARRERA', 'TB_CARRERA.COD_CARRERA', '=', 'TB_TESIS.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_FACULTAD as TB_FACULTAD', 'TB_FACULTAD.COD_FACULTAD', '=', 'TB_CARRERA.COD_FACULTAD')
                ->where('TB_TESIS.ESTADO','=','I')
                ->select('TB_TESIS.COD_TESIS', 'TB_TESIS.TEMA as tema','TB_FACULTAD.NOMBRE as facultad','TB_CARRERA.NOMBRE as carrera','TB_TESIS.FECHA_PRESENTO as fecha')->get()
        //     )->add_column('actions', ' <a href=""><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);


        )
            ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $COD_TESIS) }}" class="btn btn-primary btn-xs">&nbsp;Editar</a>|<a href="{{ route(\'titulacion.configuracion.delete\', $COD_TESIS) }}" onclick="
return confirm(\'¿Esta Seguro que desea eliminar este registro?\')"
    class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-circle"
        aria-hidden="true">&nbsp;Eliminar</a>')
            ->make(true);


/*            MTDatos::orderBy('TB_CARRERA.COD_CARRERA', 'DESC')
                ->join('BdAcademico.dbo.TB_CARRERA as TB_CARRERA', 'TB_CARRERA.COD_CARRERA', '=', 'TB_TIT_PARAMETRO.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_PLECTIVO as TB_PLECTIVO',
                    'TB_PLECTIVO.COD_PLECTIVO', '=', 'TB_TIT_PARAMETRO.COD_PLECTIVO')
                ->join('BdAcademico.dbo.TB_TIT_TIPO_PARAMETRO as TB_TIT_TIPO_PARAMETRO',
                    'TB_TIT_TIPO_PARAMETRO.COD_TIPO_PARAMETRO', '=', 'TB_TIT_PARAMETRO.COD_TIPO_PARAMETRO')
                ->join('BdAcademico.dbo.TB_TIT_TIPO_MATRICULA as TB_TIT_TIPO_MATRICULA',
                    'TB_TIT_TIPO_MATRICULA.ID', '=', 'TB_TIT_PARAMETRO.TIPO')
                ->where('TB_TIT_PARAMETRO.ESTADO', '=', '1')
                ->select('TB_TIT_PARAMETRO.N_ID', 'TB_CARRERA.NOMBRE as carrera',
                    'TB_PLECTIVO.DESCRIPCION as ciclo', 'TB_TIT_TIPO_PARAMETRO.DESCRIPCION as etapa',
                    'TB_TIT_TIPO_MATRICULA.NOM_TIPO_MAT as tipo', 'TB_TIT_PARAMETRO.FECHA_INICIO as fecha_inicio',
                    'TB_TIT_PARAMETRO.FECHA_FIN as fecha_final')->get()
        //     )->add_column('actions', ' <a href=""><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);


        )
            ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $N_ID) }}" class="btn btn-primary btn-xs">&nbsp;Editar</a>|<a href="{{ route(\'titulacion.configuracion.delete\', $N_ID) }}" onclick="
return confirm(\'¿Esta Seguro que desea eliminar este registro?\')"
    class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-circle"
        aria-hidden="true">&nbsp;Eliminar</a>')
            ->make(true);

        //var_dump($results);


        /*

                return Datatables::of(MTDatos::orderBy('COD_CARRERA','ASC')
                        ->select('COD_CARRERA as carrera','COD_PLECTIVO as ciclo','COD_TIPO_PARAMETRO as etapa',
                                  'FECHA_INICIO as fecha_inicio','FECHA_FIN as fecha_final')->get()
                                )
                    ->add_column('actions', ' <a href=""><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);

               // ->add_column('actions', ' <a href=""><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);*/
    }
}