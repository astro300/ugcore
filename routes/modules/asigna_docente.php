<?php
Route::group(['prefix' => 'academico', 'as'=>'academico.'],function(){
	Route::group(['prefix' => 'docente','as'=>'docente.'],function(){
		Route::resource('asigna_docente','Asigna_docente\AsignaDocenteController');
		Route::post('carreras','Asigna_docente\AsignaDocenteController@getCarreras')->name('carreras');
		Route::post('periodos','Asigna_docente\AsignaDocenteController@getPeriodos')->name('periodos');
		Route::post('buscadoc','Asigna_docente\AsignaDocenteController@getDocentes');
		Route::post('buscamat','Asigna_docente\AsignaDocenteController@getMaterias');
		Route::get('/buscaasig/{docente}/{plectivo}','Asigna_docente\AsignaDocenteController@getAsignaciones');
		Route::post('ingresadoc','Asigna_docente\AsignaDocenteController@createAsignacion')->name('ingresadoc');
		Route::get('/edit/{N_ID}','Asigna_docente\AsignaDocenteController@getDetalleUpd')->name('verdetalle');
		Route::get('/dacade/{docente}','Asigna_docente\AsignaDocenteController@getDAcad');
		Route::post('guardacarrera','Asigna_docente\AsignaDocenteController@createCarrera')->name('guardacarrera');
		Route::post('guardaestado','Asigna_docente\AsignaDocenteController@actuEstado')->name('guardaestado');
		Route::get('/dacademat/{nid}','Asigna_docente\AsignaDocenteController@getDAcadMatNID');
		Route::post('cambiamateria','Asigna_docente\AsignaDocenteController@actualizaMateria')->name('cambiamateria');
		Route::post('borramateria','Asigna_docente\AsignaDocenteController@borraMateria')->name('borramateria');
	});
});