<?php
namespace UGCore\Core\Repositories\Preprofesionales;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Markdown;
use UGCore\Core\Entities\Comun\AutoridadCatalog;
use UGCore\Core\Entities\Comun\EmailQueue;
use UGCore\Core\Entities\Preprofessional\PreprofessionalActivityAnexo;
use UGCore\Core\Entities\Preprofessional\PreprofessionalUsers;
use UGCore\Core\Entities\Preprofessional\PreprofessionalInstitution;
use UGCore\Core\Entities\Preprofessional\PreprofessionalCathedra;
use UGCore\Core\Entities\Preprofessional\PreprofessionalIntermediate;
use UGCore\Core\Entities\Preprofessional\PreprofessionalActivity;
use UGCore\Core\Entities\Preprofessional\PreprofessionalEvaluationEstudent;
use UGCore\Core\Entities\Preprofessional\PreprofessionalEvaluationTutor;
use UGCore\Core\Entities\Preprofessional\PreprofessionalDocuments;
use UGCore\Core\Entities\Preprofessional\Preprofessionalsuperadmin;
use DB;
use UGCore\Core\Entities\Security\User;
use UGCore\Facades\MessagesPreprofessional;
use UGCore\Http\Controllers\Ajax\SelectController;
use UGCore\Mail\WelcomeProspect;
use Utils;
use UGCore\Http\Requests;
use Storage;
use File;
use Auth;


class PreprofessionalRepository
{

    public function forStoreUsers($request, $id_faculty, $id_career,$userID)
    {


        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            $msgJSON=$this->forStudentAccessValid($id_career,$request->document,true);
            if(count($msgJSON)==2){
                $objSelect=new SelectController();
                $codFaculty=$objSelect->getNameMateriaCarreraFacultad('CARRERA',[$id_career],'http')[0];
                $objAutoridadCatalog=AutoridadCatalog::where('carrera','=',$id_career)
                    ->where('tipoAutoridad','=',3)->firstOrFail();
                $objPreprofessionalUsers= new PreprofessionalUsers();
                $objPreprofessionalUsers->document=$request->document;
                $objPreprofessionalUsers->first_name=$request->names;
                $objPreprofessionalUsers->last_name=$request->last_name;
                $objPreprofessionalUsers->institution_email=$request->email_institu;
                $objPreprofessionalUsers->alternative_email=$request->email_alternat;
                $objPreprofessionalUsers->phone=$request->phone;
                $objPreprofessionalUsers->semester=$msgJSON['NIVEL'];
                $objPreprofessionalUsers->status='A';
                $objPreprofessionalUsers->cod_faculty=$codFaculty->COD_FACULTAD;
                $objPreprofessionalUsers->cod_carrer=$id_career;
                $objPreprofessionalUsers->created_by=$userID;
                $objPreprofessionalUsers->updated_by=$userID;
                $objPreprofessionalUsers->created_ip=$request->ip();
                $objPreprofessionalUsers->updated_ip=$request->ip();
                $objPreprofessionalUsers->status_asignation='P';
                $objPreprofessionalUsers->hours_all_institution='0';
                $objPreprofessionalUsers->direccion=$request->direccion;
                $objPreprofessionalUsers->save();


                $dia=date('d');
                \Carbon\Carbon::setLocale('es');
                $mes=\Carbon\Carbon::now()->format('F');
                $anio=date('Y');

                $nombre_estudiante=$request->names.' '.$request->last_name;
                $nuic=$request->document;
                $email=$request->email_institu;
                $direccion=$request->direccion;
                $telefono=$request->phone;
                $nombre_carrera=$codFaculty->NOMBRE_CARRERA;
                $nombre_facultad=$codFaculty->NOMBRE_FACULTAD;

                $director_carrera=$objAutoridadCatalog->nombres;
                $nivel=$msgJSON['NIVEL'];

                $identity=uniqid();
                $token=bcrypt($identity);

                $pdf = \PDF::loadView('preprofessional.template.inscripcion',
                    compact('dia','mes',
                        'token','anio','nombre_estudiante','nuic','email','telefono','direccion','nombre_carrera','nivel','nombre_facultad','director_carrera'));

                \Storage::disk('ftp')->put("MODULOS/PREPROFESIONALES_PRACTICAS/FINS-$nuic-$identity.pdf", $pdf->output());


                $objPreprofessionalDocuments=new PreprofessionalDocuments();
                $objPreprofessionalDocuments->name_file="FINS-$nuic-$identity.pdf";
                $objPreprofessionalDocuments->file_path="PREPROFESIONALES_PRACTICAS/";
                $objPreprofessionalDocuments->type="FINS";
                $objPreprofessionalDocuments->created_by=$userID;
                $objPreprofessionalDocuments->updated_by=$userID;
                $objPreprofessionalDocuments->created_ip=$request->ip();
                $objPreprofessionalDocuments->updated_ip=$request->ip();
                $objPreprofessionalDocuments->token=$token;
                $objPreprofessionalUsers->documents()->save($objPreprofessionalDocuments);

                $this->sendEmail($request->email_institu,$nombre_estudiante,$request->email_alternat,$nombre_facultad,$nombre_carrera,'preprofessional.email.welcomeprospect','','','INSCRIPCIÓN AL PROCESO DE PRACTICAS PREPROFESIONALES');


                DB::connection('sqlsrv_modulos')->commit();

                MessagesPreprofessional::infoCustom('Estudiante inscrito correctamente, espera el email de confirmación en el que se notifique el tutor');

            }else{
                if(count($msgJSON)==3){
                    MessagesPreprofessional::errorCustom(ifArrayNull($msgJSON,'STATUS','ERROR DE PROCESO INTERNO'));
                }else{
                    MessagesPreprofessional::errorCustom(implode(',',$msgJSON));
                }

            }
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }
    }

    public function forUpdateUsers($request, $document, $faculty, $career)
    {
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            $msgJSON=$this->getLevelStudent($document,$career);
            if(count($msgJSON)>0){
                $objSelect=new SelectController();
                $codFaculty=$objSelect->getNameMateriaCarreraFacultad('CARRERA',[$career],'http')[0];
                $objData= PreprofessionalUsers::where('document', '=', $document)
                    ->where('cod_faculty', '=', $faculty)
                    ->where('cod_carrer', '=', $career)->firstOrFail();

                $objAutoridadCatalog=AutoridadCatalog::where('carrera','=',$career)
                    ->where('tipoAutoridad','=',3)->firstOrFail();

                $parameters=[
                    'alternative_email' => $request->email_alternat,
                    'phone' => $request->phone,
                    'institution_email'=>$request->email_institu,
                    'direccion'=>$request->direccion
                ];

                $nombre_carrera=$codFaculty->NOMBRE_CARRERA;
                $nombre_facultad=$codFaculty->NOMBRE_FACULTAD;
                $nombre_estudiante=$objData->first_name.' '.$objData->last_name;

                if($request->rechazo=='S'){
                    $parameters['observacion']=$request->obs_rechazo;
                    $parameters['status_asignation']='R';
                    PreprofessionalDocuments::where('id_student','=',$objData->id)
                        ->where('type','=','FINS')->update([
                            'deleted_at'=>date(Utils::getFormatDateSQL()),
                            'deleted_by'=>\Auth::user()->id,
                            'deleted_ip'=>$request->ip()]);


                    $this->sendEmail($request->email_institu,$nombre_estudiante,$request->emailPersonal,$nombre_facultad,$nombre_carrera,
                        'preprofessional.email.rechazoprospect',date(Utils::getFormatDateSQL()),$request->obs_rechazo,'COMUNICADO SOBRE EL PROCESO DE PRACTICAS PREPROFESIONALES');

                }else{
                    $parameters['observacion']='';
                }


                if($objData->status_asignation!='P' && $request->rechazo=='S'){
                    MessagesPreprofessional::errorCustom('NO SE PUEDE RECHAZAR UNA SOLICITUD QUE HA SIDO 
              ASIGNADA A UN TUTOR Y A UNA EMPRESA EN ESPECÍFICO');
                }else{

                    if($objData->status_asignation=='R' && $request->reactivar=='S'){
                        $parameters['observacion']=$request->obs_reactivar;
                        $parameters['status_asignation']='P';

                        $dia=date('d');
                        \Carbon\Carbon::setLocale('es');
                        $mes=\Carbon\Carbon::now()->format('F');
                        $anio=date('Y');

                        $nuic=$request->document;
                        $email=$request->email_institu;
                        $direccion=$request->direccion;
                        $telefono=$request->phone;
                        $nombre_carrera=$codFaculty->NOMBRE_CARRERA;
                        $nombre_facultad=$codFaculty->NOMBRE_FACULTAD;

                        $director_carrera=$objAutoridadCatalog->nombres;

                        $nivel=$msgJSON[0]->NIVEL;

                        $identity=uniqid();
                        $token=bcrypt($identity);

                        $pdf = \PDF::loadView('preprofessional.template.inscripcion',
                            compact('dia','mes',
                                'token','anio','nombre_estudiante','nuic','email','telefono','direccion','nombre_carrera','nivel','nombre_facultad','director_carrera'));

                        \Storage::disk('ftp')->put("MODULOS/PREPROFESIONALES_PRACTICAS/FINS-$nuic-$identity.pdf", $pdf->output());

                        $objPreprofessionalDocuments=new PreprofessionalDocuments();
                        $objPreprofessionalDocuments->name_file="FINS-$nuic-$identity.pdf";
                        $objPreprofessionalDocuments->file_path="PREPROFESIONALES_PRACTICAS/";
                        $objPreprofessionalDocuments->type="FINS";
                        $objPreprofessionalDocuments->created_by=\Auth::user()->id;
                        $objPreprofessionalDocuments->updated_by=\Auth::user()->id;
                        $objPreprofessionalDocuments->created_ip=$request->ip();
                        $objPreprofessionalDocuments->updated_ip=$request->ip();
                        $objPreprofessionalDocuments->token=$token;
                        $objData->documents()->save($objPreprofessionalDocuments);

                        $this->sendEmail($request->email_institu,$nombre_estudiante,$request->emailPersonal,$nombre_facultad,$nombre_carrera,
                            'preprofessional.email.reactivarprospect',date(Utils::getFormatDateSQL()),$request->obs_reactivar,
                            'COMUNICADO SOBRE EL PROCESO DE PRACTICAS PREPROFESIONALES');

                    }
                    $objData->update($parameters);
                    MessagesPreprofessional::warningRegisterupdadate();
                }
             }else{
                    MessagesPreprofessional::errorCustom('EL ESTUDIANTE CON IDENTIFICACION: '.$document.
                        ' NO SE ENCUENTRA HABILITADO PARA INICIAR EL PROCESO');
            }
            DB::connection('sqlsrv_modulos')->commit();
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }
    }




    public function forStoreCathedra($request, $id_faculty, $id_career)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id_faculty, $id_career) {


            $objCatedras = new PreprofessionalCathedra();
            $objCatedras->name = $request->name_cathedra;
            $objCatedras->period = $request->period;
            $objCatedras->cycle = $request->cycle;
            $objCatedras->many_estudent = 0;
            $objCatedras->status = 'A';
            $objCatedras->description = $request->description;
            $objCatedras->cod_faculty = $id_faculty;
            $objCatedras->cod_carrer = $id_career;
            $objCatedras->created_by = \Auth::user()->id;
            $objCatedras->save();
        });
    }

    public function forStoreAsigment($request, $getStudent, $id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $getStudent, $id) {

            $objAsigmentEstudent = new PreprofessionalIntermediate();
            $objAsigmentEstudent->id_cathedra = $id;
            $objAsigmentEstudent->id_student = $getStudent;
            $objAsigmentEstudent->id_tutor = $request->tutor;
            $objAsigmentEstudent->type = 'CA';
            $objAsigmentEstudent->status_cathedra = 'P';
            $objAsigmentEstudent->save();
        });
    }

    public function forUpdateCathedra($id)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($id) {
            $num_updates = PreprofessionalCathedra::where('id', '=', $id)
                ->increment('many_estudent');

        });
    }

    public function forUpdateNoteUsers($statusCathedra, $note, $id_es, $id_ca)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($statusCathedra, $note, $id_es, $id_ca) {
            $updatesstatusnote = PreprofessionalIntermediate::where('id_cathedra', '=', $id_ca)->where('id_student', '=', $id_es)
                ->update([
                    'note' => $note,
                    'status_cathedra' => $statusCathedra
                ]);
        });
    }

    public function forUpdatecathedrastudent($id_es, $ca_count)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($id_es, $ca_count) {
            $increment = $ca_count + 1;
            $updatescancatdera = PreprofessionalUsers::where('id', '=', $id_es)
                ->update([
                    'cathedra_count' => $increment
                ]);
        });
    }

    public function forStoreInstitucion($request, $id_faculty, $id_career)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id_faculty, $id_career) {


            $objProspects = new PreprofessionalInstitution();
            $objProspects->ruc = $request->document;
            $objProspects->name = $request->institution;
            $objProspects->type = $request->typeinstitution;
            $objProspects->address = $request->adress;
            $objProspects->phone = $request->phone;
            $objProspects->email = $request->email;
            $objProspects->many_estudent = 0;
            $objProspects->description = $request->description;
            $objProspects->cod_faculty = $id_faculty;
            $objProspects->cod_carrer = $id_career;
            $objProspects->created_by = \Auth::user()->id;
            $objProspects->save();
        });
    }

    public function forStoreInstitutionAssignment($request, $id_institution, $id_student)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $id_institution, $id_student) {


            $objProspects = new PreprofessionalIntermediate();
            $objProspects->id_student = $id_student;
            $objProspects->id_institution = $id_institution;
            $objProspects->id_tutor = $request->tutor;
            $objProspects->type = 'PI';
            $objProspects->status_institution = 'P';
            $objProspects->date_start = $request->star_date;
            $objProspects->date_finish = $request->end_date;
            $objProspects->name_supervisor = $request->name_supervisor;
            $objProspects->position_supervisor = $request->position_supervisor;
            $objProspects->departament = $request->area;
            $objProspects->save();
        });
    }

    public function forUpdateManyInstitution($id, $faculty, $career)
    {
            $num_updates = PreprofessionalInstitution::where('id', '=', $id)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)
                ->increment('many_estudent');

    }

    private function filePut(UploadedFile $file)
    {
        if ($file != null) {
            $extension = $file->getClientOriginalExtension();
            $nameFile = Auth::user()->name.'_'. date('Ymdhis') . Utils::uniqidReal() . '.' . $extension;
            Storage::disk('ftp')->put('MODULOS/PREPROFESIONALES_ANEXOS/' . $nameFile, File::get($file));
            return $nameFile;
        }
        return null;
    }

    public function forStoreActivityStudent($request, $id_student)
    {
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
            $arrayAnexos = [];
            $files = $request->anexo;
            if ($files != null) {
                foreach ($files as $file) {
                    $nameFile = $this->filePut($file);
                    $arrayAnexos[] = new PreprofessionalActivityAnexo(['namefile' => $nameFile]);
                }

            }

            $objActivity = new PreprofessionalActivity();
            $objActivity->date_activity = $request->date;
            $objActivity->number_hours = $request->n_hours;
            $objActivity->description = $request->description;
            $objActivity->observation = $request->observation;
            $objActivity->id_student = $id_student;
            $objActivity->created_by = \Auth::user()->id;
            $objActivity->save();

            if (count($arrayAnexos) > 0) {
                (PreprofessionalActivity::findOrFail($objActivity->id))->anexos()->saveMany($arrayAnexos);
            }

        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }

        DB::connection('sqlsrv_modulos')->commit();


    }

    public function forUpdateinstitutionstudent($quantityInstitucional, $id_student)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($quantityInstitucional, $id_student) {
            $updatescancatdera = PreprofessionalUsers::where('id', '=', $id_student)
                ->update([
                    'hours_all_institution' => $quantityInstitucional
                ]);
        });
    }

    public function forStoreEvaluationStudent($request, $idestudent)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $idestudent) {

            $objEvaluationStudent = new PreprofessionalEvaluationEstudent();
            $objEvaluationStudent->id_student = $idestudent;
            $objEvaluationStudent->eval_date =  date(Utils::getFormatDateSQL(true,false));
            $objEvaluationStudent->knowledge_appli = $request->p1;
            $objEvaluationStudent->resolution_problems = $request->p2;
            $objEvaluationStudent->use_procedures = $request->p3;
            $objEvaluationStudent->integration_work_team = $request->p4;
            $objEvaluationStudent->obs_knowledge_skills = $request->Observacion1;
            $objEvaluationStudent->punctuality = $request->p5;
            $objEvaluationStudent->responsibility = $request->p6;
            $objEvaluationStudent->obs_assistance = $request->Observacion2;
            $objEvaluationStudent->integration_team_work = $request->p7;
            $objEvaluationStudent->guide_development = $request->p8;
            $objEvaluationStudent->tutor_advice = $request->p9;
            $objEvaluationStudent->obs_support_activities = $request->Observacion3;
            $objEvaluationStudent->ease_physical_space = $request->p10;
            $objEvaluationStudent->ease_means = $request->p11;
            $objEvaluationStudent->obs_availability = $request->Observacion4;
            $objEvaluationStudent->suggestions = $request->Suggestions_std;
            $objEvaluationStudent->created_by = \Auth::user()->id;
            $objEvaluationStudent->save();


        });
    }

    public function forStoreEvaluationStudentTutor($request, $idestudent, $idtutor)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $idestudent, $idtutor) {
            $fecha=explode(' ',$request->date);
            $objEvaluationStudentTutoria = new PreprofessionalEvaluationTutor();
            $objEvaluationStudentTutoria->id_tutor = $idtutor;
            $objEvaluationStudentTutoria->id_student = $idestudent;
            $objEvaluationStudentTutoria->eval_date = $fecha[0];
            $objEvaluationStudentTutoria->number_visit = $request->n_visit;
            $objEvaluationStudentTutoria->hours_visit = $fecha[1];
            $objEvaluationStudentTutoria->knowledge_practitioner = $request->p1;
            $objEvaluationStudentTutoria->demonstrate_interest = $request->p2;
            $objEvaluationStudentTutoria->initiative = $request->p3;
            $objEvaluationStudentTutoria->demostrate_capacity = $request->p4;
            $objEvaluationStudentTutoria->is_skilled = $request->p5;
            $objEvaluationStudentTutoria->obs_technically = $request->Observacion1;
            $objEvaluationStudentTutoria->commitment = $request->p6;
            $objEvaluationStudentTutoria->is_constant = $request->p7;
            $objEvaluationStudentTutoria->doing_his_job = $request->p8;
            $objEvaluationStudentTutoria->acts_voluntarily = $request->p9;
            $objEvaluationStudentTutoria->obs_operative = $request->Observacion2;
            $objEvaluationStudentTutoria->proactive_attitude = $request->p10;
            $objEvaluationStudentTutoria->cooperate = $request->p11;
            $objEvaluationStudentTutoria->respecful = $request->p12;
            $objEvaluationStudentTutoria->leadership_skills = $request->p13;
            $objEvaluationStudentTutoria->personal_presentation = $request->p14;
            $objEvaluationStudentTutoria->obs_social = $request->Observacion3;
            $objEvaluationStudentTutoria->solves_problems = $request->p15;
            $objEvaluationStudentTutoria->ability_to_evalute = $request->p16;
            $objEvaluationStudentTutoria->plans_organizes = $request->p17;
            $objEvaluationStudentTutoria->is_creative = $request->p18;
            $objEvaluationStudentTutoria->is_persevering = $request->p19;
            $objEvaluationStudentTutoria->on_time = $request->p20;
            $objEvaluationStudentTutoria->obs_strategic = $request->Observacion4;
            $objEvaluationStudentTutoria->obs_general = $request->observationgeneral;
            $objEvaluationStudentTutoria->recomendation = $request->recommendations;
            $objEvaluationStudentTutoria->created_by = \Auth::user()->id;
            $objEvaluationStudentTutoria->save();
        });
    }



    public function forUpdateActivityDescription($request, $user)
    {
        $objupdatestudents = PreprofessionalActivity::findOrFail($request->id_actividad);
        if($objupdatestudents->approved=='1'){
            MessagesPreprofessional::warningUpdateActivityStudent($objupdatestudents->description);
        }else{

            $objUserPreprofesional = PreprofessionalUsers::where('document', '=', $user)->firstOrFail();
            if ($objUserPreprofesional->id != $objupdatestudents->id_student) {
                abort(401);
            }
            $validadateactivity = $this->forGetValidateActivity($objUserPreprofesional->id, $request->date, $objupdatestudents->id);
            if ($validadateactivity != 0) {
                MessagesPreprofessional::warningdateActivity($request->date);
            } else {
                DB::connection('sqlsrv_modulos')->beginTransaction();
                try {

                    $arrayAnexos = [];
                    $files = $request->anexo;
                    $flag=false;
                    if ($files != null) {
                        foreach ($files as $file) {
                            $nameFile = $this->filePut($file);
                            $arrayAnexos[] = new PreprofessionalActivityAnexo(['namefile' => $nameFile]);
                            $flag=true;
                        }
                        if($flag){
                            PreprofessionalActivityAnexo::where('id_activity','=',$objupdatestudents->id)->delete();
                        }

                    }
                    $objupdatestudents->date_activity = $request->date;
                    $objupdatestudents->description = $request->description;
                    $objupdatestudents->observation = $request->observation;
                    $objupdatestudents->number_hours = $request->n_hours;
                    $objupdatestudents->save();
                    if (count($arrayAnexos) > 0) {
                        (PreprofessionalActivity::findOrFail($objupdatestudents->id))->anexos()->saveMany($arrayAnexos);
                    }
                    MessagesPreprofessional::RegistroActividad();
                } catch (\Exception $e) {
                    DB::connection('sqlsrv_modulos')->rollback();
                    throw $e;
                }

                DB::connection('sqlsrv_modulos')->commit();
            }
        }

    }

    public function forDeleteActivity(PreprofessionalActivity $preprofessionalActivity, $user)
    {
        $objupdatestudents = PreprofessionalActivity::findOrFail($preprofessionalActivity->id);
        $objUserPreprofesional = PreprofessionalUsers::where('document', '=', $user)->firstOrFail();
        if ($objUserPreprofesional->id != $objupdatestudents->id_student) {
            abort(401);
        }
        MessagesPreprofessional::DeleteActividad();
        $preprofessionalActivity->delete();
    }

    public function forStoreDocumentsStudent($name_file, $route_file, $document, $type_file, $id_student)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($name_file, $route_file, $type_file, $document, $id_student) {


            $objActivity = new PreprofessionalDocuments();
            $objActivity->id_student = $id_student;
            $objActivity->name_file = $name_file;
            $objActivity->file_path = $route_file;
            $objActivity->type = $type_file;
            $objActivity->created_by = \Auth::user()->id;
            $objActivity->save();
        });
    }

    public function forUpdatefinishProcess($id_student)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($id_student) {
            $updatesstatusnote = PreprofessionalIntermediate::where('id_student', '=', $id_student)->where('type', '=', 'PI')->where('status_institution', '=', 'P')
                ->update([
                    'status_institution' => 'T'
                ]);
        });
    }

    public function forStoreSuperadmin($request, $documentUSers, $Nameusers, $EmailUsers)
    {
        DB::connection('sqlsrv_modulos')->transaction(function () use ($request, $documentUSers, $Nameusers, $EmailUsers) {

            $objSuperAdmin = new Preprofessionalsuperadmin();
            $objSuperAdmin->document = $documentUSers;
            $objSuperAdmin->name = $Nameusers;
            $objSuperAdmin->cod_faculty = $request->faculties;
            $objSuperAdmin->cod_carrers = $request->careers;
            $objSuperAdmin->email = $EmailUsers;
            $objSuperAdmin->status = 'A';
            $objSuperAdmin->created_by = \Auth::user()->id;
            $objSuperAdmin->save();
        });
    }

    public function forGetSuperadmin($documentadmin)
    {
        return $objprospects = Preprofessionalsuperadmin::where('document', '=', $documentadmin)->where('status', '=', 'A')->select('cod_carrers')->get();
    }

    public function forGetProspects($scope, $faculty, $career)
    {
        return $objprospects = PreprofessionalUsers::where('status', 'A')
            ->where('document', 'LIKE', "%" . $scope . "%")
            ->where('cod_faculty', '=', $faculty)
            ->where('cod_carrer', '=', $career)
            ->orderBy('id', 'DESC')->paginate(10);
    }

    public function forValidateProspects($documentusers, $faculty, $career)
    {
        return $objprospects = PreprofessionalUsers::where('document', $documentusers)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->count();
    }

    public function forShowProspects($documentusers, $faculty, $career)
    {
        return $objprospects = PreprofessionalUsers::where('status', 'A')->where('document', '=', $documentusers)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->select('document', 'first_name', 'last_name', 'institution_email', 'alternative_email', 'phone', 'cod_faculty', 'cod_carrer', 'created_at')->get();
    }

    public function forEditProspects($documentusers, $faculty, $career)
    {
        return PreprofessionalUsers::where('document', '=', $documentusers)
            ->where('cod_faculty', '=', $faculty)
            ->where('cod_carrer', '=', $career)->get();
    }

    public function forGetCathedras($scope, $faculty, $career)
    {
        return $objcathedras = PreprofessionalCathedra::where('status', 'A')->where('period', 'LIKE', "%" . $scope . "%")->orderBy('id', 'DESC')->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->paginate(15);
    }

    public function forSshowCathedrasValidate($documentusers, $faculty, $career)
    {
        return $objcathedras = PreprofessionalUsers::where('document', '=', $documentusers)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->count();
    }

    public function forShowCathedrasNamesStudent($documentusers, $faculty, $career)
    {
        return $objcathedras = PreprofessionalUsers::where('document', $documentusers)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->select('first_name', 'last_name')->get();
    }

    public function forGetCathedrasNames($id, $faculty, $career)
    {
        return $objcathedras = PreprofessionalCathedra::where('id', '=', $id)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->select('name')->get();
    }

    public function forGetCathedrasValidate($name_cathedra, $period, $cycle, $faculty, $career)
    {
        return $objcathedras = PreprofessionalCathedra::where('name', '=', $name_cathedra)->where('period', '=', $period)->where('cycle', '=', $cycle)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->count();
    }

    public function forGetCathedrasAssigmentValidate($documentstudent, $id, $faculty, $career)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')->where('us.document', '=', $documentstudent)->where('pu.id_cathedra', '=', $id)->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)->count();
    }

    public function forGetCathedrasValidatEstu($documentstudent, $faculty, $career)
    {
        return $objcathedras = PreprofessionalUsers::where('document', $documentstudent)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)
            ->select('id', 'cathedra_count')->get();
    }

    public function forGetCathedrasAssigmentStatus($documentstudent, $id, $faculty, $career)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')->where('us.document', '=', $documentstudent)->where('pu.id_cathedra', '=', $id)->where('us.cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->where('pu.status_cathedra', '=', 'P')->count();
    }

    public function forGetCathedrassummary($documentstudent, $id)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.cathedraIntegration as ca', 'ca.id', '=', 'pu.id_cathedra')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', $documentstudent)
            ->where('pu.id_cathedra', '=', $id)
            ->where('pu.type', '=', 'CA')
            ->select('ca.name', 'us.first_name as name_estu', 'us.last_name as ape_estu', 'ca.period', 'ca.cycle', 'pu.id_tutor')
            ->get();

    }

    public function forShowCathedrasStudent($id, $faculty, $career)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.cathedraIntegration as ca', 'ca.id', '=', 'pu.id_cathedra')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('ca.id', $id)
            ->where('pu.type', '=', 'CA')
            ->where('ca.cod_faculty', '=', $faculty)->where('ca.cod_carrer', '=', $career)
            ->select('us.document', 'us.first_name as name_estu', 'us.last_name as ape_estu', 'pu.note', 'pu.status_cathedra', 'pu.id_tutor')
            ->get();

    }

    public function forGetCathedrasEvaluation($id, $faculty, $career)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.cathedraIntegration as ca', 'ca.id', '=', 'pu.id_cathedra')
            ->where('ca.id', $id)
            ->where('pu.status_cathedra', 'P')
            ->where('pu.type', '=', 'CA')
            ->where('ca.cod_faculty', '=', $faculty)->where('ca.cod_carrer', '=', $career)
            ->select('us.document', 'us.first_name as name_estu', 'us.last_name as ape_estu', 'us.id', 'us.cathedra_count')->get();

    }

    public function forGetStudentCathedras($documentstudent, $faculty, $career)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)
            ->where('document', $documentstudent)->where('pu.type', '=', 'CA')->select('first_name', 'last_name')->get();

    }

    public function forShowStudentCathedras($documentstudent, $faculty, $career)
    {
        return $objcathedras =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.cathedraIntegration as ca', 'ca.id', '=', 'pu.id_cathedra')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', $documentstudent)
            ->where('pu.type', '=', 'CA')
            ->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)->orderBy('ca.name')
            ->select('ca.name', 'ca.period', 'ca.cycle', 'pu.note', 'pu.status_cathedra')->get();

    }

    public function forGetInstitution($scope, $faculty, $career)
    {
        return $objinstitution = PreprofessionalInstitution::where('status', 'A')->where('name', 'LIKE', "%" . $scope . "%")->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->orderBy('id', 'DESC')->paginate(15);
    }

    public function forGetInstitutionValidate($ruc, $institution, $faculty, $career)
    {
        return $objinstitution = PreprofessionalInstitution::where('ruc', '=', $ruc)->where('name', '=', $institution)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->count();
    }

    public function forGetInstitutionValidateCathedra($documentstudent, $faculty, $career)
    {
        return $objinstitution = PreprofessionalUsers::where('document', '=', $documentstudent)->where('cod_faculty', '=', $faculty)->where('cod_carrer', '=', $career)->select('cathedra_count')->get();
    }

    public function forGetInstitutionValidateUsers($documentstudent)
    {
        return $objinstitution = PreprofessionalUsers::where('document', $documentstudent)->select('first_name', 'last_name', 'id')->get();
    }

    public function forInstitutionValidaAssigment($idstudent, $faculty, $career)
    {
        return $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')->where('pu.id_student', '=', $idstudent)->where('pu.type', '=', 'PI')->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)->count();
    }

    public function forEmaildAssigment($getstudentid, $id)
    {
        return $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.id', '=', $getstudentid)
            ->where('ca.id', '=', $id)
            ->select('us.document', 'us.first_name', 'us.last_name', 'us.institution_email', 'ca.name', 'ca.type', 'pu.id_tutor')->get();
    }

    public function forShowStudentInstituttion($id, $faculty, $career,$paginate=false)
    {
         $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('pu.id_institution', $id)
            ->where('pu.type', '=', 'PI')
            ->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)
            ->select('pu.id_institution','us.document', 'us.first_name as name_estu', 'us.last_name as ape_estu',
                'pu.name_supervisor', 'pu.departament', 'pu.id_tutor');
         if($paginate){
             return $objinstitution->paginate(20);
         }else{
             return $objinstitution->get();
         }
    }

    public function forGetStudentDocuments($documentstudent, $faculty, $career)
    {
        return $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', '=',$documentstudent)
            ->where('pu.type', '=', 'PI')
            ->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)->select('us.id', 'us.first_name', 'us.last_name')->get();
    }

    public function forGetDocumentsStudent($id_student)
    {
        return $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.users as us')
            ->join('modulos.Preprofesionales.documents as do', 'us.id', '=', 'do.id_student')
            ->where('us.id', '=', $id_student)->select('us.id as id_student', 'do.id as id_document', 'do.name_file', 'do.created_at')
            ->get();

    }

    public function forGetCertificate($id_student)
    {
        return $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->where('us.id', '=', $id_student)->select('us.document', 'us.first_name', 'last_name', 'us.cod_carrer', 'us.cod_faculty', 'pu.id_tutor', 'ca.name')->get();

    }

    public function forGetEmailCertificate($id_student)
    {
        return $objinstitution =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->where('us.id', '=', $id_student)->select('us.cod_carrer', 'us.cod_faculty', 'us.first_name', 'us.last_name', 'ca.name', 'ca.type', 'us.institution_email')->get();

    }

    public function forGetStudentTutor($documenttutor, $career, $faculty)
    {
        return $objtutor =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('pu.id_tutor', $documenttutor)->where('pu.type', '=', 'PI')->where('pu.status_institution', '=', 'P')
            ->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)
            ->select('us.id as id_student', 'us.document', 'us.first_name as name_estu', 'us.last_name as ape_estu', 'us.institution_email', 'ca.name', 'ca.address')->paginate(15);

    }

    public function forGetStudentValidateTutor($documenttutor, $career, $faculty)
    {
        return $objtutor = DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('pu.id_tutor', $documenttutor)->where('pu.type', '=', 'PI')->where('pu.status_institution', '=', 'P')
            ->where('us.cod_faculty', '=', $faculty)->where('us.cod_carrer', '=', $career)->count();

    }

    public function forGetCreateEvaluation($documenttutor, $document, $docmentid)
    {
        return $objtutor =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', $document)->where('pu.type', '=', 'PI')
            ->where('pu.id_tutor', $documenttutor)
            ->where('us.id', '=', $docmentid)
            ->select('ca.address', 'us.first_name as name_estu', 'us.last_name as ape_estu', 'ca.name', 'pu.departament', 'pu.name_supervisor', 'pu.position_supervisor')
            ->firstOrFail();

    }

    public function forGetVisitinStitution($documenttutor, $document, $docmentid)
    {
        return $objtutor =DB::connection('sqlsrv_modulos')->table('Preprofesionales.users as us')
            ->join('modulos.Preprofesionales.eval_supvr_tutor as stu', 'stu.id_student', '=', 'us.id')
            ->where('stu.id_tutor', '=', $documenttutor)
            ->where('us.id', '=', $docmentid)
            ->where('us.document', '=', $document)->max('stu.number_visit');

    }

    public function forGetSummaryStudent($documenttutor, $document, $docmentid)
    {
        return $objtutor =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', $document)->where('pu.type', '=', 'PI')
            ->where('pu.id_tutor', $documenttutor)
            ->where('us.id', '=', $docmentid)
            ->select('us.document', 'us.first_name as name_estu', 'us.last_name as ape_estu', 'us.institution_email', 'us.alternative_email', 'ca.name', 'ca.address', 'pu.departament', 'pu.name_supervisor', 'pu.position_supervisor', 'ca.email')->get();

    }

    public function forGetShowEvaluation($documenttutor, $documentid)
    {
        return $objtutor =DB::connection('sqlsrv_modulos')->table('Preprofesionales.eval_supvr_tutor as et')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'et.id_student')
            ->where('us.id', $documentid)
            ->where('et.id_tutor', $documenttutor)
            ->select('us.document', 'et.id', 'et.eval_date', 'number_visit')->get();

    }

    public function forGetPdfTutor($documenttutor, $documentid, $idactivity)
    {
        return $objtutor =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.institution as ins', 'ins.id', '=', 'pu.id_institution')
            ->join('modulos.Preprofesionales.eval_supvr_tutor as et', 'et.id_student', '=', 'us.id')
            ->where('us.id', $documentid)
            ->where('pu.id_tutor', $documenttutor)
            ->where('et.id', '=', $idactivity)
            ->select('ins.address', 'us.first_name', 'us.last_name', 'us.cod_carrer', 'us.cod_faculty', 'ins.name', 'pu.departament', 'pu.name_supervisor', 'pu.position_supervisor', 'pu.id_tutor', 'et.eval_date', 'et.number_visit', 'et.hours_visit', 'et.knowledge_practitioner', 'et.demonstrate_interest', 'et.initiative', 'et.demostrate_capacity', 'et.is_skilled', 'et.obs_technically', 'et.commitment', 'et.is_constant', 'et.doing_his_job', 'et.acts_voluntarily', 'et.obs_operative', 'et.proactive_attitude', 'et.cooperate', 'et.respecful', 'et.leadership_skills', 'et.personal_presentation', 'et.obs_social', 'et.solves_problems', 'et.ability_to_evalute', 'et.plans_organizes', 'et.is_creative', 'et.is_persevering', 'et.on_time', 'et.obs_strategic', 'et.obs_general', 'et.recomendation')->get();

    }


    public function forGetActivity($documentstudent)
    {
        return $objactivity =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', $documentstudent)
            ->where('pu.type', '=', 'PI')
            ->where('pu.status_institution', '=', 'P')
            ->select('us.cod_carrer', 'us.cod_faculty', 'us.id')->get();

    }

    public function forGetActivityStudent($documentstudent, $getcarrer, $getfaculty)
    {
        return $objactivity =DB::connection('sqlsrv_modulos')->table('Preprofesionales.activity as ac')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'ac.id_student')
            ->where('us.document', $documentstudent)
            ->where('us.cod_carrer', '=', $getcarrer)
            ->where('us.cod_faculty', '=', $getfaculty)->orderBy('ac.date_activity', 'DESC')
            ->select('ac.approved','ac.id', 'ac.date_activity',DB::raw('CONVERT(VARCHAR(11),ac.date_activity,103) as date_t') ,'ac.number_hours', 'ac.description',
                'us.cathedra_count', 'ac.id_student',
            DB::connection('sqlsrv_modulos')->raw('(select count(id) from modulos.Preprofesionales.activity_anexos where id_activity=ac.id) as anexos')
            )->get();

    }


    public function forGetQuantyActivity($id_student,$flag=false)
    {

         $objactivity =DB::connection('sqlsrv_modulos')->table('Preprofesionales.activity as ac')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'ac.id_student')
            ->where('us.id', '=', $id_student);

         if($flag){
             $objactivity->where('ac.approved','=','1');
         }


       return $objactivity->select(DB::raw('SUM(ac.number_hours) as number_hours'))->get();

    }

    public function forGetValidateActivity($id_student, $date, $id = null)
    {
        $objactivity =DB::connection('sqlsrv_modulos')->table('Preprofesionales.activity as ac')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'ac.id_student')
            ->where('us.id', '=', $id_student)
            ->where('ac.date_activity', '=', $date);

        if ($id == null) {
            return $objactivity->count();
        } else {
            $objactivity->where('ac.id', '<>', $id);
            return $objactivity->count();
        }
    }

    public function forGetPdfActivity($id_student)
    {
        return $objactivity =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.activity as ac', 'us.id', '=', 'ac.id_student')
            ->join('modulos.Preprofesionales.institution as ca', 'ca.id', '=', 'pu.id_institution')
            ->where('us.id', '=', $id_student)
            ->select('us.first_name', 'us.last_name', 'us.cod_carrer', 'us.cod_faculty', 'pu.name_supervisor', 'ac.date_activity', 'ac.number_hours', 'ac.description', 'ac.observation')->get();

    }

    public function forGetValidatEstudent($documentstudent)
    {
        return $objevaluation =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->where('us.document', $documentstudent)
            ->where('pu.type', '=', 'PI')
            ->where('pu.status_institution', '=', 'P')
            ->count();

    }

    public function forGetEvaluationStudent($documentstudent)
    {
        return $objevaluation =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.eval_student as st', 'st.id_student', '=', 'us.id')
            ->where('us.document', '=', $documentstudent)
            ->where('pu.type', '=', 'PI')
            ->where('pu.status_institution', '=', 'P')
            ->count();

    }

    public function forGetEvaluationStudents($documentstudent)
    {
        return $objevaluation =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as pu')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'pu.id_student')
            ->join('modulos.Preprofesionales.institution as ins', 'ins.id', '=', 'pu.id_institution')
            ->where('us.document', $documentstudent)
            ->where('pu.type', '=', 'PI')
            ->where('pu.status_institution', '=', 'P')
            ->select('ins.address', 'us.first_name', 'us.last_name', 'us.cod_carrer','us.cod_faculty', 'ins.name', 'pu.departament', 'pu.name_supervisor', 'pu.id_tutor','pu.position_supervisor')->get();

    }

    public function forGetEvaluationStudentNew($documentstudent)
    {
        return $objevaluation =DB::connection('sqlsrv_modulos')->table('Preprofesionales.projects_has_users as st')
            ->join('modulos.Preprofesionales.users as us', 'us.id', '=', 'st.id_student')
            ->join('modulos.Preprofesionales.eval_student as pu', 'pu.id_student', '=', 'us.id')
            ->where('us.document', '=', $documentstudent)
            ->where('st.type', '=', 'PI')
            ->where('st.status_institution', '=', 'P')
            ->select('pu.knowledge_appli', 'pu.resolution_problems', 'pu.use_procedures', 'pu.integration_work_team', 'pu.obs_knowledge_skills', 'pu.punctuality', 'pu.responsibility', 'pu.obs_assistance', 'pu.integration_team_work', 'pu.guide_development', 'pu.tutor_advice', 'pu.obs_support_activities', 'pu.ease_physical_space', 'pu.ease_means', 'pu.obs_availability', 'pu.suggestions')->get();

    }

    public function forGetAdministrator($documentstudent)
    {
        return $objadministrator = DB::table('users')->where('name', '=', $documentstudent)->select('name', 'email', 'description','first_name','last_name')->get();

    }

    public function forGetAdministratorValidate($documentstudent, $career, $faculty)
    {
        return $objadministrator = Preprofessionalsuperadmin::where('document', '=', $documentstudent)->where('cod_faculty', '=', $faculty)->where('cod_carrers', '=', $career)->count();

    }
    public function forValidateActivityStudent($request,$user){
        $objupdatestudents = PreprofessionalActivity::findOrFail($request->id_actividad);
        $objupdatestudents->approved=$request->veredicto;
        $objupdatestudents->obs_approved=$request->obs_veredict;
        $objupdatestudents->observation=$request->observation;
        $objupdatestudents->description=$request->description;
        $objupdatestudents->id_user_approved=$user;
        $objupdatestudents->date_approved=date(Utils::getFormatDateSQL(true,false));
        $objupdatestudents->save();

    }
    public function forShowNameInstituttion($id){
        $objinstitution = DB::connection('sqlsrv_modulos')
            ->table('Preprofesionales.institution as in')
            ->where('in.id', $id)
            ->where('in.status', '=', 'A')
            ->select('in.name')
            ->pluck('name')->toArray();
        return $objinstitution[0];
    }


    private function getLevelStudent($userID,$career){
        return (DB::connection('sqlsrv_bdacademico')->select("SELECT DISTINCT COD_ESTUDIANTE,concat(NIVEL,' SEMESTRE') as NIVEL
                                 FROM TB_ORDEN_PAGO OP
                                WHERE CONCEPTO LIKE 'MATRI%'
                                  AND CANCEL = 'S'
                                  AND COD_RUBRO IN (SELECT COD_RUBRO FROM BdAcademico.dbo.TB_RUBRO WHERE COD_CRUBRO = 1)
                                  AND NIVEL >= 6
                                  AND COD_ESTUDIANTE = ?
                                  AND COD_CARRERA = ?
                                  AND COD_PLECTIVO IN (SELECT COD_PLECTIVO
                                FROM TB_PLECTIVO
                                WHERE DESCRIPCION IN (     
                                  SELECT DESCRIPCION
                                FROM TB_PLECTIVO_ACTIVO PA
                                  WHERE ESTADO = 'A'
                                    AND PA.TIPO = 'SEMESTRAL'))
                                UNION
                                SELECT DISTINCT COD_ESTUDIANTE,concat(NIVEL,' ANIO') as NIVEL
                                 FROM TB_ORDEN_PAGO OP
                                WHERE CONCEPTO LIKE 'MATRI%'
                                  AND CANCEL = 'S'
                                  AND COD_RUBRO IN (SELECT COD_RUBRO FROM BdAcademico.dbo.TB_RUBRO WHERE COD_CRUBRO = 1)   
                                  AND COD_ESTUDIANTE = ?
                                  AND COD_CARRERA = ?
                                  AND COD_PLECTIVO IN (SELECT COD_PLECTIVO
                                FROM TB_PLECTIVO
                                WHERE DESCRIPCION IN (     
                                  SELECT DESCRIPCION
                                FROM TB_PLECTIVO_ACTIVO PA
                                  WHERE ESTADO = 'A'
                                    AND PA.TIPO = 'ANUAL'))",[$userID,$career,$userID,$career]));
    }

    public function forStudentAccessValid($career,$userID,$flag=false){
        $result=$this->getLevelStudent($userID,$career);

        if($flag==false){
            $result=count($result);
        }

        if($result==0){
            $msgJSON=['EL ESTUDIANTE CON IDENTIFICACION: '.$userID.' NO SE ENCUENTRA HABILITADO PARA INICIAR EL PROCESO'];
            if($flag){
                return $msgJSON;
            }
            return response()->json($msgJSON, 500);
        }

        $objUserPreprofessional=PreprofessionalUsers::where('document','=',$userID)
            ->where('cod_carrer','=',$career)->first();
        if($objUserPreprofessional==null){
            if($flag){
                return ['CANTIDAD'=>0,'NIVEL'=>$result[0]->NIVEL];
            }
            return response()->json(['OK'], 200);
        }else{
            if($objUserPreprofessional->status_asignation=='P'){
                $msgJSON=['EL ESTUDIANTE CON IDENTIFICACION: '.$userID.' YA SE ENCUENTRA INGRESADO EN EL SISTEMA A LA ESPERA DE UNA ASIGNACION DE TUTOR'];
                if($flag){
                    return $msgJSON;
                }
                return response()->json($msgJSON, 500);
            }
            if($objUserPreprofessional->status_asignation=='A'){
                $msgJSON=['EL ESTUDIANTE CON IDENTIFICACION: '.$userID.' YA SE ENCUENTRA ASIGNADO A UNA INSTITUCION'];
                if($flag){
                    return $msgJSON;
                }
                return response()->json($msgJSON, 500);
            }
            if($objUserPreprofessional->status_asignation=='C'){
                $msgJSON=['EL ESTUDIANTE CON IDENTIFICACION: '.$userID.' YA CULMINÓ CON EL PROCESO DE PRÁCTICAS PRE-PROFESIONALES'];
                if($flag){
                    return $msgJSON;
                }
                return response()->json($msgJSON, 500);
            }
            if($objUserPreprofessional->status_asignation=='R'){
                $msgJSON=['EL ESTUDIANTE CON IDENTIFICACION: '.$userID.' SE ENCUENTRA EN ESTADO RECHAZADO'];
                if($flag){
                    return ['CANTIDAD'=>0,'NIVEL'=>$result[0]->NIVEL,'STATUS'=>'R'];
                }
                return response()->json($msgJSON, 500);
            }
        }
    }

    public function forStudentAccessInscription(Request $request,$career,$user){
        DB::connection('sqlsrv_modulos')->beginTransaction();
        try {
        $msgJSON=$this->forStudentAccessValid($career,$user->name,true);
        if(count($msgJSON)==2){
            $objSelect=new SelectController();
            $codFaculty=$objSelect->getNameMateriaCarreraFacultad('CARRERA',[$career],'http')[0];
            $objAutoridadCatalog=AutoridadCatalog::where('carrera','=',$career)->where('tipoAutoridad','=',3)->firstOrFail();
            $objPreprofessionalUsers= new PreprofessionalUsers();
            $objPreprofessionalUsers->document=$user->name;
            $objPreprofessionalUsers->first_name=$user->first_name;
            $objPreprofessionalUsers->last_name=$user->last_name;
            $objPreprofessionalUsers->institution_email=$request->emailInstitucional;
            $objPreprofessionalUsers->alternative_email=$request->emailPersonal;
            $objPreprofessionalUsers->phone=$request->telefono;
            $objPreprofessionalUsers->semester=$msgJSON['NIVEL'];
            $objPreprofessionalUsers->status='A';
            $objPreprofessionalUsers->cod_faculty=$codFaculty->COD_FACULTAD;
            $objPreprofessionalUsers->cod_carrer=$career;
            $objPreprofessionalUsers->created_by=$user->id;
            $objPreprofessionalUsers->updated_by=$user->id;
            $objPreprofessionalUsers->created_ip=$request->ip();
            $objPreprofessionalUsers->updated_ip=$request->ip();
            $objPreprofessionalUsers->status_asignation='P';
            $objPreprofessionalUsers->hours_all_institution='0';
            $objPreprofessionalUsers->direccion=$request->direccion;
            $objPreprofessionalUsers->save();


            $dia=date('d');
            \Carbon\Carbon::setLocale('es');
            $mes=\Carbon\Carbon::now()->format('F');
            $anio=date('Y');

            $nombre_estudiante=$user->fullName();
            $nuic=$user->name;
            $email=$request->emailInstitucional;
            $direccion=$request->direccion;
            $telefono=$request->telefono;
            $nombre_carrera=$codFaculty->NOMBRE_CARRERA;
            $nombre_facultad=$codFaculty->NOMBRE_FACULTAD;

            $director_carrera=$objAutoridadCatalog->nombres;
            $nivel=$msgJSON['NIVEL'];

            $identity=uniqid();
            $token=bcrypt($identity);

            $pdf = \PDF::loadView('preprofessional.template.inscripcion',
                compact('dia','mes',
                    'token','anio','nombre_estudiante','nuic','email','telefono','direccion','nombre_carrera','nivel','nombre_facultad','director_carrera'));

            \Storage::disk('ftp')->put("MODULOS/PREPROFESIONALES_PRACTICAS/FINS-$nuic-$identity.pdf", $pdf->output());


            $objPreprofessionalDocuments=new PreprofessionalDocuments();
            $objPreprofessionalDocuments->name_file="FINS-$nuic-$identity.pdf";
            $objPreprofessionalDocuments->file_path="PREPROFESIONALES_PRACTICAS/";
            $objPreprofessionalDocuments->type="FINS";
            $objPreprofessionalDocuments->created_by=$user->id;
            $objPreprofessionalDocuments->updated_by=$user->id;
            $objPreprofessionalDocuments->created_ip=$request->ip();
            $objPreprofessionalDocuments->updated_ip=$request->ip();
            $objPreprofessionalDocuments->token=$token;
            $objPreprofessionalUsers->documents()->save($objPreprofessionalDocuments);



            $this->sendEmail($request->emailInstitucional,$nombre_estudiante,$request->emailPersonal,$nombre_facultad,
                $nombre_carrera,'preprofessional.email.welcomeprospect','','','INSCRIPCIÓN AL PROCESO DE PRACTICAS PREPROFESIONALES');

            DB::connection('sqlsrv_modulos')->commit();



            MessagesPreprofessional::infoCustom('Estudiante inscrito correctamente, espera el email de confirmación en el que se notifique el tutor');
            return response()->json(['ok'], 200);
        }else{
            if(count($msgJSON)==3){
                MessagesPreprofessional::errorCustom(ifArrayNull($msgJSON,'STATUS','ERROR DE PROCESO INTERNO'));
            }else{
                MessagesPreprofessional::errorCustom(implode(',',$msgJSON));
            }
        }
        } catch (\Exception $e) {
            DB::connection('sqlsrv_modulos')->rollback();
            throw $e;
        }


    }

    public function sendEmail($toEmailInstitu,$nombre_estudiante,$toEmailPers,$NOMBRE_FACULTAD,$NOMBRE_CARRERA,$template,$fecha=''
        ,$obs='',$ASUNTO){
        try {
        $markdown = new Markdown(view(), config('mail.markdown'));
        $objEmailQueue = new EmailQueue();
        $data['toEmail']=$toEmailInstitu;
        $data['fromName']='Pre-Profesionales';
        $data['nameStudent'] = $nombre_estudiante;
        $data['faculty'] = $NOMBRE_FACULTAD;
        $data['carrer'] = $NOMBRE_CARRERA;
        $data['fecha'] = $fecha;
        $data['obs'] = $obs;

        $objEmailQueue->fill(['COD_ESTUDIANTE' => Auth::user()->name
            , 'NOMBRE_COMPLETO' => $nombre_estudiante
            , 'EMAIL_INSTITUCIONAL' => $toEmailInstitu
            , 'EMAIL_PERSONAL' => $toEmailPers
            , 'EMAIL_SIUG' => null
            , 'PROCESO_CORREO' => 'CONCURSO_MERITOS_INSCRIPCION'
            , 'FECHA_REGISTRO' => Utils::getDateSQL()
            , 'FECHA_PROCESO'
            , 'ESTADO' => 'I'
            , 'ASUNTO' => $ASUNTO
            , 'CONTENIDO_CORREO' =>
                $markdown->render($template,['data'=>$data])
            , 'CC' => null
            , 'CCO' => null
            , 'OBSERVACION' => null]);
        $objEmailQueue->save();
    }catch (\Exception $ex){
throw new \Exception('Error al procesar el correo electrónico: '.$ex->getMessage());
}
    }

    public function sendEmailAssigmentTutoria($objStudent, $institution, $career,$dataPerson,$emailCC,$link)
    {
        try {
            $markdown = new Markdown(view(), config('mail.markdown'));
            $objEmailQueue = new EmailQueue();
            $Namestutor = $dataPerson->NOMBRE . ' ' . $dataPerson->APELLIDO;
            $emailDocentes = $dataPerson->EMAIL;

            $getresultevaluation = [
                'nuic' => $objStudent->document,
                'student' => $objStudent->fullName(),
                'email_student' => $objStudent->institution_email,
                'name_institution' => $institution->name,
                'type_institution' => $institution->type,
                'faculty' => $career->NOMBRE_FACULTAD,
                'career' => $career->NOMBRE_CARRERA,
                'nameTutor' => $Namestutor,
                'email_teacher' => $emailDocentes,'link'=>$link];

            $fromEmail = $objStudent->institution_email.';ernesto.liberio@gmail.com';//$emailDocentes;
            $fromEmailcc = $emailCC;

            $objEmailQueue->fill(['COD_ESTUDIANTE' => $objStudent->document
                , 'NOMBRE_COMPLETO' => $objStudent->fullName()
                , 'EMAIL_INSTITUCIONAL' => $fromEmail
                , 'EMAIL_PERSONAL' => $fromEmail
                , 'EMAIL_SIUG' => null
                , 'PROCESO_CORREO' => 'CONCURSO_MERITOS_INSCRIPCION'
                , 'FECHA_REGISTRO' => Utils::getDateSQL()
                , 'FECHA_PROCESO'
                , 'ESTADO' => 'I'
                , 'ASUNTO' => 'ASIGNACION DE TUTORIA PARA PRACTICAS PREPROFESIONALES'
                , 'CONTENIDO_CORREO' =>
                    $markdown->render('preprofessional.email.emailtutorassignment', ['data' => $getresultevaluation])
                , 'CC' => $fromEmailcc
                , 'CCO' => null
                , 'OBSERVACION' => null]);
            $objEmailQueue->save();
        }catch (\Exception $ex){
            throw new \Exception('Error al procesar el correo electrónico: '.$ex->getMessage());
        }
    }
}