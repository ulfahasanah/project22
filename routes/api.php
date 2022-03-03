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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group([
    'middleware' => 'auth.jwt'
], function () {

    Route::get('/employee/get', 'EmployeeController@getEmployee');
    Route::post('/employee/create', 'EmployeeController@createEmployee');
    Route::post('/employee/update/{id}', 'EmployeeController@updateEmployee');
    Route::get('/employee/remove/{id}', 'EmployeeController@removeEmployee');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/user-profile', 'AuthController@userProfile');

});