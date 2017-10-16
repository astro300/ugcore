<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 15/11/16
 * Time: 14:41
 */

namespace UGCore\Core\Entities\Selections;


use Carbon\Carbon;
use UGCore\Core\Entities\CoreModel;

class MeritConcourseConcept extends CoreModel
{

    public $timestamps = true;
    protected $table = 'Concourse.merit_concourse_concepts';
    protected $connection= "sqlsrv_modulos";

    public function document(){
        return $this->belongsTo(Merittypedocument::class,'merittypedocument_id','id');
    }

    public function conceptDocFiles(){
        return $this->hasMany(MeritConceptDocFile::class,'merit_concourse_concept_id','id')->where('status','=','A');
    }

public function meritsubcategory(){
        return $this->belongsTo(MeritCategory::class,'meritsubcategory_id');
}


}