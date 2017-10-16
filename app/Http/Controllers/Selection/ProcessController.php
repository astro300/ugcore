<?php

namespace UGCore\Http\Controllers\Selection;

use Illuminate\Http\Request;
use UGCore\Core\Entities\Security\User;
use UGCore\Core\Entities\Selections\MeritConcourseConcept;
use UGCore\Core\Entities\Selections\MeritConcourseConfigMatriz;
use UGCore\Core\Entities\Selections\MeritConcourseStep;
use UGCore\Core\Entities\Selections\MeritInputDetail;
use UGCore\Core\Entities\Selections\MeritInputMaster;
use UGCore\Core\Entities\Selections\MeritPersonalInformationDefault;
use UGCore\Core\Repositories\Selections\SelectionRepository;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Entities\Selections\MeritConcourseConfig;
use Messages;
use Utils;
use PDF;
use Auth;
use Milon\Barcode\DNS1D;
use Validator;
use Carbon;
use DB;

class ProcessController extends Controller
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

    public function index(Request $request)
    {
        if($request->ajax()){
             return response()->json(view('selection.merit.table')->with( [
                 'filterstatus'=>$request->filterstatus,
                 'concourses' =>$this->objMeritRPY->forConcourseAvailablePostulant($request->scope,$request->filterstatus)])->render());

        }
           return view('selection.merit.index')->with(
                [

                    'filterstatus'=>'D','concourses' => $this->objMeritRPY->
                forConcourseAvailablePostulant($request->scope,'D'), 'scope' => $request->scope]);

    }

    public function create($id)
    {
        $objConfig = MeritConcourseConfig::findOrFail($id);

        if ($objConfig->status != 'A') {
            return redirect()->route('process.user.index')->withErrors(["Error" => "El proceso no se encuentra activo para poder participar"]);
        }

        if($objConfig->steps(\Config::get('configVar.concourse')['keyDocumentacion'])==0)
        {
            return redirect()->route('process.user.index')->withErrors(["Error" => "El proceso ya no se encuentra vigente para poder participar"]);
        }

        $objConceptsInformation = $this->objMeritRPY->forConceptsConcourseForm($objConfig->id, \Auth::user()->id);
        if (count($objConceptsInformation) == 0) {
            return redirect()->route('process.user.index')->withErrors(["Error" => "El proceso no tiene conceptos asignados consulte con el administrador"]);
        }

        $objResponseMaster = $this->objMeritRPY->forFindMeritMasterUserConcourse(\Auth::user()->id, $id);

        if ($objResponseMaster != null) {
            if ($objResponseMaster->status == 'F') {
                $objUser = User::find($objResponseMaster->user_id);
                return redirect()->route('process.user.index')->withErrors(['error' => 'El proceso ' . $objResponseMaster->meritconcourseconfig->title . ', fue finalizado por el usuario ' . $objUser->description . ' ' . $objResponseMaster->updated_at->diffForHumans()]);
            }
        }else{
            $objResponseMaster=new \stdClass();
            $objResponseMaster->merit_concourse_matriz_id=0;
        }

        /*Para guardar datos personales*/
        $objInformation=$this->objMeritRPY->getPersonalInformation(\Auth::user()->name);
        $cantonesDir = ['' => '* SELECCIONE *'];
        $cantonesLab = ['' => '* SELECCIONE *'];
        if($objInformation==null){
            $objInformation=new MeritPersonalInformationDefault();
            $objInformation->defaultData();
        }
        else {
            $cantonesDir = array_map('trim', $cantonesDir+$this->objMeritRPY->getSelectCantonNacional(1, $objInformation->idProvDir));
            $cantonesLab = array_map('trim', $cantonesLab+$this->objMeritRPY->getSelectCantonNacional(1, $objInformation->idProvLab));
        }



        return view('selection.merit.create')
            ->with(['objConceptsInformation' => $objConceptsInformation,
                'objConfig' => $objConfig,'objInformation'=>$objInformation,
                'estadoCivil'=>[''=>'* SELECCIONE *']+$this->objMeritRPY->getEstadoCivil(),
                'paisesDir' =>[''=>'* SELECCIONE *']+$this->objMeritRPY->getSelectProvinciaNacional(1),
                'paisesLab' =>[''=>'* SELECCIONE *']+$this->objMeritRPY->getSelectProvinciaNacional(1),
                'idSexo' =>[''=>'* SELECCIONE *',"1"=>'Masculino',"2"=>'Femenino'],
                'idCiudadDir'=>$cantonesDir,
                'idCiudadLab'=>$cantonesLab,
                'objResponseMaster'=> $objResponseMaster,
                'concourseMatriz'=> MeritConcourseConfigMatriz::with('concourseMatrizDetail.disciplineField',
                    'extendsField','specificField','detailField')->where('merit_concourse_config_id',$objConfig->id)->get(),
                'faculties'=>(new SelectController())->getfaculty()
            ]);
    }
    /*para recorrido de cantones - jcastro*/
    public function getCantonesProvincia($provincia)
    {
        return $this->objMeritRPY->getSelectCantonNacional(1,$provincia);
    }

    public function uploadAndPutDocument(Request $request)
    {
        $objConfig = MeritConcourseConfig::findOrFail($request->concourse);
        if ($objConfig->status != 'A') {
            return response()->json(['content'=>'El proceso no se encuentra activo para poder participar'],401);
        }
        if($objConfig->steps(\Config::get('configVar.concourse')['keyDocumentacion'])==0)
        {
            return response()->json(['content'=>'El proceso ya no se encuentra vigente para poder participar'],401);
        }
        return $this->objMeritRPY->forSaveForm($request);
    }

    public function uploadAndPutDocumentWithFields(Request $request)
    {
        $objConfig = MeritConcourseConfig::findOrFail($request->concourse);
        if ($objConfig->status != 'A') {
            return response()->json(['content'=>['El proceso no se encuentra activo para poder participar']],422);
        }
        if($objConfig->steps(\Config::get('configVar.concourse')['keyDocumentacion'])==0)
        {
            return response()->json(['content'=>['El proceso ya no se encuentra vigente para poder participar']],422);
        }

        $objConcourseConcept=MeritConcourseConcept::with('conceptDocFiles.documentField')->findOrFail($request->conceptConcourse);
        $rules = array(
            'documento' => "pdf|pdferror",
            "typeDocument" => "required|numeric",
            "conceptConcourse" => "required|numeric",
            "idDetail"=>"required|numeric",
            "concourse" => "required|numeric",

        );
        $arrElementData=[];
        foreach ($objConcourseConcept->conceptDocFiles as $objConceptDocFile){
            $objDocumentField=$objConceptDocFile->documentField;
            $rules[$objDocumentField->fields]=$objDocumentField->regexdata;
            $arrElementData[$objDocumentField->fields]=isset($request->all()[$objDocumentField->fields])!=true?'':$request->all()[$objDocumentField->fields];
        }

        $this->validate($request,$rules);
        return $this->objMeritRPY->forSaveFormWithFields($request,$objConcourseConcept,$arrElementData);

    }

    public function addDocumentWithFields(Request $request){
        return $this->objMeritRPY->forGetFormWithFields($request);
    }

    public function deleteDocumentWithFields(Request $request)
    {
        return $this->objMeritRPY->forDeleteFormWithFields($request);
    }

    public function deleteDocumentDetail(Request $request,MeritInputDetail $meritInputDetail){
        return $this->objMeritRPY->forDeleteDocumentDetail($request,$meritInputDetail);

    }


    public function updateDataPersonUser(Request $request, $id, $users)
    {
        $information = $this->objMeritRPY->savePersonalInformation($request);
        if($information=='1'){
            Messages::infoRegisterCustom("Los datos personales fueron ingresados correctamente");
        }
        else{
            if($information=='2'){
                Messages::infoRegisterCustom("Los datos personales fueron actualizados correctamente");
            }
        }

        return redirect()->route('process.user.create', $id);
    }


    public function show($id)
    {
        $userID = \Auth::user()->id;
        $objConfig = MeritConcourseConfig::find($id);
        $this->notFound($objConfig);

        $objConceptsInformation = $this->objMeritRPY->forConceptsConcourseForm($objConfig->id, $userID);
        if (count($objConceptsInformation) == 0) {
            return redirect()->route('process.user.index')->withErrors(["Error" => "El proceso no tiene conceptos asignados consulte con el administrador"]);
        }

        $objResponseMaster = $this->objMeritRPY->forFindMeritMasterUserConcourse($userID, $id);
        if ($objResponseMaster != null) {
            $this->owner($objResponseMaster->created_by);
        }




        return view('selection.merit.show')
            ->with(['objResponseMaster' => $objResponseMaster, 'objConceptsInformation' => $objConceptsInformation, 'objUser' => Auth::user(),
                'objConfig' => $objConfig, 'images' => asset('/images/logo_.png'), 'barcode' => $this->barcode]);

    }

    public function assigmentMatrizConcourse(Request $request,MeritConcourseConfig $concourseConfig,
                                             MeritConcourseConfigMatriz $meritConcourseConfigMatriz,$type){
       try{

            $this->objMeritRPY->forSaveMatrizAssigment($meritConcourseConfigMatriz->id,$concourseConfig->id,
                \Auth::user()->id,$request->ip(),$type);
            return response()->json(["PROCESO REALIZADO CORRECTAMENTE"], 200);
       }catch (\Exception $exception){
          return response()->json(['Error de procesamiento: '.$exception->getMessage()], 500);
       }

    }








    public function reportTemplate($id)
    {
        $objConfig = MeritConcourseConfig::findOrFail($id);

        $objResponseMaster = $this->objMeritRPY->forFindMeritMasterUserConcourse(\Auth::user()->id, $id);
        if($objResponseMaster==null){
            abort(404);
        }
        if ($objResponseMaster->status == 'F') {

            $image = public_path('images/logo_.png');
            $objUser = User::findOrFail($objResponseMaster->user_id);

            $objConceptsInformation = $this->objMeritRPY->forConceptsConcourseForm($id, $objResponseMaster->user_id);
            if (count($objConceptsInformation) == 0) {
                return redirect()->route('process.user.index')->withErrors(["Error" => "El Proceso no tiene conceptos asignados consulte con el administrador"]);
            }


            $pdf = PDF::loadView('selection.merit.report',
                ['style' => 'REPORT', 'objResponseMaster' => $objResponseMaster, 'objConceptsInformation' => $objConceptsInformation, 'objUser' => Auth::user(),
                    'objConfig' => $objConfig,
                    'images' => $image, 'barcode' => $this->barcode]);


            return $pdf->download($objUser->name . '_ficha_inscripcion.pdf', ["Content-Type" => "application/pdf"]);
        }
        return redirect()->route('process.user.index')->withErrors(['error' => 'El Proceso ' . $objResponseMaster->meritconcourseconfig->title . ',  no se encuentra finalizado por el usuario ']);

    }

    public function finishconcourse($id)
    {$userId=Auth::user()->id;

        $objResponseMaster =  $this->objMeritRPY->forFindMeritMasterUserConcourse($userId, $id);
        if($objResponseMaster==null){
            Messages::errorRegisterCustom("Estimado/a, " . Auth::user()->description . " se le informa que no puede postular su participaci&oacute;n sin antes subir documentos a la plataforma!!");
            return redirect()->route('process.user.create',$id);
        }else{
            if ($objResponseMaster->merit_concourse_matriz_id == null) {
                return redirect()->route('process.user.create', $id)
                    ->withErrors("Debes seleccionar un &aacute;rea al cual deseas aplicar.!!");
            }
           $arrayDocuments=($this->objMeritRPY->forGetDocumentsRequired($id,$objResponseMaster->id));
            $msg="";
           foreach ($arrayDocuments as $item){
               $msg.="El documento:".($item['typedocument']). "de la categor&iacute;a: ". ($item['subcategory'])." es necesario para postular.<br>";
           }
           if($msg!=""){
               Messages::errorRegisterCustom("$msg");
               return redirect()->route('process.user.create',$id);
           }
        }

        $this->objMeritRPY->forFinishConcourse($userId, $id);
        Messages::infoRegisterCustom("Estimado/a, " . Auth::user()->description . " se le informa que la postulaci&oacute;n al proceso se realiz&oacute; de manera correcta!!");
        return redirect()->route('process.user.index');
    }

}
