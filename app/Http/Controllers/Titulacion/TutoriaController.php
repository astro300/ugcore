<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTrabajoSeguimientoRepository;
use UGCore\Facades\Messages;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Security\User;

use DB;

class TutoriaController extends Controller
{
        private $datosRPY;

        public function __construct(MTrabajoSeguimientoRepository $datosRPY)
    {
        $this->datosRPY = $datosRPY;
    }
        
        public function index(){

       $objSelect=new SelectController();
       $faculties=$objSelect->getfaculty();

    	return view('Titulacion/tutorias',compact('faculties'));
    }
    public function store(request $request)
    {
/*

        $this->validate($request,['tema'=>'required','facultad'=>'required','carrera'=>'required','ciclo'=>'required','area_investigacion'=>'required']);
        try{
            $this->datosRPY->forSave($request);
            Messages::infoRegisterCustom('GUARDADO EXISTOSO');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }

        return redirect()->route('titulacion.trabajo.inscripcion.index');*/
    }
    public function datatables(){
          return $this->datosRPY->datatablesDatos();
        }
 }