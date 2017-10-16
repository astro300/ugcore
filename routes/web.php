<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test',function (){

    $dia=date('d');
    \Carbon\Carbon::setLocale('es');
    $mes=\Carbon\Carbon::now()->format('F');
    $anio=date('Y');

    $nombre_estudiante=Auth::user()->fullName();
    $nuic=Auth::user()->name;
    $email=Auth::user()->email;

    $nombre_carrera='INGENIERIA EN SISTEMAS COMPUTACIONALES';
    $director_email='MATEMATICAS Y FISICAS';
    $director_carrera='INELDA MARTILLO';
    $nombre_empresa='7 semestre';
    $fecha_inicio=Utils::getDateSQL();
    $fecha_fin=Utils::getDateSQL();
    $nombre_tutor='sfgsfgsfgsf';
    $cargo_representante='ANALISTA 3';
    $nombre_representante='ERNESTO LIBERPO';


    $pdf = \PDF::loadView('preprofessional.template.cartaInsercion',
        compact('dia','mes',
            'anio','nombre_estudiante','nuic','email','fecha_inicio','fecha_fin',
            'nombre_carrera','nombre_empresa','director_email','director_carrera','nombre_tutor','cargo_representante','nombre_representante'));

    \Storage::disk('ftp')->put('MODULOS/ddd.pdf', $pdf->output());
    return $pdf->stream('_ficha_inscripcion.pdf');

});



Route::get('/', function () {
    if(Auth::guest()){
        return view('welcome');
    }
    return redirect('/home');

});

Auth::routes();
Route::get('register/verify/{token}', 'Auth\RegisterController@verify');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@searchOption')->name('search');
Route::get('/about', 'HomeController@about')->name('about');


Route::get('/images/{directory}/{file}', function ($directory=null,$file = null) {
    $url = storage_path() . "/app/public/files/modules/{$directory}/{$file}";
    if (file_exists($url)) {
        return Response::download($url);
    }
});



Route::group(['middleware' => 'auth'], function () {


    Route::get('/master/{router?}','HomeController@getRouter')->name('master');
    Route::group(['prefix' => 'admin' , 'as'=>'admin.'], function () {
        Route::group(['prefix' => 'users', 'as'=>'users.'], function () {
        Route::get('changePassword','Security\UsersController@changePassword')->name('changePassword');
        Route::post('postChangePassword','Security\UsersController@postChangePassword')->name('postChangePassword');
        });
        require __DIR__ . '/modules/supmin.php';

    });
    
    Route::get('file-ftp/{module}/{file}', function ($module=null,$file = null) {
        try{
            $fileContent=Storage::disk('ftp')->get("MODULOS/$module/$file");
        }catch (\Exception $ex){
            $fileContent=Storage::disk('public')->get('notfound.pdf');
        }
        return Response::make($fileContent, '200', array(
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$file.'"'
        ));
    })->name('fileGet');

    require __DIR__ . '/modules/select_dependence.php';
    require __DIR__ . '/modules/preprofessional.php';
    require __DIR__ . '/modules/horarios.php';
    require __DIR__ . '/modules/asigna_docente.php';
	require __DIR__ . '/modules/HorasExtras.php';
    require __DIR__ . '/modules/forum.php';
    require __DIR__ . '/modules/selection.php';
    require __DIR__ . '/modules/titulacion.php';

});