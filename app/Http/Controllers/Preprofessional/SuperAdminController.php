<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Http\Request;

use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use DB;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use Facades\UGCore\Facades\MessagesPreprofessional as MessagesPreprofessional;
use UGCore\Core\Entities\preprofessional\Preprofessionalsuperadmin;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $objPRYPreprofessional;
    
    public function __construct()   {
         $this->objPRYPreprofessional=new PreprofessionalRepository();
    }


    public function index() {
        $Nameusers="";
        $flag=false;
        return view('preprofessional.superadmin.indexadmin',['flag'=>$flag,'Nameusers'=>$Nameusers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shearch(Request$request)   {

        $objSelectController=new SelectController();

        $objfacultyn=$objSelectController->getfaculty();


        $objusers=$this->objPRYPreprofessional->forGetAdministrator($request->document);

        if(count($objusers)==0){
            MessagesPreprofessional::warningobjusers($request->document);
            return redirect()->route('Preprofessional.superadmin.create');
        }else{

            foreach ($objusers as $objuserst) {
                $documentUSers=$objuserst->name;
                $Nameusers=$objuserst->first_name.' '.$objuserst->last_name;
                $EmailUsers=$objuserst->email;
            }
            return view('preprofessional.superadmin.indexadmin',['documentUSers'=>$documentUSers,'Nameusers'=>$Nameusers, 'EmailUsers'=>$EmailUsers,'faculties'=> $objfacultyn,'flag'=>false]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$documentUSers,$Nameusers,$EmailUsers)   {

        $objValidaUsers=$this->objPRYPreprofessional->forGetAdministratorValidate($documentUSers,$request->careers,$request->faculties);
        if($objValidaUsers>0){
            MessagesPreprofessional::warninguseradmin($Nameusers);
            return redirect()->route('Preprofessional.superadmin.create');
        }else{
            MessagesPreprofessional::Registeruseradmin($Nameusers);
            $this->objPRYPreprofessional->forStoreSuperadmin($request,$documentUSers,$Nameusers,$EmailUsers);
            return redirect()->route('Preprofessional.superadmin.create');
        }

    }
}
