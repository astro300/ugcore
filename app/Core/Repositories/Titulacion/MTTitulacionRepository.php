<?php

/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 4/9/2017
 * Time: 10:20
 */

namespace UGCore\Core\Respositories\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Entities\Titulacion\MTDatos;
use Storage;
//use File;
use Yajra\Datatables\Datatables;
use DB;
use Utils;

class MTTitulacionRepository
{
    public function getData()
    {
        return MTDatos::all();
    }


    public function forSave(Request $request, $flagAll = false)
    {

        \DB::connection('sqlsrv_bdacademico')->beginTransaction();
        try {
            if ($flagAll) {
                $matrixz = DB::connection('sqlsrv_bdacademico')
                    ->table('TB_FACULTAD AS F')
                    ->join('TB_CARRERA AS C', 'F.COD_FACULTAD', '=', 'C.COD_FACULTAD')
                    ->where('F.COD_FACULTAD', '<', '26')
                    ->where('C.NOACADE', '=', 0)
                    ->where('C.ESTADO_CARRERA', '=', 'A')
                    ->where('C.COD_CCARRERA', '=', 1)
                    ->select('F.COD_FACULTAD AS COD_FACULTAD',
                        DB::raw('LTRIM(RTRIM(C.COD_CARRERA)) AS COD_CARRERA'))->get();


                $arrayMTDATOS = [];
                foreach ($matrixz as $item) {
                    $objMTDatos =
                        ['COD_TIPO_PARAMETRO' => $request->etapa,
                            'COD_PLECTIVO' => $request->ciclo,
                            'FECHA_INICIO' => $request->fecha_inicio,
                            'FECHA_FIN' => $request->fecha_final,
                            'ESTADO' => '1',
                            'TIPO' => $request->tipo,
                            'COD_FACULTAD' => $item->COD_FACULTAD,
                            'COD_CARRERA' => $item->COD_CARRERA,
                            'USUARIO_INGRESO' => currentUser()->id,
                            'USUARIO_ACTUALIZA' => currentUser()->id,
                            'created_at' => Utils::getDateSQL(),
                            'updated_at' => Utils::getDateSQL()];

                    $arrayMTDATOS[] = $objMTDatos;
                }

                $arrayMTDATOS = array_chunk($arrayMTDATOS, 40);

                foreach ($arrayMTDATOS as $lote) {
                    MTDatos::insert($lote);
                }
            } else {
                MTDatos::insert([['COD_TIPO_PARAMETRO' => $request->etapa,
                    'COD_PLECTIVO' => $request->ciclo,
                    'FECHA_INICIO' => $request->fecha_inicio,
                    'FECHA_FIN' => $request->fecha_final,
                    'ESTADO' => '1',
                    'TIPO' => $request->tipo,
                    'COD_FACULTAD' => $request->facultad,
                    'COD_CARRERA' => $request->carrera,
                    'USUARIO_INGRESO' => currentUser()->id,
                    'USUARIO_ACTUALIZA' => currentUser()->id,
                    'created_at' => Utils::getDateSQL(),
                    'updated_at' => Utils::getDateSQL()]]);
            }

            \DB::connection('sqlsrv_bdacademico')->commit();
        } catch (\Exception $ex) {
            \DB::connection('sqlsrv_bdacademico')->rollback();
            throw new \Exception($ex);
        }


    }

    public function forUpdate(Request $request, MTDatos $datos)
    {
        //     dd($request);


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


    }

    public function forDelete($id)
    {

        $objParametro = MTDatos::findOrFail($id);

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
            MTDatos::orderBy('TB_CARRERA.COD_CARRERA', 'DESC')
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


    public function getDataNotasTitulacion()
    {
        return Datatables::of(
            DB::connection('sqlsrv_bdacademico')
                ->table('dbo.TB_ESTUDIANTE_TESIS AS ET')
                ->join('dbo.TB_TIT_MATRICULA AS M', 'ET.COD_ESTUDIANTE', '=', 'M.NUM_IDENTIFICACION')
                ->join('dbo.TB_TESIS AS T', 'ET.COD_TESIS', '=', 'T.COD_TESIS')
                ->join('dbo.TB_ESTUDIANTE_DPERSONAL AS E', 'M.NUM_IDENTIFICACION', '=', 'E.COD_ESTUDIANTE')
                ->where('M.TIPO_MODALIDAD','=',1)
                ->select('ET.COD_TESIS','ET.COD_ESTUDIANTE','T.TEMA',
                    DB::raw("E.APELLIDO+' '+E.NOMBRE AS ESTUDIANTE"),'ET.NOTA_T AS NOTA'
                    )->get()
            )->make(true);
    }

    public  function  forsaveNotaTitulacion(Request $request)
    {

    }
}