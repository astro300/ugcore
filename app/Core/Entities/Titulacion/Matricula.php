<?php

namespace UGCore\Core\Entities\Titulacion;
use UGCore\Core\Entities\CoreModel;

class Matricula extends CoreModel
{
    protected $connection = "sqlsrv_BdTitulacion";

    protected $table = "TB_TIT_MATRICULA";


    protected $fillable=['TIPO_IDENTIFICACION','NUM_IDENTIFICACION','COD_CARRERA','COD_PLECTIVO','TIPO_MATRICULA','TIPO_PROCESO','TIPO_MODALIDAD'];

    protected $primaryKey = 'N_ID';

    public function examen_complexivo()
    {
        return $this->hasMany(ExamenComplexivo::class,'MATRICULA_ID','N_ID');
    }
}
