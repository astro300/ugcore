<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 19/10/16
 * Time: 04:25 PM
 */

namespace UGCore\Core\Entities\Surveys;

use UGCore\Core\Entities\CoreModel;

class CategorySurvey extends CoreModel
{
    protected $table="Surveys.categories_surveys";
    protected $connection= "sqlsrv_modulos";
    protected $hidden=['created_at','updated_at'];

    public function surveys()
    {
        return $this->hasMany(Survey::class,'category_survey_id','id');
    }

}