<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use UGCore\Core\Entities\Preprofessional\PreprofessionalActivity;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use DB;
use Facades\UGCore\Facades\MessagesPreprofessional as MessagesPreprofessional;
use Utils;
use PDF;


class StudentProcessActivityController extends Controller
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

    public function index()
    {
        $getcarrer = "";
        $getfaculty = "";
        $id_student = 0;
        $documentstudent = \Auth::user()->name;
        $objShowValidaAcitivitystudent = $this->objPRYPreprofessional->forGetActivity($documentstudent);
        if (count($objShowValidaAcitivitystudent) > 0) {
            foreach ($objShowValidaAcitivitystudent as $objShowValidaAcitivitystudents) {
                $getcarrer = $objShowValidaAcitivitystudents->cod_carrer;
                $getfaculty = $objShowValidaAcitivitystudents->cod_faculty;
                $id_student = $objShowValidaAcitivitystudents->id;
            }
            $getquantitycount = 0;
            $getcathedracount = 0;
            $objgetactivity = $this->objPRYPreprofessional->forGetActivityStudent($documentstudent, $getcarrer, $getfaculty);
            $this->objPRYPreprofessional->forUpdateinstitutionstudent($getquantitycount, $id_student);
            return view('preprofessional.student.activitystudent', compact('objgetactivity', 'id_student', 'getquantitycount', 'getcathedracount'));
        } else {
            $id_student = "";
            $objgetactivity = "";
            $getquantitycount = "";
            $getcathedracount = "";
            MessagesPreprofessional::warningValidaActivityStudent();
            return view('preprofessional.student.activitystudent', compact('objgetactivity', 'id_student', 'getquantitycount', 'getcathedracount'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id_student)
    {
        if ($request->ajax()) {
            $getquantitycount = $this->objPRYPreprofessional->forGetQuantyActivity($id_student);
            foreach ($getquantitycount as $getquantitycounts) {
                $getquantitycounto = $getquantitycounts->number_hours;
            }
            if ($getquantitycounto >= 240) {
                return response()->json(['No puede crear otra actividad debido que ya cumplio o ha superado las 240 horas reglamentarias..!'], 401);
            } else {
                return response()->json(['url' => route('preprofessional.student.StoreActivity', $id_student), 'status' => 200], 200);
            }
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request$request, $id_student)
    {
        $this->validate($request, ['description' => 'required', 'observation' => 'required', 'n_hours' => 'required|in:1,2,3,4,5,6', 'date' => 'required|date'],
            ['description.required' => 'El campo descripci&oacute;n es requerido',
                'observation.required' => 'El campo observaci&oacute;n es requerido',
                'n_hours.required' => 'El campo número de horas ess requerido',
                'n_hours.in' => 'El campo número de horas debe estar entre 1-6',
                'date.required' => 'El campo fecha es requerido',
                'date.date' => 'El campo fecha debe tener el formato y-m-d',
            ]);

        $validadateactivity = $this->objPRYPreprofessional->forGetValidateActivity($id_student, $request->date);
        if ($validadateactivity == 0) {
            $this->objPRYPreprofessional->forStoreActivityStudent($request, $id_student);
            MessagesPreprofessional::RegistroActividad();
            return redirect()->route('preprofessional.student.indexActivity');

        } else {
            $newdateactivity = Carbon::createFromTimeStamp(strtotime($request->date))->format('d/m/Y');
            MessagesPreprofessional::warningdateActivity($newdateactivity);
            return redirect()->route('preprofessional.student.indexActivity');

        }
    }


    public function validateActividadEstudiante(Request $request)
    {
        $rules = ['veredicto' => 'required|in:0,1',
            'obs_veredict' => 'alpha_especial_numeric',
            'id_actividad' => 'required|numeric',
            'observation' => 'required', 'description' => 'required'];

        if ($request->veredicto == '0') {
            $rules['obs_veredict']='required|alpha_especial_numeric';
        }

        $this->validate($request,$rules ,
            ['obs_veredict.alpha_especial_numeric' => 'La observación tiene caracteres inválidos','obs_veredict.required' => 'La observación es requerido', 'description.required' => 'El campo descripci&oacute;n es requerido',
                'observation.required' => 'El campo observaci&oacute;n es requerido',]);

        $this->objPRYPreprofessional->forValidateActivityStudent($request, Auth::user()->id);
        return response()->json(['data'=>'Proceso ejecutado correctamente','status'=>'200','actividad'=>$request->id_actividad],200);
    }

    public function updateActivityDescription(Request $request)
    {
        $this->validate($request, ['description' => 'required', 'observation' => 'required', 'n_hours' => 'required|in:1,2,3,4,5,6', 'date' => 'required|date'],
            ['description.required' => 'El campo descripci&oacute;n es requerido',
                'observation.required' => 'El campo observaci&oacute;n es requerido',
                'n_hours.required' => 'El campo número de horas ess requerido',
                'n_hours.in' => 'El campo número de horas debe estar entre 1-6',
                'date.required' => 'El campo fecha es requerido',
                'date.date' => 'El campo fecha debe tener el formato y-m-d',
            ]);
        $this->objPRYPreprofessional->forUpdateActivityDescription($request, Auth::user()->name);

        return redirect()->route('preprofessional.student.indexActivity');
    }


    public function deleteActivity(PreprofessionalActivity $preprofessionalActivity)
    {
        $this->objPRYPreprofessional->forDeleteActivity($preprofessionalActivity, Auth::user()->name);
        return redirect()->route('preprofessional.student.indexActivity');

    }

    public function getActividadEstudiante(Request $request, PreprofessionalActivity $preprofessionalActivity)
    {
        if ($request->ajax()) {
            $preprofessionalActivity->load('anexos');
            return response()->json(['data' => $preprofessionalActivity, 'status' => 200], 200);
        } else {
            abort(401);
        }
    }


    public function pdfActivity($id_student)
    {

        $getquantitycount = $this->objPRYPreprofessional->forGetQuantyActivity($id_student, true);
        foreach ($getquantitycount as $getquantitycounts) {
            $getquantitycounto = $getquantitycounts->number_hours;
        }
        if ($getquantitycounto < 240) {
            MessagesPreprofessional::warninginDownloadPDF();
            return redirect()->route('preprofessional.student.indexActivity');
        }


        $i = 0;
        $cont = 0;
        $getActivityformats = $this->objPRYPreprofessional->forGetPdfActivity($id_student);
        $codesCareers = [];
        $codesFaculties = [];
        foreach ($getActivityformats as $getActivityformat) {
            $codesCareers[] = $getActivityformat->cod_carrer;
            $codesFaculties[] = $getActivityformat->cod_faculty;
        }
        $codesCareers = $this->objSelectController->getNameMateriaCarreraFacultad('CARRERA', $codesCareers, 'http');
        $codesCareers = Utils::getCollectionToSelectKeyValue($codesCareers, 'COD_CARRERA', 'NOMBRE_CARRERA');

        $codesFaculties = $this->objSelectController->getNameMateriaCarreraFacultad('FACULTAD', $codesFaculties, 'http');
        $codesFaculties = Utils::getCollectionToSelectKeyValue($codesFaculties, 'COD_FACULTAD', 'NOMBRE');


        foreach ($getActivityformats as $item) {
            $name_student = $item->first_name . ' ' . $item->last_name;

            $getcareers = $codesCareers[$item->cod_carrer];
            $getfaculties = $codesFaculties[$item->cod_faculty];
            $getresultactivity[$i] = array(Carbon::createFromTimeStamp(strtotime($item->date_activity))->format('d/m/Y'), $item->number_hours, $item->description, $name_student, $getfaculties, $getcareers, $item->name_supervisor, $item->observation);
            $i = $i + 1;
        }
        if (!$getcareers) {
            MessagesPreprofessional::warningsession();
            return redirect()->route('preprofessional.student.indexActivity');
        } else {
            $pdf = PDF::loadView('preprofessional.student.pdfactivity', ['getresultactivity' => $getresultactivity, 'i' => $i]);
            return $pdf->download('FADPP-2' . '.pdf');
        }
    }
}