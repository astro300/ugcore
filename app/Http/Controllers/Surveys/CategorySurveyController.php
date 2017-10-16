<?php

namespace UGCore\Http\Controllers\Surveys;

use Illuminate\Http\Request;

use UGCore\Core\Repositories\Surveys\SurveysRepository;
use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use Messages;

class CategorySurveyController extends Controller
{

    protected $objRPY;
    protected $path="surveys.categories_surveys";


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
        return view('surveys.categories_surveys.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Surveys\CategoriesSurveysRequest $request)
    {
        $this->objRPY->forSaveCategoriesSurvey($request);
        Messages::infoRegisterCustom('Categor&iacute;a de encuesta agregada correctamente');
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
        return view($this->path.'.edit')->with(['objSurvey'=>$this->objRPY->forGetCategoriesSurvey($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Surveys\CategoriesSurveysRequest $request, $id)
    {
        $this->objRPY->forUpdateCategoriesSurvey($request,$id);
        Messages::infoRegisterCustom('Categor&iacute;a de encuesta actualizada correctamente');
        return redirect()->route($this->path.'.index');
    }


    public function datatables(){
        return  $this->objRPY->forDataTable();
    }
}
