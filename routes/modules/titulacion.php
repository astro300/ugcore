<?php

Route::group(['middleware' => ['role:SUPMIN|ADMINTITULACION']], function () {
    Route::group(['prefix' => 'titulacion', 'as' => 'titulacion.'], function () {

        Route::group(['middleware' => ['titulacion_date_enabled:EC']], function () {
            Route::group(['prefix' => 'complexivo', 'as' => 'complexivo.'], function () {


                Route::get('notas', 'Titulacion\ExamencomplexivoController@index')->name('notas.index');
                Route::get('datatables/{idcarrera}', 'Titulacion\ExamencomplexivoController@getDatatable');
                Route::post('store/{idmatricula}', 'Titulacion\ExamencomplexivoController@store');

            });

        });

        Route::group(['middleware' => ['titulacion_date_enabled:CONF']], function () {
            Route::get('Configuraciones', 'Titulacion\ConfiguracionController@index')->name('configuraciones.index');
            Route::get('configuraciones-data', 'Titulacion\ConfiguracionController@datatables');

            Route::get('configuraciones_edit/{codigo}', 'Titulacion\ConfiguracionController@edit')->name('configuracion.edit');
            Route::get('configuraciones_delete/{codigo}', 'Titulacion\ConfiguracionController@delete')->name('configuracion.delete');
            Route::put('configuraciones_update/{datos}', 'Titulacion\ConfiguracionController@update')->name('configuraciones.update');

            Route::post('ConfiguracionesStore', 'Titulacion\ConfiguracionController@store')->name('configuraciones.store');
            Route::post('Configuraciones/{facultad}', 'Titulacion\ConfiguracionController@carreras');

            Route::post('Configuraciones-Parametro/{parametros}', 'Titulacion\ConfiguracionController@parametros');
            Route::post('Configuraciones-Plectivo/{plectivos}', 'Titulacion\ConfiguracionController@plectivos');
        });

        Route::group(['middleware' => ['titulacion_date_enabled:TUTORIAS']], function () {
            Route::get('Tutorias', 'Titulacion\TutoriaController@index')->name('tutorias.index');
            Route::post('TutoriasStore', 'Titulacion\TutoriaController@store')->name('tutorias.store');
        });

        Route::group(['middleware' => ['titulacion_date_enabled:REVISIONES']], function () {
            Route::get('Revisiones', 'Titulacion\RevisionController@index')->name('revisiones.index');
            Route::post('RevisionesStore', 'Titulacion\RevisionController@store')->name('revision.store');
        });

        Route::group(['middleware' => ['titulacion_date_enabled:TRABAJOTIT']], function () {
            Route::group(['prefix' => 'trabajo', 'as' => 'trabajo.'], function () {

                Route::get('TrabajoInscripcion', 'Titulacion\UserInscripcionController@index')->name('inscripcion.index');
                Route::post('DatoUsuario/{parametros}', 'Titulacion\UserInscripcionController@parametros');


            });


        });

    });


});