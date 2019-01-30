<?php


// Route::get('/cms/{any}', 'AnyController@index')->where('any', '.*');
Route::group(['prefix' => 'api/cms'], function () {
    Route::resource('tasks', 'TaskController');
    Route::get('users', 'UserController@index');
});

Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth');

Route::get('/home', 'HomeController@home')->name('home');

