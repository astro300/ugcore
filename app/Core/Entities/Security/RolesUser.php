<?php

namespace UGCore\Core\Entities\Security;

use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    protected $table ="role_user";
public  $timestamps = false;
    protected $fillable=['role_id','user_id'];

public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function insertRolesSIUG($nuic){
    	 $roleExists=User::getRolesUserbyNuicSIUG($nuic);
    	 $objUser=User::findNuic($nuic);
    	 $arrayRole=[];
    	
    	foreach ( $roleExists as $key => $value) {
    			if(!$objUser->hasRole($value)){

    				$objRole=Role::findName($value);
    				if($objRole!=null){
    					 $arrayRole[]=['user_id'=>$objUser->id,'role_id'=>$objRole->id];
    				}
                            
                }
    	}
    	if(count($arrayRole)>0){
    		RolesUser::insert($arrayRole);
    	}
    	
    }

}
