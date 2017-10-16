<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 24/10/16
 * Time: 12:04 PM
 */

namespace UGCore\Core\Repositories\Surveys;


use Illuminate\Http\Request;
use UGCore\Core\Entities\Surveys\CategoryQuestion;
use UGCore\Core\Entities\Surveys\CategorySurvey;
use UGCore\Core\Entities\Surveys\DetailResponseSurvey;
use UGCore\Core\Entities\Surveys\HeadResponseSurvey;
use UGCore\Core\Entities\Surveys\Question;
use UGCore\Core\Entities\Surveys\QuestionOption;
use UGCore\Core\Entities\Surveys\Survey;
use UGCore\Core\Entities\Surveys\SurveyQuestion;
use UGCore\Core\Entities\Surveys\TypeQuestion;
use UGCore\Http\Requests\Surveys\CategoriesQuestionsRequest;
use UGCore\Http\Requests\Surveys\CategoriesSurveysRequest;
use DB;
use Auth;
use UGCore\Http\Requests\Surveys\QuestionsRequest;
use UGCore\Http\Requests\Surveys\SurveyRequest;
use UGCore\Http\Requests\Surveys\TypeQuestionsRequest;
use Storage;
use File;
use Utils;

class SurveysRepository
{

    private $arrFTP = ['FOTO'=>'MODULOS/BANCO_PREGUNTAS/'];


    public function forGetCategorySurveys()
    {
        return CategorySurvey::orderBy('id', 'ASC')->where('status', 'A')->pluck('name', 'id')->toArray();
    }

    public function forGetSurveys()
    {
        return Survey::orderBy('id', 'ASC')->where('status', 'A')->pluck('name', 'id')->toArray();
    }

    public function forDataTable()
    {
        return \Datatables::of(CategorySurvey::orderBy('name', 'ASC')->get())
            ->add_column('actions', ' <a href="{{ route(\'surveys.categories_surveys.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>')
            ->make(true);
    }

    public function forSaveCategoriesSurvey(CategoriesSurveysRequest $request)
    {
            $object = new CategorySurvey();
            $object->name = $request->name;
            $object->status = $request->status;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip =$request->ip();
            $object->created_by = Auth::user()->id;
            $object->created_ip = $request->ip();
            $object->save();
    }

    public function forGetCategoriesSurvey($id)
    {
        $objCategorySurvey = CategorySurvey::find($id);
        if (!$objCategorySurvey) {
            abort(404);
        }
        return $objCategorySurvey;
    }

    public function forUpdateCategoriesSurvey(CategoriesSurveysRequest $request, $id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id) {
            $object = $this->forGetCategoriesSurvey($id);
            $object->name = $request->name;
            $object->status = $request->status;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->save();
        });
    }


    /*CATEGORIAS PREGUNTAS*/

    public function forGetCategoryQuestions()
    {
        return CategoryQuestion::orderBy('id', 'ASC')->where('status', 'A')->pluck('name', 'id')->toArray();
    }

    public function forDataCategoriesQuestionsSurvey()
    {
        return \Datatables::of(CategoryQuestion::orderBy('name', 'ASC')->get())
            ->add_column('actions', ' <a href="{{ route(\'surveys.categories_questions.edit\', $id) }}" ><span class="fa fa-pencil"></span>&nbsp;Editar</a>')
            ->make(true);
    }

    public function forSaveCategoriesQuestionsSurvey(CategoriesQuestionsRequest $request)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request) {
            $object = new CategoryQuestion();
            $object->name = $request->name;
            $object->status = $request->status;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->created_by = Auth::user()->id;
            $object->created_ip = $request->ip();
            $object->save();
        });
    }

    public function forGetCategoryQuestionSurvey($id)
    {
        $object = CategoryQuestion::find($id);
        if (!$object) {
            abort(404);
        }
        return $object;
    }


    public function forUpdateCategoriesQuestionsSurvey(CategoriesQuestionsRequest $request, $id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id) {
            $object = $this->forGetCategoryQuestionSurvey($id);
            $object->name = $request->name;
            $object->status = $request->status;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->save();
        });
    }


    /*TYPES PREGUNTAS*/

    public function forGetTypeQuestions()
    {

        return TypeQuestion::orderBy('id', 'ASC')->where('status', 'A')->pluck('name', 'id')->toArray();
    }


    public function forDataTypeQuestionSurvey()
    {
        return \Datatables::of(TypeQuestion::orderBy('name', 'ASC')->get())
            ->add_column('actions', ' <a href="{{ route(\'surveys.types_questions.edit\', $id) }}"><span class="fa fa-pencil"></span>&nbsp;Editar</a>')
            ->make(true);
    }


    public function forSaveTypeQuestionSurvey(TypeQuestionsRequest $request)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request) {
            $object = new TypeQuestion();
            $object->name = $request->name;
            $object->status = $request->status;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->created_by = Auth::user()->id;
            $object->created_ip = $request->ip();
            $object->save();
        });
    }

    public function forGetTypeQuestionSurvey($id)
    {
        $object = TypeQuestion::find($id);
        if (!$object) {
            abort(404);
        }
        return $object;
    }

    public function forUpdateTypeQuestionSurvey(TypeQuestionsRequest $request, $id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id) {
            $object = $this->forGetTypeQuestionSurvey($id);
            $object->name = $request->name;
            $object->status = $request->status;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->save();
        });
    }


    /*BANCO PREGUNTAS*/


    public function forDataQuestionSurvey()
    {
        return \Datatables::of(Question::join('Surveys.types_questions', 'Surveys.types_questions.id', '=', 'Surveys.questions.type_question_id')
            ->select('Surveys.questions.id', 'Surveys.questions.name', 'Surveys.types_questions.name AS type',
                DB::connection('sqlsrv_modulos')->raw(" CASE Surveys.questions.status WHEN 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS status"))
            ->orderBy('Surveys.questions.created_at', 'ASC')
            ->get())
            ->add_column('actions', ' <a href="{{ route(\'surveys.questions.edit\', $id) }}" ><span class="fa fa-pencil"></span>&nbsp;</a>&nbsp;&nbsp; <a href="{{ route(\'surveys.questions.show\', $id) }}" ><span class="fa fa-eye text-danger"></span>&nbsp;</a>')
            ->make(true);
    }

    public function forSaveQuestionSurvey(QuestionsRequest $request)
    {

        DB::connection('sqlsrv_modulos')->transaction(function () use ($request) {
            $objResponses = $request->response;
            $object = new Question();
            $object->name = strtoupper($request->description);
            $object->status = 'A';
            $object->category_question_id = $request->category_question;
            $object->type_question_id = $request->type_response;
            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->created_by = Auth::user()->id;
            $object->created_ip = $request->ip();

            if ($object->type_question_id != env('RESPONSE_SIMPLE') && $object->type_question_id != env('RESPONSE_MULTIPLE')) {
                $object->max_response=$request->max_response;
            }
            $object->save();
            $questionId = $object->id;

            $file = $request->file;
            if ($file != null) {
                $extension = $file->getClientOriginalExtension();
                $nameFile = $object->id . '.' . $extension;
                $fullPath = $this->arrFTP['FOTO'];

                if (Storage::disk('ftp')->exists("$fullPath/$nameFile")) {
                    Storage::disk('ftp')->delete("$fullPath/$nameFile");
                }
                Storage::disk('ftp')->put("$fullPath/$nameFile", File::get($file));

                $objectQuestion = Question::find($object->id);
                $objectQuestion->path_image = $nameFile;
                $objectQuestion->save();

            }

            /* SAVE OPCIONES DE RESPUESTA */

            if ($object->type_question_id == env('RESPONSE_SIMPLE') || $object->type_question_id == env('RESPONSE_MULTIPLE')) {

            $arrayResponse = [];
            foreach ($objResponses as $response) {
                $arrayResponse[] = ['name' => strtoupper($response), 'value' => strtoupper($response), 'status' => 'A', 'question_id' => $questionId, 'updated_by' => Auth::user()->id,
                    'updated_ip' => $request->ip(),
                    'created_by' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'created_at' => Utils::getDateSQL(),
                    'updated_at' => Utils::getDateSQL()];
            }

            QuestionOption::insert($arrayResponse);
        }
        });
    }

    public function forGetQuestionSurvey($id)
    {
        $object = Question::find($id);
        if (!$object) {
            abort(404);
        }
        return $object;
    }

    public function forUpdateQuestionSurvey(QuestionsRequest $request, $id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id) {
            $objResponses = $request->response == null ? [] : $request->response;
            $objResponsesExists = $request->responseExists == null ? [] : $request->responseExists;
            $object = $this->forGetQuestionSurvey($id);
            $object->name = strtoupper($request->description);
            $object->status = $request->status;
            $object->category_question_id = $request->category_question;
            $object->type_question_id = $request->type_response;
            if ($object->type_question_id != env('RESPONSE_SIMPLE') && $object->type_question_id != env('RESPONSE_MULTIPLE')) {
                $object->max_response=$request->max_response;
            }
            if ($request->status == 'A') {
                $object->updated_by = Auth::user()->id;
                $object->updated_ip = $request->ip();
                $object->deleted_by = null;
                $object->deleted_ip = null;
                $object->deleted_at = null;
            } else {
                $object->deleted_by = Auth::user()->id;
                $object->deleted_ip = $request->ip();
                $object->deleted_at = Utils::getDateSQL();
            }

            $file = $request->file;
            if ($file != null) {
                $extension = $file->getClientOriginalExtension();
                $nameFile = $object->id . '.' . $extension;
                $fullPath = $this->arrFTP['FOTO'];
                if (Storage::disk('ftp')->exists("$fullPath/$object->path_image")) {
                    Storage::disk('ftp')->delete("$fullPath/$object->path_image");
                }
                Storage::disk('ftp')->put("$fullPath/$nameFile", File::get($file));
                $object->path_image = $nameFile;
            }
            $object->save();

            /* SAVE OPCIONES DE RESPUESTA */
            $arrayNotInactive = [];
            foreach ($objResponsesExists as $key => $response) {
                $arrayNotInactive[] = $key;
                QuestionOption::where('id', $key)->update(
                    ['updated_ip' => $request->ip(), 'updated_at' => Utils::getDateSQL(),
                        'updated_by' => Auth::user()->id,
                        'name' => strtoupper($response), 'value' => strtoupper($response), 'status' => 'A'
                    ]
                );
            }

            if (count($arrayNotInactive) > 0) {
                QuestionOption::whereNotIn('id', $arrayNotInactive)->where('question_id', $id)->update(
                    ['deleted_ip' => $request->ip(),
                        'deleted_at' => Utils::getDateSQL(),
                        'deleted_by' => Auth::user()->id,
                        'status' => 'I'
                    ]);
            } else {
                QuestionOption::where('question_id', $id)->update(
                    ['deleted_ip' => $request->ip(),
                        'deleted_at' => Utils::getDateSQL(),
                        'deleted_by' => Auth::user()->id,
                        'status' => 'I'
                    ]);
            }


            if ($object->type_question_id == env('RESPONSE_SIMPLE') || $object->type_question_id == env('RESPONSE_MULTIPLE')) {
                $arrayResponse = [];
                foreach ($objResponses as $response) {
                    $arrayResponse[] = ['name' => strtoupper($response), 'value' => strtoupper($response), 'status' => 'A', 'question_id' => $id, 'updated_by' => Auth::user()->id,
                        'updated_ip' => $request->ip(),
                        'created_by' => Auth::user()->id,
                        'created_ip' => $request->ip(),
                        'created_at' => Utils::getDateSQL(),
                        'updated_at' => Utils::getDateSQL()];
                }

                QuestionOption::insert($arrayResponse);
            }else{
                QuestionOption::where('question_id', $id)->update(
                    ['deleted_ip' => $request->ip(),
                        'deleted_at' => Utils::getDateSQL(),
                        'deleted_by' => Auth::user()->id,
                        'status' => 'I'
                    ]);
            }
        });
    }


    /*GUARDAR ENCUESTAS */

    public function forUpdateSurvey(SurveyRequest $request, $id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id) {

            $object = $this->forGetSurvey($id);
            $object->name = strtoupper($request->name);
            $object->description = strtoupper($request->description);
            $object->status = $request->status;;
            $object->time = $request->duration;
            $object->category_survey_id = $request->category_survey;

            $date = explode("/", $request->date_range);

            $object->date_start = $date[0];
            $object->date_end = $date[1];


            if ($request->status == 'A') {
                $object->updated_by = Auth::user()->id;
                $object->updated_ip = $request->ip();
                $object->deleted_by = null;
                $object->deleted_ip = null;
                $object->deleted_at = null;
            } else {
                $object->deleted_by = Auth::user()->id;
                $object->deleted_ip = $request->ip();
                $object->deleted_at = Utils::getDateSQL();
            }

            $object->save();
        });
    }


    public function forSaveSurvey(SurveyRequest $request)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request) {

            $object = new Survey();
            $object->name = strtoupper($request->name);
            $object->description = strtoupper($request->description);
            $object->status = 'A';
            $object->time = $request->duration;
            $object->category_survey_id = $request->category_survey;

            $object->updated_by = Auth::user()->id;
            $object->updated_ip = $request->ip();
            $object->created_by = Auth::user()->id;
            $object->created_ip = $request->ip();

            $date = explode("/", $request->date_range);

            $object->date_start = $date[0];
            $object->date_end = $date[1];

            $object->save();
        });
    }

    public function forDataSurvey()
    {
        return \Datatables::of(Survey::join('Surveys.categories_surveys', 'Surveys.categories_surveys.id', '=', 'Surveys.surveys.category_survey_id')
            ->select('Surveys.surveys.id', 'Surveys.surveys.name', 'Surveys.categories_surveys.name AS type'
                ,
                DB::connection('sqlsrv_modulos')->raw(" CASE Surveys.surveys.status WHEN 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS status"))
            ->orderBy('Surveys.surveys.created_at', 'ASC')
            ->get())
            ->add_column('actions', ' <a href="{{ route(\'surveys.admin_surveys.edit\', $id) }}" ><span class="fa fa-pencil"></span>&nbsp;Editar</a>&nbsp;&nbsp;&nbsp;<a href="{{ route(\'surveys.admin_surveys.show\', $id) }}" ><span class="fa fa-eye"></span>&nbsp;Ver</a>&nbsp;&nbsp;&nbsp;<a href="{{ route(\'surveys.admin_surveys.questions\', $id) }}" ><span class="fa fa-list-ol"></span>&nbsp;Preguntas</a>')
            ->add_column('total', '{{ Utils::getQuestionsSurveys($id) }}')
            ->make(true);
    }

    public function forGetSurvey($id)
    {
        $object = Survey::find($id);
        if (!$object) {
            abort(404);
        }
        return $object;
    }


    public function forDataQuestionDTSurvey($survey_id)
    {
        return \Datatables::of(Question::
        join('Surveys.types_questions AS Q', 'Q.id', '=', 'Surveys.questions.type_question_id')
            ->leftJoin('Surveys.surveys_questions as SQ',function($join) use ($survey_id){
                $join->on('SQ.question_id','=','Surveys.questions.id')
                        ->where('SQ.survey_id','=',$survey_id)
                        ->where('SQ.status','=','A');
            })
            ->where('Surveys.questions.status', '=', 'A')
            ->select('Surveys.questions.id', 'Surveys.questions.name', 'Q.name AS type','Surveys.questions.max_response',
                    DB::connection('sqlsrv_modulos')->raw("(case   when SQ.id is null then '0' else '1' end )as checked"))
            ->orderBy('Q.name', 'ASC')
            ->get())
            ->add_column('actions', '<div class="checkbox checkbox-primary" style="text-align: center;margin-top: 2px;margin-bottom: 2px;">
                                                          <input @if($checked=="1") checked="checked" @endif id="question_{{$id}}" class="styled"  onclick="assigmentQuestion(this)"   name="question[]" value="{{$id}}" type="checkbox"/>
                                                         <label for="question_{{$id}}"> &nbsp; </label>
                                                </div>')
            ->make(true);
    }

    public function forSaveAssigmentQuestionSurvey(\Illuminate\Http\Request $request){
        switch($request->action){
            case 'I':
                $object=SurveyQuestion::where('question_id',$request->question)->where('survey_id',$request->survey)->first();

                if(!$object){
                    return response()->json(["Objecto no encontrado",404]);
                }else{
                    $object->status='I';
                    $object->updated_by=\Auth::user()->id;
                    $object->updated_ip=$request->ip();
                    $object->save();
                }
                return response()->json(["Pregunta inactivada correctamente",200]);
                break;

            case 'A':
                $object=SurveyQuestion::where('question_id',$request->question)->where('survey_id',$request->survey)->first();

                if(!$object){
                    $object= new SurveyQuestion();
                    $object->question_id=$request->question;
                    $object->survey_id=$request->survey;
                    $object->status='A';
                    $object->created_by=\Auth::user()->id;
                    $object->updated_by=\Auth::user()->id;
                    $object->created_ip=$request->ip();
                    $object->updated_ip=$request->ip();
                    $object->save();

                }else{
                    $object->status='A';
                    $object->updated_by=\Auth::user()->id;
                    $object->updated_ip=$request->ip();
                    $object->save();
                }
                return response()->json(["Pregunta Agregada correctamente",200]);
                break;

            default:
                return response()->json(["La petici&oacute;n solicitada no existe",404]);
                break;
        }



    }

    public function forGetSurveyQuestionID($id)
    {
        $object = SurveyQuestion::find($id);
        return $object;
    }



    public function forGetHeadResponseSurvey($id,$survey){
        $object=HeadResponseSurvey::where('user_id','=',$id)->where('survey_id','=',$survey)->first();
        return $object;
    }

    public function forGetHeadResponseSurveyByUser($id){
        return HeadResponseSurvey::with('survey.categorysurvey')->where('user_id','=',$id)->paginate(15);
    }

    public function forGetHeadResponseSurveyPaginate($id,$surveySlug){
        return HeadResponseSurvey::with('survey.categorysurvey')->where('user_id','=',$id)->where('survey_id','=',(Survey::findBySlugOrFail($surveySlug))->id)->paginate(15);
    }

    public function forGetSurveysGlobal($id)
    {
        return Survey::with('categorysurvey')->orderBy('id', 'ASC')->where('status', 'A')->whereNotIn('id',HeadResponseSurvey::where('user_id',$id)->pluck('survey_id')->toArray())->paginate();
    }


    public function forGetSurveySlug($surveySlug,$id){
        return Survey::with('categorysurvey')->orderBy('id', 'ASC')->where('status', 'A')
            ->whereNotIn('id',HeadResponseSurvey::where('user_id',$id)->pluck('survey_id')->toArray())
            ->where('id','=',(Survey::findBySlugOrFail($surveySlug))->id)->paginate(15);
    }


    public function forReportSurveyData($surveyId){

        $dataHeadResponse=HeadResponseSurvey::where('survey_id','=',$surveyId)
            ->where('status','=','A')
            ->where('status_response','=','F')->select('id')->lists('id')->toArray();

        $dataBodyResponse=[];
        if(count($dataHeadResponse)>0){
            $data=DetailResponseSurvey::from('Surveys.detail_response_surveys as drs')
                ->join('Surveys.surveys_questions as sq', 'drs.surveys_question_id','=','sq.id')
                ->join('Surveys.questions as q', 'q.id','=','sq.question_id')
                ->join('Surveys.categories_questions as cq', 'cq.id','=','q.category_question_id')
                ->join('Surveys.types_questions as tq','tq.id','=','q.type_question_id')
                ->leftJoin('Surveys.questions_options as qo', 'qo.id','=','drs.response')
                ->where('drs.type_response','=','C')
                ->where('drs.status','=','A')
                ->whereIn('drs.head_response_survey_id',$dataHeadResponse)
                ->groupBy('tq.name','drs.surveys_question_id','q.name','cq.name','drs.response','qo.name')
                ->select('tq.name as type','drs.surveys_question_id','q.name AS question','cq.name AS category','drs.response','qo.name',DB::connection('sqlsrv_modulos')->raw('COUNT(drs.id) as numbers'))
                ->orderBy('drs.surveys_question_id', 'asc')->get();
            foreach ($data as $objDetailResponseSurvey){
                $dataBodyResponse[$objDetailResponseSurvey->surveys_question_id]['question']=$objDetailResponseSurvey->question;
                $dataBodyResponse[$objDetailResponseSurvey->surveys_question_id]['type']=$objDetailResponseSurvey->type;
                $dataBodyResponse[$objDetailResponseSurvey->surveys_question_id]['category']=$objDetailResponseSurvey->category;
                $dataBodyResponse[$objDetailResponseSurvey->surveys_question_id]['options'][]= $objDetailResponseSurvey->name==null?'TIEMPO EXCEDIDO':$objDetailResponseSurvey->name;
                $dataBodyResponse[$objDetailResponseSurvey->surveys_question_id]['cantidad'][]= [$objDetailResponseSurvey->name==null?'TIEMPO EXCEDIDO':$objDetailResponseSurvey->name,floatval($objDetailResponseSurvey->numbers)];

            }
            return ['responses'=>count($dataHeadResponse),'data'=> $dataBodyResponse];
        }else{
         return null;
        }


    }
}
