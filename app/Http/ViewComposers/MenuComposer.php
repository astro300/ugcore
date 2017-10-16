<?php

/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 22/5/2017
 * Time: 11:44
 */
namespace UGCore\Http\ViewComposers;



use Illuminate\Contracts\View\View;
use UGCore\Core\Entities\Security\RolesUser;
use Session;
use Auth;
use Facades\UGCore\Facades\Utils;
use Facades\UGCore\Facades\DataXSL;
class MenuComposer{

        public function  compose(View $view){
            $menuOptions = "";
            if (Auth::user()) {
               // if (Session::has('menuOptions')) {
                //    $menuOptions = Session::get('menuOptions');
                //} else {
                    $rolesUser = RolesUser::where("user_id", "=", Auth::user()->id)->select("role_id")->get();
                    $arrayRole = array();
                    foreach ($rolesUser as $key => $value) {
                        if (!in_array($value->role_id, $arrayRole)) {
                            $arrayRole[] = $value->role_id;
                        }
                    }
                    $menuOptions = Utils::parsearMenu(Utils::getOptionSystem($arrayRole, false), DataXSL::menuOptions());
                    $menuOptions = str_replace("%5Bpath%5D", env('APP_DOMAIN'), $menuOptions);

                    //Session::put('menuOptions', $menuOptions);
                //}
            }

            $view->with(['menu'=>$menuOptions]);
        }
}