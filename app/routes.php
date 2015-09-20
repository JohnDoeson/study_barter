<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'IndexController@getIndex');

Route::controller('users', 'UsersController');



Route::get('/register', 'UsersController@getRegister');
Route::get('/login', 'UsersController@getLogin');

Route::get('/logout', 'UsersController@getLogout');

Route::post('/cities', 'ProfileController@postCities');

Route::get("/profile/{id}", "ProfileController@getProfile");




Route::get('/env', function() {
    return App::environment();
});