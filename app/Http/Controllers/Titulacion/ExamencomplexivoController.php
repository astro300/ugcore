<?php

namespace UGCore\Http\Controllers\Titulacion;





use UGCore\Facades\Messages;

use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Security\User;

use DB;


use Illuminate\Http\Request;
use UGCore\Http\Controllers\Ajax\SelectController;

use UGCore\Core\Respositories\Titulacion\ExamenComplexivoRepository;


class ExamencomplexivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $datosRPY;

    /**
     * MTDatosController constructor.
     * @param $datosRPY
     */
    public function __construct(ExamenComplexivoRepository $datosRPY)
    {
        $this->datosRPY = $datosRPY;
    }

    public function index()
    {
        $objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();
        return view('titulacion.examen_complexivo_rn')->with(['faculties'=>$faculties]);
    }

    //invocar esta funcion para llenar el dt registro de notas del examen complexivo en el evento change del select de carrera
    public function getDatatable($idcarrera){

        return $this->datosRPY->ForDatatable($idcarrera);
//        //dd($idcarrera);
        //$objRepos = new ExamenComplexivoRepository();
//        dd('hola');
        //return  $objRepository->ForDatatable($idcarrera);
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
    public function store(Request $request, $id)
    {
        $response = $this->datosRPY->forSaveOrUpdate($request,$id);
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
