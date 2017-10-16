<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 16/8/2017
 * Time: 11:10
 */

namespace UGCore\Core\Entities\Uath;
use UGCore\Core\Entities\CoreModel;


class HorasExtrasPlanificacionValAdicionales extends CoreModel
{
    public $timestamps = true;
    protected $fillable=['IDPLANIFICACION','VALEXTRAS','VALDECTER','VALAPORPAT','VALFONRES','TOTALAD','ESTADO','user_created','user_modificated'];

    protected $table = 'HorasExtras.Planificacion_ValAdicionales';
    protected $connection= "sqlsrv_bdrrhh";
}