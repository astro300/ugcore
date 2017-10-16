<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Http\Request;

use UGCore\Core\Entities\Comun\AutoridadCatalog;
use UGCore\Core\Entities\Preprofessional\PreprofessionalInstitution;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use UGCore\Core\Entities\Preprofessional\PreprofessionalTutor;
use Facades\UGCore\Facades\MessagesPreprofessional as MessagesPreprofessional;
use Utils;
use UGCore\Core\Entities\Preprofessional\PreprofessionalUsers;
use UGCore\Core\Entities\Preprofessional\PreprofessionalDocuments;
use DB;
use Mail;
use Storage;
use File;
use PDF;

class PracticesController extends Controller
{
    private $objPRYPreprofessional;
    private $objSelectController;
    public function __construct()
    {
        $this->objSelectController = new SelectController();
        $this->objPRYPreprofessional = new PreprofessionalRepository();
    }

    public function index(Request$request, $faculty, $career)
    {
        $scope = $request->scope == NULL ? '' : $request->scope;
        $objgetinstitutiones = $this->objPRYPreprofessional->forGetInstitution($scope, $faculty, $career);
        return view('preprofessional.practices.indexpractices', ['objgetinstitutiones' => $objgetinstitutiones, 'faculty' => $faculty, 'career' => $career]);
    }

    public function create($faculty, $career)
    {
        return view('preprofessional.practices.createInstitution', ['faculty' => $faculty, 'career' => $career]);
    }

    public function store(Request $request, $faculty, $career)
    {

        $this->validate($request,['document'=>'required|numeric','institution'=>'required|names','adress'=>'required|alpha_especial_numeric',
        'email'=>'required|email','phone'=>'required|numeric','typeinstitution'=>'in:PUBLICA,PRIVADA','description'=>'required|alpha_especial_numeric'],
            ['adress.required'=>'El campo dirección es obligatorio','adress.alpha_especial_numeric'=>'El campo dirección contiene caracteres incorrectos']);

        $validatestudent = $this->objPRYPreprofessional->forGetInstitutionValidate($request->document, $request->institution, $faculty, $career);
        if ($validatestudent == 0) {
            $this->objPRYPreprofessional->forStoreInstitucion($request, $faculty, $career);
            MessagesPreprofessional::infoRegisterprocces();
            return redirect()->route('preprofessional.practices.index', [$faculty, $career]);
        } else {
            MessagesPreprofessional::warninginstitutionstore($request->institution);
            return redirect()->route('preprofessional.practices.create', [$faculty, $career]);
        }
    }


    public function assignmentStuentPractices($id, $faculty, $career,Request $request)
    {
        $objInstitucion=PreprofessionalInstitution::findOrFail($id);
        $objSelectController = new SelectController();
        $tutor = $objSelectController->getAllTeacherByCareersAndActivty($career, '6', 'http')->toArray();
        $gettutor=[];
        foreach ($tutor as $key => $row) {
            $gettutor[$row->COD_DOCENTE] = $row->NOMBRES;
        }

        $showInstitutionStudents = $this->objPRYPreprofessional->forShowStudentInstituttion($id, $faculty, $career,true);


        return view('preprofessional.practices.assignment',compact('id','faculty','career','objInstitucion','gettutor','showInstitutionStudents'));
    }

    public function addAssignmentStuentPractices(Request $request, $id, $faculty, $career)
    {
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            $careers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$career], 'http')[0];

            $dataPerson = ($this->objSelectController
                ->getPersons($request->tutor)[0]);

            $objAutoridadCatalogCoordinador=AutoridadCatalog::getNameAutoridad(6,$career);
            $objAutoridadCatalogDirector=AutoridadCatalog::getNameAutoridad(3,$career);

            $emailCC=$objAutoridadCatalogCoordinador['email'].';'.$objAutoridadCatalogDirector['email'];
            $objInstitution=PreprofessionalInstitution::findOrFail($id);
            $userID=\Auth::user()->id;
            $arrayStudents=[];
            foreach ($request->students as $student){
                $objStudent=PreprofessionalUsers::findOrFail($student);
                $getvalidatestudent = $this->objPRYPreprofessional->forInstitutionValidaAssigment($objStudent->id, $faculty, $career);
                if($getvalidatestudent==0){
                    $this->objPRYPreprofessional->forStoreInstitutionAssignment($request, $objInstitution->id, $objStudent->id);
                    $this->objPRYPreprofessional->forUpdateManyInstitution($objInstitution->id, $faculty, $career);
                    $objStudent->status_asignation='A';
                    $objStudent->save();


                    $dia=date('d');
                    \Carbon\Carbon::setLocale('es');
                    $mes=\Carbon\Carbon::now()->format('F');
                    $anio=date('Y');

                    $nombre_estudiante=$objStudent->fullName();
                    $nuic=$objStudent->document;
                    $email=$objStudent->institution_email;

                    $nombre_carrera=$careers->NOMBRE_CARRERA;
                    $nombre_facultad=$careers->NOMBRE_FACULTAD;
                    $director_carrera=$objAutoridadCatalogDirector['nombres'];
                    $nombre_empresa=$objInstitution->name;
                    $fecha_inicio=$request->star_date;
                    $fecha_fin=$request->end_date;
                    $nombre_tutor=$dataPerson->NOMBRE . ' ' . $dataPerson->APELLIDO;
                    $identity=uniqid();
                    $token=bcrypt($identity);
                    $nombre_coordinador=$objAutoridadCatalogCoordinador['nombres'];

                    $pdf = \PDF::loadView('preprofessional.template.cartaAceptacion',
                        compact('dia','mes',
                            'anio','nombre_estudiante','nuic','email','fecha_inicio','fecha_fin',
                            'nombre_carrera','nombre_empresa','nombre_facultad','director_carrera','nombre_tutor','token','nombre_coordinador'));

                    \Storage::disk('ftp')->put("MODULOS/PREPROFESIONALES_PRACTICAS/CAIP-$nuic-$identity.pdf", $pdf->output());

                    $objPreprofessionalDocuments=new PreprofessionalDocuments();
                    $objPreprofessionalDocuments->name_file="CAIP-$nuic-$identity.pdf";
                    $objPreprofessionalDocuments->file_path="PREPROFESIONALES_PRACTICAS/";
                    $objPreprofessionalDocuments->type="CAIP";
                    $objPreprofessionalDocuments->created_by=$userID;
                    $objPreprofessionalDocuments->updated_by=$userID;
                    $objPreprofessionalDocuments->created_ip=$request->ip();
                    $objPreprofessionalDocuments->updated_ip=$request->ip();
                    $objPreprofessionalDocuments->token=$token;
                    $objStudent->documents()->save($objPreprofessionalDocuments);



                    $nombre_representante=$request->name_supervisor;
                    $cargo_representante=$request->position_supervisor;
                    $director_email=$objAutoridadCatalogDirector['email'];
                    $pdf = \PDF::loadView('preprofessional.template.cartaInsercion',
                        compact('dia','mes',
                            'anio','nombre_estudiante','nuic','email','fecha_inicio','fecha_fin',
                            'nombre_carrera','nombre_empresa','director_email','director_carrera',
                            'nombre_tutor','cargo_representante','nombre_representante'));

                    \Storage::disk('ftp')->put("MODULOS/PREPROFESIONALES_PRACTICAS/CIPP-$nuic-$identity.pdf", $pdf->output());
                    $objPreprofessionalDocuments=new PreprofessionalDocuments();
                    $objPreprofessionalDocuments->name_file="CIPP-$nuic-$identity.pdf";
                    $objPreprofessionalDocuments->file_path="PREPROFESIONALES_PRACTICAS/";
                    $objPreprofessionalDocuments->type="CIPP";
                    $objPreprofessionalDocuments->created_by=$userID;
                    $objPreprofessionalDocuments->updated_by=$userID;
                    $objPreprofessionalDocuments->created_ip=$request->ip();
                    $objPreprofessionalDocuments->updated_ip=$request->ip();
                    $objPreprofessionalDocuments->token=$token;
                    $objStudent->documents()->save($objPreprofessionalDocuments);




                    $arrayStudents[]=['objStudent'=>$objStudent,'link'=>route('fileGet',['PREPROFESIONALES_PRACTICAS',"CAIP-$nuic-$identity.pdf"])];

                }else{
                    throw new \Exception("Hay estudiantes que ya se encuentran asignados para realizar el proceso de prácticas preprofesionales");
                }
            }
            DB::connection('sqlsrv_modulos')->commit();

            foreach ($arrayStudents as $objStudent){
                $this->objPRYPreprofessional->sendEmailAssigmentTutoria($objStudent['objStudent'],$objInstitution,$careers,
                    $dataPerson,$emailCC,$objStudent['link']);

            }

            MessagesPreprofessional::infoCustom('ESTUDIANTES ASIGNADOS CORRECTAMENTE');
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            MessagesPreprofessional::errorCustom('ERROR: '.$e->getMessage());
            return redirect()->route('preprofessional.practices.assignmentStuentpractices', [$id, $faculty, $career])->withInput();

        }
        return redirect()->route('preprofessional.practices.assignmentStuentpractices', [$id, $faculty, $career]);
    }





    public function show($id, $faculty, $career)
    {
        $i = 0;
        $objShowInstitutionstudents = $this->objPRYPreprofessional->forShowStudentInstituttion($id, $faculty, $career);
        if (!empty($objShowInstitutionstudents)) {
            $Namestutor="";
            $NameInstitution['name']='';
            $getresult[]='';
            foreach ($objShowInstitutionstudents as $objShowInstitutionstudent) {
                $Namestutor = $this->objSelectController->getPersons($objShowInstitutionstudent->id_tutor, 'http');
                $NameInstitution['name']=$this->objPRYPreprofessional->forShowNameInstituttion($objShowInstitutionstudent->id_institution);
                $Namestutor=$Namestutor[0]->APELLIDO.' '.$Namestutor[0]->NOMBRE;
                $getresult[$i] = array($objShowInstitutionstudent->document, $objShowInstitutionstudent->name_estu, $objShowInstitutionstudent->ape_estu, $objShowInstitutionstudent->name_supervisor, $objShowInstitutionstudent->departament, $Namestutor);
                $i = $i + 1;
            }
            $flag = false;
            if ($Namestutor == " ") {
                $flag = true;
                MessagesPreprofessional::warningsession();
            }
            return view('preprofessional.practices.showstudentinstitution', compact('flag', 'getresult', 'faculty', 'career','NameInstitution'));
        } else {

            MessagesPreprofessional::messageevaulationstudent();
            return redirect()->route('preprofessional.practices.index', [$faculty, $career]);
        }
    }

    public function documents($faculty, $career)
    {
        $name_estudent = "";
        $id_student = "";
        $document = "";
        return view('preprofessional.practices.uploadfiles', ['document' => $document, 'id_student' => $id_student, 'name_estudent' => $name_estudent, 'faculty' => $faculty, 'career' => $career]);
    }

    public function shearchStudentDocument(Request $request, $faculty, $career)
    {
        $objShowInstitutionstudent = $this->objPRYPreprofessional->forGetStudentDocuments($request->document, $faculty, $career);
        $id_student=null;
        if (!empty($objShowInstitutionstudent)) {
            foreach ($objShowInstitutionstudent as $objShowInstitutionstudents) {
                $name_estudent = $objShowInstitutionstudents->first_name . " " . $objShowInstitutionstudents->last_name;
                $id_student = $objShowInstitutionstudents->id;
            }


            $getdocumentstudent = $this->objPRYPreprofessional->forGetDocumentsStudent($id_student);

            if (count($getdocumentstudent)>0) {

                return view('preprofessional.practices.documentview', ['getdocumentstudent' => $getdocumentstudent, 'faculty' => $faculty, 'career' => $career]);
            } else {

                return view('preprofessional.practices.uploadfiles', ['document' => $request->document, 'id_student' => $id_student, 'name_estudent' => $name_estudent,
                    'faculty' => $faculty, 'career' => $career]);
            }
        } else {
            MessagesPreprofessional::warningValidadocumentStudent();
            return redirect()->route('preprofessional.practices.documents', [$faculty, $career]);
        }
    }

    protected function documentval($request, $name, $document, $type, $id_student)
    {
        $file = $request;
        $extension = $file->getClientOriginalExtension();
        if ($document == "") {
            $nameFile = $name;
        } else {
            $nameFile = $name . '_' . $document . '_' . $id_student . time().'.' . $extension;
        }
        $nombre = $file->getClientOriginalName();
        $fullPath =  '/MODULOS/PREPROFESIONALES_DOCF';
        $ruta_file = $fullPath . $nameFile;

        if (!$document == "") {
            $this->objPRYPreprofessional->forStoreDocumentsStudent($nameFile, $ruta_file, $document, $type, $id_student);
        }

        Storage::disk('ftp')->put("$fullPath/$nameFile", File::get($file));
    }

    public function documentUpload(Request$request, $document, $id_student, $faculty, $career)
    {
        $this->documentval($request->generaldata, 'FichaDatosGenerales(FDGPP-1)', $document, 'FDG', $id_student);
        $this->documentval($request->dailyactivities, 'FichaActividadesDiarias(FADPP-2)', $document, 'FAD', $id_student);
        $this->documentval($request->studentassessment, 'FichaEvaluacinEstudiantil(FEEPP-4)', $document, 'EST', $id_student);
        $this->documentval($request->evaluation_performance, 'FichaSupervisionInstitucion(SP-FSPP-3-I)', $document, 'EIT', $id_student);
        $this->documentval($request->tutorassessment, 'FichaSupervisionTutor(SP-FSPP-3-T)', $document, 'ETT', $id_student);
        $this->documentval($request->certifiedtutor, 'CertificadoTutor', $document, 'CTTU', $id_student);
        $this->documentval($request->certifiedinstitution, 'CertificadoInstitucion', $document, 'CINS', $id_student);

        $getdocumentstudent = $this->objPRYPreprofessional->forGetDocumentsStudent($id_student);
        return view('preprofessional.practices.documentview', ['getdocumentstudent' => $getdocumentstudent, 'faculty' => $faculty, 'career' => $career]);
    }

    public function updateDocuments(Request$request)
    {
        $document = "";
        $ObjStudentDocument = PreprofessionalDocuments::find($request->id_document);
        $this->documentval($request->archivo, $ObjStudentDocument->name_file, $document, 'FDG', $request->id_student);
        $getdocumentstudent = $this->objPRYPreprofessional->forGetDocumentsStudent($request->id_student);
        return view('preprofessional.practices.documentview', ['getdocumentstudent' => $getdocumentstudent, 'faculty' => $request->id_faculty, 'career' => $request->id_carreer]);
    }

    public function downlandDocument($idcodument)
    {
        $ObjStudentDocument = PreprofessionalDocuments::find($idcodument);
        $fileContent=Storage::disk('ftp')->get("MODULOS/PREPROFESIONALES_DOCF/$ObjStudentDocument->name_file");
        return \Response::make($fileContent, '200', array(
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$ObjStudentDocument->name_file.'"'
        ));

    }

    public function pdfCertificate(Request$request)
    {

        $i = 0;

        $getinformationstudent = $this->objPRYPreprofessional->forGetCertificate($request->id_studen);
        foreach ($getinformationstudent as $getinformationstudents) {
            $id_faculty = $getinformationstudents->cod_faculty;
            $id_carrer = $getinformationstudents->cod_carrer;
            $data=$this->objSelectController->getNameMateriaCarreraFacultad('CARRERA',[$getinformationstudents->cod_carrer],'http')[0];
            $getcareers =$data->NOMBRE_CARRERA;
            $getfaculties = $data->NOMBRE_FACULTAD;
            $Namestutor = $this->objSelectController->getPersons($getinformationstudents->id_tutor, 'http');
            $Namestutor=$Namestutor[0]->APELLIDO.' '.$Namestutor[0]->NOMBRE;

            $day = date('d');
            $meshs = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $mesh = strtoupper($meshs[date('n') - 1]. "");
            $year = date('Y');
            $getinformationsutdent[$i] = array($getinformationstudents->document, $getinformationstudents->first_name, $getinformationstudents->last_name, $getfaculties, $getcareers, $Namestutor, $getinformationstudents->name, $day, $mesh, $year, $request->secretary, $request->deca, $request->cordinator);
            $i = $i + 1;

        }

        if ($Namestutor == " ") {
            MessagesPreprofessional::warningsession();
            $getdocumentstudent = $this->objPRYPreprofessional->forGetDocumentsStudent($request->id_studen);
            return view('preprofessional.practices.documentview', ['getdocumentstudent' => $getdocumentstudent, 'faculty' => $id_faculty, 'career' => $id_carrer]);
        } else {
            $pdf = PDF::loadView('preprofessional.practices.pdffinalcertificate', ['getinformationsutdent' => $getinformationsutdent]);
            return $pdf->download('Certificado_Final' . '.pdf');
        }
    }

    public function emailCertificateStudent($id_student)
    {
        $getemailstudent = $this->objPRYPreprofessional->forGetEmailCertificate($id_student);
        foreach ($getemailstudent as $getemailstudents) {
            $id_faculty = $getemailstudents->cod_faculty;
            $id_carrer = $getemailstudents->cod_carrer;
            $data=$this->objSelectController->getNameMateriaCarreraFacultad('CARRERA',[$getemailstudents->cod_carrer],'http')[0];
            $getcareers =$data->NOMBRE_CARRERA;
            $getfaculties = $data->NOMBRE_FACULTAD;
            $student = $getemailstudents->first_name . ' ' . $getemailstudents->last_name;
            $nameinstitution = $getemailstudents->name;
            $typeinstitution = $getemailstudents->type;
            $fromEmail = $getemailstudents->institution_email;
        }
        if (!$getcareers) {
            MessagesPreprofessional::warningsession();
            $getdocumentstudent = $this->objPRYPreprofessional->forGetDocumentsStudent($id_student);
            return view('preprofessional.practices.documentview', ['getdocumentstudent' => $getdocumentstudent, 'faculty' => $id_faculty, 'career' => $id_carrer]);
        } else {
            $fromName = "Pre-Profesionales";
            Mail::send("preprofessional.email.emailfinishcertificate", ['getcareers' => $getcareers, 'getfaculties' => $getfaculties, 'student' => $student, 'nameinstitution' => $nameinstitution, 'typeinstitution' => $typeinstitution], function ($Message) use ($fromName, $fromEmail) {
                $Message->to($fromEmail, $fromName);
                $Message->subject('Certificado  Practicas Pre-Profesionales');
            });
            MessagesPreprofessional::infocertifiqueemail();
            $this->objPRYPreprofessional->forUpdatefinishProcess($id_student);
            $getdocumentstudent = $this->objPRYPreprofessional->forGetDocumentsStudent($id_student);
            return view('preprofessional.practices.documentview', ['getdocumentstudent' => $getdocumentstudent, 'faculty' => $id_faculty, 'career' => $id_carrer]);
        }
    }
}