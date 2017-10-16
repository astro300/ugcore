<?php
namespace UGCore\Core\Repositories\Security;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use DB;

use Facades\UGCore\Facades\Utils;
use Facades\UGCore\Facades\DataXSL;
use UGCore\Core\Entities\Security\Role;


class RolesRepository {

	protected $message;
	public function forScope($scope) {
		$scope = $scope == NULL?'':$scope;
		return Role::search($scope,'name')->orderBy('id','ASC')->paginate(15)->appends('scope',$scope);
	}


	public function forStore(Request $request){
					$objRoles= new Role();
					$objRoles->name=$request->nombre;
					$objRoles->display_name=$request->nombre_largo;
					$objRoles->description=$request->descripcion;
			        $objRoles->save();
			        return true;
	}


	public function forUpdate(Request $request,Role $objRoles){
		        $objRoles->name=$request->nombre;
		        $objRoles->display_name=$request->nombre_largo;
		        $objRoles->description=$request->descripcion;
			    $objRoles->save();
		        return true;
	}


 	public function forSaveRoleOptions($request,Role $objRole){
        DB::transaction(function() use ($request,$objRole){    
          
             $arrayRoleOption=array();
             $evaluator=false;
             if(is_array($request->option)){
             	 DB::table('roles_option')->where('roles_id', '=', $objRole->id==''?'0':$objRole->id)->delete();
            foreach ($request->option as $key => $value) {
               $arrayRoleOption[]=array("roles_id"=>$objRole->id,"option_id"=> $value, "created_at"=>Utils::getDateSQL(),"updated_at"=>Utils::getDateSQL());
               $evaluator=true;
            }
        }
            if($evaluator){
            DB::table('roles_option')->insert($arrayRoleOption);
            }
 			return true;
        });
       return false;       
    }


}
