<?php

Route::group(['middleware' => ['role:SUPMIN|ADMINISTRADORPREPROFESIONALES']], function () {
    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){

        Route::resource('prospects','Preprofessional\UsersController');

        Route::get('Index','Preprofessional\UsersController@indexAdministrator')->name('prospects.indexadministrator');

        Route::post('IndexAdministrador','Preprofessional\UsersController@indexAdministratorNew')->name('prospects.indexadministratornew');

        Route::get('IndexAdministradorRetornar{faculty}/{career}','Preprofessional\UsersController@indexAdministratorReturn')->name('prospects.indexadministratorreturn');

        Route::get('IndexProspecto/{faculty}/{career}','Preprofessional\UsersController@index')->name('prospects.index');


            Route::get('CrearProspecto{faculty}/{career}','Preprofessional\UsersController@create')->name('prospects.create');
            Route::get('EditarProspectO{document}/{faculty}/{career}','Preprofessional\UsersController@edit')->name('prospects.updateprospects');
            Route::put('ActualizarProspecto{document}/{faculty}/{career}','Preprofessional\UsersController@update')->name('prospects.updateprospectsstudent');
            Route::post('CrearProspecto{faculty}/{career}','Preprofessional\UsersController@store')->name('prospects.newprospectus');




        Route::get('ResumenProspecto{document}/{faculty}/{career}','Preprofessional\UsersController@show')->name('prospects.summaryprospectus');

        Route::get('EnviarEmailProspecto{email_institu}/{nameStudent}/{faculty}/{carrer}/{facultys}/{career}','Preprofessional\UsersController@emailProspectoWelcome')->name('prospects.emailProspectoWelcome');

        Route::resource('prospects', 'Preprofessional\UsersController',
            ['only' => ['index','create','edit','update','store','show']]);


    });

    /*
//Rutas para las catedras integradoras
    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){


        Route::resource('cathedra','Preprofessional\CathedraController');

        Route::get('IndexCatedra{faculty}/{career}','Preprofessional\CathedraController@index')->name('cathedra.index');

        Route::get('CrearCatedra{faculty}/{career}','Preprofessional\CathedraController@create')->name('cathedra.createcathedra');

        Route::post('CrearCatedra{faculty}/{career}','Preprofessional\CathedraController@store')->name('cathedra.store');

        Route::get('AsignarCatedra','Preprofessional\CathedraController@edit')->name('cathedra.cathedraassignment');

        Route::get('AsignarEstudianteCatedra{id}/{faculty}/{career}','Preprofessional\CathedraController@asignemntStudent')->name('cathedra.asignemntstudent');

        Route::post('GuardarEstudianteCatedra{documentstudent}/{id}/{faculty}/{career}','Preprofessional\CathedraController@addAsignemntStudent')->name('cathedra.addasignemntstudent');

        Route::post('ValidarCedulaEstudiante{id}/{faculty}/{career}','Preprofessional\CathedraController@showDatosStudent')->name('cathedra.showDatosStudent');

        Route::get('EvaluacionEstudiantesCatedras{id}/{faculty}/{career}','Preprofessional\CathedraController@evaluationEstudent')->name('cathedra.EvaluationEstudent');

        Route::get('MostrarEstudiantes{id}/{faculty}/{career}','Preprofessional\CathedraController@show')->name('cathedra.show');

        Route::post('IngresoEstudiantesEvaluacion{id}/{faculty}/{career}','Preprofessional\CathedraController@storeEvaluation')->name('cathedra.storeevaluation');

        Route::get('BuscarEstudianteCatedras{faculty}/{career}','Preprofessional\CathedraController@searchEstudent')->name('cathedra.searchEstudent');

        Route::post('MostrarCatedrasEstudiantes{faculty}/{career}','Preprofessional\CathedraController@showStudentCathedras')->name('cathedra.showStudentcathedras');

        Route::resource('cathedra', 'Preprofessional\CathedraController',
            ['only' => ['index','create','store','edit','show']]);

    });*/


    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){

        Route::get('indexPracticasEmpresariales{faculty}/{career}','Preprofessional\PracticesController@index')->name('practices.index');

        Route::get('CrearInstitucion{faculty}/{career}','Preprofessional\PracticesController@create')->name('practices.create');

        Route::post('AgregarInstitucion{faculty}/{career}','Preprofessional\PracticesController@store')->name('practices.store');

        Route::get('AsignarEstudianteInstitucion/{id}/{faculty}/{career}','Preprofessional\PracticesController@assignmentStuentPractices')->name('practices.assignmentStuentpractices');

        Route::post('BusquedaEstudianteInstitucion{id}/{faculty}/{career}','Preprofessional\PracticesController@searchStuentPractices')->name('practices.searchStuentpractices');

        Route::post('AsignacionEstudianteInstituciones{id}/{faculty}/{career}', 'Preprofessional\PracticesController@addAssignmentStuentPractices')->name('practices.addassignmentStuentpractices');

        Route::get('MostrarEstudiante{id}/{faculty}/{career}','Preprofessional\PracticesController@show')->name('practices.show');


        Route::post('BuscarEstudianteDocumentos{faculty}/{career}','Preprofessional\PracticesController@shearchStudentDocument')->name('practices.shearchstudentdocument');

        Route::get('SubirDocumentosEstudiantesFinal{faculty}/{career}','Preprofessional\PracticesController@documents')->name('practices.documents');

        Route::post('GuardarDocumentosEstudiantesFinal{document}/{idestudent}/{faculty}/{career}','Preprofessional\PracticesController@documentUpload')->name('practices.documentupload');

        Route::post('ActualizarDocumentos','Preprofessional\PracticesController@updateDocuments')->name('practices.updateDocuments');

        Route::get('DescargarDocumentosEstudiantesFinal{id}','Preprofessional\PracticesController@downlandDocument')->name('practices.downlandDocument');

        Route::post('DescargarCertificadoCulminacion','Preprofessional\PracticesController@pdfCertificate')->name('practices.pdfCertificate');

        Route::get('EmailCeritifacionEstudiante{id}','Preprofessional\PracticesController@emailCertificateStudent')->name('practices.emailcertificatestudent');

        Route::resource('PracticasEmpresariales', 'Preprofessional\PracticesController',
            ['only' => ['index','create','store','show']]);

    });

});



Route::group(['middleware' => ['role:SUPMIN|ESTUDIANTEPREPROFESIONALES|ACAESTUDIANTE']], function () {

    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){

        Route::get('indexActividadEstudiante','Preprofessional\StudentProcessActivityController@index')->name('student.indexActivity');

        Route::get('ActividadEstudiante{documentstudent}','Preprofessional\StudentProcessActivityController@create')->name('student.CreateActivity');

        Route::post('CrearActividadEstudiante{idStudent}','Preprofessional\StudentProcessActivityController@store')->name('student.StoreActivity');

        Route::post('updateActividadEstudiante','Preprofessional\StudentProcessActivityController@updateActivityDescription')->name('student.updateActivityDescription');
        Route::get('deleteActivity/{preprofessionalActivity}','Preprofessional\StudentProcessActivityController@deleteActivity')->name('student.deleteActivity');


        Route::get('PDFActividad{idStudent}','Preprofessional\StudentProcessActivityController@pdfActivity')->name('student.pdfactivity');

        Route::resource('ActividadEstudiantes', 'Preprofessional\StudentProcessActivityController',
            ['only' => ['index','create','store']]);

        Route::get('indexInscripcion','Preprofessional\StudentProcessController@indexInscripcion')->name('student.indexInscripcion');
        Route::post('validateInscripcion/{career}','Preprofessional\StudentProcessController@validateInscripcion');
        Route::post('saveInscripcion/{career}','Preprofessional\StudentProcessController@saveInscripcion');


    });



//Evaluaciones y Documentos
    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){

        Route::get('indexEvaluacionEstudiante','Preprofessional\StudentProcessEvaluationController@index')->name('student.indexEvaluation');

        Route::post('CrearEvaluacionEstudiante{documentstudent}','Preprofessional\StudentProcessEvaluationController@store')->name('student.StoreEvaluation');

        Route::get('PDFEstudiante{document}/{value}','Preprofessional\StudentProcessEvaluationController@pdfEvaluationStudent')->name('student.pdfevaluationStudent');

        Route::get('downlanddevaluation{document}','Preprofessional\StudentProcessEvaluationController@indexEvaluationDownland')->name('student.indexevaluationdownland');

        Route::resource('EvaluacionEstudiante', 'Preprofessional\StudentProcessEvaluationController',
            ['only' => ['index','store']]);


        Route::get('indexDocumentosEstudiante','Preprofessional\StudentProcessController@indexDocument')->name('student.indexDocument');
        Route::get('DescargarDocumentosEstudiante-{value}','Preprofessional\StudentProcessController@downloadDocuments')->name('student.downloaddocuments');

        Route::get('uploadDocuments','Preprofessional\StudentProcessController@uploadDocument')->name('student.upload');

    });

});



Route::group(['middleware' => ['role:SUPMIN|ACADOCENTE|TUTORPREPROFESIONALES|ESTUDIANTEPREPROFESIONALES']], function () {

    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){
        Route::get('getActividadEstudiante/{preprofessionalActivity}',
            'Preprofessional\StudentProcessActivityController@getActividadEstudiante')->name('student.getActivityDescription')->where('preprofessionalActivity','[0-9]+');
    });
});


Route::group(['middleware' => ['role:SUPMIN|ACADOCENTE|TUTORPREPROFESIONALES']], function () {

    Route::group(['prefix' => 'preprofessional','as'=>'preprofessional.'],function(){

        Route::get('indexEstudianteTutoria','Preprofessional\ProcessTutorController@index')->name('tutor.indextutor');

        Route::post('indexEstudianteTutoriaNuevo/{cedula_tutor}','Preprofessional\ProcessTutorController@indexNew')->name('tutor.indexnew');

        Route::get('ResumenEstudianteTutoria/{documentid}/{document}/{documenttutor}/{faculty}/{career}','Preprofessional\ProcessTutorController@show')->name('tutor.showTutor');

        Route::get('EvaluacionEstudianteTutoria/{documentid}/{document}/{documenttutor}/{faculty}/{career}','Preprofessional\ProcessTutorController@create')->name('tutor.createEvaluacion');

        Route::get('EvaluacionEstudianteActivity/{documentid}/{document}/{documenttutor}/{faculty}/{career}','Preprofessional\ProcessTutorController@validateActivity')->name('tutor.validateActivity');


        Route::post('CrearEvaluationEstudianteTutor/{documentid}/{documenttutor}/{faculty}/{career}','Preprofessional\ProcessTutorController@store')->name('tutor.StoreTutorEvaluation');

        Route::get('ResumenEvaluacionesEstudianteTutoria/{documentid}/{documentutor}/{faculty}/{career}','Preprofessional\ProcessTutorController@showevaluationstudent')->name('tutor.showEvaluationStudent');

        Route::get('showdownlandlandEstudianteTutoria/{id}/{documentid}/{document}/{documenttutor}/{value}','Preprofessional\ProcessTutorController@pdfTutorEvaluationStudent')->name('tutor.pdfTutorEvaluationStudent');

        Route::resource('ProcesoTutor', 'Preprofessional\ProcessTutorController',
            ['only' => ['index','create','show','store']]);

        Route::post('validateActividadEstudiante','Preprofessional\StudentProcessActivityController@validateActividadEstudiante')->name('student.validateActivityDescription');
    });


});

Route::group(['middleware' => ['role:SUPMIN']], function () {
    Route::group(['as' => 'Preprofessional.'],function(){
        Route::get('UsuariosAdministradores','Preprofessional\SuperAdminController@index')->name('superadmin.create');
        Route::post('BusquedaUsuarioAdministradores','Preprofessional\SuperAdminController@shearch')->name('superadmin.shearch');
        Route::post('BusquedaUsuarioAdministradores{param}/{paramn}/{paramm}','Preprofessional\SuperAdminController@store')->name('superadmin.store');
        Route::resource('AdministradorPreprofesionales', 'Preprofessional\SuperAdminController',
            ['only' => ['index','store']]);
    });
});


Route::get('preprofesional/generate-qr',function (){
    $names=Auth::user()->fullName();
    $qrCode = new \Endroid\QrCode\QrCode($names);
    header('Content-Type: '.$qrCode->getContentType());
    return $qrCode->writeString();
})->name('generateQR');


Route::get('preprofesional/prospects/{faculty}/{career}', function ($faculty, $career, \Illuminate\Http\Request $request) {


    $result = \UGCore\Core\Entities\Preprofessional\PreprofessionalUsers::where('cod_faculty', '=', $faculty)
        ->where('cod_carrer', '=', $career)->where('status_asignation','=','P');


    if ($request->q != null) {
        $result = $result->where('document', 'like', "%" . $request->q . "%")->take(20)->get();
    } else {
        $result = $result->take(10)->get();
    }
    $json = [];
    foreach ($result as $row) {
        $json[] = ['id' => $row->id, 'text' => $row->fullName()];
    }
    return response()->json($json);
})->where(['faculty' => '[0-9]+', 'career' => '[0-9]+'])->name('prospects');
