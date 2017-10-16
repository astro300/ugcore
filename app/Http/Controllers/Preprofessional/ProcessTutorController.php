<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Http\Request;

use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use Facades\UGCore\Facades\MessagesPreprofessional as MessagesPreprofessional;
use DB;
use UserSessionDependences;
use Utils;
use PDF;

class ProcessTutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $objPRYPreprofessional;
    private $objSelectController;

    public function __construct()
    {
        $this->objPRYPreprofessional = new PreprofessionalRepository();
        $this->objSelectController = new SelectController();
    }

    public function index(Request $request)
    {
        $this->validate($request, ['value' => 'numeric', 'faculty' => 'numeric', 'career' => 'numeric']);

        $documenttutor = \Auth::user()->name;
        $getcareerstutor = $this->objSelectController->getCarrersAssigmentTeacher($documenttutor);
        if ($request->value == 0) {
            return view('preprofessional.tutor.indextutor', ['careers' => $getcareerstutor, 'documenttutor' => $documenttutor]);
        } else {
            $getstudenttutoria = $this->objPRYPreprofessional->forgetstudenttutor($documenttutor, $request->career, $request->faculty);
            $flag = false;
            return view('preprofessional.tutor.indexnew', ['getstudenttutoria' => $getstudenttutoria, 'documenttutor' => $documenttutor, 'faculty' => $request->faculty, 'career' => $request->career]);
        }
    }

    public function indexNew(Request$request, $documenttutor)
    {
        $getcodfaculty = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$request->careers], 'http')[0]->COD_FACULTAD;
        $getvalidatestudenttutoria = $this->objPRYPreprofessional->forGetStudentValidateTutor($documenttutor, $request->careers, $getcodfaculty);
        if ($getvalidatestudenttutoria == 0) {
            $getstudenttutoria = $this->objPRYPreprofessional->forgetstudenttutor($documenttutor, $request->careers, $getcodfaculty);
            MessagesPreprofessional::warningObtenerEstudentProspects();
        } else {
            $getstudenttutoria = $this->objPRYPreprofessional->forgetstudenttutor($documenttutor, $request->careers, $getcodfaculty);
        }

        return view('preprofessional.tutor.indexnew', ['getstudenttutoria' => $getstudenttutoria, 'documenttutor' => $documenttutor, 'faculty' => $getcodfaculty, 'career' => $request->careers]);
    }

    public function create($docmentid, $document, $documenttutor, $faculty, $career)
    {

        $getsummarystudents = $this->objPRYPreprofessional->forGetCreateEvaluation($documenttutor, $document, $docmentid);
        $getvisitinstitution = $this->objPRYPreprofessional->forGetVisitinStitution($documenttutor, $document, $docmentid);
        $getvisitinstitutionew = $getvisitinstitution + 1;
        return view('preprofessional.tutor.evaluacionstudent', compact('getsummarystudents', 'docmentid', 'document', 'documenttutor', 'getvisitinstitutionew', 'faculty', 'career'));
    }

    public function validateActivity($docmentid, $document, $documenttutor, $faculty, $career){
        $getsummarystudents = $this->objPRYPreprofessional->forGetCreateEvaluation($documenttutor, $document, $docmentid);
        $objgetactivity = $this->objPRYPreprofessional->forGetActivityStudent($document, $career, $faculty);
        return view('preprofessional.tutor.validationstudent', compact('objgetactivity','getsummarystudents', 'docmentid', 'document', 'documenttutor', 'faculty', 'career'));
    }


    public function store(Requests\Preprofessional\ProcessTutorRequest $request, $idStudent, $idTutor, $faculty, $career)
    {
        $this->objPRYPreprofessional->forStoreEvaluationStudentTutor($request, $idStudent, $idTutor);
        MessagesPreprofessional::RegistroEvaluacion();
        $value = 1;
        return redirect()->route('preprofessional.tutor.indextutor', [$value, $faculty, $career]);
    }

    public function show(Request $request, $docmentid, $document, $documenttutor, $faculty, $career)
    {
        if ($request->ajax()) {
            $getsummarystudenttutoria = $this->objPRYPreprofessional->forGetSummaryStudent($documenttutor, $document, $docmentid);
            $getvisitinstitution = $this->objPRYPreprofessional->forGetVisitinStitution($documenttutor, $document, $docmentid);
            return response()->json(view('preprofessional.tutor.summarystudenttutorship', compact('getsummarystudenttutoria', 'getvisitinstitution', 'documenttutor', 'faculty', 'career'))->render(), 200);

        } else {
            abort(401);
        }

    }

    public function showEvaluationStudent(Request $request, $documentid, $documenttutor, $faculty, $career)
    {
        if ($request->ajax()) {
            $objgetStudentEvaluationes = $this->objPRYPreprofessional->forGetShowEvaluation($documenttutor, $documentid);
            return response()->json(view('preprofessional.tutor.summaryevaluationstudent', compact('objgetStudentEvaluationes', 'documentid', 'documenttutor', 'faculty', 'career'))->render(),200);
        } else {
            abort(401);
        }
    }

    public function pdfTutorEvaluationStudent($idactivity, $documentid, $document, $documenttutor, $value)
    {
        $i = 0;
        $objgetPDFStudentEvaluation = $this->objPRYPreprofessional->forGetPdfTutor($documenttutor, $documentid, $idactivity);
        foreach ($objgetPDFStudentEvaluation as $objObtenerPDFStudentEvaluations) {
            $lugar = $objObtenerPDFStudentEvaluations->address;
            $anio = (new \Datetime($objObtenerPDFStudentEvaluations->eval_date))->format('Y');
            $mes = (new \Datetime($objObtenerPDFStudentEvaluations->eval_date))->format('m');
            $day = (new \Datetime($objObtenerPDFStudentEvaluations->eval_date))->format('d');
            $getcareers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$objObtenerPDFStudentEvaluations->cod_carrer], 'http')[0]->NOMBRE_CARRERA;
            $getfaculties = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$objObtenerPDFStudentEvaluations->cod_carrer], 'http')[0]->NOMBRE_FACULTAD;

            $dataPerson = ($this->objSelectController->getPersons($objObtenerPDFStudentEvaluations->id_tutor)[0]);
            $Namestutor = $dataPerson->NOMBRE . ' ' . $dataPerson->APELLIDO;
            $id_faculty = $objObtenerPDFStudentEvaluations->cod_faculty;
            $id_carrer = $objObtenerPDFStudentEvaluations->cod_carrer;

            $getresultevaluation[$i] = array($lugar,
                $day,
                $mes,
                $anio,
                $objObtenerPDFStudentEvaluations->first_name,
                $objObtenerPDFStudentEvaluations->last_name,
                $getfaculties,
                $getcareers,
                $objObtenerPDFStudentEvaluations->name,
                $objObtenerPDFStudentEvaluations->departament,
                $objObtenerPDFStudentEvaluations->name_supervisor,
                $Namestutor,
                $objObtenerPDFStudentEvaluations->position_supervisor,
                $objObtenerPDFStudentEvaluations->number_visit,
                $objObtenerPDFStudentEvaluations->hours_visit,
                $objObtenerPDFStudentEvaluations->knowledge_practitioner,
                $objObtenerPDFStudentEvaluations->demonstrate_interest,
                $objObtenerPDFStudentEvaluations->initiative,
                $objObtenerPDFStudentEvaluations->demostrate_capacity,
                $objObtenerPDFStudentEvaluations->is_skilled,
                $objObtenerPDFStudentEvaluations->obs_technically,
                $objObtenerPDFStudentEvaluations->commitment,
                $objObtenerPDFStudentEvaluations->is_constant,
                $objObtenerPDFStudentEvaluations->doing_his_job,
                $objObtenerPDFStudentEvaluations->acts_voluntarily,
                $objObtenerPDFStudentEvaluations->obs_operative,
                $objObtenerPDFStudentEvaluations->proactive_attitude,
                $objObtenerPDFStudentEvaluations->cooperate,
                $objObtenerPDFStudentEvaluations->respecful,
                $objObtenerPDFStudentEvaluations->leadership_skills,
                $objObtenerPDFStudentEvaluations->personal_presentation,
                $objObtenerPDFStudentEvaluations->obs_social,
                $objObtenerPDFStudentEvaluations->solves_problems,
                $objObtenerPDFStudentEvaluations->ability_to_evalute,
                $objObtenerPDFStudentEvaluations->plans_organizes,
                $objObtenerPDFStudentEvaluations->is_creative,
                $objObtenerPDFStudentEvaluations->is_persevering,
                $objObtenerPDFStudentEvaluations->on_time,
                $objObtenerPDFStudentEvaluations->obs_strategic,
                $objObtenerPDFStudentEvaluations->obs_general,
                $objObtenerPDFStudentEvaluations->recomendation);
            $i = $i + 1;
        }


        $pdf = PDF::loadView('preprofessional.tutor.pdftutoreva', ['getresultevaluation' => $getresultevaluation]);

        if ($value == 1) {
            return $pdf->stream('SP-FSPP-3_' . $document . '.pdf');

        } else {
            return $pdf->download('SP-FSPP-3_' . $document . '.pdf');
        }
    }
}
