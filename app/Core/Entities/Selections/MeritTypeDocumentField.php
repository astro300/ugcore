<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 26/04/17
 * Time: 17:10
 */

namespace UGCore\Core\Entities\Selections;


use UGCore\Core\Entities\CoreModel;

class MeritTypeDocumentField extends CoreModel
{
    public $timestamps = true;
    protected $connection= "sqlsrv_modulos";
    protected $table = 'Concourse.merit_type_documents_fields';

    public function meritTypeDocument(){
        return $this->belongsTo(Merittypedocument::class,'merittypedocument_id','id');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['created_at']);
    }

    public function getApdatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['updated_at']);
    }
}