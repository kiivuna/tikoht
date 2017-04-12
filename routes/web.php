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
Route::get('/tehtavalistas/create', 'TehtavalistasController@create');
Route::post('/tehtavalistas', 'TehtavalistasController@store');
Route::get('/tehtavalistas/{tehtavalista}', 'TehtavalistasController@show');


Route::post('/tehtavalistas/{tehtavalista}/tehtavas', 'TehtavasController@store');