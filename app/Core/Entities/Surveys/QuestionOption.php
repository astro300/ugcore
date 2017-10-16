<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 26/10/16
 * Time: 03:15 PM
 */

namespace UGCore\Core\Entities\Surveys;


use UGCore\Core\Entities\CoreModel;

class QuestionOption extends CoreModel
{
    protected $table="Surveys.questions_options";
    protected $connection= "sqlsrv_modulos";


    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
}