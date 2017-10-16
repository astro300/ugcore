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
use File;
use Yajra\Datatables\Datatables;
use DB;

class MTTitulacionRepository
{
    public function getData(){
        return MTDatos::all();
    }

    public function forSave(Request $request){

        $objMTDatos=new MTDatos($request->all());
        $objMTDatos->COD_TIPO_PARAMETRO=$request->etapa;
        $objMTDatos->COD_PLECTIVO=$request->ciclo;
        $objMTDatos->FECHA_INICIO=$request->fecha_inicio;
        $objMTDatos->FECHA_FIN=$request->fecha_final;
        $objMTDatos->ESTADO='1';
        $objMTDatos->COD_FACULTAD=$request->facultad;
        $objMTDatos->COD_CARRERA=$request->carrera;

      
        $objMTDatos->USUARIO_INGRESO=currentUser()->id;
        $objMTDatos->USUARIO_ACTUALIZA=currentUser()->id;
        $objMTDatos->save();
    }
/*
    public function forUpdate(MTDatos $dato,Request $request){
        $dato->fill($request->all());
        $dato->sexo='M';
        $dato->ip=$request->ip();
        $dato->user_id=currentUser()->id;

        if($request->documentoFoto!=null){
            //Subir documento al repositorio
            $file=$request->documentoFoto;
            $extension = $file->getClientOriginalExtension();
            $nameFile='img_'.currentUser()->id.uniqid().'.'.$extension;
            Storage::disk('public')->put("fotos/$nameFile",  File::get($file));
            $dato->archivo=$nameFile;
        }
        $dato->save();
    }
*/
    public function datatablesDatos(){
   
 /*->select('db1.*')
  ->leftJoin('db2.users as db2', 'db1.id', '=', 'db2.id')
  ->where('db2.id', 5)
  ->get();
*/





        return Datatables::of(
            MTDatos::orderBy('TB_CARRERA.COD_CARRERA','ASC')
            ->join('BdAcademico.dbo.TB_CARRERA as TB_CARRERA','TB_CARRERA.COD_CARRERA','=','TB_TIT_PARAMETRO.COD_CARRERA')
                ->select('TB_CARRERA.NOMBRE as carrera','COD_PLECTIVO as ciclo','COD_TIPO_PARAMETRO as etapa','FECHA_INICIO as fecha_inicio','FECHA_FIN as fecha_final')->get()


        )->addColumn('actions', ' <a href=""><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);
/*
         
        return Datatables::of(MTDatos::orderBy('COD_CARRERA','ASC')
                ->select('COD_CARRERA as carrera','COD_PLECTIVO as ciclo','COD_TIPO_PARAMETRO as etapa',
                          'FECHA_INICIO as fecha_inicio','FECHA_FIN as fecha_final')->get()
                        )
            ->add_column('actions', ' <a href=""><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);

       // ->add_column('actions', ' <a href="{{ route(\'titulacion.datos.edit\', $N_ID) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>')->make(true);*/
    }

    public function ListTrabTituxCarrera($idcarrera)
    {
        $lista = DB::select('SELECT T.NOMBRE, (D.APELLIDO+\' \'+ D.NOMBRE ) AS TUTOR, 
          (SELECT TOP 1  D.APELLIDO+\' \'+D.NOMBRE FROM BdTitulacion.dbo.TB_TIT_TRABAJO_REVISOR REV
            WHERE D.COD_DOCENTE = REV.COD_DOCENTE_REVISOR   COLLATE Modern_Spanish_CI_AS ) AS REVISOR
            ,
            STUFF(
            (select \',\'+(D.APELLIDO+\' \'+D.NOMBRE)
             from BdTitulacion.dbo.TB_TIT_TRABAJO_TRIBUNAL TR
             where   T.NUMERO_TRABAJO = TR.NUMERO_TRABAJO
             FOR XML PATH(\'\'))
            ,1,1,\'\'
            ) AS TRIBUNAL_SUSTENTACION

            ,
            STUFF(
            (select \',\'+(E.APELLIDO+\' \'+ E.NOMBRE)
             from BdTitulacion.dbo.TB_TIT_TRABAJO_INTEGRANTE TI
             INNER JOIN BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL E ON TI.COD_ESTUDIANTE = E.COD_ESTUDIANTE 
             COLLATE Modern_Spanish_CI_AS
             AND   T.NUMERO_TRABAJO = TI.NUMERO_TRABAJO 
             FOR XML PATH(\'\'))
            ,1,1,\'\'
            ) AS ESTUDIANTES
            
            
            FROM BdTitulacion.dbo.TB_TIT_TRABAJO T
            INNER JOIN BdAcademico.dbo.TB_DOCENTE_DPERSONAL D ON T.COD_DOCENTE_TUTOR = D.COD_DOCENTE
            COLLATE Modern_Spanish_CI_AS 
            WHERE T.COD_CARRERA  = ?', [$idcarrera]);
    }


    public function ForDatatable($idcarrera){

        //dd($idcarrera);
        return \Datatables::of(

            DB::connection('sqlsrv_BdTitulacion')
            ->table('BdTitulacion.dbo.TB_TIT_MATRICULA as ma')
                ->join('BdTitulacion.dbo.TB_TIT_TIPO_MODALIDAD as md','ma.TIPO_MODALIDAD','=','md.ID')
                ->join('BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL as e','ma.NUM_IDENTIFICACION','=','e.COD_ESTUDIANTE')
                ->join('BdAcademico.dbo.TB_CARRERA as c','ma.COD_CARRERA','=','c.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_FACULTAD as f','c.COD_FACULTAD','=','f.COD_FACULTAD')
                ->select('f.NOMBRE as FACULTAD','c.NOMBRE as CARRERA',
                    DB::raw("e.APELLIDO+' '+e.NOMBRE  as ESTUDIANTE") )
                ->where('ma.COD_CARRERA','=',$idcarrera)
                ->get()
        )
            // ->add_column('actions', ' <a href="{{ route(\'surveys.categories_surveys.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>')
            ->make(true);
    }

}