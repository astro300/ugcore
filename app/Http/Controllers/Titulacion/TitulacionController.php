<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Respositories\Titulacion\MTTitulacionRepository;
use Validator;


class TitulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();
        return view('titulacion.trabajo_titulacion')->with(['faculties'=>$faculties]);
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
        //
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


    public  function getNotasTitulacion()
    {
        return view('titulacion.ingreso_notas_titulacion');
    }
    public function getDataNotasTitulacion()
    {
        $objRPY = new MTTitulacionRepository();
        return $objRPY ->getDataNotasTitulacion();
    }

    public function SaveNotaTitulacion(Request $request, $idestudiante, $idtesis)
    {
        $rules = array(
            'NOTA' => 'required|numeric|max:10',
            'COD_ESTUDIANTE' =>'required|numeric',
            'COD_TESIS' =>'required|numeric'
        );
        $this-> validate($request, $rules);

        //$x = $request->NOTA.' '.$idestudiante.' '.$idtesis;
        $objRPY = new MTTitulacionRepository();

        $response =  $objRPY->forsaveNotaTitulacion($request);
        return response()->json($response, 200);
    }

    public function getNotasGeneralTitulacion()
    {
        $objSelect=new SelectController();
        $faculties=$objSelect->getfaculty();
        return view('titulacion.IngresoGenNotasTitulacion')->with(['faculties'=>$faculties]);
    }

    public function getDataNotasGenTitulacion($codcarrera)
    {
        $objRPY = new MTTitulacionRepository();
        return $objRPY ->getDataNotasGenTitulacion($codcarrera);
    }

    public function saveNotasGenTitulacion(Request $request)
    {
        $rules = array(
            'COD_ESTUDIANTE' =>'required|numeric',
            'COD_TESIS' =>'required|numeric',
            'NOTAT' => 'sometimes|required|numeric|max:10',
            'NOTAR' => 'sometimes|required|numeric|max:10',
            'NOTAS' => 'sometimes|required|numeric|max:10',
        );
        $this-> validate($request, $rules);
        $objRPY = new MTTitulacionRepository();
        $response =  $objRPY->forSaveNotasGenTitulacion($request);
        return response()->json($response, 200);
    }
}
