<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    //============================Translate All Pages==========================
    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:student' ]
    ], function(){

    //============================== dashboard ============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard');
    })->name('student_dashboard');

    //============================== exam ============================
    Route::group(['namespace' => 'Students\dashboard'] , function(){
        Route::resource('student_exams' , 'ExamController');
        Route::resource('student_profile' , 'profileController');
    });

});

