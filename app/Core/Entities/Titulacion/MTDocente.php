<?php

namespace UGCore\Core\Entities\Titulacion;

use Illuminate\Database\Eloquent\Model;

class MTDocente extends Model
{
    protected $table      =  'TB_TESIS_TUTORES';
    protected $connection =  'sqlsrv_bdacademico';
    protected $fillable   = ['COD_CARRERA',
                             'COD_PLECTIVO',
                             'COD_TESIS',
                             'COD_DOCENTE',
                             'ESTADO',
                             'TIPO_DOCENTE',
                             'OBSERVACION'];
    protected $primaryKey='N_ID';
}
