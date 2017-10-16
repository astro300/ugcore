<?php
namespace UGCore\Http\Controllers\Uath;

use Illuminate\Http\Request;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Uath\FormacionRepository;
use Validator;
use Input;

class FormacionController extends Controller
{
    private $objFormacion;

    public function __construct()
    {
        $this->objFormacion = new FormacionRepository();
    }

    public function index()
    {
        return view('uath.formacion.configuracion.index')
            ->with(['listaComboGrupos' => $this->objFormacion->forComboGrupos()]);
    }

    public function getListaMateriasCombo(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->objFormacion->forTodasMaterias());
        } else {
            return '';
        }
    }

    public function getMaterias()
    {
        return $this->objFormacion->forMateriasCursos();
    }

    public function guardaMateria(Request $request)
    {
        $rules = array(
            'materia' => 'required',
            'estado' => 'required'
        );
        $validator = Validator::make(Input::only('materia', 'estado'), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => "Par&aacute;metros no aceptados", 'status' => 400], 200);
        }
        $response = $this->objFormacion->forGuardaMateria($request);
        return response()->json($response, 200);
    }

    public function getDatosEditaMateria($id)
    {
        return $this->objFormacion->buscaDatosMateria($id);
    }

    public function getDatosEditaGrupo($id)
    {
        return $this->objFormacion->buscaDatosGrupo($id);
    }

    public function actualizaMateria($id, Request $request)
    {
        $rules = array(
            'materia' => 'required',
            'estado' => 'required'
        );
        $validator = Validator::make(Input::only('materia', 'estado'), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => "Par&aacute;metros no aceptados", 'status' => 400], 200);
        }
        $response = $this->objFormacion->forActualizaMateria($id, $request);
        return response()->json($response, 200);
    }

    public function getGrupos()
    {
        return $this->objFormacion->forGruposCursos();
    }

    public function guardaGrupo(Request $request)
    {
        $rules = array(
            'grupo' => 'required',
            'instructorc' => 'required',
            'instructorn' => 'required',
            'fecini' => 'required',
            'fecfin' => 'required|date_after_or_equal:fecini'
        );
        $validator = Validator::make(Input::only('grupo', 'instructorc', 'instructorn', 'fecini', 'fecfin'), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => "Parámetros no aceptados", 'status' => 400], 200);
        }
        $response = $this->objFormacion->forGuardaGrupo($request);
        return response()->json($response, 200);
    }

    public function actualizaGrupo($id, Request $request)
    {
        $rules = array(
            'grupo' => 'required',
            'instructorc' => 'required',
            'instructorn' => 'required',
            'fecini' => 'required',
            'fecfin' => 'required|date_after_or_equal:fecini'
        );
        $validator = Validator::make(Input::only('grupo', 'instructorc', 'instructorn', 'fecini', 'fecfin'), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => "Parámetros no aceptados", 'status' => 400], 200);
        }
        $response = $this->objFormacion->forActualizaGrupo($id, $request);
        return response()->json($response, 200);
    }

    public function getAsignacion($id)
    {
        return $this->objFormacion->forAsignacion($id);
    }

    public function getDatosUath($id)
    {
        return $this->objFormacion->buscaDatosUath($id);
    }

    public function guardaAsigna(Request $request)
    {
        $rules = array(
            'cedula' => 'required',
        );
        $validator = Validator::make(Input::only('cedula'), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => "Parámetros no aceptados", 'status' => 400], 200);
        }
        $response = $this->objFormacion->forGuardaAsigna($request);
        return response()->json($response, 200);
    }

    public function borraAsigna($id)
    {
        $response = $this->objFormacion->forBorraAsigna($id);
        return response()->json($response, 200);
    }

    public function getListaGruposCombo(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->objFormacion->forComboGrupos());
        } else {
            return '';
        }
    }

}