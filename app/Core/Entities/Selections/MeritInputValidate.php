<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 27/07/17
 * Time: 11:31
 */

namespace UGCore\Core\Entities\Selections;


use UGCore\Core\Entities\CoreModel;

class MeritInputValidate extends CoreModel
{
    protected $table="Concourse.merit_input_evaluations";
    protected $connection= "sqlsrv_modulos";
}