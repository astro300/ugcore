<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 18/01/17
 * Time: 14:05
 */

namespace UGCore\Core\Entities\Selections;


use UGCore\Core\Entities\Comun\SelectsBasics;
use UGCore\Core\Entities\CoreModel;

class MeritConcourseStep extends CoreModel
{
    public $timestamps = true;
    protected $table = 'Concourse.merit_concourse_config_steps';
    protected $connection= "sqlsrv_modulos";

    protected  $fillable=['merit_concourse_config_id'
        ,'select_basic_id'
        ,'created_at'
        ,'updated_at'
        ,'created_by'
        ,'updated_by'
        ,'created_ip'
        ,'updated_ip'
        ,'status'
        ,'date_start'
        ,'date_end'
        ,'ubication',
        'step_old'];

    public function concourse(){
        return $this->belongsTo(MeritConcourseConfig::class,'merit_concourse_config_id','id');
    }
    public function step(){
        return $this->belongsTo(SelectsBasics::class,'select_basic_id');
    }
}