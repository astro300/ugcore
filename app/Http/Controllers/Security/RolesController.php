<?php

namespace UGCore\Http\Controllers\Security;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use UGCore\Core\Entities\Security\Role;
use UGCore\Core\Repositories\Security\RolesRepository;
use UGCore\Http\Controllers\Controller;

use DB;
use Messages;
use Facades\UGCore\Facades\DataXSL;
use Utils;

class RolesController extends Controller
{
 protected $objRPY;
    protected $path="admin.roles.";
    private $objRoles;



    public function __construct(RolesRepository $objRPY) {
       $this->objRPY = $objRPY;
    }



    public function index(Request $request)
    {

        return view($this->path.'index')->with(['roles'=>$this->objRPY->forScope($request->scope),'scope'=>$request->scope]);
    }

    public function create()
    {
            return view($this->path.'create');
    }

    public function store(Request $request)
    {
        $this->validate($request,['nombre' => 'min:4|max:50|required|alpha']);
        $this->objRPY->forStore($request);
        Messages::infoRegister($request->nombre,'el rol');
        return redirect()->route($this->path.'index');
    }

    public function edit(Role $role)
    {
        return view($this->path.'edit')->with('objRoles',$role);
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request,['nombre' => 'min:4|max:50|required|alpha']);
         $this->objRPY->forUpdate($request,$role);
         Messages::warningRegister($request->nombre,'El rol');
         return redirect()->route($this->path.'index');
    }

    public function destroy(Role $role) {
                $name=$role->name;
                $role->delete();
                Messages::errorRegister($name,'El rol');
        return redirect()->route($this->path.'index');
    }

    public function rolesoptions(Request $request,Role $role){
        if($request->ajax()){
            try
            {
                $options = Utils::getOptionsRoles($role->id, false);
                $options_roles = Utils::parsearMenu($options, DataXSL::menu(true));
            }
            catch (QueryException $e)
            {
                return response()->json(['result'=>'NOT','content'=>$e->getMessage()],200);
            }
            return response()->json(['result'=>'OK','content'=>$options_roles],200);
        }else{
            $options = Utils::getOptionsRoles($role->id, true);
            $options_roles = Utils::parsearMenu($options, DataXSL::menu());
            return view($this->path.'rolesoptions')->with(['options_roles'=>$options_roles,
                'objRoles'=>$role]);
        }


    }

    public function saverolesoptions(Request $request,Role $role){
          $this->objRPY->forSaveRoleOptions($request,$role);
          Messages::infoRegister($role->name,'la distribuci&oacute;n de las opciones para el rol');
          return redirect()->route($this->path.'index');     
    }
}
