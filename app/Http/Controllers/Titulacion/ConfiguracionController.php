<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;

use UGCore\Core\Entities\Security\User;
use UGCore\Core\Entities\Titulacion\MTDatos;
use UGCore\Core\Respositories\Titulacion\MTTitulacionRepository;
use UGCore\Facades\Messages;
use UGCore\Http\Controllers\Controller;
use UGCore\Http\Controllers\Ajax\SelectController;

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
        $dato=$objSelect->getTIT_PARAMETRO();
           		
    	return view('titulacion.configuraciones',compact('faculties','dato'));
    }

    public function store(request $request)
    {
    	$this->validate($request,['modulo'=>'required|numeric','etapa'=>'required',
            'ciclo'=>'required','fecha_inicio'=>'date','fecha_final'=>'date|date_after_or_equal:fecha_inicio']);

    	try{
            $this->datosRPY->forSave($request,$request->todas_facultades=='1'?true:false);
            Messages::infoRegisterCustom('GUARDADO EXISTOSO');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }

        return redirect()->route('titulacion.configuraciones.index');
    }

/*public function delete(request $request)
{
        $this->validate($request,['modulo'=>'required|numeric','etapa'=>'required',
            'ciclo'=>'required','fecha_inicio'=>'date','fecha_final'=>'date|date_after_or_equal:fecha_inicio']);
        $estado=0;
        try{
            $this->datosRPY->forSave($request,$estado,$request->todas_facultades=='1'?true:false);
            Messages::infoRegisterCustom('SE ELIMINO EL REGISTRO EXISTOSAMENTE');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }

        return redirect()->route('titulacion.configuraciones.index');
    }

}*/
    public function edit ($id)
    {

        $objSelect=new SelectController();
        $cemt=$objSelect->getTIT_PARAMETRO($id);
        $cemte=$objSelect->getEtapa_Modulo($cemt['dato']->etapa);
        
        $faculties=$objSelect->getfaculty();
       // dd($cemt['dato'][0]);
        $carrera=$objSelect->carreraFacultad($cemt['dato']->faculties,'http');
        $modulo_etapa=$objSelect->moduloEtapa($cemt['dato']->etapa,$id,'http');
       // dd($modulo_etapa);
        
        $ciclo=$objSelect->PlectivosCarrera($cemt['dato']->carrera,'http');

        return view('titulacion.configuraciones_edit',compact('cemt','ciclo','cemte','modulo_etapa','carrera','faculties'));
     }
     public function parametros($parametros){
        $objSelect=new SelectController();
        return $objSelect->TitulacionParametro($parametros,'json');
      }
    
     public function carreras($facultad){
        $objSelect=new SelectController();
        return $objSelect->carreraFacultad($facultad,'json');

    }
  public function plectivos($carrera){
        $objSelect=new SelectController();
        return $objSelect->PlectivosCarrera($carrera,'json');

    }

    public function datatables(){
        return $this->datosRPY->datatablesDatos();
    }

    public function update(request $request,MTDatos $datos){
     
        
        $this->validate($request,['modulo'=>'required|numeric','etapa'=>'required',
            'ciclo'=>'required','fecha_inicio'=>'date','fecha_final'=>'date|date_after_or_equal:fecha_inicio']);

        try{
            $this->datosRPY->forUpdate($request,$datos);
            Messages::infoRegisterCustom('ACTUALIZACIÓN EXISTOSA');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }

        return redirect()->route('titulacion.configuraciones.index');
    }

     public function delete($id)
    {
       /* $objSelect=new SelectController();
        $datos=$objSelect->getTIT_PARAMETRO($id);
        $datos=$datos['dato'];*/

        try{
            $this->datosRPY->forDelete($id);
             Messages::warningRegisterCustom('BORRADO EXISTOSA');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());

        }
                return redirect()->route('titulacion.configuraciones.index');

        
    }


}
