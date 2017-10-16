<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 12/12/2016
 * Time: 17:28
 */

namespace UGCore\Core\Entities\Academico;


use UGCore\Core\Entities\CoreModel;

class tb_docente_materia extends CoreModel
{
    public $timestamps = false;

    protected $table = 'TB_DOCENTE_MATERIA';
    protected $connection= "sqlsrv_bdacademico";

    protected $primaryKey= "N_ID";
    protected $fillable=['COD_CARRERA','COD_DOCENTE','COD_MATERIA','COD_PLECTIVO','NIVEL','OBSERVACION','N_ID'];
}