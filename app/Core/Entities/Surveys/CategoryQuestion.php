<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 24/10/16
 * Time: 03:34 PM
 */

namespace UGCore\Core\Entities\Surveys;


use UGCore\Core\Entities\CoreModel;

class CategoryQuestion extends CoreModel
{
    protected $table="Surveys.categories_questions";
    protected $connection= "sqlsrv_modulos";
    protected $hidden=['created_at','updated_at'];
}