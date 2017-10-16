<?php

namespace UGCore\Core\Entities\Selections;

use Illuminate\Database\Eloquent\Model;
use Utils;
use Carbon;
class MeritInputMaster extends Model
{
     protected $table="Concourse.merit_input_masters";
      protected $connection= "sqlsrv_modulos";

      public function meritconcourseconfig(){
      	 return $this->belongsTo(MeritConcourseConfig::class,'merit_concourse_config_id','id');
      }

      public function meritinputdetails(){
      		return $this->hasMany(MeritInputDetail::class,'merit_input_master_id','id');
      }



    public static function getByUserConcourse($concourse,$user)
    {
        return MeritInputMaster::where('merit_concourse_config_id','=',$concourse)->where('user_id','=',$user)->first();
    }

    public static function processMasterConcourse($concourse,$userID,$ip){
        $objResponseMaster = MeritInputMaster::getByUserConcourse($concourse, $userID,$ip);
        if ($objResponseMaster == null) {
            $objResponseMaster = new MeritInputMaster();
            $objResponseMaster->user_id = $userID;
            $objResponseMaster->created_by =$userID;
            $objResponseMaster->updated_by =$userID;
            $objResponseMaster->created_ip = $ip;
            $objResponseMaster->updated_ip = $ip;
            $objResponseMaster->merit_concourse_config_id = $concourse;
            $objResponseMaster->status = 'P';
            $objResponseMaster->date_open = Utils::getDateSQL();
            $objResponseMaster->save();
        }
        return $objResponseMaster;
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

    public function matriz(){
        return $this->belongsTo(MeritConcourseConfigMatriz::class,'merit_concourse_matriz_id');
    }
}
