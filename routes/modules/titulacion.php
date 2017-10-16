<?php

Route::group(['middleware' => ['role:SUPMIN|ADMINTITULACION']], function () {
    
    Route::group(['prefix' => 'titulacion','as'=>'titulacion.'],function(){

        Route::get('EjemploIndex','Titulacion\UserController@index')->name('configuracion.index');
        Route::post('EjemploStore','Titulacion\UserController@store')->name('configuracion.store');
        Route::get('Configuraciones','Titulacion\ConfiguracionController@index')->name('configuraciones.index');
       Route::post('ConfiguracionesStore','Titulacion\ConfiguracionController@store')->name('configuraciones.store');
        Route::post('Configuraciones/{facultad}','Titulacion\ConfiguracionController@carreras');
        Route::post('Configuraciones-Parametro/{parametros}','Titulacion\ConfiguracionController@parametros');
 

        Route::get('configuraciones-data','Titulacion\ConfiguracionController@datatables');
        Route::get('Revisiones','Titulacion\RevisionController@index')->name('revisiones.index');
       Route::post('RevisionesStore','Titulacion\RevisionController@store')->name('revision.store');

        Route::get('Tutorias','Titulacion\TutoriaController@index')->name('tutorias.index');
       Route::post('TutoriasStore','Titulacion\TutoriaController@store')->name('tutorias.store');

       //matriculacion

              Route::get('Tutorias','Titulacion\TutoriaController@index')->name('tutorias.index');

        Route::group(['prefix' => 'complexivo','as'=>'complexivo.'],function(){


            Route::get('notas','Titulacion\ExamencomplexivoController@index')->name('notas.index');
            Route::get('datatables/{idcarrera}','Titulacion\ExamencomplexivoController@getDatatable');
            Route::post('store/{idmatricula}','Titulacion\ExamencomplexivoController@store');

        });


    });
       //matriculacion

    Route::group(['prefix' => 'trabajo','as'=>'trabajo.'],function(){

        Route::get('TrabajoInscripcion','Titulacion\UserInscripcionController@index')->name('inscripcion.index');
       // Route::post('EjemploStore','Titulacion\UserController@store')->name('configuracion.store');
        Route::get('TrabajoRegistros','Titulacion\UserInscripcionController@ListadoTrabajoTitulacion');
        Route::get('NotasSustentacion','Titulacion\SustentacionController@index');

        Route::get('RegistroGeneralTitulacion','Titulacion\TitulacionController@index');
        Route::get('RegistroExamenComplexivo','Titulacion\TitulacionController@index');
 
    });


});