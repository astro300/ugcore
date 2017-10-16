<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 01/08/17
 * Time: 19:03
 */

namespace UGCore\Core\Entities\Selections;


use UGCore\Core\Entities\CoreModel;

class MeritConcourseConfigComision extends CoreModel
{

    public $timestamps = true;

    protected $table = 'Concourse.merit_concourse_comisiones';
    protected $connection= "sqlsrv_modulos";

}