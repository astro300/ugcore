<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 26/6/2017
 * Time: 15:01
 */

namespace UGCore\Core\Entities\Selections;


use UGCore\Core\Entities\Comun\SelectsBasics;
use UGCore\Core\Entities\CoreModel;

class MeritConcourseConfigMatrizDetail extends CoreModel
{
    public $timestamps = true;
    protected $fillable=['merit_concourse_config_matriz_id','discipline_id'];

    protected $table = 'Concourse.merit_concourse_configs_matriz_detail';
    protected $connection= "sqlsrv_modulos";

    public function concourseMatriz(){
        return $this->belongsTo(MeritConcourseConfigMatriz::class,'merit_concourse_config_matriz_id','id');
    }

    public function disciplineField(){
        return $this->belongsTo(SelectsBasics::class,'discipline_id');
    }

}