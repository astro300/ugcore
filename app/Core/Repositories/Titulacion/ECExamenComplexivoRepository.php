<?php

namespace UGCore\Core\Respositories\Titulacion;
use Illuminate\Http\Request;
use Storage;
use File;
use Yajra\Datatables\Datatables;
use DB;
use UGCore\Core\Entities\Titulacion\ExamenComplexivo;
use UGCore\Core\Entities\Titulacion\Matricula;

class ECExamenComplexivoRepository
{

    public function ForDatatable($idcarrera)
    {
        $var = DB::connection('sqlsrv_bdacademico')->select('EXEC SP_NOTAS_TITULACION_COMPLEXIVO ?', [$idcarrera]);
        dd($var);
        return $var;
/*

            DB::connection('sqlsrv_bdacademico')
                ->table('BdTitulacion.dbo.TB_TIT_MATRICULA as ma')
                ->join('BdTitulacion.dbo.TB_TIT_TIPO_MODALIDAD as md','ma.TIPO_MODALIDAD','=','md.ID')
                ->leftJoin('BdAcademico.dbo.TB_EXAMEN_GRACIA as complex', 'ma.NUM_IDENTIFICACION', '=', 'complex.COD_ESTUDIANTE')
                ->leftJoin('BdAcademico.dbo.TB_MATERIA as mat', 'complex.COD_MATERIA','=','mat.COD_MATERIA')
                ->join('BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL as e','ma.NUM_IDENTIFICACION','=','e.COD_ESTUDIANTE')
                ->join('BdAcademico.dbo.TB_CARRERA as c','ma.COD_CARRERA','=','c.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_FACULTAD as f','c.COD_FACULTAD','=','f.COD_FACULTAD')
                ->select('ma.N_ID as id','f.NOMBRE as FACULTAD','c.NOMBRE as CARRERA',
                    DB::raw("e.APELLIDO+' '+e.NOMBRE  as ESTUDIANTE"),
                    DB::raw("(case when mat.CS = 'EC' then complex.NOTA end) as NOTA"),
                    DB::raw("(case when mat.CS = 'ECG' then complex.NOTA end) as NOTA_GRACIA"),
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
*/
    }

    protected function forupdate(Request $request,$id)
    {
        $objComplexivo = ExamenComplexivo::findOrfail($id);
        $objComplexivo->fill($request->all());
        $objComplexivo->save();
    }

    public function forSaveOrUpdate(Request $request, $id)
    {

        $matricula = Matricula::find($id)->first();

        if($matricula != null)
        {
            $cod_estudiante = $matricula->NUM_IDENTIFICACION;

            DB::connection('sqlsrv_bdacademico')
                ->table('BdAcademico.dbo.TB_EXAMEN_GRACIA as ex')
                ->join('BdAcademico.dbo.TB_ESTUDIANTE_DPERSONAL as e','ex.COD_ESTUDIANTE','=','e.COD_ESTUDIANTE')
                ->join('BdAcademico.dbo.TB_CARRERA as c','ex.COD_CARRERA','=','c.COD_CARRERA')
                ->join('BdAcademico.dbo.TB_PLECTIVO as p','ex.COD_PLECTIVO','=','p.COD_PLECTIVO')
                ->join('BdAcademico.dbo.COD_MATERIA as m','ex.COD_MATERIA','=','m.COD_MATERIA')
                ->select('ex.NUM_SECUENCIA')
                ->where(['c.COD_CARRERA','=',$matricula->COD_CARRERA],['p.COD_PLECTIVO','=',$matricula->COD_PLECTIVO],null);


        }
        else
        {
//            $this->forupdate($request, $complexivo->N_ID);
        }

        DB::table('users')->insert(['email' => 'john@example.com', 'votes' => 0]);

    }


}