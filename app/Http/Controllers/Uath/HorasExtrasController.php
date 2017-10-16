<?php

namespace UGCore\Http\Controllers\Uath;

use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Uath\HorasExtrasRepository;
use Validator;
use Input;
use Auth;

class HorasExtrasController extends Controller
{
    private $objHExtra;

    public function __construct()
    {
        $this->objHExtra = new HorasExtrasRepository();
    }

    public function index()
    {
        return view('uath.horasextras.planificacion.index')
        ->with(['lista_periodo' => $this->objHExtra->forListaPeriodoss()->toArray(),
            'lista_dependencias'=>$this->objHExtra->forDependenciasUnidad(Auth::user()->name)]);
    }

    public function getDatosFuncionario($cedula){
        $datosfun=$this->objHExtra->forDatosFuncionario($cedula);
        if($datosfun==[])
            return 0;
        else
            return $datosfun;
    }

    public function getDatosFunHorario($cedula){
        return $this->objHExtra->forDatosFuncionarioHorario($cedula);
    }

    public function getCalculo($cedula){
        $datosHorario= $this->objHExtra->forDatosHorarioExistente($cedula);
        if($datosHorario==[])
            return 0;
        else
            return $datosHorario;
    }

    public function createPlanificacion($uni,$per,$fec,$des){
        return $this->objHExtra->forCreatePlanificacion($uni,$per,$fec,$des);
    }

    public function getDatosPlanificacion(){
        return $this->objHExtra->datosPlanificacion(Auth::user()->name);
    }

    public function borraPlanificacion($id){
        return $this->objHExtra->delPlanificacion($id);
    }

    public function empleadosPlanificacion($idpla){
        return view('uath.horasextras.planificacion.ingresopla');
    }

}