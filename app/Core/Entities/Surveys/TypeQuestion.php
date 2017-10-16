<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 24/10/16
 * Time: 05:05 PM
 */

namespace UGCore\Core\Entities\Surveys;


use UGCore\Core\Entities\CoreModel;

class TypeQuestion extends CoreModel
{
    protected $table="Surveys.types_questions";
    protected $connection= "sqlsrv_modulos";
    protected $hidden=['created_at','updated_at'];
}