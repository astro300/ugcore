<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 15/12/16
 * Time: 12:52
 */

namespace UGCore\Core\Entities\Surveys;


use UGCore\Core\Entities\CoreModel;

class DetailResponseSurvey extends CoreModel
{
    protected $table="Surveys.detail_response_surveys";
    protected $connection= "sqlsrv_modulos";

    public function headResponseSurvey(){
        return $this->belongsTo(HeadResponseSurvey::class,'head_response_survey_id');
    }
}
