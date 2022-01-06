<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@home')->name('dashboard');

Auth::routes();

Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin.authenticate');
Route::post('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

Route::middleware(['auth:admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('enrollments', 'EnrollmentController');
    Route::resource('examination_departments', 'ExaminationDepartmentController');
    Route::resource('entrance_applications', 'EntranceApplicationController');
    Route::post(
        'entrance_applications/{entrance_application}/store-status',
        'EntranceApplicationController@storeStatus'
    )->name('entrance_applications.store-status');

    Route::post(
        'entrance_applications/{entrance_application}/confirm-study',
        'EntranceApplicationController@confirmStudy'
    )->name('entrance_applications.confirm-study');

    Route::resource('studies', 'StudyController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('image_types', 'ImageTypeController');
    Route::resource('users', 'UserController');
    Route::get('users/$user->profile->name_mm/{user}', 'UserController@showCard')->name('users.card.show');
    Route::get('users/card/print/{user}', 'UserController@printCard')->name('users.card.print');
    Route::get('users/recommendation/print/{user}', 'UserController@showRecommendation')->name('users.recommendation.show');
    // Route::get('users/recommendation/print/{user}', 'UserController@printRecommendation')->name('users.recommendation.print');
    Route::get('users/recommendation/print/{user}', 'UserController@printExcelRecommendation')->name('users.recommendation.printExcel');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('invoice_types', 'InvoiceTypeController');
    Route::resource('recommendation_types', 'RecommendationTypeController');
    Route::resource('major_change_histories', 'MajorChangeHistoryController');

    Route::get('settings', 'SiteSettingController@index')->name('settings');
    Route::post('settings/store', 'SiteSettingController@store')->name('settings.store');
    Route::post('settings/update', 'SiteSettingController@update')->name('settings.update');

    Route::resource('events', 'EventController');
});

Route::prefix('entrance')->name('entrance.')->group(function () {
    Route::get('/', 'EntranceApplicationController@showRelevantForm')->name('form');

    Route::get(
        '/matriculation-details',
        'EntranceApplicationController@showMatriculationDetailForm'
    )->name('matriculation-detail-form');

    Route::get(
        '/profile-info',
        'EntranceApplicationController@showProfileInfoForm'
    )->name('profile-info-form');

    Route::get(
        '/image-uploads',
        'EntranceApplicationController@showImageUploadsForm'
    )->name('image-uploads-form');

    Route::post('save-and-next', 'EntranceApplicationController@store')->name('save');
});
