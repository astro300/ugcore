<?php

namespace UGCore\Core\Entities\Titulacion;

use Illuminate\Database\Eloquent\Model;

class MTEstudianteTesis extends Model
{
    protected $table      = 'TB_ESTUDIANTE_TESIS';
    protected $connection = 'sqlsrv_bdacademico';
    protected $primaryKey = array('COD_TESIS', 'COD_ESTUDIANTE');
    protected $fillable   =['COD_TESIS',
        'COD_ESTUDIANTE',
        'NOTA',
        'RESPONSA1',
        'RESPONSA2',
        'FECSYS1',
        'FECSYS2',
        'NOTA_R',
        'NOTA_T',
        'COD_MATERIA',
        'COD_PLECTIVO'];
}