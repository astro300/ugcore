<?php
namespace UGCore\Core\Repositories\Selections;

use Auth;
use Config;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Markdown;
use Storage;
use UGCore\Core\Entities\Comun\EmailQueue;
use UGCore\Core\Entities\Comun\SelectsBasics;
use UGCore\Core\Entities\Selections\MeritCategory;
use UGCore\Core\Entities\Selections\MeritConceptDocFile;
use UGCore\Core\Entities\Selections\MeritConcourseConcept;
use UGCore\Core\Entities\Selections\MeritConcourseConfig;
use UGCore\Core\Entities\Selections\MeritConcourseConfigComision;
use UGCore\Core\Entities\Selections\MeritConcourseStep;
use UGCore\Core\Entities\Selections\MeritInputDetail;
use UGCore\Core\Entities\Selections\MeritInputMaster;
use UGCore\Core\Entities\Selections\MeritInputValidate;
use UGCore\Core\Entities\Selections\MeritPersonalInformation;
use UGCore\Core\Entities\Selections\Merittypedocument;
use Utils;
use Validator;

class SelectionRepository
{
    private $flagActions = false;
    private $key, $value;
    private $arrFTP = ['Foto'=>'MODULOS/CONCURSO_MERITOS_FOTOS/','Documentos'=>'MODULOS/CONCURSO_MERITOS/','Default'=>'MODULOS/'];

    public function getDataSelectBasic($module)
    {
        return SelectsBasics::where('status', '=', 'A')->where('module', '=', $module)->orderBy('description', 'ASC')
            ->pluck('description', 'id');
    }

    public function forConcourseConfig()
    {

        return \Datatables::of(MeritConcourseConfig::from('Concourse.merit_concourse_configs')
            //->leftJoin('catalogos.select_basics', 'Concourse.merit_concourse_configs.select_basic_id', '=', 'catalogos.select_basics.id')
            ->orderBy('Concourse.merit_concourse_configs.id', 'asc')
            ->select('Concourse.merit_concourse_configs.id', 'Concourse.merit_concourse_configs.date_initial'
                , 'Concourse.merit_concourse_configs.date_finish'

                , 'Concourse.merit_concourse_configs.title')->get())
            ->add_column('actions', ' <a href="{{ route(\'selection.config.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>
                                 <br/><a  href="{{ route(\'selection.config.concourseconcepts\', $id) }}"><span class="fa fa-gear"></span>&nbsp;Conceptos</a>
                                  <br/><a  href="{{ route(\'selection.config.concoursesteps\', $id) }}"><span class="icon-footprint"></span>&nbsp;Etapas</a>
                                <br/><a  href="{{ route(\'selection.config.matriz\', $id) }}"><span class="icon-notebook"></span>&nbsp;Matriz</a>
                                   <br/><a  href="{{ route(\'selection.config.comisiones\', $id) }}"><span class="icon-user"></span>&nbsp;Comisiones</a>
                                   <br/><a style="color: red" href="{{ route(\'selection.config.conceptdocfiles\', $id) }}"><span class="icon-database"></span>&nbsp;Campos</a>
                                  ')
            ->add_column('date_full', '{{ Utils::getFormatDateDB($date_initial,true,false)." - ".Utils::getFormatDateDB($date_finish,true,false)}}')
            ->make(true);

    }

    public function forDataCategories()
    {
        return \Datatables::of(MeritCategory::select('id', 'name', 'type', 'status')->get())
            ->add_column('actions', ' <a href="{{ route(\'selection.category.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>')
            ->add_column('status_full', '{{ $status=="A"?"ACTIVO":"INACTIVO"}}')
            ->add_column('type_full', '{{ $type=="1"?"CATEGOR&Iacute;A":"SUBCATEGOR&Iacute;A"}}')
            ->make(true);
    }

    public function forDataTypeDocuments()
    {
        return \Datatables::of(Merittypedocument::
        get(['merittypedocuments.id', 'merittypedocuments.name','merittypedocuments.nametable'
            , 'merittypedocuments.status as status', 'merittypedocuments.prefix']))
            ->add_column('actions',
                ' <a href="{{ route(\'selection.typedocument.edit\', $id) }}"><span class="fa fa-pencil"></span></a> &nbsp;@if($nametable!=null)<a class="text-danger" href="{{ route(\'selection.typedocument.fields\', $id) }}"><span class="fa fa-database"></span></a>@endif')
            ->add_column('status_full', '{{ $status=="A"?"ACTIVO":"INACTIVO"}}')
            ->make(true);

    }

    public function getSelectTypeDocuments()
    {
        return Merittypedocument::where('status', '=', 'A')->pluck('name', 'id');
    }

    public function getSelectCategories()
    {
        $categories = MeritCategory::orderBy('id', 'ASC')->pluck('name', 'id');
        return $categories;
    }

    public function forCategoriesGlobal($type)
    {
        return MeritCategory::orderBy('id', 'ASC')->where('status', 'A')->where('type', '=', $type)->pluck('name', 'id');
    }

    public function forConceptsConcourse($id)
    {
        return MeritConcourseConcept::where('status', 'A')->where('merit_concourse_config_id', '=', $id)->get();
    }

    public function forConceptsConcourseDocument($id)
    {
        return MeritConcourseConcept::with('document.meritTypeDocumentFields')->where('status', 'A')->where('merit_concourse_config_id', '=', $id)->get();
    }

    public function forConceptsConcourseForm($concourse, $idUser)
    {

        $arrMeritConcourseConcept = MeritConcourseConcept::from('Concourse.merit_concourse_concepts as mcc')
            ->join('Concourse.merit_categories as mc', 'mc.id', '=', 'mcc.meritcategory_id')
            ->join('Concourse.merit_categories as ms', 'ms.id', '=', 'mcc.meritsubcategory_id')
            ->join('Concourse.merittypedocuments as md', 'md.id', '=', 'mcc.merittypedocument_id')
            ->join('Concourse.merit_concourse_configs as cnf', 'cnf.id', '=', 'mcc.merit_concourse_config_id')
            ->leftJoin('Concourse.merit_input_masters as cmm ', function ($left) use ($idUser) {
                $left->on('cmm.merit_concourse_config_id', '=', 'cnf.id')->where('cmm.user_id', '=', $idUser);
            })
            ->leftJoin('Concourse.merit_input_details as mid', function ($join) {
                $join->on('mid.merit_input_master_id', '=', 'cmm.id');
                $join->on('mid.merit_concourse_concept_id', '=', 'mcc.id');
                $join->where('mid.status', '=', 'A');
            })
            -> select('cmm.date_open',
                'cmm.date_close',
                'cmm.status as status_response',
                'mid.id as idDetail',
                'mid.path as pathdoc',
                'mid.namefile as namefile',
                'mid.created_at as filecreation',
                'mid.status_validation as status_validation',
                'mid.percentage_validation as percentage_validation',
                'mcc.merit_concourse_config_id as concourse',
                'cnf.title',
                'cnf.description',
                'cnf.status',
                'cnf.date_initial',
                'cnf.date_finish',
                'mcc.meritcategory_id as key_category',
                'mc.name as name_category',
                'mcc.meritsubcategory_id as key_subcategory',
                'ms.name as name_subcategory',
                'mcc.merittypedocument_id as key_document',
                'md.name as name_document',
                'md.description as observation',
                'mcc.observation as observation_judge',


                'mcc.score as puntaje_one',
                'mcc.max_score as puntaje_max',
                'mcc.number_max_valid as max_accept',

                'mcc.id AS concourseConceptID',
                'mcc.required',
                'mcc.many',
                'md.nametable')
            ->where('mcc.merit_concourse_config_id', '=', $concourse)
            ->where('mcc.status', '=', 'A')->get();


        $arrayResult = [];
        $arrayNameTable=[];
        foreach ($arrMeritConcourseConcept as $key => $itemMeritConcourse) {

            if ($key == 0) {

                $arrayResult['information'][$itemMeritConcourse['concourse']]['title'] = $itemMeritConcourse['title'];
                $arrayResult['information'][$itemMeritConcourse['concourse']]['description'] = $itemMeritConcourse['description'];
                $arrayResult['information'][$itemMeritConcourse['concourse']]['status'] = $itemMeritConcourse['status'];
                $arrayResult['information'][$itemMeritConcourse['concourse']]['date_ini'] = $itemMeritConcourse['date_initial'];
                $arrayResult['information'][$itemMeritConcourse['concourse']]['date_fin'] = $itemMeritConcourse['date_finish'];

                $arrayResult['information'][$itemMeritConcourse['concourse']]['date_open'] = $itemMeritConcourse['date_open'];
                $arrayResult['information'][$itemMeritConcourse['concourse']]['date_close'] = $itemMeritConcourse['date_close'];
                $arrayResult['information'][$itemMeritConcourse['concourse']]['status_response'] = $itemMeritConcourse['status_response'];

                $arrayResult['fields']=[];
            }

            $arrayResult['categories'][$itemMeritConcourse['concourse']][$itemMeritConcourse['key_category']] = $itemMeritConcourse['name_category'];
            $arrayResult['subcategories'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']][$itemMeritConcourse['key_subcategory']] = $itemMeritConcourse['name_subcategory'];


            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['name'] = $itemMeritConcourse['name_document'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['observation'] = $itemMeritConcourse['observation'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['concourseConceptID'] = $itemMeritConcourse['concourseConceptID'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['jurado'] = $itemMeritConcourse['observation_judge'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['puntaje_one'] = $itemMeritConcourse['puntaje_one'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['puntaje_max'] = $itemMeritConcourse['puntaje_max'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['max_accept'] = $itemMeritConcourse['max_accept'];



            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['required'] =$itemMeritConcourse['required'] == null ? '2' : $itemMeritConcourse['required'];

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['many'] =$itemMeritConcourse['many'] == null ? '2' : $itemMeritConcourse['many'];


            if(!array_key_exists($itemMeritConcourse['concourseConceptID'],$arrayResult['fields'])){
                $arrayResult['fields'][$itemMeritConcourse['concourseConceptID']]=
                    MeritConceptDocFile::with('documentField')->where('merit_concourse_concept_id','=',$itemMeritConcourse['concourseConceptID'])->where('status','=','A')->get();


            }


            if($itemMeritConcourse['nametable']!=null && $itemMeritConcourse['idDetail']!=null){
                $arrayNameTable[$itemMeritConcourse['nametable']][]=$itemMeritConcourse['idDetail'];
            }

            $arrayResult['documents'][$itemMeritConcourse['concourse']]
            [$itemMeritConcourse['key_category']]
            [$itemMeritConcourse['key_subcategory']][$itemMeritConcourse['key_document']]['details'][]=[
                'pathdoc'=> $itemMeritConcourse['pathdoc'] == null ? '' : $itemMeritConcourse['pathdoc'],
                'namefile'=>$itemMeritConcourse['namefile'] == null ? '' : $itemMeritConcourse['namefile'],
                'filecreation'=>$itemMeritConcourse['filecreation'] == null ? '' : $itemMeritConcourse['filecreation'],
                'idDetail'=> $itemMeritConcourse['idDetail'] == null ? '0' :  $itemMeritConcourse['idDetail'],
                'status_validation'=> $itemMeritConcourse['status_validation'] == null ? '' : $itemMeritConcourse['status_validation'],
                'percentage_validation'=> $itemMeritConcourse['percentage_validation'] == null ? '0' : $itemMeritConcourse['percentage_validation']
            ];
        }

        $arrayItemsDB=[];
        foreach ($arrayNameTable as $nameTable => $ids){
            $resultDataBase=(DB::connection('sqlsrv_modulos')->table('Concourse.doc_'.trim($nameTable))
                ->whereIn('merit_input_detail_id', $ids)
                ->get());


            foreach ($resultDataBase as $itemDB){
                $arrayItemsDB[$itemDB->merit_input_detail_id]=collect($itemDB)->toArray();
            }
        }
        if(count($arrayItemsDB)>0){
            $arrayResult['resultDB']=$arrayItemsDB;
        }


        return $arrayResult;
    }

    public function forConcourseAvailablePostulant($scope, $filterstatus)
    {
        $query= MeritConcourseConfig::leftJoin('Concourse.merit_input_masters', function ($leftJoin) {
            $leftJoin->on('Concourse.merit_concourse_configs.id', '=',
                'Concourse.merit_input_masters.merit_concourse_config_id')
                ->where('modulos.Concourse.merit_input_masters.user_id', '=', Auth::user()->id);
        })
            ->join('Concourse.merit_concourse_config_steps',function($join){
                $join->on('Concourse.merit_concourse_config_steps.merit_concourse_config_id','=','Concourse.merit_concourse_configs.id')
                    ->where('Concourse.merit_concourse_config_steps.select_basic_id','=',
                        \Config::get('configVar.concourse')['keyDocumentacion']);
            })
            ->orderBy('Concourse.merit_concourse_configs.date_finish', 'desc')
            ->where('Concourse.merit_concourse_configs.title', 'LIKE', "%$scope%")

            ->where('Concourse.merit_concourse_configs.status', '=', 'A')
            ->select('Concourse.merit_concourse_config_steps.date_end as date_finish', 'Concourse.merit_concourse_configs.title',
                'Concourse.merit_concourse_config_steps.date_start as date_initial', 'Concourse.merit_concourse_configs.id',
                'Concourse.merit_concourse_configs.description', 'Concourse.merit_input_masters.status as status_master');

        if($filterstatus!='F'){
            $query=$query ->where('Concourse.merit_concourse_config_steps.date_start', '<=', Utils::getDateSQL(true, false))
                ->where('Concourse.merit_concourse_config_steps.date_end', '>=', Utils::getDateSQL(true, false));
        }


        if ($filterstatus == 'D') {
            return $query->whereNull('Concourse.merit_input_masters.status')->paginate(5);
        }else{

            return $query->where('Concourse.merit_input_masters.status', '=', $filterstatus)->paginate(5);
        }

    }

    public function forConcourseAvailable($scope)
    {
        return (MeritConcourseConfig::with('meritinputmasters.meritconcourseconfig')
            ->orderBy('date_finish', 'desc')
            ->where('title', 'LIKE', "%$scope%")
            ->where('date_initial', '<=', Utils::getDateSQL(true, false))
            ->where('date_finish', '>=', Utils::getDateSQL(true, false))
            ->where('status', '=', 'A')
            ->paginate(2));
    }

    public function forConcourseAvailableSingle()
    {
        return MeritConcourseConfig::orderBy('date_finish', 'desc')
            ->where('status', '=', 'A')
            ->get(['id', 'title', 'description', 'date_initial', 'date_finish', 'status'])->toArray();
    }

    public function forFindMeritMasterId($id)
    {
        return MeritInputMaster::find($id);
    }

    public function forFindMeritMasterUserConcourse($userID, $concourse)
    {
        return MeritInputMaster::where('user_id', $userID)->where('merit_concourse_config_id', '=', $concourse)->first();
    }

    public function forGetDocumentsRequired($configConcourse, $masterID = 0)
    {
        return MeritConcourseConcept::join('Concourse.merit_categories as mc', 'mc.id', '=', 'Concourse.merit_concourse_concepts.meritcategory_id')
            ->join('Concourse.merit_categories as ms', 'ms.id', '=', 'Concourse.merit_concourse_concepts.meritsubcategory_id')
            ->join('Concourse.merittypedocuments as mt', 'mt.id', '=', 'Concourse.merit_concourse_concepts.merittypedocument_id')
            ->where('Concourse.merit_concourse_concepts.status', '=', 'A')
            ->where('Concourse.merit_concourse_concepts.merit_concourse_config_id', '=', $configConcourse)
            ->where('Concourse.merit_concourse_concepts.required', '=', '1')
            ->whereNotIn('Concourse.merit_concourse_concepts.id', function ($query) use ($masterID) {
                $query->select('merit_concourse_concept_id')->from('Concourse.merit_input_details')->where('merit_input_master_id', '=', $masterID);
            })
            ->select('Concourse.merit_concourse_concepts.id', 'mc.name as category', 'ms.name as subcategory', 'mt.name as typedocument')->get()->toArray();

    }

    public function forCountMeritMasterValidatorCountPostulants($userID, $concourse)
    {
        return MeritInputMaster::where('merit_concourse_config_id', '=', $concourse)
            ->where('status', '=', 'F')->count();

    }

    public function forCountMeritMasterCountPostulants($concourse)
    {
        return MeritInputMaster::where('merit_concourse_config_id', '=', $concourse)
            ->where('status', '=', 'F')->count();
    }

    public function forMeritMasterValidatorCountPostulants($concourse, $flagPagination = false, $scope = '',$user_validator=null)
    {
        $matrizAccess=MeritConcourseConfigComision::where('user_id','=',$user_validator)
            ->where('merit_concourse_config_id','=',$concourse)
            ->select('merit_concourse_config_matriz_id')->pluck('merit_concourse_config_matriz_id')->toArray();


        if (!$flagPagination) {
            $datos= MeritInputMaster::from('Concourse.merit_input_masters as m')->join(env('DB_PREFIJO') . 'ugcore.dbo.users as u', 'u.id', '=', 'm.user_id')
                ->where('m.status', '=', 'F')
                ->where('m.merit_concourse_config_id', '=', $concourse)
                ->select('u.id', 'u.name as nuic', DB::raw("u.last_name+' '+ u.first_name as names"), 'u.email', 'm.date_close')
                ->orderBy('names', 'ASC');
            if($user_validator!=null){

                if(count($matrizAccess)>0){
                    return $datos->whereIn('merit_concourse_matriz_id',$matrizAccess)->get();
                }else{
                    return [];
                }
            }else{
                return $datos->get();
            }

        } else {
            $datos= MeritInputMaster::from('Concourse.merit_input_masters as m')->join(env('DB_PREFIJO') . 'ugcore.dbo.users as u', 'u.id', '=', 'm.user_id')
                ->where('m.status', '=', 'F')->where('m.merit_concourse_config_id', '=', $concourse)
                ->where(function ($where) use ($scope) {
                    $where->where('u.name', 'like', "%$scope%")
                        ->orWhere('u.last_name', 'like', "%$scope%")
                        ->orWhere('u.first_name', 'like', "%$scope%");
                })
                ->select('u.id', 'u.name as nuic', DB::raw("u.last_name+' '+ u.first_name as names"), 'u.email', 'm.date_close','m.merit_concourse_matriz_id','m.type_postulation')
                ->orderBy('u.last_name', 'ASC');

            if($user_validator!=null){

                if(count($matrizAccess)>0){
                    return $datos->whereIn('merit_concourse_matriz_id',$matrizAccess)->paginate(1);
                }else{
                    return [];
                }
            }else{
                return $datos->paginate(1);
            }
        }

    }

    public function forMeritMasterValidatorCountValidations($concourse)
    {
        return MeritInputMaster::from('Concourse.merit_input_masters as m')->join(env('DB_PREFIJO') . 'coresystem.dbo.users as u', 'u.id', '=', 'm.user_id')
            ->where('m.status_validation', '=', 'F')->where('m.merit_concourse_config_id', '=', $concourse)
            ->select('u.name as nuic', DB::raw("u.last_name+' '+ u.first_name as names"), 'u.email', 'm.date_validation', 'm.percentage_validation')
            ->orderBy('names', 'ASC')->get();
    }

    public function forFinishConcourse($userId, $id)
    {
        $this->flagActions = false;
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {

            $objResponseMaster = $this->forFindMeritMasterUserConcourse($userId, $id);
            if ($objResponseMaster->satus != 'F') {
                $objResponseMaster->date_close = Utils::getDateSQL();
                $objResponseMaster->status = 'F';
                $objResponseMaster->updated_by = $userId;
                $objResponseMaster->updated_ip = \Request::ip();
                $objResponseMaster->save();
                $this->flagActions = true;
            }

            if ($this->flagActions) {
                $markdown = new Markdown(view(), config('mail.markdown'));

                $objEmailQueue = new EmailQueue();
                $objEmailQueue->fill(['COD_ESTUDIANTE' => Auth::user()->name
                    , 'NOMBRE_COMPLETO' => Auth::user()->fullName()
                    , 'EMAIL_INSTITUCIONAL' => null
                    , 'EMAIL_PERSONAL' => Auth::user()->email
                    , 'EMAIL_SIUG' => null
                    , 'PROCESO_CORREO' => 'CONCURSO_MERITOS_INSCRIPCION'
                    , 'FECHA_REGISTRO' => Utils::getDateSQL()
                    , 'FECHA_PROCESO'
                    , 'ESTADO' => 'I'
                    , 'ASUNTO' => 'INSCRIPCIÓN AL CONCURSO DE MÉRITOS'
                    , 'CONTENIDO_CORREO' =>
                        $markdown->render('emails.concourse.inscription',['user' => Auth::user()->fullName(),
                            'concourse' => $objResponseMaster->meritconcourseconfig->title,'code'=>$id])
                    , 'CC' => null
                    , 'CCO' => null
                    , 'OBSERVACION' => null]);
                $objEmailQueue->save();

            }
            DB::connection('sqlsrv_modulos')->commit();
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }
    }

    public function forDeleteDocumentDetail(Request $request,MeritInputDetail $meritInputDetail){


        if (Storage::disk('ftp')->exists($this->arrFTP['Default'].$meritInputDetail->path.$meritInputDetail->namefile)) {
            Storage::disk('ftp')->delete($this->arrFTP['Default'].$meritInputDetail->path.$meritInputDetail->namefile);
        }
        $meritInputDetail->status='I';
        $meritInputDetail->deleted_ip=$request->ip();
        $meritInputDetail->deleted_by=Auth::user()->id;
        $meritInputDetail->save();
        return response()->json(['Archivo eliminado correctamente'], 200);
    }

    public function forDeleteFormWithFields(Request $request){
        $this->key = 200;
        $this->value = ["data"=>"Registro eliminado correctamente!", "messaage" => true];

        $rules = array(
            'idDetail' =>  "required|numeric",
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["data" => $validator->messages(), "messaage" => false], 422);
        }

        $objMeritInputDetail=MeritInputDetail::with('meritConcourseConcept.document')->find($request->idDetail);
        if($objMeritInputDetail==null){
            return response()->json(["Registro no encontrado", "messaage" => false], 404);
        }

        $nameTable=$objMeritInputDetail->meritConcourseConcept->document->nametable;
        if($nameTable==null){
            return response()->json(["Nombre de la tabla no encontrada", "messaage" => false], 404);
        }

        $now=Utils::getDateSQL();
        DB::connection('sqlsrv_modulos')->table('Concourse.merit_input_details')
            ->where('id', $request->idDetail)
            ->update(['status'=>'I','deleted_at'=>$now,'deleted_ip'=>$request->ip(),'deleted_by'=>Auth::user()->id]);

        DB::connection('sqlsrv_modulos')->table('Concourse.doc_'.trim($nameTable))
            ->where('merit_input_detail_id', $request->idDetail)
            ->update(['status'=>'I']);


        return response()->json($this->value, $this->key);

    }

    public function forGetFormWithFields(Request $request){
        $this->key = 200;
        $this->value = [];
        $validator = Validator::make($request->all(), ['idConcourseConcept'=>'required|numeric']);
        if ($validator->fails()) {
            return response()->json(["data" => $validator->messages(), "messaage" => false], 422);
        }
        $objMeritConcourseConcept=MeritConcourseConcept::find($request->idConcourseConcept);
        if($objMeritConcourseConcept==null){
            return response()->json(["data" => ['elementos'=>['Concepto no encontrado!!']], "messaage" => false], 422);
        }

        $objMeritConceptDocFields=MeritConceptDocFile::with('documentField')->where('merit_concourse_concept_id','=',$request->idConcourseConcept)->where('status','=','A')->get();
        if(count($objMeritConceptDocFields)==0){
            return response()->json(["data" => ['elementos'=>['No hay campos asignados!!']], "messaage" => false], 422);
        }else{
            $code=uniqid();
            return response()->json(["code"=>$code,"data" =>view('selection.merit.partials.fields')->with(['code'=>$code,'objMeritConceptDocFields'=>$objMeritConceptDocFields,'concourseConcept'=>$objMeritConcourseConcept])->render(), "messaage" => true], 200);
        }


    }

    public function forSaveFormWithFields(Request $request,MeritConcourseConcept $objConcourseConcept,$arrElementData=[]){
        $this->key = 200;
        $this->value = [];

        DB::connection('sqlsrv_modulos')->transaction(function () use ($request,$objConcourseConcept,$arrElementData) {

            $concourse = $request->concourse;
            $userID = Auth::user()->id;
            $ip = $request->ip();
            $dateFULL = Utils::getDateSQL();

            $objMeritTypeDocument=Merittypedocument::findOrFail($request->typeDocument);
            $objResponseMaster = MeritInputMaster::processMasterConcourse($concourse, Auth::user()->id, $request->ip());
            $file=$request->documento;

            $objResponseDetail = MeritInputDetail::find($request->idDetail);
            $flag=false;
            if ($objResponseDetail == null) {
                $objResponseDetail = new MeritInputDetail();
                $objResponseDetail->merit_input_master_id = $objResponseMaster->id;
                $objResponseDetail->merit_concourse_concept_id = $request->conceptConcourse;
                $objResponseDetail->path = 'CONCURSO_MERITOS/' . $concourse . "/";
                $objResponseDetail->created_by = $userID;
                $objResponseDetail->updated_by = $userID;
                $objResponseDetail->created_at = $dateFULL;
                $objResponseDetail->updated_at = $dateFULL;
                $objResponseDetail->created_ip = $ip;
                $objResponseDetail->updated_ip = $ip;
                $objResponseDetail->status = 'A';
                $flag=true;
            } else {
                $objResponseDetail->updated_ip = $ip;
                $objResponseDetail->updated_at = $dateFULL;
                $objResponseDetail->updated_by = $userID;
                $nameFile= $objResponseDetail->namefile;
                $objResponseDetail->status = 'A';
            }

            if($file!=null){
                $objDocument = $objConcourseConcept->document;
                $extension = $file->getClientOriginalExtension();
                $nameFile = $objDocument->prefix . $request->conceptConcourse .'-'. uniqid().'-' . Auth::user()->name . '.' . $extension;
                $objResponseDetail->namefile = $nameFile;

                $fullPath =  $this->arrFTP['Documentos']  . $objResponseMaster->merit_concourse_config_id;
                if (!array_search($fullPath, Storage::disk('ftp')->directories( $this->arrFTP['Documentos'] ))) {
                    Storage::disk('ftp')->makeDirectory($fullPath);
                }

                Storage::disk('ftp')->put("$fullPath/$nameFile", File::get($file));
            }
            $objResponseDetail->save();

            $nameTable=$objMeritTypeDocument->nametable;

            $arrElementData['status'] = 'A';
            $arrElementData['created_by']=Auth::user()->id;
            $arrElementData['updated_by']=Auth::user()->id;
            $arrElementData['updated_at']=$dateFULL;
            $arrElementData['created_at']=$dateFULL;
            if($flag){
                $arrElementData['merit_input_detail_id'] = $objResponseDetail->id;
                DB::connection('sqlsrv_modulos')->table('Concourse.doc_'.trim($nameTable))->insert($arrElementData);
            }else{
                DB::connection('sqlsrv_modulos')->table('Concourse.doc_'.trim($nameTable))
                    ->where('merit_input_detail_id', $objResponseDetail->id)
                    ->update($arrElementData);
            }

            $this->key = 200;
            $this->value = ["content" => "DATA GUARDADA CORRECTAMENTE",
                "linkdoc" =>
                    route('document.concourse',[$concourse,$nameFile]),
                "id" => $objResponseDetail->id];
        });
        return response()->json($this->value, $this->key);
    }

    public function forSaveForm(Request $request)
    {
        $this->key = 200;
        $this->value = [];

        $arrayUpload = [];
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {

            $input = $request->except('_token');
            $concourse = $input['concourse'];
            $userID = Auth::user()->id;
            $ip = $request->ip();
            $dateFULL = Utils::getDateSQL();
            if (!array_key_exists('file', $input)) {
                throw new \Exception ("DEBES SELECCIONAR UN ARCHIVO ANTES DE PRESIONAR EL BOTON SUBIR");
            } else {
                $objResponseMaster = MeritInputMaster::processMasterConcourse($concourse, Auth::user()->id, $request->ip());
               $arrayKey= MeritConcourseConcept::whereIn('id',array_keys($request->file))->where('many','=','1')->pluck('id')->toArray();
                foreach ($request->file as $key => $files) {
                    if(in_array($key, $arrayKey)){
                        if(is_array($files)){
                            foreach ($files as $item) {
                                $arrayUpload[]=$this->saveFormComplement($item,$objResponseMaster,$key,$concourse,$userID,$ip,false);
                            }
                        }else{
                            throw new \Exception ("LOS ARCHIVOS HA SUBIR TUVIERON ERRORES Ó EXISTI&Oacute; UNA MODIFICACI&Oacute;N POR PARTE DEL USUARIO");
                        }
                    }else{
                        if(is_array($files)){
                            throw new \Exception ("SOLO SE ADMITE UN ARCHIVO A LA VEZ");
                        }else{
                            $arrayUpload[]=$this->saveFormComplement($files,$objResponseMaster,$key,$concourse,$userID,$ip,true);
                        }
                    }
                }
            }

            DB::connection('sqlsrv_modulos')->commit();
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }

        return response()->json(["content" => "DATA GUARDADA CORRECTAMENTE",
            "files" => $arrayUpload], 200);
    }

    private function saveFormComplement(UploadedFile $item,MeritInputMaster $objResponseMaster, $key,$concourse,$userID,$ip,$flag){
        if ($item->getError() != 0) {
            throw new \Exception ("EXISTEN DOCUMENTOS CON ERRORES INTENTE CON OTROS ARCHIVOS");
        } else {
            if ($item->getMimeType() == "application/pdf" || $item->getMimeType() == "application/octet-stream") {
                if($flag){
                    $objResponseDetail =
                        MeritInputDetail::where('merit_input_master_id', '=', $objResponseMaster->id)
                            ->where('merit_concourse_concept_id', '=', $key)->where('status','=','A')->first();
                    if ($objResponseDetail == null) {
                        $objResponseDetail = new MeritInputDetail();
                        $objResponseDetail->merit_input_master_id = $objResponseMaster->id;
                        $objResponseDetail->merit_concourse_concept_id = $key;
                        $objResponseDetail->path = 'CONCURSO_MERITOS/' . $concourse . "/";
                        $objResponseDetail->created_by = $userID;
                        $objResponseDetail->updated_by = $userID;
                        $objResponseDetail->created_ip = $ip;
                        $objResponseDetail->updated_ip = $ip;
                        $objResponseDetail->status = 'A';
                    } else {
                        $objResponseDetail->updated_ip = $ip;
                        $objResponseDetail->status = 'A';
                    }
                }else{
                    $objResponseDetail = new MeritInputDetail();
                    $objResponseDetail->merit_input_master_id = $objResponseMaster->id;
                    $objResponseDetail->merit_concourse_concept_id = $key;
                    $objResponseDetail->path = 'CONCURSO_MERITOS/' . $concourse . "/";
                    $objResponseDetail->created_by = $userID;
                    $objResponseDetail->updated_by = $userID;
                    $objResponseDetail->created_ip = $ip;
                    $objResponseDetail->updated_ip = $ip;
                    $objResponseDetail->status = 'A';
                }



                $objMeritConcourseConcept = MeritConcourseConcept::findOrFail($key);
                $objDocument = $objMeritConcourseConcept->document;

                $extension = $item->getClientOriginalExtension();
                if($flag){
                    $nameFile = $objDocument->prefix . $key . '-' . Auth::user()->name. '.' . $extension;
                }else{
                    $nameFile = $objDocument->prefix . $key . '-' . Auth::user()->name.Utils::uniqidReal() . '.' . $extension;
                }


                $objResponseDetail->namefile = $nameFile;

                $fullPath = $this->arrFTP['Documentos'] . $objResponseMaster->merit_concourse_config_id;
                if (!array_search($fullPath, Storage::disk('ftp')->directories($this->arrFTP['Documentos']))) {
                    Storage::disk('ftp')->makeDirectory($fullPath);
                }


                if($flag){
                    if (Storage::disk('ftp')->exists("$fullPath/$nameFile")) {
                        Storage::disk('ftp')->delete("$fullPath/$nameFile");
                    }

                }

                Storage::disk('ftp')->put("$fullPath/$nameFile", File::get($item));
                $objResponseDetail->save();
                return["linkdoc" => route('document.concourse', [$concourse, $nameFile]),
                    "deletedoc"=>route('process.document.deleteDetail',$objResponseDetail->id),
                    "code" => "td_" . $key,"id"=>$objResponseDetail->id,
                    "flag"=>$flag];
            } else {
                throw new \Exception ("NO SE PUEDE SUBIR UN ARCHIVO PDF CON PROBLEMAS");
            }
        }
    }

    public function forSaveMatrizAssigment($merit_concourse_matriz_id,$concourse,$user_id,$ip,$type){
      //  DB::connection('sqlsrv_modulos')->beginTransaction();
     //   try{
            $objResponseMaster = MeritInputMaster::processMasterConcourse($concourse, $user_id, $ip);
            $objResponseMaster->merit_concourse_matriz_id=$merit_concourse_matriz_id;
            $objResponseMaster->type_postulation=$type;
            $objResponseMaster->save();
            DB::connection('sqlsrv_modulos')->commit();
        return $objResponseMaster;
      //  } catch (\Exception $e) {
      //      DB::connection('sqlsrv_modulos')->rollback();
     //       throw $e;
      //  }



    }


    public function getParameterMeritConcourseConcept($concourse, $document, $category, $subcategory)
    {
        return MeritConcourseConcept::where('merittypedocument_id', '=', $document)
            ->where('merit_concourse_config_id', '=', $concourse)
            ->where('meritcategory_id', '=', $category)
            ->where('meritsubcategory_id', '=', $subcategory)
            ->first();
    }

    public function getPersonalInformation($cedula)
    {
        return MeritPersonalInformation::where('cedula', '=', $cedula)
            ->where('estado', '=', 'A')
            ->first();
    }

    public function getEstadoCivil()
    {
        $estado_civil = DB::connection('sqlsrv_modulos')
            ->table('Concourse.merit_estado_civil AS A')
            ->where('A.estado', '=', 'A')
            ->select('A.id', 'A.descripcion')
            ->pluck('descripcion', 'id')->toArray();
        return $estado_civil;
    }

    public function getSelectProvinciaNacional($idpais)
    {
        $paises = DB::connection('sqlsrv_modulos')
            ->table('Concourse.merit_provincia AS A')
            ->where('A.IDPAIS', '=', $idpais)
            ->select('A.IDPROVINCIA', 'A.NOMBRE')
            ->pluck('NOMBRE', 'IDPROVINCIA')->toArray();
        return $paises;
    }

    public function getSelectCantonNacional($idpais, $idprovincia)
    {
        $canton = DB::connection('sqlsrv_modulos')
            ->table('Concourse.merit_canton AS A')
            ->where('A.IDPAIS', '=', $idpais)
            ->where('A.IDPROVINCIA', '=', $idprovincia)
            ->select('A.IDCANTON', 'A.NOMBRE')
            ->pluck('NOMBRE', 'IDCANTON')->toArray();
        return $canton;
    }

    public function savePersonalInformation(Request $request)
    {
        $salida = 2;
        //$save_persona = MeritPersonalInformation::find($request->cedula);
        $save_persona=$this->getPersonalInformation($request->cedula);
        if (is_null($save_persona)) {
            /*Guardar*/
            $salida = 1;
            $save_persona = new MeritPersonalInformation();
            $save_persona->fechaIngreso = Utils::getDateSQL();
        }
        $save_persona->nombres = $request->first_name;
        $save_persona->apellidos = $request->last_name;
        $save_persona->cedula = $request->cedula;
        $save_persona->fecha_nacimiento = $request->fechaNacimiento;
        $save_persona->nacionalidad = $request->nacionalidad;
        $save_persona->idEstadoCivil = $request->estadoCivil;
        $save_persona->email = $request->email;
        $save_persona->idSexo = $request->idSexo;
        $save_persona->celular = $request->celular;
        $save_persona->idProvDir = $request->idProvDir;
        $save_persona->idCiudadDir = $request->idCiudadDir;
        $save_persona->direccionDir = $request->direccionDir;
        $save_persona->telefonoDir = $request->telefonoDir;
        $save_persona->idProvLab = $request->idProvLab;
        $save_persona->idCiudadLab = $request->idCiudadLab;
        $save_persona->direccionLab = $request->direccionLab;
        $save_persona->telefonoLab = $request->telefonoLab;
        $save_persona->fechaActualiza = Utils::getDateSQL();
        $save_persona->estado = 'A';
        /*Foto*/
        $objFile = $request->file('documentoFoto');
        $ARCHIVO_FOTO='';
        if ($objFile != null) {
            $extension = $objFile->getClientOriginalExtension();
            try {
                $ARCHIVO_FOTO = 'IMG-' . $request->cedula . date('Ymdhis') . '.' . $extension;
                Storage::disk('ftp')->put($this->arrFTP['Foto'] . $ARCHIVO_FOTO, File::get($objFile));
            } catch (\Exception $ex) {
                return ["content" => ["SMG" => ["Problemas con el servidor de archivos no se puede guardar el registro documentoFoto ".$ex->getMessage()]], "success" => false];
            }
        }
        /*Fin Foto*/

        $save_persona->archivo_foto = $ARCHIVO_FOTO;
        //$objFile = $request->file('documentoFoto');

        $save_persona->save();

        return $salida;
    }


    public function forMeritMasterValidatorEvaluation($scope = '',$objMeritConcourseStep)
    {

        $stepDetail=$objMeritConcourseStep->step->description;
        return MeritInputValidate::from('Concourse.merit_input_evaluations as m')
            ->join(env('DB_PREFIJO') . 'ugcore.dbo.users as u', 'u.id', '=', 'm.user_id')
            ->join(env('DB_PREFIJO') . 'ugcore.dbo.users as us', 'us.id', '=', 'm.user_validation')
            ->where('m.status_validation', '=', 'R')
            ->where('m.percentage_validation', '>=', '10')
            ->where('m.merit_concourse_config_step_id','=',$objMeritConcourseStep->id)
            ->where(function ($where) use ($scope) {
                $where->where('u.name', 'like', "%$scope%")
                    ->orWhere('u.last_name', 'like', "%$scope%")
                    ->orWhere('u.first_name', 'like', "%$scope%");
            })
            ->select('u.id', 'u.name as nuic',
                DB::raw("u.last_name+' '+ u.first_name as names"),
                DB::raw("us.last_name+' '+ us.first_name as names_validation"),


                'u.email', 'm.date_validation',
                'm.percentage_validation',DB::raw("'$stepDetail' as stepDetail"))
            ->orderBy('u.last_name', 'ASC')->paginate(1);


    }

}

