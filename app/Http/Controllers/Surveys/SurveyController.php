<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 27/10/16
 * Time: 09:34 AM
 */

namespace UGCore\Http\Controllers\Surveys;

use Illuminate\Http\Request;
use UGCore\Core\Repositories\Surveys\SurveysRepository;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Library\Messages;

class SurveyController extends Controller
{

    protected $objRPY;
    protected $path = "surveys.admin_surveys";


    public function __construct(SurveysRepository $objRPY)
    {
        $this->objRPY = $objRPY;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . '.index')->with(['categorySurveys' => $this->objRPY->forGetCategorySurveys()]);
    }


    public function store(Requests\Surveys\SurveyRequest $request)
    {
        $this->objRPY->forSaveSurvey($request);
        Messages::infoRegisterCustom('Encuesta agregada correctamente');
        return redirect()->route($this->path . '.index');
    }

    public function datatables()
    {
        return $this->objRPY->forDataSurvey();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->path . '.edit')->with(['categorySurveys' => $this->objRPY->forGetCategorySurveys(), 'object' => $this->objRPY->forGetSurvey($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Surveys\SurveyRequest $request, $id)
    {
        $this->objRPY->forUpdateSurvey($request, $id);
        Messages::infoRegisterCustom('La pregunta ha sido actualizada correctamente');
        return redirect()->route($this->path . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view($this->path . '.show')->with(['categorySurveys' => $this->objRPY->forGetCategorySurveys(), 'object' => $this->objRPY->forGetSurvey($id)]);
    }

    public function questions($id)
    {
        return view($this->path . '.questions')->with(['categorySurveys' => $this->objRPY->forGetCategorySurveys(), 'object' => $this->objRPY->forGetSurvey($id)]);

    }

    public function questionsdt($survey_id)
    {
        return $this->objRPY->forDataQuestionDTSurvey($survey_id);
    }

    public function assigmentQuestion(\Illuminate\Http\Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'question' => 'required',
            'action' => 'required',
            'survey' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json("Paramteros insuficientes para realizar la operacion",400);
        }

        return  $this->objRPY->forSaveAssigmentQuestionSurvey($request);
    }
}