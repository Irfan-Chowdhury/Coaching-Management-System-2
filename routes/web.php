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



Auth::routes(['register' => false]); //for register route off

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/user-registration', [
        'uses' => 'UserRegistrationController@showRegistrationForm',
        'as'   => 'user-registration'
    ]);

    
    Route::post('/user-registration', [
        'uses' => 'UserRegistrationController@userSave',
        'as'   => 'user-save'
    ]);


    Route::get('/user-list', [
        'uses' => 'UserRegistrationController@userList',
        'as'   => 'user-list'
    ]);
    
    Route::get('/user-profile/{userId}', [
        'uses' => 'UserRegistrationController@userProfile',
        'as'   => 'user-profile'
    ]);
    
    Route::get('/change-user-info/{id}', [
        'uses' => 'UserRegistrationController@changeUserInfo',
        'as'   => 'change-user-info'
    ]);
    
    // Route::post('/user_info_update/{id}','UserRegistrationController@userInfoUpdate')->name('user_info_update');
    Route::post('/user-info-update', [
        'uses' => 'UserRegistrationController@userInfoUpdate',
        'as'   => 'user-info-update'
    ]);
    
    Route::get('/change-user-avatar/{id}','UserRegistrationController@changeUserAvatar')->name('change-user-avatar');

    Route::post('/update-user-photo/{id}','UserRegistrationController@updateUserPhoto')->name('update-user-photo');
    
    Route::get('/change-user-password/{id}','UserRegistrationController@changeUserPassword')->name('change-user-password');
    
    Route::post('/user-password-update/{id}','UserRegistrationController@userPasswordUpdate')->name('user-password-update');


});






