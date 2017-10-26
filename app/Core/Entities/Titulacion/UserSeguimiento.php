<?php

namespace UGCore\Core\Entities\Titulacion;
use UGCore\Core\Entities\CoreModel;

class UserSeguimiento extends CoreModel
{
   // use SoftDeletes;
    protected $table='TB_TESIS_CONTROL';
    protected $connection='sqlsrv_bdacademico';
    protected $primaryKey='N_ID';
    protected $fillable =  ['COD_TESIS',
                            'TESIS_TUTORES_ID',
                            'COD_ESTUDIANTE',
                            'FECHA_REG',
                            'ESTADO',
                            'OBSERVACION',
                            'RESPONSA1',
                            'ARCHIVO'
                            ];
}