<?php

namespace UGCore\Core\Entities\Security;


use Utils;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	 protected $table ="roles";


	  public function scopeSearch($query,$name){
        return $query->where('name','LIKE',"%$name%");
    }

     public function roleoptions()
    {
        return $this->hasMany(RolesOption::class);
    }

       public function roleusers()
    {
        return $this->hasMany(RolesUser::class);
    }

    public static function findName($name){
        return Role::where('name',$name)->first();
    }

    protected function getDateFormat()
    {
        return Utils::getFormatDateSQL(true,true);
    }

    public function getCreatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::createFromTimeStamp(strtotime($value));
    }


}