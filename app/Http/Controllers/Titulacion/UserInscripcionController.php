<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTInscripcionñ;
use UGCore\Facades\Messages;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Security\User;

use DB;

class UserInscripcionController extends Controller
{


    public function index()
    {
    	$objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();

    	return view('titulacion.trabajoinscripcion')->with(['faculties'=>$faculties]);

    }
        public function parametros($parametros)
    {
        
    	
        $objSelect=new SelectController();
        return $objSelect->SearchPerson($parametros,'json');


      }

        public function datatables(){
          return $this->datosRPY->datatablesDatos();
        }
       

    	

    
}
