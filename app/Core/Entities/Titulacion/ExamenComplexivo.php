<?php

namespace UGCore\Core\Entities\Titulacion;
use UGCore\Core\Entities\CoreModel;


class ExamenComplexivo extends CoreModel
{
    protected $connection = "sqlsrv_BdTitulacion";

    protected $table = "TB_TIT_EXAMEN_COMPLEXIVO";

    protected $fillable=['MATRICULA_ID','NOTA_COMPLEXIVO','NOTA_GRACIA','OBSERVACION'];

    protected $primaryKey = 'N_ID';

    //relacion con tabla datos
    public function MATRICULA()
    {
        return $this->belongsTo(Matricula::class,'MATRICULA_ID','N_ID');
    }
}
