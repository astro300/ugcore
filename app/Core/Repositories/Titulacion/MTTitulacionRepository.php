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

use UGCore\Core\Entities\Titulacion\MTEstudianteTesis ;
use UGCore\Core\Entities\Titulacion\MTDocente;

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
            ->addColumn('actions', '<a href="{{ route(\'titulacion.configuracion.edit\', $N_ID) }}"><i class="fa fa-pencil"></i></a>|<a href="{{ route(\'titulacion.configuracion.delete\', $N_ID) }}" onclick="
return confirm(\'¿Esta Seguro que desea eliminar este registro?\')"
    ><span class="fa fa-trash text-danger"
                                       aria-hidden="true"></a>')
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
        $ced_usuario = currentUser()->name;

        return Datatables::of(
            DB::connection('sqlsrv_bdacademico')
                ->table('dbo.TB_ESTUDIANTE_TESIS AS ET')
                ->join('dbo.TB_TIT_MATRICULA AS M', 'ET.COD_ESTUDIANTE', '=', 'M.NUM_IDENTIFICACION')
                ->join('dbo.TB_TESIS AS T', 'ET.COD_TESIS', '=', 'T.COD_TESIS')
                ->join('dbo.TB_TESIS_TUTORES AS TT','T.COD_TESIS','=','TT.COD_TESIS')
                ->join('dbo.TB_TESIS_TUTOR_CATEGORIA AS TC','TT.TIPO_DOCENTE','=','TC.N_ID')
                ->join('dbo.TB_DOCENTE_DPERSONAL AS DP','TT.COD_DOCENTE','=','DP.COD_DOCENTE')
                ->join('dbo.TB_ESTUDIANTE_DPERSONAL AS E', 'M.NUM_IDENTIFICACION', '=', 'E.COD_ESTUDIANTE')
                ->where([['M.TIPO_MODALIDAD',1],['TT.COD_DOCENTE', $ced_usuario]])
                ->whereIn('TC.N_ID', [1, 2])
                ->select('ET.COD_TESIS','ET.COD_ESTUDIANTE','T.TEMA',
                    DB::raw("E.APELLIDO+' '+E.NOMBRE AS ESTUDIANTE"),
                    'TC.DESCRIPCION AS CARGO',
                    DB::raw("(CASE TT.TIPO_DOCENTE WHEN 1
                               THEN ET.NOTA_T ELSE ET.NOTA_R END) AS NOTA")
                    )->get()
            )->make(true);
    }

    public  function  forsaveNotaTitulacion(Request $request)
    {
        $ced_usuario = currentUser()->name;

        $array_response = [];
        $array_response['status'] = 200;
        $array_response['message'] = 'La nota de titulación se ha guardado con éxito';
        //dd($request->COD_TESIS.' - '.$request->COD_ESTUDIANTE);
        $EstudianteTesis = MTEstudianteTesis::where('COD_TESIS', '=', $request->COD_TESIS)
                                            ->where('COD_ESTUDIANTE', '=', $request->COD_ESTUDIANTE)
                                            ->first();

        if($EstudianteTesis != null)
        {
            $column_nota = '';
            $DocenteTesis = MTDocente::where([['COD_TESIS',$request->COD_TESIS],['COD_DOCENTE',$ced_usuario]])
                                        ->first();
            if($DocenteTesis != null){
                if( $DocenteTesis->TIPO_DOCENTE == 1){
                    $column_nota = 'NOTA_T';
                }
                else{
                    $column_nota = 'NOTA_R';
                }

                $exito = DB::table('BdAcademico.dbo.TB_ESTUDIANTE_TESIS')
                    ->where([['COD_TESIS', $request->COD_TESIS],['COD_ESTUDIANTE', $request->COD_ESTUDIANTE]])
                    ->update([$column_nota => $request->NOTA]);

                if($exito < 1){
                    $array_response['status']=404;
                    $array_response['message']='No hay datos para registrar';
                }
            }
            else{
                $array_response['status']=404;
                $array_response['message']='El Docente no tiene asignado el trabajo de tesis seleccionado';
            }
        }
        else{
            $array_response['status']=404;
            $array_response['message']='El estudiante no se encuentra matriculado o no tiene asignado un trabajo de tesis';
        }
        return $array_response;
    }

    // Métodos para notas general de titulación

    public function getDataNotasGenTitulacion($codcarrera)
    {
        return Datatables::of(
            DB::connection('sqlsrv_bdacademico')
                ->table('dbo.TB_ESTUDIANTE_TESIS AS ET')
                ->join('dbo.TB_TIT_MATRICULA AS M', 'ET.COD_ESTUDIANTE', '=', 'M.NUM_IDENTIFICACION')
                ->join('dbo.TB_TESIS AS T', 'ET.COD_TESIS', '=', 'T.COD_TESIS')
                ->join('dbo.TB_ESTUDIANTE_DPERSONAL AS E', 'M.NUM_IDENTIFICACION', '=', 'E.COD_ESTUDIANTE')
                ->where([['M.TIPO_MODALIDAD',1],['M.COD_CARRERA', $codcarrera]])
                ->select('ET.COD_TESIS','ET.COD_ESTUDIANTE','T.TEMA',
                    DB::raw("E.APELLIDO+' '+E.NOMBRE AS ESTUDIANTE"),
                    'ET.NOTA_T AS NTUTOR','ET.NOTA_R AS NREVISOR','ET.NOTA AS NSUSTENTACION'
                    ,DB::raw('FORMAT(
                                (	 (case  when  ET.NOTA_T is NULL then 0 else  ET.NOTA_T end)
                                    +(case  when  ET.NOTA_R is NULL then 0 else  ET.NOTA_R end) 
                                    +(case   when ET.NOTA is  NULL then 0 else  ET.NOTA end)
                                )/3 , \'N\', \'en-us\') AS NOTA_FINAL')
                )->get()
        )->make(true);
    }

    public function forSaveNotasGenTitulacion(Request $request)
    {
       $notas = array();

        if(isset($request->NOTAT))
        {
            $notas['NOTA_T'] = $request->NOTAT;
        }

        if(isset($request->NOTAR))
        {
            $notas['NOTA_R'] = $request->NOTAR;
        }

        if(isset($request->NOTAS))
        {
            $notas['NOTA_S'] = $request->NOTAS;
        }

        //dd($notas);

        //            ['NOTA_T' => ,
        //            'NOTA_R' => $request->NOTAR,
        //            'NOTA' => $request->NOTAS    ]

        $array_response = [];
        $array_response['status'] = 200;
        $array_response['message'] = 'Las notas de titulación se han guardado con éxito';
        $EstudianteTesis = MTEstudianteTesis::where('COD_TESIS', '=', $request->COD_TESIS)
            ->where('COD_ESTUDIANTE', '=', $request->COD_ESTUDIANTE)
            ->first();

        if($EstudianteTesis != null)
        {
            //dd($request->NOTAT);
            $exito = DB::table('BdAcademico.dbo.TB_ESTUDIANTE_TESIS')
                ->where([['COD_TESIS', $request->COD_TESIS],['COD_ESTUDIANTE', $request->COD_ESTUDIANTE]])
                ->update( $notas );

            if($exito < 1){
                $array_response['status']=404;
                $array_response['message']='No hay datos para registrar';
            }
        }
        else{
            $array_response['status']=404;
            $array_response['message']='El estudiante no se encuentra matriculado o no tiene asignado un trabajo de tesis';
        }

        return  $array_response;
    }

}