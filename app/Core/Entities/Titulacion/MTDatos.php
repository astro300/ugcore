<?php

/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 4/9/2017
 * Time: 10:12
 */
namespace UGCore\Core\Entities\Titulacion;
use UGCore\Core\Entities\CoreModel;

class MTDatos extends CoreModel
{
   // use SoftDeletes;
    protected $table='TB_TIT_PARAMETRO';
    protected $connection='sqlsrv_bdacademico';
    protected $primaryKey='N_ID';
    protected $fillable =  ['COD_TIPO_PARAMETRO',
                            'COD_CARRERA',
                            'COD_PLECTIVO',
                            'FECHA_INICIO',
                            'FECHA_FIN',
                            'ESTADO',
                            'USUARIO_INGRESO',
                            'USUARIO_ACTUALIZA',
                            'TIPO'];
}