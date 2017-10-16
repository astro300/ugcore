<?php

namespace UGCore\Core\Entities\Preprofessional;

use Illuminate\Database\Eloquent\Model;
use UGCore\Core\Entities\CoreModel;

use Carbon;
class PreprofessionalActivity extends CoreModel
{
    protected $hidden=['created_at','updated_at'];

	 protected $conection="sqlsrv_modulos";
     protected $table ="modulos.Preprofesionales.activity";

     public function anexos(){
         return $this->hasMany(PreprofessionalActivityAnexo::class,'id_activity','id');
     }

    public function getCreatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }

}