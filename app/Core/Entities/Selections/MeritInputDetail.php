<?php

namespace UGCore\Core\Entities\Selections;

use Illuminate\Database\Eloquent\Model;
use Utils;
class MeritInputDetail extends Model
{
    protected $table="Concourse.merit_input_details";
    protected $connection= "sqlsrv_modulos";

     public function meritinputmaster(){
      	return $this->belongsTo(MeritInputMaster::class,'merit_input_master_id','id');
      }

     protected function getDateFormat()
    {
    	return Utils::getFormatDateSQL(true,true);
    }

    public function meritConcourseConcept(){
         return $this->belongsTo(MeritConcourseConcept::class,'merit_concourse_concept_id','id');
    }
}
