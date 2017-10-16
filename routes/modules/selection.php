<?php
/*
 *ADMINMERITOS
JURADOMERITOS
ACADOCENTE
DEFAULT
 * */


Route::namespace('Selection')->group(function () {
    Route::group(['prefix' => 'selection', 'as'=>'selection.' ], function () {
        Route::post('participation-cantones-{provincia}', 'ProcessController@getCantonesProvincia');
        Route::group(['middleware' => ['role:ADMINMERITOS|SUPMIN']], function () {
            Route::pattern('category', '[0-9]+');
            Route::resource('category', 'CategoryController', ['except' => ['create', 'destroy', 'show']]);
            Route::get('category/datatables', 'CategoryController@datatableCategories');

            Route::pattern('typedocument', '[0-9]+');
            Route::resource('typedocument', 'TypeDocumentController', ['except' => ['create', 'destroy', 'show']]);
            Route::get('typedocument/datatables', 'TypeDocumentController@datatableTypeDocuments')->name('typedocument.datatables');
            Route::get('typedocument/fields-documents/{id}', 'TypeDocumentController@fieldsTypeDocuments')->name('typedocument.fields');
            Route::post('fields-document/{id}', 'TypeDocumentController@getFieldDocument');

            Route::post('fields-document-update/{id}', 'TypeDocumentController@updateFieldDocument')->where(['id' => '[0-9]+']);
            Route::post('fields-document-save/{id}', 'TypeDocumentController@saveFieldDocument')->where(['id' => '[0-9]+']);

            Route::pattern('config', '[0-9]+');
            Route::resource('config', 'ConfigController', ['except' => ['create', 'destroy', 'show']]);
            Route::get('config/concepts/{concourseConfig}', 'ConfigController@concourseConcepts')->name('config.concourseconcepts');
            Route::post('config/conceptput/{concourseConfig}', 'ConfigController@conceptPutConcourse')->name('config.conceptput');
            Route::get('config/conceptedit/{conceptConcourse}', 'ConfigController@editConcourseConcepts')->name('config.editConcourseConcepts');
            Route::post('config/conceptupdate/{conceptConcourse}', 'ConfigController@updateConcourseConcepts')->name('config.updateConcourseConcepts');
            Route::get('config/datatables', 'ConfigController@datatableConcourseConfig');


            Route::get('config/comisiones/{concourseConfig}/{code?}', 'ConfigController@configConcourseComisiones')->name('config.comisiones');
            Route::post('config/matriz/save/{concourseConfig}', 'ConfigController@saveOrUpdateComisiones')
                ->name('config.saveOrUpdateComisiones');





            Route::get('config/matriz/{concourseConfig}/{code?}', 'ConfigController@matrizConcourseConfig')
                ->name('config.matriz');

            Route::get('delete/matriz/{concourseConfig}/{meritConcourseConfigMatriz?}', 'ConfigController@deleteMatrizConcourseConfig')
                ->name('delete.matriz');


            Route::post('config/matriz/save/{concourseConfig}/{code}', 'ConfigController@saveOrUpdateMatrizConcourse')
                ->name('config.saveOrUpdateMatriz');




            Route::get('config/steps/{id}', 'ConfigController@concourseSteps')->name('config.concoursesteps');
            Route::put('config/stepsave/{id}', 'ConfigController@saveSteps')->name('config.stepsave');


            Route::get('config/conceptdocfiles/{meritConcourseConfig}', 'ConfigController@concourseConceptDocFiles')->name('config.conceptdocfiles');
            Route::post('config/conceptdocfiles-save', 'ConfigController@saveConcourseConceptDocFiles')->name('config.saveconceptdocfiles');

            /************FIN DE RUTAS DE MENU CONFIGURACION PROCESO DE MERITOS**************************************************/

        });
    });
    Route::group(['prefix' => 'selection', 'as'=>'process.' ], function () {
        Route::group(['middleware' => ['role:ADMINMERITOS|SUPMIN|JURADOMERITOS']], function () {
            Route::get('selection-config-validation-index', 'ValidationController@indexValidation')->name('validation.index');
            Route::get('selection-config-validation-users-{id}', 'ValidationController@validationConcourse')->name('validation.user');
            Route::post('selection-config-validation-document', 'ValidationController@validationDocumentConcourse');
            Route::get('selection-config-validation-finish-{id}-{user}-{aditional}', 'ValidationController@validationFinishConcourse')->name('validation.finish');

            Route::post('selection-config-statistics', 'ValidationController@statisticsConcourse');
            Route::post('selection-config-statistics-global', 'ValidationController@statisticsGlobalConcourse');
            Route::get('selection-config-statistics-postulants-{id}', 'ValidationController@reportConcoursePostulants');
            Route::get('selection-config-statistics-validations-{id}', 'ValidationController@reportConcourseValidations');

        });

        Route::get('process', 'ProcessController@index')->name('user.index');
        Route::post('process/matriz/save/{concourseConfig}/{meritConcourseConfigMatriz}/{type}', 'ProcessController@assigmentMatrizConcourse')
            ->name('user.saveAssigmentMatriz');

        Route::get('process/{id}', 'ProcessController@show')->name('user.show');
        Route::get('process-participation-{id}', 'ProcessController@create')->name('user.create');
        Route::post('selection-config-update-data-{id}-{users}', 'ProcessController@updateDataPersonUser')->name('user.updateDataPerson');
        Route::get('process-finish-participation-{id}', 'ProcessController@finishconcourse')->name('user.finish');
        Route::post('config/upload', 'ProcessController@uploadAndPutDocument');
        Route::get('process-report-template-{id}', 'ProcessController@reportTemplate')->name('user.report.template');
        Route::post('process-upload-file-fields', 'ProcessController@uploadAndPutDocumentWithFields');
        Route::post('process-delete-fields', 'ProcessController@deleteDocumentWithFields');
        Route::post('process-add-fields', 'ProcessController@addDocumentWithFields');
        Route::post('process-deleteDetail-{meritInputDetail}', 'ProcessController@deleteDocumentDetail')->name('document.deleteDetail');
    });


});

Route::get('/document/file-ftp/{directory}/{file}', function ($directory=null,$file = null) {
    try{
        $fileContent=Storage::disk('ftp')->get("MODULOS/CONCURSO_MERITOS/$directory/$file");
    }catch (\Exception $ex){
        $fileContent=Storage::disk('public')->get('notfound.pdf');
    }
    return Response::make($fileContent, '200', array(
        'Content-Type' => 'application/pdf'
    ));

})->name('document.concourse');

Route::get('/photo/file-ftp/{file}', function ($file = null) {
    try{
        $fileContent=Storage::disk('ftp')->get("MODULOS/CONCURSO_MERITOS_FOTOS/$file");
    }
    catch(\Exception $ex){
        return Response::download(public_path('images/none.png') );
    }

    return Response::make($fileContent, '200');
})->name('photo.concourse');