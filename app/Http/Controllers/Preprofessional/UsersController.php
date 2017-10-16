<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Http\Request;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use UGCore\Mail\WelcomeProspect;
use Utils;
use Facades\UGCore\Facades\MessagesPreprofessional as MessagesPreprofessional;
use Mail;
use Session;
use Redirect;
use PDF;

class UsersController extends Controller
{
    private $objPRYPreprofessional;
    private $objSelectController;

    public function __construct()
    {
        $this->objSelectController = new SelectController();
        $this->objPRYPreprofessional = new PreprofessionalRepository();
    }

    public function indexAdministrator()
    {
        $objuserdadmin = $this->objPRYPreprofessional->forGetSuperadmin(\Auth::user()->name);
        if ( count($objuserdadmin)== 0) {
            MessagesPreprofessional::warningsessionAdmin();
            $getcareers = [];
        } else {
            $codes = [];
            foreach ($objuserdadmin as $objuserdadmins) {
                $codes[] = $objuserdadmins->cod_carrers;
            }
            $getcareers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', $codes, 'http');
        }
        $facultid = "";
        $carrers = "";
        return view('preprofessional.administrator.indexadministrator', ['getresultevaluation' => $getcareers, 'flag' => false, 'facultid' => $facultid, 'carrers' => $carrers]);

    }

    public function indexAdministratorNew(Request $request)
    {
        $getcodfaculty=$this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$request->carrers], 'http');
        //$getcodfaculty = Utils::showapicodfaculty($request->carrers);
        return view('preprofessional.administrator.indexadministrator', ['facultid' => $getcodfaculty[0]->COD_FACULTAD, 'flag' => false, 'carrers' => $request->carrers]);
    }

    public function indexAdministratorReturn($faculty, $career)
    {
        $flag = false;
        return view('preprofessional.administrator.indexadministrator', ['facultid' => $faculty, 'flag' => $flag, 'carrers' => $career]);
    }

    public function index(Request $request, $faculty, $career)
    {
        $getcareers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$career], 'http');
        $getfaculties = $this->objSelectController->getNameMateriaCarreraFacultad('FACULTAD', [$faculty], 'http');
        $scope = $request->scope == NULL ? '' : $request->scope;
        $getstudent = $this->objPRYPreprofessional->forGetProspects($scope, $faculty, $career);
        return view('preprofessional.prospects.index', ['faculty' => $faculty, 'carrer' => $career, 'getstudent' => $getstudent,'getcareers'=>$getcareers,'getfaculties'=>$getfaculties]);
    }

    public function create($faculty, $carrer)
    {
        $getcareers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$carrer], 'http');
        $getfaculties = $this->objSelectController->getNameMateriaCarreraFacultad('FACULTAD', [$faculty], 'http');
        return view('preprofessional.prospects.newprospectus', compact('flag', 'getfaculties', 'getcareers', 'faculty', 'carrer'));
    }

    public function store(Request $request, $faculty, $career)
    {

        $validateregist = $this->objPRYPreprofessional->forValidateProspects($request->document, $faculty, $career);
        if ($validateregist == 0) {
            $this->objPRYPreprofessional->forStoreUsers($request, $faculty, $career,\Auth::user()->id);

            return redirect()->route('preprofessional.prospects.index', [$faculty, $career]);

        } else {
            MessagesPreprofessional::warningValidadocuments($request->document);
            return redirect()->route('preprofessional.prospects.create', [$faculty, $career]);
        }
    }

    /*SIN UTILIZACIÓN - JCASTRO*/
    public function show($document, $faculty, $career)
    {
        $i = 0;
        $getstudent = $this->objPRYPreprofessional->forShowProspects($document, $faculty, $career);
        foreach ($getstudent as $getstudents) {
            $getcareers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$getstudents->cod_carrer], 'http');
            $getfaculties = $this->objSelectController->getNameMateriaCarreraFacultad('FACULTAD', [$getstudents->cod_faculty], 'http');
            $obtener_fecha = Utils::getDataFormatWEBDatetimeSqln($getstudents->getAttributes()['created_at']);
            $getresult[$i] = array($getstudents->document, $getstudents->first_name, $getstudents->last_name, $getstudents->institution_email, $getstudents->alternative_email, $getstudents->departament, $getstudents->phone, $getcareers, $getfaculties, $obtener_fecha);
            $i = $i + 1;
        }
        $flag = false;
        if (!$getcareers) {
            $flag = true;
            MessagesPreprofessional::warningsession();
        }
        return view('preprofessional.prospects.summaryprospectus', compact('flag', 'getresult', 'faculty', 'career'));
    }

    public function edit($document, $faculty, $career)
    {
        $registupdate = $this->objPRYPreprofessional->forEditProspects($document, $faculty, $career);
        return view('preprofessional.prospects.updateprospects', ['registupdate' => $registupdate, 'document' => $document, 'faculty' => $faculty, 'career' => $career]);
    }

    public function update(Request $request, $document, $faculty, $career)
    {

        $parameters=['email_alternat'=>'required|email',
            'direccion'=>'required','email_institu'=>'required|email'
            ,'phone'=>'required'];
        if($request->rechazo=='S'){
            $parameters['obs_rechazo']='required';
        }
        if($request->reactivar=='S'){
            $parameters['obs_reactivar']='required';
        }

        $this->validate($request,$parameters,
            ['email_alternat.required'=>'El campo email personal es requerido',
             'email_alternat.email'=>'El campo email personal tiene formato incorrecto',
             'email_institu.required'=>'El campo email institucional es requerido',
             'email_institu.email'=>'El campo email institucional tiene formato incorrecto',
             'phone.required'=>'El campo teléfono es requerido',
             'obs_rechazo.required'=>'El campo observación para rechazo de solicitud es obligatorio'
            ]);

        $this->objPRYPreprofessional->forUpdateUsers($request, $document, $faculty, $career);

        return redirect()->route('preprofessional.prospects.index', [$faculty, $career]);
    }

    //Envio de correo
    public function emailProspectoWelcome($email_institu, $nameStudent, $name_faculty, $name_carrer, $faculty, $career)
    {
        Mail::send(new WelcomeProspect(['toEmail'=>$email_institu,'fromName'=>'Pre-Profesionales','nameStudent' => $nameStudent, 'faculty' => $name_faculty, 'carrer' => $name_carrer]));
        MessagesPreprofessional::emailProspects($nameStudent);
        return redirect()->route('preprofessional.prospects.index', [$faculty, $career]);
    }
}