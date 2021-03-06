<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout')->middleware('auth:api');
Route::get('/login', 'LoginController@checkToken')->middleware(('auth:api'));//check access token when init app

Route::get('/group', 'GroupController@index')->middleware('auth:api', 'scope:1');//Admin get list groups
Route::get('/group/show/{group}', 'GroupController@store')->middleware('auth:api', 'scope:1,2');//Admin create group
Route::post('/group/store', 'GroupController@store')->middleware('auth:api', 'scope:1');//Admin create group
Route::put('/group/{group}', 'GroupController@update')->middleware('auth:api', 'scope:1,2');//Admin, manager update group

Route::get('/user/users/{role}', 'UserController@users')->middleware('auth:api','scope:1,2');//Admin, Manager get list users
Route::get('/user/show/{user}', 'UserController@show')->middleware('auth:api');//Show detail of a user
Route::post('/user/store', 'UserController@store')->middleware('auth:api', 'scope:1');//Admin create user
Route::put('/user/{user}', 'UserController@update')->middleware('auth:api', 'scope:1,2');//Admin update, Manager assign to group
Route::delete('/user/{user}', 'UserController@destroy')->middleware('auth:api', 'scope:1');//Admin delete user

Route::get('/task', 'TaskController@index')->middleware('auth:api');//Get personal task
Route::post('/task/store', 'TaskController@store')->middleware('auth:api');//Admin, Manager, Employee creates task

// Route::put('/user/task/{task}', 'TaskController@update')->middleware('auth:api', 'scope:3');//Update task by user
