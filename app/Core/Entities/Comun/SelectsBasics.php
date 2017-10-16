<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 09/01/17
 * Time: 16:04
 */

namespace UGCore\Core\Entities\Comun;


use UGCore\Core\Entities\CoreModel;
use UGCore\Core\Entities\Selections\MeritConcourseConfig;

class SelectsBasics extends CoreModel
{    protected $connection= "sqlsrv_modulos";
    protected $table = 'catalogos.select_basics';

    public function fatherSelectBasic()
    {
        return $this->belongsTo(SelectsBasics::class,'father','id');
    }

    public function getChildrens()
    {
        return $this->hasMany(SelectsBasics::class,'father','id');
    }

    public function getConcourses(){
        return $this->belongsTo(MeritConcourseConfig::class,'select_basic_id','id')
            ->where('status','=','A');
    }
}