<?php
namespace UGCore\Http\Controllers\Horarios;

use Illuminate\Http\Request;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Horarios\HorariosRepository;

class HorariosController extends Controller
{
    private $objHorarios;

    public function __construct(){
        $this->objHorarios = new HorariosRepository();
    }

    public function index(){
        return view('academico.docente.horarios.index')
            ->with(['listaFacultad' => $this->objHorarios->forFacultades(\Auth::user()->name)]);
    }

    public function getCarreras(\Illuminate\Http\Request $request){
        dd(1);
        if ($request->ajax()) {
            return response()->json($this->objHorarios->forCarreras($request->fac, \Auth::user()->name));
        } else {
            abort(401);
        }
    }
}