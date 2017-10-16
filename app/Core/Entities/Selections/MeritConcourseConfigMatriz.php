<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 21/6/2017
 * Time: 12:29
 */

namespace UGCore\Core\Entities\Selections;

use UGCore\Core\Entities\Comun\SelectsBasics;
use UGCore\Core\Entities\CoreModel;

class MeritConcourseConfigMatriz extends CoreModel
{

    public $timestamps = true;

    protected $table = 'Concourse.merit_concourse_configs_matriz';
    protected $connection= "sqlsrv_modulos";
    protected $fillable=['merit_concourse_config_id','extends_id','specific_id','detail_id','max_tc','max_tm'];

    public function concourseConfig(){
        return $this->belongsTo(MeritConcourseConfig::class,'merit_concourse_config_id','id');
    }

    public function concourseMatrizDetail(){
        return $this->hasMany(MeritConcourseConfigMatrizDetail::class,'merit_concourse_config_matriz_id','id');
    }

    public function extendsField(){
        return $this->belongsTo(SelectsBasics::class,'extends_id');
    }
    public function specificField(){
        return $this->belongsTo(SelectsBasics::class,'specific_id');
    }
    public function detailField(){
        return $this->belongsTo(SelectsBasics::class,'detail_id');
    }
}