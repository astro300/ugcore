<?php

namespace UGCore\Http\Controllers\Titulacion;

use UGCore\Core\Entities\Titulacion\MTDatos;
use Illuminate\Http\Request;
use UGCore\Core\Respositories\Titulacion\MTTitulacionRepository;
use UGCore\Facades\Messages;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;

class MTDatosController extends Controller
{

    private $datosRPY;

    /**
     * MTDatosController constructor.
     * @param $datosRPY
     */
    public function __construct(MTTitulacionRepository $datosRPY)
    {
        $this->datosRPY = $datosRPY;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objSelect=new SelectController();
        $table=$this->datosRPY->getData();
        $faculties=$objSelect->getfaculty();
        return view('titulacion.configuraciones.index',compact('faculties'));
        //return view('titulacion.datos.index')->with(['faculties'=>$faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['facultad'=>'required|numeric','carrera'=>'required|numeric',
            'nombre'=>'required|names']);
        try{
            $this->datosRPY->forSave($request);
            Messages::infoRegisterCustom('GUARDADO EXISTOS');
            return redirect()->route('titulacion.datos.index');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());
            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \UGCore\Core\Entities\Titulacion\MTDatos  $dato
     * @return \Illuminate\Http\Response
     */
    public function show(MTDatos $dato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \UGCore\Core\Entities\Titulacion\MTDatos  $dato
     * @return \Illuminate\Http\Response
     */
    public function edit(MTDatos $dato)
    {
        $objSelect=new SelectController();
        $table=$this->datosRPY->getData();
        $faculties=$objSelect->getfaculty();
        $carreras=$objSelect->carreraFacultad($dato->facultad,'http');
        return view('titulacion.datos.edit',compact('faculties','dato','carreras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \UGCore\Core\Entities\Titulacion\MTDatos  $mTDatos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MTDatos $dato)
    {
        $this->validate($request,['facultad'=>'required|numeric','carrera'=>'required|numeric',
        'nombre'=>'required|names']);
        try{
            $this->datosRPY->forUpdate($dato,$request);
            Messages::infoRegisterCustom('GUARDADO EXISTOS');
            return redirect()->route('titulacion.datos.index');
        }catch (\Exception $ex){
            Messages::errorRegisterCustom('Error :'.$ex->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \UGCore\Core\Entities\Titulacion\MTDatos  $dato
     * @return \Illuminate\Http\Response
     */
    public function destroy(MTDatos $dato)
    {
        //
    }

    public function carreras($facultad){
        $objSelect=new SelectController();
        return $objSelect->carreraFacultad($facultad,'json');
    }

    public function datatables(){
        return $this->datosRPY->datatablesDatos();
    }
}
