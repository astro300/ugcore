<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 25/7/2017
 * Time: 15:29
 */

namespace UGCore\Core\Entities\Uath;
use UGCore\Core\Entities\CoreModel;

class HorasExtrasPlanificacionEmpleado extends CoreModel
{
    public $timestamps = true;
    protected $fillable=['IDPLANIFICACION','ID_DATOS_PERSONAL','TIPO','CEDULA','NOMBRES_COMPLETOS','CARGO','RMU','HORARIO','DTRABREG','MODALIDAD','HORAS_JORNADA','HE','HS','HN','VHE','VHS','VHN','MONTO','ACTIVIDAD','UBICACION','ESTADO','user_created','user_modificated'];

    protected $table = 'HorasExtras.Planificacion_Empleados';
    protected $connection= "sqlsrv_bdrrhh";
}