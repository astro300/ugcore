<?php

namespace UGCore\Http\Controllers\Preprofessional;

use Illuminate\Http\Request;

use UGCore\Http\Requests;
use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Preprofesionales\PreprofessionalRepository;
use UGCore\Core\Entities\preprofessional\PreprofessionalCathedra;
use UGCore\Core\Entities\preprofessional\PreprofessionalUsers;
use UGCore\Core\Entities\preprofessional\PreprofessionalTutor;
use UGCore\Core\Entities\preprofessional\PreprofessionalIntermediate;
use UGCore\Library\Utils;
use DB;
use UGCore\Library\MessagesPreprofessional;
use UGCore\Core\Ajax\PreprofessionalAjax;
use UGCore\Library\UserSessionDependences;
use Storage;
use File;

class CathedraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        private $objPRYPreprofessional;
    public function __construct()
    {
         $this->objPRYPreprofessional=new PreprofessionalRepository();
    }


    public function index(Request $request,$faculty,$career){

            $scope = $request->scope == NULL?'':$request->scope;
            $getCathedra=$this->objPRYPreprofessional->forGetCathedras($scope,$faculty,$career);
            return view('preprofessional.cathedra.indexcathedra', ['getCathedra' => $getCathedra,'faculty' => $faculty, 'career' => $career]);
    }


    public function showDatosStudent(Request $request,$id,$faculty,$career){

        $validatedocumentStudent=$this->objPRYPreprofessional->forSshowCathedrasValidate($request->document,$faculty,$career);
        if($validatedocumentStudent==1){

            $getStudent=$this->objPRYPreprofessional->forShowCathedrasNamesStudent($request->document,$faculty,$career);

            foreach ($getStudent as $getStudents ) {
                $nameUsuer=strtoupper($getStudents->first_name);
                $lastUsuer=strtoupper($getStudents->last_name);
                $new_name_estu=$nameUsuer.' '.$lastUsuer;
                        }
                $documentstudent=$request->document;

                            $tutor = PreprofessionalAjax::getInformationDocente($career);
                            $flag=false;
                            if(!$tutor){
                                $flag=true;
                                MessagesPreprofessional::warningsession();
                            }else{

                            $gettutor= $tutor['data'];

                            foreach ($gettutor as $key => $row) {
                                $aux[$key] = $row['NOMBRES'];
                            }
                            array_multisort($aux, SORT_ASC, $gettutor);
                        }
        $getNameCa=$this->objPRYPreprofessional->forGetCathedrasNames($id,$faculty,$career);
         foreach ($getNameCa as $getNameCas) {
             $getNameCathedra=$getNameCas->name;
         }

             return view('preprofessional.cathedra.cathedraassignment',compact('flag','documentstudent','new_name_estu','gettutor','id','faculty','career','getNameCathedra'));
        }else{

            MessagesPreprofessional::warningValidadocument($request->document);
            return redirect()->route('preprofessional.cathedra.asignemntstudent',[$id,$faculty,$career]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create($faculty,$career)
    {
        $getyear=Utils::getYear();
        $Period=$getyear+1;
        $getperiod="$getyear-$Period";

        return view('preprofessional.cathedra.createcathedra',compact('getperiod','faculty','career'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$faculty,$career)
    {
        $getCathedra=$this->objPRYPreprofessional->forGetCathedrasValidate($request->name_cathedra,$request->period,$request->cycle,$faculty,$career);
        if($getCathedra==0){

            $this->objPRYPreprofessional->forStoreCathedra($request,$faculty,$career);
            MessagesPreprofessional::infoRegisterprocces();
            return redirect()->route('preprofessional.cathedra.index',[$faculty,$career]);
        }else{
            MessagesPreprofessional::warningcathedrastore();
            return redirect()->route('preprofessional.cathedra.createcathedra',[$faculty,$career]);
        }
    }

    public function asignemntStudent($id,$faculty,$career){
                        
        $tutor = PreprofessionalAjax::getInformationDocente($career);
        $flag=false;
            if(!$tutor){
                    $flag=true;
                MessagesPreprofessional::warningsession();
            }else{
        $gettutor= $tutor['data'];
        foreach ($gettutor as $key => $row) {
                    $aux[$key] = $row['NOMBRES'];
        }
        array_multisort($aux, SORT_ASC, $gettutor);
        $getNameCa=$this->objPRYPreprofessional->forGetCathedrasNames($id,$faculty,$career);
         foreach ($getNameCa as $getNameCas) {
             $getNameCathedra=$getNameCas->name;
         }
     }

         $new_name_estu="";
         $documentStudent="";
         return view('preprofessional.cathedra.cathedraassignment',compact('flag','documentstudent','new_name_estu','gettutor','id','faculty','career','getNameCathedra'));
    }


       public function addAsignemntStudent(Request $request,$documentstudent,$id,$faculty,$career){
            $getquantity=$this->objPRYPreprofessional->forGetCathedrasAssigmentValidate($documentstudent,$id,$faculty,$career);
            if($getquantity==0){
                $getStudentcathedra=$this->objPRYPreprofessional->forGetCathedrasValidatEstu($documentstudent,$faculty,$career);
                    foreach ($getStudentcathedra as $getStudentcathedras ) {
                                    $id_student=$getStudentcathedras->id;
                                    $get_cathedra_student=$getStudentcathedras->cathedra_count;
                                    }

                $get_status_cathedra=$this->objPRYPreprofessional->forGetCathedrasAssigmentStatus($documentstudent,$id,$faculty,$career);
                if($get_status_cathedra==0){

                    $getNumberCa=$this->objPRYPreprofessional->forGetCathedrasNames($id,$faculty,$career);
                    foreach ($getNumberCa as $getNumberCa) {
                        $getNameCa=$getNumberCa->name;
                    }
                                        $getcathedra_estudent_n=$get_cathedra_student+1;
                    if($getNameCa == $getcathedra_estudent_n){

                    //obtener el nombre de los docentes
                    $Namestutor = Utils::showapinametutor($request->tutor);
                    $flag=false;
                    if($Namestutor==" "){
                            $flag=true;
                        MessagesPreprofessional::warningsession();
                    }else{
                            

                                $this->objPRYPreprofessional->forStoreAsigment($request,$id_student,$id);
                                MessagesPreprofessional::infoRegisterassigment();
                                $this->objPRYPreprofessional->forUpdateCathedra($id);
                                
                                $objShowValidaDocument=$this->objPRYPreprofessional->forGetCathedrassummary($documentstudent,$id);

                        foreach ($objShowValidaDocument as $objShowValidaDocuments){
                        $nameCatedra=$objShowValidaDocuments->name;
                        $nameUsuer=strtoupper($objShowValidaDocuments->name_estu);
                        $lastUsuer=strtoupper($objShowValidaDocuments->ape_estu);
                        $new_name_estu=$nameUsuer.' '.$lastUsuer;
                        $catperiod=$objShowValidaDocuments->period;
                        $catcycle=$objShowValidaDocuments->cycle;
                        $cod_tutor=$objShowValidaDocuments->id_tutor;
                        }
                    
                    //Subir documento al repositorio
                    $file=$request->file;
                    $extension = $file->getClientOriginalExtension(); 
                                        $nameFile='Solicitud_inicio_CI_'.$id.'_'.$documentstudent.'.'.$extension;

                     $nombre = $file->getClientOriginalName();
                     $fullPath=env('URL_STORAGE_PREPROFESIONAL').'/CATEDRAS';

                            if (Storage::disk('ftp')->exists("$fullPath/$nameFile")){
                                Storage::disk('ftp')->delete("$fullPath/$nameFile");
                            }
                            Storage::disk('ftp')->put("$fullPath/$nameFile",  File::get($file));  
                    //fin subir documento
                    }
                        return view('preprofessional.cathedra.abstracstudentcathedra',compact('flag','documentstudent','nameCatedra', 'new_name_estu','faculty','career', 'catperiod', 'catcycle', 'Namestutor'));

                    }else{

                        if(empty($get_cathedra_student)){
                        MessagesPreprofessional::warningValidaCaEstudent($documentstudent);
                        }else{
                        MessagesPreprofessional::warningValidaCaEstu($documentstudent,$get_cathedra_student);
                        }
                        return redirect()->route('preprofessional.cathedra.asignemntstudent',[$id,$faculty,$career]);
                    }
                }else{
                    MessagesPreprofessional::warningValidaCaEstuXathedra($documentstudent);
                        return redirect()->route('preprofessional.cathedra.asignemntstudent',[$id,$faculty,$career]);
                }
        }else{
             $documentwarning=$documentstudent;

            MessagesPreprofessional::warningValidaCa($documentwarning);
            return redirect()->route('preprofessional.cathedra.asignemntstudent',[$id,$faculty,$career]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$faculty,$career)
    {

        $i=0;
        $objShowCatedraUers=$this->objPRYPreprofessional->forShowCathedrasStudent($id,$faculty,$career);
        if(empty($objShowCatedraUers)){
                MessagesPreprofessional::messageevaulationstudent();  
                $getresult="";
                $flag=false;        

        }else{
        foreach ($objShowCatedraUers as $objshowcathe) {
            $Namestutor = Utils::showapinametutor($objshowcathe->id_tutor);
            $getresult[$i]= array($objshowcathe->document,$objshowcathe->name_estu,$objshowcathe->ape_estu,$objshowcathe->note,$objshowcathe->status_cathedra,$Namestutor);
            $i=$i+1;
        }
        $flag=false;
            if($Namestutor==" "){
                    $flag=true;
                        MessagesPreprofessional::warningsession();
        }

    }
            return view('preprofessional.cathedra.studentshowcathedra', ['flag' => $flag,'getresult' => $getresult, 'faculty' => $faculty,'career' => $career]);
    }

    public function evaluationEstudent($id,$faculty,$career){

                $objEvaluationStudent=$this->objPRYPreprofessional->forGetCathedrasEvaluation($id,$faculty,$career);
                if(empty($objEvaluationStudent)){
                MessagesPreprofessional::messageevaulation();                  
                }

            return view('preprofessional.cathedra.evaluationstudentcathedra', ['objEvaluationStudent' => $objEvaluationStudent,'id'=>$id, 'faculty' => $faculty,'career' => $career]);
    }

    public function storeEvaluation(Request $request,$id,$faculty,$career){
        $objEvaluationStudent=$this->objPRYPreprofessional->forGetCathedrasEvaluation($id,$faculty,$career);
        foreach ($objEvaluationStudent as $objevaluation) {
            $getdocument=$objevaluation->document;
            $getdocumentstudent=$request->$getdocument;
            if(!$getdocumentstudent == ""){
                if($getdocumentstudent>6){
                    $estadoCatedra="A";
                    $this->objPRYPreprofessional->forUpdateNoteUsers($estadoCatedra,$getdocumentstudent,$objevaluation->id,$id);
                    $this->objPRYPreprofessional->forUpdatecathedrastudent($objevaluation->id,$objevaluation->cathedra_count);

                }else{
                    $estadoCatedra="R";
                    $this->objPRYPreprofessional->forUpdateNoteUsers($estadoCatedra,$getdocumentstudent,$objevaluation->id,$id);
                }
            
        }
    }
        if(!empty($getdocumentstudent)){
            MessagesPreprofessional::noteEstudent();
        }
        return redirect()->route('preprofessional.cathedra.index',[$faculty,$career]);
    }

    public function searchEstudent($faculty,$career){

        $name_estudent="";
        $objShowstudentCatedra=[];
            return view ('preprofessional.cathedra.searchstudent',['name_estudent' => $name_estudent,'objShowstudentCatedra' => $objShowstudentCatedra,'faculty' => $faculty, 'career' => $career]);

    }

    public function showStudentCathedras(Request $request,$faculty,$career){

        $ValidStudent=$this->objPRYPreprofessional->forValidateProspects($request->document,$faculty,$career);
        if ($ValidStudent==1){
            $getStudentcathedra=$this->objPRYPreprofessional->forGetStudentCathedras($request->document,$faculty,$career);
            if(!empty($getStudentcathedra)){
            foreach ($getStudentcathedra as $getStudentcathedras) {
                $name_estudent=Utils::strtoupper($getStudentcathedras->first_name,$getStudentcathedras->last_name);
            }
            $objShowstudentCatedra=$this->objPRYPreprofessional->forShowStudentCathedras($request->document,$faculty,$career);
            return view ('preprofessional.cathedra.searchstudent', compact('name_estudent','objShowstudentCatedra','faculty','career'));
        }else{
            MessagesPreprofessional::ValidaStudentwarning($request->document);
            return redirect()->route('preprofessional.cathedra.searchEstudent',[$faculty,$career]);

        }

        }else{
            MessagesPreprofessional::ValidaStudent();
            return redirect()->route('preprofessional.cathedra.searchEstudent',[$faculty,$career]);

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        //return view('preprofessional.cathedra.cathedraassignment');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
