<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 27/10/16
 * Time: 02:34 PM
 */

namespace UGCore\Core\Entities\Surveys;


use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use UGCore\Core\Entities\CoreModel;
use Utils;

class Survey extends CoreModel
{
    Use Sluggable,SluggableScopeHelpers;
    protected $table="Surveys.surveys";
    protected $connection= "sqlsrv_modulos";

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }



    public function categorysurvey()
    {
        return $this->belongsTo(CategorySurvey::class,'category_survey_id','id');
    }


    public function surveyquestions()
    {
        return $this->hasMany(SurveyQuestion::class)->where('status','A');
    }

    public function getDateCarbon(){
        if($this->date_start==null || $this->date_end==null){
            return '-';
        }


        return date(Utils::getFormatDateSQL(true,false),strtotime($this->date_start)).' hasta: '.date(Utils::getFormatDateSQL(true,false),strtotime($this->date_end));
    }
}