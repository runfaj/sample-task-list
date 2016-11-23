<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/* the initial index route for angular to sit on top of */
Route::get('/', function () {
    return view('index');
});

/* setup the api routes */
Route::group(array('prefix' => 'api'), function()
{
    Route::post('tasks/search', 'TaskController@search');
    Route::resource('tasks', 'TaskController', ['except' => [
        'create', 'edit', 'show'
    ]]);
});
