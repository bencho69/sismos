<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontController@index');

Route::post('guardaENC', 'cuestionarioController@encuesta');
Route::get('cuestionario', 'cuestionarioController@cuestionario');
Route::get('quienes_somos', 'FrontController@quienes_somos');

// El log permite autorizar el login de entrada.
Route::resource('log', 'LogController');

// Seccion de rutas de Usuarios Registrados
Route::group(['middleware' => 'auth'], function () {

   // Rutas generales

	// Authentication routes...
	Route::resource('usuarios', 'UsuarioController');
   // Catalogo de Sismos
   Route::resource('misismos', 'misismosController');
   Route::get('sel_sismo/{sismo}', 'encuestaController@sel_sismo')->name('encuestas.sel_sismo');
      // Catalogo de Sismos
   //Route::get('sismos/index','sismosController@index');
   //Route::get('sismos/edit/{id}','sismosController@edit')->name('sismos.edit');  
   //Route::get('sismos/destroy','sismosController@destroy')->name('sismos.destroy');
   //Route::get('sismos/create','sismosController@create')->name('sismos.create');  
   // Encuestas
   Route::resource('encuestas','encuestaController');

   Route::get('logout', 'LogController@logout');
   Route::get('perfil', 'FrontController@perfil')->name('perfil');
   Route::get('auth.edit/{id}', 'FrontController@edit')->name('edit');
   Route::put('auth.update/{id}', 'FrontController@update')->name('update');
   Route::get('subirAvatar', 'StorageController@subirAvatar')->name('subirAvatar');
   Route::post('temp/crearAvatar', 'StorageController@GuardarAvatar');

   //Reportes del Sistema
   Route::get('reportes/index', 'reportesController@index');
   Route::get('reportes/cual/{id}','reportesController@cual')->name('reportes.cual');
   Route::get('reporteA', 'reportesController@ReporteA');
   Route::get('reporteB', 'reportesController@ReporteB');
   Route::get('reporteC', 'reportesController@ReporteC');

});
