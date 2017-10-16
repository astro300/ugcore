<?php
Route::group(['prefix' => 'uath', 'as'=>'uath.'],function(){
    Route::group(['prefix' => 'horasextras','as'=>'horasextras.'],function(){
        //Route::pattern('horasextras', '[0-9]+');
        Route::resource('planificacion','Uath\HorasExtrasController', ['except' => ['create', 'destroy', 'show']]);
        Route::get('buscadatosfun/{cedula}','Uath\HorasExtrasController@getDatosFuncionario');
        Route::get('horariopersona/{cedula}','Uath\HorasExtrasController@getDatosFunHorario');
        Route::get('calculo/{cedula}','Uath\HorasExtrasController@getCalculo');
        Route::post('creaplani/{uni}/{per}/{fec}/{des}','Uath\HorasExtrasController@createPlanificacion')->name('creaplani');
        Route::get('planinfo','Uath\HorasExtrasController@getDatosPlanificacion');
        Route::post('borraplanificacion/{id}','Uath\HorasExtrasController@borraPlanificacion')->name('borraplanificacion');
        Route::post('borraplanificacion/{id}','Uath\HorasExtrasController@borraPlanificacion')->name('borraplanificacion');
        Route::get('empleados/{id}','Uath\HorasExtrasController@empleadosPlanificacion')->name('empleados');
    });
});