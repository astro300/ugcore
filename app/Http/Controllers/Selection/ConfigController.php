<?php

namespace UGCore\Http\Controllers\Selection;

use Illuminate\Http\Request;
use UGCore\Core\Entities\Comun\EmailQueue;
use UGCore\Core\Entities\Comun\SelectsBasics;
use UGCore\Core\Entities\Security\RolesUser;
use UGCore\Core\Entities\Security\User;
use UGCore\Core\Entities\Selections\MeritConceptDocFile;
use UGCore\Core\Entities\Selections\MeritConcourseConcept;
use UGCore\Core\Entities\Selections\MeritConcourseConfigComision;
use UGCore\Core\Entities\Selections\MeritConcourseConfigMatriz;
use UGCore\Core\Entities\Selections\MeritConcourseConfigMatrizDetail;
use UGCore\Core\Entities\Selections\MeritConcourseStep;
use UGCore\Core\Repositories\Selections\SelectionRepository;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Selections\MeritConcourseConfig;
use UGCore\Core\Entities\Selections\MeritInputMaster;
use URL;
use Messages;
use Utils;
use Validator;
use Input;
use Auth;
use DB;

class ConfigController extends Controller
{

    protected $path = "selection.config";
    protected $objRPY;


    public function __construct(SelectionRepository $objRPY)
    {
        $this->objRPY = $objRPY;
    }

    public function index()
    {
        return view($this->path . '.index');
    }

    public function datatableConcourseConfig()
    {
        return $this->objRPY->forConcourseConfig();
    }

    public function store(Request $request)
    {
        $this->validator($request);
        $date = str_replace(" ", "", explode("/", $request->txtDateRange));

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date[0]) ||
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date[1])
        ) {
            return redirect()->back()->withInput()->withErrors("El formato del rango de fechas es incorrecto, el formato correcto es YYYY-mm-dd");
        }


        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            $objConfig = new MeritConcourseConfig();
            $objConfig->title = $request->title;
            $objConfig->description = $request->description;
            $objConfig->date_initial = $date[0];
            $objConfig->date_finish = $date[1];
            $objConfig->updated_ip = $request->ip();
            $objConfig->updated_by = \Auth::user()->id;
            $objConfig->created_ip = $request->ip();
            $objConfig->created_by = \Auth::user()->id;
            $objConfig->save();

        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }

        DB::connection('sqlsrv_modulos')->commit();

        Messages::infoRegister($request->title, 'el proceso');
        return redirect()->route($this->path . '.index');
    }


    public function getPeoplesConcourse($id)
    {
        $objConfig = new MeritConcourseConfig();

        return \Datatables::of($objConfig->getPeopleConcourse($id))
            ->add_column('actions', '<a href="{{ route("competition.merit.view",$id) }}"> <span class="label bg-grey-400"><i class="fa fa-eye "></i></span></a><a href="#"
          onclick="return alertConfirmDelete(\'la inscripci&oacute;n del participante: {{ $description }} \',\'{{route("competition.merit.resetinscription",$id)}}\')" > <span class="label bg-danger"><i class="fa fa-trash "></i></span></a>')->make(true);
    }


    public function resetPeoplesConcourse($id)
    {
        $obMeritInputMaster = MeritInputMaster::find($id);

        $this->notFound($obMeritInputMaster);
        $obMeritInputMaster->status = 'P';
        $obMeritInputMaster->updated_ip = Request::ip();
        $obMeritInputMaster->updated_by = \Auth::user()->id;

        $obMeritInputMaster->save();
        $user = Utils::getDataUsersbyNuic($obMeritInputMaster->nuic);
        Messages::errorRegister($user->description, 'La participaci&oacute;n del usuario ');


        $objEmailQueue = new EmailQueue();
        $objEmailQueue->body = 'admin.emails.deleteinscription';
        $objEmailQueue->object_id = $id;
        $objEmailQueue->status = 'P';
        $objEmailQueue->updated_by = \Auth::user()->id;
        $objEmailQueue->created_by = \Auth::user()->id;

        $objEmailQueue->updated_ip = Request::ip();
        $objEmailQueue->created_ip = Request::ip();

        $objEmailQueue->save();


        return redirect()->route($this->path . '.show', $obMeritInputMaster->merit_concourse_config_id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $objConfig = MeritConcourseConfig::findOrFail($id);

        return view($this->path . '.edit')->with(['objConfig' => $objConfig, 'knowledgeAreas' => $this->objRPY->getDataSelectBasic('CAT-AREAS')]);
    }

    public function update(Request $request, $id)
    {
        $this->validator($request);

        $date = str_replace(" ", "", explode("/", $request->txtDateRange));

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date[0]) ||
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date[1])
        ) {
            return redirect()->back()->withInput()->withErrors("El formato del rango de fechas es incorrecto, el formato correcto es YYYY-mm-dd");
        }

        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            $objConfig = MeritConcourseConfig::findOrFail($id);
            $objConfig->title = $request->title;
            $objConfig->description = $request->description;
            $date = str_replace(" ", "", explode("/", $request->txtDateRange));
            $objConfig->date_initial = $date[0];
            $objConfig->date_finish = $date[1];
            $objConfig->updated_ip = $request->ip();
            $objConfig->updated_by = \Auth::user()->id;
            $objConfig->save();

        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }
        DB::connection('sqlsrv_modulos')->commit();
        Messages::warningRegister($request->title, 'el proceso');;
        return redirect()->route($this->path . '.index');
    }

    public function concourseSteps($id)
    {
        $objConfig = MeritConcourseConfig::find($id);
        $this->notFound($objConfig);

        $arraySteps = Utils::getArrayKeyConvert(MeritConcourseStep::where('merit_concourse_config_id', '=', $objConfig->id)
            ->select("merit_concourse_config_id",
                "select_basic_id",
                "status",
                "date_start",
                "date_end",
                "ubication", 'step_old')->get()->toArray(), 'select_basic_id');
        return view($this->path . '.step')->with(['objConfig' => $objConfig,
            'steps' => $this->objRPY->getDataSelectBasic('CAT-ETAPAS'), 'arraySteps' => $arraySteps]);
    }

    public function saveSteps(Request $request, $id)
    {
        $rules = [
            'array' => 'required|array',
        ];
        $this->validate($request, $rules);

        $objConfig = MeritConcourseConfig::find($id);
        $this->notFound($objConfig);
        $arrayContent = $request->array;
        $orderArray = [];
        $arrayAvailable = [];
        foreach ($arrayContent as $key => $row) {
            if (isset($row['available']) && isset($row['order']) && isset($row['range']) && isset($row['old'])) {
                if ($row['available'] == 'A') {
                    $date = str_replace(" ", "", explode("/", $row['range']));
                    $arrayAvailable[] = ['available' => 'A', 'order' => $row['order'], 'range_start' => $date[0], 'range_end' => $date[1], 'step' => $key, 'step_old' => $row['old'] == '0' ? null : $row['old']];
                }
            } else {
                return redirect()->back()->withInput()->withErrors("Inconsistencia en la informaci&oacute;n facilitada..");
            }
        }
        foreach ($arrayAvailable as $key => $row) {
            $orderArray[$key] = $row['order'];
        }
        array_multisort($orderArray, SORT_ASC, $arrayAvailable);
        $arrayPurge = Utils::getArrayKeyConvert($arrayAvailable, 'order');
        if (count($arrayPurge) == count($arrayAvailable)) {
            $dateFinish = '';
            $arrayPrepared = [];
            $arrayKey = [];
            $i = 0;
            foreach ($arrayPurge as $key => $row) {
                if ($i == 0) {
                    $dateFinish = $row['range_end'];
                    $i = 1;
                } else {
                    if (strtotime($row['range_start']) <= strtotime($dateFinish)) {
                        return redirect()->back()->withInput()->withErrors("No puede haber etapas paralelas, entre las etapas del proceso!!");
                    }
                }
                if (strtotime($row['range_start']) > strtotime($objConfig->date_finish) || strtotime($row['range_start']) < strtotime($objConfig->date_initial)) {
                    return redirect()->back()->withInput()->withErrors("fechas de las etapas no pueden exceder la fecha globales del concurso: " . $objConfig->date_initial . " al " . $objConfig->date_finish);
                }
                $arrayPrepared[$row['step']] = ['merit_concourse_config_id' => $objConfig->id, 'select_basic_id' => $row['step'],
                    'created_at' => Utils::getDateSQL(), 'updated_at' => Utils::getDateSQL(), 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id,
                    'created_ip' => $request->ip(), 'updated_ip' => $request->ip(), 'status' => $row['available'], 'date_start' => $row['range_start'],
                    'date_end' => $row['range_end'], 'ubication' => $row['order'],
                    'step_old' => $row['step_old'] == '0' ? null : $row['step_old']
                ];
                $arrayKey[] = $row['step'];
            }
            MeritConcourseStep::where('merit_concourse_config_id', '=', $objConfig->id)
                ->whereNotIn('select_basic_id', $arrayKey)
                ->update(['updated_ip' => $request->ip(), 'status' => 'I', 'updated_at' => Utils::getDateSQL()]);
            foreach ($arrayPrepared as $key => $value) {
                $objMCS = MeritConcourseStep::where('merit_concourse_config_id', '=', $objConfig->id)->
                where('select_basic_id', '=', $value['select_basic_id'])->first();
                if ($objMCS == null) {
                    $objMCS = new MeritConcourseStep();
                }
                $objMCS->fill($arrayPrepared[$key]);
                $objMCS->save();
            }
            Messages::infoRegisterCustom('Las etapas del proceso se guardaron correctamente!!');
            return redirect()->route($this->path . '.concoursesteps', $objConfig->id);
        } else {
            return redirect()->back()->withInput()->withErrors("No puede haber etapas paralelas deben tener diferentes prioridades..");
        }
    }

    public function concourseConceptDocFiles(MeritConcourseConfig $meritConcourseConfig)
    {
        return (view($this->path . '.conceptdocfiles')->with(['objConfig' => $meritConcourseConfig,
            'conceptConcourses' => $this->objRPY->forConceptsConcourseDocument($meritConcourseConfig->id),
            'categories' => $this->objRPY->forCategoriesGlobal('1'),
            'subcategories' => $this->objRPY->forCategoriesGlobal('2'),
        ]));

    }

    public function saveConcourseConceptDocFiles(Request $request)
    {
        $rules = [
            'typeDocumentField' => 'required|numeric',
            'conceptConcourse' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["data" => $validator->messages(), "messaage" => false], 422);
        }

        $objConceptDocFile = MeritConceptDocFile::where('merit_type_document_field_id', '=', $request->typeDocumentField)
            ->where('merit_concourse_concept_id', '=', $request->conceptConcourse)->first();

        $message = "Campo agregado correctamente";


        if ($objConceptDocFile == null) {
            $objConceptDocFile = new MeritConceptDocFile();
            $objConceptDocFile->merit_type_document_field_id = $request->typeDocumentField;
            $objConceptDocFile->merit_concourse_concept_id = $request->conceptConcourse;
            $objConceptDocFile->status = 'A';
            $objConceptDocFile->user_created = Auth::user()->id;
            $objConceptDocFile->user_updated = Auth::user()->id;
            $objConceptDocFile->save();
        } else {

            if ($objConceptDocFile->status == 'A') {
                $message = "Campo inactivado correctamente";
            }

            $objConceptDocFile->user_updated = Auth::user()->id;
            $objConceptDocFile->status = $objConceptDocFile->status == 'A' ? 'I' : 'A';
            $objConceptDocFile->save();
        }
        return response()->json(["data" => $message, "messaage" => true], 200);
    }

    public function concourseConcepts(MeritConcourseConfig $concourseConfig)
    {

        return (view($this->path . '.concept')->with(['objConfig' => $concourseConfig,
            'categories' => $this->objRPY->forCategoriesGlobal('1'),
            'subcategories' => $this->objRPY->forCategoriesGlobal('2'),
            'typeDocuments' => $this->objRPY->getSelectTypeDocuments(),
            'conceptConcourses' => $this->objRPY->forConceptsConcourse($concourseConfig->id),
            'action' => 'I',
            'objConceptConcourse' => null
        ]));

    }

    public function editConcourseConcepts(Request $request, MeritConcourseConcept $conceptConcourse)
    {
        if ($request->ajax()) {
            return response()->json($conceptConcourse->getAttributes(), 200);
        } else {
            abort(401);
        }


    }

    public function updateConcourseConcepts(Request $request, MeritConcourseConcept $conceptConcourse)
    {
        /*
         * score,number_max_valid,max_score
         * */

        $this->validate($request, ['typeDocument' => 'required|numeric', 'category' => 'required|numeric', 'subCategory' => 'required|numeric',
            'score' => 'required|numeric|between:0,99.99', 'number_max_valid' => 'required|numeric', 'max_score' => 'required|numeric|between:0,99.99', 'many' => 'required|numeric'
        ]);
        $conceptConcourse->merittypedocument_id = $request->typeDocument;
        $conceptConcourse->meritcategory_id = $request->category;
        $conceptConcourse->meritsubcategory_id = $request->subCategory;
        $conceptConcourse->status = $request->status;
        $conceptConcourse->ubication = $request->order;
        $conceptConcourse->observation = $request->observation;
        $conceptConcourse->required = $request->requiredf;
        $conceptConcourse->updated_ip = $request->ip();
        $conceptConcourse->updated_by = \Auth::user()->id;

        $conceptConcourse->score = $request->score;
        $conceptConcourse->number_max_valid = $request->number_max_valid;
        $conceptConcourse->max_score = $request->max_score;
        $conceptConcourse->many = $request->many;


        $conceptConcourse->save();
        return response()->json(['status' => $conceptConcourse->status, 'required' => $conceptConcourse->required, 'action' => 'UPDATE', 'concourseConfig' => $conceptConcourse->merit_concourse_config_id, 'conceptConcourse' => $conceptConcourse->id, 'text' => "Configuraci&oacute;n actualizada correctamente", "type" => "success", "cssAlert" => "alert-success"], 200);
    }

    public function conceptPutConcourse(Request $request, MeritConcourseConfig $concourseConfig)
    {
        $object = $this->objRPY->getParameterMeritConcourseConcept($concourseConfig->id, $request->typeDocument, $request->category, $request->subCategory);

        $this->validate($request, [
            'typeDocument' => 'required|numeric',
            'category' => 'required|numeric',
            'subCategory' => 'required|numeric',
            'requiredf' => 'required|in:1,2',
            'many' => 'required|in:1,0',
            'score' => 'required|numeric|between:0,99.99', 'number_max_valid' => 'required|numeric', 'max_score' => 'required|numeric|between:0,99.99'
        ]);

        if ($object == null) {
            $object = new MeritConcourseConcept();
            $object->merittypedocument_id = $request->typeDocument;
            $object->merit_concourse_config_id = $concourseConfig->id;
            $object->meritcategory_id = $request->category;
            $object->meritsubcategory_id = $request->subCategory;
            $object->status = $request->status;
            $object->ubication = $request->order;
            $object->observation = $request->observation;
            $object->required = $request->requiredf;
            $object->updated_ip = $request->ip();
            $object->updated_by = \Auth::user()->id;
            $object->created_ip = $request->ip();
            $object->created_by = \Auth::user()->id;
            $object->score = $request->score;
            $object->number_max_valid = $request->number_max_valid;
            $object->max_score = $request->max_score;
            $object->many = $request->many;
            $object->save();
            return response()->json(['status' => $object->status, 'required' => $object->required, 'action' => 'ADD', 'concourseConfig' => $concourseConfig->id, 'conceptConcourse' => $object->id, 'text' => "Configuraci&oacute;n agregada correctamente", "type" => "success", "cssAlert" => "alert-success"], 200);
        } else {

            if ($object->status == 'I') {
                $object->merittypedocument_id = $request->typeDocument;
                $object->merit_concourse_config_id = $concourseConfig->id;
                $object->meritcategory_id = $request->category;
                $object->meritsubcategory_id = $request->subCategory;
                $object->required = $request->requiredf;
                $object->status = 'A';
                $object->ubication = $request->order;
                $object->observation = $request->observation;

                $object->updated_ip = $request->ip();
                $object->updated_by = \Auth::user()->id;
                $object->score = $request->score;
                $object->number_max_valid = $request->number_max_valid;
                $object->max_score = $request->max_score;
                $object->many = $request->many;


                $object->save();
                return response()->json(['status' => $object->status, 'required' => $object->required, 'action' => 'ADD', 'concourseConfig' => $concourseConfig->id, 'conceptConcourse' => $object->id, 'text' => "Configuraci&oacute;n agregada correctamente", "type" => "success", "cssAlert" => "alert-success"], 200);

            } else {
                return response()->json(['text' => "Esta configuraci&oacute;n ya se encuentra asignada", "type" => "error", "cssAlert" => "alert-warning"], 200);
            }
        }
    }

    private function validator(Request $request)
    {
        $tild = "ñÑáéíóúÁÉÍÓÚ";
        $messsages = array(
            'title.required' => 'El campo nombre es requerido',
            'title.regex' => 'El campo nombre no debe empezar con espacioas adem&aacute;s solo se adminte contenido de letras y espacios',

            'description.required' => 'El campo descripci&oacute;n es requerido',
            'description.regex' => 'El campo descripci&oacute;n no debe empezar con espacios adem&aacute;s solo se admite contenido de letras, espacios y par&eacute;ntesis',

            'status.required' => 'El campo estado es requerido',
            'status.in' => 'El estado solo puede ser Activo o Inactivo',

            'requiredf.required' => 'El campo de obligatoriedad es requerido',
            'requiredf.in' => 'El  campo de obligatoriedad solo puede ser SI o NO',

        );
        $rules = array(
            'title' => "regex:/^[A-Za-z$tild][A-Za-z$tild \t\)\(]*$/i|required",
            'description' => "regex:/^[A-Za-z$tild()][A-Za-z$tild() \t]*$/i|required",


        );

        if ($request->_method == 'PUT') {
            $rules['status'] = 'required|in:A,I';
        }
        $this->validate($request, $rules, $messsages);
    }

    public function matrizConcourseConfig(Request $request, MeritConcourseConfig $concourseConfig, $code = 0)
    {
        if ($request->ajax()) {
            return response()->json(['Acceso no autorizado'], 401);
        } else {
            $faculties=(new SelectController())->getfaculty();

            if ($code != 0) {
                $matrizConcourseConfig = MeritConcourseConfigMatriz::findOrFail($code);

                $fieldSpecific = SelectsBasics::where('father', '=', $matrizConcourseConfig->extends_id)
                    ->orderBy('code', 'DESC')->select('description as name', 'id')->pluck('name', 'id')->toArray();

                $fieldDetailed = SelectsBasics::where('father', '=', $matrizConcourseConfig->specific_id)
                    ->orderBy('code', 'DESC')->select('description as name', 'id')->pluck('name', 'id')->toArray();

                $fieldDisciplines = SelectsBasics::where('father', '=', $matrizConcourseConfig->detail_id)
                    ->orderBy('code', 'DESC')->select('description as name', 'id')->pluck('name', 'id')->toArray();;

                $selectFieldDiscipline = ($matrizConcourseConfig->concourseMatrizDetail()->pluck('discipline_id'));


            } else {
                $matrizConcourseConfig = new \stdClass();
                $matrizConcourseConfig->id = 0;
                $matrizConcourseConfig->max_tc = 0;
                $matrizConcourseConfig->max_tm = 0;
                $matrizConcourseConfig->extends_id = '';
                $matrizConcourseConfig->specific_id = 0;
                $matrizConcourseConfig->detail_id = 0;
                $matrizConcourseConfig->facultad_id=0;
                $fieldSpecific = [];
                $fieldDetailed = [];
                $fieldDisciplines = [];
                $selectFieldDiscipline = [];

            }

            $fieldsExtends = SelectsBasics::where('module', 'CAMP-AMPLIO')
                ->pluck('description', 'id')->toArray();

            $concourseMatriz = MeritConcourseConfigMatriz::with('concourseMatrizDetail.disciplineField',
                'extendsField', 'specificField', 'detailField')->where('merit_concourse_config_id', $concourseConfig->id)
                ->get();


            return view($this->path . '.matriz')->with(['faculties'=>$faculties,'selectFieldDiscipline' => $selectFieldDiscipline, 'fieldDisciplines' => $fieldDisciplines, 'fieldDetailed' => $fieldDetailed, 'fieldSpecific' => $fieldSpecific, 'fieldsExtends' => $fieldsExtends, 'concourseConfig' => $concourseConfig,
                'concourseMatriz' => $concourseMatriz, 'matrizConcourseConfig' => $matrizConcourseConfig]);
        }
    }

    public function deleteMatrizConcourseConfig(Request $request, MeritConcourseConfig $concourseConfig, MeritConcourseConfigMatriz $meritConcourseConfigMatriz)
    {
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            MeritConcourseConfigMatrizDetail::where('merit_concourse_config_matriz_id', '=', $meritConcourseConfigMatriz->id)->delete();
            $meritConcourseConfigMatriz->delete();
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            Messages::errorRegisterCustom($e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::connection('sqlsrv_modulos')->commit();


        Messages::errorRegisterCustom('Matriz eliminada correctamente!!');
        return redirect()->route($this->path . '.matriz', [$concourseConfig->id, 0]);
    }

    public function saveOrUpdateMatrizConcourse(Request $request, MeritConcourseConfig $concourseConfig, $code = 0)
    {

        $this->validate($request, ['facultad_id'=>'required','fieldExtends' => 'required|numeric'
            , 'fieldSpecific' => 'required|numeric', 'fieldDetailed' => 'required|numeric', 'fieldDisciplines' => 'required', 'fieldVacanciesTC' => 'required|numeric', 'fieldVacanciesMT' => 'required|numeric'], [
            'fieldExtends.required' => 'El campo amplio es requerido',
            'fieldExtends.numeric' => 'El campo amplio debe ser numerico',
            'fieldDetailed.required' => 'El campo detallado es requerido',
            'fieldDetailed.numeric' => 'El campo detallado debe ser numerico',
            'fieldSpecific.required' => 'El campo específico es requerido',
            'fieldSpecific.numeric' => 'El campo específico debe ser numerico',
            'fieldVacanciesTC.required' => 'El campo tiempo completo es requerido',
            'fieldVacanciesTC.numeric' => 'El campo  tiempo completo debe ser numerico',
            'fieldVacanciesMT.required' => 'El campo medio tiempo es requerido',
            'fieldVacanciesMT.numeric' => 'El campo medio tiempo debe ser numerico',
            'fieldDisciplines.required' => 'El campo disciplinas es requerido',
            'facultad_id.required'=>'El campo facultad es requerido'
        ]);
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {

            if ($code != 0) {
                $objConcourseConfigMatriz = MeritConcourseConfigMatriz::find($code);
            } else {
                $objConcourseConfigMatriz = new MeritConcourseConfigMatriz();
                $objConcourseConfigMatriz->user_created = Auth::user()->id;
            }
            $objConcourseConfigMatriz->user_updated = Auth::user()->id;

            $objConcourseConfigMatriz->fill(['extends_id' => $request->fieldExtends, 'specific_id' => $request->fieldSpecific,
                'detail_id' => $request->fieldDetailed, 'max_tc' => $request->fieldVacanciesTC, 'max_tm' => $request->fieldVacanciesMT]);
            $objConcourseConfigMatriz->facultad_id=$request->facultad_id;

            $concourseConfig->matrices()->save($objConcourseConfigMatriz);


            $disciplines = [];
            foreach ($request->fieldDisciplines as $item) {
                $objConcourseConfigMatrizDetail = new MeritConcourseConfigMatrizDetail();
                $objConcourseConfigMatrizDetail->fill(['discipline_id' => $item]);
                $objConcourseConfigMatrizDetail->user_created = Auth::user()->id;
                $objConcourseConfigMatrizDetail->user_updated = Auth::user()->id;
                $disciplines[] = $objConcourseConfigMatrizDetail;
            }
            if (count($disciplines) > 0) {
                MeritConcourseConfigMatrizDetail::where('merit_concourse_config_matriz_id', '=', $objConcourseConfigMatriz->id)->delete();
                $objConcourseConfigMatriz->concourseMatrizDetail()->saveMany($disciplines);
            }
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            Messages::errorRegisterCustom($e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::connection('sqlsrv_modulos')->commit();


        Messages::infoRegisterCustom('Matriz guardada correctamente!!');
        return redirect()->route($this->path . '.matriz', [$concourseConfig->id, 0]);
    }

    public function configConcourseComisiones(Request $request, MeritConcourseConfig $concourseConfig,
                                              $code = 0){
        if ($request->ajax()) {
            return response()->json(['Acceso no autorizado'], 401);
        } else {

            $users=User::join('role_user','users.id','=','role_user.user_id')
                ->where('role_id',env('COMISIONES'))
                ->select('users.id',DB::raw("users.first_name+' '+users.last_name as names"))
                ->pluck('names','id')->toArray();
            if ($code != 0) {
                $comisionConcourseConfig = MeritConcourseConfigComision::findOrFail($code);
            }else{
                $comisionConcourseConfig = new \stdClass();
                $comisionConcourseConfig->id = 0;
            }

            $concourseMatriz = MeritConcourseConfigMatriz::with('concourseMatrizDetail.disciplineField',
                'extendsField', 'specificField', 'detailField')->where('merit_concourse_config_id', $concourseConfig->id)
                ->get();

            $userComisions=MeritConcourseConfigComision::where('merit_concourse_config_id', $concourseConfig->id)->get();

            $userComisionsData=[];
            foreach ($userComisions as $userC){
                $userComisionsData[$userC->merit_concourse_config_matriz_id][$userC->comision_id][]=$userC->user_id;
            }

            $faculties=(new SelectController())->getfaculty();
            return view($this->path . '.comision')->with([
                'concourseConfig' => $concourseConfig,
                'comisiones'=>config('dataselects.comisiones'),
                'comisionConcourseConfig'=>$comisionConcourseConfig,
                'users'=>$users,
                'concourseMatriz'=>$concourseMatriz,
                'faculties'=>$faculties,
                'userComisionsData'=>$userComisionsData
                ]);

        }
    }

    public function saveOrUpdateComisiones(Request $request, MeritConcourseConfig $concourseConfig){
        $this->validate($request,['usuariosApelaciones'=>'required',
            'usuariosEvaluaciones'=>'required']);


        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {

            $concourseMatriz = MeritConcourseConfigMatriz::where('merit_concourse_config_id', $concourseConfig->id)
                ->pluck('id')->toArray();

          foreach ($concourseMatriz as $id){
              if(!array_key_exists($id,$request->usuariosApelaciones)){
                 return redirect()->route($this->path . '.comisiones', [$concourseConfig->id])->withErrors(['error'=>'TODOS LOS CAMPOS SON OBLIGATORIOS']);
              }
          }


            $apelaciones = [];
            foreach ($request->usuariosApelaciones as $key=> $users) {
                foreach($users as $user){
                    $objMeritConcourseConfigComision = new MeritConcourseConfigComision();
                    $objMeritConcourseConfigComision->comision_id=2;
                    $objMeritConcourseConfigComision->user_created = Auth::user()->id;
                    $objMeritConcourseConfigComision->user_updated = Auth::user()->id;
                    $objMeritConcourseConfigComision->merit_concourse_config_matriz_id=$key;
                    $objMeritConcourseConfigComision->user_id=$user;
                    $apelaciones[] = $objMeritConcourseConfigComision;
                }

            }
            if (count($apelaciones) > 0) {
                $concourseConfig->comisiones()->where('id','=', $concourseConfig->id)
                    ->where('comision_id','=',2)->delete();
                $concourseConfig->comisiones()->saveMany($apelaciones);
            }

            $evaluaciones = [];
            foreach ($request->usuariosEvaluaciones as $key=> $users) {
                foreach($users as $user){
                    $objMeritConcourseConfigComision = new MeritConcourseConfigComision();
                    $objMeritConcourseConfigComision->comision_id=1;
                    $objMeritConcourseConfigComision->user_created = Auth::user()->id;
                    $objMeritConcourseConfigComision->user_updated = Auth::user()->id;
                    $objMeritConcourseConfigComision->merit_concourse_config_matriz_id=$key;
                    $objMeritConcourseConfigComision->user_id=$user;
                    $evaluaciones[] = $objMeritConcourseConfigComision;
                }

            }
            if (count($evaluaciones) > 0) {
                $concourseConfig->comisiones()->where('id','=', $concourseConfig->id)
                    ->where('comision_id','=',1)->delete();
                $concourseConfig->comisiones()->saveMany($evaluaciones);
            }

        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            Messages::errorRegisterCustom($e->getMessage());
            return redirect()->route($this->path . '.comisiones', [$concourseConfig->id])->withInput();
        }

        DB::connection('sqlsrv_modulos')->commit();


        Messages::infoRegisterCustom('Comisiones guardadas correctamente!!');
        return redirect()->route($this->path . '.comisiones', [$concourseConfig->id]);
    }
}