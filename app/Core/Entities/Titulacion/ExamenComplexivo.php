<?php

namespace UGCore\Core\Entities\Titulacion;
use UGCore\Core\Entities\CoreModel;


class ExamenComplexivo extends CoreModel
{
    protected $connection = "sqlsrv_bdacademico";

    protected $table = "TB_EXAMEN_GRACIA";

    protected $fillable=['COD_ESTUDIANTE'
                        ,'NOTA'
                        ,'FECHA'
                        ,'NOMBRE_MATERIA'
                        ,'COD_CARRERA'
                        ,'OBSERVACION'
                        ,'RESPONSA1'
                        ,'FECSYS1'
                        ,'COD_MATERIA'
                        ,'COD_PLECTIVO'
                        ,'ESTADO'
                        ,'TIPO'
                        ,'NIVEL'
                        ,'VEZ'
                        ,'RECUP'
                        ,'REP_INASIST'
                        ,'NOTAC'];

    protected $primaryKey = 'NUM_SECUENCIA';

    //relacion con tabla datos
    public function matricula()
    {
        return $this->belongsTo(Matricula::class,'MATRICULA_ID','N_ID');
    }
}