<?php

Route::group(['middleware' => ['role:SUPMIN|ADMINTITULACION|ACADOCENTE']], function ()
{
    Route::group(['prefix' => 'titulacion', 'as' => 'titulacion.'], function ()
    {
        Route::group(['middleware' => ['titulacion_date_enabled:EC']], function ()
        {
            Route::group(['prefix' => 'complexivo', 'as' => 'complexivo.'], function ()
            {
                Route::get('notas', 'Titulacion\ExamencomplexivoController@index')->name('notas.index');
                Route::get('getDtExamenComplexivo/{idcarrera}', 'Titulacion\ExamencomplexivoController@getDtExamenComplexivo');
                Route::post('store/{idmatricula}/{num_secuencia}', 'Titulacion\ExamencomplexivoController@store');
            });

        });

        Route::group(['middleware' => ['titulacion_date_enabled:CONF']], function ()
        {
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

        Route::group(['middleware' => ['titulacion_date_enabled:TUTORIAS']], function ()
        {
            Route::get('Tutorias-data', 'Titulacion\TutoriaController@datatables');
            Route::get('Tutorias', 'Titulacion\TutoriaController@index')->name('tutorias.index');
            Route::post('TutoriasStore', 'Titulacion\TutoriaController@store')->name('tutorias.store');
        });

        Route::group(['middleware' => ['titulacion_date_enabled:REVISIONES']], function ()
        {
            Route::get('Revisiones', 'Titulacion\RevisionController@index')->name('revisiones.index');
            Route::post('RevisionesStore', 'Titulacion\RevisionController@store')->name('revision.store');
        });

        Route::group(['middleware' => ['titulacion_date_enabled:TRABAJOTIT']], function ()
        {
            Route::group(['prefix' => 'trabajo', 'as' => 'trabajo.'], function ()
            {
                /** INGRESO DE NUEVOS TRABAJOS DE TITULACIÓN **/
                Route::get('TrabajoInscripcion',                     'Titulacion\UserInscripcionController@index')->name('inscripcion.index');
                Route::post('DatoUsuario/{cedula}',                  'Titulacion\UserInscripcionController@parametros');
                Route::post('DatoUsuarioEstudianteCarrera/{cedula}', 'Titulacion\UserInscripcionController@parametrosestudianteCarrera');
                Route::post('DatosTrabajoTitulacion/{carrera}',      'Titulacion\UserInscripcionController@DatosTrabajoTitulacion');
                Route::post('AreaInvestigacionCarrera/{carrera}',    'Titulacion\UserInscripcionController@AreaInvestigacionCarrera');
                Route::get('TrabajoInscripcionEdit/{codigo}',        'Titulacion\UserInscripcionController@edit')->name('TrabajoInscripion.edit');
                Route::get('tesis-data',                             'Titulacion\UserInscripcionController@datatables');
                Route::post('TemaStore',                             'Titulacion\UserInscripcionController@store')->name('tema.store');

                /** ASIGNACIÓN TUTOR A TRABAJO DE TITULACIÓN **/
                Route::get('tesis-docente-data',            'Titulacion\DocenteInscripcionController@datatables');
                Route::post('DatoDocente/{cedula}',         'Titulacion\DocenteInscripcionController@getDocenteTesis');
                Route::post('DatoDocenteCarreras/{cedula}', 'Titulacion\DocenteInscripcionController@getDocenteCarreras');
                Route::post('DocenteStore',                 'Titulacion\DocenteInscripcionController@store')->name('docente.store');

                Route::post('EstudianteStore',   'Titulacion\EstudianteInscripcionController@store')->name('estudiante.store');
                Route::get('NotasTitulacion', 'Titulacion\TitulacionController@getNotasTitulacion')->name('NotasTitulacion.getNotasTitulacion');
                Route::get('notas-titulacion', 'Titulacion\TitulacionController@getDataNotasTitulacion');
                Route::post('StoreNota/{idestudiante}/{idtesis}', 'Titulacion\TitulacionController@SaveNotaTitulacion');

                Route::get('NotasGeneralTitulacion','Titulacion\TitulacionController@getNotasGeneralTitulacion')->name('NotasGeneralTitulacion.getNotasGeneralTitulacion');
                Route::get('data-notas-titulacion/{codcarrera}', 'Titulacion\TitulacionController@getDataNotasGenTitulacion');


                Route::post('StoreNotasGeneral', 'Titulacion\TitulacionController@saveNotasGenTitulacion');
            });


        });

    });
});


