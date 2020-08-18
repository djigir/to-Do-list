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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// tasks list
Route::get('tasks', 'TaskController@index');

//single task
Route::get('task/{id}', 'TaskController@show');

// create task
Route::post('task', 'TaskController@store');

 //update task
Route::put('task', 'TaskController@store');

// delete task
Route::delete('task/{id}', 'TaskController@destroy');

