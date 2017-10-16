<?php

namespace UGCore\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use UGCore\Core\Entities\Security\User;
use UGCore\Core\Repositories\Security\OptionsRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getRouter(Request $request){
            if($request->router!=''){
                if(Route::has($request->router)){
                    $this->registerAction($request->router,$request->ip());
                    return redirect()->route($request->router);
                }else{
                   abort(404);
                }
            }else{
                return redirect()->route('home');
            }
    }

    public function searchOption(Request $request){
        $this->validate($request,['query'=>'required'],['query.required'=>'Debe escribir el nombre de una opci&oacute;n para buscar coincidencias']);
        $result=((new OptionsRepository())->optionsByRole(\Auth::user(),$request->get('query')));
        return view('complements.search')->with(['results'=>$result]);
    }

    public function about(){
        return view('complements.about');
    }
}
