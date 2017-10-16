<?php

namespace UGCore\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use UGCore\Core\Repositories\Security\BitacoreRepository;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function registerAction($path,$ip){
        $objBitacoreRepository=new BitacoreRepository();
        $objBitacoreRepository->forStore($ip,$path,Auth::user()->id);
    }

    public function notFound($object) {
        if (!$object) {
            abort(404);
        }
    }

    public function owner($criteria){
        if (Auth::user()->id!=$criteria  && Auth::user()->evaluateRoles(['SUPMIN'])==0) {
            abort(401);
        }
    }
}
