<?php

namespace UGCore\Core\Respositories\Titulacion;
use Illuminate\Http\Request;
use Storage;
use File;
use Yajra\Datatables\Datatables;
use DB;
use UGCore\Core\Entities\Titulacion\ExamenComplexivo;
use UGCore\Core\Entities\Titulacion\Matricula;
class ExamenComplexivoRepository
{   
    public function ForDatatable($idcarrera)
    {
        return \Datatables::of(

            DB::connection('sqlsrv_BdTitulacion')
            ->table('BdTitulacion.dbo.TB_TIT_MATRICULA as ma')
                ->join('BdTitulacion.dbo.TB_TIT_TIPO_MODALIDAD as md','ma.TIPO_MODALIDAD','=','md.ID')
                ->leftJoin('BdTitulacion.dbo.TB_TIT_EXAMEN_COMPLEXIVO as complex', 'ma.N_ID', '=', 'complex.MATRICULA_ID')
                ->join('BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL as e','ma.NUM_IDENTIFICACION','=','e.COD_ESTUDIANTE')
                ->join('BdAcademico.dbo.TB_CARRERA as c','ma.COD_CARRERA','=','c.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_FACULTAD as f','c.COD_FACULTAD','=','f.COD_FACULTAD')
                ->select('ma.N_ID as id','f.NOMBRE as FACULTAD','c.NOMBRE as CARRERA',
                    DB::raw("e.APELLIDO+' '+e.NOMBRE  as ESTUDIANTE"),'complex.NOTA_COMPLEXIVO','complex.NOTA_GRACIA',
                    DB::raw("(case when complex.NOTA_COMPLEXIVO is not null then
                                 case when
                                    complex.NOTA_GRACIA is not null
                                 then
                                    case when
                                        complex.NOTA_COMPLEXIVO > complex.NOTA_GRACIA
                                    then 
                                        complex.NOTA_COMPLEXIVO
                                    else
                                        complex.NOTA_GRACIA
                                    end
                                 else
                                    complex.NOTA_COMPLEXIVO
                                 end
                               else
                                null
                               end ) as NOTA_FINAL"), DB::raw("(case when complex.OBSERVACION IS NULL THEN '' ELSE complex.OBSERVACION END ) OBSERVACION")
                )
                ->where('ma.COD_CARRERA','=',$idcarrera)
                ->get()
        )
            // ->add_column('actions', ' <a href="{{ route(\'surveys.categories_surveys.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>')
            ->make(true);
    }

//    public function forSaveOrUpdate(Request $request, $id)
//    {
//        $array_response=[];
//        $array_response['status']=200;
//        $array_response['message']='Notas Registradas  correctamente';
//        $complexivo = ExamenComplexivo::where('MATRICULA_ID',$id)->first();
//        if($complexivo == null){
//            $this->forsave($request);
//
//        }else {
//            $this->forupdate($request, $complexivo->N_ID);
//        }
//
//        return $array_response;
//
//    }
//
//
//    protected  function forsave(Request $request)
//    {
//        $objComplexivo = new ExamenComplexivo();
//        $objComplexivo->fill($request->all());
//        $objComplexivo->USUARIO_INGRESO=\Auth::user()->id;
//        $objComplexivo->save();
//    }
//    protected function forupdate(Request $request,$id)
//    {
//        $objComplexivo = ExamenComplexivo::findOrfail($id);
//        $objComplexivo->fill($request->all());
//        $objComplexivo->save();
//    }


    public function forSaveOrUpdate(Request $request, $id){

        $matricula = Matricula::find($id)->first();

        if($matricula != null){

            $cod_estudiante = $matricula->NUM_IDENTIFICACION;

            DB::connection('sqlsrv_bdacademico')
                ->table('BdAcademico.dbo.TB_EXAMEN_GRACIA as ex')
                ->join('BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL as e','ex.COD_ESTUDIANTE','=','e.COD_ESTUDIANTE')
                ->join('BdAcademico.dbo.TB_CARRERA as c','ex.COD_CARRERA','=','c.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_PLECTIVO as p','ex.COD_PLECTIVO','=','p.COD_PLECTIVO')
                ->join('BdAcademico.dbo.COD_MATERIA as m','ex.COD_MATERIA','=','m.COD_MATERIA')
                ->select('ex.NUM_SECUENCIA')
                ->where(['c.COD_CARRERA','=',$matricula->COD_CARRERA],['p.COD_PLECTIVO','=',$matricula->COD_PLECTIVO],)


        }else {
            $this->forupdate($request, $complexivo->N_ID);
        }

        DB::table('users')->insert(
            ['email' => 'john@example.com', 'votes' => 0]
        );
    }





}