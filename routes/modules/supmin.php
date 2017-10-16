<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 22/5/2017
 * Time: 11:13
 */

Route::group(['middleware' => 'role:SUPMIN|ADMINTITULACION'], function () {
    Route::get('exceptions/index', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('exceptions.index');

    Route::pattern('role','[0-9]+');
    Route::resource('roles','Security\RolesController',['except'=>['destroy','show']]);
    Route::get('roles/options/{role}','Security\RolesController@rolesoptions')->name('roles.rolesoptions');
    Route::post('roles/save/options/{role}','Security\RolesController@saverolesoptions')->name('roles.saverolesoptions');
    Route::get('roles/eliminar/{role}','Security\RolesController@destroy')->name('roles.destroy');

    Route::pattern('user','[0-9]+');
    Route::resource('users','Security\UsersController',['except'=>['destroy','show']]);
    Route::get('users/eliminar/{user}','Security\UsersController@destroy')->name('users.destroy');
    Route::get('users/roles/{user}','Security\UsersController@usersRoles')->name('users.users_roles');
    Route::post('users/roles/store/{user}','Security\UsersController@storeRolesUser')->name('users.store_roles');


    Route::pattern('option','[0-9]+');
    Route::resource('options','Security\OptionsController',['except'=>['destroy','show']]);
    Route::get('options/eliminar/{option}','Security\OptionsController@destroy')->name('options.destroy');



    Route::group(['prefix' =>'catalogos', 'as'=>'catalogos.'],function() {
        Route::pattern('autoridades', '[0-9]+');
        Route::resource('autoridades', 'Catalogos\AutoridadesController', ['except' => ['destroy','show']]);
        Route::get('autoridades/eliminar/{autoridade}','Catalogos\AutoridadesController@destroy')->name('autoridades.destroy');
        Route::get('autoridades/datatables', 'Catalogos\AutoridadesController@datatable')->name('autoridades.datatable');
    });
});
