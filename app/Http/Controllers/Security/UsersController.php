<?php

namespace UGCore\Http\Controllers\Security;

use UGCore\Core\Entities\Security\User;
use UGCore\Http\Controllers\Controller;

//use UGCore\Http\Requests\UserRequest;

use Auth;
use DB;
use Illuminate\Http\Request;
use UGCore\Core\Repositories\Security\UsersRepository;
use Facades\UGCore\Facades\Messages;

class UsersController extends Controller {
	private $evaluator = false;
	protected $objRPY;
    protected $path="admin.users.";


    public function __construct(UsersRepository $objRPY) {
       $this->objRPY = $objRPY;
    }


	public function changePassword() {
       return view($this->path.'changePassword');
	}
	public function postChangePassword(Request $request) {

		$rules = array(
			'clave'          => 'required',
			'nueva_clave'    => 'required|min:7|different:clave',
			'confirma_clave' => 'required|same:nueva_clave',
		);

		$this->validate($request,$rules);
			if (\Hash::check($request->clave, Auth::user()->password)) {
				$this->objRPY->forChangePasswordAuth($request->nueva_clave);
				Messages::infoRegister(Auth::user()->email, "la clave  para el usuario");
			} else {
				Messages::errorRegisterCustom("La clave  actual introducida por el usuario ".\Auth::user()->email." no es la correcta!");
			}
			return redirect()->route($this->path.'changePassword');
	}


    public function index(Request $request)
    {
        return view($this->path.'index')->with(['users'=>$this->objRPY->forScope($request->scope),'scope'=>$request->scope]);
    }
    public function create() {
        return view($this->path.'create');
    }
    public function store(Request $request) {
        $this->validate($request, [
            'cedula' => 'required|min:10|unique:sqlsrv.users,name',
            'email' => 'required|email|unique:sqlsrv.users,email',
            'password' => 'required|min:6',
            'nombres' => 'required|names',
            'apellidos' => 'required|names',
            'sexo'=>'required|in:1,0',
        ],['nombres.names'=>'El campo nombre tiene caracteres incorrectos',
            'apellidos.names'=>'El campo apellido tiene caracteres incorrectos',
            'sexo.in'=>'El campo sexo debe ser Masculino o Femenino']);
        $this->objRPY->forStore($request);
        Messages::infoRegister($request->email,'el usuario');
        return redirect()->route($this->path.'index');
    }
    public function edit(User $user) {
        return view($this->path.'edit')->with('objUser', $user);
    }
    public function update(Request $request, User $user) {

        $this->objRPY->forUpdate($request,$user);
        Messages::warningRegister($request->email,'El usuario');
        return redirect()->route($this->path.'index');
    }
    public function destroy(User $user) {
        $name=$user->email;
        $user->delete();
        Messages::errorRegister($name,'El usuario');

        return redirect()->route($this->path.'index');
    }

    public function usersRoles(User $user) {
       return view($this->path.'users_roles')
            ->with($this->objRPY->forUsersRoles($user));
    }

    public function storeRolesUser(Request $request, User $user){
        if (!is_array($request->role)) {
            return redirect()->back()->withInput()->withErrors(['message' => 'El usuario '.$user->name.' necesita que le asigne roles']);
        } else {

            if (!$this->objRPY->forSaveUserRoles($request,$user)) {
                return redirect()->back()->withInput()->withErrors(['message' => 'El usuario '.$user->name.' necesita asignaci&oacute;n de los roles']);
            }
            Messages::infoRegister($user->name, "los roles para el  usuario");
            return redirect()->route($this->path.'index');
        }
    }

}