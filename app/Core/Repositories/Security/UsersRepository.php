<?php

namespace UGCore\Core\Repositories\Security;
use DB;
use Illuminate\Http\Request;
use UGCore\Core\Entities\Security\Role;
use UGCore\Core\Entities\Security\User;
use UGCore\Core\Entities\UserToken;

class UsersRepository {
	protected $evaluator;

	public function forScope($scope) {
		$scope = $scope == NULL?'':$scope;
		return  User::search($scope)->orderBy('name', 'desc')->paginate(15)->appends('scope',$scope);
	}

	

	public function forStore(Request $request){
		DB::transaction(function () use ($request) {
				$objUser = new User($request->all());
				$objUser->name = $request->cedula;
				$objUser->first_name= $request->nombres;
                $objUser->last_name= $request->apellidos;
                $objUser->sex= $request->sexo;
				$objUser->password = bcrypt($objUser->password);
				$objUser->save();
                $objUser->roles()->create(['role_id'=>env('ROLE_DEFAULT')]);
				return true;
			});
		return false;

	}

	public function forUpdate($request,User $objUser){
				$objUser->name = $request->name;
        $objUser->first_name= $request->nombres;
        $objUser->last_name= $request->apellidos;
				$objUser->email = $request->email;
				$objUser->status = $request->status;
				if (trim($request->password) != '') {
					$objUser->password = bcrypt($request->password);}
				$objUser->save();
				return true;
	}

	public function forUsersRoles(User $objUser){
		$roles = Role::pluck('name', 'id')->toArray();
		$userRoles = DB::table('role_user as ru')
			->join('roles as r', 'r.id', '=', 'ru.role_id')
				->where('ru.user_id', '=', $objUser->id)
				->orderBy('r.name', 'desc')
			->pluck('r.name', 'r.id');
		$arrayRoleExists = array();
		foreach ($userRoles as $key => $value) {
			if (!in_array($key, $arrayRoleExists)) {
				$arrayRoleExists[] = $value;
			}
		}
	return ['objUser'=>$objUser,
		 	'roles'=> $roles,
		 	'userRoles' => $userRoles,
		 	'roleExists'=> json_encode($arrayRoleExists)];
	}

	public function forSaveUserRoles($request,$user){
		$this->evaluator = false;
		DB::transaction(function () use ($request,$user) {
					$arrayRoleUsers = $request->role;
					$arrayRoleUserSave = array();
					foreach ($arrayRoleUsers as $role) {
						$this->evaluator = true;
                        $arrayRoleUserSave[] = array('user_id' => $user->id,
                            'role_id' => $role);
					}
					if ($this->evaluator) {
						DB::table('role_user')->where('user_id', '=', $user->id)->delete();
                        DB::table('role_user')->insert($arrayRoleUserSave);
					}
		});
		return $this->evaluator;
	}

	public function forChangePasswordAuth($password){
			    $objUser           = \Auth::user();
				$objUser->Password = \Hash::make($password);
				$objUser->save();
	}

	public function forSaveToken($token){
		DB::transaction(function () use ($token) {
				$objUserToken = new UserToken();
				$objUserToken->user_id=\Auth::user()->id;
				$objUserToken->token=$token;
				$objUserToken->save();
				return true;
			});
		return false;

	}

	public function forDeleteToken($token){
		DB::transaction(function () use ($token) {
			 DB::table('users_token')->where('token', '=', $token==''?'0':$token)->delete();
				return true;
			});
		return false;

	}

}