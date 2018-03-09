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

Route::get('/', function () {
	return redirect()->route('ADMIN');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//gestion-fichiers
Route::group(['prefix' => 'gestion-fichiers', 'middleware' => ['web', 'auth']], function () {
	Route::get('import-etudiant-form', 'Admin\GestionFicherController@importExport')->name('VIEW-IMPORT-ETUDIANTS');
	Route::get('downloadExcel/{type}', 'Admin\GestionFicherController@downloadExcel')->name('EXPORT-ETUDIANTS');
	Route::post('import-etudiants-post', 'Admin\GestionFicherController@importExcel')->name('POST-IMPORT-ETUDIANTS');
});

//gestion-utilisateurs
Route::get('dashboard', 'Admin\AdminController@index')->middleware(['web', 'auth'])->name('ADMIN');

Route::group(['prefix' => 'gestion-utilisateurs', 'middleware' => ['web', 'auth']], function () {
	//Route::get('dashboard"', 'AdminController@index')->name('ADMIN');
	Route::post('users/delete/{id}', 'Admin\UserController@delete')->name('users.delete');
	Route::get('users/data', 'Admin\UserController@data')->name('users.data');
	Route::resource('users', 'Admin\UserController');

});

//gestion-etudiants
Route::get('etudiants/aides', 'Admin\EtudiantController@aides')->name('etudiants.aides');
Route::get('etudiants/evolutions/{id}', 'Admin\EtudiantController@evolutions')->name('etudiants.evolutions');
Route::get('etudiants/info/{id}', 'Admin\EtudiantController@findinfo')->name('etudiants.findinfo');
Route::get('etudiants/all', 'Admin\EtudiantController@all')->name('etudiants.all');
Route::get('etudiants/les-etudiants', 'Admin\EtudiantController@listall')->name('etudiants.listall');
Route::post('etudiants/delete/{id}', 'Admin\EtudiantController@delete')->name('etudiants.delete');

Route::get('etudiants/data', 'Admin\EtudiantController@data')->name('etudiants.data');
Route::resource('etudiants', 'Admin\EtudiantController');

//gestion-evolution
Route::get('evolutions/data', 'Admin\EvolutionController@data')->name('evolutions.data');
Route::get('evolutions', 'Admin\EvolutionController@index')->name('evolutions.index');
Route::resource('evolutions', 'Admin\EvolutionController');

Route::get('etudiants/generate-pdf/{id}', 'Admin\PdfGenerateController@pdfview')->name('generate-pdf');

Route::get('stats/', 'Admin\StatsController@index')->name('stats.index');

//gestion-etablissements
Route::group(['prefix' => 'gestion-facultes'], function () {
	//Route::get('dashboard"', 'AdminController@index')->name('ADMIN');
	Route::post('etablissements/delete/{id}', 'Admin\EtablissementController@delete')->name('etablissements.delete');
	Route::get('facultes/data', 'Admin\EtablissementController@data')->name('etablissements.data');
	Route::resource('etablissements', 'Admin\EtablissementController');

});


//gestion-filieres
Route::group(['prefix' => 'gestion-filieres'], function () {
	//Route::get('dashboard"', 'AdminController@index')->name('ADMIN');
	Route::post('filieres/delete/{id}', 'Admin\FiliereController@delete')->name('filieres.delete');
	Route::get('filieres/data', 'Admin\FiliereController@data')->name('filieres.data');
	Route::resource('filieres', 'Admin\FiliereController');

});