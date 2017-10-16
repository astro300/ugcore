<?php

namespace UGCore\Core\Entities\Preprofessional;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use UGCore\Core\Entities\CoreModel;

class PreprofessionalUsers extends CoreModel
{
	 protected $conection="sqlsrv_modulos";
     protected $table ="modulos.Preprofesionales.users";

     protected $fillable=['alternative_email','phone','institution_email','direccion','observacion','status_asignation'];

    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }
    public function getCreatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }

    public function documents(){
        return $this->hasMany(PreprofessionalDocuments::class,'id_student');
    }

    public function documentsBY($type){
        return $this->documents()->where('id_student','=',$this->id)
            ->where('type','=',$type)->get();
    }



}