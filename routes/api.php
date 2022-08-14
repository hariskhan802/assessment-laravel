<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'API\UserController@login')->name('login');
Route::post('register', 'API\UserController@register')->name('register');
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('logout', 'API\UserController@logout')->name('logout');
});
Route::group(['prefix' => 'films'], function(){

	Route::post('create', 'API\FilmController@create')->name('films.create');
	Route::get('/', 'API\FilmController@index')->name('films');
	Route::get('/{slug}', 'API\FilmController@film')->name('film');
	
	Route::post('post-comment', 'API\CommentController@post_comment')->name('post-comment');
});
Route::get('get-countries', 'API\FilmController@get_countries')->name('get-countries');
Route::get('get-genres', 'API\FilmController@get_genres')->name('get-genres');
