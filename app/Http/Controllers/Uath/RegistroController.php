<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 17/3/2017
 * Time: 14:41
 */

namespace UGCore\Http\Controllers\Uath;
use Illuminate\Http\Request;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Uath\RegistroRepository;
use Validator;
use Input;

class RegistroController extends Controller
{
    private $objRegistro;

    public function __construct()
    {
        $this->objRegistro = new RegistroRepository();
    }

    public function index()
    {
        return view('uath.formacion.registro.index')
            ->with(['listaComboGruposAsis' => $this->objRegistro->forComboGrupos()]);
    }

    public function getAsignacion($id)
    {
        return $this->objRegistro->forAsignacion($id);
    }

    public function guardaAsistencia($id,$dato)
    {
        $response = $this->objRegistro->forGuardaAsistencia($id,$dato);
        return response()->json($response, 200);
    }
}