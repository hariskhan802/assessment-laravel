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

// Login Route
Route::post('login', 'API\UserController@login')->name('login');
// Register Route
Route::post('register', 'API\UserController@register')->name('register');

// Meddleware for authentic user 
Route::group(['middleware' => 'auth:api'], function(){
	// Comment Post Route
	Route::post('post-comment', 'API\CommentController@post_comment')->name('post-comment');
	Route::get('logout', 'API\UserController@logout')->name('logout');
});
Route::group(['prefix' => 'films'], function(){
	// Create Film Route
	Route::post('create', 'API\FilmController@create')->name('films.create');
	// Films Route
	Route::get('/', 'API\FilmController@index')->name('films');
	// Single Film Route
	Route::get('/{slug}', 'API\FilmController@film')->name('film');
	
});
// Country Route
Route::get('get-countries', 'API\FilmController@get_countries')->name('get-countries');
// Genre Route
Route::get('get-genres', 'API\FilmController@get_genres')->name('get-genres');
