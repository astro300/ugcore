<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 27/07/17
 * Time: 9:13
 */

namespace UGCore\Http\Controllers\Selection;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use PDF;
use UGCore\Core\Entities\Selections\MeritConcourseConfig;
use UGCore\Core\Entities\Selections\MeritConcourseStep;
use UGCore\Core\Entities\Selections\MeritInputDetail;
use UGCore\Core\Entities\Selections\MeritInputMaster;
use UGCore\Core\Entities\Selections\MeritInputValidate;
use UGCore\Core\Repositories\Selections\SelectionRepository;
use UGCore\Http\Controllers\Controller;
use Utils;
use Validator;

class ValidationController extends Controller
{
    private $objMeritRPY;
    private $barcode;

    /**
     * Class Constructor
     * @param SelectionRepository $objRepository
     * @internal param $objMeritRPY
     */
    public function __construct(SelectionRepository $objRepository)
    {
        $this->objMeritRPY = $objRepository;
        $this->barcode = new DNS1D();
        $this->barcode->setStorPath(__DIR__ . "/cache/");
    }

    public function indexValidation()
    {
        return view('selection.validation.index')->with(
            ['concourses' => $this->objMeritRPY->forConcourseAvailableSingle()]);
    }

    public function validationConcourse(Request $request, $id)
    {
        $objConfigSteps = MeritConcourseStep::findOrFail($id);
        if ($objConfigSteps->status != 'A') {
            return redirect()->route('process.validation.index')
                ->withErrors(["Error" => "Le etapa seleccionada no tiene ficha de validación activa"]);

        }
        $objConfig = $objConfigSteps->concourse;
        $this->notFound($objConfig);
        if ($objConfig->status != 'A') {
            return redirect()->route('process.validation.index')->withErrors(["Error" => "El Proceso no se encuentra activo para poder validar"]);
        }




        switch ($objConfigSteps->select_basic_id) {
            case env('MERIT_DOCUMENTACION'):
                $postulants = $this->objMeritRPY->forMeritMasterValidatorCountPostulants($objConfig->id, true, $request->scope,Auth::user()->id);
                $objConceptsInformation = [];
                if (count($postulants) > 0) {
                    $objConceptsInformation = $this->objMeritRPY->forConceptsConcourseForm($objConfig->id, $postulants[0]->id);
                    if (count($objConceptsInformation) == 0) {
                        return redirect()->route('process.validation.index')->withErrors(["Error" => "El Proceso no tiene conceptos asignados consulte con el administrador"]);
                    }
                } else {
                    return redirect()->route('process.validation.index')->withErrors(["Error" => "El Proceso no tiene postulantes para validar"]);
                }

                $objResponseMaster = $this->objMeritRPY->forFindMeritMasterUserConcourse($postulants[0]->id, $objConfig->id);
                if ($objResponseMaster == null) {
                    abort(404);
                }


                return view('selection.validation.document')->with(['objConfig' => $objConfig,
                    'postulants' => $postulants,
                    'scope' => $request->scope,
                    'objConceptsInformation' => $objConceptsInformation,
                    'objResponseMaster' => $objResponseMaster, 'idStep' => $objConfigSteps->id]);
                break;

            case env('MERIT_EVALUACION'):
                if($objConfigSteps->step_old!=null){

                    $step=MeritConcourseStep::where('select_basic_id','=',$objConfigSteps->step_old)
                        ->where('merit_concourse_config_id','=',$objConfigSteps->merit_concourse_config_id)->first();
                    $postulants=$this->objMeritRPY->forMeritMasterValidatorEvaluation($request->scope,$step);

                    if(count($postulants)==0) {
                        return redirect()->route('process.validation.index')->withErrors(["Error" => "La etapa de documentación no tiene postulantes aprobados para validar"]);
                    }

                    return view('selection.validation.evaluation')->with(['objConfig' => $objConfig,
                        'postulants' => $postulants,
                        'scope' => $request->scope,
                        'idStep' => $objConfigSteps->id]);
                }else{
                    return redirect()->route('process.validation.index')->withErrors(["Error" =>
                        "Para proceder a evaluar esta sección debes tener una etapa antecesora."]);
                }


                break;
            case env('MERIT_CLASE_DEMOSTRATIVA'):

                break;
            default:
                return redirect()->route('process.validation.index')->withErrors(["Error" => "Le etapa seleccionada no tiene ficha de validación"]);
                break;

        }


    }


    public function statisticsConcourse(Request $request)
    {
        $messsages = array(
            'id.required' => 'El campo id del proceso es requerido',
            'id.numeric' => 'El campo id del proceso debe ser numerico'
        );

        $rules = array(
            'id' => 'required|numeric'
        );

        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return response()->json("Parametros incorrectos en la peticion", 400);
        }

        return response()->json([
            "postulants" => $this->objMeritRPY->forCountMeritMasterCountPostulants($request->id),
            "steps" => MeritConcourseStep::where('Concourse.merit_concourse_config_steps.merit_concourse_config_id', '=', $request->id)
                ->where('Concourse.merit_concourse_config_steps.status', '=', 'A')->join('catalogos.select_basics as sb', 'sb.id', '=', 'Concourse.merit_concourse_config_steps.select_basic_id')
                ->select('Concourse.merit_concourse_config_steps.id', 'Concourse.merit_concourse_config_steps.date_start',
                    'Concourse.merit_concourse_config_steps.date_end', 'sb.description', 'Concourse.merit_concourse_config_steps.step_old')->orderBy('Concourse.merit_concourse_config_steps.ubication', 'ASC')
                ->get()
        ], 200);
    }


    public function statisticsGlobalConcourse(Request $request)
    {
        $messsages = array(
            'id.required' => 'El campo id del proceso es requerido',
            'id.numeric' => 'El campo id del proceso debe ser numerico'
        );

        $rules = array(
            'id' => 'required|numeric'
        );

        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return response()->json("Parametros incorrectos en la peticion", 400);
        }
        return response()->json(
            ["global" => MeritInputMaster::from("Concourse.merit_input_masters as m")
                ->where('m.status', '=', 'F')
                ->where('m.merit_concourse_config_id', '=', $request->id)
                ->select(DB::connection('sqlsrv_modulos')->raw("convert(date,m.date_close) as date"),
                    DB::connection('sqlsrv_modulos')->raw("count(m.id) as valor"))
                ->groupBy(DB::connection('sqlsrv_modulos')->raw("convert(date,m.date_close)"))->get()->toArray()]
            , 200);
    }

    public function reportConcoursePostulants($id)
    {
        $images = asset('images/logo_.png');

        $objConfig = MeritConcourseConfig::findOrFail($id);

        $pdf = PDF::loadView('selection.validation.reports.postulant',
            ['barcode' => $this->barcode,
                'objUser' => \Auth::user(), 'images' => $images,
                'objConfig' => $objConfig,
                'postulants' => $this->objMeritRPY->forMeritMasterValidatorCountPostulants($id),
                'title' => 'LISTADO DE POSTULANTES',
                'validation' => false
            ]);
        return $pdf->download(\Auth::user()->name . '_lista_postulantes.pdf', ["Content-Type" => "application/pdf"]);
    }

    public function reportConcourseValidations($id)
    {
        $images['UG'] = asset('images/logo_.png');

        $objConfig = MeritConcourseConfig::findOrFail($id);

        $pdf = PDF::loadView('selection.validation.reports.postulant',
            ['barcode' => $this->barcode,
                'objUser' => \Auth::user(), 'images' => $images,
                'objConfig' => $objConfig,
                'postulants' => $this->objMeritRPY->forMeritMasterValidatorCountValidations($id),
                'title' => 'LISTADO DE POSTULANTES VALIDADOS POR EL COMIT&Eacute;',
                'validation' => true
            ]);
        return $pdf->download(\Auth::user()->name . '_lista_aceptados.pdf', ["Content-Type" => "application/pdf"]);
    }

    public function validationDocumentConcourse(Request $request)
    {
        $rules = array(
            'idDetailValidate' => 'required|array',
            'stepConcourse' => 'required|numeric',
            'masterIDResponse' => 'required|numeric'
        );
        $validator = Validator::make($request->all(), $rules, []);
        if ($validator->fails()) {
            return response()->json("Parametros incorrectos en la peticion", 400);
        }

        $objResponseMaster = MeritInputMaster::find($request->masterIDResponse);
        if ($objResponseMaster == null) {
            return response()->json("Plantilla master no encontrada", 404);
        }

        $validate = MeritInputValidate::where('user_id', '=', $objResponseMaster->user_id)->where('merit_concourse_config_step_id', '=', $request->stepConcourse)->first();
        if ($validate != null) {
            return response()->json("Acceso denegado para actualizar la informacion consulte con la comision de apelaciones", 500);
        }


        $arrayValidate = $request->idDetailValidate;
        if (count($arrayValidate) > 0) {

            $arrayResponseDetail = MeritInputDetail::with(['meritConcourseConcept.document',
                'meritConcourseConcept.meritsubcategory'
            ])->whereIn('id', array_keys($request->idDetailValidate))->get();
            if (count($arrayResponseDetail) != count($request->idDetailValidate)) {
                return response()->json(["Para algunos códigos no se encuentra informaci&oacute;n por lo que no se puede procesar la solicitud"], 404);
            }

            $userid = \Auth::user()->id;
            $date = Utils::getDateSQL();
            $arrayExcedente = [];
            $arrayPermited = [];
            $msgEx = '';

            DB::connection('sqlsrv_modulos')->beginTransaction();
            try {
                foreach ($arrayResponseDetail as $key => $meritInputDetail) {
                    $objMeritConcourseConcept = $meritInputDetail->meritConcourseConcept;
                    $meritInputDetail->user_validation = $userid;
                    $meritInputDetail->date_validation = $date;
                    if ($arrayValidate[$meritInputDetail->id] == 1) {
                        $meritInputDetail->percentage_validation = $objMeritConcourseConcept->score;
                    } else {
                        $meritInputDetail->percentage_validation = 0;
                    }
                    $arrayPermited[$objMeritConcourseConcept->id]['max'] = $objMeritConcourseConcept->number_max_valid;
                    $arrayPermited[$objMeritConcourseConcept->id]['name'] = $objMeritConcourseConcept->document->name;
                    $arrayPermited[$objMeritConcourseConcept->id]['subcategory'] = $objMeritConcourseConcept->meritsubcategory->name;


                    $meritInputDetail->status_validation = 'F';
                    $meritInputDetail->save();
                }

                $arrayExcedente = MeritInputDetail::whereIn('id', array_keys($request->idDetailValidate))
                    ->where('percentage_validation', '>', '0')
                    ->select('merit_concourse_concept_id', DB::connection('sqlsrv_modulos')->raw('COUNT(percentage_validation) as maxInput'),
                        DB::connection('sqlsrv_modulos')->raw('sum(percentage_validation) as percentaje')
                    )
                    ->groupBy('merit_concourse_concept_id')->get();


                $percentage = 0;
                foreach ($arrayExcedente as $key => $item) {
                    if ($item->maxInput > $arrayPermited[$item->merit_concourse_concept_id]['max']) {
                        $msgEx = 'El documento ' . $arrayPermited[$item->merit_concourse_concept_id]['name'] . ' de la subcategoria ' . $arrayPermited[$item->merit_concourse_concept_id]
                            ['subcategory'] . ' solo admite validar positivamente: ' . $arrayPermited[$item->merit_concourse_concept_id]['max'] . ' archivo';
                        throw new \Exception($msgEx);
                    } else {
                        $percentage += $item->percentaje;
                    }
                }

                $objMeritInputValidate = new MeritInputValidate();
                $objMeritInputValidate->user_id = $objResponseMaster->user_id;
                $objMeritInputValidate->merit_concourse_config_step_id = $request->stepConcourse;
                $objMeritInputValidate->user_validation = $userid;
                $objMeritInputValidate->percentage_validation = $percentage;
                $objMeritInputValidate->status_validation = $percentage >= 70 ? 'A' : 'R';
                $objMeritInputValidate->date_validation = $date;
                $objMeritInputValidate->merit_concourse_matriz_id = $objResponseMaster->merit_concourse_matriz_id;
                $objMeritInputValidate->save();

                DB::connection('sqlsrv_modulos')->commit();
            } catch (\Exception $e) {
                DB::connection('sqlsrv_modulos')->rollback();
                $msgEx = $msgEx == '' ? 'Error de proceso interno: ' . $e->getMessage() . $e->getLine() : $msgEx;
                return response()->json([$msgEx], 500);
            }


        } else {
            return response()->json("Parametros incorrectos en la peticion", 400);
        }
        return response()->json(['data' => 'Registro guardado correctamente'], 200);
    }

    public function validationFinishConcourse($id, $user, $aditional)
    {
        $rules = array(
            'id' => 'required|numeric',
            'user' => 'required|numeric'
        );
        $validator = Validator::make(['id' => $id, 'user' => $user], $rules, []);
        if ($validator->fails()) {
            return redirect()->route('process.validation.user', $id)->withErrors($validator);
        }

        $objConfig = MeritConcourseConfig::find($id);
        $objUser = User::find($user);

        if ($objUser == null) {
            return redirect()->route('process.validation.user', $id)->withErrors("C&oacute;digo de Usuario no encontrado.!!");
        }
        if ($objConfig == null) {
            return redirect()->route('process.validation.user', $id)->withErrors("C&oacute;digo de proceso no encontrado.!!");
        }

        $objResponseMaster = $this->objMeritRPY->forFindMeritMasterUserConcourse($user, $id);
        if ($objResponseMaster == null) {
            return redirect()->route('process.validation.user', [$id, $aditional])->withErrors("C&oacute;digo de proceso no encontrado.!!");
        }


        if ($objResponseMaster->merit_concourse_matriz_id == null) {
            return redirect()->route('process.validation.user', [$id, $aditional])->withErrors("Debes seleccionar un &aacute;rea al cual deseas aplicar.!!");
        }
        if ($objResponseMaster->status_validation == 'F') {
            return redirect()->route('process.validation.user', [$id, $aditional])->withErrors("Esta informaci&oacute;n ya se encuentra validada el {$objResponseMaster->date_validation}.!!");
        }

        $objResponseMaster->status_validation = 'F';

        $objConceptsInformation = $this->objMeritRPY->forConceptsConcourseForm($objConfig->id, $user);
        if (count($objConceptsInformation) == 0) {
            return redirect()->route('process.validation.user', [$id, $aditional])->withErrors(["Error" => "El Proceso no tiene conceptos asignados consulte con el administrador"]);
        }

        $objResponseMaster->save();

        Messages::infoRegisterCustom("Validaci&oacute;n del usuario realizada correctamente!");
        return redirect()->route('process.validation.user', [$id, $aditional]);
    }
}