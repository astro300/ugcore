<?php

namespace UGCore\Http\Controllers\Titulacion;


//use UGCore\Core\Entities\Titulacion\MTDatos;
use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTTitulacionRepository;
use UGCore\Facades\Messages;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Security\User;

use DB;
class ConfiguracionController extends Controller
{
	private $datosRPY;

	    public function __construct(MTTitulacionRepository $datosRPY)
    {
        $this->datosRPY = $datosRPY;
    }
    public function index()
    {
    	//  $table=$this->datosRPY->getData();
      	$objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();

     	 $ciclo= DB::connection('sqlsrv_bdacademico')->table('TB_PLECTIVO')
    	->where('ESTADO','=','T')
    	->pluck('DESCRIPCION','COD_PLECTIVO')->toArray();

       	$modulo=['1'=>'TITULACIÓN','2'=>'EXAMEN COMPLEXIVO'];

		
    	return view('titulacion.configuraciones')->with(['faculties'=>$faculties,'modulo'=>$modulo,'ciclo'=>$ciclo/*'objUser'=>$objUSer*/]);
    }

    public function store(request $request)
    {
    	$this->validate($request,['modulo'=>'required|numeric',
            'etapa'=>'required','facultad'=>'required','carrera'=>'required',
            'ciclo'=>'required','fecha_inicio'=>'date','fecha_final'=>'date|date_after_or_equal:fecha_inicio']);

    	try{
            $this->datosRPY->forSave($request);
            Messages::infoRegisterCustom('GUARDADO EXISTOS');
            return redirect()->route('titulacion.configuraciones.index');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());
            return redirect()->back()->withInput();
        }

    }
     
     public function parametros($parametros){
        $objSelect=new SelectController();
        return $objSelect->TitulacionParametro($parametros,'json');
      }
    
     public function carreras($facultad){
        $objSelect=new SelectController();
        return $objSelect->carreraFacultad($facultad,'json');

    }

    public function datatables(){
        return $this->datosRPY->datatablesDatos();
    }


}
