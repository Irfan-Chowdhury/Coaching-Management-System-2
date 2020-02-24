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

Route::get('/', function () {
    return view('welcome');
    //return view('admin.home.home');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user-registration', [
    'uses' => 'UserRegistrationController@showRegistrationForm',
    'as'   => 'user-registration'
])->middleware('auth');

Route::post('/user-registration', [
    'uses' => 'UserRegistrationController@userSave',
    'as'   => 'user-save'
])->middleware('auth');

Route::get('/user-list', [
    'uses' => 'UserRegistrationController@userList',
    'as'   => 'user-list'
])->middleware('auth');
