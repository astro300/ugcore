<?php
namespace UGCore\Core\Entities\Academico;
use UGCore\Core\Entities\CoreModel;

/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 12/12/2016
 * Time: 12:51
 */
class tb_docente_dacademico extends CoreModel
{
    public $timestamps = false;

    protected $table = 'TB_DOCENTE_DACADEMICO';
    protected $connection= "sqlsrv_bdacademico";

    protected $primaryKey= "COD_CARRERA";
    protected $fillable=['COD_DOCENTE','COD_ANTERIOR','COD_CARRERA','ESTADO','FECHA_INGRESO',
        'FECHA_SALIDA','VALOR_HORA','RESPONSA1','RESPONSA2','FECSYS1','FECSYS2'];
}