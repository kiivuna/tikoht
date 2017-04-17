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
    return view('layouts.master');
})->name('home');


Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');  //turvallisempi jos post


//Route::get('/', 'TasksController@index')->name('home');
Route::get('/tehtavalistas', 'TehtavalistasController@index');
Route::get('/tehtavalistas/omat', 'TehtavalistasController@omat');
Route::get('/tehtavalistas/create', 'TehtavalistasController@create');
Route::post('/tehtavalistas', 'TehtavalistasController@store');
Route::get('/tehtavalistas/{tehtavalista}', 'TehtavalistasController@show');
Route::post('/tehtavalistas/{tehtavalista}/delete', 'TehtavalistasController@destroy');
Route::get('/tehtavalistas/{tehtavalista}/edit', 'TehtavalistasController@edit');
Route::post('/tehtavalistas/{tehtavalista}/edit', 'TehtavalistasController@update');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::post('/tehtavalistas/{tehtavalista}/tehtavas', 'TehtavasController@store');
Route::post('/tehtavas/{tehtavas}/delete', 'TehtavasController@destroy');
Route::get('/tehtavas/{tehtavas}/edit', 'TehtavasController@edit');
Route::post('/tehtavas/{tehtavas}/edit', 'TehtavasController@update');

//Route::get('/', 'TasksController@index')->name('home');
Route::get('/sessios', 'SessiosController@index');
Route::get('/sessios/omat', 'SessiosController@omat');
Route::get('/sessios/create', 'SessiosController@create');
Route::post('/sessios', 'SessiosController@store');
Route::get('/sessios/{sessio}', 'SessiosController@show');
Route::post('/sessios/{sessio}/delete', 'SessiosController@destroy');
Route::get('/sessios/{sessio}/edit', 'SessiosController@edit');
Route::post('/sessios/{sessio}/edit', 'SessiosController@update');

Route::get('/kurssit', function () {
    return view('kurssis.omat');
});

Route::get('/kurssit/{kurssi}', 'KurssisController@show');

Route::get('/kurssit/sessiot/{sessio}', 'SessiosController@showsessiot');
//Route::get('/kurssit/{kurssi}/{sessio}', function () {
//    return view('layouts.master');
//});


Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
    return "this page requires that you be logged in and an Admin";
}]);