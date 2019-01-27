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

Route::get('/', 'CharactersController@index')->name('home');

//Route::get('/characters', 'CharactersController@index');
Route::get('/characters/filter', 'CharactersController@filter');
Route::put('/characters/addExp/{character}', 'CharactersController@addExp');
Route::put('/characters/levelup/{character}', 'CharactersController@levelup');


//Route::get('/character/{id}', function () {
//    //use with $id
//    return view('characters/character');
//});
Route::resource('characters', 'CharactersController');
Route::resource('tags', 'TagsController');
Auth::routes();

Route::get('/home', 'CharactersController@index')->name('home');
