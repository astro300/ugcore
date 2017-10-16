<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 26/4/2017
 * Time: 12:16
 */

namespace UGCore\Core\Entities\Selections;
use UGCore\Core\Entities\CoreModel;

class MeritPersonalInformation extends CoreModel
{
    public $timestamps = false;

    protected $table = 'Concourse.merit_personal_information';
    protected $connection= "sqlsrv_modulos";

    protected $primaryKey= "id";
    protected $fillable=['id','cedula','nombres','apellidos','fecha_nacimiento','nacionalidad','idEstadoCivil','email','celular','idSexo','idProvDir'
        ,'idCiudadDir','telefonoDir','idProvLab','idCiudadLab','telefonoLab','fechaIngreso','fechaActualiza','estado','archivo_foto'];
}