<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 24/10/16
 * Time: 05:45 PM
 */

namespace UGCore\Http\Controllers\Surveys;

use Illuminate\Http\Request;


use UGCore\Core\Repositories\Surveys\SurveysRepository;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use Messages;

class QuestionController extends Controller
{

    protected $objRPY;
    protected $path="surveys.questions";


    public function __construct(SurveysRepository $objRPY) {
        $this->objRPY = $objRPY;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path.'.index')->with(['typeQuestions'=>$this->objRPY->forGetTypeQuestions(),'categoryQuestions'=>$this->objRPY->forGetCategoryQuestions()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Surveys\QuestionsRequest $request)
    {
        $this->objRPY->forSaveQuestionSurvey($request);
        Messages::infoRegisterCustom('Pregunta agregada correctamente');
        return redirect()->route($this->path.'.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->path.'.edit')->with(['typeQuestions'=>$this->objRPY->forGetTypeQuestions(),'categoryQuestions'=>$this->objRPY->forGetCategoryQuestions(),'object'=>$this->objRPY->forGetQuestionSurvey($id)]);
    }

    public function show($id)
    {
        return view($this->path.'.show')->with(['typeQuestions'=>$this->objRPY->forGetTypeQuestions(),'categoryQuestions'=>$this->objRPY->forGetCategoryQuestions(),'object'=>$this->objRPY->forGetQuestionSurvey($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Surveys\QuestionsRequest $request, $id)
    {
        $this->objRPY->forUpdateQuestionSurvey($request,$id);
        Messages::infoRegisterCustom('La pregunta ha sido actualizada correctamente');
        return redirect()->route($this->path.'.index');
    }


    public function datatables(){
        return  $this->objRPY->forDataQuestionSurvey();
    }
}
