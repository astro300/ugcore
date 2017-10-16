<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 29/10/16
 * Time: 13:14
 */

namespace UGCore\Core\Entities\Surveys;


use UGCore\Core\Entities\CoreModel;

class SurveyQuestion extends CoreModel
{
    protected $table="Surveys.surveys_questions";
    protected $connection= "sqlsrv_modulos";

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /*
     *  select id from [Surveys].surveys_questions where survey_id=4 and status='A' and
  id not in(  select surveys_question_id from [Surveys].[detail_response_surveys]
   where head_response_survey_id=7 and status ='A')
     * */

    public static function getNotQuestionResponse($survey,$headResponseSurvey){
        return SurveyQuestion::where('survey_id','=',$survey)
            ->where('status','=','A')
            ->whereNotIn('id',DetailResponseSurvey::where('head_response_survey_id','=',$headResponseSurvey)->where('status','=','A')
                ->select('surveys_question_id')->get()->toArray())
            ->get();
    }
}