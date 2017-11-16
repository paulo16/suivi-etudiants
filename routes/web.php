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
});

//gestion-etudiants
Route::get('etudiants/data', 'Admin\EtudiantController@data')->name('etudiants.data');
Route::resource('etudiants', 'Admin\EtudiantController');

//gestion-evolution
Route::get('evolutions/data', 'Admin\EvolutionController@data')->name('evolutions.data');
Route::get('evolutions', 'Admin\EvolutionController@index')->name('evolutions.index');




