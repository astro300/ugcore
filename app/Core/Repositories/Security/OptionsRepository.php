<?php

namespace UGCore\Core\Repositories\Security;

use DB;
use Illuminate\Http\Request;
use UGCore\Core\Entities\Security\Option;
use UGCore\Core\Entities\Security\RolesOption;
use UGCore\Core\Entities\Security\RolesUser;
use UGCore\Core\Entities\Security\User;

class OptionsRepository {

	public function forScope($scope) {
		$scope = $scope == NULL?'':$scope;
		return DB::table('options as a')
			->leftJoin('options as b', 'b.id', '=', 'a.optionid')
			->where('a.name', 'LIKE', "%".$scope."%")
			->orderBy('a.name', 'desc')
			->select('a.*', 'b.name as father')
			->paginate(15)->appends('scope',$scope);
	}

	public function forSelect($status = 'A') {
		return Option::orderBy('name', 'desc')->where('status', '=', $status)
		                                      ->pluck('name', 'id')->toArray();
	}

	public function forStore(Request $request){
				$objOptions = new Option($request->all());
				$objOptions->optionid = $objOptions->optionid == '0'?NULL:$objOptions->optionid;
				$objOptions->save();
	}


	public function forUpdate(Request $request,Option $objOption){
				$objOption->name = $request->name;
				$objOption->prefix = $request->prefix;
				$objOption->url = $request->url;
				$objOption->parameters = $request->parameters;
				$objOption->icons = $request->icons;
				$objOption->optionid = $request->optionid == '0'?NULL:$request->optionid;
				$objOption->status = $request->status;
				$objOption->save();
	}

    public function optionsByRole(User $user,$filter){
       return RolesOption::join('options as OP','OP.id','=','roles_option.option_id')
           ->leftJoin('options as O','O.id','=','OP.optionid')
           ->where('OP.name','LIKE',"%$filter%")
           ->whereIn('roles_option.roles_id',RolesUser::where('user_id','=',$user->id)->select('role_id')->get()->toArray())
           ->where('OP.status','=','A')
           ->select('OP.name','OP.url','OP.icons','O.name AS padre')

           ->get()->toArray();
    }
}
