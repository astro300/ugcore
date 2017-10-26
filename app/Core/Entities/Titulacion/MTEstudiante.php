<?php

namespace UGCore\Core\Entities\Titulacion;

use Illuminate\Database\Eloquent\Model;

class MTEstudiante extends Model
{
    // use SoftDeletes;
    protected $table='TB_TESIS';
    protected $connection='sqlsrv_bdacademico';
    protected $primaryKey='COD_TESIS';
    protected $fillable=['COD_CARRERA',
        'COD_TESIS',
        'ESTADO',
        'FECHA_APRONEGA',
        'FECHA_PRESENTO',
        'FECHA_SUSTENTO',
        'FECSYS1',
        'FECSYS2',
        'RESPONSA1',
        'RESPONSA2',
        'TEMA',
        'TIPT',
        'COD_PLECTIVO',
        'AREA_INVESTIGACION_ID'
    ];
}
