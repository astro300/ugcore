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
        $nsec = 0;
        $array_response = [];
        $array_response['status'] = 200;
        $array_response['message'] = 'Operación realizada con éxito';

        if($num_secuncia != null && $num_secuncia != '' && $num_secuncia != 'null')
        {
            $num_secuncia = substr($num_secuncia, 0,-1);
            $array_sec = preg_split("/,/", $num_secuncia);
            $nsec = count( $array_sec);
        }

        if($nsec > 1){
            $sec1 = $array_sec[0];
            $sec2 = $array_sec[1];
        }
        else{
            if($nsec == 1 ){
                $sec1 = $array_sec[0];
            }
        }
        $matricula = Matricula::find($id);
        

        $Resp = DB::connection('sqlsrv_bdacademico')
                ->select('EXEC SP_NOTAS_TIT_COMPLEXIVO_INSERTORUPDATE ?,?,?,?,?,?,?'
                    , [$matricula->NUM_IDENTIFICACION
                    , $matricula->COD_CARRERA
                    , $matricula->COD_PLECTIVO
                    , $request->NOTA_COMPLEXIVO
                    , $request->NOTA_GRACIA
                    , $sec1
                    , $sec2]);

        if($Resp[0]->RESULT != 0){
            $array_response['status']=404;
            $array_response['message']='No hay datos para registrar';
        }
        return $array_response;

    }


}