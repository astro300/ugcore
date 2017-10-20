<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTrabajoInscripcionRepository;
use UGCore\Facades\Messages;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Security\User;

use DB;

class UserInscripcionController extends Controller
{

    private $datosRPY;

        public function __construct(MTrabajoInscripcionRepository $datosRPY)
    {
        $this->datosRPY = $datosRPY;
    }
    public function index()
    {
    	$objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();
        $tipo_docente=$objSelect->getTutorCategoria();
        $area_investigacion=$objSelect->getAreaCarrera();

    	return view('titulacion.trabajoinscripcion')->with(['area_investigacion'=>$area_investigacion,'tipo_docente'=>$tipo_docente,'faculties'=>$faculties]);

    }

    public function store(request $request)
    {

    /*
        $this->validate($request,['modulo'=>'required|numeric','etapa'=>'required',            'ciclo'=>'required','fecha_inicio'=>'date','fecha_final'=>'date|date_after_or_equal:fecha_inicio']);

        try{
            $this->datosRPY->forSave($request,$request->todas_facultades=='1'?true:false);
            Messages::infoRegisterCustom('GUARDADO EXISTOSO');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }

        return redirect()->route('titulacion.configuraciones.index');


    */


        $this->validate($request,['tema'=>'required','facultad'=>'required','carrera'=>'required','ciclo'=>'required']);
        try{
            $this->datosRPY->forSave($request);
            Messages::infoRegisterCustom('GUARDADO EXISTOSO');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }

        return redirect()->route('titulacion.trabajo.inscripcion.index');
    }
        public function parametros($cedula)
      {
        
    	
        $objSelect=new SelectController();
        return $objSelect->SearchPerson_Titulacion($cedula,'json');


      }

        public function datatables(){
          return $this->datosRPY->datatablesDatos();
        }

        public function parametrosestudianteCarrera($cedula)
        {
            $objSelect=new SelectController();
        return $objSelect->SearchPersonCarrera_Titulacion($cedula,'json');

        }

        public function DatosTrabajoTitulacion($carrera)
        {
            
            $objSelect=new SelectController();
        return $objSelect->SearchPersonTesis_Titulacion($carrera,'json');

        }
       

    	

    
}
