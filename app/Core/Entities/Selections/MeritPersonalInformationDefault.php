<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 26/4/2017
 * Time: 10:47
 */

namespace UGCore\Core\Entities\Selections;


class MeritPersonalInformationDefault
{
    public $cedula;
    public $nombres;
    public $apellidos;
    public $fecha_nacimiento;
    public $nacionalidad;
    public $idEstadoCivil;
    public $email;
    public $celular;
    public $idSexo;
    public $idProvDir;
    public $idCiudadDir;
    public $direccionDir;
    public $idTelefonoDir;
    public $idProvLab;
    public $idCiudadLab;
    public $direccionLab;
    public $telefonoLab;
    public $fechaIngreso;
    public $fechaActualiza;
    public $estado;
    public $archivo_foto;

    public function defaultData()
    {
        $this-> cedula=\Auth::user()->name;
        $this-> nombres=\Auth::user()->first_name;
        $this-> apellidos=\Auth::user()->last_name;
        $this-> fecha_nacimiento='';
        $this-> nacionalidad='';
        $this-> idEstadoCivil='';
        $this-> email=\Auth::user()->email;
        $this-> celular='';
        $this-> idSexo=\Auth::user()->sex;
        $this-> idProvDir=0;
        $this-> idCiudadDir=0;
        $this-> direccionDir='';
        $this-> telefonoDir='';
        $this-> idProvLab=0;
        $this-> idCiudadLab=0;
        $this-> direccionLab='';
        $this-> telefonoLab='';
        $this-> fechaIngreso='0';
        $this-> fechaActualiza=0;
        $this-> estado='A';
        $this-> archivo_foto='';
    }
}