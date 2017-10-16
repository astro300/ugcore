<?php

namespace UGCore\Core\Entities\Preprofessional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use UGCore\Core\Entities\CoreModel;


class PreprofessionalDocuments extends CoreModel
{
    use SoftDeletes;
	 protected $conection="sqlsrv_modulos";
     protected $table ="modulos.Preprofesionales.documents";


     public function user(){
         return $this->belongsTo(PreprofessionalUsers::class,'id_student');
     }
}