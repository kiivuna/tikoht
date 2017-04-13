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



Route::post('/tehtavalistas/{tehtavalista}/tehtavas', 'TehtavasController@store');
Route::post('/tehtavas/{tehtavas}/delete', 'TehtavasController@destroy');
Route::get('/tehtavas/{tehtavas}/edit', 'TehtavasController@edit');
Route::post('/tehtavas/{tehtavas}/edit', 'TehtavasController@update');


Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
    return "this page requires that you be logged in and an Admin";
}]);