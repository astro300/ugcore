<?php

/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 19/7/2017
 * Time: 14:51
 */
namespace UGCore\Core\Entities\Uath;
use UGCore\Core\Entities\CoreModel;

class HorasExtrasPlanificacion extends CoreModel
{
    public $timestamps = true;
    protected $fillable=['IDMATRIZ','IDPERIODO','DESCRIPCION','ESTADO','FECHA_INICIO','FECHA_FIN','TOTAL','user_created','user_modificated'];

    protected $table = 'HorasExtras.Planificacion';
    protected $connection= "sqlsrv_bdrrhh";
}
