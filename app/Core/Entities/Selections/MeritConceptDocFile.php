<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 29/4/2017
 * Time: 12:34
 */

namespace UGCore\Core\Entities\Selections;


use UGCore\Core\Entities\CoreModel;

class MeritConceptDocFile extends CoreModel
{
    protected $table = 'Concourse.merit_concepts_doc_fields';
    protected $connection= "sqlsrv_modulos";

    public function concourseConcept(){
        return $this->belongsTo(MeritConcourseConcept::class,'merit_concourse_concept_id','id');
    }

    public function documentField(){
        return $this->belongsTo(MeritTypeDocumentField::class,'merit_type_document_field_id','id');
    }
}
