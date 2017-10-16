<?php

namespace UGCore\Core\Entities\Surveys;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use UGCore\Core\Entities\CoreModel;

class HeadResponseSurvey extends CoreModel
{
    protected $table="Surveys.head_response_surveys";
    protected $connection= "sqlsrv_modulos";


    public function detailResponseSurveys($status){
        return $this->hasMany(DetailResponseSurvey::class,'head_response_survey_id')->whereIn('status',$status);
    }
    public function detailResponseSurveysASSOC($status){
        return ($this->hasMany(DetailResponseSurvey::class,'head_response_survey_id')->whereIn('status',$status)->select('surveys_question_id')->groupBy('surveys_question_id')->pluck('surveys_question_id')->toArray());
    }
    public function questionResponseSurveys($status){
        $dataTMP= $this->hasMany(DetailResponseSurvey::class,'head_response_survey_id')
            ->where('head_response_survey_id','=',$this->id)->whereIn('status',$status)->select('surveys_question_id','response')->get();
        $result=[];
        foreach ($dataTMP as $item){
            $result[$item->surveys_question_id][]=$item->response;
        }
        return $result;
    }

    public function survey(){
        return $this->belongsTo(Survey::class,'survey_id');
    }
    public function getDateResponseLastCarbon(){
        if($this->data_response_last==null){
        return '-';
        }
        return Carbon::createFromTimeStamp(strtotime($this->data_response_last))->diffForHumans();
    }

    public function getFullStatus(){
        $array=['C'=>'EN CURSO','F'=>'FINALIZADA'];
        if(!array_key_exists($this->status_response,$array)){
            return '-';
        }
        return $array[$this->status_response];
    }

}
