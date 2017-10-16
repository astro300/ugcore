<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 25/10/16
 * Time: 09:01 AM
 */

namespace UGCore\Core\Entities\Surveys;


use UGCore\Core\Entities\CoreModel;

class Question extends CoreModel
{
    protected $table="Surveys.questions";
    protected $connection= "sqlsrv_modulos";

    public function questionoptions(){
        return $this->hasMany(QuestionOption::class,'question_id','id');
    }
    public function questionoptionsactive(){
        return $this->hasMany(QuestionOption::class,'question_id','id')->where('status','A');
    }

    public function surveyquestions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    public function categoryquestion()
    {
        return $this->belongsTo(CategoryQuestion::class,'category_question_id','id');
    }

    public function typequestion()
    {
        return $this->belongsTo(TypeQuestion::class,'type_question_id','id');
    }
}