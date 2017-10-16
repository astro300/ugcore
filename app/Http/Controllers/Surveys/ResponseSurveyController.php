<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 31/10/16
 * Time: 02:50 PM
 */

namespace UGCore\Http\Controllers\Surveys;


use Illuminate\Http\Request;
use UGCore\Core\Entities\Surveys\DetailResponseSurvey;
use UGCore\Core\Entities\Surveys\HeadResponseSurvey;
use UGCore\Core\Entities\Surveys\Survey;
use UGCore\Core\Entities\Surveys\SurveyQuestion;
use UGCore\Core\Repositories\Surveys\SurveysRepository;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;

use Session;
use Utils;
use Validator;
use Auth;
use DB;

class ResponseSurveyController extends Controller
{

    protected $objRPY;
    protected $path = "surveys.responses";




    public function __construct(SurveysRepository $objRPY)
    {
        $this->objRPY = $objRPY;
    }


    public function index(Request $request){
        $objUser=Auth::user();
        if($request->survey_name!=null){
            $surveys = $this->objRPY->forGetSurveySlug($request->survey_name,$objUser->id);
            $dataHeadResponseSurveys = $this->objRPY->forGetHeadResponseSurveyPaginate($objUser->id,$request->survey_name);
        }else{
            $surveys = $this->objRPY->forGetSurveysGlobal($objUser->id);
            $dataHeadResponseSurveys = $this->objRPY->forGetHeadResponseSurveyByUser($objUser->id);
        }

        return view($this->path . '.index',compact('surveys','dataHeadResponseSurveys'));
    }
    public function indexSurvey(Request $request,$survey)
    {
        $survey=Survey::findBySlugOrFail($survey);
        $survey->load(('surveyquestions.question'));
        $objUser=Auth::user();
        $objHeadResponseSurvey = $this->objRPY->forGetHeadResponseSurvey($objUser->id, $survey->id);
        if ($objHeadResponseSurvey == null) {
            $objHeadResponseSurvey=new HeadResponseSurvey();
            $objHeadResponseSurvey->user_id=$objUser->id;
            $objHeadResponseSurvey->survey_id=$survey->id;
            $objHeadResponseSurvey->date_response_initial= Utils::getDateSQL();
            $objHeadResponseSurvey->status_response= 'C';
            $objHeadResponseSurvey->status= 'A';
            $objHeadResponseSurvey->created_by= $objUser->id;
            $objHeadResponseSurvey->updated_by= $objUser->id;
            $objHeadResponseSurvey->created_ip= $request->ip();
            $objHeadResponseSurvey->updated_ip= $request->ip();
            $objHeadResponseSurvey->save();
        } elseif ($objHeadResponseSurvey->survey->status != 'A') {
            return redirect()->route('home')->withErrors("La encuesta, $survey->name no se encuentra activa!!");
        } elseif ($objHeadResponseSurvey->status_response == 'F') {
            return redirect()->route('home')->withErrors("La encuesta, $survey->name ya fue culminada el " . Utils::getFormatDateDB($objHeadResponseSurvey->date_response_last, false, false));
        }


        $detailSurveyQuestionResponse = $objHeadResponseSurvey->questionResponseSurveys(['A']);
        return view($this->path . '.survey')->with(['response'=>$detailSurveyQuestionResponse,'object' => $survey,'surveyquestions'=>$survey->surveyquestions()->paginate(4), 'objectSessionSurvey' => null, 'objHeadResponseSurvey' => $objHeadResponseSurvey]);
    }
public function responseSurveyQuestion(Request $request, SurveyQuestion $surveyQuestion){
       $this->validate($request,[
           'id' => 'required|numeric',
           'response' => 'required|json'
       ]);
    $response = json_decode($request->response);
    $datetime = Utils::getDateSQL();
    $userId= Auth::user()->id;
    $objHeadSurveyResponse = HeadResponseSurvey::where('user_id', '=', $userId)->where('survey_id', '=', $surveyQuestion->survey->id)->firstOrFail();


    if($objHeadSurveyResponse->status_response!='F'){
        $arrayDetailQuestionSurvey = [];
        $typeResponse = 'C';
        $typeResponseID = $surveyQuestion->question->type_question_id;
        if (count($response) == 0) {
            return response()->json("Debes seleccionar una respuesta", 500);
        }
        foreach ($response as $key => $value) {
            if (trim($value) == '') {
                return response()->json("Debes seleccionar una respuesta", 500);
            }
        }
        if ($typeResponseID == env('RESPONSE_SHORT') || $typeResponseID == env('RESPONSE_LARGE')) {
            $typeResponse = 'T';
        };
        if ($typeResponseID == env('RESPONSE_MULTIPLE')|| $typeResponseID ==  env('RESPONSE_SIMPLE')) {
            $typeResponse = 'C';
        };
        foreach ($response as $key => $value) {
            $arrayDetailQuestionSurvey[] = ['head_response_survey_id' => $objHeadSurveyResponse->id, 'surveys_question_id' => $surveyQuestion->id, 'response' => $value,
                'status' => 'A', 'created_by' => $userId, 'updated_by' => $userId, 'created_ip' => $request->ip(), 'updated_ip' => $request->ip(), 'created_at' => $datetime,
                'updated_at' => $datetime, 'type_response' => $typeResponse];
        }

        DB::connection('sqlsrv_modulos')->beginTransaction();
        try{


            DetailResponseSurvey::where('head_response_survey_id', '=', $objHeadSurveyResponse->id)
                ->where('surveys_question_id', '=', $surveyQuestion->id)->update(['status' => 'E']);

            DetailResponseSurvey::insert($arrayDetailQuestionSurvey);
            $objHeadSurveyResponse->date_response_last=$datetime;
            $objHeadSurveyResponse->save();
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }

        DB::connection('sqlsrv_modulos')->commit();


        return response()->json("Respuesta grabada correctamente.!!", 200);

    }else{
        return response()->json(["La encuesta se encuentra finalizada no puedes guardar dicha pregunta"], 500);
    }


}
}