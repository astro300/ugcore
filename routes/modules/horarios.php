<?php
Route::group(['prefix' => 'academico','as'=>'academico.'],function(){
    Route::group(['prefix' => 'docente','as'=>'docente.'],function(){
        Route::resource('horarios','Horarios\HorariosController');
        Route::post('carreras','Horarios\HorariosController@getCarreras')->name('carreras');
        Route::post('periodos','Horarios\HorariosController@getPeriodos')->name('periodos');
    });
});
