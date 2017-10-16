<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Http\Request;

use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use DB;
use Facades\UGCore\Facades\MessagesPreprofessional as MessagesPreprofessional;
use Utils;
use PDF;
use Storage;
use File;
use Response;

class StudentProcessEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $objPRYPreprofessional;

    public function __construct()
    {
        $this->objPRYPreprofessional = new PreprofessionalRepository();
    }

    public function index()
    {
        $documentstudent = \Auth::user()->name;
        $objShowValidaAcitivitystudent = $this->objPRYPreprofessional->forGetValidatEstudent($documentstudent);

        if ($objShowValidaAcitivitystudent > 0) {
            $getvalidaevaluation = $this->objPRYPreprofessional->forGetEvaluationStudent($documentstudent);
            if ($getvalidaevaluation == 0) {
                return view('preprofessional.student.evaluationpracticesinstitution', compact('documentstudent', 'getvalidaevaluation'));
            } else {
                return redirect()->route('preprofessional.student.indexevaluationdownland', $documentstudent);
            }
        } else {
            $documentstudent = "";
            $getvalidaevaluation = 1;

            MessagesPreprofessional::warningValidaEvaluationStudent();
            return view('preprofessional.student.evaluationpracticesinstitution', compact('documentstudent', 'getvalidaevaluation'));
        }
    }

    public function indexEvaluationDownland($documentstudent)
    {
        return view('preprofessional.student.windowsevaluation', ['documentstudent' => $documentstudent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Preprofessional\ProcessStudentRequest $request, $documentstudent)
    {
        $objgetidstudent = $this->objPRYPreprofessional->forGetInstitutionValidateUsers($documentstudent);
        foreach ($objgetidstudent as $objgetidstudents) {
            $getidstudent = $objgetidstudents->id;
        }
        $this->objPRYPreprofessional->forStoreEvaluationStudent($request, $getidstudent);
        MessagesPreprofessional::RegistroEvaluacion();
        return redirect()->route('preprofessional.student.indexevaluationdownland', $documentstudent);
    }

    public function pdfEvaluationStudent($documentstudent, $value)
    {
        $objSelectController=new SelectController();
        $i = 0;
        $objgetPDFStudentEvaluation = $this->objPRYPreprofessional->forGetEvaluationStudents($documentstudent);
        foreach ($objgetPDFStudentEvaluation as $objgetPDFStudentEvaluations) {
            $Obtenerfecha = date(Utils::getFormatDateSQL());;
            $lugarfecha = strtoupper($objgetPDFStudentEvaluations->address) . " " . $Obtenerfecha;

            $getcareers = $objSelectController->getNameMateriaCarreraFacultad('CARRERA', [$objgetPDFStudentEvaluations->cod_carrer], 'http')[0]->NOMBRE_CARRERA;
            $getfaculties = $objSelectController->getNameMateriaCarreraFacultad('FACULTAD', [$objgetPDFStudentEvaluations->cod_faculty], 'http')[0]->NOMBRE;
            $dataPerson=($objSelectController->getPersons($objgetPDFStudentEvaluations->id_tutor)[0]);
           $Namestutor =$dataPerson->NOMBRE.' '.$dataPerson->APELLIDO;
            $getresultevaluation[$i] = array($lugarfecha, strtoupper($objgetPDFStudentEvaluations->first_name),strtoupper($objgetPDFStudentEvaluations->last_name), $getfaculties, $getcareers, strtoupper($objgetPDFStudentEvaluations->name), strtoupper($objgetPDFStudentEvaluations->departament), strtoupper($objgetPDFStudentEvaluations->name_supervisor), $Namestutor,strtoupper($objgetPDFStudentEvaluations->position_supervisor));
            $i = $i + 1;
        }
        $objgetPDFStudentEvaluationew = $this->objPRYPreprofessional->forGetEvaluationStudentNew($documentstudent);

        if (!$getcareers) {
            MessagesPreprofessional::warningsession();
            return redirect()->route('preprofessional.student.indexevaluationdownland', $documentstudent);
        } else {

            $pdf = PDF::loadView('preprofessional.student.pdfstudentassessment', ['getresultevaluation' => $getresultevaluation, 'objgetPDFStudentEvaluationew' => $objgetPDFStudentEvaluationew, 'documentstudent' => $documentstudent]);

            if ($value == 1) {
                return $pdf->stream('FEEPP-4_' . $documentstudent . '.pdf');

            } else {
                return $pdf->download('FEEPP-4_' . $documentstudent . '.pdf');
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}