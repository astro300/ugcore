<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTTitulacionRepository;
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
/*
     	 $ciclo= DB::connection('sqlsrv_bdacademico')->table('TB_PLECTIVO')
    	->where('COD_CARRERA','=','0301')
    	->pluck('DESCRIPCION','COD_PLECTIVO')->toArray();

*/
    	return view('titulacion.trabajoinscripcion')->with(['faculties'=>$faculties]);

    }

    public  function  ListadoTrabajoTitulacion()
    {
        $objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();
        return view('titulacion.titulacion')->with(['faculties'=>$faculties]);

    }

    public function RegistroNotas()
    {
        $objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();
        return view('titulacion.RegistroNotasSustentacion')->with(['faculties'=>$faculties]);
    }

    public  function ListTrabTituxCarreras($id)
    {

    }
}
