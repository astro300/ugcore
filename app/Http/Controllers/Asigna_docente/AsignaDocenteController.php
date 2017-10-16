<?php

namespace UGCore\Http\Controllers\Asigna_docente;

use Illuminate\Http\Request;

use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Academico\AsignaDocenteRepository;
use Validator;
use Input;
use Messages;
use Alerts;
class AsignaDocenteController extends Controller
{

    private $objAsignaDoc;

    public function __construct(){
        $this->objAsignaDoc = new AsignaDocenteRepository();
    }

    public function index(){
        $bandera=$this->objAsignaDoc->forHabilita();
        if ($bandera == '0') {
            abort(401);
        }
        return view('academico.docente.asigna_docente.index')
            ->with(['listaFacultad' => $this->objAsignaDoc->forFacultades(\Auth::user()->name)]);
    }

    public function getCarreras(\Illuminate\Http\Request $request){
        if ($request->ajax()) {
            return response()->json($this->objAsignaDoc->forCarreras($request->fac, \Auth::user()->name));
        } else {
           abort(401);
        }
    }

    public function getPeriodos(\Illuminate\Http\Request $request){
        if ($request->ajax()) {
            return response()->json($this->objAsignaDoc->forPeriodos($request->car));
        } else {
            abort(401);
        }
    }

    public function getDocentes(\Illuminate\Http\Request $request){
        if ($request->ajax()) {
            return response()->json($this->objAsignaDoc->forDocentes($request->doc));
        } else {
            abort(401);
        }
    }

    public function getMaterias(\Illuminate\Http\Request $request){
        if ($request->ajax()) {
            return response()->json($this->objAsignaDoc->forMaterias($request->mat, $request->plec));
        } else {
            abort(401);
        }
    }

    public function getAsignaciones($docente, $plectivo){
        return $this->objAsignaDoc->forAsignaciones($docente, $plectivo);
    }

    public function createAsignacion(Request $request){
        $rules = array(
            'facultad' => 'required|alpha_num',
            'carrera' => 'required|alpha_num',
            'plectivo' => 'required|alpha_num',
            'docente' => 'required|alpha_num',
            'materia' => 'required|alpha_num',
        );

        $this-> validate($request, $rules);

        if( $this->objAsignaDoc->forGuardaAsignacionDoc($request) ){
            Messages::infoRegisterCustom('Se ha guardado la materia correctamente');
        }
        else{
            Messages::warningRegisterCustom('La materia ya existe en la planificaci&oacute;n acad&eacute;mica');
        }
        return redirect()->route('academico.docente.asigna_docente.index');
    }

    public function getDetalleUpd($nid){
        return $this->objAsignaDoc->forVeriMateriaID($nid);
    }

    public function getDAcad($cedula){
        return $this->objAsignaDoc->forVerDAcademico($cedula);
    }

    public function createCarrera(\Illuminate\Http\Request $request){
        $rules = array(
            'caradd' => 'required',
            'cedadd' => 'required'
        );
        $this-> validate($request, $rules);

        $response = $this->objAsignaDoc->forGuardaDAcademico($request->caradd, $request->cedadd);
        return response()->json($response, 200);
    }

    public function actuEstado(\Illuminate\Http\Request $request){
        $rules = [
            'estado' => 'required|numeric|in:1,0',
            'docente' => 'required',
            'carrera' => 'required'
        ];
        $this->validate($request,$rules);

        $response = $this->objAsignaDoc->forActualizaEstado($request->estado, $request->docente, $request->carrera);
        return response()->json($response, 200);
    }

    public function getDAcadMatNID($nid){
        return $this->objAsignaDoc->forVerDAcademicoNID($nid);
    }

    public function actualizaMateria(\Illuminate\Http\Request $request){
        $rules = array(
            'materia' => 'required',
            'cid' => 'required',
            'plectivo' => 'required'
        );
        $this->validate($request,$rules);

        $response = $this->objAsignaDoc->forActualizaMateria($request->materia, $request->cid, $request->plectivo);
        return response()->json($response, 200);
    }

    public function borraMateria(\Illuminate\Http\Request $request){
        $rules = array(
            'cid' => 'required'
        );
        $this->validate($request,$rules);

        $response = $this->objAsignaDoc->forEliminaMateria($request->cid);
        return response()->json($response, 200);
    }
}