<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 20/12/16
 * Time: 10:04
 */

namespace UGCore\Http\Controllers\Surveys;

use UGCore\Core\Entities\Surveys\Survey;
use UGCore\Core\Repositories\Surveys\SurveysRepository;
use UGCore\Http\Controllers\Controller;

class ReportSurveyController extends Controller
{
    protected $objRPY;
    protected $path="surveys.reports";


    public function __construct(SurveysRepository $objRPY) {
        $this->objRPY = $objRPY;
    }
    public function index(){
        return view($this->path.'.index')->with(['surveys'=>$this->objRPY->forGetSurveys()]);
    }

    public function getProcessReport(\Illuminate\Http\Request  $request){
        $validator = \Validator::make($request->all(), [
            'btnAction' => 'required|in:XLS,PDF,VIEW',
            'surveys' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->route('surveys.report_global')->withErrors(["Par&aacute;metros insuficientes para realizar la operaci&oacute;n"]);
        }

        $objSurvey=Survey::find($request->surveys);
        if($objSurvey==null){
            return redirect()->route('surveys.report_global')->withErrors(["C&oacute;digo de encuesta no existe"]);
        }

        switch ($request->btnAction){
            case 'XLS':break;
            case 'VIEW': return $this->reportView($objSurvey); break;
            case 'PDF':break;
        }

    }

    public function reportView($objSurvey){
        $data=$this->objRPY->forReportSurveyData($objSurvey->id);
        if(count($data)>0){
            return view($this->path.'.previewdata')->with(['dataReport'=>$data,'objSurvey'=>$objSurvey]);
        }else{
            return redirect()->route('surveys.report_global')->withErrors(["No hay datos para evaluar la solicitud"]);
        }

    }
}