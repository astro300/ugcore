<?php

namespace UGCore\Http\Controllers\Surveys;

use Illuminate\Http\Request;

use UGCore\Core\Repositories\Surveys\SurveysRepository;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use Messages;

class CategoryQuestionController extends Controller
{

    protected $objRPY;
    protected $path="surveys.categories_questions";


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
        return view($this->path.'.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Surveys\CategoriesQuestionsRequest $request)
    {
        $this->objRPY->forSaveCategoriesQuestionsSurvey($request);
        Messages::infoRegisterCustom('Categor&iacute;a de pregunta agregada correctamente');
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
        return view($this->path.'.edit')->with(['objSurvey'=>$this->objRPY->forGetCategoryQuestionSurvey($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Surveys\CategoriesQuestionsRequest $request, $id)
    {
        $this->objRPY->forUpdateCategoriesQuestionsSurvey($request,$id);
        Messages::infoRegisterCustom('Categor&iacute;a de pregunta actualizada correctamente');
        return redirect()->route($this->path.'.index');
    }


    public function datatables(){
        return  $this->objRPY->forDataCategoriesQuestionsSurvey();
    }
}
