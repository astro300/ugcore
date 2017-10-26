<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTDocenteInscripcionRepository;
use UGCore\Http\Controllers\Controller;
use UGCore\Http\Controllers\Ajax\SelectController;

class DocenteInscripcionController extends Controller
{
    private $datosRPY;

    public function __construct(MTDocenteInscripcionRepository $datosRPY)
    {
        $this->datosRPY = $datosRPY;
    }

    public function datatables()
    {
        return $this->datosRPY->datatablesDatos();
    }

    public function getDocenteTesis($cedula)
    {
        $objSelect = new SelectController();
        return $objSelect->searchDocenteTitulacion($cedula, 'json');
    }

    public function getDocenteCarreras($cedula)
    {
        $objSelect = new SelectController();
        return $objSelect->searchDocenteCarreraTitulacion($cedula, 'json');
    }
}
