<?php

namespace UGCore\Http\Controllers\Titulacion;

use Illuminate\Http\Request;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Security\User;
use DB;
class UserController extends Controller
{
    public function index(){

	$objUSer=User::findOrFail(3);

    	/*1 $users=User::where('name','like',"099%")->pluck('name','id')->toArray();

*/
    	 $users= DB::connection('sqlsrv_bdacademico')->table('TB_PLECTIVO')
    	->where('COD_CARRERA','=','0301')
    	->pluck('DESCRIPCION','COD_PLECTIVO')->toArray();

    	/* $tmp= DB::connection('sqlsrv_bdacademico')
    	->select("SELECT DESCRIPCION, COD_PLECTIVO FROM TB_PLECTIVO WHERE COD_CARRERA = ?",['0301']);
    	$users=[];
    	foreach ($tmp as $item) {
    		$users[$item->COD_PLECTIVO]=$item->DESCRIPCION;
    	}*/

         return view('titulacion.index')->with(['users'=>$users,'objUser'=>$objUSer]);
    }

    public function store(Request $request){
    	$this->validate($request,['nombre'=>'required|numeric','dos'=>'required','tres'=>'required']);

    }
}
