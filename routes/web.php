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

Route::get('/', 'CharactersController@index');

//Route::get('/characters', 'CharactersController@index');
//Route::get('/character', 'CharactersController@showCharacter');


//Route::get('/character/{id}', function () {
//    //use with $id
//    return view('characters/character');
//});
Route::resource('characters', 'CharactersController');