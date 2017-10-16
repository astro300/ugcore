<?php

namespace UGCore\Core\Entities\Comun;

use UGCore\Core\Entities\CoreModel;

class EmailQueue extends CoreModel
{
	protected $table ="CorreosEnviadosEstudiantes";
    protected $connection= "sqlsrv_parametros";

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;


    protected $fillable=['COD_ESTUDIANTE'
        ,'NOMBRE_COMPLETO'
        ,'EMAIL_INSTITUCIONAL'
        ,'EMAIL_PERSONAL'
        ,'EMAIL_SIUG'
        ,'PROCESO_CORREO'
        ,'FECHA_REGISTRO'
        ,'FECHA_PROCESO'
        ,'ESTADO'
        ,'ASUNTO'
        ,'CONTENIDO_CORREO'
        ,'CC'
        ,'CCO'
        ,'OBSERVACION'];

}