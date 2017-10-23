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

    public function getDtExamenComplexivo($idcarrera)
    {
        return DataTables::of(DB::connection('sqlsrv_bdacademico')
            ->select('EXEC SP_NOTAS_TITULACION_COMPLEXIVO_2 ?', [$idcarrera]))->make(true);
    }

    protected function forupdate(Request $request,$id)
    {
        $objComplexivo = ExamenComplexivo::findOrfail($id);
        $objComplexivo->fill($request->all());
        $objComplexivo->save();
    }

    public function forSaveOrUpdate(Request $request, $id,$num_secuncia)
    {

        $array_sec = [];
        $sec1 = 0;
        $sec2 = 0;


        if($num_secuncia != null && $num_secuncia != '')
        {
            $num_secuncia = substr($num_secuncia, 0,-1);
            $array_sec = preg_split("/,/", $num_secuncia);

        }
        $nsec = count( $array_sec);
        if($nsec > 1){
            $sec1 = $array_sec[0];
            $sec2 = $array_sec[1];
        }
        else{
            if($nsec = 1 ){
                $sec1 = $array_sec[0];
            }
        }


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