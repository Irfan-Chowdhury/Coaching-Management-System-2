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
    

    //--- General Section ---
    Route::get('/add-header-footer','HomePageController@addHeaderFooterForm')->name('add-header-footer');
    Route::post('/header-footer-save','HomePageController@headerFooterSave')->name('header-footer-save');
    Route::get('/manage-header-footer/{id}','HomePageController@manageHeaderFooter')->name('manage-header-footer');
    Route::post('/header-footer-update/{id}','HomePageController@headerFooterUpdate')->name('header-footer-update');
    
    //--- Slider Section ---
    Route::get('/add-slide','SliderController@addSlide')->name('add-slide');
    Route::post('/upload-slide','SliderController@uploadSlide')->name('upload-slide');
    Route::get('/manage-slide','SliderController@manageSlide')->name('manage-slide');
    Route::get('/slide-unpublished/{id}','SliderController@slideUnpublished')->name('slide-unpublished');
    Route::get('/slide-published/{id}','SliderController@slidePublished')->name('slide-published');
    Route::get('/slide-edit/{id}','SliderController@slideEdit')->name('slide-edit');
    Route::post('/update-slide/{id}','SliderController@updateSlide')->name('update-slide');
    Route::get('/slide-delete/{id}','SliderController@slideDelete')->name('slide-delete');
    
    //Photo Gallery Section
    Route::get('/photo-gallery','SliderController@photoGallery')->name('photo-gallery');

    //School Management section
    Route::get('/school/add','SchoolManagementController@addSchoolForm')->name('add-school');
    Route::post('/school/add','SchoolManagementController@schoolSave')->name('school-save');
    Route::get('/school/list','SchoolManagementController@schoolList')->name('school-list');
    Route::get('/school/unpublished/{id}','SchoolManagementController@schoolUnpublished')->name('school-unpublished');
    Route::get('/school/published/{id}','SchoolManagementController@schoolPublished')->name('school-published');
    Route::get('/school/edit/{id}','SchoolManagementController@schoolEditForm')->name('school-edit');
    Route::post('/school/update/{id}','SchoolManagementController@schoolUpdate')->name('school-update');
    Route::get('/school/delete/{id}','SchoolManagementController@schoolDelete')->name('school-delete');

    //Class Management section
    Route::get('/class/add','ClassManagementController@addClassForm')->name('add-class');
    Route::post('/class/add','ClassManagementController@classSave')->name('class-save');
    Route::get('/class/list','ClassManagementController@classList')->name('class-list');
    Route::get('/class/unpublished/{id}','ClassManagementController@classUnpublished')->name('class-unpublished');
    Route::get('/class/published/{id}','ClassManagementController@classPublished')->name('class-published');
    Route::get('/class/edit/{id}','ClassManagementController@classEditForm')->name('class-edit');
    Route::post('/class/update/{id}','ClassManagementController@classUpdate')->name('class-update');
    Route::get('/class/delete/{id}','ClassManagementController@classDelete')->name('class-delete');

    //Batch Management section
    Route::get('/batch/add','BatchManagementController@addBatchForm')->name('add-batch');
    Route::post('/batch/add','BatchManagementController@batchSave')->name('batch-save');
    Route::get('/batch/list','BatchManagementController@batchList')->name('batch-list');
    Route::get('/batch/list-by-ajax','BatchManagementController@batchListByAjax')->name('batch-list-by-ajax'); //Ajax for show list
    Route::get('/batch/unpublished','BatchManagementController@batchUnpublished')->name('batch-unpublished'); //Unpublished by Ajax
    Route::get('/batch/published','BatchManagementController@batchPublished')->name('batch-published'); //Published by Ajax
    Route::get('/batch/delete','BatchManagementController@batchDelete')->name('batch-delete'); //Delete by Ajax
    Route::get('/batch/edit/{id}','BatchManagementController@batchEdit')->name('batch-edit'); 
    Route::post('/batch/update/{id}','BatchManagementController@batchUpdate')->name('batch-update'); 

    //Student Type Management section
    Route::get('/student-type','StudentTypeController@index')->name('student-type');
    Route::post('/student-type-add','StudentTypeController@studentTypeAdd')->name('student-type-add'); //Create By Ajax
    Route::get('/student-type-list','StudentTypeController@studentTypeList')->name('student-type-list'); //Read By Ajax

    Route::get('/student-type-unpublish','StudentTypeController@studentTypeUnpublish')->name('student-type-unpublish'); //unpublish By Ajax
    
    Route::get('/student-type-publish','StudentTypeController@studentTypePublish')->name('student-type-publish'); //publish By Ajax
    
    Route::post('/student-type-update','StudentTypeController@studentTypeUpdate')->name('student-type-update'); //update By Ajax
    
    Route::get('/student-type-delete','StudentTypeController@studentTypeDelete')->name('student-type-delete'); //delete By Ajax


});






